<?php $time_start = date("Y/m/d g:i a", strtotime($event['time_started']));
$time_end = date(" g:i a", strtotime($event['time_started']) +60*60 );
?>
<h2>Booking for <?= $title ?></h2>
<div class="my-4">
    <h6>Date and time : <p class="d-inline" id="time_start"><?php echo $time_start; ?> </p><p class="d-inline">-<?php echo $time_end; ?> </p>
    <h6>Venue : <?php echo $event['venue_name']; ?> </h6>
    <h6>Availabe seats: <p class="d-inline" id="availableNumber"><?php echo $event['number']; ?> </p> </h6>

    <?php if($event['result']): ?>
    <h6>Winner: <p class="d-inline" id="resultText"><?php echo $event['result']; ?></p></h6>
    <?php endif; ?>

    <!--only user can edit-->
    <?php if($this->session->userdata('logged_in')): ?>
    <a class="btn btn-success pull-left mr-2 px-4" href="<?php echo base_url(); ?>timetable/edit/<?php echo $event['slug']; ?>">Edit</a>
    <?php echo form_open('timetable/delete/'.$event['id']); ?>
    <input type="submit" value="Delete" class="btn btn-danger">
    </form>
    <?php endif; ?>
</div>

<?php //echo validation_errors(); ?>

<?php echo form_open('timetable/booking'); ?>
	<div class="">
		<div class="">
			<div class="form-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name" placeholder="Name" required>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" name="email" placeholder="Email" required>
			</div>
      <div class="form-group">
        <label for="quantity">Quantity (maximum 10):</label>
        <input type="number" id="seatNumber" name="number" min="1" max="10" value=1 required>
			</div>
      <input class="d-none" type="text" name="event_id" value= <?php echo $event['id']; ?> >
			<button id="bookBtn"
      <?php if($event['type_id'] == 1): ?>
      class="btn btn-success btn-block"
      <?php elseif($event['type_id'] == 2): ?>
      class="check_loc btn btn-success btn-block"
      <?php endif; ?>
      type="submit" >Submit</button>
		</div>
	</div>
<?php echo form_close(); ?>
