<?php
session_start();
require_once("vars.php");
ob_start();

if(isset($_POST["s1"]))
{
    $conn = mysqli_connect(hname, uname, password, dbname) or die("Error in connection: " . mysqli_connect_error());

    $n = mysqli_real_escape_string($conn, $_POST["nm"]);
    $ph = mysqli_real_escape_string($conn, $_POST["ph"]);
    $msg = mysqli_real_escape_string($conn, $_POST["msg"]);

    $q = "INSERT INTO addprescription(name, phonenumber, medicines)
          VALUES('$n', '$ph', '$msg')";

    mysqli_query($conn, $q) or die("Error in query: " . mysqli_error($conn));

    $count = mysqli_affected_rows($conn);

    mysqli_close($conn);

    if($count == 1)
    {
        $message = "Prescription added successfully.";
    }
    else
    {
        $message = "Prescription could not be added.";
    }
}
?>

<html>
<head>
<title>Prescription</title>

<?php
require_once("ext.php");
?>

<script>
function checkphno(e)
{
    var a = e.keyCode || e.which;

    // Allow digits and Backspace
    if((a >= 48 && a <= 57) || a == 8)
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

<?php
require_once("docheader.php");
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
            Add Prescription
        </li>
    </ol>
</nav>

<!-- //breadcrumbs -->

<center>

<h2>Add Prescription</h2>
<br>

<form name="form1" method="post">

<input type="text"
       name="nm"
       placeholder="Enter Name"
       class="form-control"
       style="width:400px;"
       required>

<br>

<input type="text"
       name="ph"
       placeholder="Enter Phone Number"
       class="form-control"
       style="width:400px;"
       minlength="10"
       maxlength="10"
       onkeypress="return checkphno(event)"
       required>

<br>

<textarea name="msg"
          rows="5"
          class="form-control"
          style="width:400px;"
          placeholder="Your Advice / Medicines Prescribed..."
          required></textarea>

<br>

<input type="submit"
       name="s1"
       value="Submit"
       class="btn btn-primary">

</form>

<br>

<?php
if(isset($message))
{
    echo "<div class='alert alert-success'>$message</div>";
}
?>

</center>

<?php
require_once("footer.php");
?>

</body>
</html>