/**
 * Created by Nataliia on 27.09.2015.
 */
$(document).ready(init);

function init() {

    $(".student_info .valid-param").on("blur",
        function(event, data) {

            validate(
                function (event, field) {
                    editStudent(field);
                },
                function (event) {
                    event.preventDefault();
                },
                event
                , $(this))
        });
}

function editStudent(editField) {

    var editData = new Object();

    var studentRow = editField.closest("tr");
    var studentParams = studentRow.find(".valid-param");
    for(var i = 0; i < studentParams.length; i++) {

        var currentParam = $(studentParams[i]);

        var value = "";
        if(currentParam.prop("tagName") === "SELECT") {
            value = currentParam.val();
        } else {
            value = currentParam.text();
        }

        editData[currentParam.attr("name")] = value.trim();
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