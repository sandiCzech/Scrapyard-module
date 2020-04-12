<?php

/**
 * This file is part of the Scrapyard module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace WebCMS\ScrapyardModule;

/**
 *
 * @author Jakub Sanda <sanda@webcook.cz>
 */
class Scrapyard extends \WebCMS\Module
{
	/**
	 * [$name description]
	 * @var string
	 */
    protected $name = 'Scrapyard';
    
    /**
     * [$author description]
     * @var string
     */
    protected $author = 'Jakub Sanda';
    
    /**
     * [$presenters description]
     * @var array
     */
    protected $presenters = array(
		array(
		    'name' => 'CarBrand',
		    'frontend' => false,
		    'parameters' => true
		),
        array(
            'name' => 'CarModel',
            'frontend' => false,
            'parameters' => true
        ),
        array(
            'name' => 'Tire',
            'frontend' => true,
            'parameters' => true
        ),
        array(
            'name' => 'Car',
            'frontend' => true,
            'parameters' => true
        ),
		array(
		    'name' => 'Settings',
		    'frontend' => false
		)
    );

    public function __construct() 
    {
	
    }
}
