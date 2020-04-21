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


}
