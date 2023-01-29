<?php 

    ini_set('display_errors', 1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
     // Defining constant php variable for local host

     define('DB_host', 'sql311.epizy.com');
     define('DB_username', 'epiz_33459705');
     define('DB_password', 'hvZgW4p2guu7');
     define('DB_name', 'epiz_33459705_banking_db');

    //  define('DB_host', 'localhost');
    //  define('DB_username', 'root');
    //  define('DB_password', 'root');
    //  define('DB_name', 'SkyBank');
 

    // define('DB_host', 'nationalbankplc.org');
    // define('DB_username', 'natikplc_admin');
    // define('DB_password', 'natikplc_password');
    // define('DB_name', 'natikplc_SkyBank');

//     $url = parse_url(getenv("CLEARDB_DATABASE_URL"));

// $server = $url["host"];
// $username = $url["user"];
// $password = $url["pass"];
// $db = substr($url["path"], 1);

// $conn = new mysqli($server, $username, $password, $db);

    $conn = mysqli_connect(DB_host, DB_username, DB_password, DB_name);

    if (!$conn) {
        die("connection failed" . mysqli_connect_error());
         echo "Connection Fail";
    }
    // $query = " SELECT * FROM login";
    // $result = mysqli_query($conn, $query) or die("Query Fail");

    // if(mysqli_num_rows($result) > 0){

    //     while($row = mysqli_fetch_assoc($result)){
    //         echo $row['Sr.No']; 
    //         echo $row['AccountNo'];
    //         echo $row['Username']; 
    //         echo $row['Password'];

    //         echo "<br>";
    //     }

    // }

    // mysqli_close($conn);
