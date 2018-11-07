<html>
<head>
    <meta charset="UTF-8"/>
    <meta content='IE=edge' http-equiv='X-UA-Compatible'>
    <meta name="viewport"
                        content="width=device-width, initial-scale=1.0"
              >
    <meta name="keywords" content="">
    <meta name="description" content="">
<link rel="shortcut icon" href="gallery/house.jpg" type="image/jpg">
<title>Property Manager</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet"  href="css/sitestyle22.css" type="text/css" media="screen">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
   <script type="text/javascript"  src="js/jquery.js"></script>
      <script type="text/javascript"  src="js/jQuery.print.js"></script>
   <script type="text/javascript" src="js/jq-sticky-anything.js"></script>
   <script type="text/javascript"  src="js/jquery.slideshow.min.js"></script>
     <script type="text/javascript"  src="print/printrep.js"></script>
   <script type="text/javascript">
function detectBrowser()
{
var browser=navigator.appName;
var b_version=navigator.appVersion;
var version=parseFloat(b_version);
if ((browser=="Microsoft Internet Explorer"))
{
alert("Your browser is not supported!");
document.write("This browser is not supported. please use a different browser");
}
}
</script>
   
   <script type="text/javascript">
    $('.topnav').stickThis({
         top:0
       });
    
   </script>
   <script type="text/javascript">
    $(document).ready(function(){
     $('#slideshow').slideshow(
        {
            timeout:5000,
            fadetime:3000,
            type:'sequence'
        }
                               
                               );   
        
        });    
        
   </script>
   <script>
   function printcontent(div){
     var restorepage=document.body.innerHTML;
	 var printcontent=document.getElementById(div).innerHTML;
	 document.body.innerHTML=printcontent;
	 window.print();
	 document.body.innerHTML=restorepage;
      }
   
   </script>
   <script>
   function printreceipt(){
   var myWindow = window.open("", "myWindow", "width=200,height=100");
    myWindow.document.write("<p>This is 'myWindow'</p>");
   }
   </script>
</head>