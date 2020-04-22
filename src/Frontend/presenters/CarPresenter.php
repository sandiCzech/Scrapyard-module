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

	private $brand;

	private $models;

	private $model;

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
		$this->brands = $this->brandsRepository->findBy(array(), array('name' => 'ASC'));
		$this->models = $this->modelsRepository->findBy(array(), array('name' => 'ASC'));
	}

	public function renderDefault($id)
	{

		$params = $this->getParameter('parameters');

		if (count($params) > 0) {
			if (isset($params[0])) {
				$this->brand = $this->brandsRepository->findOneBySlug($params[0]);
				if (!is_object($this->brand)) {
					$this->redirect('default', array(
						'path' => $this->actualPage->getPath(),
						'abbr' => $this->abbr
					));
				} else {
					$this->models = $this->modelsRepository->findBy(array(
						'carBrand' => $this->brand
					), array('name' => 'ASC'));
					$this->template->brand = $this->brand;

					$this->cars = $this->repository->findBy(array(
						'carBrand' => $this->brand
					), array('carName' => 'ASC'));

					if (isset($params[1])) {
						$this->model = $this->modelsRepository->findOneBySlug($params[1]);
						if (!is_object($this->model)) {
							$this->redirect('default', array(
								'path' => $this->actualPage->getPath(),
								'abbr' => $this->abbr
							));
						} else {
							$this->template->model = $this->model;

							$this->cars = $this->repository->findBy(array(
								'carBrand' => $this->brand,
								'carModel' => $this->model
							), array('carName' => 'ASC'));
						}
					}
				}
			}
		}

		$this->template->cars = $this->cars;
		$this->template->brands = $this->brands;
		$this->template->models = $this->models;
		$this->template->id = $id;
	}

	public function renderShowBrand($id)
	{

		
	}

}
