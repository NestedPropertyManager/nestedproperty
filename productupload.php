<?php require_once("includes/session.php");?>
<?php
confirm_logged_in();
?>
<?php include("includes/header.php")?>
<?php require_once("connect.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/pagination.php");?>
<?php require_once("includes/photos.php");?>

<?php
$upload_errors=array(
UPLOAD_ERR_OK       =>"Fashion item uploaded successfully",
UPLOAD_ERR_INI_SIZE =>"Larger than upload_max_filesize",
UPLOAD_ERR_FORM_SIZE=>"Larger than form MAX_FILE_SIZE",
UPLOAD_ERR_PARTIAL  =>"Partial upload",
UPLOAD_ERR_CANT_WRITE  =>"cant write to disk",
UPLOAD_ERR_EXTENSION  =>"File upload stopped by extension"
);

if(isset($_POST['submit'])){
//process the form data
$tmp_file=$_FILES['file_upload']['tmp_name'];
$target_file=basename($_FILES['file_upload']['name']);
$upload_dir="includes/productphotos";


$cat=$_POST['category'];
$desc=$_POST['desc'];
$contact=$_POST['contact'];
$message="select a file to upload";

$fashion_set=get_photoproducts();
        $products=array($cat,$desc,$contact);
foreach($products as $product){
   if(!empty($product) || $product!=""){
if(move_uploaded_file($tmp_file,$upload_dir."/".$target_file)){
//create($target_file,$_FILES['file_upload']['type'],$_FILES['file_upload']['size'],"caption");
//create("file1","jpg","1","caption");
if(createfashion($cat,$target_file,$desc,$contact)){
$message="File uploaded successfully";
}else{
$message=$_FILES['file_upload']['name'].$_FILES['file_upload']['type'];
}
}
else{
$error=$_FILES['file_upload']['error'];
$message=$upload_errors[$error];
} 
   }else{
      $message="please fill the fields to upload photo";
   }
   
   
}   
}else{
   $message="Select a photo to upload";
}
?>
<body>
<div id="wrapbg">
<div id="wrap">
<div id="banner">
<div id="logo" align="center">&nbsp;&nbsp;&nbsp;<img src="images/header.jpg" alt="logo"></div>
<div id="topnav">
<?php menu();?>        
</div>   
</div>
<div id="leftcol">
<div class="box"><h2>quick links</h2>
<ul>
<li><a href="productupload.php">Add New fashion product</a></li>
<li><a href="editfashion.php?subj=1">Upadate products</a></li>
<li><a href="newuser.php">Create new user</a></li>     
</ul>
</div>
<div class="box" align="center"><h2><marquee>Home And Office Delivery</marquee></h2>
<p>
<img src="includes/uploads/delivery.jpg" width=\"150\" height=\"130\" align="center"/>
</p>
</div>
<div class="box"><h2>Recent News</h2><p>
<?php
$subject_set=get_pages_forsubject(6);
while($subject=mysql_fetch_array($subject_set)){
echo "<b><li";
echo "><a href=\"index.php?subj=".urlencode($subject["subject_id"])."\">
{$subject["menu_name"]}</a></li></b>";
}
?>
</p>
<br></div>
    
</div>
<div id="rightcol"><br/>
<img src="images/rightlogo.jpg" align="center"/>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<bold><i>Welcome to admin page <?php echo $_SESSION['username']?></i></bold></p>
<h1>
<?php if(isset($_GET['subj'])){
echo "<b>".$sel_subject['menu_name']."</b>";
}else if(!isset($_GET['subj'])){
echo "";
}
?>
</h1>
<?php
if(!isset($_GET['subj'])){
?>
<div class="form">
<?php if(!empty($message)){ echo "<p>{$message}</p>";}?><br/>
 <form action="productupload.php" enctype="multipart/form-data" method="POST" border="2px">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="file_upload"/><br/><br/>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category       :<select name="category">
         <?php
         $subject_set=get_allsubjects();
         $subject_count=mysql_num_rows($subject_set);
         while($subject=mysql_fetch_array($subject_set)){
            echo "<option value=\"{$subject['menu_name']}\">{$subject['menu_name']}</option>";
         }
         ?>
           
         </select><br/><br/></p>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;:<input type="date" name="desc" value=""/><br/><br/>		 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sales order&nbsp;&nbsp;:<input type="text" name="desc" value=""/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;quantity out&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="contact" value=""/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="POST"/><br/><br/>
</form>

</div><br/><br/>
<div class="rightcol2">
<?php  
echo "<p><b>services offered by the company to our esteemed clients</b></p>";
$subject_pages=get_pages_forsubject("3");
echo "<ul>";
while($page=mysql_fetch_array($subject_pages)){
echo "<li><a href=\"index.php?subj=3\"><img src=\"images/sidenav.jpg\"/>{$page['menu_name']}</a></li>";
}
echo "</ul>";
/*include("includes/defaultselect.php");*/
 ?>
 </div><br/><br/>
<div class="rightcol3" align="center">
<p><strong><a href="wrs.php"><MARQUEE>THE MOST FASHIONABLE HANDBAGS, MEN'S CLOTHS, SHOES, SPORTS WEAR</MARQUEE></a></strong></p>
</div>
<?php }?>

<?php if(isset($_GET['subj'])){
/*include("includes/houseform.php");*/
$subject_pages=get_pages_fornsubject($sel_subject['id'],$pagination->offset());
while($page=mysql_fetch_array($subject_pages)){
echo "<h><b>{$page['menu_name']}</b></h>";
echo "<p>{$page['content']}</p><br/><br/>";
}
}
?> 
<br/><br/>
</div>
<?php include("includes/footer.php")?>