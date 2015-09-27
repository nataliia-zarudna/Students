<?php

namespace framework;

use framework\Response;

class Template {

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

    public function setParam($name, $value) {

        $this->params[$name] = $value;
    }

    public function unsetParam($name) {
        unset($this->params[$name]);
    }

    public function show() {

        /*if($this->path == "") {
            $viewFile = ROOT.$this->view;

            //header("Content-Type: text/javascript; charset=UTF-8");
            //$fileInfo = new finfo();
            //echo "<br/>FILE".$fileInfo->file($viewFile, FILEINFO_MIME_TYPE);

            //header("Content-Type: ".mime_content_type($viewFile));

            //echo "VIEW: ".$viewFile;

            return readfile($viewFile);

        } else {*/
            $viewFile = $this->path . "/" . $this->view . ".php";


        //}

        if(isset($this->params)) {
            foreach ($this->params as $key => $value) {
                $$key = $value;
            }
        }

        if($this->type == "redirect") {

            header("Location:/".$this->view);
            exit();
        }

        include($viewFile);
        //echo $viewFile;



    }

}