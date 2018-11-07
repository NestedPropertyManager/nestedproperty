<?php
class photos{
    public $id;
    public $filename;
    public $type;
    public $size;
    public $caption;
	
	public $temp_path;
	protected $upload_dir="uploads";
	public $errors=array();
	
	public $upload_errors=array(
UPLOAD_ERR_OK       =>"NO errors",
UPLOAD_ERR_INI_SIZE =>"Larger than upload_max_filesize",
UPLOAD_ERR_FORM_SIZE=>"Larger than form MAX_FILE_SIZE",
UPLOAD_ERR_PARTIAL  =>"Partial upload",
UPLOAD_ERR_CANT_WRITE  =>"cant write to disk",
UPLOAD_ERR_EXTENSION  =>"File upload stopped by extension"
);
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
function confirm_query($result_set){
if(!$result_set){
 die("database query failed".mysql_error());
}
}
public function attach_file($file){
//perform error checking on form parameters
    if(!$file||empty($file)||!is_array($file)){
	//error: nothing uploaded or wrong with argument usage
	$this->errors[]="No file was uploaded";
	return false;
    } elseif($file['error']!=0){
	//error: report what php says went wrong
	$this->errors[]=$this->upload_errors[$file['error']];
	return false;
	}else{
	//set object attributes to the form parameters
	$this->temp_path=$file['tmp_name'];
	$this->filename=basename($file['name']);
	$this->type=$file['type'];
	$this->size=$file['size'];	
	return true;
	}
}
public function find_by_id(){
}
public function save(){
if(isset($this->id)){
$this->update();
}else{
//make sure there are no errors
//if(!empty($this->errors)){retuen false;}
$target_file=basename($_FILES['file_upload']['name']);
    if(move_uploaded_file($this->temp_path,$target_path)){
	//success
	//save to a corresponding entry to the database
	        if($this->create()){
			unset($this->temp_path);
			return true;
			}
       }
	   else{
	   $this->errors[]="file upload failed";
	   return false;
	   }
}
}
public function create(){
global $conn;
$page_set=mysql_query("INSERT INTO photos(filename,type,size,caption) VALUES('{$this->filename}', 
'{$this->type}',{$this->size},'{$this->caption}')",$conn);
confirm_query($page_set);
return true;
}
public function update(){
}
public function delete(){
}
}
?>