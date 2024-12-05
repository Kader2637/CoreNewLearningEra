<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <form id="loginForm">
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <div id="responseMessage"></div>

    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(event) {
                event.preventDefault();

                const formData = {
                    email: $('input[name="email"]').val(),
                    password: $('input[name="password"]').val()
                };

                $.ajax({
                    url: '/api/ApiLogin',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                    success: function(response) {
                        $('#responseMessage').html('<p>' + response.message + '</p>');
                        localStorage.setItem('token', response.data.token);
                        localStorage.setItem('user', JSON.stringify(response.data));

                        const user = response.data;
                        if (user.role === 'admin') {
                            window.location.href = '/admin';
                        } else if (user.role === 'student') {
                            window.location.href = '/student';
                        } else if (user.role === 'teacher') {
                            window.location.href = '/teacher';
                        } else {
                            window.location.href = '/home';
                        }
                    },
                    error: function(xhr) {
                        const errorResponse = JSON.parse(xhr.responseText);
                        $('#responseMessage').html('<p>' + errorResponse.message + '</p>');
                    }
                });
            });
        });
    </script>
</body>

</html>
