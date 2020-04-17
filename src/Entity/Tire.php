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
    private $tireName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tireSize;

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
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @orm\Column(type="text", nullable=true)
     */
    private $text;

    public function __construct()
    {
        $this->hide = false;
        $this->sold = false;
    }

    /**
     * Get the value of size
     */ 
    public function getTireSize()
    {
        return $this->tireSize;
    }

    /**
     * Set the value of size
     *
     * @return  self
     */ 
    public function setTireSize($tireSize)
    {
        $this->tireSize = $tireSize;

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

    /**
     * Get the value of tireName
     */ 
    public function getTireName()
    {
        return $this->tireName;
    }

    /**
     * Set the value of tireName
     *
     * @return  self
     */ 
    public function setTireName($tireName)
    {
        $this->tireName = $tireName;

        return $this;
    }
}
