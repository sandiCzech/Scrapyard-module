<?php

/**
 * This file is part of the Scrapyard module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace AdminModule\ScrapyardModule;

use Nette\Forms\Form;
use WebCMS\ScrapyardModule\Entity\Tire;

/**
 *
 * @author Jakub Sanda <jakub.sanda@webcook.cz>
 */
class TirePresenter extends BasePresenter
{
    
    private $tire;

    private $carBrand;

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

    protected function createComponentTireGrid($name)
    {
        $grid = $this->createGrid($this, $name, "\WebCMS\ScrapyardModule\Entity\Tire");

        $grid->addColumnText('tireName', 'Název')->setSortable()->setFilterText();

        $grid->addColumnText('carBrand', 'Značka')->setCustomRender(function($item) {
            return $item->getCarBrand()->getName();
        })->setSortable();

        $grid->addColumnText('price', 'Cena')->setSortable();

        $grid->addColumnText('tireSize', 'Velikost')->setSortable();

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
        $this->tire = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\Tire')->find($id);
        $this->tire->setHide($this->tire->getHide() ? false : true);

        $this->em->flush();

        $this->flashMessage('Upraveno', 'success');
        $this->forward('default', array(
            'idPage' => $this->actualPage->getId()
        ));
    }

    public function actionUpdate($id, $idPage)
    {
        if ($id) {
            $this->tire = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\Tire')->find($id);
        }
    }

    public function renderUpdate($idPage)
    {
        $this->reloadContent();

        $this->template->idPage = $idPage;
        $this->template->tire = $this->tire;
    }

    public function actionDelete($id){

        $tire = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\Tire')->find($id);

        $this->em->remove($tire);
        $this->em->flush();
        
        $this->flashMessage('Pneu bylo smazáno.', 'success');
        
        if(!$this->isAjax()){
            $this->forward('default', array(
                'idPage' => $this->actualPage->getId()
            ));
        }
    }

    public function createComponentForm($name)
    {
        $form = $this->createForm('form-submit', 'default', null);

        $form->addText('tireName', 'Název')
            ->setRequired('Název je povinný.');

        $brands = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarBrand')->findBy(array('alu' => true));;
        $brandsForSelect = array();
        if ($brands) {
            foreach ($brands as $brand) {
                $brandsForSelect[$brand->getId()] = $brand->getName();
            }
        }

        $sizesForSelect = array(
            'R13' => 'R13',
            'R14' => 'R14',
            'R15' => 'R15',
            'R16' => 'R16',
            'R16.5'=> 'R16.5',
            'R17'=> 'R17',
            'R18' => 'R18',
            'R19' => 'R19',
            'R20' => 'R20',
            'R21' => 'R21',
            'R22' => 'R22',
            'R23' => 'R23',
            'R24' => 'R24',
            'R26' => 'R26',
            'R28' => 'R28',
            'R30' => 'R30'
        );

        $form->addSelect('carBrand', 'Značka')->setItems($brandsForSelect);
        $form->addSelect('tireSize', 'Velikost')->setItems($sizesForSelect);
        $form->addText('price', 'Cena');
        $form->addText('tireCondition', 'Stav');
        $form->addTextArea('text', 'Text')->setAttribute('class', 'form-control editor');
                
        $form->addCheckbox('hide', 'Schovat');

        if ($this->tire) {
            $form->setDefaults($this->tire->toArray());
        }

        $form->addSubmit('save', 'Uložit');

        $form->onSuccess[] = callback($this, 'formSubmitted');

        return $form;
    }

    public function formSubmitted($form)
    {
        $values = $form->getValues();

        if (!$this->tire) {
            $this->tire = new Tire;
            $this->em->persist($this->tire);
        } else {
            // delete old photos and save new ones
            $qb = $this->em->createQueryBuilder();
            $qb->delete('WebCMS\ScrapyardModule\Entity\PhotoTire', 'l')
                    ->where('l.tire = ?1')
                    ->setParameter(1, $this->tire)
                    ->getQuery()
                    ->execute();
        }

        $this->tire->setTireName($values->tireName);
        $carBrand = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarBrand')->find($values->carBrand);
        $this->tire->setCarBrand($carBrand);
        $this->tire->setTireSize($values->tireSize);
        $this->tire->setTireCondition($values->tireCondition);
        $this->tire->setPrice($values->price);
        $this->tire->setText($values->text);
        $this->tire->setHide($values->hide);

        if (array_key_exists('files', $_POST)) {
            $counter = 0;
            if(array_key_exists('fileDefault', $_POST)) $default = intval($_POST['fileDefault'][0]) - 1;
            else $default = -1;
            
            foreach($_POST['files'] as $path){

                $photo = new \WebCMS\ScrapyardModule\Entity\PhotoTire;
                $photo->setName($_POST['fileNames'][$counter]);
                
                if($default === $counter){
                    $photo->setMain(TRUE);
                }else{
                    $photo->setMain(FALSE);
                }
                
                $photo->setPath($path);
                $photo->setTire($this->tire);
                $photo->setCreated(new \DateTime);

                $this->em->persist($photo);

                $counter++;
            }
        }

        $this->em->flush();

        $this->flashMessage('Pneu bylo uloženo.', 'success');

        $this->forward('default', array(
            'idPage' => $this->actualPage->getId()
        ));
    }

    

    
}
