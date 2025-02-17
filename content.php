<html>
<head>
    <title>Add User</title>
</head>
<body>

<?php include('header.php'); ?>



<form action="process.php" method="post" enctype="multipart/form-data">
    <label for="name">Name:</label>
    <input type="text" name="name" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" required><br>

    <label for="room">Room No:</label>
    <input type="text" name="room" required><br> 

    <label for="ext">Ext:</label>
    <input type="text" name="ext"><br>

    
    <label for="profile_picture">Profile Picture:</label>
    <input type="file" name="profile_picture" accept="image/*" required><br>

    <button type="submit">Submit</button>
    <button type="reset">Reset</button>
</form>

<?php include('footer.php'); ?>

</body>
</html>

