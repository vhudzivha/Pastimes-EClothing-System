<?php
session_start();
include 'DBConn.php';

$products = $conn->query("SELECT * FROM tblProducts")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Pastimes Clothing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: #f4f6f9;
        }
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .product-image {
            height: 250px;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .product-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }
        .product-info {
            padding: 20px;
        }
        .price {
            font-size: 1.5rem;
            color: #667eea;
            font-weight: bold;
        }
        nav {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-tshirt"></i> Pastimes E-Clothing
            </a>
            <div class="ms-auto">
                <?php if(isset($_SESSION['username'])): ?>
                    <span class="text-white me-3">Welcome, <?php echo $_SESSION['username']; ?></span>
                    <a href="home.php" class="btn btn-outline-light btn-sm">Dashboard</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-light btn-sm">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Our Products</h2>
        <div class="row">
            <?php foreach($products as $product): ?>
            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-image">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    </div>
                    <div class="product-info">
                        <h5><?php echo $product['name']; ?></h5>
                        <p class="text-muted"><?php echo $product['description']; ?></p>
                        <p class="price">$<?php echo number_format($product['price'], 2); ?></p>
                        <p><small>Category: <?php echo $product['category']; ?></small></p>
                        <button class="btn btn-primary w-100">Add to Cart</button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>