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
$voucher=$_POST['voucher'];
$typecode=$_POST['typecode'];
$referenceid=$_POST['referenceid'];
$description=$_POST['description'];
$amount=$_POST['amount'];
$user=$_POST['user'];

global $conn;

$message="<h6>select a file to upload</h6>";
   if(!empty($referenceid) || $referenceid!=""){
	   $sql="SELECT COUNT(*) FROM payment WHERE reference='{$referenceid}'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
if($row[0]>0){
$message="<h6>Payment Voucher already raised</h6>";
   }else{	   
	   	      $page_set=get_twocoldata("service_requisition","requisition_no",$referenceid,'approval','Approved');
while($page=mysqli_fetch_array($page_set,MYSQLI_ASSOC)){
	if($amount<=$page['amount']){
	if(makepayment($date,$voucher,$typecode,$referenceid,$page['landlord_id'],$description,$amount,$user)){
			if(negativepayment($amount,$page['landlord_id'])){
			$message="<h5>payment Voucher raised successfully</h5>";		
			}else{
	$message="<h6>sorry, Landlord account not update, check all the fields and try again!!!!!!</h6>";
			}
}else{
	$message="<h6>sorry, payment not made, check all the fields and try again!!!!!!</h6>";
}
}
else{
  	$message="<h6>sorry, payment Voucher amount is greater than requisition amount!!!!!!</h6>";	
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
<ul>
<li><a href="viewvessel.php">Property Management </a></li>
<li><a href="viewallocation.php">Landlord</a></li>
<li><a href="viewmiller.php">Property Management</a></li>
<li><a href="viewdepot.php">Tenant</a></li>
<li><a href="viewatl.php">Property Maintenance</a></li>
<li><a href="viewatl.php">Payment History</a></li>
<li><a href="viewvessel.php">Reports</a></li>
   </ul>    
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
 <form  action="paymentvoucher.php"  method="GET" border="2px">
   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Date:<input type="date" name="date" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Requisition No:<input type="text" name="requisitionid" value=""/></p><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" class="btn btn-success" name="submit" value="Raise PV"/><br/>
 
 </form><br/>
<?php if(!empty($message)){ echo "<p>{$message}</p>";} else{ echo "fill in all the fields below to raise a new payment voucher, please not that all fields are mandatory";}?><br/><br/><br/> 
<?php if(isset($_GET['requisitionid']) ){?>
<div class="form">
 <form action="paymentvoucher.php" enctype="multipart/form-data" method="POST" border="2px">
 <fieldset>
<?php $subject_pages=get_twocoldata("service_requisition",'requisition_no',$_GET['requisitionid'],'approval','Approved');
while($page=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)):  
if($_GET['requisitionid']==$page['requisition_no']){ 
?>
<br/> <p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/voucher.jpg" alt="logo"></div></p><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date Registerd&nbsp;&nbsp;:<input type="date" name="date" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Payment Voucher No.&nbsp;&nbsp;:<input type="text" name="voucher" value="<?php  $ptype=array("PV75000",count_svalue("payment",'type_code','PA950003')+1); echo $ptype[0].$ptype[1];?>" readonly/><br/><br/>	
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transaction Type Code:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="typecode" value="PA950003" readonly/><br/><br/>			 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reference NO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="referenceid" value="<?php echo $_GET['requisitionid']?>" readonly/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Description :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="description" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="amount" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Voucher Raised By &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="user" value="<?php echo $_SESSION['username']?>" readonly/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" class="btn btn-success" value="Post PV"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="" class="btn btn-success" >print PV</button><br/><br/>
<?php 
}else{ $message="requisition does not exist"; echo $message ;}
endwhile;?>
</fieldset>
</form>
</div><br/><br/>
<?php };?>
</div>
<?php include("includes/footer.php")?>