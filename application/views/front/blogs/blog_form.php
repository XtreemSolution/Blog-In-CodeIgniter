<style type="text/css">
   .bootstrap-tagsinput{
   width: 100%;
   }
</style>
<?php
   if($success!="error"){
   
   
   if (isset($message) && $message) {
       $alert = ($success) ? 'alert-success' : 'alert-danger';
       echo '<div class="alert ' . $alert . '">' . $message . '</div>';
   }
   ?>
<div class="portlet light" style="height:45px">
   <div class="row">
      <ul class="page-breadcrumb breadcrumb">
         <li>
            <i class="icon-home"></i>
            <a href="<?php echo site_url() ?>" class="tooltips" data-original-title="Home" data-placement="top" data-container="body">Home</a>
            <i class="fa fa-arrow-right"></i>
         </li>
         <li>
            <a href="<?php echo site_url('') ?>" class="tooltips" data-original-title="List of Testimonial" data-placement="top" data-container="body">List of Blogs</a>
            <i class="fa fa-arrow-right"></i>
         </li>
         <li>
            <?php if ($id != '') {?>Update Blogs <?php } else {?>Add  Blogs <?php }
               ?>
         </li>
         <li style="float:right;">
            <a class="btn red tooltips" href="<?php echo base_url(''); ?>" style="float:right;margin-right:3px;margin-top: -7px;" data-original-title="Go Back" data-placement="top" data-container="body">Go Back<i class="m-icon-swapleft m-icon-white"></i>
            </a>
         </li>
      </ul>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="portlet light">
         <div class="portlet-title">
            <div class="row">
               <div class="col-md-6">
                  <div class="caption font-red-sunglo">
                     <i class="fa fa-file-image"></i>
                     <span class="caption-subject bold uppercase"><?php echo $page_title; ?></span>
                  </div>
               </div>
            </div>
         </div>
         <div class="portlet-body form">
            <?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal ajax_form')); ?>
            <div class="form-group form-md-line-input">
               <label for="form_control_title" class="control-label col-md-2">Title<span style="color:red">*</span></label>
               <div class="col-md-10">
                  <?php echo form_input(array('placeholder' => "Enter title", 'id' => "title", 'name' => "title", 'class' => "form-control", 'value' => "$title")); ?>
                  <div class="form-control-focus"> </div>
               </div>
            </div>
          
            
            <div class="form-group form-md-line-input">
               <label for="form_control_title" class="control-label col-md-2">Content<span style="color:red">*</span></label>
               <div class="col-md-10">
                  <?php echo form_textarea(array('placeholder' => "Content", 'id' => "aboutus", 'name' =>"content", 'class' => "form-control", 'value' => "$content", 'type' => 'text','rows'=>'4')); ?>
                  <div class="form-control-focus"> </div>
               </div>
            </div>
            <div class="form-group form-md-line-input" id="image_div">
               <label for="form_control_image" class="control-label col-md-2">Image<?php if(empty($image_name)){ ?><span style="color:red">*</span><?php } ?></label>
               <div class="col-md-6">
                  <input type="file" name="image_name" id="form_control_images" style="width: 250px;">  
                  </br>
               </div>
               <?php if(!empty($image_name)) { ?>
               <div class="col-md-2">
                  <?php
                     echo '<img src="' . base_url('assets/uploads/blogs/'. $image_name) .'" widht="80" height="80">';
                     ?>
               </div>
               <?php } ?>
            </div>


  
            <div class="form-actions noborder">
               <div class="row">
                  <div class="col-md-offset-2 col-md-10">
                     <button type="submit" class="btn btn-default">Submit</button>
                     <a href="<?php echo base_url(''); ?>" class=" btn btn-default pull-right">Cancel</a>
                  </div>
               </div>
            </div>
            </form>
         </div>
      </div>
   </div>
</div>
</div>
<?php } else{ ?>
<div class="alert alert-info">No record found</div>
<?php } ?>
<script type="text/javascript">
   var element = 'content';
   CKEDITOR.replace(element,
   {
   
   });
</script>
<script type="text/javascript">
   $('.ajax_form').submit(function(event){
     for (instance in CKEDITOR.instances)
       {
           CKEDITOR.instances[instance].updateElement();
       }
   });
</script>
