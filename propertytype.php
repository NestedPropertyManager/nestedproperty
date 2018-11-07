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
$typecode=$_POST['typecode'];
$typename=$_POST['type'];
global $conn;

$message="<h6>select a file to upload</h6>";
   if(!empty($typename) || $typename!=""){
	   $sql="SELECT COUNT(*) FROM property_type WHERE type_code='{$typecode}'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
if($row[0]>0){
$message="<h6>staff already exists</h6>";
   }else{	   
   	     //$subject_set=get_onedata("staff","staff_code",$staffid);
//while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
		if(createpropertytype($date,$typecode,$typename)){	
			$message="<H5>"."..... ".$typename."&nbsp;&nbsp;&nbsp&nbsp;&nbsp;.......New property type created successfully</H5>";					
}else{
     $message="<H6>".$typename."&nbsp;&nbsp;New staff not created</H6>";	
}

//}
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
<div class="box"><h2>Property Management</h2>
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
<fieldset>
<div class="form">
<?php if(!empty($message)){ echo "<p>{$message}</p>";} else{ echo "fill in all the fields below to create a new property type";}?><br/>
 <p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/newpropertytype.jpg" alt="logo"></div></p><br/>
 <form action="propertytype.php" enctype="multipart/form-data" method="POST" border="2px">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date Registerd&nbsp;&nbsp;:<input type="date" name="date" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Property Type code.&nbsp;&nbsp;:<input type="text" name="typecode" value="<?php  $ptype=array("PT25000",count_value("property_type")+1); echo $ptype[0].$ptype[1];?>" readonly/><br/><br/>		
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Property Type &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="type" value="" required/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" class="btn btn-success" value="New Property"/><br/><br/>
</form>

</div><br/><br/>
</fieldset>
</div>
<?php include("includes/footer.php")?>