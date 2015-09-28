<?php

namespace controller;

use framework\core\Request;
use framework\core\Response;
use framework\core\validation\Validator;
use model\ModelException;
use model\Student;

class StudentsController Extends Controller
{
    /**
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function index($request, $response)
    {
        try {

            Student::setRegistry($this->registry);
            $students = Student::findAll();

            $response->setParams(array("students" => $students));
            return "students";

        } catch (ModelException $e) {
            $response->setParams(array("exception" => $e->getMessage()));
            $response->sendRedirect("error");
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function validate($request, $response)
    {
        Student::setRegistry($this->registry);

        $params = $request->getParams();

        $student = new Student();
        $student->setFirstName($params["first_name"]);
        $student->setSecondName($params["second_name"]);
        $student->setAge($params["age"]);
        $student->setGender($params["gender"]);
        $student->setAddress($params["address"]);

        $validator = new Validator();
        $validationResult = $validator->validate($student);

        $response->setParams(array("validationResult" => $validationResult));
        $response->setPath(ROOT . Validator::$VALIDATION_RESULT_PATH);
        return Validator::$VALIDATION_RESULT_VIEW;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function add($request, $response)
    {
        Student::setRegistry($this->registry);

        $params = $request->getParams();

        try {
            $student = new Student();
            $student->setFirstName($params["first_name"]);
            $student->setSecondName($params["second_name"]);
            $student->setAge($params["age"]);
            $student->setGender($params["gender"]);
            $student->setAddress($params["address"]);

            $student->save();

        } catch (ModelException $e) {
            $response->setParams(array("exception" => $e->getMessage()));
            $response->sendRedirect("error");
        }

        $response->sendRedirect("students");
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function update($request, $response)
    {

        $params = $request->getParams();

        Student::setRegistry($this->registry);

        try {

            $student = Student::find($params["id"]);

            $student->setFirstName($params["first_name"]);
            $student->setSecondName($params["second_name"]);
            $student->setAge($params["age"]);
            $student->setGender($params["gender"]);
            $student->setAddress($params["address"]);

            $student->save();

        } catch (ModelException $e) {
            $response->setParams(array("exception" => $e->getMessage()));
            $response->sendRedirect("error");
        }

        $response->sendRedirect("students");
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function delete($request, $response)
    {
        try {

            Student::setRegistry($this->registry);

            $params = $request->getParams();

            $student = Student::find($params["id"]);
            $student->delete();

        } catch (ModelException $e) {
            $response->setParams(array("exception" => $e->getMessage()));
            $response->sendRedirect("error");
        }

        $response->sendRedirect("students");
    }

}