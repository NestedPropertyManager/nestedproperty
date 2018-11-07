<?php require_once("includes/session.php")?>
<?php
//this file stores all functions
function mysql_prep($value){
 $magic_quotes_active=get_magic_quotes_gpc();
 $new_enough_php=function_exists("mysql_real_escape_string");//i.e PHP v4.3.0
 
 if($new_enough_php){
 if($magic_quotes_active){ $value=stripslashes($value);}
 $value=mysqli_real_escape_string($value);
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
	global $conn;
if(!$result_set){
 die("database query failed".mysqli_error($conn));
}
}

function get_allsubjects(){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT * 
FROM subjects WHERE visible=1");
confirm_query($subject_set);
return $subject_set;
}
function get_allvessel(){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT * 
FROM vessel");
confirm_query($subject_set);
return $subject_set;
}

function get_vessels(){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT * 
FROM vessel");
confirm_query($subject_set);
return $subject_set;
}
function get_bl(){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT * 
FROM vesselbl");
confirm_query($subject_set);
return $subject_set;
}
function get_specvessel($ves){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT * 
FROM vessel WHERE name='{$ves}'");
confirm_query($subject_set);
return $subject_set;
}
function get_specvesselbl($table,$col,$ves){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT * 
FROM {$table} WHERE {$col}='{$ves}'");
confirm_query($subject_set);
return $subject_set;
}
function get_specbl($bl){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT * 
FROM vesselbl WHERE blname='{$bl}'");
confirm_query($subject_set);
return $subject_set;
}
function get_allpages(){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM pages WHERE visible=1  ORDER BY position ASC");
confirm_query($subject_set);
return $subject_set;
}
function get_allproducts(){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM pages WHERE visible=1  ORDER BY position ASC");
confirm_query($subject_set);
return $subject_set;
}
function get_photoproducts(){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT photo 
FROM products");
confirm_query($subject_set);
return $subject_set;
}
function get_pages_forsubject($sub_id){
global $conn;
$page_set=mysqli_query($conn,"SELECT * 
FROM pages WHERE subject_id={$sub_id} AND visible=1 
ORDER BY position ASC LIMIT 15");
confirm_query($page_set);
return $page_set;
}
function get_pages_fornsubject($sub_id,$ofset){
global $conn;
$page_set=mysqli_query($conn,"SELECT * 
FROM pages WHERE subject_id={$sub_id} AND visible=1 
ORDER BY position ASC LIMIT 10 OFFSET {$ofset}");
confirm_query($page_set);
return $page_set;
}
function get_pages_foronesubject($sub_id,$type,$location,$ofset){
global $conn;
$page_set=mysqli_query($conn,"SELECT * 
FROM pages WHERE subject_id={$sub_id} AND type='{$type}' AND location='{$location}' AND visible=1
ORDER BY position ASC LIMIT 10 OFFSET {$ofset}");
confirm_query($page_set);
return $page_set;
}

function get_millers($ves,$startdate,$enddate,$ofset){
global $conn;
$page_set=mysqli_query($conn,"SELECT * 
FROM millers WHERE vessel='{$ves}' AND date BETWEEN '{$startdate}' AND '{$enddate}'
ORDER BY id DESC LIMIT 10 OFFSET {$ofset}");
confirm_query($page_set);
return $page_set;
}
function get_depots($ves,$startdate,$enddate,$ofset){
global $conn;
$page_set=mysqli_query($conn,"SELECT * 
FROM depots WHERE vessel='{$ves}' AND date BETWEEN '{$startdate}' AND '{$enddate}'
ORDER BY id DESC LIMIT 20 OFFSET {$ofset}");
confirm_query($page_set);
return $page_set;
}
function get_truckatl($ves,$col,$startdate,$ofset){
global $conn;
$page_set=mysqli_query($conn,"SELECT * 
FROM truckatl WHERE vessel='{$ves}' AND {$col}='{$startdate}' AND status='NOT DISPATCHED'
ORDER BY id DESC LIMIT 20 OFFSET {$ofset}");
confirm_query($page_set);
return $page_set;
}
function get_atldispatch($ves,$table,$col,$val){
global $conn;
$page_set=mysqli_query($conn,"SELECT * 
FROM {$table} WHERE vessel='{$ves}' AND {$col}='{$val}'
ORDER BY id");
confirm_query($page_set);
return $page_set;
}
function get_transaction($reference,$startdate,$enddate,$ofset){
global $conn;
$page_set=mysqli_query($conn,"SELECT * 
FROM payment WHERE reference='{$reference}' AND date BETWEEN '{$startdate}' AND '{$enddate}'
ORDER BY id DESC LIMIT 10 OFFSET {$ofset}");
confirm_query($page_set);
return $page_set;
}
function get_propertycashbook($propertyid,$startdate,$enddate,$ofset){
global $conn;
$page_set=mysqli_query($conn,"SELECT * 
FROM payment WHERE property_id='{$propertyid}' AND date BETWEEN '{$startdate}' AND '{$enddate}'
ORDER BY id DESC LIMIT 10 OFFSET {$ofset}");
confirm_query($page_set);
return $page_set;
}
function get_maintenancereport($unitid,$startdate,$enddate,$ofset){
global $conn;
$page_set=mysqli_query($conn,"SELECT * 
FROM service_requisition WHERE unit_code='{$unitid}' AND date BETWEEN '{$startdate}' AND '{$enddate}'
ORDER BY id DESC LIMIT 10 OFFSET {$ofset}");
confirm_query($page_set);
return $page_set;
}

function get_location_forsubject($sub_id){
global $conn;
$page_set=mysqli_query($conn,"SELECT DISTINCT location
FROM pages WHERE subject_id={$sub_id} ORDER BY position ASC");
confirm_query($page_set);
return $page_set;
}
function get_type_forsubject($sub_id){
global $conn;
$page_set=mysqli_query($conn,"SELECT DISTINCT type
FROM pages WHERE subject_id={$sub_id} ORDER BY position ASC");
confirm_query($page_set);
return $page_set;
}
function get_subjects_byid($sub_id){
global $conn;
$result_set=mysqli_query($conn,"SELECT * FROM `subjects` WHERE id=".$sub_id."");
confirm_query($result_set);
//if no rows rows are returned fetch array will return false
if($subject=mysqli_fetch_array($result_set,MYSQLI_NUM)){
return $subject;
}
else{
return NULL;
}
return $subject;
}
function get_tablebyid($table,$sub_id){
global $conn;
$result_set=mysqli_query($conn,"SELECT * FROM {$table} WHERE id=".$sub_id."");
confirm_query($result_set);
//if no rows rows are returned fetch array will return false
if($subject=mysqli_fetch_array($result_set,MYSQLI_NUM)){
return $subject;
}
else{
return NULL;
}
return $subject;
}
function get_pages_byid($sub_id){
global $conn;
$result_set=mysqli_query($conn,"SELECT * FROM `pages` WHERE id=".$sub_id."");
confirm_query($result_set);
//if no rows rows are returned fetch array will return false
if($subject=mysqli_fetch_array($result_set,MYSQLI_NUM)){
return $subject;
}

else{
return NULL;
}
return $subject;
}
function get_refbyid($table,$sub_id){
global $conn;
$result_set=mysqli_query("SELECT * FROM {$table} WHERE id=".$sub_id."",$conn);
confirm_query($result_set);
//if no rows rows are returned fetch array will return false
if($subject=mysqli_fetch_array($result_set,MYSQLI_NUM)){
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
function find_tablepage($table){
global $sel_subject;
global $sel_pages;


$maxsubj=count_selvessel($table);
    if(isset($_GET['subj']) && $_GET['subj']<($maxsubj + 1) && $_GET['subj']!=0){
      $sel_subject=get_tablebyid($table,$_GET['subj']);
     //$sel_pages="";
       }
elseif(isset($_GET['page'])){
$sel_pages=get_refid($table,$_GET['page']);
//$sel_subject="";
}
elseif(isset($_POST['submit'])){
//$sel_loc=get_pages_byid($_POST['location']);
//$sel_subject="";
}
else{
$sel_subject="1";
$sel_pages="1";
}
}
function navigation($sel_subject,$sel_pages){

echo "<ul class=\"current\">";
echo "<b><li><a href=\"staff.php\">Return to Menu</a></li></b><br><br/>";   

//3. perform database query
$subject_set=get_allsubjects();
//4. use returned data
while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
echo "<li";
if($subject["id"]==$sel_subject['id']){
echo "class=\"selected\"";
}
echo "><a href=\"edit_subject.php?subj=".urlencode($subject["id"])."\">
{$subject["menu_name"]}</a></li>";
echo "<ul class=\"pages\">";
$page_set=get_pages_forsubject($subject["id"]) ;
//4. use returned data
while($page=mysqli_fetch_array($page_set,MYSQLI_ASSOC)){
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
while($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
$output.="<li";
        if($subject["id"]==$sel_subject['id']){ $output.=" class=\"selected\"";}
        $output.="><a href=\"index.php?subj=" . urlencode($subject["id"]).
        "\">{$subject["menu_name"]}</a></li>";
		if($subject["id"]==$sel_subject["id"]){
		$page_set=get_pages_forsubject($subject["id"]);
		$output .="<ul class=\"pages\">";
		while($page=mysqli_fetch_array($page_set,MYSQLI_ASSOC)){
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
$subject_set=mysqli_query($conn,"SELECT COUNT(*) 
FROM pages WHERE visible=1 AND subject_id={$sid}  ORDER BY position ASC");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
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
$subject_set=mysqli_query($conn,"SELECT COUNT(*) AS vl 
FROM {$table} ORDER BY id ASC");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function count_value($table){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT COUNT(*) 
FROM {$table}");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
}
function count_svalue($table,$col,$data){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT COUNT(*) 
FROM {$table} WHERE {$col}='{$data}'");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function count_twovalue($table,$col1,$data1,$col2,$data2){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT COUNT(*) 
FROM {$table} WHERE {$col1}='{$data1}' AND {$col2}='{$data2}'");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
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
$subject_set=mysqli_query($conn,"SELECT COUNT(*) 
FROM {$table} WHERE category='{$sel}' ORDER BY id ASC");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function get_summation($table,$data,$col1,$val1,$col2,$val2){
global $conn;
$subject_set=mysqli_query($conn,"SELECT SUM({$data}) AS sm
FROM {$table} WHERE {$col1}='{$val1}' AND {$col2}='{$val2}'");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function get_onesum($data,$table,$col,$val){
global $conn;
$subject_set=mysqli_query($conn,"SELECT SUM({$data}) AS sm
FROM {$table} WHERE {$col}='{$val}'");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function get_acconesum($data,$table,$col,$val,$col2,$val2){
global $conn;
$subject_set=mysqli_query($conn,"SELECT SUM({$data}) AS sm
FROM {$table} WHERE {$col}='{$val}' AND {$col2}='{$val2}'");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function get_accsum($data,$table,$col,$val,$col2,$val2,$col3,$val3){
global $conn;
$subject_set=mysqli_query($conn,"SELECT SUM({$data}) AS sm
FROM {$table} WHERE {$col}='{$val}' AND {$col2}='{$val2}' AND {$col3}='{$val3}'");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function count_selvessel($table){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT COUNT(*) 
FROM {$table} ORDER BY id ASC");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function count_seltable($table){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT COUNT(*) 
FROM {$table}");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}

function count_vcount($table,$vessel,$type){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT COUNT(*) 
FROM {$table} WHERE vessel='{$vessel}' AND type='{$type}' ORDER BY id ASC");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function count_vtablecount($table,$col1,$data1,$col2,$data2){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT COUNT(*) 
FROM {$table} WHERE {$col1}='{$data1}' AND {$col2}='{$data2}' ORDER BY date ASC");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function count_2vtablecount($table,$col1,$data1,$col2,$data2,$col3,$data3){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT COUNT(*) 
FROM {$table} WHERE {$col1}='{$data1}' AND {$col2}='{$data2}' AND {$col3}='{$data3}' ORDER BY date ASC");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function count_allovcount($table,$vessel,$col,$val){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT COUNT(*) 
FROM {$table} WHERE vessel='{$vessel}' AND {$col}='{$val}' ORDER BY id ASC");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function count_anycount($table,$col1,$vessel,$col,$val){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT COUNT(*) 
FROM {$table} WHERE {$col1}='{$vessel}' AND {$col}='{$val}' ORDER BY id ASC");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function count_schedule($table,$vessel,$type,$date){
global $conn;
//3. perform database query
$subject_set=mysql_query($conn,"SELECT COUNT(*) 
FROM {$table} WHERE vessel='{$vessel}' AND type='{$type}' AND date='{$date}' ORDER BY id ASC");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
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
$subject_set=mysqli_query($conn,"SELECT COUNT(*) 
FROM pages WHERE visible=1 AND subject_id={$sid} AND type='{$type}' AND location='{$selloc}'  ORDER BY position ASC");
confirm_query($subject_set);
if($subject=mysqli_fetch_array($subject_set,MYSQLI_ASSOC)){
return array_shift($subject);
}
else{
return NULL;
}
return array_shift($subject);
}
function create($name,$type,$size){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO photos(filename,type,size)
           VALUES('{$name}','{$type}',{$size})");
if($page_set){
return true;
}else{
return false;
}
}
function createuser($username,$hashpass){
global $conn;
$page_set=mysql_query($conn,"INSERT INTO users(username,hashed_pass)
           VALUES('{$username}','{$hashpass}')");
if($page_set){
return true;
}else{
return false;
}
}
function createtenant($date,$tenantid,$unitid,$tenantname,$national,$location,$other,$user){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO tenantt(date,tenant_code,unit_code,tenant_name,national_id,location,other_details,created_by)
           VALUES('{$date}','{$tenantid}','{$unitid}','{$tenantname}',{$national},'{$location}','{$other}','{$user}')");
if($page_set){
return true;
}else{
return false;
}
}
function tenantarchive($date,$tenantid,$unitid,$tenantname,$national,$location,$other,$user){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO tenantarchive(date,tenant_code,unit_code,tenant_name,national_id,location,other_details,deleted_by)
           VALUES('{$date}','{$tenantid}','{$unitid}','{$tenantname}',{$national},'{$location}','{$other}','{$user}')");
if($page_set){
return true;
}else{
return false;
}
}
function createaccount($date,$account,$landlord,$amount){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO account(date,account_no,landlord_id,amount)
           VALUES('{$date}','{$account}','{$landlord}',{$amount})");
if($page_set){
return true;
}else{
return false;
}
}
function makepayment($date,$propertyid,$transactionid,$typecode,$reference,$mode,$unitcode,$description,$amount,$user){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO payment(date,property_id,transaction_no,type_code,reference,mode,unit_code,description,amount,created_by)
VALUES('{$date}','{$propertyid}','{$transactionid}','{$typecode}','{$reference}','{$mode}','{$unitcode}','{$description}','{$amount}','{$user}')");
if($page_set){
return true;
}else{
return false;
}
}
function requisition($date,$requisitionid,$unitid,$landlord,$description,$amount,$approval,$user){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO service_requisition(date,requisition_no,unit_code,landlord_id,description,amount,approval,created_by)
           VALUES('{$date}','{$requisitionid}','{$unitid}','{$landlord}','{$description}','{$amount}','{$approval}','{$user}')");
if($page_set){
return true;
}else{
return false;
}
}
function createvessel($name,$commodity,$opening,$balance,$allocbal){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO vessel(name,commodity,openingbal,closingbalance,balance,allocationbal)
           VALUES('{$name}','{$commodity}',{$opening},{$balance},{$balance},{$allocbal})");
if($page_set){
return true;
}else{
return false;
}
}

function createdestination($vessel,$bl,$type,$name,$ref,$opening,$eod,$balance,$atlbalance){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO destination(vessel,blname,type,destination,reference,openingbal,eodbalance,balance,atlbalance)
           VALUES('{$vessel}','{$bl}','{$type}','{$name}','{$ref}','{$opening}','{$eod}',{$balance},{$atlbalance})");
if($page_set){
return true;
}else{
return false;
}
}
function createbl($vessel,$blname,$commodity,$opening,$stockbalance,$allocationbal,$balance){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO vesselbl(vesselname,blname,commodity,openingbal,stockbalance,allocationbal,balance)
           VALUES('{$vessel}','{$blname}','{$commodity}',{$opening},{$stockbalance},{$allocationbal},{$balance})");
if($page_set){
return true;
}else{
return false;
}
}

function createatl($vessel,$type,$date,$transporter,$truck,$delivery,$atl,$contact,$quantity,$destination,$ref,$status){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO atl(vessel,type,date,transporter,truck,delivery,atl,contact,quantity,destination,reference,status)
           VALUES('{$vessel}','{$type}','{$date}','{$transporter}','{$truck}','{$delivery}','{$atl}','{$contact}',{$quantity},'{$destination}','{$ref}','{$status}')");
if($page_set){
return true;
}else{
return false;
}
}
function createdespatch($vessel,$bl,$type,$date,$transporter,$truck,$delivery,$atl,$da,$weight,$quantity,$destination){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO dispatch(vessel,blname,type,date,transporter,truck,external,atl,da,weight,quantity,destination)
           VALUES('{$vessel}','{$bl}','{$type}','{$date}','{$transporter}','{$truck}',{$delivery},'{$atl}','{$da}','{$weight}','{$quantity}','{$destination}')");
if($page_set){
return true;
}else{
return false;
}
}

function createmiller($vessel,$destination,$date,$shift,$ref,$qout){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO millers(vessel,destination,date,shift,ref,quantityout)
           VALUES('{$vessel}','{$destination}','{$date}','{$shift}','{$ref}',{$qout})");
if($page_set){
return true;
}else{
return false;
}
}

function createlandlord($landlordid,$date,$agent,$landlordname,$national,$location,$other){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO landlord(landlord_id,date,agent_code,landlord_name,national_id,location,other_details)
           VALUES('{$landlordid}','{$date}','{$agent}','{$landlordname}',{$national},'{$location}','{$other}')");
if($page_set){
return true;
}else{
return false;
}
}
function createnewstaff($staffid,$date,$agentid,$staffname,$nationalid){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO staff(staff_code,date,agent_code,staff_name,national_id)
           VALUES('{$staffid}','{$date}','{$agentid}','{$staffname}',{$nationalid})");
if($page_set){
return true;
}else{
return false;
}
}
function createpropertytype($date,$typecode,$typename){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO property_type(date,type_code,type_name)
           VALUES('{$date}','{$typecode}','{$typename}')");
if($page_set){
return true;
}else{
return false;
}
}
function createunit($date,$unitid,$propertyid,$location,$type,$rent,$availability,$user){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO propertyunit(date,code,property_id,unit_location,unit_type,monthly_rent,availability,created_by)
           VALUES('{$date}','{$unitid}','{$propertyid}','{$location}','{$type}',{$rent},'{$availability}','{$user}')");
if($page_set){
return true;
}else{
return false;
}
}
function createproperty($date,$propertyid,$typeid,$agentid,$landlordid,$location,$details,$user){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO property(date,property_id,type_code,agent_code,landlord_code,property_location,other_details,created_by)
           VALUES('{$date}','{$propertyid}','{$typeid}','{$agentid}','{$landlordid}','{$location}','{$details}','{$user}')");
if($page_set){
return true;
}else{
return false;
}
}
function createatlarchive($atl,$destination,$qout){
global $conn;
$page_set=mysqli_query($conn,"INSERT INTO atlarchive(atl,destination,quantity)
           VALUES('{$atl}','{$destination}',{$qout})");
if($page_set){
return true;
}else{
return false;
}
}
function get_destination($ref){
global $conn;
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM destination WHERE reference='{$ref}' LIMIT 1");
confirm_query($subject_set);
return $subject_set;
}
function get_alldestination($table){
global $conn;
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM {$table}");
confirm_query($subject_set);
return $subject_set;
}
function get_dispatch($atl,$da){
global $conn;
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM dispatch WHERE atl='{$atl}' AND da='{$da}' LIMIT 1");
confirm_query($subject_set);
return $subject_set;
}
function updatedestination($ref,$qout){
		global $conn;
$page_set=mysqli_query($conn,"update destination
 set balance=balance-{$qout}
 where reference='{$ref}';");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function positivepayment($amount,$ref){
		global $conn;
$page_set=mysqli_query($conn,"update account
 set accbalance=accbalance+{$amount}
 where landlord_id='{$ref}';");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function negativepayment($amount,$ref){
		global $conn;
$page_set=mysqli_query($conn,"update account
 set accbalance=accbalance-{$amount}
 where landlord_id='{$ref}';");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}

function unitavailability($availability,$ref){
		global $conn;
$page_set=mysqli_query($conn,"update propertyunit
 set availability={$availability}
 where code='{$ref}';");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updatedestocks($vessel,$bl,$destination,$qout){
		global $conn;
$page_set=mysqli_query($conn,"update destination
 set balance=balance-{$qout}
 where vessel='{$vessel}' AND blname='{$bl}' AND destination='{$destination}';");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updateallocation($newopening,$bal,$ref){
		global $conn;
$page_set=mysqli_query($conn,"update destination
 set openingbal={$newopening} AND balance=balance+({$newopening}-openingbal)
 where reference='{$ref}';");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updatebalances($table,$ref,$col,$qty){
		global $conn;
$page_set=mysqli_query($conn,"update {$table}
 set {$col}={$col}-{$qty}
 where reference='{$ref}';");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updatestaff($name,$newid,$staffid){
		global $conn;
$page_set=mysqli_query($conn,"update staff
 set staff_name='{$name}',national_id={$newid}
 where staff_code='{$staffid}';");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updatelandlord($name,$national,$location,$other,$landlordid){
		global $conn;
$page_set=mysqli_query($conn,"update landlord
 set landlord_name='{$name}',national_id={$national},location='{$location}',other_details='{$other}'
 where landlord_id={$landlordid};");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updatetenant($name,$national,$other,$tenantid){
		global $conn;
$page_set=mysqli_query($conn,"update tenantt
 set tenant_name='{$name}',national_id={$national},other_details='{$other}'
 where tenant_code={$tenantid};");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function approverequisition($approval,$requisitionid,$landlordid,$approver){
		global $conn;
$page_set=mysqli_query($conn,"update service_requisition
 set approval='{$approval}',approved_by='{$approver}'
 where requisition_no='{$requisitionid}' AND landlord_id='{$landlordid}' AND approval='Not Approved';");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updateatldelbalances($table,$col,$spec,$ref,$qty){
		global $conn;
$page_set=mysqli_query($conn,"update {$table}
 set {$col}={$col}+{$qty}
 where {$spec}='{$ref}';");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updatevesselqty($ref,$qout){
global $conn;
$page_set=mysqli_query($conn,"update vessel
 set balance=balance-{$qout}
 where name='{$ref}'");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updateblqty($ref,$qout){
global $conn;
$page_set=mysqli_query($conn,"update vesselbl
 set stockbalance=stockbalance-{$qout}
 where blname='{$ref}'");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updatevesselcqty($ref,$col,$qout){
global $conn;
$page_set=mysqli_query($conn,"update vessel
set {$col}={$col}-{$qout}
 where name='{$ref}'");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updatevesselaqty($ref,$col,$qout){
global $conn;
$page_set=mysqli_query($conn,"update vessel
set {$col}={$col}+{$qout}
 where name='{$ref}'");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updatevesselallocation($ref,$alloc){
global $conn;
$page_set=mysqli_query($conn,"update vessel
 set allocationbal=allocationbal-{$alloc}
 where name='{$ref}'");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updateblallocation($ref,$alloc){
global $conn;
$page_set=mysqli_query($conn,"update vesselbl
 set allocationbal=allocationbal-{$alloc}
 where blname='{$ref}'");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updateatlbalance($ref,$qout){
		global $conn;
$page_set=mysqli_query($conn,"update destination
 set atlbalance=atlbalance-{$qout}
 where reference='{$ref}';",$conn);
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updateblatlbalance($ref,$qout){
		global $conn;
$page_set=mysqli_query($conn,"update vesselbl
 set balance=balance-{$qout}
 where blname='{$ref}';");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updateatlarchive($ref,$qout){
		global $conn;
$page_set=mysqli_query($conn,"update destination
 set atlbalance=atlbalance+{$qout}
 where reference='{$ref}';");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updateatlstatus($ref){
		global $conn;
$page_set=mysqli_query($conn,"update truckatl
 set status='dispatched'
 where atl='{$ref}';");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function deleteatl($atl){
		global $conn;
$page_set=mysqli_query($conn,"DELETE FROM truckatl
 WHERE atl={$atl} AND status='NOT DISPATCHED';",$conn);
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function sendtoarchive($table,$col,$data){
		global $conn;
$page_set=mysqli_query($conn,"DELETE FROM {$table}
 WHERE {$col}='{$data}';");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function updatefashion($id,$desc,$contact){
global $conn;
$page_set=mysqli_query($conn,"UPDATE fashion set
         description='{$desc}',contact={$contact} WHERE
          id={$id}");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function deletefashion($id){
global $conn;
$page_set=mysqli_query($conn,"DELETE FROM fashion WHERE
          id={$id}");
if(mysqli_affected_rows($conn)==1){
return true;
}else{
return false;
}
}
function get_photos($ofset){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM photos ORDER BY id ASC LIMIT 10 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function get_vessel($ofset){
global $conn;
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM vessel ORDER BY id ASC LIMIT 10 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function get_fashion($ofset,$cat){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM fashion WHERE category='{$cat}' ORDER BY id ASC  LIMIT 5 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function get_tabledetails($table,$ofset,$col1,$data1,$col2,$data2){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM {$table} WHERE {$col1}='{$data1}' AND {$col2}='{$data2}' ORDER BY id ASC  LIMIT 20 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function get_anyallocation($ofset,$ves,$col,$cat){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM destination WHERE vessel='{$ves}' AND {$col}='{$cat}' ORDER BY id ASC  LIMIT 20 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function get_alltabledetails($table,$ofset){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM {$table} ORDER BY id ASC  LIMIT 20 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function get_spectabledetails($table,$col,$data,$ofset){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM {$table} WHERE {$col}='{$data}' ORDER BY id ASC  LIMIT 20 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}

function get_dschedule($ofset,$ves,$type,$date,$depot){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT *
FROM dispatch WHERE vessel='{$ves}' AND type='{$type}' AND date='{$date}' AND destination LIKE '%{$depot}%' ORDER BY id ASC  LIMIT 20 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function get_alldschedule($ofset){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM dispatch ORDER BY id ASC  LIMIT 20 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function get_miller($ofset,$cat){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM millers WHERE vid='{$cat}' ORDER BY id ASC  LIMIT 10 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function get_allmillers($ofset){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM millers ORDER BY date DESC  LIMIT 20 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function get_depot($ofset,$cat){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM depots WHERE vid='{$cat}' ORDER BY id ASC  LIMIT 5 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function get_specdepot($vesselname,$depotname){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM destination WHERE vessel='{$vesselname}' AND destination LIKE '%{$depotname}%' ORDER BY id ASC");
confirm_query($subject_set);
return $subject_set;
}
function get_spectruckatl($vesselname,$col,$val){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM truckatl WHERE vessel='{$vesselname}' AND {$col} LIKE '%{$val}%'");
confirm_query($subject_set);
return $subject_set;
}
function get_specdespatch($vesselname,$depotname){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM depots WHERE vessel='{$vesselname}' AND destination LIKE '%{$depotname}%'");
confirm_query($subject_set);
return $subject_set;
}
function get_specatl($vessel,$ref){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM atl WHERE vessel='{$vessel}' AND reference LIKE '%{$ref}%'");
confirm_query($subject_set);
return $subject_set;
}
function get_alldepots($ofset){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM depots ORDER BY id ASC  LIMIT 20 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function get_alldata($table,$ofset){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM {$table} ORDER BY id ASC  LIMIT 20 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function get_table($table,$col,$data){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM {$table} WHERE {$col}='{$data}' ORDER BY id");
confirm_query($subject_set);
return $subject_set;
}
function get_onedata($table,$col,$data){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM {$table} WHERE {$col}='{$data}'");
confirm_query($subject_set);
return $subject_set;
}
function get_twocoldata($table,$col,$data,$col2,$data2){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM {$table} WHERE {$col}='{$data}' AND {$col2}='{$data2}' ");
confirm_query($subject_set);
return $subject_set;
}
function get_spectwodata($table,$val,$col,$data,$col2,$data2){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT {$val} 
FROM {$table} WHERE {$col}='{$data}' AND {$col2}='{$data2}' ");
confirm_query($subject_set);
return $subject_set;
}
function get_gentable($table){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM {$table}");
confirm_query($subject_set);
return $subject_set;
}
function get_genspectable($table,$col){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT {$col} 
FROM {$table}");
confirm_query($subject_set);
return $subject_set;
}
function get_specdata($table,$col,$data,$offset){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM {$table} WHERE {$col}='{$data}' ORDER BY id ASC  LIMIT 20 OFFSET {$offset}");
confirm_query($subject_set);
return $subject_set;
}
function get_ntwodata($table,$val,$col,$data,$col2,$data2,$offset){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT {$val} 
FROM {$table} WHERE {$col}='{$data}' AND {$col2} !='{$data2}' ORDER BY id ASC  LIMIT 20 OFFSET {$offset}");
confirm_query($subject_set);
return $subject_set;
}
function get_allfashion($ofset,$cat){
global $conn;
//ORDER BY id ASC 
//3. perform database query
$subject_set=mysqli_query($conn,"SELECT DISTINCT * 
FROM products ORDER BY id ASC  LIMIT 5 OFFSET {$ofset}");
confirm_query($subject_set);
return $subject_set;
}
function menu(){
$subject_set=get_allsubjects();
 echo "<ul>"; 
if(!isset($_SESSION['username'])){
 echo "<li><a href=\"login.php\" class=\"current\">login</a></li>";
}else{
echo "<li><a href=\"index.php\" class=\"current\">Home </a></li>";
 echo "<li><a href=\"newproperty.php\" class=\"current\">property manager </a></li>";
   echo "<li><a href=\"newlandlord.php\" class=\"current\">Landlord </a></li>";
      echo "<li><a href=\"newproperty.php\" class=\"current\">property management </a></li>";
	       echo "<li><a href=\"newtenant.php\" class=\"current\">Tenant</a></li>";
		   if($_SESSION['accesslevel']=='manager'|| $_SESSION['accesslevel']=='staff' ){echo "<li><a href=\"maintenancereport.php\" class=\"current\">Property maintenance </a></li>";}
echo "<li><a href=\"cashbook.php\" class=\"current\">Finance </a></li>";
echo "<li><a href=\"#\" class=\"current\">Reports </a></li>";
echo "<li><a href=\"logout.php\" class=\"current\">logout<span><img src=\"images/off.png\"/></span></a></li>";}
echo "</ul>";
}
function sidemenu(){
 echo "<ul><li><a href=\"newproperty.php\">Property Management </a></li>
<li><a href=\"landlordlist.php\">Landlord</a></li>
<li><a href=\"propertylist.php\">Property Management</a></li>
<li><a href=\"newtenant.php\">Tenant</a></li>
<li><a href=\"unitlist.php\">Property Units Availability</a></li>
<li><a href=\"requisitionlist.php\">Property Maintenance</a></li>
<li><a href=\"#\">Payment History</a></li>
<li><a href=\"#\">Reports</a></li>
   </ul>"; 
}
function receipt($date,$transaction,$type,$name,$property,$unit,$desc,$amount,$user){
	echo "<b>Tranaction Date&nbsp;&nbsp;:</b>{$date}<br/><br/>";
	echo "<b>Tranaction No&nbsp;&nbsp;:</b>{$transaction}<br/><br/>";
	echo "<b>Tranaction Type Code</b>&nbsp;&nbsp;:</b>{$type}<br/><br/>";
	echo "<b>Tenant Name</b>&nbsp;&nbsp;:</b>{$name}<br/><br/>";
	echo "<table width=\"450\" cellspacing=\"4\" cellpadding=\"4\" border=\"0\">";
	echo "<tr  bgcolor=\"#ccccff\">";
	echo "<th><b>Property No</b></th>";
	echo "<th><b>Property Unit No</b></th>";
	echo "<th><b>Description</b></th>";
	echo "<th><b>Amount</b></th>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>{$property}</td>";
	echo "<td>{$unit}</td>";
	echo "<td>{$desc}</td>";
	echo "<td>Ksh.{$amount}</td>";
	echo "</tr>";
	echo "</table><br/>";
	echo "<b>Prepared By</b>..................{$user}...<br/><br/>";
    echo "<b>Signature By</b>.............................<br/><br/>";
    echo "<b>Date</b>......................................<br/><br/>";	
	echo "<button onclick=\"printelem('printreceipt')\" class=\"btn btn-success\" >Print Receipt</button>";
}
function landlord(){
 echo "<b><ul><li><a href=\"newproperty.php\">Property Management </a></li>
<li><a href=\"landlordlist.php\">Create New Landlord</a></li>
<li><a href=\"propertylist.php\">Edit Landlord Profile</a></li>
<li><a href=\"newtenant.php\">View Landlord List</a></li>
<li><a href=\"requisitionlist.php\">Property Statement</a></li>
<li><a href=\"#\">Requisition Approval</a></li>
   </ul></b>"; 
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