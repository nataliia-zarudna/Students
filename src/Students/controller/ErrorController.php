<?php

namespace controller;

use framework\core\Request;
use framework\core\Response;

class ErrorController Extends Controller {

    /**
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function index($request, $response) {

        $exception = $request->getParams()["exception"];
        $response->setParams(array("errorMessage" => $exception));
        return "error";
    }

}