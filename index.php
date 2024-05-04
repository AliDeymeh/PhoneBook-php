
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=9.0">
    <title>دفترچه تلفن </title>
    <link rel="stylesheet" type="text/css" href="./style/style.css" />
</head>
<body dir="rtl"> 
<header class="header">
<ul>
<li><a href="all-data.php">نمایش همه</a></li>
<li><a href="search.php">جستجو</a></li>
<li><a href="delete.php">حذف</a></li>
<li><a href="add.php">افزودن مخاطب</a></li>

</ul>
</header>
    <?php
$serverName = "localhost"; // آدرس سرور MySQL
$username = "root"; // نام کاربری MySQL
$password = ""; // رمز عبور MySQL
$dbname = "phonebook"; // نام پایگاه داده

// اتصال به پایگاه داده
$conn = new mysqli($serverName, $username, $password, $dbname);

// بررسی اتصال
if ($conn->connect_error) {
    die("به دیتا بیس متصل نشد " . $conn->connect_error);
}

  ?>
  
</body>
</html>