<?php
include 'DBConn.php';

if(file_exists("users.txt")){
    $file = fopen("users.txt", "r");
    $count = 0;
    
    while (($line = fgets($file)) !== false) {
        $data = explode(",", $line);
        
        if(count($data) >= 4){
            $name = trim($data[0]);
            $email = trim($data[1]);
            $username = trim($data[2]);
            $password = md5(trim($data[3]));
            
            try {
                $stmt = $conn->prepare("INSERT INTO tblUser (name, email, username, password, status) VALUES (?, ?, ?, ?, 'approved')");
                $stmt->execute([$name, $email, $username, $password]);
                $count++;
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage() . "<br>";
            }
        }
    }
    
    fclose($file);
    echo "<div style='text-align: center; margin-top: 50px;'>";
    echo "<h2 style='color: green;'>✅ Data loaded successfully!</h2>";
    echo "<p>$count users added to database.</p>";
    echo "<a href='index.php' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px;'>Go to Homepage</a>";
    echo "</div>";
} else {
    echo "<div style='text-align: center; margin-top: 50px; color: red;'>";
    echo "<h2>Error: users.txt file not found!</h2>";
    echo "<p>Please make sure users.txt exists in the same directory.</p>";
    echo "</div>";
}
?>