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
$total_count=count_seltable("service_requisition");
//find all records.
$pagination=new pagination($page,$per_page,$total_count);

if(isset($_GET['startdate']) ||isset($_GET['propertyid']) ){
$vpage=!empty($_GET['pg'])?(int)$_GET['pg']:1;	
$vper_page=20;		
$vtotal_count="";
	$page_set=get_onedata('propertyunit','property_id',$_GET['propertyid']);
 while($pageset=mysqli_fetch_array($page_set,MYSQLI_ASSOC)){	
 $vtotal_count=count_2vtablecount("service_requisition",'unit_code',$pageset['code'],'date',$_GET['startdate'],'date',$_GET['enddate']);
 $vpagination=new pagination($vpage,$vper_page,$vtotal_count);
 }		
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
<div class="box" align="center"><h2><marquee>maintenance report</marquee></h2>
<p>
<img src="images/house1.jpg" width=\"150\" height=\"130\" align="center"/>
</p>
</div>
<div class="box"><h2>Recent News</h2><p>
<?php
$subject_set=get_pages_forsubject(6);
while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
echo "<b><li";
echo "><a href=\"tenantstatement.php?subj=".urlencode($subject["subject_id"])."\">
{$subject["menu_name"]}</a></li></b>";
}
?>
</p>
<br></div>
    
</div>
<div id="rightcol"><br/>
<p >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<bold><i>Plese input the start date, end date and tenant No to view the statement</i></bold></p>
<h1>
<?php if(isset($_GET['subj'])){
echo "<b>".$sel_subject['menu_name']."</b>";
}else if(!isset($_GET['subj'])){
echo "";
}
?>
</h1>

<div class="fashioncol">

 <form action="maintenancereport.php?" enctype="multipart/form-data" method="GET" border="2px">
<p>&nbsp;&nbsp;<strong>Start Date:</strong><input type="date" name="startdate" value="" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>End Date:</strong><input type="date" name="enddate" value="" required/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Property No:</strong><input type="text" name="propertyid" value="" required/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>
<input type="submit" class="btn btn-success" name="search" value="View Report"/>
</p>
</form><br/>
<div id="printform">
<p><div id="parhead" align="center">&nbsp;&nbsp;&nbsp;<img src="gallery/maintenancereport.png" alt="logo"></div></p><br/>
<?php 
if(isset($_GET['startdate'])&& $_GET['enddate'] ||isset($_GET['propertyid']) ){
  // $page_set=get_onedata('propertyunit','code',$_GET['propertyid']);
//while($pageset=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
	//$subject_pages=get_table('payment','property_id',$_GET['propertyid']);
//while($subject=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){

	echo "<p><strong>Property No:</strong>&nbsp;&nbsp;{$_GET['propertyid']}&nbsp;&nbsp;&nbsp;";
echo "<p><strong>Period From:</strong>&nbsp;&nbsp;{$_GET['startdate']}&nbsp;&nbsp;&nbsp;<strong>Period To:</strong>&nbsp;&nbsp;.{$_GET['enddate']}";
	echo "</p>";
//}
//}
echo "<br/>";
echo "<div class=\"table-responsive\">";
	echo "<table class=\"table-hover\" width=\"800\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
echo "<tr  bgcolor=\"#ccccff\">";
echo "<th><b>Date</b></th>";
echo "<th><b>Requisition No.</b></th>";
echo "<th><b>Property Unit id.</b></th>";
echo "<th><b>Description</b></th>";
echo "<th><b>Amount</b></th>";
echo "<th><b>Approval Status</b></th>";
echo "<th><b>&nbsp;</b></th>";
echo "</tr>";

	$page_set=get_onedata('propertyunit','property_id',$_GET['propertyid']);
 while($pageset=mysqli_fetch_array($page_set,MYSQLI_ASSOC)){	
$subject_pages=get_maintenancereport($pageset['code'],$_GET['startdate'],$_GET['enddate'],$vpagination->offset());
while($page=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){
echo "<tr>";
echo "<td>{$page['date']}</td>";
echo "<td>{$page['requisition_no']}</td>";
echo "<td>{$page['unit_code']}</td>";
echo "<td>{$page['description']}</td>";
echo "<td>Ksh.{$page['amount']}</td>";
echo "<td>{$page['approval']}</td>";
echo "</tr>";
}
}
echo "</table>";
echo "</div>";
echo "<br/>";
echo "<p align=\"center\">";
echo "page {$pagination->current_page}";
echo "</p>";	
echo "<button onclick=\"printelem('printform')\" class=\"btn btn-success\" >Print Report</button>"; 	
}
?>
</div>
</div>
<div class='pagination' align='center' style="clear: both;">
<?php
if(isset($_GET['startdate']) ||isset($_GET['tenantid']) ){
	if($vpagination->total_pages()>1){
  echo "<br/>";
  if($vpagination->has_previous_page()){
   echo "<a href=\"tenantstatement.php?startdate={$_GET['startdate']}&type={$_GET['tenantid']}&pg={$pagination->previous_page()}\">&laquo; Previous</a>";
  }
  for($i=1;$i<=$vpagination->total_pages();$i++){
  if($i==$page){
  echo "<span class=\"selected\">{$i}</span>";
  }
  else{
    echo " <a href=\"tenantstatement.php?startdate={$_GET['startdate']}&tenantid={$_GET['tenantid']}&pg={$i}\">{$i}</a> ";
	//echo "<a href=\"index.php?subj=".urlencode($subject["id"])."&pg=\"{$i}\"\">{$i}</a>";
  }
  }
  if($vpagination->has_next_page()){
 echo "<a href=\"tenantstatement.php?startdate={$_GET['startdate']}&tenantid={$_GET['tenantid']}&pg={$pagination->next_page()}\">Next &raquo;</a>";
  }
  
}
}
else{
if($pagination->total_pages()>1){
  echo "<br/>";
  if($pagination->has_previous_page()){
   echo "<a href=\"maintenancereport.php?pg={$pagination->previous_page()}\">&laquo; Previous</a>";
  }
  for($i=1;$i<=$pagination->total_pages();$i++){
  if($i==$page){
  echo "<span class=\"selected\">{$i}</span>";
  }
  else{
    echo " <a href=\"maintenancereport.php?pg={$i}\">{$i}</a> ";
	//echo "<a href=\"index.php?subj=".urlencode($subject["id"])."&pg=\"{$i}\"\">{$i}</a>";
  }
  }
  if($pagination->has_next_page()){
 echo "<a href=\"maintenancereport.php?pg={$pagination->next_page()}\">Next &raquo;</a>";
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