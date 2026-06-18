<?php

session_start();

include 'DBConn.php';


// Increase quantity
if(isset($_GET['plus'])){

    $id = $_GET['plus'];

    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]++;
    }

}


// Decrease quantity
if(isset($_GET['minus'])){

    $id = $_GET['minus'];

    if(isset($_SESSION['cart'][$id]) && $_SESSION['cart'][$id] > 1){

        $_SESSION['cart'][$id]--;

    }

}


// Remove item
if(isset($_GET['remove'])){

    $id = $_GET['remove'];

    unset($_SESSION['cart'][$id]);

}


// Checkout
if(isset($_POST['checkout'])){

$user_id = 1; // Admin user

foreach($_SESSION['cart'] as $id => $quantity){

$stmt = $conn->query("SELECT * FROM tblproducts WHERE id=$id");

$product = $stmt->fetch(PDO::FETCH_ASSOC);

$total_price = $product['price'] * $quantity;

$conn->query("
INSERT INTO tblorders(user_id, product_id, quantity, total_price)
VALUES ($user_id,$id,$quantity,$total_price)
");

}

unset($_SESSION['cart']);

header("Location: success.php");

exit();

unset($_SESSION['cart']);

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Shopping Cart</title>

<style>

body{

font-family:Arial;

padding:20px;

}

table{

width:100%;

border-collapse:collapse;

}

th,td{

padding:15px;

border:1px solid #ddd;

text-align:center;

}

th{

background:#007bff;

color:white;

}

h1{

text-align:center;

}

a{

text-decoration:none;

padding:6px 10px;

background:#007bff;

color:white;

border-radius:4px;

margin-right:5px;

}

.remove{

background:red;

}

button{

padding:12px 25px;

background:green;

color:white;

border:none;

border-radius:5px;

font-size:18px;

cursor:pointer;

margin-top:20px;

}

</style>

</head>

<body>

<h1>My Shopping Cart</h1>

<table>

<tr>

<th>Product</th>

<th>Price</th>

<th>Quantity</th>

<th>Action</th>

</tr>

<?php

$total = 0;

if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){

foreach($_SESSION['cart'] as $id => $quantity){

$stmt = $conn->query("SELECT * FROM tblProducts WHERE id=$id");

$product = $stmt->fetch(PDO::FETCH_ASSOC);


// VERY IMPORTANT

if(!$product){

continue;

}

?>

<tr>

<td>

<?php echo $product['name']; ?>

</td>

<td>

R <?php echo $product['price']; ?>

</td>

<td>

<?php echo $quantity; ?>

</td>

<td>

<a href="cart.php?plus=<?php echo $id; ?>">+</a>

<a href="cart.php?minus=<?php echo $id; ?>">-</a>

<a class="remove" href="cart.php?remove=<?php echo $id; ?>">

Remove

</a>

</td>

</tr>

<?php

$total += ($product['price'] * $quantity);

}

}

?>

</table>

<h2>

Total : R <?php echo number_format($total,2); ?>

</h2>

<a href="checkout.php"
style="
padding:15px 30px;
background:green;
color:white;
text-decoration:none;
border-radius:5px;
font-size:18px;
">
Checkout
</a>

</body>

</html>