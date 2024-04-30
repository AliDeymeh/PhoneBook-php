<?php
include "index.php"; // فرض بر اینکه این فایل شامل اتصال به دیتابیس است

// بررسی اطلاعات فرم و ثبت آن‌ها در دیتابیس
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$phone = $_POST['phone'];

$sql = "INSERT INTO contacts (name, lastname, phone) VALUES ('$name', '$lastname', '$phone')";

if ($conn->query($sql) === TRUE) {
    // انتقال کاربر به صفحه دیگر بعد از ثبت اطلاعات
    // header("Location: view.php");
    // exit(); // تضمین مسیر صحیح اجرا
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);
?>
  <form
      class="container"
      action="add.php"
      method="post"
      enctype="multipart/form-data"
    >
      <div class="data-set">
        <p>افزودن کاربر جدید</p>
      </div>
      <div class="data-set">
        <label for="name">نام</label>
        <input type="text" id="name" class="input" name="name"/>
      </div>
      <div class="data-set">
        <label for="lastname">نام خانوادگی</label>
        <input type="text" id="lastname" class="input" name="lastname"/>
      </div>
      <div class="data-set">
        <label for="phone">تلفن</label>
        <input type="tel" id="phone" class="input" name="phone"/>
      </div>
      <div class="data-set">
        <button type="submit">ثبت اطلاعات</button>
      </div>
    </form>