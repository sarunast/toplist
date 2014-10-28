$(document).ready(function(){
    $('input#btnWizardPrev').on('click', function() {
        $('#MyWizard').wizard('previous');
    });
    $('input#btnWizardNext').on('click', function() {
        var form = $("#CreateServer").validate()
        if(form.form()){
            $('#MyWizard').wizard('next');
        }
    });
    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Please enter valid IP address."
    );
    $("#CreateServer").validate({
        rules:{
            ip: {
                regex:  "^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$"
            },
            image: {
                accept: "image/*"
            }
        }
    });
});