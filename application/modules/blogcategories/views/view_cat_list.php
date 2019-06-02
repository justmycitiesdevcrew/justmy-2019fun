<style>
	.content{
		padding-top: 70px;
		background-color: #fafafa;
		width:100%;
		height:600px;
	}
	.text{
		color: #5a5757;
		font-size: 20px;
		font-weight: 600;
	}
	.page{
		padding-top: 5px;
	}
</style>
<div class="page">
	
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center content">
				<div class="text">Select the content above that you want to manage.</div>
			</div>
		</div>
	
</div>
<script>
	function activeEnactive(id, value) {
		if(value==1){
			value=0;
		}
		else{
			value=1;
		}
		var r = confirm("Do you want to change status ?");
		if (r == true) {
		   window.location.assign("<?php echo base_url(); ?>blogcategories/BlogCategoriesmanage/ActiveStatus?inactiveStatusId="+id+"&&statusValue="+value); 
		}

	}
</script>