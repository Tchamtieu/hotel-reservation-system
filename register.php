<?Php
    #host, username, pwd, db name
        $servername="localhost";
        $username="root";
        $password="";
        $db="hotel";
        $conn= mysqli_connect( $servername,$username,$password, $db);
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
    <title>register</title>
</head>
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
<body>

<!-- php -->
 
    <form action="" method="POST" class="registration_container" enctype="multipart/form-data">
        <h1>Register!</h1>
        <div class="input">
            <input type="text" placeholder="enter username" name="u_name" required>
        </div>
        <div class="input">
            <input type="email" placeholder="user email" name="u_email" required>
        </div>
        <div class="input">
            <input type="password" placeholder="user password" name="u_pass" required>
        </div>
        <div class="input">
            <input type="text"placeholder="firstname" name="u_fname" required>
        </div>
        <div class="input">
            <input type="text" placeholder="last name" name="u_lname" required>
        </div>
        <div class="input">
            <input type="text" placeholder="phone number" name="u_num" required>
        </div>
        <div class="input">
            <label for="" style="padding-left:10px">date od birth:</label>
            <input type="date" placeholder="date of birth" name="u_dob">
        </div>
        <div class="input">
            <textarea  id="" name="u_bio"> Your bio...</textarea>
        </div>
        <div class="input">
            <input type="file" placeholder="profile image" name="u_pict" >
        </div>
        <button name="register">register</button>
        <p>already have an acount? <a href="login.php">login</a></p>
    </form>

    <?php
    
    
      if(isset($_POST['register'])){
        $u_name =  $_POST['u_name'];
        $u_email =  $_POST['u_email'];
        $u_pass =  $_POST['u_pass'];
        $u_fname =  $_POST['u_fname'];
        $u_lname =  $_POST['u_lname'];
        $u_num =  $_POST['u_num'];
        $u_dob =  $_POST['u_dob'];
        $u_bio =  $_POST['u_bio'];
        $u_pict = $_FILES['u_pict']['name'];
        $u_pict_tmp =  $_FILES['u_pict']['tmp_name'];
       
        move_uploaded_file( $u_pict_tmp, "../images/$u_pict");
        $query= "INSERT INTO users (u_name, email, u_password, first_name, last_name, phone_number, date_of_birth, u_address, profile_image) 
        VALUES ('$u_name','$u_email','$u_pass','$u_fname','$u_lname','$u_num','$u_dob','$u_bio','$u_pict' )";
        if(mysqli_query($conn, $query)){
            echo "<script>window.open('login.php','_self')</script>";
        }
       
      }
    ?>
</body>
</html>