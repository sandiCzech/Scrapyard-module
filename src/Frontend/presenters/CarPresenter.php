<?php

/**
 * This file is part of the Scrapyard module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace FrontendModule\ScrapyardModule;

use WebCMS\ScrapyardModule\Entity\Car;


/**
 *
 * @author Jakub Sanda <jakub.sanda@webcook.cz>
 */
class CarPresenter extends BasePresenter
{
	private $id;

	private $repository;

	private $cars;

	protected function startup() 
    {
		parent::startup();

		$this->repository = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\Car');
	}

	protected function beforeRender()
    {
		parent::beforeRender();	
	}

	public function actionDefault($id)
    {	
		$this->cars = $this->repository->findBy(array(), array('id' => 'DESC'));
	}

	public function renderDefault($id)
	{
		$this->template->cars = $this->cars;
		$this->template->id = $id;
	}

}
