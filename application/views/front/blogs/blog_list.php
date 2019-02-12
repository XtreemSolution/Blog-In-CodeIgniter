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
        <td>
            <a data-toggle="modal" data-id="<?php echo $record->id; ?>" data-url="<?php echo base_url('blogs/delete'); ?>" class="btn btn-danger tooltips" onClick="deleteRecord(this);" data-original-title="Delete this record" data-placement="top" data-container="body">Delete</a>
           <!--  <a href="<?php echo base_url('blogs/update/'.$record->id) ?>" class="btn btn-info  tooltips" data-original-title="Update this record" data-placement="top" data-container="body">Edit</a>
             <a href="<?php echo base_url('blogs/view/'.$record->id) ?>" class="btn btn-success  tooltips" data-original-title="Update this record" data-placement="top" data-container="body">View</a> -->

        </td>

      </tr>
   <?php } ?>   
  <?php } else{ ?>

    <tr><td align="center" colspan="4">No Records Found !!</td></tr>
  <?php } ?>    
    </tbody>
  </table>
  </div>
</div>