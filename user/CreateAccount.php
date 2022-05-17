<?php
session_start();
include_once('../bankConfig.php');
include "connection.php";
include '../mail/mail_config.php';
// checking Submit button is clicked or not by isset function
if (isset($_POST['submit'])) {

    $Account_Number = $_SESSION['Account_No'];
    $First_Name = $_SESSION['C_First_Name'];
    $Last_Name = $_SESSION['C_Last_Name'];
    $Birth_Date = $_SESSION['C_Birth_Date'];
    $Email = $_SESSION['C_Email'];
    $Pincode = $_SESSION['C_Pincode'];
    $hex = $_SESSION['ProfileColor'];
    $Gender = $_SESSION['Gender'];
    $Username = $_SESSION['Username'];
    $hashPass = $_SESSION['hashPass'];
    $OTP = $_SESSION['OTP'];

    if ($OTP == $_POST['Otp']) {
        $Upload_query = "INSERT INTO
            customer_detail(`Account_No`, `C_First_Name`, `C_Last_Name`, `C_Father_Name`, `C_Mother_Name`, `C_Birth_Date`, /*C_Adhar_No, C_Pan_No,*/ `C_Mobile_No`, `C_Email`, `C_Pincode`, `C_Adhar_Doc`, `C_Pan_Doc`, `ProfileColor`, `Gender`, `ProfileImage`, `Bio`)
            VALUES('$Account_Number', '$First_Name', '$Last_Name', '', '', '$Birth_Date', '', '$Email', '$Pincode', '', '', '$hex', 'Not Availabel', '', '')";

        // $hex = $hex;
        // sql query for login table
        $login_query = "INSERT INTO login(`AccountNo`, `Username`, `Password`, `Status`, `State`) VALUES('$Account_Number', '$Username', '$hashPass', 'Inactive', '0')";

        // sql query for Accounts table
        $account_query = "INSERT INTO accounts(`AccountNo`, `Balance`, `AccountType`, `SavingBalance`, `SavingTarget`, `State`) VALUES('$Account_Number', '0.0', '$Account_Type', '0.0', '', '0')";

        // query execution
        mysqli_query($conn, $Upload_query) or die(mysqli_error($conn));
        mysqli_query($conn, $login_query) or die(mysqli_error($conn));
        mysqli_query($conn, $account_query) or die(mysqli_error($conn));
        $res = sendMail($bank_name,$bank_mail,"Registration details","
            <ul>
            <li>Account Number: ".$Account_Number."</li>
            <li>Name:".$First_Name." ".$Last_Name."</li>
            <li>Pin: ".$Pincode."</li>
            <li>Username: ".$Username."</li>
            </ul>
        ");
        if ($res) {
            header("Location: ../user/login.php?success= Sign up successful!");
            header("Location: ../user/register.php?error= Wrong OTP code supplied!");
        }
        exit();
    } else {
        header("Location: ../user/register.php?error= Wrong OTP code supplied!");
        exit();
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Validate Email</title>

    <!-- Favicons -->
    <link href="../assets/img/favicon-32x32.png" rel="icon">
    <link href="../assets/img/apple-icon-180x180.png" rel="apple-touch-icon">

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Project CSS -->
    <link rel="stylesheet" href="../assets/css/createAccount.css">


    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../assets/js/createAc.js"></script>
</head>

<body>
    <form id="regForm" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <!-- <h1 class="mb-3">Register:</h1> -->

        <div class="tab">
            <p class="SubAction">Validate Email Account</p>

            <div class="col-md mb-3">
                <div class="col-md">
                    <div class="alert alert-success" role="alert">
                        Verification Code has been sent to your email, please check your email
                    </div>
                    <div class="form-floating OtpMobile">
                        <input type="tel" class="form-control" name="Otp" id="Otp" placeholder="Enter 6 Digit OTP" pattern="[0-9]{6}">
                        <label for="floatingInputGrid">Enter 6 Digit OTP</label>
                        <span style="color: red;" id="OtpError"></span>
                    </div>
                </div>
            </div>

        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
                <input type="submit" name="submit" id="submitBtn" class="CustomButton">
            </div>
        </div>
    </form>


    <script src="../assets/js/createAccount.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>

    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>


</body>

</html>