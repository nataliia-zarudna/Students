<?php

namespace framework;

use framework\Response;

class Template
{

    private $params;
    private $path;
    private $view;
    private $type;

    /**
     * @param Response $response
     */
    function __construct($response)
    {
        $this->params = $response->getParams();
        $this->path = $response->getPath();
        $this->view = $response->getView();
        $this->type = $response->getType();
    }

    public function setParam($name, $value)
    {

        $this->params[$name] = $value;
    }

    public function unsetParam($name)
    {
        unset($this->params[$name]);
    }

    public function show()
    {
        $viewFile = $this->path . "/" . $this->view . ".php";

        if (isset($this->params)) {
            foreach ($this->params as $key => $value) {
                $$key = $value;
            }
        }

        if ($this->type == "redirect") {

            header("Location:/" . $this->view);
            exit();

        } else {
            include($viewFile);
        }
    }
}