<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "watchdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = $_POST["password"];

    // echo "Email: $email, Password: $password";

    

    $sql = "SELECT  email, password FROM Users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo"<pre>";
        print_r($row);
        echo"</pre>";

        $pws = $row["password"];
        
        if(password_verify($password, $pws) ){
            echo "Password matching! redirecting";
            header("Location: index.html");
            exit;
        } else {
            echo "Invalid password";
        }
    } else {
        echo "NO USER FOUND";
    }
}

mysqli_close($conn);

?>