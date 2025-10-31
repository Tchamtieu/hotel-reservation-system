<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <nav class="topnav">
        <div class="hotel-logo">
            <p >Afrique hotel</p>
        </div>
       <div class="right-side">
            <div class="search">
                <input type="search" placeholder="search...">
                <button class="search-btn">search</button>
            </div>
            <div class="notification">
                <i class=""></i>
            </div>
            <div class="user-info">
                    <img src="..images/room4.jpg" alt="" width="50px" height="50px" style="border-radius:50%;">
                       <p class="dropdown-p" style="padding-left:10px;">Admin</p>
                    <div class="dropdown">
                    
                        <div class="dropdown-content">
                            <a href="user_profile_page.php">Profile</a>
                            <a href="">Settings</a>
                            <a href="../login.php">Logout</a>
                        </div>
                    </div>

                        
            </div>
       </div>
    </nav>
    <style>
         .search-btn{
            padding:5px 10px;
            border-radius:5px;
            border:none;
            background-color:#007bff;
            color:#fff;
         }
         input[type="search"]:focus{
           outline:none;
         }
         .search-btn:hover{
            background-color:#0056b3;
            cursor:pointer;
         }
         
        /* dropdown */
        .dropdown{
            top:40px;
            right:35px;
            /* background:red; */
            position:absolute;
            display:inline-block;
            /* margin:10px; */
          
         }
         .right-side{
            padding: 20px;
            margin-right:30px;
         }
        
         .user-info{
            /* background:red; */
            display:inline;
            margin-right:20px;
         }
         .dropdown-content{
            padding:10px;
            top:0px;
            display:none;
            border-radius:10px;
            position:relative;
            background-color:#f9f9f9;
            min-width:160px;
            box-shadow:0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index:1;
           
         }
         .dropdown-content a{
            color:black;
            padding:12px 16px; 
            text-decoration:none;
            display:block;
         }
         .dropdown-content a:hover{
            background-color:#f1f1f1;
            border-radius:10px;
            display:block;
         }
          .user-info:hover .dropdown-content, .dropdown, .dropdown-content a{
            display:block;
        }

        /* dropdown end  */

         .topnav{
          height:65px;
          width:100%;
          position:fixed;
         
          top:0;
          left:0;
          background-color:rgba(0,0,0);
          color:#fff;
          display:flex;
          justify-content:space-between;
          align-items:center;
          padding:0 40px;
         
         }
         .hotel-logo p{
          font-size:20px;
          font-weight:bold;
         }
         .right-side{
          display:flex;
          align-items:center;
          gap:20px;
         }
         .search input[type="search"]{
          padding:5px 10px;
          border-radius:5px;
          border:none;
         }
         .user-info{
          display:flex;
          align-items:center;
          gap:10px;
         }
         .search-btn{
            background:blue;
         }
    </style>
</body>
</html>