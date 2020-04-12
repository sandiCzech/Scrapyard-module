<?php

/**
 * This file is part of the Scrapyard module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace WebCMS\ScrapyardModule\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as gedmo;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Scrapyard_CarModel")
 */
class CarModel extends \WebCMS\Entity\Entity
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="CarBrand")
     * @ORM\JoinColumn(name="carBrand_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $carBrand;

    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getCarBrand()
    {
        return $this->carBrand;
    }
    
    public function setCarBrand($carBrand)
    {
        $this->carBrand = $carBrand;
        return $this;
    }


}
