<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
    <?php require_once("ext.php"); ?>
</head>
<body>
<?php require_once("userheader.php"); ?>

<!-- main image slider container -->
<div class="inner-banner"></div>

<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Thanks</li>
    </ol>
</nav>
<!-- //breadcrumbs -->

<div class="text-center my-4">
    <h2>Your Appointment Booked Successfully</h2>
    <h4>
        Your Appointment No : 
        <?php 
            // Check if 'id' exists and escape it to prevent XSS
            echo isset($_GET["id"]) ? htmlspecialchars($_GET["id"], ENT_QUOTES, 'UTF-8') : 'N/A'; 
        ?>
    </h4>
</div>

<?php require_once("footer.php"); ?>
</body>
</html>