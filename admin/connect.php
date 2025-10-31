<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

$server="localhost";
$username="root";
$password="";
$database="hotel";
$conn=mysqli_connect($server,$username,$password,$database);
if(!$conn){
    die("error".mysqli_connect_error());
}

?>
</body>
</html>