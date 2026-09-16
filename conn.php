<<<<<<< HEAD
<html>
<?php
// include("unauthAccess.php");

$host = "localhost";
$user = "root";
$pass = "";
$db   = "webservices2026";

$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
=======
<html>
<?php
// include("unauthAccess.php");

$host = "localhost";
$user = "root";
$pass = "";
$db   = "webservices2026";

$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
>>>>>>> 44d45502d65e73c015d7fc3df2e7e7ae7f6af7df
</html>