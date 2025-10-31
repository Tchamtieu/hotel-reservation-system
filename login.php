 
 <?php
 session_start();
    #host, username, pwd, db name
        $servername="localhost";
        $username="root";
        $password="";
        $db="hotel";
        $conn= mysqli_connect( $servername,$username,$password,$db);
        if(!$conn){
            echo "<script>alert('fail to connect')</script>";
        }
        // else{
        //     echo "<script> alert('connected successfully')</script>";
        // }
 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <title>Document</title>
</head>
<body>
    
    <form action="" method="POST" name="form">
        <h1>login!</h1>
        
            <label for="u_name">
                <input type="text" placeholder="enter your name" required name="u_name">
           
        </div>
        <div class="input">
           
                <input type="password" placeholder="password" required name="u_pass">
            
        </div>
       
            <button class="login_btn" name="login">login</button>
            <p>don't have an account yet? <a href="register.php">register</a></p>
        
    </form>
    
    <?php
    if(isset($_POST['login'])){

        $u_name= $_POST['u_name'];
        $u_pass= $_POST['u_pass'];
        $query= "SELECT  * FROM users where u_name='$u_name' 
        AND u_password='$u_pass'";
        $user_object= mysqli_query($conn, $query);
        $row=  mysqli_fetch_array($user_object);
        $id= $row['user_id'];
        $num_of_object= mysqli_num_rows($user_object);
       
         if($num_of_object == 1){
           $_SESSION['user_id']=$id;
            echo "<script>window.open('index.php', '_self');</script>";
         }
        else{
             echo "<script>alert('your email or password is incorrect, try again.');</script>";
        }
        
    }
    ?>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url(images/room2.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
         
        }
    </style>
</body>
</html>