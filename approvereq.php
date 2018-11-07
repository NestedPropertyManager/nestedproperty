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
if(isset($_POST['approve'])){	
$date=$_POST['date'];
$requisitionid=$_POST['requisitionid'];
$landlordid=$_POST['landlordid'];
$approver=$_SESSION['username'];
global $conn;

$message="<h6>select a file to upload</h6>";
   if(!empty($date) || $date!="" && !empty($requisitionid) || $requisitionid!="" ){
   $subject_set=get_onedata("service_requisition","requisition_no",$requisitionid);
while($page=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){	   
		if(approverequisition('Approved',$requisitionid,$landlordid,$approver)){	
			$message="<H5>"."..... ".$requisitionid."&nbsp;&nbsp;&nbsp&nbsp;&nbsp;...Requisition approved successfully</H5>";					
}else{
     $message="<H6>"." ".$requisitionid."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Requisition already approved</H6>";	
}

   }
}
    else{
      $message="<h5>please fill the all the fields</h5>";
   }
   
   
}   
else{
	if(isset($_POST['reject'])){
	$date=$_POST['date'];
$requisitionid=$_POST['requisitionid'];
$landlordid=$_POST['landlordid'];
global $conn;

$message="<h6>select a file to upload</h6>";
   if(!empty($date) || $date!="" && !empty($requisitionid) || $requisitionid!="" ){
   $subject_set=get_onedata("service_requisition","requisition_no",$requisitionid);
while($page=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){	   
		if(approverequisition('Rejected',$requisitionid,$landlordid,$approver)){	
			$message="<H5>"."..... ".$requisitionid."&nbsp;&nbsp;&nbsp&nbsp;&nbsp;...Requisition Rejected successfully</H5>";					
}else{
     $message="<H6>"."Requisition No. ".$requisitionid."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Requisition not rejected</H6>";	
}

   }
}
    else{
      $message="<h5>please fill the all the fields</h5>";
   }
	}
	else{
		   $message="Fill all the fields to approve or reject Requisition";		
	}	
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
<div class="box"><h2></h2>
<ul>
<ul>
   <li><a href="newstaff.php">Create New Staff</a></li>
   <li><a href="editstaff.php">Update Staff Deatails</a></li>
    <li><a href="approvereq.php">Approve Service Request</a></li>
	<ul>
</ul>

<br></div>
    
</div>
<div id="rightcol"><br/>
<?php if(!empty($message)){ echo "<p>{$message}</p>";}?>
 <form  action="approvereq.php"  method="GET" border="2px"><br/>
 <br/> <p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/authorisereq.jpg" alt="logo"></div></p><br/><br/>
   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Date:<input type="date" name="date" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Requisition No:<input type="text" name="requisitionid" value=""/></p><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" class="btn btn-success" name="submit" value="search Requisition"/><br/>
 
 </form><br/>
 <div class="table-responsive">
<?php
echo "<form action=\"approvereq.php?\" enctype=\"multipart/form-data\" method=\"POST\" border=\"2px\" scroll=\"true\">"; 
if(isset($_GET['requisitionid']) ){
$subject_pages=get_onedata("service_requisition",'requisition_no',$_GET['requisitionid']);
while($page=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){	
echo "<label for=\"date\"><strong>Date Registered</strong></label>";
echo "<input type=\"text\" class=\"form-control\" name=\"date\" value=\"{$page['date']}\" readonly/><br/>";
echo "<label for=\"req\"><strong>Requisition No</strong></label>";
echo "<input type=\"text\" class=\"form-control\" name=\"requisitionid\" value=\"{$page['requisition_no']}\" readonly/><br/>";
echo "<label for=\"unit\"><strong>Unit No</strong></label>";
echo "<input type=\"text\" class=\"form-control\" name=\"unitid\" value=\"{$page['unit_code']}\" readonly/><br/>";
echo "<label for=\"landlord\"><strong>Date Registered</strong></label>";
echo "<input type=\"text\" class=\"form-control\" name=\"landlordid\" value=\"{$page['landlord_id']}\" readonly/><br/>";
echo "<label for=\"desc\"><strong>Description</strong></label>";
echo "<input type=\"text\" class=\"form-control\" rows=\"50\" cols=\"30\" name=\"description\" value=\"{$page['description']}\" readonly/><br/>";
echo "<label for=\"amount\"><strong>Amount</strong></label>";
echo "<input type=\"text\" class=\"form-control\" name=\"amount\" value=\"{$page['amount']}\" readonly/><br/>";
echo "<label for=\"approve\"><strong>Approval Status</strong></label>";
echo "<input type=\"text\" class=\"form-control\" name=\"status\" value=\"{$page['approval']}\" readonly/><br/><br/>";
echo "<p>";
if($_SESSION['accesslevel']=="landlord"|| $_SESSION['accesslevel']=="manager"){
echo "<input type=\"submit\" name=\"approve\"  class=\"btn btn-success\" value=\"Approve Requisition\"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"reject\" class=\"btn btn-success\" value=\"Reject Requisition\"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
}
	
}
	
echo "</form>";
?>
</div>
</div><br/>
<?php include("includes/footer.php")?>