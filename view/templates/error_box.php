<?php
	if(isset($_SESSION['errors'])){
?>
	<div id="errorBox" class="display display--error-box">
		<a  onclick="hideErrorBox()"style="color: white; float: right; cursor: pointer;">x</a>
		<?php 
		foreach ($_SESSION['errors'] as $key => $value) {
		?>
			<?php echo $value ?><br>
		<?php };?>

	</div>
<?php $_SESSION['errors'] = null ; }?>
<script >
	function hideErrorBox(){
		document.getElementById('errorBox').style.display = 'none';
	}
</script>