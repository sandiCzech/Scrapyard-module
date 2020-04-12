<?php

/**
 * This file is part of the Scrapyard module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace AdminModule\ScrapyardModule;

/**
 * Description of
 *
 * @author Jakub Sanda <sanda@webcook.cz>
 */
class BasePresenter extends \AdminModule\BasePresenter
{	
    protected function startup()
    {
	   parent::startup();
    }

    protected function beforeRender()
    {
	   parent::beforeRender();
    }
	
    public function actionDefault($idPage)
    {
    }
}