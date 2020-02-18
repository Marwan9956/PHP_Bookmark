<h2>Add New bookmark</h2>
<hr>

<!--------Error Message----------->
<?php $this->load->view('inc/layout/message'); ?>

<form method="post" action="<?php base_url("table/add");?>">
	
	<label for="title">Title</label>
	<input id="title" type="text" name="title" class="inpTxt" placeholder="Bookmark title"
		 value="<?php echo $this->input->post('title');?>" />
	
	
	
	<label for="url">Url</label>
	<input id="url" type="text" name="bookmark_url" class="inpTxt"  placeholder="Bookmark url"
		 value="<?php echo $this->input->post('url');?>">
	
	
	<br>
	<select name="category_id" required class="inpTxt">
		<option value="" selected disabled>Select Category</option>
		<?php foreach(categories() as $category):?>
			<option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
		<?php endforeach;?>
	</select>
	
	<button name="submit" type="submit" class="btn-submit">Add</button>
</form>