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
$total_count=count_seltable("payment");
//find all records.
$pagination=new pagination($page,$per_page,$total_count);

if(isset($_GET['startdate']) ||isset($_GET['tenantid']) ){
$vpage=!empty($_GET['pg'])?(int)$_GET['pg']:1;	
$vper_page=20;	
$vtotal_count=count_2vtablecount("payment",'reference',$_GET['tenantid'],'date',$_GET['startdate'],'date',$_GET['enddate']);	
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

 <form action="tenantstatement.php?" enctype="multipart/form-data" method="GET" border="2px">
<p>&nbsp;&nbsp;<strong>Start Date:</strong><input type="date" name="startdate" value="" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>End Date:</strong><input type="date" name="enddate" value="" required/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Tenant No:</strong><input type="text" name="tenantid" value="" required/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/>
<input type="submit" class="btn btn-success" name="search" value="View Statement"/>
</p>
</form><br/>
<div id="printform">
<p><div id="parhead" align="center">&nbsp;&nbsp;&nbsp;<img src="gallery/tstatement.jpg" alt="logo"></div></p><br/>
<?php 
if(isset($_GET['startdate'])&& $_GET['enddate'] ||isset($_GET['tenantid']) ){
	$subject_pages=get_table('tenantt','tenant_code',$_GET['tenantid']);
while($subject=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){
	echo "<p><strong>Tenant Name:</strong>&nbsp;&nbsp;.{$subject['tenant_name']}.&nbsp;&nbsp;&nbsp;<strong>Tenant No:</strong>&nbsp;.{$subject['tenant_code']}";
	echo "<p><strong>Property Unit No:</strong>&nbsp;&nbsp;.{$subject['unit_code']}.&nbsp;&nbsp;&nbsp;<strong>Location:</strong>&nbsp;&nbsp;.{$subject['location']}";
	echo "</p>";
}
echo "<br/>";
	echo "<table width=\"650\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
echo "<tr  bgcolor=\"#ccccff\">";
echo "<th><b>Transaction Date</b></th>";
echo "<th><b>Transaction No.</b></th>";
echo "<th><b>Payment mode No.</b></th>";
echo "<th><b>Description.</b></th>";
echo "<th><b>Amount Paid</b></th>";
echo "<th><b>&nbsp;</b></th>";
echo "</tr>";

$subject_pages=get_transaction($_GET['tenantid'],$_GET['startdate'],$_GET['enddate'],$vpagination->offset());
while($page=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){
echo "<tr>";
echo "<td>{$page['date']}</td>";
echo "<td>{$page['transaction_no']}</td>";
echo "<td>{$page['mode']}</td>";
echo "<td>{$page['description']}</td>";
echo "<td>Kshs.{$page['amount']}</td>";

echo "</tr>";
}
echo "</table>";
echo "<br/>";
echo "<p align=\"center\">";
echo "page {$pagination->current_page}";
echo "</p>";	
echo "<button onclick=\"printelem('printform')\" class=\"btn btn-success\" >print Statement</button>"; 	
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
   echo "<a href=\"tenantstatement.php?pg={$pagination->previous_page()}\">&laquo; Previous</a>";
  }
  for($i=1;$i<=$pagination->total_pages();$i++){
  if($i==$page){
  echo "<span class=\"selected\">{$i}</span>";
  }
  else{
    echo " <a href=\"tenantstatement.php?pg={$i}\">{$i}</a> ";
	//echo "<a href=\"index.php?subj=".urlencode($subject["id"])."&pg=\"{$i}\"\">{$i}</a>";
  }
  }
  if($pagination->has_next_page()){
 echo "<a href=\"tenantstatement.php?pg={$pagination->next_page()}\">Next &raquo;</a>";
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