<?php

require_once 'core/dbConfig.php';

// Handle the insertion of customers
if (isset($_POST['insertCustomer'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $license_number = $_POST['license_number'];

    $stmt = $pdo->prepare("INSERT INTO customers (first_name, last_name, email, phone, license_number) 
                            VALUES (:first_name, :last_name, :email, :phone, :license_number)");

    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':license_number', $license_number);

    $stmt->execute();

    // Redirect to the index page after insertion
    header("Location: index.php");
    exit();
}

// Handle the insertion of cars
if (isset($_POST['insertCar'])) {
    $model = $_POST['model'];
    $plate_number = $_POST['plate_number'];
    $color = $_POST['color'];
    $status = $_POST['status'];
    $price_per_day = $_POST['price_per_day'];

    $stmt = $pdo->prepare("INSERT INTO cars (model, plate_number, color, status, price_per_day) 
                            VALUES (:model, :plate_number, :color, :status, :price_per_day)");

    $stmt->bindParam(':model', $model);
    $stmt->bindParam(':plate_number', $plate_number);
    $stmt->bindParam(':color', $color);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':price_per_day', $price_per_day);

    $stmt->execute();

    // Redirect to the index page after insertion
    header("Location: index.php");
    exit();
}

// Handle the insertion of rentals
if (isset($_POST['insertRental'])) {
    $customer_id = $_POST['customer_id'];
    $car_id = $_POST['car_id'];
    $status = $_POST['status'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $stmt = $pdo->prepare("INSERT INTO rentals (customer_id, car_id, status, start_date, end_date) 
                            VALUES (:customer_id, :car_id, :status, :start_date, :end_date)");

    $stmt->bindParam(':customer_id', $customer_id);
    $stmt->bindParam(':car_id', $car_id);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);

    $stmt->execute();

    // Redirect to the index page after insertion
    header("Location: index.php");
    exit();
}

// Handle the insertion of payments
if (isset($_POST['insertPayment'])) {
    $rental_id = $_POST['rental_id'];
    $payment_date = $_POST['payment_date'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    $stmt = $pdo->prepare("INSERT INTO payments (rental_id, payment_date, amount, payment_method) 
                            VALUES (:rental_id, :payment_date, :amount, :payment_method)");

    $stmt->bindParam(':rental_id', $rental_id);
    $stmt->bindParam(':payment_date', $payment_date);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':payment_method', $payment_method);

    $stmt->execute();

    // Redirect to the index page after insertion
    header("Location: index.php");
    exit();
}

if (isset($_POST['insertNewProjectBtn'])) {
    $web_dev_id = $_GET['web_dev_id'];
    $project_name = $_POST['projectName'];
    $technologies_used = $_POST['technologiesUsed'];

    $stmt = $pdo->prepare("INSERT INTO projects (web_dev_id, project_name, technologies_used) 
                           VALUES (:web_dev_id, :project_name, :technologies_used)");
    $stmt->bindParam(':web_dev_id', $web_dev_id);
    $stmt->bindParam(':project_name', $project_name);
    $stmt->bindParam(':technologies_used', $technologies_used);
    $stmt->execute();

    // Redirect after successful insertion
    header("Location: viewsproject.php?web_dev_id=$web_dev_id");
    exit;
}

?>
