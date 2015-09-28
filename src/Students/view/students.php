<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../../web/js/edit_students.js"></script>
<script type="text/javascript" src="../../../web/js/validation.js"></script>

<div class="page-header">
    <h1>Students</h1>
</div>

<div class="table-hover">
    <table class="table">

        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Address</th>
        </tr>
        </thead>

        <tbody>
        <?php

        if (isset($students)) {
            for ($i = 0;
                 $i < count($students);
                 $i++) {

                ?>

                <tr class='student_info' student_id=' <?php $students[$i]->getId() ?> '>
                    <td contenteditable='true' name='first_name'><?php $students[$i]->getFirstName() ?></td>
                    <td contenteditable='true' name='second_name'> <?php $students[$i]->getSecondName() ?></td>
                    <td contenteditable='true' name='age'> <?php $students[$i]->getAge() ?></td>

                    <td contenteditable='true' name='gender'>
                        <select>
                            <option <?php
                            if ($students[$i]->getGender() == "male") {
                                echo "selected";
                            } ?>
                                >male
                            </option>
                            <option <?php
                            if ($students[$i]->getGender() == "female") {
                                echo "selected";
                            } ?>
                                >female
                            </option>
                        </select>
                    </td>

                    <td contenteditable='true' name='address'> <?php $students[$i]->getAddress() ?></td>
                    <td><a href='/students/delete?id=' <?php $students[$i]->getId() ?> '>[x]</a></td>
                </tr>
            <?php }
        }
        ?>
        </tbody>
    </table>
</div>

<br/>

<form role="form" class=" valid-form" action="/Students/add" method="post">

    <div class="row">
        <div class="col-xs-2">
            <label class="error-message" for="first_name"></label>
            <input type="text" class="form-control" name="first_name" placeholder="first name" value=""/>
            <br/>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-2">
            <label class="error-message" for="second_name"></label>
            <input type="text" class="form-control" name="second_name" placeholder="second name" value="Ivanov"/>
            <br/>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-2">
            <label class="error-message" for="age"></label>
            <input type="text" class="form-control" name="age" placeholder="age" value="23"/>
            <br/>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-xs-2">
            <label class="error-message" for="gender"></label>
            <select class="form-control" name="gender">
                <option>male</option>
                <option>female</option>
            </select>
            <br/>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-xs-2">
            <label class="error-message" for="address"></label>
            <input type="text" class="form-control" name="address" placeholder="address" value="Sumy"/>
            <br/>
        </div>
    </div>

    <input class="btn btn-default" type="submit" value="Add">
</form>
