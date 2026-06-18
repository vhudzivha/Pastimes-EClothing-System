<?php
session_start();

include 'DBConn.php';

if(isset($_POST['placeorder'])){

    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postal = $_POST['postal'];

    $sql = "INSERT INTO tbldelivery(fullname, phone, address, city, postal)
            VALUES('$fullname','$phone','$address','$city','$postal')";

    $conn->query($sql);

    unset($_SESSION['cart']);

    echo "
    <script>
    alert('Order placed successfully!');
    window.location='shop.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Checkout</title>

<style>

body{
font-family:Arial;
background:#f4f4f4;
}

.container{

width:500px;
margin:50px auto;
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 0 15px rgba(0,0,0,0.2);

}

h1{

text-align:center;
color:green;

}

input{

width:100%;
padding:12px;
margin-top:10px;
margin-bottom:20px;
border:1px solid #ccc;
border-radius:5px;

}

button{

width:100%;
padding:15px;
background:green;
color:white;
border:none;
border-radius:5px;
font-size:18px;
cursor:pointer;

}

button:hover{

background:#006400;

}

</style>

</head>

<body>

<div class="container">

<h1>Checkout</h1>

<form method="POST">

<label>Full Name</label>

<input type="text" name="fullname" required>


<label>Phone Number</label>

<input type="text" name="phone" required>


<label>Address</label>

<input type="text" name="address" required>


<label>City</label>

<input type="text" name="city" required>


<label>Postal Code</label>

<input type="text" name="postal" required>


<button type="submit" name="placeorder">

Place Order

</button>

</form>

</div>

</body>
</html>