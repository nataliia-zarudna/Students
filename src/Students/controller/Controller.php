<?php

namespace controller;

abstract class Controller {

    protected $registry;

    public function __construct($registry)
    {
        $this->registry = $registry;
    }

}