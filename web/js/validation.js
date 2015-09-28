/**
 * Created by sirobaban on 28.09.2015.
 */
$(document).ready(init);

function init() {

    console.log("validation on");

    $(".valid-form [type=submit]").on("click",
        function (event, data) {

            event.preventDefault();

            var form = $(this).closest(".valid-form");

            var validationData = new Object();
            var inputs = form.find("input[name], select[name]");
            for (var i = 0; i < inputs.length; i++) {

                var input = $(inputs[i]);
                validationData[input.attr("name")] = input.val();
            }

            $.ajax({
                url: "/students/validate",
                data: validationData,
                method: "post",
                success: function (data) {

                    var result = $.parseJSON(data);
                    if (result.toString() !== "") {

                        var errorLabels = form.find(".error-message");
                        for (var i = 0; i < errorLabels.length; i++) {

                            var errorLabel = $(errorLabels[i]);
                            var errorMessage = result[errorLabel.attr("for")];
                            if (errorMessage === undefined) {
                                errorMessage = "";
                            }

                            errorLabel.text(errorMessage);
                        }
                    } else {
                        form.submit();
                    }
                }
            });
        }
    );

}