<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pastimes E-Clothing Store</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<a href="contact.php"

class="btn btn-dark btn-custom w-100">

📩 Contact Seller

</a>

<style>

body{
background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
min-height:100vh;
}

.hero-section{
background:rgba(255,255,255,0.95);
border-radius:20px;
padding:60px 40px;
margin-top:100px;
box-shadow:0 20px 60px rgba(0,0,0,0.3);
}

.btn-custom{
padding:12px 30px;
margin:10px;
border-radius:50px;
font-weight:bold;
transition:0.3s;
}

.btn-custom:hover{
transform:translateY(-3px);
}

.feature-icon{
font-size:3rem;
color:#667eea;
margin-bottom:20px;
}

footer{
background:rgba(0,0,0,0.8);
color:white;
text-align:center;
padding:20px;
margin-top:50px;
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

<div class="container">

<a class="navbar-brand" href="#">
<i class="fas fa-tshirt"></i>
Pastimes E-Clothing
</a>

<div class="ms-auto">

<?php if(isset($_SESSION['username'])){ ?>

<span class="text-white me-3">

Welcome,
<?php echo $_SESSION['username']; ?>

</span>

<a href="home.php" class="btn btn-outline-light btn-sm">

Dashboard

</a>

<?php } ?>

</div>

</div>

</nav>


<div class="container">

<div class="hero-section text-center">

<h1 class="display-4 mb-4">

Welcome to Pastimes E-Clothing Store

</h1>

<p class="lead mb-5">

Discover the latest fashion trends at unbeatable prices!

</p>


<div class="row justify-content-center">

<div class="col-md-3">

<a href="login.php"
class="btn btn-primary btn-custom w-100">

<i class="fas fa-sign-in-alt"></i>

Login

</a>

</div>


<div class="col-md-3">

<a href="register.php"
class="btn btn-success btn-custom w-100">

<i class="fas fa-user-plus"></i>

Register

</a>

</div>


<div class="col-md-3">

<!-- SHOP NOW BUTTON -->

<a href="shop.php"
class="btn btn-info btn-custom w-100 text-white">

<i class="fas fa-shopping-bag"></i>

Shop Now

</a>

</div>


<div class="col-md-3">

<a href="admin.php"
class="btn btn-warning btn-custom w-100">

<i class="fas fa-user-shield"></i>

Admin Panel

</a>

</div>

</div>

</div>


<div class="row mt-5 g-4">

<div class="col-md-4">

<div class="card text-center h-100">

<div class="card-body">

<i class="fas fa-truck feature-icon"></i>

<h4>Free Shipping</h4>

<p>On orders over $50</p>

</div>

</div>

</div>


<div class="col-md-4">

<div class="card text-center h-100">

<div class="card-body">

<i class="fas fa-undo-alt feature-icon"></i>

<h4>30-Day Returns</h4>

<p>Hassle-free returns</p>

</div>

</div>

</div>


<div class="col-md-4">

<div class="card text-center h-100">

<div class="card-body">

<i class="fas fa-headset feature-icon"></i>

<h4>24/7 Support</h4>

<p>Customer service always available</p>

</div>

</div>

</div>

</div>

</div>


<footer>

<p>

© 2024 Pastimes E-Clothing Store | All Rights Reserved

</p>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>