<h1><?php echo $post['title'] ?></h1>
<h2><?php echo $post['name']; ?></h2>
<small class="post-date">Posted on: <?php echo $post['created']; ?> by <?php echo $post['username']; ?>
<?php echo " ".$post['sport_name']; ?></small><br>

<div class="post-body">
	<?php echo $post['body']; ?>
</div>

<div id="carousel_ID" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ul class="carousel-indicators">
		<?php $i=0; ?>
		<?php foreach($images as $image) : ?>
			<li data-target="#carousel_ID" data-slide-to="<?php echo $i; $i++;?>"></li>
	  <?php endforeach; ?>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
		<?php foreach($images as $image) : ?>
			<div class="carousel-item">
				<img class="" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $image['post_image']; ?>"
				onerror="this.onerror=null;this.src='<?php echo site_url(); ?>assets/images/noimage.jpg';">
	    </div>
	  <?php endforeach; ?>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev filter-red" href="#carousel_ID" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next filter-red" href="#carousel_ID" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

<!--only user who create can edit-->
<?php if($this->session->userdata('user_id') == $post['user_id'] || $this->session->userdata('authority_id') == 2): ?>
<a class="btn btn-success pull-left mr-2 px-4" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['slug']; ?>">Edit</a>
<?php echo form_open('/posts/delete/'.$post['id']); ?>
<input type="submit" value="Delete" class="btn btn-danger">
</form>
<?php endif; ?>
<!--comment-->
<hr>
<h3>Comments</h3>
<?php if($comments) : ?>
	<?php foreach($comments as $comment) : ?>
		<div class="well">
			<small><?php echo $comment['created_time'] ?> by <?php echo $comment['name']; ?></small>
			<h5><?php echo $comment['body']; ?> </h5>
		</div>
	<?php endforeach; ?>
<?php else : ?>
	<p>No Comments To Display</p>
<?php endif; ?>
<hr>
<h3>Add Comment</h3>
<?php //echo validation_errors(); ?>
<?php echo form_open('comments/create/'.$post['id']); ?>
	<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="text" name="email" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Body</label>
		<textarea name="body" class="form-control" required></textarea >
	</div>
	<input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">
	<button class="btn btn-primary" type="submit">Submit</button>
</form>
