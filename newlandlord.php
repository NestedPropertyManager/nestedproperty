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
$landlordname=$_POST['landlordname'];
$landlordid=$_POST['landlordid'];
$residence=$_POST['residence'];
$national=$_POST['national'];
$other=$_POST['other'];
$account=array("ACC",$landlordid);
global $conn;

$message="<h6>select a file to upload</h6>";
   if(!empty($date) || $date!="" && !empty($landlordname) || $landlordname!="" ){
	   $sql="SELECT COUNT(*) FROM landlord WHERE landlord_id='{$landlordid}'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
if($row[0]>0){
$message="<h6>staff already exists</h6>";
   }else{
   $subject_set=get_onedata("agent","agent_name",$agentname);
while($page=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){	   
   	     //$subject_set=get_onedata("staff","staff_code",$staffid);
//while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
		if(createlandlord($landlordid,$date,$page['agent_code'],$landlordname,$national,$residence,$other)){
			if(createaccount($date,$account[0].$account[1],$landlordid,0)){
		$message="<H5>"."..... ".$landlordname."&nbsp;&nbsp;&nbsp&nbsp;&nbsp;.......New landlord created successfully</H5>";	
			}else{
		$message="<H6>"."..... ".$landlordname."&nbsp;&nbsp;&nbsp&nbsp;&nbsp;.......account not created</H6>";	
			}					
}else{
     $message="<H6>"."ATL ".$landlordname."&nbsp;&nbsp;&nbsp;".$landlordid."&nbsp;&nbsp;New landlord not created</H6>";	
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
<div class="form">
<?php if(!empty($message)){ echo "<p>{$message}</p>";} else{ echo "fill in all the fields below to create a new staff";}?><br/><br/><br/>
<p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/createlandlord.jpg" alt="logo"></div></p><br/>
<fieldset>
 <form action="newlandlord.php" enctype="multipart/form-data" method="POST" border="2px">
<label for="date"><strong>Date Registerd</strong></label>
<input type="date" class="form-control" name="date" value="" required/><br/>
<label for="agent"><strong>Agent Name</strong></label><select name="agentname" class="form-control">
         <?php
         $subject_set=get_gentable("agent");
         $subject_count=mysqli_num_rows($subject_set);
         while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
            echo "<option value=\"{$subject['agent_name']}\">{$subject['agent_name']}</option>";
         }
         ?>  
         </select><br/>
<label for="date"><strong>Landlord ID</strong></label>
<input type="text" name="landlordid" class="form-control" value="<?php echo '7500010'.count_value("landlord")+1;?>" readonly/><br/>
<label for="name"><strong>Landlord Name</strong></label>
<input type="text" class="form-control" name="landlordname" value="" required/><br/>
<label for="residence"><strong>Place Of Residence</strong></label>
<input type="text" class="form-control" name="residence" value="" required/><br/>
<label for="national"><strong>National ID</strong></label>
<input type="text" class="form-control" name="national" value="" required/><br/>
<label for="date"><strong>Contacts</strong></label>
<input type="text" class="form-control" name="other" value="" required/><br/>
<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" class="btn btn-success" value="New Landlord"/><br/><br/>
</form>
</fieldset>
</div><br/><br/>
</div>
<?php include("includes/footer.php")?>