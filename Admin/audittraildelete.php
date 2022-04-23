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
$audittrail_delete = new audittrail_delete();

// Run the page
$audittrail_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$audittrail_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var faudittraildelete = currentForm = new ew.Form("faudittraildelete", "delete");

// Form_CustomValidate event
faudittraildelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
faudittraildelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $audittrail_delete->showPageHeader(); ?>
<?php
$audittrail_delete->showMessage();
?>
<form name="faudittraildelete" id="faudittraildelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($audittrail_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $audittrail_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="audittrail">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($audittrail_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($audittrail->id->Visible) { // id ?>
		<th class="<?php echo $audittrail->id->headerCellClass() ?>"><span id="elh_audittrail_id" class="audittrail_id"><?php echo $audittrail->id->caption() ?></span></th>
<?php } ?>
<?php if ($audittrail->datetime->Visible) { // datetime ?>
		<th class="<?php echo $audittrail->datetime->headerCellClass() ?>"><span id="elh_audittrail_datetime" class="audittrail_datetime"><?php echo $audittrail->datetime->caption() ?></span></th>
<?php } ?>
<?php if ($audittrail->script->Visible) { // script ?>
		<th class="<?php echo $audittrail->script->headerCellClass() ?>"><span id="elh_audittrail_script" class="audittrail_script"><?php echo $audittrail->script->caption() ?></span></th>
<?php } ?>
<?php if ($audittrail->user->Visible) { // user ?>
		<th class="<?php echo $audittrail->user->headerCellClass() ?>"><span id="elh_audittrail_user" class="audittrail_user"><?php echo $audittrail->user->caption() ?></span></th>
<?php } ?>
<?php if ($audittrail->_action->Visible) { // action ?>
		<th class="<?php echo $audittrail->_action->headerCellClass() ?>"><span id="elh_audittrail__action" class="audittrail__action"><?php echo $audittrail->_action->caption() ?></span></th>
<?php } ?>
<?php if ($audittrail->_table->Visible) { // table ?>
		<th class="<?php echo $audittrail->_table->headerCellClass() ?>"><span id="elh_audittrail__table" class="audittrail__table"><?php echo $audittrail->_table->caption() ?></span></th>
<?php } ?>
<?php if ($audittrail->field->Visible) { // field ?>
		<th class="<?php echo $audittrail->field->headerCellClass() ?>"><span id="elh_audittrail_field" class="audittrail_field"><?php echo $audittrail->field->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$audittrail_delete->RecCnt = 0;
$i = 0;
while (!$audittrail_delete->Recordset->EOF) {
	$audittrail_delete->RecCnt++;
	$audittrail_delete->RowCnt++;

	// Set row properties
	$audittrail->resetAttributes();
	$audittrail->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$audittrail_delete->loadRowValues($audittrail_delete->Recordset);

	// Render row
	$audittrail_delete->renderRow();
?>
	<tr<?php echo $audittrail->rowAttributes() ?>>
<?php if ($audittrail->id->Visible) { // id ?>
		<td<?php echo $audittrail->id->cellAttributes() ?>>
<span id="el<?php echo $audittrail_delete->RowCnt ?>_audittrail_id" class="audittrail_id">
<span<?php echo $audittrail->id->viewAttributes() ?>>
<?php echo $audittrail->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($audittrail->datetime->Visible) { // datetime ?>
		<td<?php echo $audittrail->datetime->cellAttributes() ?>>
<span id="el<?php echo $audittrail_delete->RowCnt ?>_audittrail_datetime" class="audittrail_datetime">
<span<?php echo $audittrail->datetime->viewAttributes() ?>>
<?php echo $audittrail->datetime->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($audittrail->script->Visible) { // script ?>
		<td<?php echo $audittrail->script->cellAttributes() ?>>
<span id="el<?php echo $audittrail_delete->RowCnt ?>_audittrail_script" class="audittrail_script">
<span<?php echo $audittrail->script->viewAttributes() ?>>
<?php echo $audittrail->script->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($audittrail->user->Visible) { // user ?>
		<td<?php echo $audittrail->user->cellAttributes() ?>>
<span id="el<?php echo $audittrail_delete->RowCnt ?>_audittrail_user" class="audittrail_user">
<span<?php echo $audittrail->user->viewAttributes() ?>>
<?php echo $audittrail->user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($audittrail->_action->Visible) { // action ?>
		<td<?php echo $audittrail->_action->cellAttributes() ?>>
<span id="el<?php echo $audittrail_delete->RowCnt ?>_audittrail__action" class="audittrail__action">
<span<?php echo $audittrail->_action->viewAttributes() ?>>
<?php echo $audittrail->_action->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($audittrail->_table->Visible) { // table ?>
		<td<?php echo $audittrail->_table->cellAttributes() ?>>
<span id="el<?php echo $audittrail_delete->RowCnt ?>_audittrail__table" class="audittrail__table">
<span<?php echo $audittrail->_table->viewAttributes() ?>>
<?php echo $audittrail->_table->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($audittrail->field->Visible) { // field ?>
		<td<?php echo $audittrail->field->cellAttributes() ?>>
<span id="el<?php echo $audittrail_delete->RowCnt ?>_audittrail_field" class="audittrail_field">
<span<?php echo $audittrail->field->viewAttributes() ?>>
<?php echo $audittrail->field->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$audittrail_delete->Recordset->moveNext();
}
$audittrail_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $audittrail_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$audittrail_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$audittrail_delete->terminate();
?>