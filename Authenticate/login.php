<?php



// Link php files
require_once './../vendor/autoload.php';

use App\Helpers\CustomError;
use App\Modules\Users;
use App\Helpers\Request;

// Create new objects
$errors = new CustomError();
$users = new Users();
$Request = new Request();

// Check request method
if($Request -> isPost()) {

// Form values variables
    $email = $Request -> input('email');
    $password = $Request -> input('password');

// Check Errors of fields
    if (trim($email) == '') {
        $errors->set_error('email', 'Fill the email field');
    }
    if (trim($password) == '') {
        $errors->set_error('password', 'Fill the password field');
    } elseif (strlen($password) < 6) {
        $errors->set_error('password', 'Password should not be less than 6 letters');
    }


// Redirect after signup

    try {
        if ($errors->count_error() <= 0) {

            $statement = $users ->selectUsers(compact('email'));

            if($statement) {
                if ($statement-> password == $password) {
                    header("Location:http://localhost:8000/Authenticate/welcome.php");
                    return;
                } else {
                    $errors->set_error('notfound', 'User is not fount');
                }
            }}
    }catch (Exception $e){
        echo $e;
    }}






?>






<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
    />
    <!-- MDB -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css"
        rel="stylesheet"
    />
    <title>Register</title>

</head>
<body>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <?php if ($errors -> has_error('notfound')){ ?>
                    <h3 class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color: red"><?= $errors -> key_error('notfound');?></h3>
                <?php } ?>
                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">LOG IN</p>
                <form method="POST">
                    <!-- Email input -->
                    <?php if ($errors -> has_error('email')){ ?>
                        <span class="mb-5" style="color: red"><?= $errors -> key_error('email');?></span>
                    <?php } ?>
                    <div class="form-outline mb-4">
                        <input type="email" name="email" id="form1Example13" class="form-control form-control-lg" />
                        <label class="form-label" for="form1Example13">Email address</label>
                    </div>

                    <!-- Password input -->
                    <?php if ($errors -> has_error('password')){ ?>
                        <span class="mb-5" style="color: red"><?= $errors -> key_error('password');?></span>
                    <?php } ?>
                    <div class="form-outline mb-4">
                        <input type="password" name="password" id="form1Example23" class="form-control form-control-lg" />
                        <label class="form-label" for="form1Example23">Password</label>
                    </div>

                    <div class="d-flex justify-content-around align-items-center mb-4">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value=""
                                    id="form1Example3"
                                    checked
                            />
                            <label class="form-check-label" for="form1Example3"> Remember me </label>
                        </div>
                        <a href="#!">Forgot password?</a>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>



                </form>
            </div>
        </div>
    </div>
</section>
<!-- MDB -->
<script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"
></script>
</body>
</html>

<!-- MDB -->
<script
    type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"
></script>
</body>
</html>

