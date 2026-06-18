<?php
include 'DBConn.php';

$sql = "SELECT * FROM tblUser";
$result = $conn->query($sql);

echo "<table border='1'>";
echo "<tr><th>Name</th><th>Email</th></tr>";

while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "</tr>";
}

echo "</table>";
?>