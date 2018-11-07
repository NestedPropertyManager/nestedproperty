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
<div id="logo" align="center">&nbsp;&nbsp;&nbsp;<img src="images/header.png" alt="logo"></div>
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
<img src="includes/uploads/vessel.png" width=\"150\" height=\"130\" align="center"/>
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
<h1>
<?php if(isset($_GET['subj'])){
echo "<b>".$sel_subject['menu_name']."</b>";
}else if(!isset($_GET['subj'])){
echo "";
}
?>
</h1>
<div class="col-md-6">
<div class="row">
<p><H5><STRONG>PROPERTY MANAGER </STRONG></H5>
<ul>
   <li><a href="newstaff.php">create new staff</a></li>
   <li><a href="editstaff.php">Edit staff details</a></li>
</ul>
</p>
</div>
<div class="row">
<p><H5><STRONG>LANDLORD </STRONG></H5>
<ul>
   <li><a href="#">create new landlord</a></li>
   <li><a href="#">Edit landlord details</a></li>
   <li><a href="#">View Property statement</a></li>
   <li><a href="#">Requisition Approval</a></li>
</ul>
</p>
<p><H5><STRONG>PROPERTY MANAGEMENT</STRONG></H5>
<ul>
   <li><a href="#">CREATE NEW PROPERTY TYPE</a></li>
   <li><a href="#">CREATE NEW PROPERTY</a></li>
   <li><a href="#">CREATE NEW PROPERTY UNIT</a></li>
   <li><a href="#">Pay Monthly Rent</a></li>
</ul>
</p>
</div>
<div class="row">
<p><H5><STRONG>TENANT</STRONG></H5>
<ul>
   <li><a href="#">create new tenant</a></li>
   <li><a href="#">Edit tenant details</a></li>
   <li><a href="#">View Tenant profile</a></li>
   <li><a href="#">Pay Monthly Rent</a></li>
   <li><a href="#">view Monthly statement/payment history</a></li>
</ul>
</p>
</div>
</div>
<div class="col-md-6">
<div class="row">
<p><H5><STRONG>PROPERTY MAINTENANCE</STRONG></H5>
<ul>
   <li><a href="#">CREATE SERVICE REQUISITION</a></li>
   <li><a href="#">APPROVE SERVICE REQUEST</a></li>
</ul>
</p>
<p><H5><STRONG>PAYMENT HISTORY</STRONG></H5>
<ul>
   <li><a href="#">MONTHLY EXPENDITURE ON PROPERTY</a></li>
   <li><a href="#"></a></li>
</ul>
</p>
<p><H5><STRONG>REPORTS</STRONG></H5>
<ul>
   <li><a href="#">Tenant payment ledger</a></li>
   <li><a href="#">Property financial report</a></li>
   <li><a href="#">Property Maintenance Report </a></li>
</ul>
</p>
</div>
</div>
<br/><br/>
<div class="rightcol3" align="center">
<p><strong></strong></p><BR/>

</div>
<br/><br/>

</div>
<?php include("includes/footer.php")?>