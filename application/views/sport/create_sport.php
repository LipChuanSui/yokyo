<h1><?= $title; ?></h1>

<?php echo form_open_multipart('sports/create_sport'); ?>
<div class="form-group">
	<label>Sports Name</label>
	<input type="text" class="form-control" name="sport_name" placeholder="Add Sport">
	<p><?php echo form_error('sport_name'); ?></p>
</div>
<div class="form-group">
	<label>Upload image</label>
	<input class="d-block" type="file"  name="userfile" size="20" ></input>
</div>
<button type="submit" class="btn btn-success">Submit</button>
<?php echo form_close(); ?>
