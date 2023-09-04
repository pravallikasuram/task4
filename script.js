$(document).ready(function() {

 

    $('#loginForm').on('submit', function(event) {

        event.preventDefault();

        var username = $('#username').val();

        var password = $('#password').val();

        // Perform client-side validation

        if (username === '' || password === '') {

            $('#message').html('Username and password should not be blank.');

            return;

        }

        // **AJAX request to check credentials**

        $.ajax({

            url: 'index_process.php',

            method: 'POST',

            data: { username: username, password: password },

            success: function(response) {

                if (response === 'customer') {

                        window.location.href = 'customer.php';

                        // Redirect customer to customer page

                    } else if (response === 'admin') {

                        window.location.href = 'admin.php';

                        // Redirect admin to admin page

                    } else {

                        $('#message').html('Invalid credentials.');

                    }

            },

            error: function(xhr, status, error) {

                    console.log(error);

                    // Log the error for debugging

                    $('#message').html('An error occurred during login.'); }

        });

    });

});

 