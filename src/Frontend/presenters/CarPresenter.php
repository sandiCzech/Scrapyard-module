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

	private $brandsRepository;

	private $modelsRepository;

	private $cars;

	private $car;

	private $brands;

	private $models;

	protected function startup() 
    {
		parent::startup();

		$this->repository = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\Car');
		$this->brandsRepository = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarBrand');
		$this->modelsRepository = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarModel');
	}

	protected function beforeRender()
    {
		parent::beforeRender();	
	}

	public function actionDefault($id)
    {	
		$this->cars = $this->repository->findBy(array(), array('id' => 'DESC'));
		$this->brands = $this->brandsRepository->findBy(array(), array('id' => 'DESC'));
		$this->models = $this->modelsRepository->findBy(array(), array('id' => 'DESC'));
	}

	public function renderDefault($id)
	{

		$detail = $this->getParameter('parameters');

		if (count($detail) > 0) {
			$this->car = '';

			if (!is_object($this->car)) {
				$this->redirect('default', array(
					'path' => $this->actualPage->getPath(),
					'abbr' => $this->abbr
				));
			} else {
				$this->template->car = $this->car;
			}
		}

		$this->template->cars = $this->cars;
		$this->template->brands = $this->brands;
		$this->template->models = $this->models;
		$this->template->id = $id;
	}

}
