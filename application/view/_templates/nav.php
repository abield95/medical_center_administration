<!-- <nav class="nav">
	<ul id="medical_name">
		<li>Medical Administration</li>
	</ul>
	<ul id="medical_support_tools">
		<li id="menu_container">menu</li>
		<li id="search_container"><input type="text" placeholder="search"></li>
		<li id="message_container">Messages</li>
		<li id="notes_container">Notes</li>
		<li id="username_container">Username</li>
		<li id="config_container">Config</li>
	</ul>
</nav> -->
<section class="nav_section">
	<div class="content">
		<div class="navigation">
			<div class="left_nav_container">
				<h2>Hospital Administration</h2>
			</div>
			<div class="right_nav_container">
				<input type="image" class="image_button" id="menu_nav_button" src="<?php echo Config::get('URL') ?>images/menu.png">
				<input type="text" name="search" placeholder="Search" id="search_nav_element">
				<input type="image" class="image_button" src="<?php echo Config::get('URL') ?>images/message.png">
				<input type="image" class="image_button" src="<?php echo Config::get('URL') ?>images/notes.png">
				<input type="button" value="UserName">
				<input type="image" class="image_button" src="<?php echo Config::get('URL') ?>images/config.png" alt="config">
			</div>
		</div>
	</div>
</section>

