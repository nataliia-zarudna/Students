<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../../web/js/edit_students.js"></script>

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
            for ($i = 0; $i < count($students); $i++) {

                echo "<tr class='student_info' student_id=" . $students[$i]->getId() . ">";
                echo "<td contenteditable='true' name='first_name'>" . $students[$i]->getFirstName() . "</td>";
                echo "<td contenteditable='true' name='second_name'>" . $students[$i]->getSecondName() . "</td>";
                echo "<td contenteditable='true' name='age'>" . $students[$i]->getAge() . "</td>";
                echo "<td contenteditable='true' name='gender'>" . $students[$i]->getGender() . "</td>";

                //echo "<td><select name='gender'" . $students[$i]->getGender() . "></select></td>";

                echo "<td contenteditable='true' name='address'>" . $students[$i]->getAddress() . "</td>";
                echo "<td><a href='/students/delete?id=" . $students[$i]->getId() . "'>[x]</a></td>";
                echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>
</div>

<br/>

<form class="form-inline" action="/Students/add" method="post">
    <input type="text" class="form-control" name="first_name" placeholder="first name" value="Ivan"/>
    <input type="text" class="form-control" name="second_name" placeholder="second name" value="Ivanov"/>
    <input type="text" class="form-control" name="age" placeholder="age" value="23"/>
    <!--input type="text" class="form-control" name="gender" placeholder="gender" value="m"/-->

    <select class="form-control" name="gender">
        <option>male</option>
        <option>female</option>
    </select>

    <input type="text" class="form-control" name="address" placeholder="address" value="Sumy"/>
    <input class="btn btn-default" type="submit" value="Add">
</form>
