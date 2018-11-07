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
$requisitionid=$_POST['requisitionid'];
$unitid=$_POST['unitid'];
$description=$_POST['description'];
$amount=$_POST['amount'];
$approval=$_POST['approval'];
$user=$_POST['user'];

global $conn;

$message="<h6>select a file to upload</h6>";
   if(!empty($unitid) || $unitid!=""){
	   $sql="SELECT COUNT(*) FROM service_requisition WHERE requisition_no='{$requisitionid}}'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
if($row[0]>0){
$message="<h6>Requisition already made</h6>";
   }else{	   
	   	      $page_set=get_onedata("propertyunit","code",$unitid);
while($page=mysqli_fetch_array($page_set,MYSQLI_ASSOC)){
	$pag_set=get_onedata("property","property_id",$page['property_id']);
while($pag=mysqli_fetch_array($pag_set,MYSQLI_ASSOC)){
	if(requisition($date,$requisitionid,$unitid,$pag['landlord_code'],$description,$amount,$approval,$user)){
			$message="<h5>Requisition Raised, awaiting approval</h5>";		
			
}else{
	$message="<h6>sorry, requisition not raised, check all the fields and try again!!!!!!</h6>";
}
	
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
<fieldset>
 <p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/requisitionreq.jpg" alt="logo"></div></p><br/>
<?php if(!empty($message)){ echo "<p>{$message}</p>";} else{ echo "fill in all the fields below to create a new property, please not that all fields are mandatory";}?><br/><br/><br/>
 <form action="requisition.php" enctype="multipart/form-data" method="POST" border="2px">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date Registerd&nbsp;&nbsp;:<input type="date" name="date" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Requisition No.&nbsp;&nbsp;:<input type="text" name="requisitionid" value="<?php  $ptype=array("RQN85000",count_value("service_requisition")+1); echo $ptype[0].$ptype[1];?>" readonly/><br/><br/>	
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="unitid" value="" required/><br/><br/>			 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Description :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="description" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="amount" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Approval:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="approval" value="Not Approved" readonly/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Property Created By &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="user" value="<?php echo $_SESSION['username']?>" readonly/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" class="btn btn-success" value="Send For Approval"/>
</form>
</fieldset>
</div><br/><br/>
</div>
<?php include("includes/footer.php")?>