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
        <li class="breadcrumb-item active" aria-current="page"> Add department </li>
    </ol>
</nav>
<!-- //breadcrumbs -->
<center>
<h2> Add department </h2> <br/>
</center>
      <center><form name="form1" method="post" enctype="multipart/form-data">
             <input type="text" name="depname" placeholder="Department name" required="">
    <br/><br/>
         <input type="submit" name="s1" value="Add department">
        </form></center>
        <?php
       if(isset($_POST["s1"]))
        {
           $dname = $_POST["depname"];
           //$a = $_POST["depid"];
           require_once("vars.php");
         $conn = mysqli_connect(hname, uname, password, dbname)  or die("Error in connection" . mysqli_connect_error());
        $q="insert into managedep(depname) values ('$dname')";
         $res=mysqli_query($conn,$q) or die ("Error in query" . mysqli_error($conn));
          $count = mysqli_affected_rows($conn); //1 or 0
           mysqli_close($conn);
             if($count==1)
              {
                  print "Department added successfully";
               }
              else
               {
                   print "Department not added successfully";
                }
              }
  ?>
  <?php
require_once("footer.php");
?>
</body>
</html>
