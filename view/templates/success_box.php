<?php
	if(isset($_SESSION['success'])){
?>
	<div id="SuccessBox" class="display display--Success-box">
		<a  onclick="hideSuccessBox()"style="color: white; float: right; cursor: pointer;">x</a>
		<?php 
		foreach ($_SESSION['success'] as $key => $value) {
		?>
			<?php echo $value ?><br>
		<?php };?>

	</div>
<?php $_SESSION['success'] = null ; }?>
<script >
	function hideSuccessBox(){
		document.getElementById('SuccessBox').style.display = 'none';
	}
</script>