<?php/**private $classCode;
	private $determinerCode;
	private $id; //unordered array
	private $code;
	private $quantity = NULL;
	private $name;
	private $desc;
	private $statusCode;
	private $existenceTime;
	private $telecom;
	private $riskCode;
	private $handlingCode;

	//associations of entity
	private $communicationFunction;//0...*
	private $playedRole;//0...*
	private $scopedRole;//0...*
	private $languajeCommunication;//0...*

private $administrativeGenderCode;
	private $birthTime;
	private $deceasedInd;
	private $deceasedTime;
	private $multipleBirthInd;
	private $multipleBirthOrderNumber;
	private $organDonorInd;

private $addr;
	private $maritalStatusCode;
	private $educationLevelCode;
	private $disabilityCode;
	private $livingArrangementCode;
	private $religiousAffiliationCode;
	private $raceCode;
	private $ethnicGroupCode;**/ ?>

<input type="text" placeholder="Name">
<input type="text" placeholder="LastName">
<input type="text" placeholder="Person description">

<label for="statusCode">Status</label>
<select name="statusCode">
	<option value="active">Active</option>
	<option value="inactive">Inactive</option>
</select>

<!--Telecom-->
<fieldset id="telecomFieldset">
	<legend>Telecomunication</legend>
	<span id="hiddenValTel" class="hidden">0</span>
	<div id="telecomunicationContainer">
		<div id="telecomContainer_0" class="prueba">
			<?php $this->renderWithoutHeaderAndFooter('patient_administration/telecomunication');  ?>
		</div>
	</div>
	<div class="tooltip"><span class="tooltiptext" style="margin-bottom: 0px; margin-left: -75px;">Add Telecom Field</span><input type="button" class="addButton" name="addTelecomField" value="+" id="addTelecom"></div>
</fieldset>

<label for="genderCode">Gender</label>
<select name="genderCode" id="genderCode">
	<option value="M">Male</option>
	<option value="F">Female</option>
	<option value="UN">Undifferentiated</option>
</select>

<fieldset>
	<legend>BirthDate</legend>
	<input type="number" name="day" min="1" max="31" placeholder="Day">
	<input type="number" name="month" min="1" max="12" placeholder="Month">
	<input type="number" name="year" min="1920" placeholder="Year">
</fieldset>

<div>
	<label for="deceasedInd">Deceased</label>
	<input type="checkbox" name="deceasedInd" id="deceasedInd">

	<div class="hidden" id="deceasedInfo">
		<input type="number" name="day" min="1" max="31" placeholder="Day" required="true">
		<input type="number" name="month" min="1" max="12" placeholder="Month" required="true">
		<input type="number" name="year" min="1920" placeholder="Year" required="true">
		<input type="number" name="hour" min="0" max="23" placeholder="Hour">
		<input type="number" name="minute" min="0" max="59" placeholder="Minutes">
		<input type="number" name="secods" min="0" max="59" placeholder="Seconds">
	</div>
</div>

<div>
	<label for="multipleBirth">Multiple Birth</label>
	<input type="checkbox" name="multipleBirth" id="multipleBirthInd">

	<div id="multipleBirthNumber" class="hidden">
		<label for="multipleBirthNumber">Multiple Birth Number</label>
		<input type="number" name="multipleBirthNumber" min="1" max="12" value="1">
	</div>
</div>

<label for="organDonor">Organ Donor</label>
<input type="checkbox" name="organDonor">

<div class='dropdown'>
	<input type='text' class='droptxt' placeholder='Marital Status' id='maritalStatus' required='true'>
	<div class='dropdown-content'>
		<a class='tooltip' id="A"><span class='tooltiptext'>Marriage contract has been declared null and to not have existed</span>Annulled</a>
		<a class="tooltip" id="D"><span class="tooltiptext">Marriage contract has been declared dissolved and inactive</span>Divorced</a>
		<a class="tooltip" id="I"><span class="tooltiptext">Subject to an Interlocutory Decree.</span>Interlocutory</a>
		<a class="tooltip" id="L"><span class="tooltiptext"></span>Legally Separated</a>
		<a class="tooltip" id="M"><span class="tooltiptext">A current marriage contract is active</span>Married</a>
		<a class="tooltip" id="P"><span class="tooltiptext">More than 1 current spouse</span>Polygamous</a>
		<a class="tooltip" id="S"><span class="tooltiptext">No marriage contract has ever been entered</span>Never Married</a>
		<a class="tooltip" id="T"><span class="tooltiptext">Person declares that a domestic partner relationship exists.</span>Domestic Partner</a>
		<a class="tooltip" id="U"><span class="tooltiptext">Currently not in a marriage contract.</span>Unmarried</a>
		<a class="tooltip" id="W"><span class="tooltiptext">The spouse has dies</span>Widowed</a>			
	</div>
</div>

<div class="dropdown">
	<label for="educationLevel">Education Level</label>
	<input type='text' class='droptxt' placeholder='Education Level' id='educationLevel' required='true' name="educationLevel">
	<div class="dropdown-content">
		<a class='tooltip' id=""><span class="tooltiptext">Associate's or technical degree complete</span>ASSOC</a>
		<a class='tooltip' id=""><span class="tooltiptext">College or baccalaureate degree complete</span>BD</a>
		<a class='tooltip' id=""><span class="tooltiptext">Elementary School</span>ELEM</a>
		<a class='tooltip' id=""><span class="tooltiptext">Graduate or professional Degree complete</span>GD</a>
		<a class='tooltip' id=""><span class="tooltiptext">High School or secondary school degree complete</span>HS</a>
		<a class='tooltip' id=""><span class="tooltiptext">Some post-baccalaureate education</span>PB</a>
		<a class='tooltip' id=""><span class="tooltiptext">Doctoral or post graduate education</span>POSTG</a>
		<a class='tooltip' id=""><span class="tooltiptext">Some College education</span>SCOL</a>
		<a class='tooltip' id=""><span class="tooltiptext">Some secondary or high school education</span>SEC</a>
	</div>
</div>

<fieldset>
	<legend>Disability</legend>
	<span id="hiddenValDis" class="hidden">0</span>
	<div id="disElementContainer">
		<div id="disabilityContainer_0">
			<div class="dropdown">
				<label for="personDisabilityType">Disability Type</label>
				<input type='text' class='droptxt' placeholder='Disability Type' id='disabilityType_0' required='true' name="disabilityType">
				<div class="dropdown-content">
					<a class='tooltip' id=""><span class="tooltiptext"></span>Vision Impaired</a>
					<a class='tooltip' id=""><span class="tooltiptext"></span>Hearing Impaired</a>
					<a class='tooltip' id=""><span class="tooltiptext"></span>Speech Impaired</a>
					<a class='tooltip' id=""><span class="tooltiptext"></span>Mentally Impaired</a>
					<a class='tooltip' id=""><span class="tooltiptext">A crib is required to move the person</span>Requires crib</a>
					<a class='tooltip' id=""><span class="tooltiptext">Person requires crutches to ambulate</span>Requires Crutches</a>
					<a class='tooltip' id=""><span class="tooltiptext">A gurney is required to move the person</span>Requires Gurney</a>
					<a class='tooltip' id=""><span class="tooltiptext">Person requires a wheelchair to be ambulatory</span>Requires Wheelchair</a>
					<a class='tooltip' id=""><span class="tooltiptext">Person requires a walker to ambulate</span>Requires Walker</a>
					<a class="tooltip" id=""><span class="tooltiptext">No Disability</span>No Disability</a>
				</div>
			</div>
		</div>
	</div>
	<div class="tooltip">
		<span class="tooltiptext" style="margin-bottom: 0px; margin-left: -75px;">Add disability</span>
		<input type="button" class="addButton" name="addDisability" id="addDisability" value="+">
	</div>
</fieldset>

<label for="religious">Religious Affiliation</label>
<select name="religious">
	<option value="none">None</option>
	<option value="catolic">Catolic</option>
</select>

<label for="race">Race</label>
<select name="race" id="race">
	<option value="black">Black</option>
	<option value="white">White</option>
</select>

<label for="ethnicGroup">Ethnic Group</label>
<select name="ethnicGroup" id="ethnicGroup">
	<option value="black">Black</option>
	<option value="white">White</option>
</select>

<script type="application/javascript" src="<?php echo Config::get('URL') ?>js/add_patient.js"></script>
<script type="application/javascript" src="<?php echo Config::get('URL') ?>js/common.js"></script>
<script type="application/javascript" src="<?php echo Config::get('URL') ?>js/person_view.js"></script>