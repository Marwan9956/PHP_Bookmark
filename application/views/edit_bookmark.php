<?php 
if(!empty($this->input->post("title"))){
	$title = $this->input->post("title");
	$url   = $this->input->post("bookmark_url");
	$cat_id  = $this->input->post("category_id");
}else{
	$title = $bookmark->title ;
	$url   = $bookmark->url;
	$cat_id = $bookmark->category_id;
}
?>
<h2>Edit</h2>
<hr>
<!--------Error Message----------->
<?php $this->load->view('inc/layout/message'); ?>
	

<form method="post" action="<?php base_url("table/add");?>">
	
	<label for="title">Title</label>
	<input id="title" type="text" name="title" class="inpTxt" placeholder="Bookmark title"
		 value="<?php echo $title;?>" />
	
	
	
	<label for="url">Url</label>
	<input id="url" type="text" name="bookmark_url" class="inpTxt"  placeholder="Bookmark url"
		 value="<?php echo $url;?>">
	
	
	<br>
	<select name="category_id" required class="inpTxt">
		<option value=""  disabled>Select Category</option>
		<?php foreach(categories() as $category):?>
			<option value="<?php echo $category->id; ?>" 
			<?php if($category->id == $cat_id ){ echo "selected";} ?> > <?php echo $category->name; ?></option>
		<?php endforeach;?>
	</select>
	
	<button name="submit" type="submit" class="btn-submit">Edit</button>
</form>