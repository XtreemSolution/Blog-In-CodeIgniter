<div class="container">
  <h2>Blogs List</h2>
  <a href="<?php echo base_url('blogs/add'); ?>" class="btn btn-success pull-right">Add Blogs</a>
  <br>
                                                                                        
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
       
        <th>Title</th>
        <th>Content</th>
        <th>Image</th>
        <th>Options</th>
        
      </tr>
    </thead>
    <tbody>
 <?php if($blogsRecords) { ?>
    <?php foreach($blogsRecords as $record){  ?>

      <tr>
        <td><?php echo $record->title ?></td>
        <td><?php echo $record->content ?></td>
        <td><img src="<?php echo  base_url('assets/uploads/blogs/') ?><?php echo $record->image_name ?>" widht="80" height="80"></td>
        <td><a href="" class="btn btn-danger">Delete</a></td>

      </tr>
   <?php } ?>   
  <?php }  ?>    
    </tbody>
  </table>
  </div>
</div>