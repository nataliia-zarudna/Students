/**
 * Created by sirobaban on 28.09.2015.
 */
$(document).ready(init);

function init() {

    console.log("validation on");

    $(".valid-form [type=submit]").on("click",
        function (event, data) {

            validate(
                function (event, field) {
                    field.closest(".valid-form").submit();
                },
                function (event) {
                    event.preventDefault();
                },
                event
                , $(this))
        });
}

function validate(onSuccess, onFail, event, field) {

    onFail(event);

    var form = field.closest(".valid-form");

    var validationData = getValidationData(form);

    $.ajax({
        url: "/students/validate",
        data: validationData,
        method: "post",
        success: function (data) {

            var result = $.parseJSON(data);
            if (result.toString() !== "") {

                fillErrorMessages(form, result);

            } else {
                form.find(".error-message").text("");
                onSuccess(event, field);
            }
        }
    });
}

function getValidationData(form) {

    var validationData = new Object();
    var inputs = form.find(".valid-param[name], .valid-param[name]");
    for (var i = 0; i < inputs.length; i++) {

        var input = $(inputs[i]);

        var value = "";
        if (input.prop("tagName") == "INPUT"
            || input.prop("tagName") == "SELECT") {

            value = input.val();
        } else {
            value = input.text().trim();
        }
        validationData[input.attr("name")] = value;
    }

    return validationData;
}

function fillErrorMessages(form, validationResult) {

    var errorLabels = form.find(".error-message");
    for (var i = 0; i < errorLabels.length; i++) {

        var errorLabel = $(errorLabels[i]);
        var errorMessage = validationResult[errorLabel.attr("for")];
        if (errorMessage === undefined) {
            errorMessage = "";
        }

        console.log("for " + errorLabel.attr("for") + ", mess " + errorMessage);
        errorLabel.text(errorMessage);
    }
}