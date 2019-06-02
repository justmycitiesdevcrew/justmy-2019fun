<!-- Main content -->
<style>
	.form-group label {
	    display: block;
	    font-size: 14px;
	    font-weight: 500;
	}
	box-header.a {
	    color: #525456;
	    font-size: 15px;
	}
	.status{
		text-align: right;
	}
	span#res{
		color: #5c5e61;
	    font-size: 15px;
	}
</style>
<style>
	.urlpost{
		display: inline-block;
    	width: 70%;
	}
	.urlfont{
		font-weight: 100;
		display: inline-block !important;
	}
	.urlfont-size{
		font-size: 14px;
	}
	.box-title-html-part{
		text-align: center!important;
		font-size: 18px;
		margin-top: 0px!important;
		margin-bottom:0px!important;
	}
	.container {
	    width: 100%!important;
        margin-top: 20px;
	}
	.nav-pills>li.active>a, .nav-pills>li.active>a:hover, .nav-pills>li.active>a:focus {
	   text-align: center;
	}
	.nav-pills>li>a {
	    text-align: center;
	}
	.tabshtml {
	    border: solid 1px #c1c1c1;
	    border-radius: 3px;
	}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/build.min.css">
<script src="<?php echo base_url(); ?>assets/dist/js/build.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/fastselect.min.css">
<script src="<?php echo base_url(); ?>assets/dist/js/fastselect.standalone.js"></script>
<section class="content">
	<div class="row">
            <!-- left column -->
		<div class="col-md-12">
              <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header" style="background-color: rgba(19, 17, 17, 0.21);">
					<div class="col-md-6"><h3 class="box-title">Edit Post</h3></div>
					<div class="col-md-6 status"><a href="<?php echo base_url(); ?>post/postStatus?id=<?php echo $this->input->get('id') ?>"><span class="fa fa-pencil-square-o" id="res">Add Status</span></a></div>
                </div><!-- /.box-header -->
					
                <!-- form start -->
                <div class="box-body">				  
				    
					<?php if ($posts) { ?>
					<?php $i=1; foreach($posts as $posts): ?>
					<form id="" role="form" action="<?php echo base_url(); ?>post/updatePost?Id=<?php echo $posts['post_id'];?>" enctype="multipart/form-data" method="post"  class="attireCodeToggleBlock"/>
                    <input type="hidden" name="post_id" value="<?php echo $posts['post_id']; ?>" >
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-xs-6">
							<div class="form-group">
								  <label for="InputMarket">Market</label>
								  <select class="form-control multipleSelect" name="markets[]" multiple>
									 <option value="">---Select Market---</option>
							  
										<?php if($marketLists){
											//echo "<pre>"; print_r($categoryLists);die;
											foreach($marketLists as $keys=>$marketList):
											$isSelected = '';
													foreach($marketAddedLists as $marketAddedList){
														if($marketAddedList['market_id'] == $marketList['market_id']){
															$isSelected = 'selected';
														}
													}
										?>	
								  <option value="<?php echo $marketList['market_id'] ?>" <?php echo $isSelected; ?>><?php echo ucfirst($marketList['market_name']); ?></option>
									<?php 
									endforeach; } ?>
								  </select>
							</div>
						</div>
						<div class="col-lg-6 col-sm-6 col-xs-6">
							<div class="form-group">
								  <label for="InputProfile">Channel</label>
								  <select class="form-control multipleSelect" name="channel[]"  multiple>
									 <option value="">---Select Channels---</option>
							  
								<?php if($channelLists){
									//echo "<pre>"; print_r($categoryLists);die;
									foreach($channelLists as $keys=>$channelList):
									$isSelected = '';
											foreach($channelAddedLists as $channelAddedList){
												if($channelAddedList['channel_id'] == $channelList['channel_id']){
													$isSelected = 'selected';
												}
											}
								?>	
								  <option value="<?php echo $channelList['channel_id'] ?>" <?php echo $isSelected; ?>><?php echo ucfirst($channelList['channel_name']); ?></option>
									<?php 
									endforeach; } ?>
		
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-xs-6">
							<div class="form-group">
								  <label for="InputProfile">Profile</label>
								  <select class="form-control multipleSelect" name="profile[]" multiple>
									 <option value="">---Select Profile Type---</option>
							  
										<?php if($profileLists){
											//echo "<pre>"; print_r($categoryLists);die;
											foreach($profileLists as $keys=>$profileList):
											$isSelected = '';
													foreach($profileAddedLists as $profileAddedList){
														if($profileAddedList['profile_id'] == $profileList['profile_id']){
															$isSelected = "selected";
														}
													}
										?>	
								  <option value="<?php echo $profileList['profile_id'] ?>" <?php echo $isSelected; ?>><?php echo ucfirst($profileList['profile_name']); ?></option>
									<?php 
									endforeach; } ?>
								  </select>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
							<div class="form-group">					
							  <label for="PostTitle">Title</label>
							  <input type="text" name="post_title" class="form-control" id="PostTitle" placeholder="Enter Post Title" value="<?php echo $posts['cp_title']; ?>" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-xs-12">
							<div class="form-group">					
							  <label for="PostUrl">Url</label>
							  <label class="urlfont">http://2019fun.justmy.com/&nbsp</label><input type="text" name="post_url" class="form-control urlpost" id="PostUrl" placeholder="Enter Post Url" value="<?php echo substr($posts['cp_url'],26); ?>" required>
							</div>
						</div>
						<div class="col-lg-6 col-sm-6 col-xs-12">
							<div class="form-group">
							  <label for="PostType">Type</label>
								<select class="form-control" name="post_type">
									<option value="">---Type---</option>
									<option value="1" <?php if($posts['cp_type'] == "article") {?> <?php echo "selected"?> <?php } ?>>Article</option>
									<option value="2" <?php if($posts['cp_type'] == "event") {?> <?php echo "selected"?> <?php } ?>>Event</option>
									<option value="3" <?php if($posts['cp_type'] == "guest photographer") {?> <?php echo "selected"?> <?php } ?>>Guest Photographer</option>
									<option value="4" <?php if($posts['cp_type'] == "guest videographer") {?> <?php echo "selected"?> <?php } ?>>Guest Videographer</option>
									<option value="5" <?php if($posts['cp_type'] == "guest blogger") {?> <?php echo "selected"?> <?php } ?>>Guest Blogger</option>
									<option value="6" <?php if($posts['cp_type'] == "gallery") {?> <?php echo "selected"?> <?php } ?>>Gallery</option>
									<option value="7" <?php if($posts['cp_type'] == "video") {?> <?php echo "selected"?> <?php } ?>>Video</option>
									<option value="8" <?php if($posts['cp_type'] == "site page") {?> <?php echo "selected"?> <?php } ?>>Site Page</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-xs-6">
							<div class="form-group">					
							  <label for="PostAuthor">Author</label>
							  <input type="text" id="PostAuthor" name="post_author" class="form-control" value="<?php echo $posts['cp_author_name'];; ?>">
							</div>
						</div>
						<div class="col-lg-6 col-sm-6 col-xs-6">
							<div class="form-group">					
							  <label for="PostUser">User</label>
							  <select class="form-control" name="post_user">
									 <option value="">---Select User---</option>
								  
									<?php if($UserLists){
										foreach($UserLists as $keys=>$UserList):
									?>	
									  <option value="<?php echo $UserList->user_id; ?>" <?php if($UserList->user_id == $posts['c_user_id']){ echo "selected";}?>><?php echo ucfirst($UserList->first_name); ?></option>
										<?php 
										endforeach; } ?>
		
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-xs-12">
							<div class="form-group">
								  <label for="inputProductPhoto">Image</label>
								 
								 <?php if($posts['cp_image']) { ?>
								  <a href="<?php echo base_url().'upload/images/'.$posts['cp_image']; ?>" id="link" target="_blank">
										<span class="label label-success" style="font-size:11px;">View</span>
								  </a>
								  <?php } else { echo '<input type="file" name="post_image" id="inputProductPhoto">'; } ?>
								  <?php if($posts['cp_image']) { ?>
								  <a href="#" id="productLinklogo" style="visibility:visible;" onclick="deletelogoimage()">
										<span class="label label-danger" style="font-size:11px;">Update</span>
								  </a>
								  <input type="file" name="post_image" id="inputProductPhoto" style="display:none" accept="image/x-png,image/gif,image/jpeg,image/jpg"> 
									<?php } ?>
							</div>
						</div>
						<div class="col-lg-6 col-sm-6 col-xs-12">
							<div class="form-group">
								  <label for="html">HTML</label>
								 
								 <?php if($posts['cp_html']) { ?>
								  <a href="<?php echo base_url().'upload/images/'.$posts['cp_html']; ?>" id="link" target="_blank">
										<span class="label label-success" style="font-size:11px;">View</span>
								  </a>
								  <?php } else { echo '<input type="file" name="post_html" id="inputProductPhoto">'; } ?>
								  <?php if($posts['cp_html']) { ?>
								  <a href="#" id="productLinkHtml" style="visibility:visible;" onclick="deleteHTML()">
										<span class="label label-danger" style="font-size:11px;">Update</span>
								  </a>
								  <input type="file" name="post_html" id="html" style="display:none"> 
									<?php } ?>
							</div>
						</div>
					</div>
								
							<center><button class="btn btn-info" style="margin:10px;">Update</button></center>
						
					</form>
					<?php $i++; endforeach; } else { ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>	
</section>
<script>

		$('.multipleSelect').fastselect();

	</script>
<script>
 function deletelogoimage() {
		document.getElementById('inputProductPhoto').style.display='block';
		document.getElementById('productLinklogo').style.display='none';
		
		}
</script>
<script>
 function deleteHTML() {
		document.getElementById('html').style.display='block';
		document.getElementById('productLinkHtml').style.display='none';
		
		}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="box-header" style="background-color: rgba(19, 17, 17, 0.21);">
			<h3 class="box-title-html-part">Add HTML</h3>
		</div>
	</div>
</div>
	
<script src="//code.jquery.com/jquery-1.10.2.js"></script>  
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<div class="row">
	<div class="container">
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
			<ul class="nav nav-pills nav-stacked">
			  <li class="active tabshtml"><a href="#tab_a" data-toggle="pill">Content</a></li>
			  <li class="tabshtml"><a href="#tab_b" data-toggle="pill">Content with Skyscraper</a></li>
			  <li class="tabshtml"><a href="#tab_c" data-toggle="pill">Video</a></li>
			  <li class="tabshtml"><a href="#tab_d" data-toggle="pill">Image</a></li>
			  <li class="tabshtml"><a href="#tab_e" data-toggle="pill">Spotlight Text</a></li>
			</ul>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
			<div class="tab-content">
			        <div class="tab-pane active" id="tab_a">
			        	<h4>Content</h4>
						<div class="row">
							<div class="col-lg-10 col-sm-10 col-xs-10">
								<div class="form-group">					
								  <label for="ContentTitle">Content Title</label>
								  <input type="text" name="title" class="form-control" id="ContentTitle" placeholder="Enter Title" value="" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-10 col-sm-10 col-xs-10">
								<div class="form-group">					
								  <label for="ContentText">Content</label>
								   <textarea name="ContentText" id="editor1" rows="10" cols="80"></textarea>
								</div>
							</div>
						</div>
					</div>
			        <div class="tab-pane" id="tab_b">
			             <h4>Skyscraper Text</h4>
			           <div class="row">
							<div class="col-lg-10 col-sm-10 col-xs-10">
								<div class="form-group">					
								  <label for="SkyscraperContentTitle">Skyscraper Content Title</label>
								  <input type="text" name="title" class="form-control" id="SkyscraperContentTitle" placeholder="Enter Title" value="" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-10 col-sm-10 col-xs-10">
								<div class="form-group">					
								  <label for="SkyscraperContentText">Skyscraper Content</label>
								    <textarea name="SkyscraperContentText" id="editor2" rows="10" cols="80"></textarea>
								</div>
							</div>
						</div>
			        </div>
			        <div class="tab-pane" id="tab_c">
			             <h4>Video</h4>
			            <div class="row">
							<div class="col-lg-10 col-sm-10 col-xs-10">
								<div class="form-group">					
								  <label for="ContentText">Video Name</label>
								  <input type="text" name="city" value="" class="form-control" id="City" placeholder="Enter City" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-5 col-sm-5 col-xs-5">
								<div class="form-group">					
								  <label for="ContentText">Video Url</label>
								  <input type="text" name="title" class="form-control" id="SkyscraperContentTitle" placeholder="Enter Title" value="" required>
								</div>
							</div>
							<div class="col-lg-5 col-sm-5 col-xs-5">
								<div class="form-group">					
								 <label for="ContentText">Upload Video</label>
								  <input type="file" name="title" id="SkyscraperContentTitle" value="" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-10 col-sm-10 col-xs-10">
								<div class="form-group">					
								  <label for="SkyscraperContentTitle">Video Details</label>
								  <textarea name="SkyscraperContentText" id="editor3" rows="10" cols="80"></textarea>
								</div>
							</div>
						</div>
			        </div>
			        <div class="tab-pane" id="tab_d">
			             <h4>Image</h4>
			            <div class="row">
							<div class="col-lg-10 col-sm-10 col-xs-10">
								<div class="form-group">					
								  <label for="ContentText">Image Name</label>
								  <input type="text" name="city" value="" class="form-control" id="City" placeholder="Enter City" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-5 col-sm-5 col-xs-5">
								<div class="form-group">					
								  <label for="ContentText">Image Url</label>
								  <input type="text" name="title" class="form-control" id="SkyscraperContentTitle" placeholder="Enter Title" value="" required>
								</div>
							</div>
							<div class="col-lg-5 col-sm-5 col-xs-5">
								<div class="form-group">					
								 <label for="ContentText">Upload Image</label>
								  <input type="file" name="title" id="SkyscraperContentTitle" value="" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-10 col-sm-10 col-xs-10">
								<div class="form-group">					
								  <label for="SkyscraperContentTitle">Image Details</label>
								  <textarea name="SkyscraperContentText" id="editor4" rows="10" cols="80"></textarea>
								</div>
							</div>
						</div>
			        </div>
			         <div class="tab-pane" id="tab_e">
			             <h4>Spotlight</h4>
			             <div class="row">
							<div class="col-lg-10 col-sm-10 col-xs-10">
								<div class="form-group">					
								  <label for="SkyscraperContentTitle">Spotlight Text</label>
								  <textarea name="SkyscraperContentText" id="editor5" rows="10" cols="80"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-10 col-sm-10 col-xs-10">
								<div class="form-group">					
								  <label for="SkyscraperContentTitle">Credit</label>
								 <input type="text" name="title" class="form-control" id="SkyscraperContentTitle" placeholder="Enter Title" value="" required>
								</div>
							</div>
						</div>
			        </div>
			</div><!--tab content-->
		</div>
	</div><!--end of container-->
</div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <script src="https://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script>
   CKEDITOR.replace( 'editor1' );
   CKEDITOR.replace( 'editor2' );
   CKEDITOR.replace( 'editor3' );
   CKEDITOR.replace( 'editor4' );
   CKEDITOR.replace( 'editor5' );
</script>