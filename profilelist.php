<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'db_connection.php';

$sql = "SELECT * FROM Profile";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile List</title>
</head>
<body>
    <h1>Profile List</h1>
    <a href="profilelistadd.php">Add Client</a>
    <table border="1">
        <tr>
            <th>IdNum</th>
            <th>Fname</th>
            <th>Mname</th>
            <th>Lname</th>
            <th>Birthdate</th>
            <th>Region</th>
            <th>Province</th>
            <th>City</th>
            <th>Barangay</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['IdNum']}</td>
                    <td>{$row['Fname']}</td>
                    <td>{$row['Mname']}</td>
                    <td>{$row['Lname']}</td>
                    <td>{$row['Birthdate']}</td>
                    <td>{$row['Region']}</td>
                    <td>{$row['Province']}</td>
                    <td>{$row['City']}</td>
                    <td>{$row['Barangay']}</td>
                    <td>
                        <a href='profilelistedit.php?IdNum={$row['IdNum']}'>Edit</a> |
                        <a href='profilelistdel.php?IdNum={$row['IdNum']}'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No records found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
