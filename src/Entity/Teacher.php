<?php

/**
 * This file is part of the University module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace WebCMS\UniversityModule\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as gedmo;

/**
 * @ORM\Entity()
 * @ORM\Table(name="university_Teacher")
 */
class Teacher extends \WebCMS\Entity\Entity
{

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $degreeBefore;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $degreeAfter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @var datetime $created
     * 
     * @gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $department;

    /**
     * @ORM\ManyToMany(targetEntity="Field") 
     * @ORM\JoinTable(name="university_teacherfields", joinColumns={@ORM\JoinColumn(name="teacher_id", referencedColumnName="id", onDelete="CASCADE")}, inverseJoinColumns={@ORM\JoinColumn(name="field_id",referencedColumnName="id", onDelete="CASCADE", unique=false)})
     */
    private $fields;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $perex;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="Photo")
     * @ORM\JoinColumn(name="photo_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $photo;

    /**
     * @gedmo\Slug(fields={"name", "id"})
     * @ORM\Column(length=64)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="WebCMS\Entity\Page")
     * @orm\JoinColumn(name="page_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $page;

    public function getDegreeBefore()
    {
        return $this->degreeBefore;
    }
    
    public function setDegreeBefore($degreeBefore)
    {
        $this->degreeBefore = $degreeBefore;
        return $this;
    }

    public function getDegreeAfter()
    {
        return $this->degreeAfter;
    }
    
    public function setDegreeAfter($degreeAfter)
    {
        $this->degreeAfter = $degreeAfter;
        return $this;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }
    
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }
    
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
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

    public function getActive()
    {
        return $this->active;
    }
    
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    public function getCreated()
    {
        return $this->created;
    }
    
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    public function getDepartment()
    {
        return $this->department;
    }
    
    public function setDepartment($department)
    {
        $this->department = $department;
        return $this;
    }

    public function getFields() {
        return $this->fields;
    }

    public function setFields($fields) {
        $this->fields = $fields;
        return $this;
    }

    public function getPerex() {
        return $this->perex;
    }

    public function setPerex($perex) {
        $this->perex = $perex;
        return $this;
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
        return $this;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
        return $this;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function setSlug($slug) {
        $this->slug = $slug;
        return $this;
    }

    public function getPage() {
        return $this->page;
    }

    public function setPage($page) {
        $this->page = $page;
        return $this;
    }

}
