<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
    <?php require_once("ext.php"); ?>
</head>

<body>

<?php
if(isset($_SESSION["utype"]) && $_SESSION["utype"] == "doctor")
    require_once("docheader.php");
else
    require_once("repcheader.php");
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
            User Details
        </li>
    </ol>
</nav>

<section>
<div class="container">

    <h2 align="center">Search Appointment by Date</h2>
    <br>

    <div class="row">
        <div class="col-sm-7 mx-auto">

            <form method="post">

                <input type="date" name="date" class="form-control" required>

                <br>

                <input type="submit" name="s2" class="btn btn-primary" value="Go">

            </form>

            <br>

            <h2>User Details</h2>

<?php

if(isset($_POST["s2"]))
{

    if(!empty($_POST["date"]))
    {

        $a = $_POST["date"];
        $b = date("Y-m-d", strtotime($a));

        require_once("vars.php");

        $conn = mysqli_connect(hname, uname, password, dbname);

        if(!$conn)
        {
            die("Connection Failed : " . mysqli_connect_error());
        }

        $q = "SELECT * FROM addappointment WHERE date='$b'";

        $res = mysqli_query($conn, $q);

        if(!$res)
        {
            die("Query Error : " . mysqli_error($conn));
        }

        $count = mysqli_num_rows($res);

        if($count > 0)
        {

            echo "<table class='table table-striped table-bordered'>";
            echo "<tr>";
            echo "<th>Name</th>";
            echo "<th>Phone No</th>";
            echo "<th>Appointment Time</th>";
            echo "</tr>";

            while($ud = mysqli_fetch_assoc($res))
            {

                $uid = $ud["userid"];
                $did = $ud["docid"];
                $tid = $ud["timeid"];

                // User
                $q1 = "SELECT * FROM signup WHERE userid='$uid'";
                $res1 = mysqli_query($conn,$q1);
                $ans = mysqli_fetch_assoc($res1);

                // Doctor
                $q2 = "SELECT * FROM adddoc WHERE docid='$did'";
                $res2 = mysqli_query($conn,$q2);
                $ans1 = mysqli_fetch_assoc($res2);

                // Time Slot
                $q3 = "SELECT * FROM managetime WHERE timeid='$tid'";
                $res3 = mysqli_query($conn,$q3);
                $ans2 = mysqli_fetch_assoc($res3);

                echo "<tr>";

                echo "<td>";
                echo isset($ans["Name"]) ? $ans["Name"] : "";
                echo "</td>";

                echo "<td>";
                echo isset($ans["Phone"]) ? $ans["Phone"] : "";
                echo "</td>";

                echo "<td>";
                echo isset($ans2["slotname"]) ? $ans2["slotname"] : "";
                echo "</td>";

                echo "</tr>";

            }

            echo "</table>";

        }
        else
        {
            echo "<div class='alert alert-danger'>";
            echo "No appointment found.";
            echo "</div>";
        }

        mysqli_close($conn);

    }
    else
    {
        echo "<div class='alert alert-warning'>";
        echo "Please select a date.";
        echo "</div>";
    }

}

?>

        </div>
    </div>

</div>
</section>

<?php
require_once("footer.php");
?>

</body>
</html>