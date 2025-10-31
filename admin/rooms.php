<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <?php
    
    include('sidebar.php');
    include('topnav.php');
    
    ?>

     <div class="big-container">
        <div class="card-container">
            <div class="card">
                <img src="../images/room5" alt="" class="card-img" width="50%" height="100%" >
                <div class="card-content">
                    <h3>Deluxe</h3>
                     
                    <span>occupied</span>
                    <div class="card-btns">
                        <button  >DELETE</button>
                        <button>EDIT</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="../images/room1" alt="" class="card-img" width="50%" height="100%" >
                <div class="card-content">
                    <h3>Deluxe</h3>
                    
                    <span>occupied</span>
                    <div class="card-btn">
                        <button>DELETE</button>
                        <button>EDIT</button>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="../images/room4" alt="" class="card-img" width="50%" height="100%" >
                <div class="card-content">
                    <h3>Deluxe</h3>
                    
                    <span>occupied</span>
                    <div class="card-btn">
                        <button>DELETE</button>
                        <button>EDIT</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="small-container">
            <form action="">
                <div >
                    <select class="input" name="" id="" >
                    <option value="">Deluxe</option>
                    <option value="">Suite</option>
                    <option value="">Standard</option>
                </select>
                </div>
                <div>
                     <input  class="input" type="number">
                </div>
               
                <div>
                    <textarea  class="input" name="" id="" rows="5" columns="11">description...</textarea>
                </div>
                <div>
                     <button  class="input">ADD ROOM</button>
                </div>
                
                 <div class="small-card-container">
                    <div class="card simple-card">
                        <h3>Total rooms</h3>
                        <h3>10</h3>
                    </div>
                 </div>
            </form>
        </div>
     </div>
     <style>
        :root{
          
        }
      
       .card-container{
        display:block;
        width:100%;
        width:100%;
        background-color:pink;

      

        
       }
        .big-container{
            top:9%;
            display:flex;
           
            width:82%;
            height:100%;
            position:fixed;
            right:10px;
           justify-content:center;
            border-radius:5px;
        }
        .card{
           display:flex;
           flex-direction:row;
            width:50%;
            height:150px;
            margin:10px;
            background:black;
            color:white;
        }
        .card img{
            width:50%;
            height:85%;
            border-radius:5px;
           margin:10px;

        }
        .card .card-content{
            display:block;
            width:50%;
            height:100%;
            
            padding:10px;
        }
       button{
            padding:5px 10px;
            background:blue;
            color:white;
            border-radius:10px;
        }
        .small-card-container{
            height:100%;
            width:50%;
        }
        form{
            display:block;
            width:70%;
            height:50%;
            backdrop-filter:blur(5px);
            box-shadow: 5px 5px 5px black;
        }
      .input{
        width:100%;
        border-radius:5px;
        margin:5px;


      }
     </style>
</body>
</html>