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
 * @ORM\Table(name="Scrapyard_CarBrand")
 */
class CarBrand extends \WebCMS\Entity\Entity
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @gedmo\Slug(fields={"name"})
     * @ORM\Column(length=64)
     */
    private $slug;

    /**
     * @ORM\Column(type="boolean")
     */
    private $top;

    public function __construct()
    {
        $this->top = false;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
        return $this;
    }



    /**
     * Get the value of top
     */ 
    public function getTop()
    {
        return $this->top;
    }

    /**
     * Set the value of top
     *
     * @return  self
     */ 
    public function setTop($top)
    {
        $this->top = $top;

        return $this;
    }
}
