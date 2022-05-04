$(document).ready(function() {

    // Sign in button clicked
    $("#signIn").click(function() {
        $("#loginModal").show();

        window.onclick = function(event) {
            if (event.target == loginModal) {
                $("#loginModal").hide();
            }
        }
    });

});