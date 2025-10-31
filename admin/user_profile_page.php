<?php
session_start();    
// include ('../admin/connect.php')
//  #host, username, pwd, db name
        $servername="localhost";
        $username="root";
        $password="";
        $db="hotel";
        $conn= mysqli_connect( $servername,$username,$password,$db);
        if(!$conn){
            echo "<script>alert('fail to connect')</script>";
        };

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <Link rel="stylesheet" href="css\dashboard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include ('topnav.php');
    ?>

    <?php
    include ('sidebar.php');
    ?>

    <div class="big-container">
          <?php
            $id=$_SESSION['user_id'];
            $query="SELECT * FROM users WHERE id= $id";
            $obj= mysqli_query($conn, $query);
            $row = mysqli_fetch_array[$obj];
            
          
        ?>
        <div class="profile-cards">
          
            <strong>Name:<?php echo $row['u_name'];?></strong>
            <p>Email:<?php echo $row['email'];?></p>
        </div>
        <div class="profile-cards"> 
            <strong style="font-size:20px;">Profile settings</strong>
            <p>Country:<?php echo $row['u_country'];?></p>
            <p>city:<?php echo $row['u_city'];?></p>
            <p>Date:<?php echo $row['u_date_of_birth'];?></p>
            
        </div>
        <div class="profile-cards">
            <p>bio:<?php echo $row['u_address'];?></p>
        </div>
    </div>
    <style>
        body{
            width:100vw;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background-color:rgba(5, 5, 13, 0.67);
        }
        .big-container{
            display:flex;
           
            width:81%;
            height:50%;
            position:fixed;
            right:10px;
           justify-content:center;
           align-items:center;
           background:black;
            border-radius:5px;
           

        }
        .profile-cards{
            margin:3px;
            border-radius:5px;
            background:lightgray;
            width:25%;
            height:80%;
            padding:20px 10px;
            

            
           


        }

    </style>
</body>
</html>