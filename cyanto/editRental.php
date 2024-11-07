<?php

require_once 'core/models.php';

if (isset($_GET['id'])) {
    $rental_id = $_GET['id'];
    $rental = getRentalById($rental_id);  // Fetch rental details by ID
    if (!$rental) {
        // If the rental does not exist, redirect or show an error
        header("Location: index.php");
        exit;
    }
} else {
    header("Location: index.php");  // If no rental ID is passed, redirect
    exit;
}

// Check if the form is submitted for updating the rental
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Pass all necessary data to the updateRental function
    updateRental($rental_id, $rental['customer_id'], $rental['car_id'], $status, $start_date, $end_date);  

    header("Location: index.php");  // Redirect after successful update
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Rental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Rental</h1>
    <form action="editRental.php?id=<?php echo $rental['rental_id']; ?>" method="POST">
        <select name="status" required>
            <option value="active" <?php echo $rental['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
            <option value="completed" <?php echo $rental['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
            <option value="cancelled" <?php echo $rental['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
        </select>
        <input type="date" name="start_date" value="<?php echo $rental['start_date']; ?>" required>
        <input type="date" name="end_date" value="<?php echo $rental['end_date']; ?>" required>
        <button type="submit">Update Rental</button>
    </form>
</body>
</html>
