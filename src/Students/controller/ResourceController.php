<?php

namespace controller;

use framework\Request;
use framework\Response;

class ResourceController {

    /**
     * @param Request $request
     */
    public function load($request) {

        $response = new Response($request->getUrl());
        //$response.set
        $response->setPath("a");
        return $response;

    }
}