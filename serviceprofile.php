<?php
session_start();
require 'db_connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM services";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Services Profile</title>
</head>
<body>
    <h2>Services Profile</h2>
    <a href="serviceprofileadd.php">Add Service</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Service Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['ServiceID']; ?></td>
            <td><?php echo $row['ServiceName']; ?></td>
            <td><?php echo $row['Description']; ?></td>
            <td>
                <a href="serviceprofileedit.php?id=<?php echo $row['ServiceID']; ?>">Edit</a>
                <a href="serviceprofiledelete.php?id=<?php echo $row['ServiceID']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
