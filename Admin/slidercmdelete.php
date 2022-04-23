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
$slidercm_delete = new slidercm_delete();

// Run the page
$slidercm_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$slidercm_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fslidercmdelete = currentForm = new ew.Form("fslidercmdelete", "delete");

// Form_CustomValidate event
fslidercmdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fslidercmdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $slidercm_delete->showPageHeader(); ?>
<?php
$slidercm_delete->showMessage();
?>
<form name="fslidercmdelete" id="fslidercmdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($slidercm_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $slidercm_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="slidercm">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($slidercm_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($slidercm->SlidercmID->Visible) { // SlidercmID ?>
		<th class="<?php echo $slidercm->SlidercmID->headerCellClass() ?>"><span id="elh_slidercm_SlidercmID" class="slidercm_SlidercmID"><?php echo $slidercm->SlidercmID->caption() ?></span></th>
<?php } ?>
<?php if ($slidercm->Titulo->Visible) { // Titulo ?>
		<th class="<?php echo $slidercm->Titulo->headerCellClass() ?>"><span id="elh_slidercm_Titulo" class="slidercm_Titulo"><?php echo $slidercm->Titulo->caption() ?></span></th>
<?php } ?>
<?php if ($slidercm->Detalle->Visible) { // Detalle ?>
		<th class="<?php echo $slidercm->Detalle->headerCellClass() ?>"><span id="elh_slidercm_Detalle" class="slidercm_Detalle"><?php echo $slidercm->Detalle->caption() ?></span></th>
<?php } ?>
<?php if ($slidercm->Url_image->Visible) { // Url_image ?>
		<th class="<?php echo $slidercm->Url_image->headerCellClass() ?>"><span id="elh_slidercm_Url_image" class="slidercm_Url_image"><?php echo $slidercm->Url_image->caption() ?></span></th>
<?php } ?>
<?php if ($slidercm->Orden->Visible) { // Orden ?>
		<th class="<?php echo $slidercm->Orden->headerCellClass() ?>"><span id="elh_slidercm_Orden" class="slidercm_Orden"><?php echo $slidercm->Orden->caption() ?></span></th>
<?php } ?>
<?php if ($slidercm->Estado->Visible) { // Estado ?>
		<th class="<?php echo $slidercm->Estado->headerCellClass() ?>"><span id="elh_slidercm_Estado" class="slidercm_Estado"><?php echo $slidercm->Estado->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$slidercm_delete->RecCnt = 0;
$i = 0;
while (!$slidercm_delete->Recordset->EOF) {
	$slidercm_delete->RecCnt++;
	$slidercm_delete->RowCnt++;

	// Set row properties
	$slidercm->resetAttributes();
	$slidercm->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$slidercm_delete->loadRowValues($slidercm_delete->Recordset);

	// Render row
	$slidercm_delete->renderRow();
?>
	<tr<?php echo $slidercm->rowAttributes() ?>>
<?php if ($slidercm->SlidercmID->Visible) { // SlidercmID ?>
		<td<?php echo $slidercm->SlidercmID->cellAttributes() ?>>
<span id="el<?php echo $slidercm_delete->RowCnt ?>_slidercm_SlidercmID" class="slidercm_SlidercmID">
<span<?php echo $slidercm->SlidercmID->viewAttributes() ?>>
<?php echo $slidercm->SlidercmID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($slidercm->Titulo->Visible) { // Titulo ?>
		<td<?php echo $slidercm->Titulo->cellAttributes() ?>>
<span id="el<?php echo $slidercm_delete->RowCnt ?>_slidercm_Titulo" class="slidercm_Titulo">
<span<?php echo $slidercm->Titulo->viewAttributes() ?>>
<?php echo $slidercm->Titulo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($slidercm->Detalle->Visible) { // Detalle ?>
		<td<?php echo $slidercm->Detalle->cellAttributes() ?>>
<span id="el<?php echo $slidercm_delete->RowCnt ?>_slidercm_Detalle" class="slidercm_Detalle">
<span<?php echo $slidercm->Detalle->viewAttributes() ?>>
<?php echo $slidercm->Detalle->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($slidercm->Url_image->Visible) { // Url_image ?>
		<td<?php echo $slidercm->Url_image->cellAttributes() ?>>
<span id="el<?php echo $slidercm_delete->RowCnt ?>_slidercm_Url_image" class="slidercm_Url_image">
<span>
<?php echo GetFileViewTag($slidercm->Url_image, $slidercm->Url_image->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($slidercm->Orden->Visible) { // Orden ?>
		<td<?php echo $slidercm->Orden->cellAttributes() ?>>
<span id="el<?php echo $slidercm_delete->RowCnt ?>_slidercm_Orden" class="slidercm_Orden">
<span<?php echo $slidercm->Orden->viewAttributes() ?>>
<?php echo $slidercm->Orden->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($slidercm->Estado->Visible) { // Estado ?>
		<td<?php echo $slidercm->Estado->cellAttributes() ?>>
<span id="el<?php echo $slidercm_delete->RowCnt ?>_slidercm_Estado" class="slidercm_Estado">
<span<?php echo $slidercm->Estado->viewAttributes() ?>>
<?php echo $slidercm->Estado->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$slidercm_delete->Recordset->moveNext();
}
$slidercm_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $slidercm_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$slidercm_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$slidercm_delete->terminate();
?>