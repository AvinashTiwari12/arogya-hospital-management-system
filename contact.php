<?php
// Database Connection
$conn = mysqli_connect('localhost', 'root', '123', 'hospital_db');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$success_msg = "";
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Database insert query matching your phpMyAdmin table columns
    $query = "INSERT INTO contact_us (name, phone, email, subject, message) VALUES ('$name', '$phone', '$email', '$subject', '$message')";
    
    if (mysqli_query($conn, $query)) {
        $success_msg = "Message sent successfully!";
    } else {
        $success_msg = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arogya - Contact Us</title>
    <link rel="stylesheet" href="style.css?v=2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header Section -->
    <header class="navbar">
        <div class="logo">AROGYA</div>
        <nav>
            <a href="#">Home</a>
            <a href="#">Contact</a>
            <a href="#">User Account <i class="fa-solid fa-angle-down"></i></a>
        </nav>
    </header>

    <!-- Banner Image Section -->
    <div class="banner">
        <img src="doctor-image.jpg" alt="Doctor Banner">
    </div>

    <!-- Main Container -->
    <div class="contact-container">
        <div class="breadcrumb">
            <a href="#">Home</a> / <span>Contact Us</span>
        </div>

        <div class="section-title">
            <h2>Contact Us</h2>
            <p>Get in Touch with Us</p>
            <p class="subtitle">If you have any questions, feedback, or need assistance, feel free to contact us. Our team is always ready to help you.</p>
        </div>

        <?php if($success_msg != ""): ?>
            <p style="text-align:center; color: green; font-weight: bold; margin-bottom: 20px;"><?php echo $success_msg; ?></p>
        <?php endif; ?>

        <div class="contact-grid">
            <!-- Contact Form -->
            <div class="form-box">
                <h3>Contact Form</h3>
                <form action="" method="POST">
                    <div class="input-row">
                        <input type="text" name="name" placeholder="Enter Name" required>
                        <input type="text" name="phone" placeholder="Enter Phone Number" required>
                    </div>
                    <div class="input-row">
                        <input type="email" name="email" placeholder="Enter Email" required>
                        <input type="text" name="subject" placeholder="Enter Subject" required>
                    </div>
                    <div class="input-full">
                        <textarea name="message" rows="4" placeholder="Your Message..." required></textarea>
                    </div>
                    <button type="submit" name="submit" class="send-btn">Send Message</button>
                </form>
            </div>

            <!-- Contact Information & Socials -->
            <div class="info-box">
                <h3>Contact Information</h3>
                <ul>
                    <li><i class="fa-solid fa-location-dot"></i> Model Town, Ludhiana, India</li>
                    <li><i class="fa-solid fa-phone"></i> +91-9876843210</li>
                    <li><i class="fa-solid fa-envelope"></i> info@arogya.com</li>
                </ul>

                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="#" class="facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="twitter"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" class="google"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="pinterest"><i class="fa-brands fa-pinterest-p"></i></a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>