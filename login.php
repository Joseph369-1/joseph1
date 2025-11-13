<?php
require 'db_connect.php';
if( isset($_POST['username']) && isset($_POST['password'])
    ){
$username =$_POST ['username'];
$password = $_POST ['password'];

$sql = "sselect * from users where username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if(
    $result->num_row > 0
){
    $user = $result->fetch_assoc();

if(password_verify($password, $user['password'])){
    echo "<script>alert('Login successful!'); window.location= 'index.html';</script>";
}else{
    echo "<script>alert('incorrect password'); window.history.back();</script>";
}
} else{
    echo "<script>alert('user not found'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
    }
    else{
        echo "please fill in all the field.";
    }

?>