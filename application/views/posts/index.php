<h1><?= $title ?></h1>
<?php foreach($posts as $post) : ?>
<div class="my-4">
	<h3><?php echo $post['title']; ?></h3>
		<small class="post-date">Posted on: <?php echo $post['created']; ?> <?php echo $post['name'] ?>  by <?php echo $post['username']; ?>
		<?php echo $post['sport_name']; ?></small>
			<?php echo word_limiter($post['body'], 50); ?>
			<br>
		<a class="btn btn-read" href="<?php echo site_url('posts/'.$post['slug']); ?>">Read More</a>
</div>
<?php endforeach; ?>

<h1>List of Categories</h1>
<a class="btn btn-read" href="<?php echo site_url('posts/category/1'); ?>">Article</a><p></p>
<a class="btn btn-read" href="<?php echo site_url('posts/category/2'); ?>">News</a><p></p>
<a class="btn btn-read" href="<?php echo site_url('posts/category/3'); ?>">Gallery</a>


<h1><?= $title2 ?></h1>
<ul class="sports_row row">
<?php foreach($sports as $sport) : ?>
  <li class="sports_item col-4 col-md-2">
      <a class="sports_link" href="<?php echo site_url('posts/sports/'.$sport['sport_slug']); ?>">
        <div class="sports_pic">
						<img class="image_responsive d-block" src="<?php echo site_url(); ?>assets/images/sports/<?php echo $sport['sport_img']; ?>"
					onerror="this.onerror=null;this.src='<?php echo site_url(); ?>assets/images/noimage.jpg';">
				</div>
          <h2 class="sports_title">
              <?php echo $sport['sport_name']; ?>
          </h2>
      </a>
  </li>
<?php endforeach; ?>
</ul>
