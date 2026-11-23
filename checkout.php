<?php
session_start();
ob_start();
require_once("vars.php");

// Database Connection Ek Hi Baar Kholenge
$conn = mysqli_connect(hname, uname, password, dbname) or die("Error in connection: " . mysqli_connect_error());

// Form Processing Submitting Logic (HTML Se Pehle Taaki Header Redirection Mein Error Na Aaye)
$msg = "";
if (isset($_POST["s1"])) {
    $n = mysqli_real_escape_string($conn, $_POST["nm"]);
    $ph = mysqli_real_escape_string($conn, $_POST["ph"]);
    $add = mysqli_real_escape_string($conn, $_POST["add"]);
    $mode = mysqli_real_escape_string($conn, $_POST["mode"]);
    $userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
    $tm = mysqli_real_escape_string($conn, $_POST["tm"]);
    $d = mysqli_real_escape_string($conn, $_POST["dt"]);
    $did = mysqli_real_escape_string($conn, $_GET["docid"]);
    $depid = mysqli_real_escape_string($conn, $_GET["depid"]);
    $fees = mysqli_real_escape_string($conn, $_POST["fees"]);

    // Duplicate appointment check
    $q = "SELECT * FROM addappointment WHERE date='$d' AND timeid='$tm' AND docid='$did'";
    $res = mysqli_query($conn, $q) or die("Error in query: " . mysqli_error($conn));

    if (mysqli_num_rows($res) > 0) {
        $msg = "<div class='alert alert-danger'>Please choose a different time slot or date.</div>";
    } else {
        // Insert into addappointment
        $q_app = "INSERT INTO addappointment(userid, depid, docid, timeid, date) VALUES ('$userid', '$depid', '$did', '$tm', '$d')";
        mysqli_query($conn, $q_app) or die("Error in query: " . mysqli_error($conn));

        if ($mode == "cod") {
            // Insert into checkout
            $q_chk = "INSERT INTO checkout(name, phoneno, address, paymode, docid, fees, userid) VALUES ('$n', '$ph', '$add', '$mode', '$did', '$fees', '$userid')";
            if (mysqli_query($conn, $q_chk)) {
                $last_id = mysqli_insert_id($conn);
                header("Location: thxbooking.php?id=$last_id");
                exit();
            } else {
                $msg = "<div class='alert alert-danger'>Problem while booking appointment, try again.</div>";
            }
        } else {
            header("Location: checkoutcard.php?n=" . urlencode($n) . "&ph=" . urlencode($ph) . "&add=" . urlencode($add) . "&mode=" . urlencode($mode) . "&userid=" . urlencode($userid) . "&did=" . urlencode($did) . "&fees=" . urlencode($fees));
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <?php require_once("ext.php"); ?>
    <script>
    function checkphno(e) {
        var a = e.keyCode || e.which;
        if (a >= 48 && a <= 57) {
            return true;
        } else {
            return false;
        }
    }
    </script>
</head> 
<body>
<?php require_once("userheader.php"); ?>

<div class="inner-banner"></div>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
    </ol>
</nav>

<div class="container text-center">
    <h2>Checkout Page</h2> <br/>
    
    <?php if(!empty($msg)) echo $msg; ?>

    <?php
    $did = isset($_GET["docid"]) ? mysqli_real_escape_string($conn, $_GET["docid"]) : "";
    $fees = 0;
    if(!empty($did)) {
        $qu = "SELECT * FROM adddoc WHERE docid='$did'";
        $res = mysqli_query($conn, $qu) or die("Error in query: " . mysqli_error($conn));
        if(mysqli_num_rows($res) == 1) {
            $x = mysqli_fetch_array($res);
            $fees = $x["fees"];
            echo "<h4>Doctor Fees: ".$fees." RS/-</h4><br>";
        }
    }

    $uname = isset($_SESSION["username"]) ? mysqli_real_escape_string($conn, $_SESSION["username"]) : "";
    $x1 = array("Name" => "", "Phone" => "");
    if(!empty($uname)) {
        $qu1 = "SELECT * FROM signup WHERE username='$uname'";
        $res1 = mysqli_query($conn, $qu1) or die("Error in query: " . mysqli_error($conn));
        if(mysqli_num_rows($res1) > 0) {
            $x1 = mysqli_fetch_array($res1);
        }
    }
    ?>

    <form name="form1" method="post" action="">
        <input type="hidden" name="fees" value="<?php echo $fees; ?>">
        
        <input type="text" name="nm" value="<?php echo htmlspecialchars($x1["Name"]); ?>" placeholder="Enter Name" class="form-control col-md-6 offset-md-3" required><br/>
        
        <input type="text" name="ph" value="<?php echo htmlspecialchars($x1["Phone"]); ?>" placeholder="Enter Phone Number" class="form-control col-md-6 offset-md-3" required minlength="10" maxlength="10" onkeypress="return checkphno(event)"><br/>
        
        <label>Address</label><br/>
        <textarea name="add" rows="3" class="form-control col-md-6 offset-md-3" required></textarea><br/>
        
        <label>Payment Mode</label><br/>
        <label><input type="radio" class="mode" name="mode" value="cod" required> Pay on Appointment day</label>
        <label><input type="radio" class="mode" name="mode" value="dc" required> Debit Card</label>
        <label><input type="radio" class="mode" name="mode" value="cc" required> Credit Card</label><br/><br/>

        <h5>Choose Timeslot</h5>
        <select name="tm" class="form-control col-md-6 offset-md-3" required>
            <option value="">Choose Timeslot</option>
            <?php
            $qu2 = "SELECT * FROM managetime";
            $res2 = mysqli_query($conn, $qu2) or die("Error in query: " . mysqli_error($conn));
            if(mysqli_num_rows($res2) > 0) {
                while($ans = mysqli_fetch_array($res2)) {
                    echo "<option value='{$ans[0]}'>{$ans[1]}</option>";
                }
            } else {
                echo "<option value=''>No Time Slot Available</option>";
            }
            ?>
        </select><br/>

        <input type="date" name="dt" class="form-control col-md-6 offset-md-3" required><br/>
        
        <input type="submit" name="s1" value="Register" class="btn btn-success">
    </form>
</div>

<?php
mysqli_close($conn);
require_once("footer.php");
?>
</body>
</html>