<?php

$users = file('users.txt', FILE_IGNORE_NEW_LINES);


$user_data = [];


foreach ($users as $line) {
    $line = trim($line); 
    if (!empty($line)) {
        $user_data[] = explode(': ', $line); 
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<h1>Users List</h1>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
        <th>Room No</th>
        <th>Ext</th>
        <th>Profile Picture</th>
    </tr>

    <?php
    // عرض البيانات في جدول
    $user_count = count($user_data) / 6; // كل مستخدم يحتوي على 6 أسطر من البيانات
    for ($i = 0; $i < $user_count; $i++) {
        $imagePath = $user_data[$i * 6 + 5][1]; // استرجاع مسار الصورة المخزنة
        $imageUrl = 'uploads/' . basename($imagePath); // تأكد من أن المسار يتضمن مجلد 'uploads'
echo "$imageUrl";

        echo "<tr>";
        echo "<td>" . $user_data[$i * 6][1] . "</td>";
        echo "<td>" . $user_data[$i * 6 + 1][1] . "</td>";
        echo "<td>" . $user_data[$i * 6 + 2][1] . "</td>";
        echo "<td>" . $user_data[$i * 6 + 3][1] . "</td>";
        echo "<td>" . $user_data[$i * 6 + 4][1] . "</td>";
        echo "<td><img src='$imageUrl' alt='Profile Picture'></td>"; // عرض الصورة

       echo "</tr>";
	
    }
	
    ?>


</table>

</body>
</html>


