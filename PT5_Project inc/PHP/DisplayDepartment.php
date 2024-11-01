<?php
include 'dbconnect.php';
$projectID = $_GET['project'];

if (empty($projectID)) {
    die("Project ID is missing from the URL.");
}

$sql = "SELECT d.departmentName FROM department d 
        INNER JOIN department_project dp ON d.departmentID = dp.departmentID 
        WHERE dp.projectID = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die('Prepare statement failed: ' . $conn->error);
}

$stmt->bind_param("i", $projectID);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die('Query execution failed: ' . $conn->error);
}

if ($result->num_rows > 0) {
    echo "<h2>Departments Working on Project " . $projectID . "</h2>";
    echo "<ul>";

    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row["departmentName"] . "</li>";
    }

    echo "</ul>";
} else {
    echo "No departments found for this project.";
}

$stmt->close();
$conn->close();
?>