<!-- Main content -->
<style>
	.urlpost{
		display: inline-block;
    	width: 70%;
	}
	.urlfont{
		font-weight: 100;
	}
</style>
<section class="content">
    <div class="row">
            <!-- left column -->
		<div class="col-md-12">
              <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header" style="background-color: rgba(19, 17, 17, 0.21);">
                  <h3 class="box-title">Add Post </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
				
				
				
			    <div class="box-body">
					<form  action="<?php echo base_url();?>post/insertPost" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">					
								  <label for="PostTitle">Title</label>
								  <input type="text" name="post_title" class="form-control" id="PostTitle" placeholder="Enter Post Title" value="" required>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">					
								  <label for="PostUrl">Url</label><br>
									<label class="urlfont">http://2019fun.justmy.com/&nbsp</label><input type="text" name="post_url" class="form-control urlpost" id="PostUrl" placeholder="Enter Post Url" value="" required><span> /</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-xs-12">
								<div class="form-group">					
								  <label for="PostAuthor">Author</label>
								  <input type="text" id="PostAuthor" name="post_author" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">					
								  <label for="PostUser">User</label>
									<select class="form-control" name="post_user">
										 <option value="">---Select Admin---</option>
									  
										<?php if($UserLists){
											//echo "<pre>"; print_r($categoryLists);die;
											foreach($UserLists as $keys=>$UserList):
										?>	
										  <option value="<?php echo $UserList->user_id; ?>"><?php echo ucfirst($UserList->first_name); ?></option>
											<?php 
											endforeach; } ?>
			
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <label for="PostType">Type</label>
									<select class="form-control" name="post_type">
										<option value="">---Type---</option>
										<option value="1">Article</option>
										<option value="2">Event</option>
										<option value="3">Guest Photographer</option>
										<option value="4">Guest Videographer</option>
										<option value="5">Guest Blogger</option>
										<option value="6">Gallery</option>
										<option value="7">Video</option>
										<option value="8">Site Page</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <label for="inputProductPhoto">Image</label>
								  <input type="file" name="post_image" id="inputProductPhoto" accept="image/x-png,image/gif,image/jpeg,image/jpg">
								</div>
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <label for="html">HTML</label>
								  <input type="file" name="post_html" id="html">
								</div>
							</div>
						</div>
						<center><input class="btn btn-info" type="submit" value="Submit" ></center>	
					</form>
				</div><!-- /.box -->
			</div>
		</div>
	</div>
</section>
					
<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>					
<style> 
#menu ul,
#menu li {
  list-style: none
}
#menu ul {
  height: auto;
}

#menu li {
  float: left;
  display: inline;
  position: relative;
}
#menu a {
  display: block;
  
  color: #333;
}
#menu ul.menus {
    width: 213px;
    position: absolute;
    z-index: 99;
    display: none;
    border: 1px solid #d7d7d7;
	    background: white;
}
#ul.submenu{
    width: 213px;
    position: absolute;
    z-index: 99;
    display: none;
    border: 1px solid #d7d7d7;
	background: white;
}


#menu ul.menus li {
  display: block;
  width: 100%;
  
 
}

#menu li:hover ul.menus {
  display: block
}
.rr{
	margin:0;
}
.prett {
    padding: 16px 0px 16px 0px;
    font-size: 15px;
    box-shadow: 1px 3px 10px #8080804d;
}


#menu a.prett::after {
  content: "";
 
  position: absolute;
  top: 15px;
  right: 9px
}

#menu ul.menus a:hover {
  background: #00adff;
  color: white;
}

#menu ul.menus .submenu {
  display: none;
  left: 180px;
  top: 0;
  width: 213px;
    position: absolute;
    z-index: 99;
    display: none;
    border: 1px solid #d7d7d7;
    background: white;
}




#menu ul.menus .has-submenu:hover .submenu {
  display: block;
}

</style>
			 <script src="<?php echo base_url(); ?>assets/datepickar/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/datepickar/jquery.datetimepicker.full.js"></script>
