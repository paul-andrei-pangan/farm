<?php
session_start();
include('db.php'); // Include the database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Insert livestock if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $livestock_name = $_POST['livestock_name'];
    $quantity = $_POST['quantity'];
    $birth_date = $_POST['birth_date'];

    // Insert the new livestock into the database
    $query = "INSERT INTO livestock (livestock_name, quantity, birth_date, user_id) 
              VALUES ('$livestock_name', '$quantity', '$birth_date', '$user_id')";
    if ($conn->query($query) === TRUE) {
        echo "Livestock added successfully!";
        header("Location: livestock.php"); // Redirect to livestock page
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Livestock</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f8f9fa;
        margin: 0;
        padding: 0;
        display: flex;
        min-height: 100vh;
    }

    /* Sidebar Styles */
    .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 18px; /* Smaller font for consistency */
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .sidebar ul li {
            margin: 8px 0;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 14px; /* Smaller font size for compactness */
            display: flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background: #34495e;
        }

    /* Main Content */
    .main-content {
        margin-left: 280px;
        padding: 20px;
        flex-grow: 1;
    }
        h2 {
            color: white;
        }

        /* Add Livestock Form */
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: auto;
        }

        .form-container h3 {
            color: #007bff;
            font-size: 22px;
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin: 10px 0 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background: #007bff;
            color: white;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        /* Cancel Button Styles */
        .cancel-button {
            background-color: #dc3545;
            width: 100%;
            margin-top: 10px;
        }

        .cancel-button:hover {
            background-color: #c82333;
        }
        h3{
            color: black;
        font-size: 22px;
        text-align: center; /* Center the title */
        margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>🐄 Livestock Dashboard</h2>
    <ul>
    <li><a href="dashboard.php">🏠 Home</a></li>
        <li><a href="profile.php">👤 Profile</a></li>
        <li><a href="crops.php">🌱 Crops</a></li>
        <li><a href="livestock.php">🐄 Livestock</a></li>
        <li><a href="inventory.php">📦 Inventory</a></li>
        <li><a href="expenses.php">💸 Expenses</a></li>
        <li><a href="income.php">💰 Income</a></li>
        <li><a href="settings.php">⚙ Settings</a></li>
        <li><a href="logout.php" class="logout">🚪 Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <h3>Add New Livestock</h3>

    <div class="form-container">
        <h3>Enter Livestock Details</h3>
        <form method="POST" action="add_livestock.php">
            <label for="livestock_name">Livestock Name:</label>
            <input type="text" name="livestock_name" id="livestock_name" required>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" required>

            <label for="birth_date">Birth Date:</label>
            <input type="date" name="birth_date" id="birth_date" required>

            <button type="submit">Add Livestock</button>
            <!-- Cancel Button -->
            <a href="livestock.php">
                <button type="button" class="cancel-button">Cancel</button>
            </a>
        </form>
    </div>
</div>

</body>
</html>
