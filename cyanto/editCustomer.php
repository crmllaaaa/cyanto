<?php

require_once 'core/models.php';

if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $customer = getCustomerById($customer_id);  // Fetch customer details by ID
} else {
    // If no ID is passed, redirect to the main page
    header("Location: index.php");
    exit;
}

// Check if the form is submitted for updating the customer
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $license_number = $_POST['license_number'];

    updateCustomer($customer_id, $first_name, $last_name, $email, $phone, $license_number);  // Update customer in the DB
    header("Location: index.php");  // Redirect after successful update
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Customer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Customer</h1>
    <form action="editCustomer.php?id=<?php echo $customer['customer_id']; ?>" method="POST">
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($customer['first_name']); ?>" required>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($customer['last_name']); ?>" required>
        <input type="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" required>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($customer['phone']); ?>" required>
        <input type="text" name="license_number" value="<?php echo htmlspecialchars($customer['license_number']); ?>" required>
        <button type="submit">Update Customer</button>
    </form>
</body>
</html>
