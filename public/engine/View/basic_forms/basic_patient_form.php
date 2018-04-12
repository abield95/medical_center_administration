
<head>
	<link rel="stylesheet" type="text/css" href="engine/View/basic_forms/basic_patient_form.css">
	<script type="text/javascript" src="engine/View/basic_forms/basic_patient_form.js"></script>
</head>
<form id="patient_data">
		<fieldset>
			<legend>Patient Information: </legend>
			<label for="name">Name: </label>
			<input type="text" name="name" id="name" placeholder="Name">

			<label for="lastName">Last Name</label>
			<input type="text" name="lastName" id="lastName" placeholder="Last Name">

			<label for="sex">Sex: </label>
			<select id="sex" name="sex">
				<option value="m">M</option>
				<option value="f">F</option>
				<option value="o">Other</option>
			</select>

			<label for="birthDate" id="lbBirthDate">BirthDate</label>
			<input type="text" name="birthDate" id="birthDate" placeholder="YY/MM/DD">

			<label for="race">Race</label>
			<input type="text" name="race" id="race">

			<label for="maritalStatus">Marital Status: </label>
			<select name="maritalStatus">
				<option value="married">Married</option>
				<option value="divorced">Divorced</option>
				<option value="single">Single</option>
			</select>

		</fieldset>

		<fieldset>
			<legend>Identification</legend>
			<label for="socialSecurityNumber">Social Security Number: </label>
			<input type="text" name="socialSecurityNumber" id="socialSecurityNumber">

			<label for="identificationNumber">Identification Number: </label>
			<input type="text" name="identificationNumber" id="identificationNumber">
		</fieldset>

		<fieldset>
			<legend>Languaje Preferences</legend>
			<label for="languajeForSpeaking">Speaking</label>
			<select name="languajeForSpeaking" id="languajeForSpeaking">
				<option value="en">English</option>
				<option value="sp">Spanish</option>
			</select>

			<label for="languajeForWrittenMedicalInfo">Writing Medical Info</label>
			<select name="languajeForWrittenMedicalInfo" id="languajeForWrittenMedicalInfo">
				<option value="en">English</option>
				<option value="sp">Spanish</option>
			</select>

			<label for="checkForInterpreter">Interpreter</label>
			<input type="checkbox" name="checkForInterpreter" id="checkForInterpreter">
		</fieldset>

		<fieldset>
			<legend>Contact Information</legend>

			<label for="address">Address</label>
			<input type="text" name="address" id="address">

			<label for="city" id="lbCity">City: </label>
			<input type="text" name="city" id="city">

			<label for="state">State: </label>
			<input type="text" name="state" id="state">

			<label for="country">Country</label>
			<input type="text" name="country" id="country">

			<label for="postalCode" id="lbPostalCode">Postal Code: </label>
			<input type="number" name="postalCode" id="postalCode" >

			<label for="emergencyContact">Emergency Contact: </label>
			<input type="text" name="emergencyContact" id="emergencyContact">

			<label for="emergencyPhone">Emergency Phone: </label>
			<input type="text" name="emergencyPhone" id="emergencyPhone">

			<label for="workPhone">Work Phone: </label>
			<input type="text" name="workPhone" id="workPhone">

			<label for="homePhone">Home Phone: </label>
			<input type="text" name="homePhone" id="homePhone">

			<label for="mobilePhone">Mobile Phone: </label>
			<input type="text" name="mobilePhone" id="mobilePhone">

			<label for="contactEmail">Contact Email: </label>
			<input type="email" name="contactEmail" id="contactEmail">

		</fieldset>
		<input type="submit" name="submitPatientData" id="submitPatientData" value="Save">
	</form>