<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>

    <?php require_once("ext.php"); ?>

    <style>
        /* Slider */
        #slideShowImages {
            width: 900px;
            height: 450px;
            overflow: hidden;
            margin: 0 auto;
        }

        #slideShowImages img {
            width: 900px !important;
            height: 450px !important;
            object-fit: contain !important;
            display: block;
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Blue box/border remove */
        .inner-banner {
            display: none !important;
            border: none !important;
            background: none !important;
        }

        /* Responsive */
        @media (max-width: 950px) {
            #slideShowImages {
                width: 90%;
                height: auto;
            }

            #slideShowImages img {
                width: 100% !important;
                height: auto !important;
            }
        }
    </style>
</head>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<body>

<?php require_once("userheader.php"); ?>

<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Home</a>
        </li>

        <li class="breadcrumb-item active" aria-current="page">
            Index
        </li>
    </ol>
</nav>
<!-- //breadcrumbs -->


<!-- Welcome Heading -->
<center>
    <h2>Welcome to Home Page</h2>
</center>


<!-- Slider Start -->
<center>

    <div id="slideShowImages">

        <img src="uploads/download.png"
             alt="Slide 1">

        <img src="uploads/image 2.png"
             alt="Slide 2">

        <img src="uploads/image 3.png"
             alt="Slide 3">

        <img src="uploads/image 4.png"
             alt="Slide 4">

    </div>

</center>
<!-- Slider End -->


<script src="slideshow.js"></script>


<?php
if (isset($_SESSION["name"])) {
    $a = $_SESSION["name"];
}
?>


<?php require_once("footer.php"); ?>

</body>
</html>