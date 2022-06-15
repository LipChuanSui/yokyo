<h2><?= $title; ?></h2>

<?php //echo validation_errors(); ?>

<?php echo form_open_multipart('timetable/create'); ?>
<div class="form-group">
	<label>Title</label>
	<input type="text" class="form-control" name="title" placeholder="Add Title">
	<p><?php echo form_error('title'); ?></p>
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
	<label>Time Start</label>
	<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
		<input name="time_start" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
		<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
			<div class="input-group-text"><i class="fa fa-calendar"></i></div>
		</div>
	</div>
</div>
<script>
$(function () {
    $('#datetimepicker1').datetimepicker({
			defaultDate: "8/2/2020",
			minDate: "8/2/2020",
			maxDate: "8/8/2020",
    });
});

</script>

<div class="form-group">
	<label>Venues</label>
	<select name="venue_id" class="form-control">
		<?php foreach($venues as $venue): ?>
		<option value="<?php echo $venue['id']; ?>"><?php echo $venue['venue_name']; ?></option>
		<?php endforeach; ?>
	</select>
</div>
<div class="form-group">
	<label>Types</label>
	<select name="type_id" class="form-control">
		<?php foreach($types as $type): ?>
		<option value="<?php echo $type['id']; ?>"><?php echo $type['type_name']; ?></option>
		<?php endforeach; ?>
	</select>
</div>
<button type="submit" class="btn btn-success">Submit</button>
</form>
