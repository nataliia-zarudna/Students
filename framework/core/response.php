<?php

namespace framework\core;

class Response
{
    private $params;
    private $path;
    private $code;
    private $headers;

    /**
     * @param string $view
     * @param array $params
     */
    function __construct()
    {
        $this->params = array();
        $this->code = 200;
        $this->headers = array();
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param string $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    public function sendRedirect($url) {

        http_response_code(HttpCodes::$FOUND);
        header("Location: /" . $url . $this->getParamsAsQuery());
        exit();
    }

    private function getParamsAsQuery() {

        $paramsQuery = "";
        foreach($this->params as $key => $value) {
            $paramsQuery .= $key."=".$value;
        }
        if($paramsQuery != "") {
            $paramsQuery = "?".$paramsQuery;
        }
        return $paramsQuery;
    }

}