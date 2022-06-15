<h2><?= $title; ?></h2>

<?php echo form_open_multipart('posts/create'); ?>
	<div class="form-group">
		<label>Title</label>
		<input type="text" class="form-control" name="title" placeholder="Add Title">
		<p><?php echo form_error('title'); ?></p>
	</div>
	<div class="form-group">
		<label>Body</label>
		<textarea id="editor1" class="form-control" name="body" placeholder="Add Body"></textarea>
		<p><?php echo form_error('body'); ?></p>
	</div>
	<script>CKEDITOR.replace( 'editor1' ); </script>
	<div class="form-group">
		<label>Category</label>
		<select name="category_id" class="category_class form-control">
			<?php foreach($categories as $category): ?>
				<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group">
		<label>Sports</label>
		<select name="sport_id" class="form-control">
			<?php foreach($sports as $sport): ?>
				<option value="<?php echo $sport['id']; ?>"><?php echo $sport['sport_name']; ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-group">
		<label>Upload image</label>
		<input id= "uploadBtn" class="d-block" type="file"  name="userfile[]" size="20"></input>
	</div>
	<script>



	</script>
	<button type="submit" class="btn btn-success">Submit</button>
<?php echo form_close(); ?>
