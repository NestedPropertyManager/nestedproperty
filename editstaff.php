<?php require_once("includes/session.php");?>
<?php
confirm_logged_in();
?>
<?php require_once("includes/session.php")?>
<?php include("includes/header.php")?>
<?php require_once("connect.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/pagination.php");?>
<?php
find_selected_page();
?>
<?php
if(isset($_POST['submit'])){	
$date=$_POST['date'];
$agentid=$_POST['agentid'];
$staffname=$_POST['staffname'];
$staffid=$_POST['staffid'];
$national=$_POST['national'];
global $conn;

$message="<h6>select a file to upload</h6>";
   if(!empty($date) || $date!="" && !empty($national) || $national!="" ){
   $subject_set=get_onedata("staff","staff_code",$staffid);
while($page=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){	   
		if(updatestaff($staffname,$national,$staffid)){	
			$message="<H5>"."..... ".$staffname."&nbsp;&nbsp;&nbsp&nbsp;&nbsp;...staff updated successfully</H5>";					
}else{
     $message="<H6>"."ATL ".$staffname."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;staff records not updated</H6>";	
}

   }
}
    else{
      $message="<h5>please fill the all the field to create a new allocation</h5>";
   }
   
   
}   
else{
   $message="Fill all the fields to update depot";
}


?>
<?php
 $catselect="";
   if(isset($_GET['subj'])){
    $catselect=$sel_subject['menu_name'];  
   }else{
      $catselect="handbags";
   } 
?>
 <script type="text/javascript"  src="js/jquery.lightbox-0.5.js"></script>
 <link rel="stylesheet"  href="css/jquery.lightbox-0.5.css" type="text/css" media="screen">
<script type="text/javascript">
 $(function(){
        $('.fashioncol a').lightBox();   
        });
   </script>
   
      <script type="text/javascript">
    $('.menu').stickThis();
    
   </script>
<body>
<div id="wrapbg">
<div id="wrap">
<div id="banner">
<div id="logo"  align="center">&nbsp;&nbsp;&nbsp;<img src="gallery/real.png" alt="logo"></div>
<div id="topnav">
<?php menu();?>        
</div>   
</div>
<div id="leftcol">
<div class="box"><h2>quick links</h2>
<ul>
<?php sidemenu();?>  
</ul>
</div>
<div class="box" align="center"><h2><marquee>Property Manager</marquee></h2>
<p>
<img src="images/house1.jpg" width=\"150\" height=\"130\" align="center"/>
</p>
</div>
<div class="box"><h2>Recent News</h2>
<ul>
<ul>
   <li><a href="newstaff.php">Create New Staff</a></li>
   <li><a href="editstaff.php">Update Staff Deatails</a></li>
    <li><a href="approvereq.php">Approve Service Request</a></li>
	<ul>
</ul>
</div>
    
</div>
<div id="rightcol"><br/>
<fieldset>
<?php if(!empty($message)){ echo "<p>{$message}</p>";}?><br/>
 <form  action="editstaff.php"  method="GET" border="2px">
 <br/> <p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/updatestaff.jpg" alt="logo"></div></p><br/><br/>
   <p><label for="agent"><strong>Select Agent</strong></label>:<select name="vesselname" class="form-control">
         <?php
         $subject_set=get_gentable("staff");
         $subject_count=mysqli_num_rows($subject_set);
         while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
            echo "<option value=\"{$subject['agent_code']}\">{$subject['agent_code']}</option>";
         }
         ?>  
         </select><br/>
<label for="agent"><strong>Staff ID</strong></label>		 
<input type="text" class="form-control" name="staffid" value=""/></p><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" class="btn btn-success" name="submit" value="search"/><br/>
 
 </form></fieldset><br/>
 <div class="table-responsive">
<form action="editstaff.php?" enctype="multipart/form-data" method="POST" border="2px"> 
<?php
if(isset($_GET['vesselname']) ||isset($_GET['ref']) ){
$subject_pages=get_onedata("staff",'staff_code',$_GET['staffid']);
while($page=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){	
echo "<label for=\"agent\"><strong>Date Registered</strong></label>";
echo "<input type=\"text\" class=\"form-control\" row=\"10\" name=\"date\" value=\"{$page['date']}\" readonly/><br/>";
echo "<label for=\"agent\"><strong>Agent ID</strong></label>";
echo "<input type=\"text\" class=\"form-control\" name=\"agentid\" value=\"{$page['agent_code']}\" readonly/><br/>";
echo "<label for=\"agent\"><strong>Staff ID</strong></label>";
echo "<input type=\"text\" class=\"form-control\" name=\"staffid\" value=\"{$page['staff_code']}\" readonly/><br/>";
echo "<label for=\"agent\"><strong>Staff Name</strong></label>";
echo "<label for=\"staff\"><strong>Staff Name</strong></label>";
echo "<input type=\"text\" class=\"form-control\" name=\"staffname\" value=\"{$page['staff_name']}\" required/><br/>";
echo "<label for=\"agent\"><strong>National ID</strong></label>";
echo "<input type=\"text\" class=\"form-control\" name=\"national\" value=\"{$page['national_id']}\" required/><br/><br/>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"submit\" class=\"btn btn-success\" value=\"Edit staff\"/><br/><br/>";
}	
}	
echo "</form>";
?>
</div>
</div><br/>
<?php include("includes/footer.php")?>