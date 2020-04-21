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
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tireCondition;

    /**
     * @ORM\ManyToOne(targetEntity="CarBrand")
     * @ORM\JoinColumn(name="carBrand_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $carBrand;

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
    
    /**
     * @ORM\OneToMany(targetEntity="PhotoTire", mappedBy="tire") 
     * @var Array
     */
    private $photos;

    /**
     * @gedmo\Slug(fields={"tireName", "id"})
     * @ORM\Column(length=64)
     */
    private $slug;

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
     * Get the value of tireCondition
     */ 
    public function getTireCondition()
    {
        return $this->tireCondition;
    }

    /**
     * Set the value of tireCondition
     *
     * @return  self
     */ 
    public function setTireCondition($tireCondition)
    {
        $this->tireCondition = $tireCondition;

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
     * Get the value of slug
     */ 
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @return  self
     */ 
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }
}
