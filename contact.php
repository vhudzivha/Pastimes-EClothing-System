<?php

include 'DBConn.php';

$success = "";

if(isset($_POST['send'])){

$name = $_POST['name'];

$email = $_POST['email'];

$message = $_POST['message'];

$sql = "INSERT INTO tblmessages(name,email,message)

VALUES(?,?,?)";

$stmt = $conn->prepare($sql);

$stmt->execute([$name,$email,$message]);

$success = "Message sent successfully!";

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Contact Seller</title>

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

color:#333;

}

input,textarea{

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

background:#007bff;

color:white;

border:none;

border-radius:5px;

font-size:18px;

cursor:pointer;

}

.success{

background:#d4edda;

color:#155724;

padding:15px;

border-radius:5px;

text-align:center;

margin-bottom:20px;

}

</style>

</head>

<body>

<div class="container">

<h1>📩 Contact Seller</h1>

<?php if($success!=""){ ?>

<div class="success">

<?php echo $success; ?>

</div>

<?php } ?>

<form method="POST">

<input

type="text"

name="name"

placeholder="Your Name"

required>

<input

type="email"

name="email"

placeholder="Your Email"

required>

<textarea

name="message"

placeholder="Write your message here"

required>

</textarea>

<button

name="send"

type="submit">

Send Message

</button>

</form>

</div>

</body>

</html>