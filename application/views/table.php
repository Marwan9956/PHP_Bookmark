<h2>Your Bookmark:</h2>
<hr>
<!--------Error Message----------->
<?php $this->load->view('inc/layout/message'); ?>
	
<?php if(!empty($bookmarks)):?>
<table class="table table-hover">
  <thead>
	<tr class="table-first-row">
	  <th></th>
	  <th>Bookmark Name</th>
	  <th>Bookmark url</th>
	  <th>Edit</th>
	  <th>Delete</th>
	</tr>
  </thead>
  <tbody>
	<?php foreach($bookmarks as $bookmark):?>
	<tr>
	  <th scope="row"><?php echo $bookmark->id ;?></th>
	  <td><?php echo $bookmark->title; ?></td>
	  <td><a href="http://<?php echo $bookmark->url; ?>/" target="_blank"><?php echo $bookmark->url; ?><a></td>
	  <td><a class="btn-edit" href="<?php echo base_url('table/edit/'.$bookmark->id); ?>">Edit</a></td>
	  <td><a class="btn-logout" href="<?php echo base_url('table/delete_bookmark/'.$bookmark->id); ?>">Delete</a></td>
	</tr>
	<?php endforeach;?>
  </tbody> 
</table>
<?php else:?>
	<p> there is no bookmarks To display</p>
<?php endif;?>