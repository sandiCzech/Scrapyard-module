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
 * @ORM\Table(name="Scrapyard_Tire")
 */
class Tire extends \WebCMS\Entity\Entity
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $size;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $condition;

    /**
     * @ORM\ManyToOne(targetEntity="CarBrand")
     * @ORM\JoinColumn(name="carBrand_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $carBrand;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    private $price;
    
    /**
     * @ORM\OneToMany(targetEntity="PhotoTire", mappedBy="Tire") 
     * @var Array
     */
    private $photos;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hide;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sold;

    /**
     * @ORM\Column(type="boolean")
     */
    private $top;

    /**
     * @orm\Column(type="text", nullable=true)
     */
    private $text;

    public function __construct()
    {
        $this->hide = false;
        $this->top = false;
        $this->sold = false;
    }


    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of size
     */ 
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @return  self
     */ 
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the value of condition
     */ 
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Set the value of condition
     *
     * @return  self
     */ 
    public function setCondition($condition)
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of photos
     *
     * @return  Array
     */ 
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Set the value of photos
     *
     * @param  Array  $photos
     *
     * @return  self
     */ 
    public function setPhotos(Array $photos)
    {
        $this->photos = $photos;

        return $this;
    }

    /**
     * Get the value of hide
     */ 
    public function getHide()
    {
        return $this->hide;
    }

    /**
     * Set the value of hide
     *
     * @return  self
     */ 
    public function setHide($hide)
    {
        $this->hide = $hide;

        return $this;
    }

    /**
     * Get the value of sold
     */ 
    public function getSold()
    {
        return $this->sold;
    }

    /**
     * Set the value of sold
     *
     * @return  self
     */ 
    public function setSold($sold)
    {
        $this->sold = $sold;

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

    /**
     * Get the value of text
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @return  self
     */ 
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of carBrand
     */ 
    public function getCarBrand()
    {
        return $this->carBrand;
    }

    /**
     * Set the value of carBrand
     *
     * @return  self
     */ 
    public function setCarBrand($carBrand)
    {
        $this->carBrand = $carBrand;

        return $this;
    }
}
