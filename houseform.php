<?php include("includes/header.php")?>
<?php require_once("connect.php");?>
<?php require_once("includes/functions.php");?>
<?php
find_selected_page();
?>
<?php
$food=$_POST["food"];
$location=$_POST["location"];

if(!isset($_POST['submit'])){
//if the page is not submitted to itself, echo the form
?>
<?php
find_selected_page();
?>
<body>
<div id="wrapbg">
<div id="wrap">
<div id="banner">
<div id="logo"><a href="index.php"><img src="images/logo.jpg" alt="logo"></a></div>
<div id="topnav">
<ul>
<li><a href="index.php" class="current">Home</a></li>    
<li><a href="about.php">About us</a></li>
<li><a href="gallery.php">Gallery</a></li>
<li class="last"><a href="contacts.php">Contacts</a></li>
<li class="last"><a href="memberin.php">Log in</a></li>
<li class="last"><a href="login.php">Sign in</a></li>
</ul>
        
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
<div class="box"><h2>videos</h2></div>
<div class="box"><h2>quotes</h2><p>
Did you know 
changamwe has the best schools in mombasa county
</p>
<br></div>
    
</div>
<div id="rightcol">
<h1>
<?php if(isset($_GET['subj'])){
echo $sel_subject['menu_name'];
}else if(!isset($_GET['subj'])){
echo "Welcome to nyumbasearch";
}
?>
</h1>
search all the prefered houses within changamwe locality.
<br/><br/>
<form method="post" action="<?php echo $PHP_SELF;?>">
<p>
<select name="food">
<?php
$subject_set=get_location_forsubject($_GET['subj']);
$subject_count=mysql_num_rows($subject_set);
while($subject=mysql_fetch_array($subject_set)){
echo "<option value=\"{$subject['location']}\"";
echo ">{$subject['location']}</option>"; 
}
?>

</select>
<b>location:</b>
<select name="location">
<?php
$subject_set=get_location_forsubject($_GET['subj']);
$subject_count=mysql_num_rows($subject_set);
while($subject=mysql_fetch_array($subject_set)){
echo "<option value=\"{$subject['location']}\"";
echo ">{$subject['location']}</option>"; 
}
?>
</select>
</p>
</form>
<?php
}else{
echo "wow!!!!!";
}
?>  
</div>
<?php include("includes/footer.php")?>