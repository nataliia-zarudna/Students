/**
 * Created by sirobaban on 28.09.2015.
 */
$(document).ready(init);

function submitForm() {

}

function preventSubmit(event) {
    event.preventDefault();
}

function init() {

    console.log("validation on");



    $(".valid-form [type=submit]").on("click", validate($(this).closest(".valid-form").submit, preventSubmit(event)));
        /*function (event, data) {

            event.preventDefault();

            var form = $(this).closest(".valid-form");

            var validationData = new Object();
            var inputs = form.find(".valid-param[name], .valid-param[name]");
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
    );*/

}

function validate(onSuccess, onFail) {

        onFail();

        var form = $(this).closest(".valid-form");

        var validationData = new Object();
        var inputs = form.find(".valid-param[name], .valid-param[name]");
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
                    onSuccess();
                }
            }
        });


}