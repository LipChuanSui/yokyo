<h1><?= $title ?></h1>
<?php foreach($posts as $post) : ?>
<div class="my-4">
	<h3><?php echo $post['title']; ?></h3>
		<small class="post-date">Posted on: <?php echo $post['created']; ?> <?php echo $post['name'] ?> <?php echo $post['sport_name'] ?>
		</small>
			<?php echo word_limiter($post['body'], 50); ?>
			<br>
		<a class="btn btn-read" href="<?php echo site_url('posts/'.$post['slug']); ?>">Read More</a>
</div>
<?php endforeach; ?>
