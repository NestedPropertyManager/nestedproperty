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
<?php
//1. the current page number($current_page)
$page=!empty($_GET['pg'])?(int)$_GET['pg']:1;
//2. records per page($per_page)
$per_page=20;
//3.total record count($total_count)
$total_count=count_seltable("tenantt");
//find all records.
$pagination=new pagination($page,$per_page,$total_count);

if(isset($_GET['property']) ){	
$vpage=!empty($_GET['pg'])?(int)$_GET['pg']:1;	
$vper_page=20;	
$vtotal_count=count_svalue("payment",'property_id',$_GET['property']);	
$vpagination=new pagination($vpage,$vper_page,$vtotal_count);	
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
<?php sidemenu();?>   
</ul> 
</ul>
</div>
<div class="box" align="center"><h2><marquee>landlord</marquee></h2>
<p>
<img src="images/house1.jpg" width=\"150\" height=\"130\" align="center"/>
</p>
</div>
<div class="box"><h2>Reports</h2>
<ul>
<ul>
   <li><a href="tenantstatement.php">Tenant Statement</a></li>
   <li><a href="tenantlist.php">Tenant Summary List</a></li>
   <li><a href="propertylist.php">Property List</a></li>
   <li><a href="cashbook.php">Property financial report</a></li>
   <li><a href="maintenancereport.php">Property Maintenance Report </a></li>
</ul>
</ul>
<br></div>
    
</div>
<div id="rightcol"><br/>
<p >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<bold><i>Click the image below for full view</i></bold></p>
<h1>
<?php if(isset($_GET['subj'])){
echo "<b>".$sel_subject['menu_name']."</b>";
}else if(!isset($_GET['subj'])){
echo "";
}
?>
</h1>

<div class="fashioncol">

 <form action="tenantlist.php?" enctype="multipart/form-data" method="GET" border="2px">
 <table>
 <tr>
 <th>
 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Payment month</strong>    :<select name="month">
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
         </select><br/><br/></p></th> 
		  <th><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Property No</strong>       :<select name="property">
          <?php
         $subject_set=get_genspectable('propertyunit','property_id');
         $subject_count=mysqli_num_rows($subject_set);
         while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
            echo "<option value=\"{$subject['property_id']}\">{$subject['property_id']}</option>";
         }
         ?> 
         </select><br/><br/></p></th>
		 <th>&nbsp;&nbsp;<input type="submit" class="btn btn-success" name="search" value="Search"/></th>
 </tr>
 </table>
</form><br/>
<div id="printform">
<p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/tenantlist.jpg" alt="logo"></div></p><br/> 
<p align="left">
<b>Property No</b>: <?php echo  $data=!isset($_GET['property'])?"<i>Not selected</i>":$_GET['property']; ?>   
<br/><b>Location</b>:   <?php echo  $data=!isset($_GET['location'])?"<i>Not selected</i>":$_GET['location']; ?>
</p><br/>
<?php 
if(isset($_GET['month']) ||isset($_GET['property']) ){
	$total=count_svalue("payment","type_code","PA950001");
	$paid=count_twovalue("payment","property_id",$_GET['property'],"description",date('M'));
	$perc=($paid/$total)*100;
?>	
<label align="center"><strong>Paid Rent Current Month For Property <?php echo $_GET['property'];?></strong></label>
<div class="progress">
<div class="progress-bar progress-bar-stripped progress-bar-animated" style="width:<?php echo ceil($perc)."%";?>">
<?php echo ceil($perc)."%";?>
</div>
</div>
<table width="800" cellspacing="0" cellpadding="0" border="0">
<tr  bgcolor="#ccccff">
<th><b>Date Occupied</b></th>
<th><b>Tenant No.</b></th>
<th><b>Tenant Name</b></th>
<th><b>Unit No.</b></th>
<th><b>Unit location</b></th>
<th><b>Unit Type</b></th>
<th><b>Monthly Rent</b></th>
<th><b>&nbsp;</b></th>
</tr>
<?php
$subject_set=get_ntwodata('payment','unit_code','property_id',$_GET['property'],'description',$_GET['month'],$vpagination->offset());
while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
	    $page_set=get_spectabledetails('tenantt','unit_code',$subject['unit_code'],$pagination->offset());
while($page=mysqli_fetch_array($page_set,MYSQLI_ASSOC)){
	$unit_set=get_spectabledetails('propertyunit','code',$page['unit_code'],$vpagination->offset());
while($unit=mysqli_fetch_array($unit_set,MYSQLI_ASSOC)){
echo "<tr>";
echo "<td>{$page['date']}</td>";
echo "<td>{$page['tenant_code']}</td>";
echo "<td>{$page['tenant_name']}</td>";
echo "<td>{$page['unit_code']}</td>";
echo "<td>{$page['location']}</td>";
echo "<td>{$unit['unit_type']}</td>";
echo "<td>Ksh.{$unit['monthly_rent']}</td>";

echo "</tr>";
}
}
}
echo "</table>";
echo "<br/>";
echo "<p align=\"center\">";
echo "page {$pagination->current_page}";
echo "</p>";		
}else{?>
<?php 
	$total=count_svalue("payment","type_code","PA950001");
	$paid=count_twovalue("payment","type_code","PA950001","description",date('M'));
	$perc=($paid/$total)*100;
?>	
<label align="center"><strong>Total Paid Rent Current Month For All Properties</strong></label>
<div class="progress">
<div class="progress-bar progress-bar-stripped progress-bar-animated" style="width:<?php echo ceil($perc)."%";?>">
<?php echo ceil($perc)."%";?>
</div>
</div>

<table width="800" cellspacing="0" cellpadding="0" border="0">
<tr  bgcolor="#ccccff">
<th><b>Date Occupied</b></th>
<th><b>Tenant No.</b></th>
<th><b>Tenant Name</b></th>
<th><b>Unit No.</b></th>
<th><b>Unit location</b></th>
<th><b>Unit Type</b></th>
<th><b>Monthly Rent</b></th>

<th><b>&nbsp;</b></th>
<?php
    $subject_set=get_alltabledetails('tenantt',$pagination->offset());
while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
    $page_set=get_spectabledetails('propertyunit','code',$subject['unit_code'],$pagination->offset());
while($page=mysqli_fetch_array($page_set,MYSQLI_ASSOC)){	
echo "<tr>";
echo "<td>{$subject['date']}</td>";
echo "<td>{$subject['tenant_code']}</td>";
echo "<td>{$subject['tenant_name']}</td>";
echo "<td>{$subject['unit_code']}</td>";
echo "<td>{$subject['location']}</td>";
echo "<td>{$page['unit_type']}</td>";
echo "<td>Ksh.{$page['monthly_rent']}</td>";
echo "</tr>";
}
}
echo "</table>";
echo "<br/>";	
echo "<p align=\"center\">";
echo "page {$pagination->current_page}";
echo "</p>";		
}
?>
</div>
<button onclick="printelem('printform')" class="btn btn-success" >print List</button>
</div>
<div class='pagination' align='center' style="clear: both;">
<?php
if(isset($_GET['month']) ||isset($_GET['property']) ){
	if($vpagination->total_pages()>1){
  echo "<br/>";
  if($vpagination->has_previous_page()){
   echo "<a href=\"tenantlist.php?month={$_GET['month']}&property={$_GET['property']}&pg={$pagination->previous_page()}\">&laquo; Previous</a>";
  }
  for($i=1;$i<=$vpagination->total_pages();$i++){
  if($i==$page){
  echo "<span class=\"selected\">{$i}</span>";
  }
  else{
    echo " <a href=\"tenantlist.php?month={$_GET['month']}&property={$_GET['property']}&pg={$i}\">{$i}</a> ";
	//echo "<a href=\"index.php?subj=".urlencode($subject["id"])."&pg=\"{$i}\"\">{$i}</a>";
  }
  }
  if($vpagination->has_next_page()){
 echo "<a href=\"tenantlist.php?month={$_GET['month']}&property={$_GET['property']}&pg={$pagination->next_page()}\">Next &raquo;</a>";
  }
  
}
}
else{
if($pagination->total_pages()>1){
  echo "<br/>";
  if($pagination->has_previous_page()){
   echo "<a href=\"tenantlist.php?pg={$pagination->previous_page()}\">&laquo; Previous</a>";
  }
  for($i=1;$i<=$pagination->total_pages();$i++){
  if($i==$page){
  echo "<span class=\"selected\">{$i}</span>";
  }
  else{
    echo " <a href=\"tenantlist.php?pg={$i}\">{$i}</a> ";
	//echo "<a href=\"index.php?subj=".urlencode($subject["id"])."&pg=\"{$i}\"\">{$i}</a>";
  }
  }
  if($pagination->has_next_page()){
 echo "<a href=\"tenantlist.php?pg={$pagination->next_page()}\">Next &raquo;</a>";
  }
  
}
}

?>
</div><br/>
<br/><br/>
<div class="rightcol3" align="center">
<p><strong></strong></p><BR/>

</div>
<br/><br/>

</div>
<?php include("includes/footer.php")?>