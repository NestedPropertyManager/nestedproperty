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
$amount=$_POST['amount'];
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
	if(makepayment($date,$transaction,$typecode,$subject['tenant_code'],$page['code'],$mode,$description,$amount,$user)){
			if(positivepayment($amount,$pag['landlord_code'])){
			$message="<h5>payment made successfully</h5>";		
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
<div id="printform">
<fieldset>
<?php if(!empty($message)){ echo "<p>{$message}</p>";} else{ echo "fill in all the fields below to create a new property, please not that all fields are mandatory";}?><br/><br/><br/>
 <form  action="mreceipt.php" enctype="multipart/form-data" method="POST" border="1px">
 <br/> <p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/receipt.jpg" alt="logo"></div></p><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date Registerd&nbsp;&nbsp;:<input type="date" name="date" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transaction No.&nbsp;&nbsp;:<input type="text" name="transaction" value="<?php  $ptype=array("MR75000",count_svalue("payment",'type_code','PA950002')+1); echo $ptype[0].$ptype[1];?>" readonly/><br/><br/>	
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Transaction Type Code:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="typecode" value="PA950002" readonly/><br/><br/>			 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tenant NO:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="tenantid" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Description :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="description" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Payment Mode Reference No:<input type="text" name="modereference" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="amount" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Property Created By &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="user" value="<?php echo $_SESSION['username']?>" readonly/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" class="btn btn-success" value="Post Receipt"/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="printelem('printform')" class="btn btn-success" >print Receipt</button><br/><br/>
</form>
</fieldset>
</div><br/><br/>
</div>
<?php include("includes/footer.php")?>