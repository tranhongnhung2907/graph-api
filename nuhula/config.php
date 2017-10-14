<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "thisisnotsafe";
$dbname = "nu_fb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

$sql = 'INSERT INTO users VALUES ("' . $_GET['user_id'] . '","' . $_GET['user_token'] . '","' . $_GET['user_expire'] . '")';


if (mysqli_query($conn, $sql)) {
	echo 'successfully updated';
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn) . '<br>';
	$sql = 'UPDATE users SET expire = "' . $_GET['user_expire'] . '", token = "' .$_GET['user_token'] . '" WHERE id_user = "' . $_GET['user_id'] . '"';
	if (mysqli_query($conn, $sql)) {
		echo 'update successfully';
	}

}
// echo $_SESSION['part1'];
// echo $_GET['user_id'].'<br>';
// echo $_GET['user_token'].'<br>';
// echo $_GET['user_expire'];
mysqli_close($conn);
?>
