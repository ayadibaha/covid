<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Authentification</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="login/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/fonts/iconic/css/material-design-iconic-font.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/css/util.css" />
    <link rel="stylesheet" type="text/css" href="login/css/main.css" />
    <!--===============================================================================================-->
</head>

<body style="background-color: #999999;">
    <div class="limiter">
        <div class="container-login100">
            <div class="login100-more" style="background-image: url('login/images/bg-01.jpg');">
            </div>

            <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50" style="padding-top:10px!important;">
                <form class="login100-form validate-form" method="post" action="auth.php">

                    <img src="./login/images/covid19tunisia-fb.png" style="height:15%;margin-bottom:20px;">
                    <span class="login100-form-title p-b-59">
                        Authentification
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Email obligatoire: ex@abc.xyz">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="text" name="email" placeholder="Email addess..." />
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Mot de passe obligatoire">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="pass" placeholder="*************" />
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" class="login100-form-btn">
                                S'authentifier
                            </button>
                        </div>
                    </div>
                    <div style="display:block;margin:20px 0 0 10px;">
                        <a style="color:#adadad!important; text-decoration: none!important;" href="https://covid-19.tn/fr/quest-ce-que-covid-19/">Plus d'informations!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="login/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="login/vendor/bootstrap/js/popper.js"></script>
    <script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="login/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="login/vendor/daterangepicker/moment.min.js"></script>
    <script src="login/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="login/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="login/js/main.js"></script>
</body>

</html>