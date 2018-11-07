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
$landlordname=$_POST['landlordname'];
$landlordid=$_POST['landlordid'];
$national=$_POST['national'];
$location=$_POST['location'];
$other=$_POST['other'];
global $conn;

$message="<h6>select a file to upload</h6>";
   if(!empty($date) || $date!="" && !empty($national) || $national!="" ){
   $subject_set=get_onedata("landlord","landlord_id",$landlordid);
while($page=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){	   
		if(updatelandlord($landlordname,$national,$location,$other,$landlordid)){	
			$message="<H5>"."..... ".$landlordname."&nbsp;&nbsp;&nbsp&nbsp;&nbsp;...staff updated successfully</H5>";					
}else{
     $message="<H6>"."ATL ".$landlordname."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;staff records not updated</H6>";	
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
<div class="box"><h2>Landlord</h2>
<ul>
<ul>
   <li><a href="newlandlord.php">CREATE NEW LANDLORD</a></li>
   <li><a href="editlandlord.php">EDIT LANDLORD DETAILS</a></li>
     <li><a href="landlordlist.php">VIEW LANDLORD LIST</a></li>
   <li><a href="maintenancereport.php">VIEW PROPERTY STATEMENT</a></li>
   <li><a href="approvereq.php">REQUISITION APPROVAL</a></li>
</ul></ul>
</div>
    
</div>
<div id="rightcol"><br/>
<?php if(!empty($message)){ echo "<p>{$message}</p>";}?><br/>
<p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/updatelandlord.jpg" alt="logo"></div></p><br/>
 <form  action="editlandlord.php"  method="GET" border="2px">
   <p><strong>Select Agent</strong>:<select name="landlord">
         <?php
         $subject_set=get_gentable("landlord");
         $subject_count=mysqli_num_rows($subject_set);
         while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
            echo "<option value=\"{$subject['agent_code']}\">{$subject['agent_code']}</option>";
         }
         ?>  
         </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Landlord id:<input type="text" name="landlordid" value=""/></p><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" class=\"btn btn-success\" name="submit" value="search"/><br/>
 
 </form><br/>
 <div class="table-responsive">
<?php
echo "<form action=\"editlandlord.php?\" enctype=\"multipart/form-data\" method=\"POST\" border=\"2px\">"; 
if(isset($_GET['landlord']) ){
$subject_pages=get_onedata("landlord",'landlord_id',$_GET['landlordid']);
while($page=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){
echo "<label for=\"date\"><strong>Date Registration</strong></label>";	
echo "<input type=\"text\" class=\"form-control\" name=\"date\" value=\"{$page['date']}\" readonly/><br/>";
echo "<label for=\"agent\"><strong>Agent ID</strong></label>";	
echo "<input type=\"text\" class=\"form-control\" name=\"agentid\" value=\"{$page['agent_code']}\" readonly/><br/>";
echo "<label for=\"landlordid\"><strong>Date Registration</strong></label>";	
echo "<input type=\"text\" class=\"form-control\" name=\"landlordid\" value=\"{$page['landlord_id']}\" readonly/><br/>";
echo "<label for=\"landlordname\"><strong>Landlord Name</strong></label>";	
echo "<input type=\"text\" class=\"form-control\" name=\"landlordname\" value=\"{$page['landlord_name']}\" required/><br/>";
echo "<label for=\"national\"><strong>Landlord ID</strong></label>";
echo "<input type=\"text\" class=\"form-control\" name=\"national\" value=\"{$page['national_id']}\" required/><br/><br/>";
echo "<label for=\"location\"><strong>Place Of Residence</strong></label>";
echo "<input type=\"text\" class=\"form-control\" name=\"location\" value=\"{$page['location']}\" required/><br/><br/>";
echo "<label for=\"details\"><strong>Other Details</strong></label>";
echo "<input type=\"text\" class=\"form-control\" name=\"other\" value=\"{$page['other_details']}\" required/><br/><br/>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"submit\" class=\"btn btn-success\" value=\"Update landlord\"/><br/><br/>";
}
	
}
	
echo "</form>";
?>
</div>
</div><br/>
<?php include("includes/footer.php")?>