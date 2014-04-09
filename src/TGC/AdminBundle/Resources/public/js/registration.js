$(function() {
    $("#goto-step2").click(function(e) {
        e.preventDefault();
        
        $("ul.error").remove();
        
        var button = $(this);
        button.attr('disabled', 'disabled');
        button.html('Please wait...');
        
        var formData = $("#registration-step1 input").serialize();
        $.getJSON($(this).attr("data-validate-url"), formData, function(data) {
            if (data.errors) {
                // displaying form errors
                button.removeAttr('disabled');
                button.html('Go to step 2');
                
                $.each(data.errors, function(key, val) {
                    var message = '<ul class="error"><li>' + val + '</li></ul>';
                    var field = $("#fos_user_registration_form_" + key);
                    if (!field.size()) {
                        field = $("#fos_user_registration_form_" + key + "_first");
                    }
                    field.before(message);
                });
            } else {
                // proceeding to step 2
                $("#registration-step1").slideUp().find("input").removeAttr("required");
                $("#registration-step2").slideDown();

                if ($("#fos_user_registration_form_roles").val() == "ROLE_CONSULTANT") {
                    $(".business-field").hide().find("input, textarea").removeAttr("required");
                } else {
                    $(".consultant-field").hide().find("input, textarea").removeAttr("required");
                }
            }
        });

    });

});