<?php echo meta('Content-type', 'text/html; charset=UTF-8', 'equiv'); ?> 
<link type="text/css" href="<?php echo base_url() ?>css/style.css" rel="stylesheet" />

<script language="javascript" src="<?php echo base_url() ?>js/jquery-1.6.2.min.js"  ></script>

<script language="javascript" >
	
$(document).ready(function(){
	value = 'fernando';
	var valid = $.ajax({
				  url: "<?php echo base_url() ?>users/nick_exist",
				  data: "nick="+value,
				  async: false
				 }).responseText;
	if (valid == "1"){
		alert("false "+valid);
		
	}					
	else{
		alert("true "+valid);	
	}	
})

</script>

<div>

</div>

<?php 

echo get_flash_message();
?>