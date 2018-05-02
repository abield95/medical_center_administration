
<head>
	<script type="text/javascript" src="<?php echo Config::get('URL') ?>js/add_patient.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo Config::get('URL') ?>css/add_patient.css">
</head>
<body>
	<form>

	<label for="fullname">Full Name</label>
	<input type="text" name="fullname">

	<fieldset id="telecomFieldset">
		<legend>Telecom Area</legend>
		<div id="telecomunicationContainer">
			<?php $this->renderWithoutHeaderAndFooter('patient_administration/telecomunication');  ?>
		</div>
		<input type="button" value="Add" id="addTel">
	</fieldset>

	<label for="genderCode">Gender</label>

	<?php echo RoleCode::getGender(); ?>
	<!-- <select name="genderCode" id="genderCode">
		
	</select> -->

	<fieldset>
		<legend>Birth information</legend>
		<input type="text" name="birthDate" placeholder="birthDate">
		<label for="multipleBirth">Multiple Birth</label>
		<input type="checkbox" name="checkMultiplebirth">
		<input type="number" name="multipleBirthOrderNumber" value="1">
	</fieldset>

	<fieldset>
		<legend>Deceased info</legend>
		<label for="deseacedCheck">Deceased</label>
		<input type="checkbox" name="deceased">
		<input type="text" name="deceasedTime" placeholder="deceasedTime">
	</fieldset>

	<label for="organDonor">Organ Donor</label>
	<input type="checkbox" name="organDonor">

	<fieldset id="addressContainer">
		<legend>Address</legend>
		<?php echo Address::loadAddrFields();#Address::getFieldsUse(1, array("default"), "Type Address"); ?>
	</fieldset>

	<input type="submit" value="submit">
</form>
</body>