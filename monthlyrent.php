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
$transaction=$_POST['transaction'];
$typecode=$_POST['typecode'];
$tenantid=$_POST['tenantid'];
$description=$_POST['description'];
$user=$_POST['user'];
$mode=$_POST['modereference'];

global $conn;

$message="<h6>select a file to upload</h6>";
   if(!empty($tenantid) || $tenantid!=""){
	   $sql="SELECT COUNT(*) FROM payment WHERE transaction_no='{$transaction}}'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
if($row[0]>0){
$message="<h6>Transaction  already made</h6>";
   }else{	   
   	      $subject_set=get_onedata("tenantt","tenant_code",$tenantid);
while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
	   	      $page_set=get_onedata("propertyunit","code",$subject['unit_code']);
while($page=mysqli_fetch_array($page_set,MYSQLI_ASSOC)){
	$pag_set=get_onedata("property","property_id",$page['property_id']);
while($pag=mysqli_fetch_array($pag_set,MYSQLI_ASSOC)){
	   	      $payment_set=get_twocoldata("payment","reference",$tenantid,"description",$description);
$payment=mysqli_fetch_row($payment_set);
	if($payment[0]>0){
		  $message="<h6>Tenant Rent for that month is already made!!!!!!</h6>";
}else{
  	if(makepayment($date,$pag['property_id'],$transaction,$typecode,$subject['tenant_code'],$mode,$page['code'],$description,$page['monthly_rent'],$user)){
			if(positivepayment($page['monthly_rent'],$pag['landlord_code'])){
			$message="<h5>payment made successfully</h5>";	
            $_SESSION['transaction']=$transaction;			
			}else{
	$message="<h6>sorry, Landlord account not update, check all the fields and try again!!!!!!</h6>";
			}
}else{
	$message="<h6>sorry, payment not made, check all the fields and try again!!!!!!</h6>";
}
}	
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
<div class="box"><h2>Tenant Management</h2>
<ul><ul>
   <li><a href="newtenant.php">Create New Tenant</a></li>
   <li><a href="edittenant.php">Edit Tenant Details</a></li>
   <li><a href="monthlyrent.php">Pay Monthly Rent</a></li>
   <li><a href="tenantstatement.php">view Monthly statement/payment history</a></li>
</ul>
</ul>
<br></div>
    
</div>
<div id="rightcol"><br/>
<div class="form">
<?php if(!empty($message)){ echo "<p>{$message}</p>";} else{ echo "fill in all the fields below to create a new property, please not that all fields are mandatory";}?>
<br/>
<?php if(!isset($_GET['receiptid'])){?>
<fieldset>
 <form action="monthlyrent.php" enctype="multipart/form-data" method="POST" border="2px">
<p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/mrent.jpg" alt="logo"></div></p><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Payment Date&nbsp;&nbsp;:<input type="date" name="date" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transaction No.&nbsp;&nbsp;:<input type="text" name="transaction" value="<?php  $ptype=array("RNT75000",count_svalue("payment",'type_code','PA950001')+1); echo $ptype[0].$ptype[1];?>" readonly/><br/><br/>	
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transaction Type Code:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="typecode" value="PA950001" readonly/><br/><br/>			 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tenant NO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="tenantid" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Payment Mode Reference No:<input type="text" name="modereference" value="" required/><br/><br/>
 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Payment month</strong>    :<select name="description">
    <option value="jan">January</option>
   <option value="feb">February</option>
   <option value="mar">March</option>
   <option value="apr">April</option>
   <option value="may">May</option>
   <option value="jun">June</option>
   <option value="jul">July</option>
   <option value="aug">August</option>
   <option value="sept">September</option>
   <option value="oct">October</option>
   <option value="nov">November</option>
   <option value="dec">December</option> 
         </select><br/><br/></p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Property Created By &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="user" value="<?php echo $_SESSION['username']?>" readonly/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" class="btn btn-success" value="Pay Rent"/>
</form><br/>
<?php }  else{ 
    	$subject_set=get_onedata("payment","transaction_no",$_GET['receiptid']);
while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
	   $page_set=get_onedata("propertyunit","code",$subject['unit_code']);
while($page=mysqli_fetch_array($page_set,MYSQLI_ASSOC)){
		   $sub_set=get_onedata("tenantt","tenant_code",$subject['reference']);
while($sub=mysqli_fetch_array($sub_set,MYSQLI_ASSOC)){
	echo "<form id=\"printreceipt\">";
	 echo  "<p><div id=\"parhead\" align=\"left\">&nbsp;&nbsp;&nbsp;<img src=\"gallery/mrent.jpg\" alt=\"logo\"></div></p><br/>";
      	receipt($subject['date'],$subject['transaction_no'],$subject['type_code'],$sub['tenant_name'],$page['property_id'],$sub['unit_code'],$subject['description'],$subject['amount'],$subject['created_by']);	
     echo "</form>";
}}
}
}
?>
 <form  action="monthlyrent.php"  method="GET" border="2px">
   <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Date:<input type="date" name="date" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monthly Receipt No:<input type="text" name="receiptid" value="<?php echo isset($_SESSION['transaction'])?$_SESSION['transaction']:"";  ?>"/></p><br/> 
 <p align="center"><input type="submit" name="preview" class="btn btn-success" value="Preview Receipt"/></p><br/>
 </form></fieldset><br/>
</div><br/><br/>
</div>
<?php include("includes/footer.php")?>