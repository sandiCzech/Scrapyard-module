<?php

/**
 * This file is part of the Scrapyard module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace FrontendModule\ScrapyardModule;

use WebCMS\ScrapyardModule\Entity\Tire;


/**
 *
 * @author Jakub Sanda <jakub.sanda@webcook.cz>
 */
class TirePresenter extends BasePresenter
{
	private $id;

	private $repository;

	private $tires;

	protected function startup() 
    {
		parent::startup();

		$this->repository = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\Tire');
	}

	protected function beforeRender()
    {
		parent::beforeRender();	
	}

	public function actionDefault($id)
    {	
		$this->tires = $this->repository->findBy(array(), array('id' => 'DESC'));
	}

	public function renderDefault($id)
	{
		$this->template->tires = $this->tires;
		$this->template->id = $id;
	}

}
