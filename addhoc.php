<?php
session_start();
?>
<html>
<head>
<title>Add Staff</title>

<?php
require_once("ext.php");
?>

<script>
function checkphno(e)
{
    var a = e.which || e.keyCode;

    if(a >= 48 && a <= 57)
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
require_once("adminheader.php");
?>

<div class="inner-banner"></div>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Add Staff
        </li>
    </ol>
</nav>

<center>
<h2>Add Staff</h2><br/>
</center>

<center>

<form name="form1" method="post">

<h5>Choose Department</h5>

<select name="dep" required>
<option value="">Choose</option>

<?php

require_once("vars.php");

$conn=mysqli_connect(hname,uname,password,dbname)
or die("Error in connection ".mysqli_connect_error());

$qu="select * from managedep";

$res=mysqli_query($conn,$qu)
or die("Error in query ".mysqli_error($conn));

while($ans=mysqli_fetch_array($res))
{
    echo "<option value='$ans[0]'>$ans[1]</option>";
}

mysqli_close($conn);

?>

</select>

<br><br>

<input type="text" name="nm" placeholder="Enter Name" required><br><br>

<input type="text" name="ex" placeholder="Experience" required><br><br>

<input type="text" name="ph" placeholder="Phone Number"
required maxlength="10" minlength="10"
onkeypress="return checkphno(event)"><br><br>

<input type="email" name="em"
placeholder="Email / Username" required><br><br>

<input type="password" name="pass"
placeholder="Password" required><br><br>

<input type="text" name="fees"
placeholder="Fees" required><br><br>

<textarea name="add" rows="3"
placeholder="Address" required></textarea>

<br><br>

<label>
<input type="radio" name="gend" value="m" required>
Male
</label>

<label>
<input type="radio" name="gend" value="f">
Female
</label>

<br><br>

<h5>Choose User Type</h5>

<select name="ut" required>

<option value="">Choose</option>

<option value="Doctor">Doctor</option>

<option value="Receptionist">Receptionist</option>

</select>

<br><br>

<input type="submit" name="s1" value="Submit">

</form>

</center>

<?php

if(isset($_POST["s1"]))
{

$dname=$_POST["dep"];
$nm=$_POST["nm"];
$ex=$_POST["ex"];
$ph=$_POST["ph"];
$em=$_POST["em"];
$pass=$_POST["pass"];
$fee=$_POST["fees"];
$add=$_POST["add"];
$gen=$_POST["gend"];
$ut=$_POST["ut"];

require_once("vars.php");

$conn=mysqli_connect(hname,uname,password,dbname)
or die("Error in connection ".mysqli_connect_error());

$q="insert into adddoc
(depid,name,experience,phone,email,password,address,gender,usertype,fees)
values
('$dname','$nm','$ex','$ph','$em','$pass','$add','$gen','$ut','$fee')";

$res=mysqli_query($conn,$q)
or die("Error in query ".mysqli_error($conn));

$count=mysqli_affected_rows($conn);

mysqli_close($conn);

if($count==1)
{
    echo "Staff added successfully";
}
else
{
    echo "Staff not added";
}

}

?>

<?php
require_once("footer.php");
?>

</body>
</html>