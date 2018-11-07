<?php require_once("header.php");?>
<?php require_once("connect.php");?>
<?php require_once("functions.php");?>
<?php
$upload_errors=array(
UPLOAD_ERR_OK       =>"NO errors",
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
$upload_dir="fashionuploads";
$cat=$_POST['category'];
$name=$_POST['name'];
$desc=$_POST['desc'];
$price=$_POST['price'];


if(move_uploaded_file($tmp_file,$upload_dir."/".$target_file)){
//create($target_file,$_FILES['file_upload']['type'],$_FILES['file_upload']['size'],"caption");
//create("file1","jpg","1","caption");
if(createfashion($target_file,$cat,$name,$desc,$price)){
$message="File uploaded successfully";
}else{
$message=$_FILES['file_upload']['name'].$_FILES['file_upload']['type'];
}
}
else{
$error=$_FILES['file_upload']['error'];
$message=$upload_errors[$error];
}}
?>
<body>
<div id="wrapbg">
<div id="wrap">
<div id="banner">
<div id="logo"><a href="index.php"><img src="images/chlogo.jpg" alt="logo"></a></div>
<div id="topnav">
<?php menu();?>        
</div>   
</div>
<div id="slideshow">
   <img src="images/slide1.jpg" alt="the beach"/>    
   <img src="images/slide2.jpg" alt="Lodge"/>
   <img src="images/slide3.jpg" alt="Lodges"/>
   <img src="images/slide4.jpg" alt="sail fish"/>
    
</div>
<div id="leftcol">
<div class="box"><h2>quick links</h2>
<ul>
<?php
echo "<b><li><a href=\"index.php\">Return to Menu</a></li></b><br><br/>"; 
$subject_set=get_allsubjects();
while($subject=mysql_fetch_array($subject_set)){
echo "<b><li";
echo "><a href=\"index.php?subj=".urlencode($subject["id"])."\">
{$subject["menu_name"]}</a></li></b>";
}
?>     
</ul>
</div>
<div class="box"><h2><marquee>visit us</marquee></h2>
<p>
Motech s/w for best websites, desktop applications,
graphics and computer maintainance.
</p>
</div>
<div class="box"><h2>quotes</h2><p>
<?php
 if(isset($_GET['subj'])){
echo "Did you know changamwe has the best ".$sel_subject['menu_name']." in mombasa county
";
}else if(!isset($_GET['subj'])){
echo "Did you know changamwe has the best houses and schools in mombasa county";
}
?>
</p>
<br></div>
    
</div>
<div id="rightcol">
<h1>
<?php if(isset($_GET['subj'])){
echo "<b>".$sel_subject['menu_name']."</b>";
}else if(!isset($_GET['subj'])){
echo "Welcome to nyumbasearch";
}
?>
</h1>
search all the prefered property within changamwe.
click an item below to direct you to your prefered choice. click on houses to view
all the available houses, select type and location for specific houses in a given area.<br/>
<b>why trek if you can browse, this is where it all begins, contact any of the available agents</b> 
<br/><br/>
<?php if(!empty($message)){echo "<p>{$message}</p>";}?>
 <form action="fashionupload.php" enctype="multipart/form-data" method="POST">
<input type="file" name="file_upload"/><br/><br/>
Category&nbsp;&nbsp;&nbsp;   :<input type="text" name="category" value=""/><br/><br/>
Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      : <input type="text" name="name" value=""/><br/><br/>
Description&nbsp;&nbsp;&nbsp;:<input type="text" name="desc" value=""/><br/><br/>
price&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<input type="text" name="price" value=""/><br/><br/>
<input type="submit" name="submit" value="upload"/><br/><br/>
</form>   
</div>
<?php include("footer.php")?>