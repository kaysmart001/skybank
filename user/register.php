<?php
include 'connection.php';
include "script.php";
include "../mail/sendMail.php";
require_once '../bankConfig.php';
include '../mail/mail_config.php';
session_start();

$Pincode =  mt_srand(000, 999);

//  Error Variables
$First_Name_error =  $Last_Name_error = $Father_Name_error = $Mother_Name_error = null;
$Birth_Date_error = $Mobile_Number_error =  $Pan_Number_error = $Adhar_Number_error = null;
$Email_error = $Pincode_error = false;
$UsernameError =  $PasswordError  = $ConfirmPasswordError = false;
if (isset($_SESSION['username'])) {
    header("Location: ../user/UserData/Dashboard.php");
} else {


    // checking Submit button is clicked or not by isset function
    if (isset($_POST['submit'])) {

        // ----------------------------------------- Basic Detail Section -----------------------------------------

        $Account_Type = "Saving";
        $Account_Status = "Inactive";
        $Balance = "0.0";

        // Storing Form values in variable
        $Username = $_POST['username'];
        $First_Name = $_POST['firstname'];
        $Last_Name = $_POST['lastname'];
        $Email = $_POST['email'];
        $Birth_Date = $_POST['BirthDate'];
        $Password = $_POST['password'];

        // $Pan_Number = $_POST['PanNumber'];
        // $Adhar_Number = $_POST['AdharNumber'];
        $Account_Number = date('ndyHisL');

        if (strlen($Account_Number) > 12) {
            $Account_Number = substr($Account_Number, 0, -1);
        }

        // $Pincode = $_POST['pincode'];



        // Validate Name of customer
        /* 
            1] Preg_match_all(): This function check any number is avaible in string or not
            2] !\d+! : passing this regular expression in above function which conatin numeric data pattern
            3] Variable : this parameter contains string to be check
            4] logic explain: if() ant numeric value found in string and it is == 1 
        
     */

        if (preg_match_all('!\d+!', $First_Name) == 1) {
            $First_Name_error = "* Numeric value not allowed in First Name";
        }
        if (preg_match_all('!\d+!', $Last_Name) == 1) {
            $Last_Name_error = "* Numeric value not allowed in Last Name";
        }

        if (!empty($Email)) {
            if (!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $Email)) {
                $Email_error = "* Invalid Email ID";
                header("Location: ../user/register.php?error=" . $Email_error);
                exit();
            } else {
                $Email = mysqli_real_escape_string($conn, $_POST['email']);
                $queryEmail = "SELECT * FROM customer_detail WHERE C_Email = '" . $Email . "'";

                $result2 =  mysqli_query($conn, $queryEmail);

                if (mysqli_num_rows($result2) > 0) {
                    $Email_error = "* Email Already Exist";
                    header("Location: ../user/register.php?error=" . $Email_error);
                    exit();
                }
            }
        } else {
            $Email_error = "Enter Your Email";
            header("Location: ../user/register.php?error=" . $Email_error);
            exit();
        }


        // ************************************************** Picode Validation *********************************************





        $today = new DateTime();
        $diff = $today->diff(new datetime($Birth_Date));
        $age = $diff->y;

        if ($age < 18) {
            $Birth_Date_error = "You Are Not Eligible to Open Online Account.";
            header("Location: ../user/register.php?error=" . $Birth_Date_error);
            exit();
        }

        $Username = $_POST['username'];
        $Password  = $_POST['password'];
        $ConfirmPassword = $_POST['confirmPassword'];



        if (!empty($Username)) {
            if (!preg_match_all('/^[A-Za-z]{1}[A-Za-z0-9]{5,31}$/', $Username)) {

                $UsernameError = "Please Enter Valid Username";
                header("Location: ../user/register.php?error=" . $UsernameError);
                exit();
            } else {
                $UsernameError = false;

                $Username = mysqli_real_escape_string($conn, $_POST['username']);
                $query3 = "SELECT * FROM login WHERE Username = '" . $Username . "'";

                $result3 =  mysqli_query($conn, $query3);

                if (mysqli_num_rows($result3) > 0) {
                    $UsernameError = "Username Already Exist";
                    header("Location: ../user/register.php?error=" . $UsernameError);
                    exit();
                }
            }
        } else {
            $UsernameError = "Username Cannot Empty";
            header("Location: ../user/register.php?error=" . $UsernameError);
            exit();
        }

        // ----------------------------------------- Password Verification ---------------------------------------------
        if (!empty($Password)) {
            if (!preg_match_all('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m', $Password)) {
                $PasswordError  = "Password must contain Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character";
                header("Location: ../user/register.php?error=" . $PasswordError);
                exit();
            } else {
                $hashPass = md5($Password);
                $PasswordError = false;
            }
        } else {
            $PasswordError = "Password Cannot be empty";
            $PasswordError  = "Password must contain Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character";
            header("Location: ../user/register.php?error=" . $PasswordError);
            exit();
        }

        if (!empty($ConfirmPassword)) {

            if ($ConfirmPassword != $Password) {
                $ConfirmPasswordError = "Please Enter same Password";
                header("Location: ../user/register.php?error=" . $PasswordError);
                exit();
            } else {
                $ConfirmPasswordError = false;
                $OTP = rand(100000, 999999);
                $_SESSION['OTP'] = $OTP;


                $hex = '#';

                //Create a loop.
                foreach (array('r', 'g', 'b') as $color) {
                    //Random number between 0 and 255.
                    $val = mt_rand(0, 255);
                    //Convert the random number into a Hex value.
                    $dechex = dechex($val);
                    //Pad with a 0 if length is less than 2.
                    if (strlen($dechex) < 2) {
                        $dechex = "0" . $dechex;
                    }
                    //Concatenate
                    $hex .= $dechex;
                }

                //Print out our random hex color.
                $ProfileColor = $hex;

                if ($First_Name_error == null && $Last_Name_error == null && $Email_error == null && $UsernameError == false && $PasswordError == false && $ConfirmPasswordError == false) {


                    $_SESSION['Account_No'] = $Account_Number;
                    $_SESSION['C_First_Name'] = $First_Name;
                    $_SESSION['C_Last_Name'] = $Last_Name;
                    $_SESSION['C_Birth_Date'] = $Birth_Date;
                    $_SESSION['C_Email'] = $Email;
                    $_SESSION['C_Pincode'] = $Pincode;
                    $_SESSION['ProfileColor'] = $ProfileColor;
                    $_SESSION['Gender'] = '';
                    $_SESSION['Username'] = $Username;
                    $_SESSION['hashPass'] = $hashPass;

                    // $Upload_query = "INSERT INTO
                    // customer_detail(`Account_No`, `C_First_Name`, `C_Last_Name`, `C_Father_Name`, `C_Mother_Name`, `C_Birth_Date`, /*C_Adhar_No, C_Pan_No,*/ `C_Mobile_No`, `C_Email`, `C_Pincode`, `C_Adhar_Doc`, `C_Pan_Doc`, `ProfileColor`, `Gender`, `ProfileImage`, `Bio`)
                    // VALUES('$Account_Number', '$First_Name', '$Last_Name', '', '', '$Birth_Date', '', '$Email', '$Pincode', '', '', '$hex', 'Not Availabel', '', '')";


                    // // sql query for login table
                    // $login_query = "INSERT INTO login(`AccountNo`, `Username`, `Password`, `Status`, `State`) VALUES('$Account_Number', '$Username', '$hashPass', '$Account_Status', '0')";

                    // // sql query for Accounts table
                    // $account_query = "INSERT INTO accounts(`AccountNo`, `Balance`, `AccountType`, `SavingBalance`, `SavingTarget`, `State`) VALUES('$Account_Number', '$Balance', '$Account_Type', '0.0', '', '0')";

                    // // query execution

                    // // mysqli_query($conn, $Upload_query) or die(mysqli_error($conn));
                    // // mysqli_query($conn, $login_query) or die(mysqli_error($conn));
                    // // mysqli_query($conn, $account_query) or die(mysqli_error($conn));

                    // require '../mail/congraMail.php';
                    // $response = sendMessage($Email, $First_Name);
                    // echo $otp;
                    $res = sendMail($First_Name . " " . $Last_Name, $Email, "One Time Password", $OTP);

                    if ($res === "Success") {
                        header("location: ./CreateAccount.php");
                    } else {
                        header("Location: ../user/register.php?error= ". $res);
                        exit();
                    }
                }
            }
        } else {
            $ConfirmPasswordError = "Please Confirm Password";
            header("Location: ../user/register.php?error=" . $PasswordError);
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register <?php echo $bank_name; ?></title>
    <!-- Favicons -->
    <link href="../assets/img/favicon-32x32.png" rel="icon">
    <link href="../assets/img/apple-icon-180x180.png" rel="apple-touch-icon">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/login.css">

    <!-- Extra CSS for external module -->
    <style>
        .swal-button {
            padding: 7px 19px;
            border-radius: 2px;
            background: linear-gradient(to right, #8e2de2, #4a00e0);
            font-size: 12px;
            color: white;
        }

        .swal-button:hover {
            opacity: 0.8;
            background-color: transparent;
        }
    </style>

    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../assets/js/createAc.js"></script>
</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="../assets/img/PageImage/loginImage.jpg" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="brand-wrapper">
                                <img src="../assets/img/Logo.svg" alt="logo" class="logo">
                                <p><?php echo $bank_name; ?></p>
                            </div>
                            <p class="login-card-description">Create your account</p>

                            <!-- Register Form -->
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <?php if (isset($_GET['error'])) {  ?>
                                    <p style="color: red;"> *<?php echo $_GET['error'] ?> ! </p>

                                <?php } ?>

                                <div class="form-group">
                                    <label for="username" class="sr-only">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                    <p id="alert1" style="color: red;"><?php echo $UsernameError ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="firstname" class="sr-only">First Name</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="First Name" required>
                                    <p id="alert1" style="color: red;"><?php echo $First_Name_error ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="sr-only">Last Name</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Last Name" required>
                                    <p id="alert1" style="color: red;"><?php echo $Last_Name_error; ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="sr-only">Last Name</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" required>
                                    <p id="alert1" style="color: red;"><?php echo $Email_error ?></p>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="username" class="sr-only">Username</label>
                                    <input type="text" name="username" id="Username" class="form-control" placeholder="Username" required>
                                    <p id="alert1" style="color: red;"></p>
                                </div> -->
                                <div class="form-group">
                                    <label for="BirthDate" class="sr-only">Date of Birth</label>
                                    <input style="line-height:8.5px;" type="date" name="BirthDate" id="BirthDate" class="form-control" required>
                                    <p id="alert1" style="color: red;"><?php echo $Birth_Date_error; ?></p>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                    <p id="alert1" style="color: red;"><?php echo $PasswordError ?></p>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="confirmPassword" class="sr-only">Confirm password</label>
                                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm password" required>
                                    <p id="alert1" style="color: red;"><?php echo $ConfirmPasswordError; ?></p>
                                </div>
                                <input name="submit" id="submit" class="btn btn-block login-btn mb-4" type="submit" value="Sign up">
                            </form>

                            <!-- <a href="../user/forgotPassword.php" class="forgot-password-link">Forgot password?</a> -->
                            <p class="login-card-footer-text">Already have an account? <a href="../user/login.php" class="text-reset">Login here</a></p>
                            <nav class="login-card-footer-nav">
                                <a href="../terms.php">Terms of use.</a>
                                <a href="../privacypolicy.php">Privacy policy</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>
    <script src="../assets/js/showHidePass.js"></script>
    <script src="../assets/js/createAccount.js"></script>
    <script>
        <?php if (isset($_GET['error'])) { ?>
            swal({
                title: "Account Alert!",
                text: "<?php echo $_GET['error'] ?>",
                icon: "error",
            });


        <?php } ?>
    </script>
    <script>
        $(document).ready(function() {
            $('input[type=\'password\']').showHidePassword();

            // $('#OldPassword').showHidePassword();
        });
    </script>
</body>

</html>