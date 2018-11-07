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
$agentname=$_POST['agentname'];
$staffname=$_POST['staffname'];
$staffid=$_POST['staffid'];
$national=$_POST['national'];
global $conn;

$message="<h6>select a file to upload</h6>";
   if(!empty($date) || $date!="" && !empty($national) || $national!="" ){
	   $sql="SELECT COUNT(*) FROM staff WHERE staff_code='{$staffid}'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
if($row[0]>0){
$message="<h6>staff already exists</h6>";
   }else{
   $subject_set=get_onedata("agent","agent_name",$agentname);
while($page=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){	   
   	     //$subject_set=get_onedata("staff","staff_code",$staffid);
//while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
		if(createnewstaff($staffid,$date,$page['agent_code'],$staffname,$national)){	
			$message="<H5>"."..... ".$staffname."&nbsp;&nbsp;&nbsp&nbsp;&nbsp;.......New staff created successfully</H5>";					
}else{
     $message="<H6>"."ATL ".$atl."&nbsp;&nbsp;&nbsp;".$subject['destination']."&nbsp;&nbsp;New staff not created</H6>";	
}

//}

   }
   }
}
    else{
      $message="<h5>please fill the all the field to create a new allocation</h5>";
   }
   
   
}   
else{
   $message="Fill all the fields to create a New staff";
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
<div class="box"><h2>Staff Management</h2>
<ul>
<ul>
   <li><a href="newstaff.php">Create New Staff</a></li>
   <li><a href="editstaff.php">Update Staff Deatails</a></li>
    <li><a href="approvereq.php">Approve Service Request</a></li>
	<ul>
</ul>
</div>
<div class="box"><h2>Property Manager</h2><p>
<p><img src="images/house1.jpg" width=\"150\" height=\"130\" align="center"/></p>
<br></div>
    
</div>
<div id="rightcol"><br/>
<?php if(!empty($message)){ echo "<p>{$message}</p>";} else{ echo "fill in all the fields below to create a new staff";}?><br/><br/>
<div class="form">
 <fieldset>
 <form action="newstaff.php" enctype="multipart/form-data" method="POST"><br/>
 <p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/newstaff.jpg" alt="logo"></div></p><br/> 
 <label for="date"><strong>Date Registerd</strong></label>&nbsp;&nbsp;&nbsp;:
&nbsp;<input type="date"  name="date" value="" required/><br/><br/><br/>
 <label for="date"><strong>Agent Name</strong></label>&nbsp;&nbsp;&nbsp;:<select name="agentname">
         <?php
         $subject_set=get_gentable("agent");
         $subject_count=mysqli_num_rows($subject_set);
         while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
            echo "<option value=\"{$subject['agent_name']}\">{$subject['agent_name']}</option>";
         }
         ?>  
         </select><br/><br/><br/>
<label for="date"><strong>Staff Name</strong></label>&nbsp;&nbsp;&nbsp;:
<input type="text" name="staffname" value="" required/><br/><br/><br/>
<label for="date"><strong>Staff ID</strong></label>&nbsp;&nbsp;&nbsp;:
<input type="text" name="staffid" value="<?php echo '45000'.count_value("staff")+1;?>" readonly/><br/><br/><br/>
<label for="date"><strong>National ID</strong></label>&nbsp;&nbsp;&nbsp;:		
<input type="number"  name="national" value="" required/><br/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit"  name="submit" class="btn btn-success" value="New Staff"/><br/><br/>
</form>
</fieldset>
</div><br/><br/>
</div>
<?php include("includes/footer.php")?>