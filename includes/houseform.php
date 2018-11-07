<?php include("includes/header.php")?>
<?php require_once("connect.php");?>
<?php require_once("includes/functions.php");?>
<?php
find_selected_page();
?>

<form action="searchresults.php?subj=<?php echo urlencode($sel_subject['id']);?>" method="post" fieldset="3">
<p><b>Type:</b>
<select name="type">
<?php
$subject_set=get_type_forsubject($_GET['subj']);
$subject_count=mysql_num_rows($subject_set);
while($subject=mysql_fetch_array($subject_set)){
echo "<option value=\"{$subject['type']}\"";
echo ">{$subject['type']}</option>"; 
}
?>
</select>
&nbsp;&nbsp;&nbsp;
<b>Location:</b>
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
<br/>
<tr><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="submit" value="Search" style="background-color: #ccffcc" />
</p>
</form>   
<div style="margin-top: 2.5em; border-top: 1px solid #000000;"></div><td></tr>	
 
	