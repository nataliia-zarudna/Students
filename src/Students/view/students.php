<h4>Students</h4>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../../../web/js/edit_students.js" ></script>
<table width="500">

    <thead>
    <tr>First Name</tr>
    <tr>Last Name</tr>
    <tr>Age</tr>
    <tr>Gender</tr>
    <tr>Address</tr>
    </thead>

    <tbody>
    <?php

    if (isset($students)) {
        for ($i = 0; $i < count($students); $i++) {

            echo "<tr class='student_info' student_id=".$students[$i]->getId().">";
            echo "<td contenteditable='true' name='first_name'>".$students[$i]->getFirstName()."</td>";
            echo "<td contenteditable='true' name='second_name'>".$students[$i]->getSecondName()."</td>";
            echo "<td contenteditable='true' name='age'>".$students[$i]->getAge()."</td>";
            echo "<td contenteditable='true' name='gender'>".$students[$i]->getGender()."</td>";
            echo "<td contenteditable='true' name='address'>".$students[$i]->getAddress()."</td>";
            echo "<td><a href='/students/delete?id=".$students[$i]->getId()."'>[x]</a></td>";
            echo "</tr>";
        }
    }
    ?>
    </tbody>
</table>

<br/>

<form action="/Students/add" method="post">
    <input name="first_name" placeholder="first name" value="Ivan" />
    <input name="second_name" placeholder="second name" value="Ivanov" />
    <input name="age" placeholder="age" value="23" />
    <input name="gender" placeholder="gender" value="m" />
    <input name="address" placeholder="address" value="Sumy" />
    <input type="submit" value="GO">
</form>
