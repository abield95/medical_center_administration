	<section class="section_left">
		<div class="content">
			<div id="profile_picture_container">
				<picture>
					<img src="<?php echo Config::get('URL') ?>images/notes.png" alt="">
				</picture>
			</div>
			<div class="dropdown left_info_container">
				<a class="showdrop" id="username">UserName</a>
				<div class="hidden">
					<a>Balance</a>
					<a>Inbox</a>
					<a>Settings</a>
					<a>LogOut</a>
				</div>
			</div>
			<hr>
			<div class="dropdown">
				<a class="showdrop" id="appintment">Appointment</a>
				<div class="hidden">
					<a>Dr. Schedule</a>
					<a>Prox. Appointment</a>
				</div>
			</div>
			<div class="dropdown">
				<a class="showdrop" id="doctors">Doctors</a>
				<div class="hidden">
					<a>All Doctors</a>
					<a>Add Doctor</a>
					<a>Edit Doctor</a>
					<a>Doctor Profile</a>
				</div>
			</div>
		</div>
	</section>

	<section class="section_right">
		<div class="content">