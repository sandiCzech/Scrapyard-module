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

	private $brandsRepository;

	private $tires;

	private $tire;

	private $brands;

	private $brand;

	private $sizes;

	private $size;

	protected function startup() 
    {
		parent::startup();

		$this->repository = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\Tire');
		$this->brandsRepository = $this->em->getRepository('\WebCMS\ScrapyardModule\Entity\CarBrand');
	}

	protected function beforeRender()
    {
		parent::beforeRender();	
	}

	public function actionDefault($id)
    {	
		$this->tires = $this->repository->findBy(array(), array('id' => 'DESC'));
		$this->brands = $this->brandsRepository->findBy(array(), array('name' => 'ASC'));

		$this->sizes = array(
			'r13' => 'R13',
			'r14' => 'R14',
			'r15' => 'R15',
			'r16' => 'R16',
			'r16.5'=> 'R16.5',
			'r17'=> 'R17',
			'r18' => 'R18',
			'r19' => 'R19',
			'r20' => 'R20',
			'r21' => 'R21',
			'r22' => 'R22',
			'r23' => 'R23',
			'r24' => 'R24',
			'r26' => 'R26',
			'r28' => 'R28',
			'r30' => 'R30'
	);
	}

	public function renderDefault($id)
	{

		$params = $this->getParameter('parameters');

		if (count($params) > 0) {
			if (isset($params[0])) {
				$this->size = strtoupper($params[0]);
				if (!in_array($this->size, $this->sizes)) {
					$this->redirect('default', array(
						'path' => $this->actualPage->getPath(),
						'abbr' => $this->abbr
					));
				} else {

					$this->tires = $this->repository->findBy(array(
						'tireSize' => $this->size
					), array('id' => 'DESC'));

					if (isset($params[1])) {
						$this->brand = $this->brandsRepository->findOneBySlug($params[1]);
						if (!is_object($this->brand)) {
							$this->redirect('default', array(
								'path' => $this->actualPage->getPath(),
								'abbr' => $this->abbr
							));
						} else {
							$this->template->brand = $this->brand;

							$this->tires = $this->repository->findBy(array(
								'tireSize' => $this->size,
								'carBrand' => $this->brand
							), array('id' => 'DESC'));

							if (isset($params[2])) {
								$this->tire = $this->repository->findOneBySlug($params[2]);
							}
						}
					}
				}
			}
		}

		$this->template->tires = $this->tires;
		$this->template->tire = $this->tire;
		$this->template->brands = $this->brands;
		$this->template->sizes = $this->sizes;
		$this->template->size = $this->size;
		$this->template->id = $id;
	}

}
