<h1 class="text-center pt-4" >2 August -  8 August 2020 FunOlympic Games</h1>
<h1 class="text-center" id="timer"></h1>

<div id="carousel_home" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#carousel_home" data-slide-to="0" class="active"></li>
    <li data-target="#carousel_home" data-slide-to="1"></li>
    <li data-target="#carousel_home" data-slide-to="2"></li>
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="" src="<?php echo site_url(); ?>assets/images/homepage/1.jpg"
				onerror="this.onerror=null;this.src='<?php echo site_url(); ?>assets/images/noimage.jpg';">
      </div>
      <div class="carousel-item">
        <img class="" src="<?php echo site_url(); ?>assets/images/homepage/2.jpg"
				onerror="this.onerror=null;this.src='<?php echo site_url(); ?>assets/images/noimage.jpg';">
      </div>
      <div class="carousel-item">
        <img class="" src="<?php echo site_url(); ?>assets/images/homepage/3.jpg"
				onerror="this.onerror=null;this.src='<?php echo site_url(); ?>assets/images/noimage.jpg';">
      </div>
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev filter-red" href="#carousel_home" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next filter-red" href="#carousel_home" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>

<div class="row mt-4">
  <div class="col-md-5">
    <h1 class=""><a href="<?php echo site_url('posts/category/1'); ?>">Articles</a></h1>
    <?php $i = 0;
    foreach($articles as $article) : ?>
    <div class="my-4">
    	<h3><?php echo $article['title']; ?></h3>
    		<small class="post-date">Posted on: <?php echo $article['created']; ?> by <?php echo $article['username']; ?>
          <?php echo $article['sport_name']; ?></small>
    			<?php echo word_limiter($article['body'], 30); ?>
    			<br>
    		<a class="btn btn-read" href="<?php echo site_url('posts/'.$article['slug']); ?>">Read More</a>
    </div>
    <?php if(++$i > 1) break;endforeach; ?>
  </div>
  <div class="col-md-7">
    <img style="width:100%;height:auto;" src="<?php echo site_url(); ?>assets/images/homepage/4.jpg"
    onerror="this.onerror=null;this.src='<?php echo site_url(); ?>assets/images/noimage.jpg';">
  </div>
</div>

<div class="row mt-4">
  <div class="col-md-7">
    <img style="width:100%;height:auto;" src="<?php echo site_url(); ?>assets/images/homepage/5.jpg"
    onerror="this.onerror=null;this.src='<?php echo site_url(); ?>assets/images/noimage.jpg';">
  </div>
  <div class="col-md-5">
    <h1 class=""><a href="<?php echo site_url('posts/category/2'); ?>">News</a></h1>
    <?php $i = 0;
    foreach($news as $new) : ?>
    <div class="my-4">
    	<h3><?php echo $new['title']; ?></h3>
      <small class="post-date">Posted on: <?php echo $article['created']; ?> by <?php echo $article['username']; ?>
        <?php echo $article['sport_name']; ?></small>
    			<?php echo word_limiter($new['body'], 30); ?>
    			<br>
    		<a class="btn btn-read" href="<?php echo site_url('posts/'.$new['slug']); ?>">Read More</a>
    </div>
    <?php if(++$i > 1) break;endforeach; ?>
  </div>
</div>


<div class="row mt-4">
  <div class="col-md-5">
    <h1 class=""><a href="<?php echo site_url('posts/category/3'); ?>">Galleries</a></h1>
    <?php $i = 0;
    foreach($galleries as $gallery) : ?>
    <div class="my-4">
    	<h3><?php echo $gallery['title']; ?></h3>
        <small class="post-date">Posted on: <?php echo $article['created']; ?> by <?php echo $article['username']; ?>
        <?php echo $article['sport_name']; ?></small>
    			<?php echo word_limiter($gallery['body'], 30); ?>
    			<br>
    		<a class="btn btn-read" href="<?php echo site_url('posts/'.$gallery['slug']); ?>">Read More</a>
    </div>

    <?php if(++$i > 1) break;endforeach; ?>
  </div>
  <div class="col-md-7">
    <img class="page_img" src="<?php echo site_url(); ?>assets/images/homepage/6.jpg"
    onerror="this.onerror=null;this.src='<?php echo site_url(); ?>assets/images/noimage.jpg';">
  </div>
</div>

<h1>Follow the FunOlympic Games</h1>
<div class="mt-4 row">
  <div class="col-md-3 col-6 text-center">
    <a href="#" class="fa fa-facebook"></a>
  </div>
  <div class="col-md-3 col-6 text-center">
    <a href="#" class="fa fa-twitter"></a>
  </div>
  <div class="col-md-3 col-6 text-center">
    <a href="#" class="fa fa-youtube"></a>
  </div>
  <div class="col-md-3 col-6 text-center">
    <a href="#" class="fa fa-instagram"></a>
  </div>
</div>

<script>
// Set the date we're counting down to
var countDownDate = new Date("August 2, 2020 10:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Output the result in an element with id="timer"
  document.getElementById("timer").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is over, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("timer").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
