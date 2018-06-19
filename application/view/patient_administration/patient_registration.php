<link rel="stylesheet" type="text/css" href="<?php echo Config::get('URL') ?>css/style.css">

<style type="text/css">
	#identificationContainer, #telecomFieldset
	{
		width: 45%;
	}

	#addressContainer
	{
		width: 95%;
	}
</style>

<main>
	<form action="">
		<label for="name">Names</label>
		<input type="text" name="name">
		<label for="lastname">Lastname</label>
		<input type="text" name="lastname">

		<select name="maritalStatusSelect" id="maritalStatusSelect">
			<option value="M">Masculino</option>
			<option value="F">Femenino</option>
			<option value="U">Unknown</option>
		</select>

		<label for="birthdate">BirthDate</label>
		<input type="text" name="birthdate">

		<fieldset id="identificationContainer">
			<legend>Identification</legend>
			<input type="text" name="identification">
			<input type="button" name="addIDField" value="Add">
		</fieldset>

		<fieldset id="telecomFieldset">
			<legend>Telecomunication</legend>
			<span id="hiddenValTel" class="hidden">0</span>
			<div id="telecomunicationContainer">
				<div id="telecomContainer_0" class="prueba">
					<?php $this->renderWithoutHeaderAndFooter('patient_administration/telecomunication');  ?>
				</div>
			</div>
			<input type="button" name="addTelecomField" value="Add Telecom" id="addTelecom">
		</fieldset>

		<fieldset id="addressContainer">
			<legend>Address</legend>
			<input type="text" name="address">
			<input type="button" name="addAddressField" value="Add Address">
		</fieldset>

		<input type="submit" name="registerPatient" value="Register">
	</form>
</main>

<script type="application/javascript" src="<?php echo Config::get('URL') ?>js/add_patient.js"></script>
<script type="application/javascript" src="<?php echo Config::get('URL') ?>js/common.js"></script>