var TGCRegistration = function() {
    var bioCount, skillCount;

    function init() {
        initFormButtons();
        initFormFields();
    }
    
    function initFormButtons() {
        $("#goto-step2").click(function(e) {
            e.preventDefault();

            var $button = $(this);
            $button.attr('disabled', 'disabled');
            $button.html('Please wait...');
            
            var success = function() { switchStep() };
            var fail = function() {
                $button.removeAttr('disabled');
                $button.html('Go to step 2');
            };
            validateForm($("#registration-step1 input"), success, fail);
        });
        
        $("#fos_user_registration_form_submit").click(function(e) {
            e.preventDefault();

            var $button = $(this);
            $button.attr('disabled', 'disabled');
            $button.html('Please wait...');

            var success = function() { $("#registration-form").submit() };
            var fail = function() {
                $button.removeAttr('disabled');
                $button.html('Submit');
            };
            validateForm($("#registration-form"), success, fail);
        });
    }
    
    function initFormFields() {
        bioCount = $("#bio-fields-list").attr('data-count');
        skillCount = $("#skills-fields-list").attr('data-count');
    
        $('#add-another-bio').click(function() {
            var bioList = $('#bio-fields-list');

            var newWidget = bioList.attr('data-prototype');
            newWidget = newWidget.replace(/__name__/g, bioCount);
            bioCount++;

            var newLi = $('<li></li>').html(newWidget + '<a class="remove-field">[x]</a>');
            newLi.appendTo(bioList);

            return false;
        }).click();

        $('#add-another-skill').click(function() {
            var skillList = $('#skills-fields-list');

            var newWidget = skillList.attr('data-prototype');
            newWidget = newWidget.replace(/__name__/g, skillCount);
            skillCount++;

            var newLi = $('<li></li>').html(newWidget + '<a class="remove-field">[x]</a>');
            newLi.appendTo(skillList);

            return false;
        }).click();
        
        $(document).on('click', ".remove-field", function() {
            $(this).closest('li').remove();
            return false;
        });
    }
    
    function validateForm(fields, successCallback, failCallback) {
        $("ul.error").remove();
        var formData = fields.serializeArray();
        // workaround for file field
        fields.find("input[type=file]").each(function() {
            var $this = $(this);
            console.log($this);
            formData.push({'name': $this.attr('name'), 'value': $this.val()});
        });
        $.post($("#registration-form").attr("data-validate-url"), formData, function(data) {
            if (data.errors) {
                console.log(data.errors);
                $.each(data.errors, function(key, val) {
                    var message = '<ul class="error"><li>' + val + '</li></ul>';
                    var $field = $("#fos_user_registration_form_" + key);
                    if (!$field.size()) {
                        $field = $("#fos_user_registration_form_" + key + "_first");
                    }
                    if ($field.size()) {
                        $field.before(message);
                    } else {
                        $(".form_errors").append(message);
                    }
                });

                $('html,body').animate({
                    scrollTop: $("ul.error").first().offset().top},
                    'slow');
                    
                failCallback();
            } else {
                successCallback();
            }
        });
    }
    function switchStep() {
        $("#registration-step1").slideUp().find("input").removeAttr("required");
        $("#registration-step2").slideDown();

        if ($("#fos_user_registration_form_roles").val() == "ROLE_CONSULTANT") {
            $(".business-field").hide().find("input, textarea").removeAttr("required");
        } else {
            $(".consultant-field").hide().find("input, textarea").removeAttr("required");
        }
    }
    return {
        init: init,
        switchStep: switchStep
    }
}();

$(document).ready(TGCRegistration.init);