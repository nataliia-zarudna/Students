<?php

namespace framework\validation;

use framework\ConfigManager;

class Validator
{

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

    private function getObjectValue($object, $field)
    {
        $reflection = new \ReflectionObject($object);
        $property = $reflection->getProperty($field);
        $property->setAccessible(true);

        return $property->getValue($object);
    }

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

    private function valueBetween($value, $params)
    {

        if (isset($params->min)
            && $value < $params->min
        ) {

            return false;
        }

        if (isset($params->max)
            && $value > $params->max
        ) {

            return false;
        }

        return true;
    }

    private function onlyDigits($value, $params) {

        if(preg_match('/^[0-9]*$/', $value) == 0) {
            return false;
        } else {
            return true;
        }
    }

    private function regexp($value, $params)
    {
        if (isset($params->regexp)
            && preg_match("#".$params->regexp."#", $value) == 0
        ) {

            return false;
        } else {
            return true;
        }
    }
}