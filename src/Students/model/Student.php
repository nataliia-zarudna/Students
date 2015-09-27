<?php

namespace model;

use framework\Logger;
use PDO;

class Student
{
    private $id;
    private $first_name;
    private $second_name;
    private $age;
    private $gender;
    private $address;

    private static $registry;

    /**
     * @return int
     */
    function getID()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getSecondName()
    {
        return $this->second_name;
    }

    /**
     * @param string $second_name
     */
    public function setSecondName($second_name)
    {
        $this->second_name = $second_name;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $group
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return PDO
     */
    public static function getRegistry()
    {
        return self::$registry;
    }

    /**
     * @param PDO $db
     */
    public static function setRegistry($registry)
    {
        self::$registry = $registry;
    }

    private static function getDB() {
        return self::$registry["db"];
    }

    /**
     * @return Logger
     */
    private static function getLogger() {
        return self::$registry["logger"];
    }

    public function save()
    {
        if(isset($this->id)) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    private function create()
    {
        try {

            $preparedStatement = self::getDB()->prepare("insert into students"
                . " (first_name, second_name, age, gender, address)"
                . " values(:first_name, :second_name, :age, :gender, :address)");

            $preparedStatement->execute($this->toArray($this));

            $createdID = self::getDB()->lastInsertId();
            return self::find($createdID);

        } catch (PDOException $e) {
            echo "Exception trying to create student with id " . $this . id;
            self::getLogger()->error($e->getMessage(), $e);
        }

    }

    private function update()
    {
        try {

            $preparedStatement = self::getDB()->prepare("update students "
                . "set first_name = :first_name "
                . ", second_name = :second_name "
                . ", age = :age "
                . ", gender = :gender "
                . ", address = :address "
                . "where id = :id");

            $preparedStatement->execute($this->toArray($this));

            return $this;

        } catch (PDOException $e) {
            echo "Exception trying to save student with id " . $this . id;
            self::getLogger()->error($e->getMessage(), $e);
        }
    }

    public function delete()
    {
        try {

            echo "DELETE ".$this->id;

            $preparedStatement = self::getDB()->prepare("delete from students where id = :id");
            $preparedStatement->bindParam(":id", $this->id, PDO::PARAM_INT);
            $preparedStatement->execute();

        } catch (PDOException $e) {
            echo "Exception trying to delete student with id " . $this . id;
            self::getLogger()->error($e->getMessage(), $e);
        }
    }

    /**
     * @param int $id
     * @return Student
     */
    public static function find($id)
    {
        try {

            $preparedStatement = self::getDB()->query("select "
                . " first_name"
                . ", second_name"
                . ", age"
                . ", gender"
                . ", address"
                . ", id"
                . " from students "
                . " where id = :id");

            $preparedStatement->bindParam(":id", $id);
            $preparedStatement->execute();

            $student = $preparedStatement->fetchAll(PDO::FETCH_CLASS, "model\Student");

            if (count($student) > 0) {
                return $student[0];
            } else {
                return null;
            }

        } catch (PDOException $e) {
            echo "Exception trying to find student with id " . $id;
            self::getLogger()->error($e->getMessage(), $e);
        }
    }

    public static function findAll()
    {
        try {

            self::getLogger()->debug("dsfdfs");

            $preparedStatement = self::getDB()->query("select  "
                . " first_name "
                . ", second_name"
                . ", age"
                . ", gender"
                . ", address, id "
                . " from students ");

            return $preparedStatement->fetchAll(PDO::FETCH_CLASS
                , "model\Student");

        } catch (PDOException $e) {
            echo "Exception trying to find students";
            self::getLogger()->error($e->getMessage(), $e);
        }
    }


    private function toArray()
    {
        $array = array(
            "first_name" => $this->first_name,
            "second_name" => $this->second_name,
            "age" => $this->age,
            "gender" => $this->gender,
            "address" => $this->address
        );

        if(isset($this->id)) {
            $array["id"] = $this->id;
        }

        return $array;
    }
}