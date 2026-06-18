<?php
session_start();

include 'DBConn.php';

$message = "";

// Add product to cart
if(isset($_POST['addcart'])){

    $id = $_POST['product_id'];

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }

    if(isset($_SESSION['cart'][$id])){

        $_SESSION['cart'][$id]++;

    }else{

        $_SESSION['cart'][$id] = 1;

    }

    $message = "Product added to cart successfully!";
}


// Load products
if(isset($_GET['search'])){

    $search = $_GET['search'];

    $stmt = $conn->prepare(
        "SELECT * FROM tblProducts
        WHERE name LIKE ?"
    );

    $stmt->execute(["%$search%"]);

}

elseif(isset($_GET['category'])){

    $category = $_GET['category'];

    $stmt = $conn->prepare(
        "SELECT * FROM tblProducts
        WHERE category=?"
    );

    $stmt->execute([$category]);

}

else{

    $stmt = $conn->query(
        "SELECT * FROM tblProducts"
    );

}

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>

<title>Pastimes E-Clothing Store</title>

<form method="GET" style="text-align:center;margin-bottom:20px;">

<input type="text"

name="search"

placeholder="🔍 Search products..."

style="

padding:12px;

width:300px;

border-radius:25px;

border:1px solid #ccc;

">

<button

style="

padding:12px 20px;

background:#007bff;

color:white;

border:none;

border-radius:25px;

">

Search

<div style="text-align:center;margin-bottom:30px;">

<a href="shop.php"

style="margin:10px;">

All

</a>

<a href="shop.php?category=Men"

style="margin:10px;">

Men

</a>

<a href="shop.php?category=Women"

style="margin:10px;">

Women

</a>

<a href="shop.php?category=Shoes"

style="margin:10px;">

Shoes

</a>

<a href="shop.php?category=Accessories"

style="margin:10px;">

Accessories

</a>

</div>

</button>

</form>
<style>

body{

font-family:Arial,sans-serif;
background:#f4f4f4;
padding:20px;

}

h1{

text-align:center;

}

.success{

background:#d4edda;
color:#155724;
padding:15px;
width:60%;
margin:20px auto;
text-align:center;
border-radius:8px;
font-weight:bold;

}

.top-bar{

display:flex;
justify-content:flex-end;
margin-bottom:20px;

}

.top-bar a{

background:green;
color:white;
padding:12px 20px;
text-decoration:none;
border-radius:5px;
font-weight:bold;

}

.container{

display:flex;
flex-wrap:wrap;
gap:20px;
justify-content:center;

}

.card{

width:250px;
background:white;
padding:15px;
border-radius:15px;
box-shadow:0 0 10px rgba(0,0,0,0.2);

}

.card img{

width:100%;
height:200px;
object-fit:cover;
border-radius:10px;

}

button{

width:100%;
padding:10px;
background:#007bff;
color:white;
border:none;
border-radius:5px;
cursor:pointer;

}

button:hover{

background:#0056b3;

}

</style>

</head>

<body>

<h1>Pastimes E-Clothing Store</h1>


<?php if($message != ""){ ?>

<div class="success">

✅ <?php echo $message; ?>

</div>

<?php } ?>


<div class="top-bar">

<a href="cart.php">

🛒 View Cart

</a>

</div>


<div class="container">

<?php foreach($products as $product){ ?>

<div class="card">

<img src="<?php echo $product['image']; ?>">

<h2>

<?php echo $product['name']; ?>

</h2>

<p>

<?php echo $product['description']; ?>

</p>

<p>

R <?php echo $product['price']; ?>

</p>

<p>

Stock:

<?php echo $product['stock']; ?>

</p>

<form method="POST">

<input type="hidden"

name="product_id"

value="<?php echo $product['id']; ?>">

<button

type="submit"

name="addcart">

Add To Cart

</button>

</form>

</div>

<?php } ?>

</div>

</body>

</html>