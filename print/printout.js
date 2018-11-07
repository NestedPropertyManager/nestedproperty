<script>
function printout(print,printdiv){
       $function(){
	   $(print).on('click', function(){
	   $.print(printdiv)
	   });
	   };

}
function print(){
	// here we will write our custom code for printing our div
		$(function(){
			$('#print').on('click', function() {
                //Print ele2 with default options
                $.print(".print_div");
            });
		});
	
}
</script>