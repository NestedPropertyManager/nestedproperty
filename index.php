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
 <link rel="stylesheet"  href="css/jquery.lightbox-0.5.css" type="text/css" media="screen"/>
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
<div class="box"><h2><marquee>Property Manager</marquee></h2>
<p>
<img src="images/house1.jpg" width=\"150\" height=\"130\" align="center"/>
</p>
<ul>
<ul>
<li>
<button type="button" class="btn btn-primary">Requisitions to Approve<span class="badge"><?php echo count_svalue('service_requisition','approval','Not Approved');?></span>
</button></li>
<li><strong>Managed Properties</strong>&nbsp;<span class="badge"><?php echo count_value('property');?></span></li>
<li><strong>Landlords</strong>&nbsp;<span class="badge"><?php echo count_value('landlord');?></span></li>
<li><strong>Tanants</strong>&nbsp;<span class="badge"><?php echo count_value('tenantt');?></span></li>
</ul>
</ul>
</div>    
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
<p><H5><STRONG><span><img src="gallery/listpreview/pmanager.png"/></span>&nbsp;&nbsp;PROPERTY MANAGER </STRONG></H5>
<ul>
   <li><a href="newstaff.php">CREATE NEW STAFF</a></li>
   <li><a href="editstaff.php">UPDATE STAFF DETAILS</a></li>
    <li><a href="approvereq.php">APPROVE SERVICE REQUEST</a></li>
</ul>
</p>
</div>
<div class="row">
<p><H5><STRONG><span><img src="gallery/listpreview/landlord.png"/></span>&nbsp;&nbsp;LANDLORD </STRONG></H5>
<ul>
   <li><a href="newlandlord.php">CREATE NEW LANDLORD</a></li>
   <li><a href="editlandlord.php">EDIT LANDLORD DETAILS</a></li>
     <li><a href="landlordlist.php">VIEW LANDLORD LIST</a></li>
   <li><a href="maintenancereport.php">VIEW PROPERTY STATEMENT</a></li>
   <li><a href="approvereq.php">REQUISITION APPROVAL</a></li>
</ul>
</p>
<p><H5><STRONG><span><img src="gallery/listpreview/pmanager.png"/></span>&nbsp;&nbsp;PROPERTY MANAGEMENT</STRONG></H5>
<ul>
   <li><a href="propertytype.php">CREATE NEW PROPERTY TYPE</a></li>
   <li><a href="newproperty.php">CREATE NEW PROPERTY</a></li>
   <li><a href="newunit.php">CREATE NEW PROPERTY UNIT</a></li>
    <li><a href="unitlist.php">PROPERTY UNITS AVAILABILITY</a></li>
   <li><a href="monthlyrent.php">PAY MONTHLY RENT</a></li>
</ul>
</p>
</div>
<div class="row">
<p><H5><STRONG><span><img src="gallery/listpreview/tenant.png"/></span>&nbsp;&nbsp;TENANT</STRONG></H5>
<ul>
   <li><a href="newtenant.php">CREATE NEW TENANT</a></li>
   <li><a href="edittenant.php">EDIT TENANT DETAILS</a></li>
   <li><a href="monthlyrent.php">PAY MONTHLY RENT</a></li>
   <li><a href="tenantstatement.php">view Monthly statement/payment history</a></li>
</ul>
</p>
</div>
</div>
<div class="col-md-6">
<div class="row">
<p><H5><STRONG><span><img src="gallery/listpreview/pmaintenance.png"/></span>&nbsp;&nbsp;PROPERTY MAINTENANCE</STRONG></H5>
<ul>
   <li><a href="requisition.php">CREATE SERVICE REQUISITION</a></li>
   <li><a href="approvereq.php">APPROVE SERVICE REQUEST</a></li>
      <li><a href="requisitionlist.php">REQUISITION LIST</a></li>
</ul>
</p>
<p><H5><STRONG><span><img src="gallery/listpreview/finance.png"/></span>&nbsp;&nbsp;FINANCE MANAGEMENT</STRONG></H5>
<ul>
   <li><a href="monthlyrent.php">MONTHLY RENT</a></li>
   <li><a href="mreceipt.php">MISCELLENOUS RECEIPT</a></li> 
   <li><a href="paymentvoucher.php">PAYMENTS VOUCHER</a></li>
</ul>
</p>
<p><H5><STRONG><span><img src="gallery/listpreview/reports.png"/></span>&nbsp;&nbsp;REPORTS</STRONG></H5>
<ul>
   <li><a href="tenantstatement.php">Tenant Statement</a></li>
   <li><a href="tenantlist.php">Tenant Summary List</a></li>
   <li><a href="propertylist.php">Property List</a></li>
   <li><a href="unitlist.php">Property Units Availability</a></li>
   <li><a href="cashbook.php">Property financial report</a></li>
   <li><a href="maintenancereport.php">Property Maintenance Report </a></li>
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