<?php

/**
 * This file is part of the Scrapyard module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace AdminModule\ScrapyardModule;

use Nette\Forms\Form;
use WebCMS\ScrapyardModule\Entity\CarModel;

/**
 *
 * @author Jakub Sanda <jakub.sanda@webcook.cz>
 */
class CarModelPresenter extends BasePresenter
{
    
    private $carModel;
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

    protected function createComponentCarModelGrid($name)
    {
        $grid = $this->createGrid($this, $name, "\WebCMS\ScrapyardModule\Entity\CarModel", null, array());

        $grid->setFilterRenderType(\Grido\Components\Filters\Filter::RENDER_INNER);

        $grid->addColumnText('name', 'Název')->setSortable()->setFilterText();

        $grid->addColumnText('carBrand', 'Značka auta')->setCustomRender(function($item) {
          return $item->getCarBrand()->getName();
        })->setSortable();

        $grid->addActionHref("update", 'Upravit', 'update', array('idPage' => $this->actualPage->getId()))->getElementPrototype()->addAttributes(array('class' => array('btn' , 'btn-primary', 'ajax')));
        $grid->addActionHref("delete", 'Smazat', 'delete', array('idPage' => $this->actualPage->getId()))->getElementPrototype()->addAttributes(array('class' => array('btn', 'btn-danger'), 'data-confirm' => 'Are you sure you want to delete this item?'));

        return $grid;
    }


    public function actionUpdate($id, $idPage)
    {
        if ($id) {
            $this->carModel = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarModel')->find($id);
        }
    }

    public function renderUpdate($idPage)
    {
        $this->reloadContent();

        $this->template->idPage = $idPage;
    }
    
    public function actionDelete($id){

        $carModel = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarModel')->find($id);

        $this->em->remove($carModel);
        $this->em->flush();
        
        $this->flashMessage('Model byl smazán.', 'success');
        
        if(!$this->isAjax()){
            $this->forward('default', array(
                'idPage' => $this->actualPage->getId()
            ));
        }
    }

    public function createComponentForm($name)
    {
        $form = $this->createForm('form-submit', 'default', null);

        $form->addText('name', 'Název')
            ->setRequired('Název je povinný.');

        $brands = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarBrand')->findAll();
        $brandsForSelect = array();
        if ($brands) {
            foreach ($brands as $brand) {
                $brandsForSelect[$brand->getId()] = $brand->getName();
            }
        }

        $form->addSelect('carBrand', 'Značka')->setItems($brandsForSelect);

        if ($this->carModel) {
            $form->setDefaults($this->carModel->toArray());
        }

        $form->addSubmit('save', 'Uložit');

        $form->onSuccess[] = callback($this, 'formSubmitted');

        return $form;
    }

    public function formSubmitted($form)
    {
        $values = $form->getValues();

        if (!$this->carModel) {
            $this->carModel = new CarModel;
            $this->em->persist($this->carModel);
        }

        $this->carModel->setName($values->name);
        $carBrand = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarBrand')->find($values->carBrand);
        $this->carModel->setCarBrand($carBrand);

        $this->em->flush();

        $this->flashMessage('Model byl uložen.', 'success');

        $this->forward('default', array(
            'idPage' => $this->actualPage->getId()
        ));
    }

    
}
