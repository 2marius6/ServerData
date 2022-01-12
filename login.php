<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ServerInfo - Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login_style.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/login.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
</head>
<body class="text">
<main class="form-signin">
    <form action="" method="" name="loginForm" id="loginForm">
        <h1 class="h3 mb-3 fw-normal text-center">You need to sign in</h1>
        <div class="form-floating">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            <label for="email">Email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
            <label for="pass">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-dark-blue" type="submit" id="submitLogin" onclick="login()">Sign in</button>
        <br>
        <br>
        <h1 class="form-text text-muted text-center">If you don't have an account, contact the administrator at: <a href="mailto:marius.nichiteanu01@e-uvt.ro">marius.nichiteanu01@e-uvt.ro</a></h1>
        <div id="msj"></div>
    </form>
</main>
</body>
</html>