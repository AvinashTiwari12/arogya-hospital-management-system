<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>User Details</title>

<?php
require_once("ext.php");
?>

</head>
<body>

<?php
require_once("recpheader.php");
?>

<!-- main image slider container -->
<div class="inner-banner"></div>

<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            User Details
        </li>
    </ol>
</nav>

<section>
<div class="container">

<h2 align="center">User Details</h2>
<br>

<div class="container">
<div class="col-sm-7" style="margin:auto;">

<form method="post">

<input type="text"
name="un"
class="form-control"
placeholder="Enter Username"
required>

<br>

<input type="submit"
name="s2"
class="btn btn-primary"
value="Go">

<br><br>

<?php

if(isset($_POST["s2"]))
{

    $a = trim($_POST["un"]);

    require_once("vars.php");

    $conn = mysqli_connect(hname,uname,password,dbname)
    or die("Error in connection : ".mysqli_connect_error());

    $q = "SELECT * FROM signup WHERE username='$a'";

    $res = mysqli_query($conn,$q)
    or die("Error in query : ".mysqli_error($conn));

    $count = mysqli_num_rows($res);

    if($count==1)
    {

        $ud = mysqli_fetch_array($res);

        $uid = $ud["userid"];

        echo "<h3>User Details</h3>";

        echo "<table class='table table-bordered'>

        <tr>
        <th>Name</th>
        <td>".$ud["Name"]."</td>
        </tr>

        <tr>
        <th>Phone</th>
        <td>".$ud["Phone"]."</td>
        </tr>

        <tr>
        <th>Gender</th>
        <td>".$ud["Gender"]."</td>
        </tr>

        <tr>
        <td colspan='2' align='center'>
        <a class='btn btn-success'
        href='bookappointment.php?userid=$uid'>
        Book Appointment
        </a>
        </td>
        </tr>

        </table>";

    }
    else
    {
        echo "<div class='alert alert-danger'>
        User not found.
        </div>";
    }

    mysqli_close($conn);

}

?>

</form>

</div>
</div>

</div>
</section>

<?php
require_once("footer.php");
?>

</body>
</html>