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
$terms_conditions_delete = new terms_conditions_delete();

// Run the page
$terms_conditions_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terms_conditions_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fterms_conditionsdelete = currentForm = new ew.Form("fterms_conditionsdelete", "delete");

// Form_CustomValidate event
fterms_conditionsdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fterms_conditionsdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fterms_conditionsdelete.lists["x_status[]"] = <?php echo $terms_conditions_delete->status->Lookup->toClientList() ?>;
fterms_conditionsdelete.lists["x_status[]"].options = <?php echo JsonEncode($terms_conditions_delete->status->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $terms_conditions_delete->showPageHeader(); ?>
<?php
$terms_conditions_delete->showMessage();
?>
<form name="fterms_conditionsdelete" id="fterms_conditionsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($terms_conditions_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $terms_conditions_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terms_conditions">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($terms_conditions_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($terms_conditions->TermsConditionsID->Visible) { // TermsConditionsID ?>
		<th class="<?php echo $terms_conditions->TermsConditionsID->headerCellClass() ?>"><span id="elh_terms_conditions_TermsConditionsID" class="terms_conditions_TermsConditionsID"><?php echo $terms_conditions->TermsConditionsID->caption() ?></span></th>
<?php } ?>
<?php if ($terms_conditions->name->Visible) { // name ?>
		<th class="<?php echo $terms_conditions->name->headerCellClass() ?>"><span id="elh_terms_conditions_name" class="terms_conditions_name"><?php echo $terms_conditions->name->caption() ?></span></th>
<?php } ?>
<?php if ($terms_conditions->dateupdate->Visible) { // dateupdate ?>
		<th class="<?php echo $terms_conditions->dateupdate->headerCellClass() ?>"><span id="elh_terms_conditions_dateupdate" class="terms_conditions_dateupdate"><?php echo $terms_conditions->dateupdate->caption() ?></span></th>
<?php } ?>
<?php if ($terms_conditions->_userid->Visible) { // userid ?>
		<th class="<?php echo $terms_conditions->_userid->headerCellClass() ?>"><span id="elh_terms_conditions__userid" class="terms_conditions__userid"><?php echo $terms_conditions->_userid->caption() ?></span></th>
<?php } ?>
<?php if ($terms_conditions->status->Visible) { // status ?>
		<th class="<?php echo $terms_conditions->status->headerCellClass() ?>"><span id="elh_terms_conditions_status" class="terms_conditions_status"><?php echo $terms_conditions->status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$terms_conditions_delete->RecCnt = 0;
$i = 0;
while (!$terms_conditions_delete->Recordset->EOF) {
	$terms_conditions_delete->RecCnt++;
	$terms_conditions_delete->RowCnt++;

	// Set row properties
	$terms_conditions->resetAttributes();
	$terms_conditions->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$terms_conditions_delete->loadRowValues($terms_conditions_delete->Recordset);

	// Render row
	$terms_conditions_delete->renderRow();
?>
	<tr<?php echo $terms_conditions->rowAttributes() ?>>
<?php if ($terms_conditions->TermsConditionsID->Visible) { // TermsConditionsID ?>
		<td<?php echo $terms_conditions->TermsConditionsID->cellAttributes() ?>>
<span id="el<?php echo $terms_conditions_delete->RowCnt ?>_terms_conditions_TermsConditionsID" class="terms_conditions_TermsConditionsID">
<span<?php echo $terms_conditions->TermsConditionsID->viewAttributes() ?>>
<?php echo $terms_conditions->TermsConditionsID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terms_conditions->name->Visible) { // name ?>
		<td<?php echo $terms_conditions->name->cellAttributes() ?>>
<span id="el<?php echo $terms_conditions_delete->RowCnt ?>_terms_conditions_name" class="terms_conditions_name">
<span<?php echo $terms_conditions->name->viewAttributes() ?>>
<?php echo $terms_conditions->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terms_conditions->dateupdate->Visible) { // dateupdate ?>
		<td<?php echo $terms_conditions->dateupdate->cellAttributes() ?>>
<span id="el<?php echo $terms_conditions_delete->RowCnt ?>_terms_conditions_dateupdate" class="terms_conditions_dateupdate">
<span<?php echo $terms_conditions->dateupdate->viewAttributes() ?>>
<?php echo $terms_conditions->dateupdate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terms_conditions->_userid->Visible) { // userid ?>
		<td<?php echo $terms_conditions->_userid->cellAttributes() ?>>
<span id="el<?php echo $terms_conditions_delete->RowCnt ?>_terms_conditions__userid" class="terms_conditions__userid">
<span<?php echo $terms_conditions->_userid->viewAttributes() ?>>
<?php echo $terms_conditions->_userid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terms_conditions->status->Visible) { // status ?>
		<td<?php echo $terms_conditions->status->cellAttributes() ?>>
<span id="el<?php echo $terms_conditions_delete->RowCnt ?>_terms_conditions_status" class="terms_conditions_status">
<span<?php echo $terms_conditions->status->viewAttributes() ?>>
<?php if (ConvertToBool($terms_conditions->status->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $terms_conditions->status->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $terms_conditions->status->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$terms_conditions_delete->Recordset->moveNext();
}
$terms_conditions_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $terms_conditions_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$terms_conditions_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$terms_conditions_delete->terminate();
?>