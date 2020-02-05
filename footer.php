	
</div><!-- wrapper -->
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
<script>
function check_user(){
	var user_name=document.getElementById("user_nam").value;
	$.post("check_user.php",
	{
		user:user_name
	},
	function(data,status){
		//alert(data);
		//document.getElementById('avuser').innerHTML=data; 
		if(data=='<option value="no value">')
		{document.getElementById('send').disabled=true;}
		else
		{document.getElementById('send').disabled=false;}
	}
	);
}
</script>
<div id="footer">Created by Nayan</div>
</body>
</html> 