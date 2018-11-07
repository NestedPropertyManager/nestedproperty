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
$tenantid=$_POST['tenantid'];
$tenantname=$_POST['tenantname'];
$nationalid=$_POST['nationalid'];
$location=$_POST['location'];
$other=$_POST['other'];
global $conn;

$message="<h6>select a file to upload</h6>";
   if(!empty($date) || $date!="" && !empty($nationalid) || $nationalid!="" ){
   $subject_set=get_onedata("tenantt","tenant_code",$tenantid);
while($page=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){	   
		if(updatetenant($tenantname,$nationalid,$other,$tenantid)){	
			$message="<H5>"."..... ".$landlordname."&nbsp;&nbsp;&nbsp&nbsp;&nbsp;...staff updated successfully</H5>";					
}else{
     $message="<H6>"."ATL ".$tenantname."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; records not updated</H6>";	
}

   }
}
    else{
      $message="<h5>please fill the all the field to create a new allocation</h5>";
   }
   
   
} 
if(isset($_POST['vacate'])){
$date=$_POST['date'];
$tenantid=$_POST['tenantid'];
$unitid=$_POST['unitid'];
$tenantname=$_POST['tenantname'];
$nationalid=$_POST['nationalid'];
$location=$_POST['location'];
$other=$_POST['other'];
$user=$_SESSION['username'];

global $conn;

$message="<h6>select a file to upload</h6>";
   if(!empty($tenantid) || $tenantid!=""){
	   $sql="SELECT COUNT(*) FROM tenantt WHERE tenant_code='{$tenantid}}'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
if($row[0]>0){
$message="<h6>property unit already exists</h6>";
   }else{	   
   	      $subject_set=get_onedata("propertyunit","code",$unitid);
while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
		if(tenantarchive($date,$tenantid,$unitid,$tenantname,$nationalid,$subject['unit_location'],$other,$user)){	
		     if(unitavailability(1,$unitid)){	
             if(sendtoarchive("tenantt",'tenant_code',$tenantid)){
		$message="<H5>"."..... ".$tenantid."&nbsp;&nbsp;&nbsp&nbsp;&nbsp;.......New Tenant vacated successfully</H5>"; 
			 }
		
			 }else{
				  $message="<H6>&nbsp;&nbsp;New Tenant not created</H6>";	
			 }
				
}else{
     $message="<H6>&nbsp;&nbsp;Tenant not Vacated</H6>";	
}

}
   }
}
    else{
      $message="<h6>please fill the all the field to create a new allocation</h6>";
   }	
	}  
else{
	   $message="Fill all the fields to update Tenant";	
	
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
<fieldset>
<?php if(!empty($message)){ echo "<p>{$message}</p>";}?><br/>
 <form  action="edittenant.php"  method="GET" border="2px">
 <p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/updatetenant.jpg" alt="logo"></div></p><br/>
   <p><strong>Select Agent</strong>:<select name="tenant">
         <?php
         $subject_set=get_gentable("agent");
         $subject_count=mysqli_num_rows($subject_set);
         while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
            echo "<option value=\"{$subject['agent_code']}\">{$subject['agent_name']}</option>";
         }
         ?>  
         </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tenant No:<input type="text" name="tenantid" value=""/></p><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" class="btn btn-success" name="submit" value="search Tenant"/><br/>
 
 </form><br/>
 <div class="table-responsive">
<?php
echo "<form action=\"edittenant.php?\" enctype=\"multipart/form-data\" method=\"POST\" border=\"2px\">"; 
if(isset($_GET['tenantid']) ){
$subject_pages=get_onedata("tenantt",'tenant_code',$_GET['tenantid']);
while($page=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){	
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date registered&nbsp;&nbsp;:<input type=\"text\" name=\"date\" value=\"{$page['date']}\" readonly/><br/><br/>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tenant No&nbsp;&nbsp;:<input type=\"text\" name=\"tenantid\" value=\"{$page['tenant_code']}\" readonly/><br/><br/>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit No&nbsp;&nbsp;:<input type=\"text\" name=\"unitid\" value=\"{$page['unit_code']}\" readonly/><br/><br/>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tenant Name&nbsp;&nbsp;:<input type=\"text\" name=\"tenantname\" value=\"{$page['tenant_name']}\" required/><br/><br/>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;National id&nbsp;&nbsp;:<input type=\"text\" name=\"nationalid\" value=\"{$page['national_id']}\" required/><br/><br/>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Location&nbsp;&nbsp;:<input type=\"text\" name=\"location\" value=\"{$page['location']}\" readonly/><br/><br/>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;other_details id&nbsp;&nbsp;:<input type=\"text\" name=\"other\" value=\"{$page['other_details']}\" required/><br/><br/>";
echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"vacate\" class=\"btn btn-success\" value=\"Edit Tenant\"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
if($_SESSION['accesslevel']=="manager"){
echo "<input type=\"submit\" name=\"vacate\"  class=\"btn btn-success\" value=\"Vacate Tenant\"/><br/><br/></p>";
}
}
	
}
	
echo "</form>";
?>
</div>
</fieldset>
</div><br/>
<?php include("includes/footer.php")?>