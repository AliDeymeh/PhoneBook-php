<?php
include "index.php";
$sqlRead = "SELECT * FROM contacts";
$result = $conn->query($sqlRead);

if ($result->num_rows > 0) {
    echo "<table class='table rwd-table table-hover table-striped table-responsive'>
    <thead>
    <tr>
          <th>ردیف</th>
          <th>نام</th>
          <th>نام خانوادگی</th>
          <th>تلفن</th>       
    </tr>
    </thead>
    <tbody>";

    $row_num = 1;
    while ($row = $result->fetch_assoc()) {
        if (!empty($row["name"]) && !empty($row["lastname"]) && !empty($row["phone"])) {
            echo "<tr>";
            echo "<td class='text-capitalize'>$row_num</td>";
            echo "<td class='text-capitalize' data-th='نام'>" . $row["name"] . "</td>";
            echo "<td class='text-capitalize' data-th='نام خانوادگی'>" . $row["lastname"] . "</td>";
            echo "<td class='text-capitalize' data-th='تلفن'>" . $row["phone"] . "</td>";
            echo "</tr>";

            $row_num++;
        }
    }

    echo "</tbody></table>";
} else {
    echo "هیچ ردیفی یافت نشد.";
}
?>
?>