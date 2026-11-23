<?php
session_start();
require_once("vars.php");
?>
<html>
<head>
<title>
Book Appointment
</title>
<?php
require_once("ext.php");
?>
</head>
<body>
<?php
if(isset($_SESSION["userid"]))
    require_once("header.php");
else
    require_once("recheader.php");
?>
<! -- main image slider container -->
      <div class="inner-banner"></div>
<! – breadcrumbs -->
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Book Appointment</li>
        </ol>
    </nav>
<!-- // breadcrumbs -->
<section>
<div class="container">
<h2 align="center">Book Appointment</h2> <br/>
    <div class="container">
    <div class="col-sm-7" style="margin:auto;">
   <form name="form1" method="post">
<h5>Choose Department </h5>
<select name="dep" class="form-control">
<option value=""> Choose </option>
<?php
  // require_once("vars.php");
     $conn = mysqli_connect(hname, uname, password, dbname) or die("Error in connection". mysqli_connect_error());
   $squ = "select * from managdep";
   $res = mysqli_query($conn, $squ) or die ("Error in query" . mysqli_error($conn));
       $row = mysqli_affected_rows($conn); // 1 or 0
mysqli_close($conn);
  if($row >= 1)
   {
	while($ans = mysqli_fetch_array($res))
	{
		if(isset($_POST["go"]))
		{
			$depid = $_POST["dep"];
			if($depid == $ans[0])
			{
				print "<option value='$ans[0]' selected >$ans[1]</option>";
			}
			else
			{	
				print "<option value=$ans[0]>$ans[1] </option>”;
                                     }
                                   }
                                   else
                                   {
                                         print "<option value=$ans[0]>$ans[1] </option>”;
                                    }
                              }
else
{
	print"<option value=$ans[0]>$ans[1]</option>";
}
?>
<select>
<input type="submit" name="go" value="Go" class="btn btn-primary"> <br/> <br/>
<h5>Choose Doctor </h5>
<select name="doc" class="form-control">
<option value=""> Choose </option>
<?php
if(isset($_POST["go"]))
{
	$dep=$_POST["dep"];
            require_once("vars.php");
	  $conn=mysqli_connect(hname,uname,password,dbname)or die("Error in connection".
	$qul="select * from adddoc where depid='$dep' and usertype='Doctor'";
	$res1=mysqli_query($conn,$sql1)or die ("Error in query" .mysqli_error ($conn));
              $row=mysqli_affected_rows($conn);1 or 0
	mysqli_connect_error());
     if($row >=1)
      {
          while ($ans=mysqli_fetch_array($res1))
           {
               print”<option values=$ans [0] >$ans[2]</option>”;
           }
       }
     else
     {
         print"<option> No Doctor Available </option>";
      }
}
?>
</select>
<br/> <br/>
<h5>Choose timeslot </h5>
<select name="tm" class="form-control">
<option value=""> Choose </option>
<?php
//require_once("vars.php");
    $conn=mysqli_connect(hname,uname,password,dbname)or die("Error in connection". mysqli_connect_error());
  $qu2="select * from managetime";
  $res2=mysqli_query($conn,$qu2)or die ("Error in query" . mysqli_error($conn));
    $row=mysqli_affected_rows($conn);//1 or 0
    mysqli_close($conn);
 if($row>=1)
    {
        while($ans=mysqli_fetch_array($res2))
        {
            print"<option value=$ans[0]>$ans[1]</option>";
        }
    }
    else
    {
        print" No Time slot Available ";
    }
?>
</select><br/> <br/>
<input type="date" name="dt" value="Enter date" class="form-control"> <br/> <br/>
<input type="submit" name="s1" value="Add appointment" class="btn btn-primary">
<center>
<?php
if(isset($_POST["s1"]))
{
    $dep = $_POST["dep"];
    $doc = $_POST["doc"];
    $tm  = $_POST["tm"];
    $d   = $_POST["dt"];
    if(isset($_GET["userid"]))
    {
        $uid = $_GET["userid"];
    }
    else
    {
        $uid = $_SESSION["userid"];
    }
    //require_once("vars.php");
    $conn = mysqli_connect(hname, uname, password, dbname) 
            or die("Error in connection" . mysqli_connect_error());
    $q = "select * from addappointment where date='$d' and timeid='$tm' and docid='$doc'";
    $res = mysqli_query($conn, $q) or die("error in query" . mysqli_error($conn));
    $count = mysqli_affected_rows($conn);
    mysqli_close($conn);
    if($count == 1)
    {
        print "Please choose different time slot";
    }
    else
    {
        //require_once("vars.php");
        $conn = mysqli_connect(hname, uname, password, dbname) 
                or die("Error in connection" . mysqli_connect_error());
$q = "insert into addappointment(userid, depid, docid, timeid, date) 
      values ('$uid', '$dep', '$doc', '$tm', '$d')";
$res = mysqli_query($conn, $q) or die("error in query" . mysqli_error($conn));
$count = mysqli_affected_rows($conn);
mysqli_close($conn);
if($count == 1)
 {
     print "Appointment added successfully";
   }
 }
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
	
