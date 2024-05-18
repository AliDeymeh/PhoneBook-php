
<?php
include "index.php"; // اتصال به دیتابیس
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM contacts WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
echo  "
<section class='div-searching'>

<form class='container form-search' 
      
      method='post'
      enctype='multipart/form-data' action='search.php'> <!-- فرم برای ارسال اطلاعات به سمت فایل search.php -->
        <label for='phone' >شماره تلفن: </label>
        <input style={{color:'red'}} type='text' id='phone' name='phone' placeholder='شماره تلفن را ورودی دهید'> <!-- ورودی جهت وارد کردن شماره تلفن -->
        <button type='submit'>جستجو</button> <!-- دکمه ارسال فرم برای جستجو -->
    </form>
<form class='container form-search' 
      
      method='post'
      enctype='multipart/form-data' action='search.php'> <!-- فرم برای ارسال اطلاعات به سمت فایل search.php -->
        <label for='name' > نام : </label>
        <input style={{color:'red'}} type='text' id='name' name='name' placeholder='شماره تلفن را ورودی دهید'> <!-- ورودی جهت وارد کردن نام  -->
        <button type='submit'>جستجو</button> <!-- دکمه ارسال فرم برای جستجو -->
    </form><form class='container form-search' 
      
      method='post'
      enctype='multipart/form-data' action='search.php'> <!-- فرم برای ارسال اطلاعات به سمت فایل search.php -->
        <label for='lastname' >نام خانوادگی : </label>
        <input style={{color:'red'}} type='text' id='lastname' name='lastname' placeholder='شماره تلفن را ورودی دهید'> <!-- ورودی جهت وارد کردن  نام خانوادگی -->
        <button type='submit'>جستجو</button> <!-- دکمه ارسال فرم برای جستجو -->
    </form>
</section>    
";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone_search =!empty($_POST['phone'])? mysqli_real_escape_string($conn, $_POST['phone']):""; // شماره تلفن مورد جستجو
$name_search =!empty($_POST['name'])? mysqli_real_escape_string($conn, $_POST['name']):"";
$lastname_search =!empty($_POST['lastname'])? mysqli_real_escape_string($conn, $_POST['lastname']):"";
    // کوئری SELECT برای جستجو در بخش شماره تلفن
    $sql_search =!empty($phone_search) ?"SELECT * FROM contacts WHERE phone LIKE '%$phone_search%'":!empty($name_search)?"SELECT * FROM contacts WHERE name LIKE '%$name_search%'":"SELECT * FROM contacts WHERE lastname LIKE '%$lastname_search%'";
    $result_search = $conn->query($sql_search);

    if ($result_search->num_rows > 0) {
        echo "<table class='rwd-table'>
        <thead>
            <tr>
                <th>ردیف</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>تلفن</th>
                <th>حذف</th>
            </tr>
        </thead>
        <tbody>";

        $row_num = 1;
        while ($row = $result_search->fetch_assoc()) {
          if (!empty($row["name"]) && !empty($row["lastname"]) && !empty($row["phone"])) {
            echo "<tr>";
            echo "<td data-th='ردیف'>" . $row_num . "</td>";
            echo "<td data-th='نام'>" . $row["name"] . "</td>";
            echo "<td data-th='نام خانوادگی'>" . $row["lastname"] . "</td>";
            echo "<td data-th='تلفن'>" . $row["phone"] . "</td>";
            echo "<td data-th='حذف'><button onclick='deleteRecord(" . $row["id"] . ")'>حذف</button></td>";
            echo "</tr>";

            $row_num++;}
        }

        echo "</tbody></table>";
    } else {
        echo "هیچ رکوردی با این مشخصات یافت نشد.";
    }

    mysqli_close($conn);
}
?>

<script>
  function deleteRecord(id) {
   if(confirm('آیا مطمئن به حذف این رکورد هستید؟')) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
            // Refresh the table after successful deletion
            location.reload();
         }
      };
      xhr.open("POST", "delete.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send("id=" + id);
   }
}
</script>

