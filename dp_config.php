
<?php


$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "watchdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);


if(!$conn){
die("Connection failed". mysqli_connect_error());
}

if($_SERVER['REQUEST_METHOD']=="POST"){

    $full_name = mysqli_real_escape_string($conn, $_POST["full_name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
     

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO  Users (full_name, email, password) VALUES ('$full_name', '$email', '$hashed_password')";

if(mysqli_query($conn, $sql)){

header("Location: login.html");
exit;
}else{
    echo "ERROR: ".mysqli_error($conn);
}

mysqli_close($conn);


}


?>
