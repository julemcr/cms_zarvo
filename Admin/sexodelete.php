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
$sexo_delete = new sexo_delete();

// Run the page
$sexo_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sexo_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fsexodelete = currentForm = new ew.Form("fsexodelete", "delete");

// Form_CustomValidate event
fsexodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsexodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $sexo_delete->showPageHeader(); ?>
<?php
$sexo_delete->showMessage();
?>
<form name="fsexodelete" id="fsexodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($sexo_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $sexo_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sexo">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($sexo_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($sexo->SexoID->Visible) { // SexoID ?>
		<th class="<?php echo $sexo->SexoID->headerCellClass() ?>"><span id="elh_sexo_SexoID" class="sexo_SexoID"><?php echo $sexo->SexoID->caption() ?></span></th>
<?php } ?>
<?php if ($sexo->Sexo->Visible) { // Sexo ?>
		<th class="<?php echo $sexo->Sexo->headerCellClass() ?>"><span id="elh_sexo_Sexo" class="sexo_Sexo"><?php echo $sexo->Sexo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$sexo_delete->RecCnt = 0;
$i = 0;
while (!$sexo_delete->Recordset->EOF) {
	$sexo_delete->RecCnt++;
	$sexo_delete->RowCnt++;

	// Set row properties
	$sexo->resetAttributes();
	$sexo->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$sexo_delete->loadRowValues($sexo_delete->Recordset);

	// Render row
	$sexo_delete->renderRow();
?>
	<tr<?php echo $sexo->rowAttributes() ?>>
<?php if ($sexo->SexoID->Visible) { // SexoID ?>
		<td<?php echo $sexo->SexoID->cellAttributes() ?>>
<span id="el<?php echo $sexo_delete->RowCnt ?>_sexo_SexoID" class="sexo_SexoID">
<span<?php echo $sexo->SexoID->viewAttributes() ?>>
<?php echo $sexo->SexoID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sexo->Sexo->Visible) { // Sexo ?>
		<td<?php echo $sexo->Sexo->cellAttributes() ?>>
<span id="el<?php echo $sexo_delete->RowCnt ?>_sexo_Sexo" class="sexo_Sexo">
<span<?php echo $sexo->Sexo->viewAttributes() ?>>
<?php echo $sexo->Sexo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$sexo_delete->Recordset->moveNext();
}
$sexo_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sexo_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$sexo_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$sexo_delete->terminate();
?>