<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Admin front site</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<script>
    $(document).ready(function () {
        $('#login_button').click(function (){
            $.post("process.php", {
                    username: document.getElementById("username").value,
                    password: document.getElementById("password").value,
                    log_in: "1"
                },
                function (data){
                    alert(data);
                }, 'json');
        });
    });
</script>
<div class="login">
    <h1>Login</h1>
    <form method="post" action="process.php">
        <input type="text" name="username" id="username" placeholder="Username" required="required" />
        <input type="password" name="password" id="password" placeholder="Password" required="required"/>
        <button type="submit" name="login-button" id="login_button" class="btn btn-primary btn-block btn-large">Let me in.</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
