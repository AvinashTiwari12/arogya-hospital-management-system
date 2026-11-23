<?php
session_start();
?>
<html>
<head>
<title>
Add department
</title>
<?php
require_once("ext.php");
?>
</head>
<body>
<?php
require_once("adminheader.php");
?>
<!-- main image slider container -->
     <div class="inner-banner">
         </div>
<!-- breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Manage time</li>
    </ol>
</nav>
<!-- //breadcrumbs -->
<center>
<h2>Time management </h2> <br/>
</center>
  <center><form name="form1" method="post" enctype="multipart/form-data">
     <input type="text" name="tm" placeholder="Slot name" required=""> <br/> <br/>
     <input type="submit" name="s1" value="Add ">
     </form></center>
     <?php
     if(isset($_POST["s1"]))
      {
         $t = $_POST["tm"];
         //$a = $_POST["depid"];
         require_once("vars.php");
        $conn=mysqli_connect(hname,uname,password,dbname)or die("Error in  connection".mysqli_connect_error());
     $q="insert into managetime(slotname)values ('$t')";
        $res=mysqli_query($conn,$q)or die ("Error in query" . mysqli_error($conn));
            $count=mysqli_affected_rows($conn);//1 or 0
            mysqli_close($conn);
            if($count==1)
             {
                 print"timeslot added successfully";
            }
           else
            {
                print"timeslot not added successfully";
             }
       }
?>
<?php
require_once("footer.php");
?>
</body>
</html>

