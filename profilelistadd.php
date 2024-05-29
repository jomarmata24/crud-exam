<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $birthdate = $_POST['birthdate'];
    $region = $_POST['region'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $barangay = $_POST['barangay'];

    $sql = "INSERT INTO profile (Fname, Mname, Lname, Birthdate, Region, Province, City, Barangay) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssiiii", $fname, $mname, $lname, $birthdate, $region, $province, $city, $barangay);

    if ($stmt->execute()) {
        header("Location: profilelist.php");
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Client</title>
</head>
<body>
    <h2>Add Client</h2>
    <form method="POST" action="">
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" required><br><br>
        <label for="mname">Middle Name:</label>
        <input type="text" id="mname" name="mname"><br><br>
        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" required><br><br>
        <label for="birthdate">Birthdate:</label>
        <input type="date" id="birthdate" name="birthdate" required><br><br>
        <label for="region">Region:</label>
        <input type="number" id="region" name="region" required><br><br>
        <label for="province">Province:</label>
        <input type="number" id="province" name="province" required><br><br>
        <label for="city">City:</label>
        <input type="number" id="city" name="city" required><br><br>
        <label for="barangay">Barangay:</label>
        <input type="number" id="barangay" name="barangay" required><br><br>
        <button type="submit">Save</button>
    </form>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>
