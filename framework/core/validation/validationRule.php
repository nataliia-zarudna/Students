<?php

namespace framework\core\validation;

class ValidationRule {

    private $field;
    private $rule;
    private $params;
    private $message;

    /**
     * @param array $data
     */
    public function __construct($data) {

        $this->field = $data->field;
        $this->rule = $data->rule;
        $this->params = $data->params;
        $this->message = $data->message;

    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param string $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     * @param string $rule
     */
    public function setRule($rule)
    {
        $this->rule = $rule;
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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}