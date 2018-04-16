
<form action="">

	<label for="fullname">Full Name</label>
	<input type="text" name="fullname">

	<fieldset>
		<legend>Telecom Area</legend>
		<input type="text" name="Telecom">
		<?php echo Telecomunication::getKeys('use') ?>
		<?php echo Telecomunication::getKeys('capabilities') ?>
		<input type="text" name="time" placeholder="Timw">
	</fieldset>

	<label for="genderCode">Gender Code</label>
	<select name="genderCode" id="genderCode">
		<option value=<?php echo RoleCode::get("AdministrativeGender", "F"); ?>></option>
	</select>

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
</form>