<?php

/**
 * This file is part of the Scrapyard module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace WebCMS\ScrapyardModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Scrapyard_PhotoTire")
 */
class PhotoTire extends \WebCMS\Entity\Entity
{
		/**
		 * @ORM\Column(type="string", length=255)
		 */
		private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @ORM\ManyToOne(targetEntity="Tire", inversedBy="photos") 
     * @ORM\JoinColumn(name="tire_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $tire;

    /**
     * @ORM\Column(type="boolean")
     */
    private $main;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;


    /**
     * Gets the value of name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the value of name.
     *
     * @param mixed $name the name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the value of path.
     *
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets the value of path.
     *
     * @param mixed $path the path
     *
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Gets the value of main.
     *
     * @return mixed
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * Sets the value of main.
     *
     * @param mixed $main the main
     *
     * @return self
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Gets the value of created.
     *
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Sets the value of created.
     *
     * @param mixed $created the created
     *
     * @return self
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get the value of tire
     */ 
    public function getTire()
    {
        return $this->tire;
    }

    /**
     * Set the value of tire
     *
     * @return  self
     */ 
    public function setTire($tire)
    {
        $this->tire = $tire;

        return $this;
    }
}