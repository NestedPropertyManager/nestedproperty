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

if(isset($_GET['date']) ||isset($_GET['requisition']) ){
$vpage=!empty($_GET['pg'])?(int)$_GET['pg']:1;	
$vper_page=20;	
$vtotal_count=count_vtablecount("service_requisition",'date',$_GET['date'],'requisition_no',$_GET['requisition']);	
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
echo "><a href=\"requisitionlist.php?id=".urlencode($subject["id"])."\">
{$subject["menu_name"]}</a></li></b>";
}
?>
</p>
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

 <form action="requisitionlist.php?" enctype="multipart/form-data" method="GET" border="0px">
 <table>
 <tr>
 <th>
 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Select Date:<input type="date" name="date" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></th> 
 <th><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Requisition No.:<input type="text" name="requisition" value=""/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/><br/></p></th>
 <th>&nbsp;&nbsp;<input type="submit" class="btn btn-success" name="search" value="Search"/></th>
 </tr>
 </table>
</form><br/><br/><br/>
<div id="printform">
 <p><div id="parhead" align="center">&nbsp;&nbsp;&nbsp;<img src="gallery/service.jpg" alt="logo"></div></p><br/>
<?php 
if(isset($_GET['requisition']) ||isset($_GET['date']) ){
	echo "<table width=\"850\" cellspacing=\"10\" cellpadding=\"10\" border=\"0\">";
echo "<tr  bgcolor=\"#ccccff\">";
echo "<th><b>DateRequested</b></th>";
echo "<th><b>Requisition No.</b></th>";
echo "<th><b>Unit No.</b></th>";
echo "<th><b>Description</b></th>";
echo "<th><b>Amount</b></th>";
echo "<th><b>Approval</b></th>";
echo "<th><b>Requested By</b></th>";
echo "<th><b>Approved By</b></th>";
echo "<th><b>&nbsp;</b></th>";
echo "</tr>";

$subject_pages=get_tabledetails('service_requisition',$pagination->offset(),'date',$_GET['date'],'requisition_no',$_GET['requisition']);
while($page=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){
echo "<tr>";
echo "<td>{$page['date']}</td>";
echo "<td>{$page['requisition_no']}</td>";
echo "<td>{$page['unit_code']}</td>";
echo "<td>{$page['description']}</td>";
echo "<td>Kshs.{$page['amount']}</td>";
echo "<td>{$page['approval']}</td>";
echo "<td>{$page['created_by']}</td>";
echo "<td>{$page['approved_by']}</td>";

echo "</tr>";
}
echo "</table>";
echo "<br/>";
echo "<p align=\"center\">";
echo "page {$pagination->current_page}";
echo "</p>";		
}
else{
		echo "<table width=\"650\" cellspacing=\"5\" cellpadding=\"5\" border=\"0\">";
echo "<tr  bgcolor=\"#ccccff\">";
echo "<th><b>DateRequested</b></th>";
echo "<th><b>Requisition No.</b></th>";
echo "<th><b>Unit No.</b></th>";
echo "<th><b>Description</b></th>";
echo "<th><b>Amount</b></th>";
echo "<th><b>Approval</b></th>";
echo "<th><b>Requested By</b></th>";
echo "<th><b>Approved By</b></th>";
echo "<th><b>&nbsp;</b></th>";

$subject_pages=get_alltabledetails('service_requisition',$pagination->offset());
while($page=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){
echo "<tr>";
echo "<td>{$page['date']}</td>";
echo "<td>{$page['requisition_no']}</td>";
echo "<td>{$page['unit_code']}</td>";
echo "<td>{$page['description']}</td>";
echo "<td>Ksh.{$page['amount']}</td>";
if($page['approval']=="Approved"){
	echo "<td><h5>{$page['approval']}</h5></td>";
}else{
	echo "<td><h6>{$page['approval']}</h6></td>";
}
echo "<td>{$page['created_by']}</td>";
echo "<td>{$page['approved_by']}</td>";

echo "</tr>";
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
if(isset($_GET['date']) ||isset($_GET['requisition']) ){
	if($vpagination->total_pages()>1){
  echo "<br/>";
  if($vpagination->has_previous_page()){
   echo "<a href=\"requisitionlist.php?date={$_GET['date']}&requisition={$_GET['requisition']}&pg={$pagination->previous_page()}\">&laquo; Previous</a>";
  }
  for($i=1;$i<=$vpagination->total_pages();$i++){
  if($i==$page){
  echo "<span class=\"selected\">{$i}</span>";
  }
  else{
    echo " <a href=\"requisitionlist.php?date={$_GET['date']}&requisition={$_GET['requisition']}&pg={$i}\">{$i}</a> ";
	//echo "<a href=\"index.php?subj=".urlencode($subject["id"])."&pg=\"{$i}\"\">{$i}</a>";
  }
  }
  if($vpagination->has_next_page()){
 echo "<a href=\"requisitionlist.php?date={$_GET['date']}&requisition={$_GET['requisition']}&pg={$pagination->next_page()}\">Next &raquo;</a>";
  }
  
}
}
else{
if($pagination->total_pages()>1){
  echo "<br/>";
  if($pagination->has_previous_page()){
   echo "<a href=\"requisitionlist.php?pg={$pagination->previous_page()}\">&laquo; Previous</a>";
  }
  for($i=1;$i<=$pagination->total_pages();$i++){
  if($i==$page){
  echo "<span class=\"selected\">{$i}</span>";
  }
  else{
    echo " <a href=\"requisitionlist.php?pg={$i}\">{$i}</a> ";
	//echo "<a href=\"index.php?subj=".urlencode($subject["id"])."&pg=\"{$i}\"\">{$i}</a>";
  }
  }
  if($pagination->has_next_page()){
 echo "<a href=\"requisitionlist.php?pg={$pagination->next_page()}\">Next &raquo;</a>";
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