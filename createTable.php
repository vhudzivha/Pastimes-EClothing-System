<?php
include 'DBConn.php';

try {
    // Drop existing table
    $conn->exec("DROP TABLE IF EXISTS tblUser");
    $conn->exec("DROP TABLE IF EXISTS tblProducts");
    $conn->exec("DROP TABLE IF EXISTS tblOrders");

    // Create users table
    $sql = "CREATE TABLE tblUser (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        email VARCHAR(100) UNIQUE,
        username VARCHAR(50) UNIQUE,
        password VARCHAR(255),
        status VARCHAR(20) DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($sql);

    // Create products table
    $sql = "CREATE TABLE tblProducts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(200),
        description TEXT,
        price DECIMAL(10,2),
        category VARCHAR(100),
        image VARCHAR(500),
        stock INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($sql);

    // Create orders table
    $sql = "CREATE TABLE tblOrders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        product_id INT,
        quantity INT,
        total_price DECIMAL(10,2),
        order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES tblUser(id),
        FOREIGN KEY (product_id) REFERENCES tblProducts(id)
    )";
    $conn->exec($sql);

    // Insert sample products
    $products = [
        ["Classic T-Shirt", "Comfortable cotton t-shirt", 29.99, "Men", "https://via.placeholder.com/300", 50],
        ["Slim Fit Jeans", "Premium denim jeans", 79.99, "Men", "https://via.placeholder.com/300", 30],
        ["Floral Dress", "Beautiful summer dress", 59.99, "Women", "https://via.placeholder.com/300", 25],
        ["Leather Jacket", "Genuine leather jacket", 199.99, "Men", "https://via.placeholder.com/300", 15],
        ["Running Shoes", "Lightweight athletic shoes", 89.99, "Sports", "https://via.placeholder.com/300", 40]
    ];

    $stmt = $conn->prepare("INSERT INTO tblProducts (name, description, price, category, image, stock) VALUES (?, ?, ?, ?, ?, ?)");
    
    foreach($products as $product) {
        $stmt->execute($product);
    }

    echo "<div style='color: green; text-align: center; margin-top: 50px;'>";
    echo "<h2>✅ Tables created successfully!</h2>";
    echo "<p>Database structure initialized with sample products.</p>";
    echo "<a href='index.php' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px;'>Go to Homepage</a>";
    echo "</div>";

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
