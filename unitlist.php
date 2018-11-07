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
$total_count=count_seltable("propertyunit");
//find all records.
$pagination=new pagination($page,$per_page,$total_count);

if(isset($_GET['location']) ||isset($_GET['type']) ){
$vpage=!empty($_GET['pg'])?(int)$_GET['pg']:1;	
$vper_page=20;	
$vtotal_count=count_vtablecount("propertyunit",'unit_location',$_GET['location'],'unit_type',$_GET['type']);	
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
echo "><a href=\"unitlist.php?subj=".urlencode($subject["subject_id"])."\">
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

 <form action="unitlist.php?" enctype="multipart/form-data" method="GET" border="2px">
 <table>
 <tr>
 <th>
 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Location</strong>       :<select name="location">
          <?php
         $subject_set=get_genspectable('propertyunit','unit_location');
         $subject_count=mysqli_num_rows($subject_set);
         while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
            echo "<option value=\"{$subject['unit_location']}\">{$subject['unit_location']}</option>";
         }
         ?> 
         </select><br/><br/></p></th> 
		  <th><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Property Unit Type</strong>       :<select name="type">
          <?php
         $subject_set=get_genspectable('propertyunit','unit_type');
         $subject_count=mysqli_num_rows($subject_set);
         while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
            echo "<option value=\"{$subject['unit_type']}\">{$subject['unit_type']}</option>";
         }
         ?> 
         </select><br/><br/></p></th>
		 <th>&nbsp;&nbsp;<input type="submit" class="btn btn-success" name="search" value="Search"/></th>
 </tr>
 </table>
</form><br/>
<div id="printform">
<br/> <p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/propertyunitlist.jpg" alt="logo"></div></p><br/>
<p align="left">
<b>Property Type</b>: <?php echo  $data=!isset($_GET['type'])?"<i>Not selected</i>":$_GET['type']; ?>   
<br/><b>Location</b>:   <?php echo  $data=!isset($_GET['location'])?"<i>Not selected</i>":$_GET['location']; ?>
</p>
<?php 
if(isset($_GET['location']) ||isset($_GET['type']) ){
	echo "<table width=\"800\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
echo "<tr  bgcolor=\"#ccccff\">";
echo "<th><b>Date Created</b></th>";
echo "<th><b>Unit Id.</b></th>";
echo "<th><b>Property Id.</b></th>";
echo "<th><b>Unit location</b></th>";
echo "<th><b>Unit Type</b></th>";
echo "<th><b>Monthly Rent</b></th>";
echo "<th><b>Status</b></th>";
echo "<th><b>&nbsp;</b></th>";
echo "</tr>";

$subject_pages=get_tabledetails('propertyunit',$pagination->offset(),'unit_location',$_GET['location'],'unit_type',$_GET['type']);
while($page=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){
echo "<tr>";
echo "<td>{$page['date']}</td>";
echo "<td>{$page['code']}</td>";
echo "<td>{$page['property_id']}</td>";
echo "<td>{$page['unit_location']}</td>";
echo "<td>{$page['unit_type']}</td>";
echo "<td>{$page['monthly_rent']}</td>";
if($page['availability']==0){
	echo "<td>Occupied</td>";
}else{
	echo "<td>Not occupied</td>";
}

echo "</tr>";
}
echo "</table>";
echo "<br/>";
echo "<p align=\"center\">";
echo "page {$pagination->current_page}";
echo "</p>";		
}
else{
		echo "<table width=\"800\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";
echo "<tr  bgcolor=\"#ccccff\">";
echo "<th><b>Date Created</b></th>";
echo "<th><b>Unit Id.</b></th>";
echo "<th><b>Property Id.</b></th>";
echo "<th><b>Unit location</b></th>";
echo "<th><b>Unit Type</b></th>";
echo "<th><b>Monthly Rent</b></th>";
echo "<th><b>Status</b></th>";

echo "<th><b>&nbsp;</b></th>";

$subject_pages=get_alltabledetails('propertyunit',$pagination->offset());
while($page=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){
echo "<tr>";
echo "<td>{$page['date']}</td>";
echo "<td>{$page['code']}</td>";
echo "<td>{$page['property_id']}</td>";
echo "<td>{$page['unit_location']}</td>";
echo "<td>{$page['unit_type']}</td>";
echo "<td>Ksh.{$page['monthly_rent']}</td>";
if($page['availability']==0){
	echo "<td color=\"#ccccff\"><H6>Occupied<H6></td>";
}else{
	echo "<td>Not occupied</td>";
}

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
<button onclick="printcontent('printform')" class="btn btn-success" >print List</button>
</div>
<div class='pagination' align='center' style="clear: both;">
<?php
if(isset($_GET['location']) ||isset($_GET['type']) ){
	if($vpagination->total_pages()>1){
  echo "<br/>";
  if($vpagination->has_previous_page()){
   echo "<a href=\"unitlist.php?location={$_GET['location']}&type={$_GET['type']}&pg={$pagination->previous_page()}\">&laquo; Previous</a>";
  }
  for($i=1;$i<=$vpagination->total_pages();$i++){
  if($i==$page){
  echo "<span class=\"selected\">{$i}</span>";
  }
  else{
    echo " <a href=\"unitlist.php?location={$_GET['location']}&type={$_GET['type']}&pg={$i}\">{$i}</a> ";
	//echo "<a href=\"index.php?subj=".urlencode($subject["id"])."&pg=\"{$i}\"\">{$i}</a>";
  }
  }
  if($vpagination->has_next_page()){
 echo "<a href=\"unitlist.php?location={$_GET['location']}&type={$_GET['type']}&pg={$pagination->next_page()}\">Next &raquo;</a>";
  }
  
}
}
else{
if($pagination->total_pages()>1){
  echo "<br/>";
  if($pagination->has_previous_page()){
   echo "<a href=\"unitlist.php?pg={$pagination->previous_page()}\">&laquo; Previous</a>";
  }
  for($i=1;$i<=$pagination->total_pages();$i++){
  if($i==$page){
  echo "<span class=\"selected\">{$i}</span>";
  }
  else{
    echo " <a href=\"unitlist.php?pg={$i}\">{$i}</a> ";
	//echo "<a href=\"index.php?subj=".urlencode($subject["id"])."&pg=\"{$i}\"\">{$i}</a>";
  }
  }
  if($pagination->has_next_page()){
 echo "<a href=\"unitlist.php?pg={$pagination->next_page()}\">Next &raquo;</a>";
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