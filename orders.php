<?php

session_start();

include 'DBConn.php';

$stmt = $conn->query("SELECT * FROM tblorders ORDER BY id DESC");

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html>

<head>

<title>Orders History</title>

<style>

body{

font-family:Arial;
background:#f4f4f4;
padding:20px;

}

h1{

text-align:center;
color:#333;

}

.top{

text-align:center;
margin-bottom:20px;

}

.top a{

text-decoration:none;
background:#007bff;
color:white;
padding:12px 20px;
border-radius:5px;

}

table{

width:100%;
border-collapse:collapse;
background:white;

}

th{

background:#007bff;
color:white;
padding:15px;

}

td{

padding:15px;
text-align:center;
border-bottom:1px solid #ddd;

}

tr:hover{

background:#f1f1f1;

}

</style>

</head>

<body>

<h1>📦 Orders History</h1>

<div class="top">

<a href="shop.php">

🛍 Continue Shopping

</a>

</div>


<table>

<tr>

<th>Order ID</th>

<th>User ID</th>

<th>Product ID</th>

<th>Quantity</th>

<th>Total Price</th>

<th>Order Date</th>

</tr>


<?php foreach($orders as $order){ ?>

<tr>

<td>

<?php echo $order['id']; ?>

</td>

<td>

<?php echo $order['user_id']; ?>

</td>

<td>

<?php echo $order['product_id']; ?>

</td>

<td>

<?php echo $order['quantity']; ?>

</td>

<td>

R <?php echo $order['total_price']; ?>

</td>

<td>

<?php echo $order['order_date']; ?>

</td>

</tr>

<?php } ?>

</table>

</body>

</html>