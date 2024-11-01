<?php
include 'dbconnect.php';

// SQL query to retrieve employees
$sql = "SELECT employeeID, fullName, dateOfBirth, degreeType, typingSpeed, departmentID FROM employees";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    echo "<table>
        <tr>
            <th>Employee ID</th>
            <th>Full Name</th>
            <th>Date of Birth</th>
            <th>Degree Type</th>
            <th>Typing Speed</th>
            <th>Department</th>
        </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . $row['employeeID'] . "</td>
            <td>" . $row['fullName'] . "</td>
            <td>" . $row['dateOfBirth'] . "</td>
            <td>" . $row['degreeType'] . "</td>
            <td>" . $row['typingSpeed'] . "</td>
            <td>" . $row['departmentName'] . "</td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "No employees found.";
}

$conn->close();
?>