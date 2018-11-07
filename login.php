<?php require_once("includes/session.php");?>
<?php
sign_in();
?>
<?php include("includes/header.php")?>
<?php require_once("connect.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/pagination.php");?>
<?php require_once("includes/photos.php");?>
<?php
find_selected_page();
?>
<?php
    include_once("includes/form_functions.php");
	
	//START PROCESSING
	if(isset($_POST['submit'])){
	//Form has been submitted
	$errors=array();
	$required_field=array('username', 'password');
	foreach($required_field as $fieldname){
     if(!isset($_POST[$fieldname])||empty($_POST[$fieldname])){
      $errors[]=$fieldname;
        }
       }
    $fields_with_length=array('password'=>30);
   foreach($fields_with_length as $fieldname=>$maxlength){
     if(strlen(trim(mysql_prep($_POST[$fieldname])))>$maxlength){
      $errors[]=$fieldname;
       }
	   }
    $username=trim(mysql_prep($_POST['username']));
    $password=trim(mysql_prep($_POST['password']));
	$hashed_password=sha1($password);
	 
	
	if(empty($errors)){
	$query="SELECT * FROM users WHERE username='{$username}'
        AND hashed_pass='{$password}'";
	$result_set=mysqli_query($conn,$query);
	confirm_query($result_set);
	if(mysqli_num_rows($result_set)==1){
	//username/password authentication
	$found_user=mysqli_fetch_array($result_set,MYSQLI_ASSOC);
	$_SESSION['user_id']=$found_user['id'];
	$_SESSION['username']=$found_user['username'];
	$_SESSION['accesslevel']=$found_user['accesslevel'];
	
	redirect_to("index.php");
	}else{
	$message="username/password combination incorrect.<br/>
	please make sure your caps lock is off and try again";
	}	
	}else{
	if(count($errors)==1){
	$message="there was 1 error in the form";
	}
	else{
	$message="there were ".count($errors)." errors in the form";
	}
	}
 
	}else{
	//Form has not been submitted
	$message="Admin Area, log in with your<br/> username and password<br/>";
	if(isset($_GET['logout'])&& $_GET['logout']==1){
	$message="you are now logged out";
	
	}
	
	$username="";
	$password="";
	}
?>


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
<div class="box"><h2>Property Manager</h2>
<img src="images/house1.jpg" width=\"150\" height=\"130\" align="center"/>

</div>    
</div>
<div id="rightcol"><br/>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<bold><i>Log in with your username and password to access Property Manager </i></bold></p>
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
<div class="login-form">
<form action="login.php" method="POST">
<h1>Log in</h1>
<div class="message">
<?php echo $message."<br/>";?>
</div><br/>
<p>Username:&nbsp;
<input type="text" name="username" placeholder="username" value="<?php echo htmlentities($username)?>" required/></p><br/>
<p>password:&nbsp;&nbsp;
<input type="password" name="password" value="<?php echo htmlentities($password)?>" required/></p><br/>
<p>
<input type="submit" class="btn btn-success" name="submit" value="sign in"/>&nbsp;&nbsp;<a href="index.php"><bold>cancel</bold></a></p>
<br/><br/>
</form>
</div>
<div class="rightcol2">
<?php  
$subject_pages=get_pages_forsubject("3");
echo "<ul>";
while($page=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){
echo "<li><a href=\"index.php?subj=3\"><img src=\"images/sidenav.jpg\"/>{$page['menu_name']}</a></li>";
}
echo "</ul>";
/*include("includes/defaultselect.php");*/
 ?>
 </div><br/><br/>
<div class="rightcol3" align="center">
<br/><br/>
</div>
<?php }?>

<?php if(isset($_GET['subj'])){
/*include("includes/houseform.php");*/
$subject_pages=get_pages_fornsubject($sel_subject['id'],$pagination->offset());
while($page=mysqli_fetch_array($subject_pages,MYSQLI_ASSOC)){
echo "<h><b>{$page['menu_name']}</b></h>";
echo "<p>{$page['content']}</p><br/><br/>";
}
}
?> 
<br/><br/>
</div>
<?php include("includes/footer.php")?>