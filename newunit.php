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
$unitid=$_POST['unitid'];
$propertyid=$_POST['propertyid'];
$type=$_POST['type'];
$rent=$_POST['rent'];
$user=$_POST['user'];

global $conn;

$message="<h6>select a file to upload</h6>";
   if(!empty($propertyid) || $propertyid!=""){
	   $sql="SELECT COUNT(*) FROM propertyunit WHERE code='{$unitid}}'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
if($row[0]>0){
$message="<h6>property unit already exists</h6>";
   }else{	   
   	      $subject_set=get_onedata("property","property_id",$propertyid);
while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
		if(createunit($date,$unitid,$propertyid,$subject['property_location'],$type,$rent,1,$user)){	
			$message="<H5>"."..... ".$unitid."&nbsp;&nbsp;&nbsp&nbsp;&nbsp;.......New property unit created successfully</H5>";					
}else{
     $message="<H6>&nbsp;&nbsp;New property not created</H6>";	
}

}
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
<div class="box"><h2>Recent News</h2><p>
<?php
$subject_set=get_pages_forsubject(6);
while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
echo "<b><li";
echo "><a href=\"index.php?subj=".urlencode($subject["subject_id"])."\">
{$subject["menu_name"]}</a></li></b>";
}
?>
</p>
<br></div>
    
</div>
<div id="rightcol"><br/>
<div class="form">
<?php if(!empty($message)){ echo "<p>{$message}</p>";} else{ echo "fill in all the fields below to create a new property, please not that all fields are mandatory";}?><br/><br/><br/>
<fieldset>
 <form action="newunit.php" enctype="multipart/form-data" method="POST" border="2px">
   <p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/createpropertyunit.jpg" alt="logo"></div></p><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date Registerd&nbsp;&nbsp;:<input type="date" name="date" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Property Unit No.&nbsp;&nbsp;:<input type="text" name="unitid" value="<?php  $ptype=array("U55000",count_value("propertyunit")+1); echo $ptype[0].$ptype[1];?>" readonly/><br/><br/>	
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Property No.</strong>:<select name="propertyid">
         <?php
         $subject_set=get_gentable("property");
         $subject_count=mysqli_num_rows($subject_set);
         while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
            echo "<option value=\"{$subject['property_id']}\">{$subject['property_id']}</option>";
         }
         ?>  
         </select><br/><br/>			 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Property Unit type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="type" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monthly Rent &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="number" name="rent" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Property Created By &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="user" value="<?php echo $_SESSION['username']?>" readonly/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" class="btn btn-success" value="New Property"/><br/><br/>
</form>
</fieldset>
</div><br/><br/>
</div>
<?php include("includes/footer.php")?>