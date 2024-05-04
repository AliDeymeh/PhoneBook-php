<?php
include "index.php";
$sqlRead = "SELECT * FROM contacts";
$result = $conn->query($sqlRead);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM contacts WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
if ($result->num_rows > 0) {
    echo "<table class='table rwd-table table-hover table-striped table-responsive'>
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
    while ($row = $result->fetch_assoc()) {
      if (!empty($row["name"]) && !empty($row["lastname"]) && !empty($row["phone"])) {  
      echo "<tr>";
        echo "<td class='text-capitalize' >$row_num</td>";
        echo "<td class='text-capitalize'  data-th='نام'>" . $row["name"] . "</td>";
        echo "<td  class='text-capitalize' data-th='نام خانوادگی'>" . $row["lastname"] . "</td>";
        echo "<td  class='text-capitalize' data-th='تلفن'>" . $row["phone"] . "</td>";
        
  echo "<td data-th='حذف'><button class='btn-remove' onclick='deleteRecord(" . $row["id"] . ")'>حذف</button></td>";
        echo "</tr>";

        $row_num++;
    }}

    echo "</tbody></table>";
} else {
    echo "هیچ ردیفی یافت نشد.";
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