<?php require_once("includes/session.php");?>
<?php include("includes/header.php")?>
<?php require_once("connect.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/pagination.php");?>
<?php require_once("includes/photos.php");?>
<?php
confirm_logged_in();
?>
<?php
if(isset($_POST['submit'])){
//process the form data

$username=$_POST['username'];
$confirm=$_POST['confirm'];
$password=$_POST['password'];
$hashed_password=sha1($password);
$message="select a file to upload";

if($password==$confirm){
      
   if((!empty($username)&& !empty($password))||($username!="" && $password!="")){
           if(createuser($username,$hashed_password)){
            $message="User created successfully";
            }else{
            $message="Check all the fields";
            }
           }else{
                $message="make sure all field are filled";
             }
   
}else{
 $message= "password and confirm password must match";  
}

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

<div id="slideshow">
   <img src="images/sfashions.jpg" alt="the beach"/>
</div>
<div id="leftcol">
<div class="box"><h2>Fashion</h2>
<ul>
<li><a href="productupload.php">Add New fashion product</a></li>
<li><a href="editfashion.php">Upadate products</a></li>
<li><a href="newuser.php">Create new user</a></li>      
</ul>
</div>
<div class="box" align="center"><h2><marquee>Fashion of the week</marquee></h2>
<img src="includes/uploads/fselect.jpg" width=\"150\" height=\"130\" align="center"/>
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
 <form action="newuser.php" enctype="multipart/form-data" method="POST" border="2px">


&nbsp;&nbsp;&nbsp;&nbsp; Username : <input type="text" name="username" value=""/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; Password : <input type="password" name="password" value=""/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp; Confirm Password:<input type="password" name="confirm" value=""/><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="create"/><br/><br/>
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