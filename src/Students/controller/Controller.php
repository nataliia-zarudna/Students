<?php

namespace controller;

use framework\core\Registry;

abstract class Controller {

    protected $registry;

    /**
     * @param Registry $registry
     */
    public function __construct($registry)
    {
        $this->registry = $registry;
    }

}