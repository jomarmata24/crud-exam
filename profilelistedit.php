<?php
session_start();
require 'db_connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['IdNum'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $birthdate = $_POST['birthdate'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];

    $sql = "UPDATE profile SET Fname = ?, Mname = ?, Lname = ?, Birthdate = ?, Region = ?, Province = ?, City = ?, Barangay = ? WHERE IdNum = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiiiii", $fname, $mname, $lname, $birthdate, $region, $province, $city, $barangay, $id);

    if ($stmt->execute()) {
        header("Location: profilelist.php");
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $sql = "SELECT * FROM profile WHERE IdNum = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $fname = $row['Fname'];
    $mname = $row['Mname'];
    $lname = $row['Lname'];
    $birthdate = $row['Birthdate'];
    $region = $row['Region'];
    $province = $row['Province'];
    $city = $row['City'];
    $barangay = $row['Barangay'];

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Client</title>
</head>
<body>
    <h2>Edit Client</h2>
    <form method="POST" action="">
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" value="<?php echo $fname; ?>" required><br><br>
        <label for="mname">Middle Name:</label>
        <input type="text" id="mname" name="mname" value="<?php echo $mname; ?>"><br><br>
        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" value="<?php echo $lname; ?>" required><br><br>
        <label for="birthdate">Birthdate:</label>
        <input type="date" id="birthdate" name="birthdate" value="<?php echo $birthdate; ?>" required><br><br>
        <label for="region">Region:</label>
        <input type="number" id="region" name="region" value="<?php echo $region; ?>" required><br><br>
        <label for="province">Province:</label>
        <input type="number" id="province" name="province" value="<?php echo $province; ?>" required><br><br>
        <label for="city">City:</label>
        <input type="number" id="city" name="city" value="<?php echo $city; ?>" required><br><br>
        <label for="barangay">Barangay:</label>
        <input type="number" id="barangay" name="barangay" value="<?php echo $barangay; ?>" required><br><br>
        <button type="submit">Save</button>
    </form>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>
