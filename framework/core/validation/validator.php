<?php

namespace framework\core\validation;

use framework\core\ConfigManager;

class Validator
{
    public static $VALIDATION_RESULT_PATH = "/framework/core/view";
    public static $VALIDATION_RESULT_VIEW = "validationResult";

    /**
     * @param object $object
     * @return array
     */
    public function validate($object)
    {
        $validationRules = $this->getValidationRules(get_class($object));

        $validationResult = array();
        for ($i = 0; $i < count($validationRules); $i++) {

            $rule = $validationRules[$i]->getRule();
            $params = $validationRules[$i]->getParams();
            $field = $validationRules[$i]->getField();
            $value = $this->getObjectValue($object, $field);

            if (!$this->$rule($value, $params)) {

                $validationResult[$field] = $validationRules[$i]->getMessage();
            }
        }

        return $validationResult;
    }

    /**
     * @param string $className
     * @return ValidationRule[]
     */
    private function getValidationRules($className)
    {

        $rulesFile = ROOT . "/app/validation_rules/" . ConfigManager::getConfig($className . "_validation");

        $rulesJson = json_decode(file_get_contents($rulesFile));

        $rules = array();
        for ($i = 0; $i < count($rulesJson); $i++) {

            $rule = new ValidationRule($rulesJson[$i]);
            array_push($rules, $rule);
        }

        return $rules;
    }

    /**
     * @param object $object
     * @param string $field
     * @return string
     */
    private function getObjectValue($object, $field)
    {
        $reflection = new \ReflectionObject($object);
        $property = $reflection->getProperty($field);
        $property->setAccessible(true);

        return $property->getValue($object);
    }

    /**
     * @param string $value
     * @return bool
     */
    private function notEmpty($value)
    {

        if (isset($value) && $value !== "") {

            // echo "\n notEmpty true";
            return true;
        } else {
            // echo "\n notEmpty false";
            return false;
        }
    }

    /**
     * @param string $value
     * @param array $params
     * @return bool
     */
    private function valueBetween($value, $params)
    {
        if ($value !== ""
            && ((isset($params->min)
                    && $value < $params->min)
                || (isset($params->max)
                    && $value > $params->max))
        ) {

            return false;
        }

        return true;
    }

    /**
     * @param string $value
     * @param array $params
     * @return bool
     */
    private function onlyDigits($value, $params)
    {

        if (preg_match('/^[0-9]*$/', $value) == 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param string $value
     * @param array $params
     * @return bool
     */
    private function regexp($value, $params)
    {
        if (isset($params->regexp)
            && preg_match("#" . $params->regexp . "#", $value) == 0
        ) {

            return false;
        } else {
            return true;
        }
    }
}