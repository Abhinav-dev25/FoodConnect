<?php
$connection = mysqli_connect("localhost", "root", "", "demo");

$result = mysqli_query($connection, "SELECT name, food, quantity, phoneno, latitude, longitude FROM food_donations");

$donors = array();

while($row = mysqli_fetch_assoc($result)) {
    $donors[] = $row;
}

echo json_encode($donors);
?>
