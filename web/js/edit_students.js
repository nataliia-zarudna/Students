/**
 * Created by Nataliia on 27.09.2015.
 */
$(document).ready(init);

function init() {

    $(".student_info td[name]").on("blur", editStudent);

    $(".student_info td[name] select").on("change", editStudent);

}

function editStudent() {

    console.log("dfsdf");

    var editData = new Object();

    var studentRow = $(this).closest("tr");

    console.log(studentRow);

    var studentParams = studentRow.children("td[name]");
    for(var i = 0; i < studentParams.length; i++) {

        var currentRow = $(studentParams[i]);
        var value = "";
        if(currentRow.children("select").length == 0) {
            value = currentRow.text();
        } else {
            value = $(currentRow.children("select")[0]).val();
        }

        editData[currentRow.attr("name")] = value;
    }
    var studentID = studentRow.attr("student_id");
    editData["id"] = studentID;

    $.ajax({
        url: "Students/update",
        data: editData,
        method: "post",
        success: function(data) {
            console.log("Student with id = " + studentID + " has been updated");
        }
    });

}