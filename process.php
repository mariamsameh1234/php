<?php
var_dump($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function clean_input($data) {
        return trim(htmlspecialchars($data));
    }

    $name = clean_input($_POST['name']);
    $email = clean_input($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $room = $_POST['room'];
    $ext = clean_input($_POST['ext']);
    $profile_picture = $_FILES['profile_picture'];

    $errors = [];

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($room) || empty($ext)) {
        $errors[] = "All fields are required!";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format!";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match!";
    }

    if (!ctype_digit($ext)) {
        $errors[] = "Ext must be a number!";
    }

    if (!filter_var($room, FILTER_VALIDATE_INT)) {
        $errors[] = "Room No must be a valid number!";
    }

    if ($profile_picture['error'] !== 0) {
        $errors[] = "Profile picture is required!";
    } else {
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_ext = pathinfo($profile_picture['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($file_ext), $allowed_extensions)) {
            $errors[] = "Invalid file type! Only JPG, PNG, and GIF are allowed.";
        }

        if ($profile_picture['size'] > 2 * 1024 * 1024) {
            $errors[] = "File size must be less than 2MB!";
        }
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        exit;
    }

    // تأكد من وجود المجلد "uploads"
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // استخدام البريد الإلكتروني كاسم للصورة
    $email_filename = preg_replace('/[^a-zA-Z0-9_]/', '_', $email); // استبدال الأحرف غير المسموح بها
    $new_filename = $email_filename . "." . $file_ext; // إضافة الامتداد

    $upload_path = $upload_dir . $new_filename;
    move_uploaded_file($profile_picture['tmp_name'], $upload_path);

    // تشفير كلمة المرور
    $hashedPassword = md5($password);

    // فتح الملف وكتابة البيانات
    $file = fopen("users.txt", "a");
    fwrite($file, "name: " . $name . "\n");
    fwrite($file, "email: " . $email . "\n");
    fwrite($file, "Password: " . $hashedPassword . "\n");
    fwrite($file, "Room No: " . $room . "\n");
    fwrite($file, "Ext: " . $ext . "\n");
    fwrite($file, "Profile Picture: " . $upload_path . "\n");
    fwrite($file, "-------------------------\n");
    fclose($file);

    echo "<p style='color:green;'>User added successfully!</p>";
    exit;
}
?>

