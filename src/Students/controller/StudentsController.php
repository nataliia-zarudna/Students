<?php

//require_once(ROOT."/src/Students/controller/Controller.php");

namespace controller;

use controller\Controller;
use framework\Request;
use framework\Response;
use model\Student;

class StudentsController Extends Controller
{
    public function index()
    {
        Student::setRegistry($this->registry);
        $students = Student::findAll();

        return new Response("students", array("students" => $students));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function add($request)
    {
        Student::setRegistry($this->registry);

        $params = $request->getParams();

        $student = new Student();
        $student->setFirstName($params["first_name"]);
        $student->setSecondName($params["second_name"]);
        $student->setAge($params["age"]);
        $student->setGender($params["gender"]);
        $student->setAddress($params["address"]);

        $student->save();

        $response = $this->index();
        $response->setType("redirect");
        return $response;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function update($request) {

        $params = $request->getParams();

        Student::setRegistry($this->registry);

        $student = Student::find($params["id"]);

        $student->setFirstName($params["first_name"]);
        $student->setSecondName($params["second_name"]);
        $student->setAge($params["age"]);
        $student->setGender($params["gender"]);
        $student->setAddress($params["address"]);

        $student->save();

        $response = $this->index();
        $response->setType("redirect");
        return $response;
    }

    public function delete($request) {

        Student::setRegistry($this->registry);

        $params = $request->getParams();

        $student = Student::find($params["id"]);
        $student->delete();

        $response = $this->index();
        $response->setType("redirect");
        return $response;
    }

}