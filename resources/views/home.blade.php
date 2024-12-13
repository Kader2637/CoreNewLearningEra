<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test Auth</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Authenticated User</h1>
    <div id="userInfo"></div>

    <script>
        $(document).ready(function() {
            const user = JSON.parse(localStorage.getItem('user')); 

            if (user) {
                $('#userInfo').html('<p>Welcome, ' + user.name + '!</p>');
            } else {
                $('#userInfo').html('<p>No user is logged in.</p>');
            }
        });
    </script>
</body>
</html>
