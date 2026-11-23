<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>

    <?php
    require_once("ext.php");
    ?>
</head>

<body>

<?php
require_once("header.php");
?>

<!-- main image slider container -->
<div class="inner-banner"></div>
<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Login
        </li>
    </ol>
</nav>
<!-- //breadcrumbs -->

<center>
    <h2>Login Page</h2>
    <br>

    <form name="form1" method="post">

        <input type="text" name="em"
               placeholder="Enter Email or Username"
               required>
        <br><br>

        <input type="password" name="pass"
               placeholder="Enter Password"
               required>
        <br><br>

        <input type="submit" name="s1" value="Login">

    </form>
</center>

<?php
if(isset($_POST["s1"]))
{
    $un = $_POST["em"];
    $pass = $_POST["pass"];
    require_once("vars.php");

    $conn = mysqli_connect("localhost", "root", "", "hospital_db")
    or die("Error in connection: " . mysqli_connect_error());

    $qu = "SELECT * FROM signup WHERE username='$un'";

    $resu = mysqli_query($conn, $qu)
        or die("Error in query: " . mysqli_error($conn));

    $count = mysqli_num_rows($resu);

    if($count == 1)
    {
        $q = "SELECT * FROM signup WHERE username='$un' AND password='$pass'";

        $res = mysqli_query($conn, $q)
             or die("Error in query: " . mysqli_error($conn));

        $count1 = mysqli_num_rows($res);

        if($count1 == 1)
        {
            $ans = mysqli_fetch_array($res);

            // Creating Session
            $_SESSION["name"] = $ans["name"];
            $_SESSION["userid"] = $ans["userid"];
            $_SESSION["username"] = $ans["username"];

            if($ans["utype"] == "admin")
            {
                $_SESSION["utype"] = "admin";
                header("Location: admin.php");
                exit();
            }
            else
            {
                $_SESSION["utype"] = "user";
                header("Location: index.php");
                exit();
            }
        }
        else
        {
            echo "Wrong Email or Password!";
        }
    }
    else
    {
        $sql = "SELECT * FROM adddoc WHERE email='$un'";

        $resul = mysqli_query($conn, $sql)
                or die("Error in query: " . mysqli_error($conn));

        $count2 = mysqli_num_rows($resul);

        if($count2 == 1)
        {
            $q1 = "SELECT * FROM adddoc WHERE email='$un' AND password='$pass'";

            $res = mysqli_query($conn, $q1)
                  or die("Error in query: " . mysqli_error($conn));

            $count3 = mysqli_num_rows($res);

            if($count3 == 1)
            {
                $ans1 = mysqli_fetch_array($res);

                // Creating Session
                $_SESSION["name"] = $ans1["name"];
                $_SESSION["username"] = $ans1["email"];

                if($ans1["usertype"] == "Receptionist")
                {
                    $_SESSION["utype"] = "receptionist";
                    header("Location: recep.php");
                    exit();
                }
                else
                {
                    $_SESSION["utype"] = "doctor";
                    header("Location: doc.php");
                    exit();
                }
            }
            else
            {
                echo "Wrong Email or Password!";
            }
        }
        else
        {
            header("Location: signup.php");
            exit();
        }
    }
}
?>

<center>
    <p><a href="signup.php">Register Here</a></p>
</center>

<?php
require_once("footer.php");
?>

</body>
</html>