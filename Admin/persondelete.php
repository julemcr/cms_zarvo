<?php
namespace PHPMaker2019\cmsweb;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$person_delete = new person_delete();

// Run the page
$person_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$person_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fpersondelete = currentForm = new ew.Form("fpersondelete", "delete");

// Form_CustomValidate event
fpersondelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpersondelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpersondelete.lists["x_Sexo"] = <?php echo $person_delete->Sexo->Lookup->toClientList() ?>;
fpersondelete.lists["x_Sexo"].options = <?php echo JsonEncode($person_delete->Sexo->lookupOptions()) ?>;
fpersondelete.lists["x_Country"] = <?php echo $person_delete->Country->Lookup->toClientList() ?>;
fpersondelete.lists["x_Country"].options = <?php echo JsonEncode($person_delete->Country->lookupOptions()) ?>;
fpersondelete.lists["x_Activated[]"] = <?php echo $person_delete->Activated->Lookup->toClientList() ?>;
fpersondelete.lists["x_Activated[]"].options = <?php echo JsonEncode($person_delete->Activated->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $person_delete->showPageHeader(); ?>
<?php
$person_delete->showMessage();
?>
<form name="fpersondelete" id="fpersondelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($person_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $person_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="person">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($person_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($person->PersonID->Visible) { // PersonID ?>
		<th class="<?php echo $person->PersonID->headerCellClass() ?>"><span id="elh_person_PersonID" class="person_PersonID"><?php echo $person->PersonID->caption() ?></span></th>
<?php } ?>
<?php if ($person->Sexo->Visible) { // Sexo ?>
		<th class="<?php echo $person->Sexo->headerCellClass() ?>"><span id="elh_person_Sexo" class="person_Sexo"><?php echo $person->Sexo->caption() ?></span></th>
<?php } ?>
<?php if ($person->Name->Visible) { // Name ?>
		<th class="<?php echo $person->Name->headerCellClass() ?>"><span id="elh_person_Name" class="person_Name"><?php echo $person->Name->caption() ?></span></th>
<?php } ?>
<?php if ($person->LastName->Visible) { // LastName ?>
		<th class="<?php echo $person->LastName->headerCellClass() ?>"><span id="elh_person_LastName" class="person_LastName"><?php echo $person->LastName->caption() ?></span></th>
<?php } ?>
<?php if ($person->Country->Visible) { // Country ?>
		<th class="<?php echo $person->Country->headerCellClass() ?>"><span id="elh_person_Country" class="person_Country"><?php echo $person->Country->caption() ?></span></th>
<?php } ?>
<?php if ($person->City->Visible) { // City ?>
		<th class="<?php echo $person->City->headerCellClass() ?>"><span id="elh_person_City" class="person_City"><?php echo $person->City->caption() ?></span></th>
<?php } ?>
<?php if ($person->Address->Visible) { // Address ?>
		<th class="<?php echo $person->Address->headerCellClass() ?>"><span id="elh_person_Address" class="person_Address"><?php echo $person->Address->caption() ?></span></th>
<?php } ?>
<?php if ($person->Username->Visible) { // Username ?>
		<th class="<?php echo $person->Username->headerCellClass() ?>"><span id="elh_person_Username" class="person_Username"><?php echo $person->Username->caption() ?></span></th>
<?php } ?>
<?php if ($person->Activated->Visible) { // Activated ?>
		<th class="<?php echo $person->Activated->headerCellClass() ?>"><span id="elh_person_Activated" class="person_Activated"><?php echo $person->Activated->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$person_delete->RecCnt = 0;
$i = 0;
while (!$person_delete->Recordset->EOF) {
	$person_delete->RecCnt++;
	$person_delete->RowCnt++;

	// Set row properties
	$person->resetAttributes();
	$person->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$person_delete->loadRowValues($person_delete->Recordset);

	// Render row
	$person_delete->renderRow();
?>
	<tr<?php echo $person->rowAttributes() ?>>
<?php if ($person->PersonID->Visible) { // PersonID ?>
		<td<?php echo $person->PersonID->cellAttributes() ?>>
<span id="el<?php echo $person_delete->RowCnt ?>_person_PersonID" class="person_PersonID">
<span<?php echo $person->PersonID->viewAttributes() ?>>
<?php echo $person->PersonID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($person->Sexo->Visible) { // Sexo ?>
		<td<?php echo $person->Sexo->cellAttributes() ?>>
<span id="el<?php echo $person_delete->RowCnt ?>_person_Sexo" class="person_Sexo">
<span<?php echo $person->Sexo->viewAttributes() ?>>
<?php echo $person->Sexo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($person->Name->Visible) { // Name ?>
		<td<?php echo $person->Name->cellAttributes() ?>>
<span id="el<?php echo $person_delete->RowCnt ?>_person_Name" class="person_Name">
<span<?php echo $person->Name->viewAttributes() ?>>
<?php echo $person->Name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($person->LastName->Visible) { // LastName ?>
		<td<?php echo $person->LastName->cellAttributes() ?>>
<span id="el<?php echo $person_delete->RowCnt ?>_person_LastName" class="person_LastName">
<span<?php echo $person->LastName->viewAttributes() ?>>
<?php echo $person->LastName->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($person->Country->Visible) { // Country ?>
		<td<?php echo $person->Country->cellAttributes() ?>>
<span id="el<?php echo $person_delete->RowCnt ?>_person_Country" class="person_Country">
<span<?php echo $person->Country->viewAttributes() ?>>
<?php echo $person->Country->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($person->City->Visible) { // City ?>
		<td<?php echo $person->City->cellAttributes() ?>>
<span id="el<?php echo $person_delete->RowCnt ?>_person_City" class="person_City">
<span<?php echo $person->City->viewAttributes() ?>>
<?php echo $person->City->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($person->Address->Visible) { // Address ?>
		<td<?php echo $person->Address->cellAttributes() ?>>
<span id="el<?php echo $person_delete->RowCnt ?>_person_Address" class="person_Address">
<span<?php echo $person->Address->viewAttributes() ?>>
<?php echo $person->Address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($person->Username->Visible) { // Username ?>
		<td<?php echo $person->Username->cellAttributes() ?>>
<span id="el<?php echo $person_delete->RowCnt ?>_person_Username" class="person_Username">
<span<?php echo $person->Username->viewAttributes() ?>>
<?php echo $person->Username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($person->Activated->Visible) { // Activated ?>
		<td<?php echo $person->Activated->cellAttributes() ?>>
<span id="el<?php echo $person_delete->RowCnt ?>_person_Activated" class="person_Activated">
<span<?php echo $person->Activated->viewAttributes() ?>>
<?php if (ConvertToBool($person->Activated->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $person->Activated->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $person->Activated->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$person_delete->Recordset->moveNext();
}
$person_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $person_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$person_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$person_delete->terminate();
?>