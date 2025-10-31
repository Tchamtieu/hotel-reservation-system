<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/bootstrap-icons.svg" rel="stylesheet">
   
</head>
<body>
    <nav class="sidebar">
        <ul>
           
           
            <li><a href="../admin/dashboard.php">dashbord</a></li>
            <li><a href="../admin/gallery.php">gallery</a></li>
            <li><a href="../admin/bookings.php">bookings</a></li>
            <li><a href="../admin/payment.php">payments</a></li>
            <li><a href="../admin/staff.php">staff</a></li>
            <li><a href="../admin/guest.php">guests</a></li>
            <li><a href="../admin/calender.php">calender</a></li>
            <li><a href="../admin/dashboard.php">prof</a></li>
                
        </ul>
    </nav>
    <style>
        :root{

        }
       .sidebar{
        height:100vh;
        width:250px;
        position:fixed;
        /* top: -10%; */
        left:0;
        border-top:blue solid 4px;
        background-color:black;
        color:#fff;
        padding-top:20px;
        border-radius:0 5px 5px 0;
       
       }
       .sidebar ul{
        border-bottom:1px solid #495057;
      
        display:block;
        padding:0;
       
       }
       .sidebar ul li{
        list-style:none;
        padding:15px 20px;
        /* background-color:red; */
        margin-left:none;
       }
         .sidebar ul li a{
          color:#fff;
          text-decoration:none;
          font-size:16px;
          display:block;
          transition:ease-in 0.3s;
         }
          .sidebar ul li a:hover{
            transition:0.3s;
            background-color:#495057;
            border-radius:4px;
            padding-left:25px;
            padding-top:10px;
            padding-bottom:10px;
            
          }

           
    </style>
</body>
</html>