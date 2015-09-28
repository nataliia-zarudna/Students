<?php

namespace framework\core;

class Request {

    private $url;
    private $params;
    private $headers;

    /**
     * @param string $url
     */
    public function __construct($url) {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
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
    public function getHeaders()
    {
        return $this->headers;
    }

}