<?php
session_start();
ob_start();
require_once("vars.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Book Appointment</title>
<?php require_once("ext.php"); ?>
</head>
<body>
<?php
if(isset($_SESSION["userid"]))
    require_once("userheader.php");
else
    require_once("recpheader.php");

// Database connection
$conn = mysqli_connect(hname, uname, password, dbname) 
        or die("Error in connection: " . mysqli_connect_error());
?>

<!-- main image slider container -->
<div class="inner-banner"></div>

<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Appointment</li>
    </ol>
</nav>

<section>
<div class="container">
    <h2 align="center">View Appointment</h2> <br/>
    <div class="container">
        <div class="col-sm-7" style="margin:auto;">
            <form name="form1" method="post" action="">
                
                <h5>Choose Department</h5> <br/>
                <select name="dep" class="form-control" onchange="this.form.submit()">
                    <option value="">Choose Department</option>
                    <?php
                    $selected_dep = isset($_POST["dep"]) ? $_POST["dep"] : "";
                    
                    $qu = "SELECT * FROM managedep";
                    $res = mysqli_query($conn, $qu) or die("Error in query: " . mysqli_error($conn));

                    if(mysqli_num_rows($res) > 0) {
                        while($ans = mysqli_fetch_array($res)) {
                            $selected = ($selected_dep == $ans[0]) ? "selected" : "";
                            echo "<option value='{$ans[0]}' {$selected}>{$ans[1]}</option>";
                        }
                    } else {
                        echo "<option value=''>No Departments Available</option>";
                    }
                    ?>
                </select>
                <br/>

                <h5>Choose Doctor</h5>
                <select name="doc" class="form-control">
                    <option value=""> Choose Doctor </option>
                    <?php
                    if(!empty($selected_dep)) {
                        $dep_safe = mysqli_real_escape_string($conn, $selected_dep);
                        $qul = "SELECT * FROM adddoc WHERE depid='$dep_safe' AND usertype='Doctor'";
                        $res1 = mysqli_query($conn, $qul) or die("Error in query: " . mysqli_error($conn));

                        if(mysqli_num_rows($res1) > 0) {
                            while($ans1 = mysqli_fetch_array($res1)) {
                                echo "<option value='{$ans1[0]}'>{$ans1[2]}</option>";
                            }
                        } else {
                            echo "<option value=''>No Doctor Available</option>";
                        }
                    }
                    ?>
                </select>
                <br/> <br/>
                <input type="submit" name="s1" value="Submit" class="btn btn-primary">

                <?php
                if(isset($_POST["s1"])) {
                    $dep = $_POST["dep"];
                    $doc = $_POST["doc"];
                    if(empty($dep) || empty($doc)) {
                        echo "<p class='text-danger mt-2'>Please select both options above.</p>";
                    } else {
                        header("Location: checkout.php?docid=$doc&depid=$dep");
                        exit();
                    }   
                }
                ?>
            </form>
        </div>
    </div>
</div>
</section>

<?php
mysqli_close($conn);
require_once("footer.php");
?>
</body>
</html>