<?php

/**
 * This file is part of the Scrapyard module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace AdminModule\ScrapyardModule;

use Nette\Forms\Form;
use WebCMS\ScrapyardModule\Entity\CarBrand;

/**
 *
 * @author Jakub Sanda <jakub.sanda@webcook.cz>
 */
class CarBrandPresenter extends BasePresenter
{
    
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

    protected function createComponentCarBrandGrid($name)
    {
        $grid = $this->createGrid($this, $name, "\WebCMS\ScrapyardModule\Entity\CarBrand", null, array());

        $grid->setFilterRenderType(\Grido\Components\Filters\Filter::RENDER_INNER);

        $grid->addColumnText('name', 'Název')->setSortable()->setFilterText();

        $grid->addColumnText('top', 'Topovaný')->setCustomRender(function($item) {
            if ($item->getTop()) {
                return 'Ano';
            } else {
                return 'Ne';
            }
        })->setSortable();

        $grid->addColumnText('alu', 'Alu')->setCustomRender(function($item) {
            if ($item->getAlu()) {
                return 'Ano';
            } else {
                return 'Ne';
            }
        })->setSortable();

        $grid->addActionHref("update", 'Upravit', 'update', array('idPage' => $this->actualPage->getId()))->getElementPrototype()->addAttributes(array('class' => array('btn' , 'btn-primary', 'ajax')));
        $grid->addActionHref("delete", 'Smazat', 'delete', array('idPage' => $this->actualPage->getId()))->getElementPrototype()->addAttributes(array('class' => array('btn', 'btn-danger'), 'data-confirm' => 'Are you sure you want to delete this item?'));

        return $grid;
    }


    public function actionUpdate($id, $idPage)
    {
        if ($id) {
            $this->carBrand = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarBrand')->find($id);
        }
    }

    public function renderUpdate($idPage)
    {
        $this->reloadContent();

        $this->template->idPage = $idPage;
    }
    
    public function actionDelete($id){

        $carBrand = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarBrand')->find($id);

        $this->em->remove($carBrand);
        $this->em->flush();
        
        $this->flashMessage('Značka byla odstraněna.', 'success');
        
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

        $form->addCheckbox('top', 'Topovaný');
        $form->addCheckbox('alu', 'Alu kolo');

        if ($this->carBrand) {
            $form->setDefaults($this->carBrand->toArray());
        }

        $form->addSubmit('save', 'Uložit');

        $form->onSuccess[] = callback($this, 'formSubmitted');

        return $form;
    }

    public function formSubmitted($form)
    {
        $values = $form->getValues();

        if (!$this->carBrand) {
            $this->carBrand = new CarBrand;
            $this->em->persist($this->carBrand);
        }

        $this->carBrand->setName($values->name);
        $this->carBrand->setTop($values->top);
        $this->carBrand->setAlu($values->alu);

        $this->em->flush();

        $this->flashMessage('Značka byla uložena.', 'success');

        $this->forward('default', array(
            'idPage' => $this->actualPage->getId()
        ));
    }

    
}
