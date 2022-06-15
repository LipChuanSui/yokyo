<?php //echo validation_errors(); ?>

<?php echo form_open('users/register'); ?>
	<div class="row justify-content-center align-self-center">
		<div class="col-md-6">
			<h1 class="text-center"><?= $title; ?></h1>
			<div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" name="email" placeholder="Email">
				<p><?php echo form_error('email'); ?></p>
			</div>
			<div class="form-group">
				<label>Authority</label>
				<select name="authority_id" class="form-control">
					<?php foreach($authorities as $authority): ?>
						<option value="<?php echo $authority['id']; ?>"><?php echo $authority['name']; ?></option>
					<?php endforeach; ?>
				</select>
		</div>
			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="username" placeholder="Username">
				<p><?php echo form_error('username'); ?></p>
			</div>
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password" placeholder="Password">
						<p><?php echo form_error('password'); ?></p>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label>Confirm Password</label>
						<input type="password" class="form-control" name="password2" placeholder="Confirm Password">
						<p><?php echo form_error('password2'); ?></p>
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-success btn-block">Submit</button>
		</div>
	</div>
<?php echo form_close(); ?>
