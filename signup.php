<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup Page</title>

    <?php require_once("ext.php"); ?>

    <script>
    function checkphno(e)
    {
        var a = e.keyCode || e.which;

        if(a >= 48 && a <= 57)
        {
            return true;
        }
        else if(a == 8 || a == 9 || a == 13)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    </script>

</head>

<body>

<?php require_once("header.php"); ?>

<!-- main image slider container -->
<div class="inner-banner"></div>

<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Signup
        </li>
    </ol>
</nav>
<!-- //breadcrumbs -->

<center>
    <h2>Signup Page</h2>
    <br>

    <form name="form1" method="post">

        <input type="text" name="nm" placeholder="Enter Name" required>
        <br><br>

        <input type="text" name="ph" placeholder="Enter Phone Number"
               required minlength="10" maxlength="10"
               onkeypress="return checkphno(event)">
        <br><br>

        <label>
            <input type="radio" name="gen" value="m" required> Male
        </label>

        <label>
            <input type="radio" name="gen" value="f" required> Female
        </label>

        <br><br>

        <input type="email" name="un" placeholder="Enter Email or Username" required>
        <br><br>

        <input type="password" name="pass" placeholder="Enter Password" required>
        <br><br>

        <input type="password" name="cpass" placeholder="Confirm Password" required>
        <br><br>

        <input type="submit" name="s1" value="Register">

    </form>

</center>

<?php

if(isset($_POST["s1"]))
{
    $n = $_POST["nm"];
    $ph = $_POST["ph"];
    $gen = $_POST["gen"];
    $un = $_POST["un"];
    $pass = $_POST["pass"];
    $cpass = $_POST["cpass"];
    $utype = "user";

    if($pass != $cpass)
    {
        die("Password and Confirm Password do not match.");
    }

    require_once("vars.php");

    $conn = mysqli_connect(hname, uname, password, dbname)
            or die("Error in connection : " . mysqli_connect_error());

    $q = "INSERT INTO signup(name,phone,gender,username,password,utype)
          VALUES('$n','$ph','$gen','$un','$pass','$utype')";

    mysqli_query($conn, $q)
            or die("Error in query : " . mysqli_error($conn));

    $count = mysqli_affected_rows($conn);

    mysqli_close($conn);

    if($count == 1)
    {
        header("Location: thx.php");
        exit();
    }
    else
    {
        echo "Problem while signing up. Try again.";
    }
}

?>

<?php require_once("footer.php"); ?>

</body>
</html>