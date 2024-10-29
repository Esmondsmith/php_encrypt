<?php

//ESMOND AGHARO 07035967785. 
//Not too strong in Laravel, thanks.

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $allowed_emails = ['gmail.com', 'outlook.com', 'yahoo.com'];
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailName = substr(strrchr($email, "@"), 1);
        // Check if the domain is in the allowed list
        if (in_array($emailName, $allowed_emails)) {
            echo "Valid Email";
            // Proceed with the rest of the registration process
        } else {
            echo "Error, only Gmail, Yahoo, and Outlook are allowed!";
        }
    } else {
        echo "Invalid email format.";
    }

    $sql = "INSERT INTO users (name, phone, email, password, dob) VALUES (:name, :phone, :email, :password, :dob)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'phone' => $phone, 'email' => $email, 'password' => $password, 'dob' => $dob]);

    header("Location: index.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New User</title>
    <script>
        // Capitalize First and Last Names 
        function nameCapitalise() {
            const nameEntered = document.getElementById('names');
            const words = nameEntered.value.trim().split(" ");
            for (let i = 0; i < words.length; i++) {
                words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
            }
            nameEntered.value = words.join(" ");
        }

        // Check Phone Length
        function validatePhoneNumber() {
            const phoneNumber = document.getElementById('phoneNumb');
            const phone = phoneNumber.value;
            if (phone.length !== 11) {
                alert("Phone number must be exactly 11 digits.");
            }
        }

        // Check if Older than 18.
        function ageValidate() {
            const dobInput = document.querySelector('input[name="dob"]');
            const dob = new Date(dobInput.value);
            const today = new Date();
            const age = today.getFullYear() - dob.getFullYear();
            const age_diff = today.getMonth() - dob.getMonth();
            const birth_diff = today.getDate() - dob.getDate();
            
            if (age < 18 || (age === 18 && age_diff < 0) || (age === 18 && age_diff === 0 && birth_diff < 0)) {
                alert("You must be older than 18 years to register.");
                dobInput.value = ""; 
                dobInput.focus();
            }
        }

        // Validate Form on Submit
        function validateForm(event) {
            nameCapitalise();
            validatePhoneNumber();
            ageValidate();
        }
    </script>
</head>
<body style="display: flex; justify-content: center; align-items:center">
    <div>
        <h2>Register New User</h2>
        <form action="index.php" method="POST" style="padding: 10px; border: 2px solid black" onsubmit="validateForm(event)">
            <div style="padding: 5px">
                <input type="text" name="name" id="names" placeholder="Name" required onblur="nameCapitalise()">
            </div>
            <div style="padding: 5px">
                <input type="number" name="phone" id="phoneNumb" placeholder="Phone Number" required onblur="validatePhoneNumber()">
            </div>
            <div style="padding: 5px">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div style="padding: 5px">
                <input type="password" name="password" placeholder="Enter Password" required>
            </div>
            <div style="padding: 5px">
                <input type="date" name="dob" placeholder="Select dob" required onblur="ageValidate()">
            </div>
            <div style="padding: 5px">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
</body>
</html>
