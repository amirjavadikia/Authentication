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
        $name = $Request -> input('name');
        $username = $Request -> input('username');
        $email = $Request -> input('email');
        $password = $Request -> input('password');
        $password_repeat = $Request -> input('password_repeat');

// Check Errors of fields
        if (trim($name) == '') {
            $errors->set_error('name', 'Fill the name field');
        }
        if (trim($username) == '') {
            $errors->set_error('username', 'Fill the username field');
        }
        if (trim($email) == '') {
            $errors->set_error('email', 'Fill the email field');
        }
        if (trim($password) == '') {
            $errors->set_error('password', 'Fill the password field');
        } elseif (strlen($password) < 6) {
            $errors->set_error('password', 'Password should not be less than 6 letters');
        }
        if (trim($password_repeat) == '') {
            $errors->set_error('password_repeat', 'Please, repeat your password');
        } elseif (strlen($password_repeat) < 6) {
            $errors->set_error('password_repeat', 'Password should not be less than 6 letters');
        }
        if (trim($password_repeat) !== trim($password)) {
            $errors->set_error('password_repeat', 'The passwords must be same');
        }


// Redirect after signup

        try {
            if ($errors->count_error() <= 0) {
                $result = $users->addUsers(compact('name','username','email','password'));
                if ($result) {
                    header("Location:http://localhost:8000/Authenticate/login.php");
                    return;
                } else {
                    $errors->set_error('register_error', 'register went wrong');
                }
            }
        }catch (Exception $e){
            echo $e;
        }
}


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
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                <?php if ($errors -> has_error('register_error')){ ?>
                                    <h3 class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" style="color: red"><?= $errors -> key_error('register_error');?></h3>
                                <?php } ?>
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                <form class="mx-1 mx-md-4" method="POST">

                                    <?php if ($errors -> has_error('name')){ ?>
                                        <span class="m-5" style="color: red"><?= $errors -> key_error('name');?></span>
                                    <?php } ?>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" name="name" id="form3Example1c" class="form-control" />
                                            <label class="form-label" for="form3Example1c">Name</label>
                                        </div>
                                    </div>

                                    <?php if ($errors -> has_error('username')){ ?>
                                        <span class="m-5" style="color: red"><?= $errors -> key_error('username');?></span>
                                    <?php } ?>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" name="username" id="form3Example1c" class="form-control" />
                                            <label class="form-label" for="form3Example1c">Username</label>
                                        </div>
                                    </div>

                                    <?php if ($errors -> has_error('email')){ ?>
                                        <span class="m-5" style="color: red"><?= $errors -> key_error('email');?></span>
                                    <?php } ?>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email" name="email" id="form3Example3c" class="form-control" />
                                            <label class="form-label" for="form3Example3c">Email</label>
                                        </div>
                                    </div>

                                    <?php if ($errors -> has_error('password')){ ?>
                                        <span class="m-5" style="color: red"><?= $errors -> key_error('password');?></span>
                                    <?php } ?>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" name="password" id="form3Example4c" class="form-control" />
                                            <label class="form-label" for="form3Example4c">Password</label>
                                        </div>
                                    </div>

                                    <?php if ($errors -> has_error('password_repeat')){ ?>
                                        <span class="m-5" style="color: red"><?= $errors -> key_error('password_repeat');?></span>
                                    <?php } ?>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" name="password_repeat" id="form3Example4cd" class="form-control" />
                                            <label class="form-label" for="form3Example4cd">Repeat your password</label>
                                        </div>
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-5">
                                        <input
                                            class="form-check-input me-2"
                                            type="checkbox"
                                            value=""
                                            id="form2Example3c"
                                        />
                                        <label class="form-check-label" for="form2Example3">
                                            I agree all statements in <a href="#!">Terms of service</a>
                                        </label>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-primary btn-lg">Register</button>
                                    </div>

                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">

                            </div>
                        </div>
                    </div>
                </div>
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
