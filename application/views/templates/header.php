<!DOCTYPE html>
<html>

<head>
	<title>Yokyo</title>
	<link rel="icon" href="<?php echo base_url('assets/images/bear-logo.png'); ?>" type="image/gif" sizes="16x16">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scsale=1">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!--Bootstrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="http://cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css"/>

</head>

<body>
	<!--navbar-->
	<nav class="navbar navbar-expand-lg navbar-light" id="fixheader">
		<div class="container">
			<!--Nav-->
			<div class="nav_bar collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>about">About Us</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>posts">Posts</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>timetable">Events</a></li>
					<?php if($this->session->userdata('logged_in')) : ?>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>statistic">Statistic</a></li>
					<?php endif; ?>
				</ul>
			</div>


			<!--Logo-->
			<div class="logo">
					<a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/images/bear-logo.png'); ?>" alt="otw_logo" class="img-fluid"></a>
			</div>


			<!--login-->
			<div class="nav_bar collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<!--if not login-->
					<?php if(!$this->session->userdata('logged_in')) : ?>
					<li id="google_translate_element" class="nav-item"></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/login">Login</a></li>
					<?php endif; ?>
					<!--if login as admin-->
					<?php if($this->session->userdata('logged_in') && $this->session->userdata('authority_id') == 2) : ?>
					<li class="nav-item">
						<p class="nav-link mb-0">Hello Admin</p>
					</li>
					<li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Create</a>
            <div class="dropdown-menu">
							<a class="nav-link" href="<?php echo base_url(); ?>posts/create">Create Post</a>
							<a class="nav-link" href="<?php echo base_url(); ?>timetable/create">Create Event</a>
							<a class="nav-link" href="<?php echo base_url(); ?>sports/create_sport">Create Sports</a>
            </div>
          </li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/register">Register</a></li>
					<li id="google_translate_element" class="nav-item"></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/logout">Logout</a></li>
					<?php endif; ?>
					<!--if login as staff-->
					<?php if($this->session->userdata('logged_in') && $this->session->userdata('authority_id') == 1) : ?>
						<li class="nav-item">
							<p class="nav-link mb-0">Hello Staff</p>
						</li>
						<li class="nav-item dropdown">
	            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Create</a>
	            <div class="dropdown-menu">
								<a class="nav-link" href="<?php echo base_url(); ?>posts/create">Create Post</a>
								<a class="nav-link" href="<?php echo base_url(); ?>timetable/create">Create Event</a>
								<a class="nav-link" href="<?php echo base_url(); ?>sports/create_sport">Create Sports</a>
	            </div>
	          </li>
						<li id="google_translate_element" class="nav-item"></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>users/logout">Logout</a></li>
					<?php endif; ?>

				</ul>
			</div>
			<!--mobile-->
			<button class="openbtn" onclick="openNav()">☰</button>
		</div>
	</nav>

	<div class="overlay" onclick="closeNav()"></div>
	<!--mobile menu-->
	<div id="mySidebar" class="sidebar">
		<a href="javascript:void(0)" class="" onclick="closeNav()">Close Menu<i class="icon-close closebtn"></i></a>
		<a href="/yokyo/" onclick="closeNav()">Home</a>
		<a href="/yokyo/about" onclick="closeNav()">About Us</a>
		<a href="/yokyo/posts" onclick="closeNav()">Posts</a>
		<a href="/yokyo/timetable" onclick="closeNav()">Timetable</a>
		<a href="/yokyo/book" onclick="closeNav()">Join Us</a>
	</div>


	<div class="container pad_bot">
		<!-- Flash messages -->
		      <?php if($this->session->flashdata('user_registered')): ?>
		        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
		      <?php endif; ?>

		      <?php if($this->session->flashdata('post_created')): ?>
		        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; ?>
		      <?php endif; ?>

		      <?php if($this->session->flashdata('post_updated')): ?>
		        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>'; ?>
		      <?php endif; ?>

		      <?php if($this->session->flashdata('category_created')): ?>
		        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_created').'</p>'; ?>
		      <?php endif; ?>

		      <?php if($this->session->flashdata('post_deleted')): ?>
		        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_deleted').'</p>'; ?>
		      <?php endif; ?>

		      <?php if($this->session->flashdata('login_failed')): ?>
		        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
		      <?php endif; ?>

		      <?php if($this->session->flashdata('user_loggedin')): ?>
		        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedin').'</p>'; ?>
		      <?php endif; ?>

		       <?php if($this->session->flashdata('user_loggedout')): ?>
		        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_loggedout').'</p>'; ?>
		      <?php endif; ?>

		      <?php if($this->session->flashdata('category_deleted')): ?>
		        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('category_deleted').'</p>'; ?>
		      <?php endif; ?>

					<?php if($this->session->flashdata('event_created')): ?>
		        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('event_created').'</p>'; ?>
		      <?php endif; ?>

					<?php if($this->session->flashdata('event_booked')): ?>
					 <?php echo '<p class="alert alert-success">'.$this->session->flashdata('event_booked').'</p>'; ?>
				 <?php endif; ?>
