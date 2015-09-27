/**
 * Created by Nataliia on 27.09.2015.
 */
$(document).ready(init);

function init() {

    $(".student_info").children("td[contenteditable=true]").on("blur",
        function(event, data) {

            var editData = new Object();

            var studentRow = $(this).parent("tr");
            var studentParams = studentRow.children("td[name]");
            for(var i = 0; i < studentParams.length; i++) {

                var currentRow = $(studentParams[i]);
                editData[currentRow.attr("name")] = currentRow.text();
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
    );

}