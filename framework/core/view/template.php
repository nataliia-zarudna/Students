<?php

namespace framework\core\view;

use framework\core\Response;
use framework\core\HttpCodes;

class Template
{
    private $view;
    private $response;

    /**
     * @param string $view
     * @param Response $response
     */
    function __construct($view, $response)
    {
        $this->view = $view;
        $this->response = $response;
    }

    public function show()
    {
        http_response_code($this->response->getCode());
        $headers = $this->response->getHeaders();
        foreach($headers as $key => $value) {
            header($key, $value);
        }

        $viewFile = $this->response->getPath() . "/" . $this->view . ".php";
        foreach ($this->response->getParams() as $key => $value) {
            $$key = $value;
        }

        include($viewFile);

    }
}