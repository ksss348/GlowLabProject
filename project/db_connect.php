<?php
$conn = mysqli_connect("localhost", "root", "", "my_website");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>