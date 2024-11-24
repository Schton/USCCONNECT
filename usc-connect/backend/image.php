<?php
require_once('C:\xampp\htdocs\usc-connect\backend\dbcon.php'); // include database connection

if (isset($_GET['eventID'])) {
    $eventID = $_GET['eventID'];

    // Query the database to fetch the image
    $stmt = $conn->prepare("SELECT eventIMG FROM events WHERE eventID = ?");
    $stmt->bind_param("i", $eventID);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($eventIMG);

    if ($stmt->fetch()) {
        // Set the correct header for the image type
        header("Content-Type: image/jpeg");
        echo $eventIMG;  // Output the image data
    } else {
        // If no image is found, return a default image
        header("Content-Type: image/jpeg");
        echo file_get_contents('path/to/default-image.jpg');
    }

    $stmt->close();
}
?>
