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
$total_count=count_seltable("landlord");
//find all records.
$pagination=new pagination($page,$per_page,$total_count);

if(isset($_GET['landlord']) ||isset($_GET['agent']) ){
$vpage=!empty($_GET['pg'])?(int)$_GET['pg']:1;	
$vper_page=20;	
$vtotal_count=count_vtablecount("landlord",'agent_code',$_GET['agent'],'landlord_id',$_GET['landlord']);	
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
<div class="box"><h2>Recent News</h2>
<ul>
<ul>
   <li><a href="newlandlord.php">CREATE NEW LANDLORD</a></li>
   <li><a href="editlandlord.php">EDIT LANDLORD DETAILS</a></li>
     <li><a href="landlordlist.php">VIEW LANDLORD LIST</a></li>
   <li><a href="maintenancereport.php">VIEW PROPERTY STATEMENT</a></li>
   <li><a href="approvereq.php">REQUISITION APPROVAL</a></li>
</ul></ul>

</div>
    
</div>
<div id="rightcol"><br/>
<div class="fashioncol">

 <form action="landlordlist.php?" enctype="multipart/form-data" method="GET" border="2px">
 <table cellspacing="10">
 <tr>
 <th>
 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Select Agent</strong>       :<select name="agent">
          <?php
         $subject_set=get_gentable('landlord');
         $subject_count=mysqli_num_rows($subject_set);
         while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
            echo "<option value=\"{$subject['agent_code']}\">{$subject['agent_code']}</option>";
         }
         ?> 
         </select><br/><br/></p></th> 
		  <th><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Select Landlord Number</strong>       :<select name="landlord">
          <?php
         $subject_set=get_gentable('landlord');
         $subject_count=mysqli_num_rows($subject_set);
         while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
            echo "<option value=\"{$subject['landlord_id']}\">{$subject['landlord_id']}</option>";
         }
         ?> 
         </select><br/><br/></p></th>
		 <th>&nbsp;&nbsp;<input type="submit" name="search" value="Search"/></th>
 </tr>
 </table>
</form><br/>
<div id="printform" class="table-responsive">
<p><div id="parhead" align="left">&nbsp;&nbsp;&nbsp;<img src="gallery/landlordlist.jpg" alt="logo"></div></p><br/>
<?php 
if(isset($_GET['agent']) ||isset($_GET['landlord']) ){
	echo "<table class=\"table-stripped\" width=\"800\" cellspacing=\"0\" cellpadding=\"0\" border=\"5\">";
echo "<tr  bgcolor=\"#ccccff\">";
echo "<th><b>Date Registered</b></th>";
echo "<th><b>Agent no.</b></th>";
echo "<th><b>Landlord no.</b></th>";
echo "<th><b>Landlord Name</b></th>";
echo "<th><b>National id</b></th>";
echo "<th><b>location</b></th>";
echo "<th><b>&nbsp;</b></th>";
echo "</tr>";

$subject_pages=get_tabledetails('landlord',$pagination->offset(),'agent_code',$_GET['agent'],'landlord_id',$_GET['landlord']);
while($page=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){
echo "<tr>";
echo "<td>{$page['date']}</td>";
echo "<td>{$page['agent_code']}</td>";
echo "<td>{$page['landlord_id']}</td>";
echo "<td>{$page['landlord_name']}</td>";
echo "<td>{$page['national_id']}</td>";
echo "<td>{$page['location']}</td>";

echo "</tr>";
}
echo "</table>";
echo "<br/>";
echo "<p align=\"center\">";
echo "page {$pagination->current_page}";
echo "</p>";		
}
else{
		echo "<table width=\"800\" cellspacing=\"0\" cellpadding=\"0\" border=\"5\">";
echo "<tr  bgcolor=\"#ccccff\">";
echo "<th><b>Date Registered</b></th>";
echo "<th><b>Agent No.</b></th>";
echo "<th><b>Landlord No.</b></th>";
echo "<th><b>Landlord Name</b></th>";
echo "<th><b>National id</b></th>";
echo "<th><b>Location</b></th>";
echo "<th><b>&nbsp;</b></th>";
echo "</tr>";

$subject_pages=get_alltabledetails('landlord',$pagination->offset());
while($page=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){
echo "<tr>";
echo "<td>{$page['date']}</td>";
echo "<td>{$page['agent_code']}</td>";
echo "<td>{$page['landlord_id']}</td>";
echo "<td>{$page['landlord_name']}</td>";
echo "<td>{$page['national_id']}</td>";
echo "<td>{$page['location']}</td>";

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
if(isset($_GET['landlord']) ||isset($_GET['agent']) ){
	if($vpagination->total_pages()>1){
  echo "<br/>";
  if($vpagination->has_previous_page()){
   echo "<a href=\"landlordlist.php?landlord={$_GET['landlord']}&agent={$_GET['agent']}&pg={$pagination->previous_page()}\">&laquo; Previous</a>";
  }
  for($i=1;$i<=$vpagination->total_pages();$i++){
  if($i==$page){
  echo "<span class=\"selected\">{$i}</span>";
  }
  else{
    echo " <a href=\"landlordlist.php?landlord={$_GET['landlord']}&agent={$_GET['agent']}&pg={$i}\">{$i}</a> ";
	//echo "<a href=\"index.php?subj=".urlencode($subject["id"])."&pg=\"{$i}\"\">{$i}</a>";
  }
  }
  if($vpagination->has_next_page()){
 echo "<a href=\"landlordlist.php?landlord={$_GET['landlord']}&agent={$_GET['agent']}&pg={$pagination->next_page()}\">Next &raquo;</a>";
  }
  
}
}
else{
if($pagination->total_pages()>1){
  echo "<br/>";
  if($pagination->has_previous_page()){
   echo "<a href=\"landlordlist.php?pg={$pagination->previous_page()}\">&laquo; Previous</a>";
  }
  for($i=1;$i<=$pagination->total_pages();$i++){
  if($i==$page){
  echo "<span class=\"selected\">{$i}</span>";
  }
  else{
    echo " <a href=\"landlordlist.php?pg={$i}\">{$i}</a> ";
	//echo "<a href=\"index.php?subj=".urlencode($subject["id"])."&pg=\"{$i}\"\">{$i}</a>";
  }
  }
  if($pagination->has_next_page()){
 echo "<a href=\"landlordlist.php?pg={$pagination->next_page()}\">Next &raquo;</a>";
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