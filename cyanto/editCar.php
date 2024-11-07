<?php

require_once 'core/models.php';


if (isset($_GET['id'])) {
    $car_id = $_GET['id'];
    $car = getCarById($car_id);  // Fetch car details by ID
} else {
    // If no ID is passed, redirect to the main page
    header("Location: index.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model = $_POST['model'];
    $plate_number = $_POST['plate_number'];
    $color = $_POST['color'];
    $status = $_POST['status'];
    $price_per_day = $_POST['price_per_day'];

    updateCar($car_id, $model, $plate_number, $color, $status, $price_per_day);  // Update the car in the DB
    header("Location: index.php");  // Redirect after successful update
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Car</title>
</head>
<body>
    <h1>Edit Car</h1>
    <form action="editCar.php?id=<?php echo $car['car_id']; ?>" method="POST">
        <input type="text" name="model" value="<?php echo htmlspecialchars($car['model']); ?>" required>
        <input type="text" name="plate_number" value="<?php echo htmlspecialchars($car['plate_number']); ?>" required>
        <input type="text" name="color" value="<?php echo htmlspecialchars($car['color']); ?>" required>
        <select name="status" required>
            <option value="available" <?php echo $car['status'] == 'available' ? 'selected' : ''; ?>>Available</option>
            <option value="rented" <?php echo $car['status'] == 'rented' ? 'selected' : ''; ?>>Rented</option>
            <option value="maintenance" <?php echo $car['status'] == 'maintenance' ? 'selected' : ''; ?>>Maintenance</option>
        </select>
        <input type="number" name="price_per_day" value="<?php echo htmlspecialchars($car['price_per_day']); ?>" required>
        <button type="submit">Update Car</button>
    </form>
</body>
</html>
