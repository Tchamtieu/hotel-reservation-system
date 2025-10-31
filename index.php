<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <header>
       
        <nav>
             <div class="hotel-logo"style="width:50px;height:50px;border-radius:100%;background:yellow;text-align:center;color:black;"><h1>H</h1></div>
             
            <ul>
             <li><a href="">Home</a></li>
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
         
        <div class="banner">
            <h1>Welcome to Afrique Hotel</h1>
            <p style="color:white; font-weight:bold;"> Lorem ipsum dolor sit amet, consectetur adipisicing elit.  </p>
        </div>
         <div class="logout" >
            <button style="width:62px; position:absolute; right:20px; top:70px;"><a href="logout.php">logout</a></button>
         </div>

        <!-- banner form -->
        <form action="" class="banner-form" method="POST">
            <h5 style="color:black; font-weight:bold; text-align:center;"> search available rooms!</h5>
            <input type="date">
            <input type="date"  >
            <input type="number" placeholder="number of guests">
            <input type="text" placeholder="number of rooms">
            <button>Search availability</button>
        </form>
    </header>

    <!-- room section -->
    <section class="room-section">
        <h1 style="text-align:center;">ROOMS CATEGORIES</h1>
        <div class="room-container">
            <div class="room-card">
                <img src="images/room1.jpg" alt="">
                
                <div class="room-info">
                     <h3>suites</h3>
                     <p>Spacious, elegant, and perfect for relaxation.</p>
                     <p>price: 85000FCFA/night </p>
                     <button ><a href="#">book</a></button>
                </div>
               
            </div>
            <div class="room-card">
                <img src="images/room2.jpg" alt="">
                <div class="room-info">
                     <h3>deluxe rooms</h3>
                     <p>Comfortable and stylish rooms with modern amenities.</p>
                     <p>price: 55000FCFA/night </p>
                     <button ><a href="#">book</a></button>
                </div>
            </div>
            <div class="room-card">
                <img src="images/room6.jpg" alt="">
                <div class="room-info">
                     <h3>family rooms</h3>
                     <p>Spacious accommodations for the whole family.</p>
                     <p>price: 75000FCFA/night </p>
                     <button ><a href="#">book</a></button>
                </div>
            </div>
            <div class="room-card">
                <img src="images/room4.jpg" alt="">
                <div class="room-info">
                     <h3>standard rooms</h3>
                     <p>Cozy and affordable rooms for budget-conscious travelers.</p>
                     <p>price: 35000FCFA/night </p>
                     <button ><a href="#">book</a></button>
                </div>
            </div>
            <div class="room-card">
                <img src="images/room5.jpg" alt="">
                <div class="room-info">
                     <h3>presidential</h3>
                     <p>Comfortable and stylish rooms with modern amenities.</p>
                     <p>price: 100000FCFA/night </p>
                     <button ><a href="#">book</a></button>
                </div>
            </div>
                
        </div>
    </section>

    <!-- facilities section -->
    <section class="services-section">
          <h1  style="text-align:center;">FACILITIES</h1>
        <div class="services-container">
            
            <div class="services-card">
                <img src="images/pool.jpg" alt="">
                <div class="services-info">
                     <h3>POOL</h3>
                     <p>Enjoy a refreshing swim in our outdoor pool.</p>
                     <button ><a href="#">book</a></button>
                </div>
                
            </div>
            <div class="services-card">
                <img src="images/gym.jpg" alt="">
                <div class="services-info">
                     <h3>GYM</h3>
                     <p>Stay fit and active during your stay with our state-of-the-art gym facilities.</p>
                     <button ><a href="#">book</a></button>
                </div>
            </div>
            <div class="services-card">
                <img src="images/spa.jpg" alt="">
                <div class="services-info">
                     <h3>SPA</h3>
                     <p>Relax and rejuvenate with our luxurious spa treatments.</p>
                     <button ><a href="#">book</a></button>
                </div>
            </div>
            <div class="services-card">
                <img src="images/restaurant.jpg" alt="">
                <div class="services-info">
                     <h3>RESTAURANT</h3>
                     <p>Savor delicious cuisine at our on-site restaurant.</p>
                     <button ><a href="#">book</a></button>
                </div>
            </div>
            <div class="services-card">
                <img src="images/bar.jpg" alt="">
                <div class="services-info">
                     <h3>BAR</h3>
                     <p>Unwind with a drink at our stylish bar.</p>
                     <button ><a href="#">book</a></button>
                </div>
            </div>

        </div>
    </section>

    <!-- offers section -->
    </section>
    <section class="offers-section">
        <div class="offers-container">
            <div class="offers-cards">

            </div>
            <div class="offers-cards">

            </div>
            <div class="offers-cards">

            </div>
            <div class="offers-cards">

            </div>
            <div class="offers-cards">

            </div>
        </div>

    </section>

    <!-- events section -->
     <section class="events-section">
        <h1  style="text-align:center;">EVENTS</h1>
        <div class="event-container">
            <div class="event-card event1" style="background-color: rgb(189, 185, 185);">
              <img src="images/event1.jpg" alt="">
              <div class="event-content">
                <h1>Pool competition</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint officia id, delectus 
                    <button class="event-btn"> participate</button>
                </p>
              </div>
            </div>
            <div class="event-card event2" style="background-color: rgb(189, 185, 185);">
                  <img src="images/event2.jpg" alt="">
                   <div class="event-content">
                        <h1>Staff training</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint officia id, delectus 
                            <button class="event-btn"> participate</button>
                        </p>
              </div>
            </div>
            <div class="event-card event3" style="background-color: rgb(189, 185, 185);">
                  <img src="images/event3.jpg" alt="">
                   <div class="event-content">
                        <h1>Herver's and Malya marraige</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint officia id, delectus 
                            <button class="event-btn"> participate</button>
                        </p>
              </div>
            </div>
            <div class="event-card event4" style="background-color: rgb(189, 185, 185);">
                 <img src="images/event4.jpg" alt="">
                   <div class="event-content">
                        <h1>Tech conference</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint officia id, delectus 
                            <button class="event-btn"> participate</button>
                        </p>
              </div>
            </div>
            <div class="event-card event5" style="background-color: rgb(189, 185, 185);">
                    <img src="images/event5.jpg" alt="">
                   <div class="event-content">
                        <h1>Party</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint officia id, delectus 
                            <button class="event-btn"> participate</button>
                        </p>
              </div>
            </div>
            <div class="event-card event6" style="background-color: rgb(189, 185, 185);">

            </div>
            <div class="event-card event7" style="background-color: rgb(189, 185, 185);">

            </div>
           

            </div>
        </div>

    </section>

    <!-- feedback section -->
    <section class="feedback-section">
        <div class="feedback-container">
            <div class="feedback-card">

            </div>
        </div>

    </section>
    <footer>

    </footer>
</body>
</html>