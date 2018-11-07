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
$propertyid=$_POST['propertyid'];
$typeid=$_POST['typeid'];
$agentid=$_POST['agentid'];
$landlordid=$_POST['landlordid'];
$location=$_POST['location'];
$details=$_POST['details'];
$user=$_POST['user'];

global $conn;

$message="<h6>select a file to upload</h6>";
   if(!empty($location) || $location!=""){
	   $sql="SELECT COUNT(*) FROM property WHERE property_id='{$propertyid}}'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
if($row[0]>0){
$message="<h6>property already exists</h6>";
   }else{	   
   	     //$subject_set=get_onedata("staff","staff_code",$staffid);
//while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
		if(createproperty($date,$propertyid,$typeid,$agentid,$landlordid,$location,$details,$user)){	
			$message="<H5>"."..... ".$propertyid."&nbsp;&nbsp;&nbsp&nbsp;&nbsp;.......New property type created successfully</H5>";					
}else{
     $message="<H6>&nbsp;&nbsp;New property not created</H6>";	
}

//}
   }
}
    else{
      $message="<h6>please fill the all the field to create a new allocation</h6>";
   }
   
   
}   
else{
   $message="fill in all the fields below to create a new property, please not that all fields are mandatory";
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
   <li><a href="propertytype.php">Create New Property Type</a></li>
   <li><a href="newproperty.php">Create New Property</a></li>
   <li><a href="newunit.php">Create New Property Unit</a></li>
    <li><a href="unitlist.php">View Property Units</a></li>
   <li><a href="monthlyrent.php">Pay Monthly Rent</a></li>
</ul>
</ul>
<br></div>
    
</div>
<div id="rightcol"><br/>
<div class="form">
 <fieldset>
<?php if(!empty($message)){ echo "<p>{$message}</p>";} else{ echo "fill in all the fields below to create a new property, please not that all fields are mandatory";}?><br/><br/><br/>
 <form action="newproperty.php" enctype="multipart/form-data" method="POST" border="2px">
  <p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/createproperty.jpg" alt="logo"></div></p><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date Registerd&nbsp;&nbsp;:<input type="date" name="date" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Property No.&nbsp;&nbsp;:<input type="text" name="propertyid" value="<?php  $ptype=array("P35000",count_value("property")+1); echo $ptype[0].$ptype[1];?>" readonly/><br/><br/>	
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Property Type No.</strong>:<select name="typeid">
         <?php
         $subject_set=get_gentable("property_type");
         $subject_count=mysqli_num_rows($subject_set);
         while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
            echo "<option value=\"{$subject['type_code']}\">{$subject['type_name']}</option>";
         }
         ?>  
         </select><br/><br/>	
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Agent No.</strong>:<select name="agentid">
         <?php
         $subject_set=get_gentable("agent");
         $subject_count=mysqli_num_rows($subject_set);
         while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
            echo "<option value=\"{$subject['agent_code']}\">{$subject['agent_code']}</option>";
         }
         ?>  
         </select><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Landlord Name.</strong>:<select name="landlordid">
         <?php
         $subject_set=get_gentable("landlord");
         $subject_count=mysqli_num_rows($subject_set);
         while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
            echo "<option value=\"{$subject['landlord_id']}\">{$subject['landlord_name']}</option>";
         }
         ?>  
         </select><br/><br/>		 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Property Location &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="location" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Contacts &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="details" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Property Created By &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="user" value="<?php echo $_SESSION['username']?>" readonly/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" class="btn btn-success" value="New Property"/><br/><br/>
</form>
</fieldset>
</div><br/><br/>
</div>
<?php include("includes/footer.php")?>