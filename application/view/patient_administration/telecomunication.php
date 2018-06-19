	
<!--<div class="telecomContainer">-->
	<?php echo Telecomunication::getKeys('use') ?>
	<?php echo Telecomunication::getKeys('capabilities') ?>
	<input type="text" name="Telecom" placeholder="Number" required="true">
	<div class="tooltip">
		<span class="tooltiptext" style="margin-bottom: 0px; margin-left: -75px;">Delete the element</span>
		<input type="button" name="delete" value="X" class="deleteField">
	</div>
<!--</div>-->