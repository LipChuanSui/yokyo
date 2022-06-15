<h1><?= $title ?></h1>
<?php foreach($events as $event) : ?>
	<div class="my-4">
		<h3><?php echo $event['title']; ?></h3>
	  	<h6>Date and time : <?php $time_start = date("d/m/Y g:i a", strtotime($event['time_started']));
			$time_end = date(" g:i a", strtotime($event['time_started']) +60*60 );

	    echo $time_start." - ". $time_end; ?> </h6>
	    <h6>Venue : <?php echo $event['venue_name']; ?> </h6>
	    <h6>Available places : <?php echo $event['number']; ?> </h6>

			<a class="btn btn-read" href="<?php echo site_url('/timetable/book/'.$event['slug']); ?>">Read More</a>
	</div>

<?php endforeach; ?>
