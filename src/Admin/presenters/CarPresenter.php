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

        $grid->addColumnText('name', 'Název')->setSortable();

        $grid->addColumnText('carBrand', 'Značka auta')->setCustomRender(function($item) {
            return $item->getCarBrand()->getName();
        })->setSortable();

        $grid->addActionHref("update", 'Upravit', 'update', array('idPage' => $this->actualPage->getId()))->getElementPrototype()->addAttributes(array('class' => array('btn', 'btn-primary', 'ajax')));
        $grid->addActionHref("delete", 'Smazat', 'delete', array('idPage' => $this->actualPage->getId()))->getElementPrototype()->addAttributes(array('class' => array('btn', 'btn-danger') , 'data-confirm' => 'Are you sure you want to delete this item?'));

        return $grid;
    }

    
}
