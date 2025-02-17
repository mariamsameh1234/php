<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>

<form method="POST">
    <label>First Name:</label>
    <input type="text" name="first_name" required>
    <br><br>

    <label>Last Name:</label>
    <input type="text" name="last_name" required>
    <br><br>

    <label>Address:</label>
    <textarea name="address" rows="5" cols="40"></textarea>
    <br><br>

    <label>Country:</label>
    <select name="country"> 
        <option value="Egypt">Egypt</option>
        <option value="UK">UK</option>
        <option value="USA">USA</option>
    </select>
    <br><br>

    <label>Gender:</label>
    <input type="radio" name="gender" value="Male"> Male
    <input type="radio" name="gender" value="Female"> Female
    <br><br>

    <label>Skills:</label><br>
    <input type="checkbox" name="skills[]" value="PHP"> PHP
    <input type="checkbox" name="skills[]" value="MySQL"> MySQL
    <input type="checkbox" name="skills[]" value="J2SE"> J2SE
    <input type="checkbox" name="skills[]" value="PostgreSQL"> PostgreSQL
    <br><br>

    <label>Username:</label>
    <input type="text" name="user_name" required>
    <br><br>

    <label>Password:</label>
    <input type="password" name="password" required>
    <br><br>

    <label>Department:</label>
    <select name="department"> 
        <option value="Open Source">Open Source</option>
        <option value="PWD">PWD</option>
    </select>
    <br><br>

    <button type="submit">Submit</button>
    <button type="reset">Reset</button>
</form>

</body>
</html>

<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $first_name = test_input($_POST["first_name"]);
    $last_name = test_input($_POST["last_name"]);
    $address = test_input($_POST["address"]);
    $country = test_input($_POST["country"]);
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : "Not specified";
    $skills = isset($_POST["skills"]) ? implode(", ", $_POST["skills"]) : "No skills selected";
    $department = test_input($_POST["department"]);

    
 $fl = fopen("file.txt", "a");
    fwrite($fl, "First Name: " . $first_name . "\n");
    fwrite($fl, "Last Name: " . $last_name . "\n");
    fwrite($fl, "Address: " . $address . "\n");
    fwrite($fl, "Country: " . $country . "\n");
    fwrite($fl, "Gender: " . $gender . "\n");
    fwrite($fl, "Skills: " . $skills . "\n");
    fwrite($fl, "Department: " . $department . "\n");

    fclose($fl);



    $title = ($gender == "Male") ? "Mr." : "Miss.";

   
    echo "<h2>Thanks ($title) $first_name $last_name</h2>";
    echo "<h3>Please Review Your Information:</h3>";
    echo "<p><strong>Name:</strong> $first_name $last_name</p>";
    echo "<p><strong>Address:</strong> $address</p>";
    echo "<p><strong>Your Skills:</strong> $skills</p>";
    echo "<p><strong>Department:</strong> $department</p>";
}
?>


