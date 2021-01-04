<?php

/**
 * This file is part of the Scrapyard module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace AdminModule\ScrapyardModule;

use Nette\Forms\Form;
use WebCMS\ScrapyardModule\Entity\Car;

/**
 *
 * @author Jakub Sanda <jakub.sanda@webcook.cz>
 */
class CarPresenter extends BasePresenter
{
    
    private $car;

    private $carBrand;

    private $carModel;

    protected function startup()
    {
    	parent::startup();
    }

    protected function beforeRender()
    {
	   parent::beforeRender();
    }

    public function actionDefault($idPage)
    {
    }

    public function renderDefault($idPage){
        $this->reloadContent();
        
        $this->template->idPage = $idPage;
    }

    protected function createComponentCarGrid($name)
    {
        $grid = $this->createGrid($this, $name, "\WebCMS\ScrapyardModule\Entity\Car");

        $grid->addColumnText('carName', 'Název')->setSortable()->setFilterText();

        $grid->addColumnText('carBrand', 'Značka')->setCustomRender(function($item) {
            return $item->getCarBrand()->getName();
        })->setSortable();

        $grid->addColumnText('carModel', 'Model')->setCustomRender(function($item) {
            return $item->getCarModel()->getName();
        })->setSortable();


        $grid->addColumnText('year', 'Rok výroby')->setSortable()->setFilterText();

        $grid->addColumnText('fuel', 'Palivo')->setSortable()->setFilterText();

        $grid->addColumnText('hide', 'Schovat')->setCustomRender(function($item) {
            if ($item->getHide()) {
                return 'Ano';
            } else {
                return 'Ne';
            }
        })->setSortable();

        $grid->addActionHref("update", 'Upravit', 'update', array('idPage' => $this->actualPage->getId()))->getElementPrototype()->addAttributes(array('class' => array('btn', 'btn-primary', 'ajax')));
        $grid->addActionHref("hide", 'Schovat', 'hide', array('idPage' => $this->actualPage->getId()))->getElementPrototype()->addAttributes(array('class' => array('btn', 'btn-primary', 'ajax')));
        $grid->addActionHref("delete", 'Smazat', 'delete', array('idPage' => $this->actualPage->getId()))->getElementPrototype()->addAttributes(array('class' => array('btn', 'btn-danger') , 'data-confirm' => 'Are you sure you want to delete this item?'));

        return $grid;
    }

    public function actionHide($id, $idPage)
    {
        $this->car = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\Car')->find($id);
        $this->car->setHide($this->car->getHide() ? false : true);

        $this->em->flush();

        $this->flashMessage('Upraveno', 'success');
        $this->forward('default', array(
            'idPage' => $this->actualPage->getId()
        ));
    }

    public function actionUpdate($id, $idPage)
    {
        if ($id) {
            $this->car = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\Car')->find($id);
        }
    }

    public function renderUpdate($idPage)
    {
        $this->reloadContent();

        $this->template->idPage = $idPage;
        $this->template->car = $this->car;
    	$this->template->modelyAut = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarModel')->findAll();
    }

    public function actionDelete($id){

        $Car = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\Car')->find($id);

        $this->em->remove($Car);
        $this->em->flush();
        
        $this->flashMessage('Auto bylo smazáno.', 'success');
        
        if(!$this->isAjax()){
            $this->forward('default', array(
                'idPage' => $this->actualPage->getId()
            ));
        }
    }

    public function createComponentForm($name)
    {
        $form = $this->createForm('form-submit', 'default', null);

        $form->addText('carName', 'Název')
            ->setRequired('Název je povinný.');

        $brands = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarBrand')->findAll();
        $brandsForSelect = array();
        if ($brands) {
            foreach ($brands as $brand) {
                $brandsForSelect[$brand->getId()] = $brand->getName();
            }
        }

        $form->addSelect('carBrand', 'Značka')->setItems($brandsForSelect);

        $models = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarModel')->findAll();
        $modelsForSelect = array();
        if ($models) {
            foreach ($models as $model) {
                $modelsForSelect[$model->getId()] = $model->getName();
            }
        }

        $form->addSelect('carModel', 'Model')->setItems($modelsForSelect);

        $form->addText('year', 'Rok výroby');
        $form->addText('engine', 'Motorizace');
        $form->addText('engineCode', 'Kódové označení ');
        $form->addText('fuel', 'Palivo');
        $form->addText('bodywork', 'Karoserie');
        $form->addTextArea('text', 'Text')->setAttribute('class', 'form-control editor');
                
        $form->addCheckbox('hide', 'Schovat');

        if ($this->car) {
            $form->setDefaults($this->car->toArray());
        }

        $form->addSubmit('save', 'Uložit');

        $form->onSuccess[] = callback($this, 'formSubmitted');

        return $form;
    }

    public function formSubmitted($form)
    {
        $values = $form->getValues();

        if (!$this->car) {
            $this->car = new Car;
            $this->em->persist($this->car);
        } else {
            // delete old photos and save new ones
            $qb = $this->em->createQueryBuilder();
            $qb->delete('WebCMS\ScrapyardModule\Entity\PhotoCar', 'l')
                    ->where('l.car = ?1')
                    ->setParameter(1, $this->car)
                    ->getQuery()
                    ->execute();
        }

        $this->car->setCarName($values->carName);
        $carBrand = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarBrand')->find($values->carBrand);
        $this->car->setCarBrand($carBrand);
        $carModel = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarModel')->find($values->carModel);
        $this->car->setCarModel($carModel);
        $this->car->setYear($values->year);
        $this->car->setEngine($values->engine);
        $this->car->setEngineCode($values->engineCode);
        $this->car->setFuel($values->fuel);
        $this->car->setBodywork($values->bodywork);
        $this->car->setText($values->text);
        $this->car->setHide($values->hide);

        if (array_key_exists('files', $_POST)) {
            $counter = 0;
            if(array_key_exists('fileDefault', $_POST)) $default = intval($_POST['fileDefault'][0]) - 1;
            else $default = -1;
            
            foreach($_POST['files'] as $path){

                $photo = new \WebCMS\ScrapyardModule\Entity\PhotoCar;
                $photo->setName($_POST['fileNames'][$counter]);
                
                if($default === $counter){
                    $photo->setMain(TRUE);
                }else{
                    $photo->setMain(FALSE);
                }
                
                $photo->setPath($path);
                $photo->setCar($this->car);
                $photo->setCreated(new \DateTime);

                $this->em->persist($photo);

                $counter++;
            }
        }

        $this->em->flush();

        $this->flashMessage('Auto bylo uloženo.', 'success');

        $this->forward('default', array(
            'idPage' => $this->actualPage->getId()
        ));
    }

    
}
