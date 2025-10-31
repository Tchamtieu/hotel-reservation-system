<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    
    <title>Document</title>
</head>
<body>

 <nav>
     <div class="hotel-logo"style="width:50px;height:50px;border-radius:100%;background:yellow;text-align:center;color:black;"><h1>H</h1></div>
             
            <ul>
             <li><a href="index.php">Home</a></li>
             <li><a href="">Rooms</a></li>
             <li><a href="">Services</a></li>
             <li><a href="admin\dashboard.php">dashboard</a></li>
             <li><a href="gallery.php">gallery</a></li>
             <li><a href="">Events</a></li>
             <li><a href="">Offers</a></li>
             <li><a href="">About</a></li>
             <button ><a href="login.php">login</a></button>
            </ul>
           
    </nav>


    <diiv class="search" style="display:flex; justify-content:end;">
        <input type="search" placeholder="search..." style="width:50%;">
        <button style="width:10%;">search</button>
    </diiv>
    <div class="categories">
      <a href="#suite-rooms">suites</a><a href=".delux-rooms">deluxe</a><a href="">standard</a><a href="">single</a><a href="">restaurant menu</a><a href="">spa services</a>
    </div>

    <h1>GALLERY</h1>
    <h2>SUITES</h2>
    <section class="suite-rooms">
        <div class=" suite room1" style="background:pink;">
            <img src="images\room7.jpg" alt="">
        </div>
        <div class="suite room2" style="background:black;">
             
        </div>
        <div class="suite room3" style="background:steelblue;"></div>
        <div class="suite room4" style="background:red;"></div>
        <div class="suite room5" style="background:purple;"></div>
        <div class="suite room6" style="background:yellow;"></div>
        <div class="suite room7" style="background:green;"></div>
        <div class="suite room8" style="background:lightgray;"></div>
        <div class="suite room9" style="background:brown;"></div>
        <div class="suite room10" style="background:orange;"></div>
    </section>

    <h2>DELUXE ROOMS</h2>
    <section class="deluxe-rooms">
          <div class=" suite room1" style="background:pink;"></div>
        <div class="suite room2" style="background:black;"></div>
        <div class="suite room3" style="background:steelblue;"></div>
        <div class="suite room4" style="background:red;"></div>
        <div class="suite room5" style="background:purple;"></div>
        <div class="suite room6" style="background:yellow;"></div>
        <div class="suite room7" style="background:green;"></div>
        <div class="suite room8" style="background:lightgray;"></div>
        <div class="suite room9" style="background:brown;"></div>
        <div class="suite room10" style="background:orange;"></div>
    </section>
    <section class="standard">

    </section>
    <style>
        body{
            width:100vw;
            height:150vh;
        }
        .suite-rooms, .deluxe-rooms{
            display:grid;
            width:100%;
           height:50%;
            grid-template-columns: repeat(5,1fr);
            gap:10px;
          
        }
        .suite{
              border-radius:10px;
             
            
        }
        .suite img{
            width:93%;
            height:95%;
            border-radius:10px;
            margin:10px;

        }
        .room1{
            grid-row: span 2;
        }
        .room2{
            grid-column:span 2;
        }
         .room6{
            grid-row: span 2;
         }
         .categories a{
          margin:10px;
            text-decoration:none;
            color:gray;
            background:rgba(175, 208, 212, 0.52);
             border-radius:10px;
             padding:5px 15px;
         }
         .categories{
            display:flex;
            margin:10px;
            color:gray;
         }
         .categories a:hover{
            color:black;
           
         }
    </style>
</body>
</html>