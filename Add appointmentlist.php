<html>
<head>
<title>
List of Patients
</title>
<?php
require_once("ext.php");
?>
</head>
<body>
<?php
require_once("recpheader.php");
?>
<!-- main image slider container -->
     <div class="inner-banner">
</div>
<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <li class="breadcrumb-item active" aria-current="page"> List of Patients</li>
    </ol>
</nav>
<!-- //breadcrumbs -->
<center>
    <h2>List of Patients</h2>
</center>
<center>
<form name="form1" method="post">
<input type="submit" name="s1" value="search">
</form>
</center>
   <?php
if(isset($_POST["s1"]))
{
    $conn=mysqli_connect("localhost","root","","hmsdb") or die("Error in connection". mysqli_connect_error());
    $q="select * from checkout";
    $res=mysqli_query($conn,$q) or die ("Error in query". mysqli_error($conn));
    $count=mysqli_affected_rows($conn);
    mysqli_close($conn);
    if($count==0)
    {
        print"No records";
    }
    else
    {
        print"<table class='table table-striped'>
        <tr> 
            <th> Name </th>
            <th> Phone </th>
            <th> Address </th>
            <th> Paymode </th>
            <th> Fees </th>
        </tr>";
        while($x=mysqli_fetch_array($res))
         {
                  print"<tr>
                <td> $x[1] </td>
                <td> $x[2] </td>
                <td> $x[3] </td>
                <td> $x[4] </td>
                <td> $x[6] </td>
            </tr>";
        }
        print"</table>";
    }
}
?>

<?php
require_once("footer.php");
?>
</body>
</html>
