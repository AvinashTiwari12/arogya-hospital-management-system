<?php
session_start();
ob_start();
require_once("vars.php");

// DB Connection
$conn = mysqli_connect(hname, uname, password, dbname) or die("Error in connection: " . mysqli_connect_error());

// GET Data safely fetch kar rahe hain
$n      = isset($_GET["n"]) ? mysqli_real_escape_string($conn, trim($_GET["n"])) : "";
$ph     = isset($_GET["ph"]) ? mysqli_real_escape_string($conn, trim($_GET["ph"])) : "";
$add    = isset($_GET["add"]) ? mysqli_real_escape_string($conn, trim($_GET["add"])) : "";
$mode   = isset($_GET["mode"]) ? mysqli_real_escape_string($conn, trim($_GET["mode"])) : "";
$userid = isset($_GET["userid"]) ? mysqli_real_escape_string($conn, trim($_GET["userid"])) : "";
$fees   = isset($_GET["fees"]) ? mysqli_real_escape_string($conn, trim($_GET["fees"])) : "";
$did    = isset($_GET["did"]) ? mysqli_real_escape_string($conn, trim($_GET["did"])) : "";

$msg = "";

// PHP Processing (HTML output se PEHLE redirection ke liye)
if (isset($_POST["s1"])) {
    $hn = mysqli_real_escape_string($conn, trim($_POST["holder"]));
    $cn = mysqli_real_escape_string($conn, trim($_POST["cardno"]));
    $ed = mysqli_real_escape_string($conn, trim($_POST["expdate"]));
    $cv = mysqli_real_escape_string($conn, trim($_POST["cvvno"]));

    if (empty($hn) || empty($cn) || empty($ed) || empty($cv)) {
        $msg = "<p style='color:red;'>Error! Enter Details in all Fields.</p>";
    } else {
        $q = "INSERT INTO checkout(name, phoneno, address, paymode, docid, fees, userid) 
              VALUES ('$n', '$ph', '$add', '$mode', '$did', '$fees', '$userid')";
        
        if (mysqli_query($conn, $q)) {
            // Sahi aur accurate ID nikalne ke liye
            $appointid = mysqli_insert_id($conn); 
            header("Location: thxbooking.php?id=$appointid");
            exit();
        } else {
            $msg = "<p style='color:red;'>Problem while checkout, Try again.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Checkout - Payment</title>
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

<!-- main image slider container -->
<div class="inner-banner"></div>

<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
    </ol>
</nav>

<div style="text-align: center;">
    <h2>Pay and Checkout</h2> <br/>
    
    <?php if(!empty($msg)) echo $msg; ?>

    <form name="form1" method="post" action="">
        <div id="cardmode">
            <input type="text" name="holder" placeholder="Enter Holder Name" required><br/><br/>
            <input type="text" name="cardno" maxlength="16" minlength="16" placeholder="Enter Card No" required><br/><br/>
            <input type="text" name="expdate" placeholder="Enter Expiry Date (MM/YY)" required><br/><br/>
            <input type="text" name="cvvno" maxlength="3" minlength="3" placeholder="Enter CVV No" required><br/><br/>
        </div>
        <input type="submit" name="s1" value="Register" class="btn btn-primary">
    </form>
</div>

<?php
mysqli_close($conn);
require_once("footer.php");
?>
</body>
</html>