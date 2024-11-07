<?php

require_once 'core/models.php';
require_once 'core/handleForms.php';

$customers = getAllCustomers();
$cars = getAllCars();
$rentals = getAllRentals();
$payments = getAllPayments();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CY Car Rental System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>CY's Car Rental System</h1>
    <!-- Insert New Customer Form -->
    <h2>Insert Customer</h2>
    <form action="index.php" method="POST">
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone" required>
        <input type="text" name="license_number" placeholder="License Number" required>
        <button type="submit" name="insertCustomer">Add Customer</button>
    </form>

    <!--customers table-->
    <h3>Customers<h3>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>License Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?php echo htmlspecialchars($customer['customer_id']); ?></td>
                    <td><?php echo htmlspecialchars($customer['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($customer['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($customer['email']); ?></td>
                    <td><?php echo htmlspecialchars($customer['phone']); ?></td>
                    <td><?php echo htmlspecialchars($customer['license_number']); ?></td>
                    <td>
                        <a href="editCustomer.php?id=<?php echo $customer['customer_id']; ?>">Edit</a> |
                        <a href="deleteCustomer.php?id=<?php echo $customer['customer_id']; ?>">Delete</a>
                        <a href="viewprojects.php?customer_id=<?php echo $customer['customer_id']; ?>" class="btn">View</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
              
    <!-- Insert New Car Form -->
    <h2>Insert Car</h2>
    <form action="index.php" method="POST">
        <input type="text" name="model" placeholder="Car Model" required>
        <input type="text" name="plate_number" placeholder="Plate Number" required>
        <input type="text" name="color" placeholder="Car Color" required>
        <select name="status" required>
            <option value="available">Available</option>
            <option value="rented">Rented</option>
            <option value="maintenance">Maintenance</option>
        </select>
        <input type="number" name="price_per_day" placeholder="Price Per Day" required>
        <button type="submit" name="insertCar">Add Car</button>
    </form>
    <!--cars table-->            
    <h3>Cars</h3>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Model</th>
                <th>Plate Number</th>
                <th>Color</th>
                <th>Status</th>
                <th>Price Per Day</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cars as $car): ?>
                <tr>
                    <td><?php echo htmlspecialchars($car['car_id']); ?></td>
                    <td><?php echo htmlspecialchars($car['model']); ?></td>
                    <td><?php echo htmlspecialchars($car['plate_number']); ?></td>
                    <td><?php echo htmlspecialchars($car['color']); ?></td>
                    <td><?php echo htmlspecialchars($car['status']); ?></td>
                    <td><?php echo number_format($car['price_per_day'], 2); ?></td>
                    <td>
                        <a href="editCar.php?id=<?php echo $car['car_id']; ?>">Edit</a> |
                        <a href="deleteCar.php?id=<?php echo $car['car_id']; ?>">Delete</a>
                        <a href="viewprojects.php?customer_id=<?php echo $customer['customer_id']; ?>" class="btn">View</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Insert New Rental Form -->
    <h2>Insert Rental</h2>
    <form action="index.php" method="POST">
        <input type="number" name="customer_id" placeholder="Customer ID" required>
        <input type="number" name="car_id" placeholder="Car ID" required>
        <select name="status" required>
            <option value="rented">Rented</option>
            <option value="returned">Returned</option>
        </select>
        <input type="date" name="start_date" required>
        <input type="date" name="end_date" required>
        <button type="submit" name="insertRental">Add Rental</button>
    </form>

    <!-- Rentals table -->
    <h3>Rentals</h3>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer ID</th>
                <th>Car ID</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rentals as $rental): ?>
                <tr>
                    <td><?php echo htmlspecialchars($rental['rental_id']); ?></td>
                    <td><?php echo htmlspecialchars($rental['customer_id']); ?></td>
                    <td><?php echo htmlspecialchars($rental['car_id']); ?></td>
                    <td><?php echo htmlspecialchars($rental['status']); ?></td>
                    <td><?php echo htmlspecialchars($rental['start_date']); ?></td>
                    <td><?php echo htmlspecialchars($rental['end_date']); ?></td>
                    <td>
                        <a href="editRental.php?id=<?php echo $rental['rental_id']; ?>">Edit</a> |
                        <a href="deleteRental.php?id=<?php echo $rental['rental_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Insert New Payment Form -->
    <h2>Insert Payment</h2>
    <form action="index.php" method="POST">
        <input type="number" name="rental_id" placeholder="Rental ID" required>
        <input type="date" name="payment_date" required>
        <input type="number" name="amount" placeholder="Amount" required>
        <input type="text" name="payment_method" placeholder="Payment Method" required>
        <button type="submit" name="insertPayment">Add Payment</button>
    </form>

    <!-- Payments table -->
    <h3>Payments</h3>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Rental ID</th>
                <th>Payment Date</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($payments as $payment): ?>
                <tr>
                    <td><?php echo htmlspecialchars($payment['payment_id']); ?></td>
                    <td><?php echo htmlspecialchars($payment['rental_id']); ?></td>
                    <td><?php echo htmlspecialchars($payment['payment_date']); ?></td>
                    <td><?php echo number_format($payment['amount'], 2); ?></td>
                    <td><?php echo htmlspecialchars($payment['payment_method']); ?></td>
                    <td>
                        <a href="editPayment.php?id=<?php echo $payment['payment_id']; ?>">Edit</a> |
                        <a href="deletePayment.php?id=<?php echo $payment['payment_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</body>
</html>
