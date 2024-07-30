<?php
// Connect to the database
include("connection.php");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to get patients data
$query = "SELECT fname,lname,gender,email  FROM patreg";
$result = mysqli_query($con, $query);

// Set the filename for the CSV file
$filename = "patients_list_" . date("Ymd") . ".csv";

// Set headers to force download the file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Open PHP output stream for writing CSV data
$output = fopen('php://output', 'w');

// Write CSV headers
fputcsv($output, array('First Name','Last Name', 'Gender', 'Email'));

// Write data rows to CSV
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

// Close output stream
fclose($output);

// Close database connection
mysqli_close($con);
?>
