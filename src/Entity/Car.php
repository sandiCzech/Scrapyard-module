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
 * @ORM\Table(name="Scrapyard_Car")
 */
class Car extends \WebCMS\Entity\Entity
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $carName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fuel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $engine;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $engineCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $price;
    
    /**
     * @ORM\OneToMany(targetEntity="PhotoCar", mappedBy="car") 
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
    private $top;

    /**
     * @orm\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="CarBrand")
     * @ORM\JoinColumn(name="carBrand_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $carBrand;

    /**
     * @ORM\ManyToOne(targetEntity="CarModel")
     * @ORM\JoinColumn(name="carModel_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $carModel;

    public function __construct()
    {
        $this->hide = false;
        $this->top = false;
    }


    /**
     * Get the value of name
     */ 
    public function getCarName()
    {
        return $this->carName;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setCarName($carName)
    {
        $this->carName = $carName;

        return $this;
    }

    /**
     * Get the value of year
     */ 
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set the value of year
     *
     * @return  self
     */ 
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get the value of fuel
     */ 
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * Set the value of fuel
     *
     * @return  self
     */ 
    public function setFuel($fuel)
    {
        $this->fuel = $fuel;

        return $this;
    }

    /**
     * Get the value of engine
     */ 
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * Set the value of engine
     *
     * @return  self
     */ 
    public function setEngine($engine)
    {
        $this->engine = $engine;

        return $this;
    }

    /**
     * Get the value of engineCode
     */ 
    public function getEngineCode()
    {
        return $this->engineCode;
    }

    /**
     * Set the value of engineCode
     *
     * @return  self
     */ 
    public function setEngineCode($engineCode)
    {
        $this->engineCode = $engineCode;

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

    /**
     * Get the value of carModel
     */ 
    public function getCarModel()
    {
        return $this->carModel;
    }

    /**
     * Set the value of carModel
     *
     * @return  self
     */ 
    public function setCarModel($carModel)
    {
        $this->carModel = $carModel;

        return $this;
    }
}
