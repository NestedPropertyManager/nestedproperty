function printcontent(el){
     var restorepage=document.body.innerHTML;
	 var printcontent=document.getElementById(el).innerHTML;
	 //document.body.innerHTML=printcontent;
	 window.open(printcontent);
	 window.print();
	document.body.innerHTML=restorepage;
      }
	  function printout(printdiv){
      var DocumentContainer = document.getElementById(printdiv);
    var WindowObject = window.open('', 'PrintWindow', 'width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes');
    WindowObject.document.writeln(DocumentContainer.innerHTML);
    WindowObject.document.close();
    WindowObject.focus();
    WindowObject.print();
    WindowObject.close();

}
function print(){
	// here we will write our custom code for printing our div
		$(function(){
			$('#printreceipt').on('click', function() {
                //Print ele2 with default options
                $.print(".form");
            });
		});
}
function printdata(printdiv)
{
	$(function(){
		$(printdiv).print-preview();
	})
}
function printelem(divId) {
    var content = document.getElementById(divId).innerHTML;
    var mywindow = window.open('', 'Print', 'height=500,width=700');

    mywindow.document.write('<html><head><title>');
    mywindow.document.write('<link rel="stylesheet"  href="css/printform.css" type="text/css" media="screen">');
	mywindow.document.write('<link rel="stylesheet" href="css/bootstrap.min.css">');
	mywindow.document.write('<link rel="stylesheet" href="css/print.css">');
    mywindow.document.write('</title>');	
    mywindow.document.write('</head><body >');
	mywindow.document.write('<div class="container-fluid">');
    mywindow.document.write(content);
	mywindow.document.write('<button onclick="window.print()" class="btn btn-info">print receipt</button>');	
	mywindow.document.write('</div>');
    mywindow.document.write('</body></html>');

    mywindow.document.close();
    mywindow.focus()
   // mywindow.print();
   // mywindow.close();
    return true;
}
