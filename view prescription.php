<?php
session_start();
?>
<html>
<head>
<title>User Details</title>
<?php
require_once("ext.php");
?>
</head>

<body>

<?php
require_once("userheader.php");
?>

<!-- main image slider container -->
<div class="inner-banner">
</div>

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

        <h2 align="center">Search Prescription by Name</h2>
        <br>

        <div class="col-sm-7" style="margin:auto;">

            <form name="form1" method="post">

                <input type="text" name="un" class="form-control" placeholder="Enter Name" required>

                <br>

                <input type="submit" name="s2" class="btn btn-primary" value="Go">

            </form>

            <br>

            <h2>User Details</h2>

<?php

if(isset($_POST["s2"]))
{
    require_once("vars.php");

    $conn = mysqli_connect(hname, uname, password, dbname);

    if(!$conn)
    {
        die("Connection Failed : " . mysqli_connect_error());
    }

    $a = mysqli_real_escape_string($conn, $_POST["un"]);

    $q = "SELECT * FROM addprescription WHERE name='$a'";

    $res = mysqli_query($conn, $q);

    if(!$res)
    {
        die("Query Error : " . mysqli_error($conn));
    }

    $count = mysqli_num_rows($res);

    if($count > 0)
    {
        echo "<table class='table table-striped table-bordered'>
                <tr>
                    <th>Name</th>
                    <th>Phone No</th>
                    <th>Advice / Medicine Prescribed</th>
                </tr>";

        while($row = mysqli_fetch_assoc($res))
        {
            echo "<tr>
                    <td>".$row["name"]."</td>
                    <td>".$row["phonenumber"]."</td>
                    <td>".$row["medicines"]."</td>
                  </tr>";
        }

        echo "</table>";
    }
    else
    {
        echo "<div class='alert alert-danger'>No Details Found.</div>";
    }

    mysqli_close($conn);
}

?>

        </div>

    </div>

</section>

<?php
require_once("footer.php");
?>

</body>
</html>