<?php
//this file stores all functions
function mysql_prep($value){
 $magic_quotes_active=get_magic_quotes_gpc();
 $new_enough_php=function_exists("mysql_real_escape_string");//i.e PHP v4.3.0
 
 if($new_enough_php){
 if($magic_quotes_active){ $value=stripslashes($value);}
 $value=mysql_real_escape_string($value);
 }
 else{
 if(!$magic_quotes_active){ $value=addslashes($value);}
 }
 return $value;
}
function redirect_to($loca=NULL){
if($loca!=NULL){
header("Location:{$loca}");
//exit;
}
}
function confirm_query($result_set){
if(!$result_set){
 die("database query failed".mysql_error());
}
}

function get_allsubjects(){
global $conn;
//3. perform database query
$subject_set=mysql_query("SELECT * 
FROM subjects WHERE visible=1",$conn);
confirm_query($subject_set);
return $subject_set;
}
function get_allpages(){
global $conn;
//3. perform database query
$subject_set=mysql_query("SELECT DISTINCT * 
FROM pages WHERE visible=1  ORDER BY position ASC",$conn);
confirm_query($subject_set);
return $subject_set;
}
function get_allproducts(){
global $conn;
//3. perform database query
$subject_set=mysql_query("SELECT DISTINCT * 
FROM pages WHERE visible=1  ORDER BY position ASC",$conn);
confirm_query($subject_set);
return $subject_set;
}
function get_photoproducts(){
global $conn;
//3. perform database query
$subject_set=mysql_query("SELECT DISTINCT photo 
FROM products",$conn);
confirm_query($subject_set);
return $subject_set;
}
function get_pages_forsubject($sub_id){
global $conn;
$page_set=mysql_query("SELECT * 
FROM pages WHERE subject_id={$sub_id} AND visible=1 
ORDER BY position ASC LIMIT 15",$conn);
confirm_query($page_set);
return $page_set;
}
function get_pages_fornsubject($sub_id,$ofset){
global $conn;
$page_set=mysql_query("SELECT * 
FROM pages WHERE subject_id={$sub_id} AND visible=1 
ORDER BY position ASC LIMIT 10 OFFSET {$ofset}",$conn);
confirm_query($page_set);
return $page_set;
}
function get_pages_foronesubject($sub_id,$type,$location,$ofset){
global $conn;
$page_set=mysql_query("SELECT * 
FROM pages WHERE subject_id={$sub_id} AND type='{$type}' AND location='{$location}' AND visible=1
ORDER BY position ASC LIMIT 10 OFFSET {$ofset}",$conn);
confirm_query($page_set);
return $page_set;
}
function get_location_forsubject($sub_id){
global $conn;
$page_set=mysql_query("SELECT DISTINCT location
FROM pages WHERE subject_id={$sub_id} ORDER BY position ASC",$conn);
confirm_query($page_set);
return $page_set;
}
function get_type_forsubject($sub_id){
global $conn;
$page_set=mysql_query("SELECT DISTINCT type
FROM pages WHERE subject_id={$sub_id} ORDER BY position ASC",$conn);
confirm_query($page_set);
return $page_set;
}
function get_subjects_byid($sub_id){
global $conn;
$result_set=mysql_query("SELECT * FROM `subjects` WHERE id=".$sub_id."",$conn);
confirm_query($result_set);
//if no rows rows are returned fetch array will return false
if($subject=mysql_fetch_array($result_set)){
return $subject;
}
else{
return NULL;
}
return $subject;
}
function get_pages_byid($sub_id){
global $conn;
$result_set=mysql_query("SELECT * FROM `pages` WHERE id=".$sub_id."",$conn);
confirm_query($result_set);
//if no rows rows are returned fetch array will return false
if($subject=mysql_fetch_array($result_set)){
return $subject;
}
else{
return NULL;
}
return $subject;
}
function find_selected_page(){
global $sel_subject;
global $sel_pages;
global $sel_loc;

$maxsubj=count_photos("subjects");
    if(isset($_GET['subj']) && $_GET['subj']<($maxsubj + 1) && $_GET['subj']!=0){
      $sel_subject=get_subjects_byid($_GET['subj']);
     //$sel_pages="";
       }
elseif(isset($_GET['page'])){
$sel_pages=get_pages_byid($_GET['page']);
//$sel_subject="";
}
elseif(isset($_POST['submit'])){
//$sel_loc=get_pages_byid($_POST['location']);
//$sel_subject="";
}
else{
$sel_subject="1";
$sel_pages="1";
$sel_loc="chaani";
}
}
function navigation($sel_subject,$sel_pages){

echo "<ul class=\"current\">";
echo "<b><li><a href=\"staff.php\">Return to Menu</a></li></b><br><br/>";   

//3. perform database query
$subject_set=get_allsubjects();
//4. use returned data
while($subject=mysql_fetch_array($subject_set)){
echo "<li";
if($subject["id"]==$sel_subject['id']){
echo "class=\"selected\"";
}
echo "><a href=\"edit_subject.php?subj=".urlencode($subject["id"])."\">
{$subject["menu_name"]}</a></li>";
echo "<ul class=\"pages\">";
$page_set=get_pages_forsubject($subject["id"]) ;
//4. use returned data
while($page=mysql_fetch_array($page_set)){
       echo "<li";
       if($page['id']==$sel_pages['id']){
	   echo "class=\"selected\"";
	   }
echo "><a href=\"content.php?page=".urlencode($page["subject_id"])."\">{$page["menu_name"]}</a></li>";
}
echo "</ul>";
}
}
function public_navigation($sel_subject,$sel_pages){
$output="<ul class=\"subjects\">";
$subject_set=get_allsubjects();
while($subject=mysql_fetch_array($subject_set)){
$output.="<li";
        if($subject["id"]==$sel_subject['id']){ $output.=" class=\"selected\"";}
        $output.="><a href=\"index.php?subj=" . urlencode($subject["id"]).
        "\">{$subject["menu_name"]}</a></li>";
		if($subject["id"]==$sel_subject["id"]){
		$page_set=get_pages_forsubject($subject["id"]);
		$output .="<ul class=\"pages\">";
		while($page=mysql_fetch_array($page_set)){
		$output .= "<li";
		if($page["id"]==$sel_pages['id']){ $output .="class=\"selected\"";}
		    $output .="><a href=\"index.php?page=" . urlencode($page["id"]).
		    "\">{$page["menu_name"]}</a></li>";
		}
		$output .="</ul>";
		}
		}
		$output .="<br/>";
		$output .="<li><a href=\"login.php\">Staff Area</a></li>";
		$output .="</ul>";
		return $output;
}
function count_all($sid){
global $conn;
//3. perform database query
$subject_set=mysql_query("SELECT COUNT(*) 
FROM pages WHERE visible=1 AND subject_id={$sid}  ORDER BY position ASC",$conn);
confirm_query($subject_set);
if($subject=mysql_fetch_array($subject_set)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function count_photos($table){
global $conn;
//3. perform database query
$subject_set=mysql_query("SELECT COUNT(*) 
FROM {$table} ORDER BY id ASC",$conn);
confirm_query($subject_set);
if($subject=mysql_fetch_array($subject_set)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}

function count_selphotos($table,$sel){
global $conn;
//3. perform database query
$subject_set=mysql_query("SELECT COUNT(*) 
FROM {$table} WHERE category='{$sel}' ORDER BY id ASC",$conn);
confirm_query($subject_set);
if($subject=mysql_fetch_array($subject_set)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}

function count_allsel($sid,$selloc,$type){
global $conn;
//3. perform database query
$subject_set=mysql_query("SELECT COUNT(*) 
FROM pages WHERE visible=1 AND subject_id={$sid} AND type='{$type}' AND location='{$selloc}'  ORDER BY position ASC",$conn);
confirm_query($subject_set);
if($subject=mysql_fetch_array($subject_set)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function create($name,$type,$size){
global $conn;
$page_set=mysql_query("INSERT INTO photos(filename,type,size)
           VALUES('{$name}','{$type}',{$size})",$conn);
if($page_set){
return true;
}else{
return false;
}
}
function createuser($username,$hashpass){
global $conn;
$page_set=mysql_query("INSERT INTO users(username,hashed_pass)
           VALUES('{$username}','{$hashpass}')",$conn);
if($page_set){
return true;
}else{
return false;
}
}
function createfashion($cat,$photo,$desc,$contact){
global $conn;
$page_set=mysql_query("INSERT INTO fashion(category,photo,description,contact)
           VALUES('{$cat}','{$photo}','{$desc}',{$contact})",$conn);
if($page_set){
return true;
}else{
return false;
}
}
function updatefashion($id,$desc,$contact){
global $conn;
$page_set=mysql_query("UPDATE fashion set
         description='{$desc}',contact={$contact} WHERE
          id={$id}",$conn);
if(mysql_affected_rows()==1){
return true;
}else{
return false;
}
}
function deletefashion($id){
global $conn;
$page_set=mysql_query("DELETE FROM fashion WHERE
          id={$id}",$conn);
if(mysql_affected_rows()==1){
return true;
}else{
return false;
}
}
function get_photos($ofset){
global $conn;
//3. perform database query
$subject_set=mysql_query("SELECT DISTINCT * 
FROM photos ORDER BY id ASC LIMIT 5 OFFSET {$ofset}",$conn);
confirm_query($subject_set);
return $subject_set;
}
function get_fashion($ofset,$cat){
//global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysql_query("SELECT DISTINCT * 
FROM fashion WHERE category='{$cat}' ORDER BY id ASC  LIMIT 5 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function get_allfashion($ofset,$cat){
//global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysql_query("SELECT DISTINCT * 
FROM products ORDER BY id ASC  LIMIT 5 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function menu(){
$subject_set=get_allsubjects();
 echo "<ul>";
 echo "<li><a href=\"index.php\" class=\"current\">Home</a></li>";  
while($subject=mysql_fetch_array($subject_set)){
echo "<li><a href=\"fashionproduct.php?subj={$subject["id"]}\">{$subject["menu_name"]}</a>"; 
echo "<ul>";
while($subject_set=get_allsubjects()){
	echo "<li>product1</li>";
}
echo "</ul>";
echo "</li>";
}
if(!isset($_SESSION['username'])){
 echo "<li><a href=\"fashionlogin.php\" class=\"current\">login</a></li>";
}else{
 echo "<li><a href=\"productupload.php\" class=\"current\">Edit </a></li>";
 echo "<li><a href=\"logout.php\" class=\"current\">logout</a></li>";}
echo "</ul>";
}
function __autoload($class_name){
   $class_name=strtolower($class_name);
   $path="../includes/{$class_name}.php";
   if(file_exists($path)){
   require_once($path);
   }else{
   die("The file {$class_name}.php could not be found/");
   }
}
function size_as_text($text){
if($text<1024){
return "{$text}bytes";
}elseif($text<1048576){
$size_kb=round($text/1024);
return "{$size_kb}kb";
}else{
$size_mb=round($text/1048576, 1);
return "{$size_mb}MB";
}
}
?>