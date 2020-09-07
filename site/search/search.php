<script>
	function searchFocus(){
		if(document.sForm.sText.value=='Nhập từ khóa ...') {
			document.sForm.sText.value='';
		}
	}
	function searchBlur(){
		if(document.sForm.sText.value=='') {
			document.sForm.sText.value='Nhập từ khóa ...';
		}
	}
</script>
<div id="search" class="col-md-7 col-sm-12 col-xs-12">
	<form action="index.php?page_layout=search" method="POST" name="sForm">
		<input onfocus="searchFocus();" onblur="searchBlur();" type="text" name="sText" value="Nhập từ khóa ...">
		<input type="submit" name="search" value="Tìm Kiếm">
	</form>
</div>