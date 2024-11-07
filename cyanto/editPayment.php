<?php

require_once 'core/models.php';

if (isset($_GET['id'])) {
    $payment_id = $_GET['id'];
    $payment = getPaymentById($payment_id);  // Fetch payment details by ID
    if (!$payment) {
        // If the payment does not exist, redirect or show an error
        header("Location: index.php");
        exit;
    }

    // Define the current rental_id based on the payment information
    $current_rental_id = $payment['rental_id'];  // Ensure the rental_id is available
} else {
    header("Location: index.php");  // If no payment ID is passed, redirect
    exit;
}

// Check if the form is submitted for updating the payment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payment_date = $_POST['payment_date'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    // Pass all necessary data to the updatePayment function
    updatePayment($payment_id, $current_rental_id, $payment_date, $amount, $payment_method);  

    header("Location: index.php");  // Redirect after successful update
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Payment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Payment</h1>

    <!-- Edit Payment Form -->
    <form action="editPayment.php?id=<?php echo $payment['payment_id']; ?>" method="POST">
        <!-- Rental ID Text Field -->
        <label for="rental_id">Rental ID:</label>
        <input type="text" name="rental_id" value="<?php echo htmlspecialchars($current_rental_id); ?>" required>
        <br><br>

        <!-- Payment Date -->
        <label for="payment_date">Payment Date:</label>
        <input type="date" name="payment_date" value="<?php echo htmlspecialchars($payment['payment_date']); ?>" required>
        <br><br>

        <!-- Amount -->
        <label for="amount">Amount:</label>
        <input type="number" name="amount" value="<?php echo htmlspecialchars($payment['amount']); ?>" required>
        <br><br>

        <!-- Payment Method -->
        <label for="payment_method">Payment Method:</label>
        <input type="text" name="payment_method" value="<?php echo htmlspecialchars($payment['payment_method']); ?>" required>
        <br><br>

        <button type="submit">Update Payment</button>
    </form>
</body>
</html>
