<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Our Services - FlyHigh</title>
  <link rel="stylesheet" href="services.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header class="header">
    <div class="logo">FlyHigh</div>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="services.php">Services</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="login.php">Log In</a></li>
      <li><a href="signup.php">Sign Up</a></li>
    </ul>
  </header>

  <section class="services-section">
    <h2>Our Services</h2>
    <div class="services-container">
      <?php
      $destinations = [
        ['Rome', 'img/Temple-of-Saturn-Arch-Septimius-Severus-Forum.webp', 'Experience the rich history and culture of Rome.'],
        ['Paris', 'img/paris-city-lights.jpg', 'Explore the romantic city of Paris.'],
        ['New York', 'img/HH_NEWYORK_shutterstock_1740358463.png', 'Discover the vibrant city of New York.'],
        ['Safari', 'img/safari-truck-giraffes-micato-safaris-SAFARIGUIDETIPS0721-2549bb165aa34dc193cb8b6f3958654b.jpg', 'Embark on an adventurous safari.'],
        ['Beijing', 'img/banner-beijing.jpg', 'Visit Beijing to explore its rich history.'],
        ['Riyadh', 'img/crowne-plaza-riyadh-7599728729-2x1.avif', 'Experience the vibrant culture of Riyadh.'],
        ['Madrid', 'img/madrid-daytime-town-square-cityscape-wallpaper-preview.jpg', 'Immerse yourself in Madrid\'s art scene.']
      ];

      
      foreach ($destinations as $destination) {
          echo '
          <div class="service-item">
            <img src="' . $destination[1] . '" alt="' . $destination[0] . '" class="service-image">
            <h3>' . $destination[0] . '</h3>
            <p>' . $destination[2] . '</p>
            <form action="services.php" method="post">
              <input type="hidden" name="destination" value="' . $destination[0] . '">
              <label for="name">Name:</label>
              <input type="text" name="name" required>
              <label for="email">Email:</label>
              <input type="email" name="email" required>
              <button type="submit" class="book-btn">Book Now</button>
            </form>
          </div>';
      }
      ?>
    </div>
  </section>

  <?php
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $destination = $_POST['destination'];
      $name = $_POST['name'];
      $email = $_POST['email'];

      
      $conn = new mysqli('localhost', 'root', '', 'flyhigh');

      if ($conn->connect_error) {
          die('Connection failed: ' . $conn->connect_error);
      }

      
      $stmt = $conn->prepare('INSERT INTO bookings (destination, user_name, user_email) VALUES (?, ?, ?)');
      $stmt->bind_param('sss', $destination, $name, $email);

      if ($stmt->execute()) {
          echo '<script>alert("Booking successful!");</script>';
      } else {
          echo '<script>alert("Booking failed. Please try again.");</script>';
      }

      $stmt->close();
      $conn->close();
  }
  ?>

  <script src="scripts.js"></script>
</body>
</html>
