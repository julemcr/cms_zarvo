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
$paises_delete = new paises_delete();

// Run the page
$paises_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$paises_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fpaisesdelete = currentForm = new ew.Form("fpaisesdelete", "delete");

// Form_CustomValidate event
fpaisesdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpaisesdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $paises_delete->showPageHeader(); ?>
<?php
$paises_delete->showMessage();
?>
<form name="fpaisesdelete" id="fpaisesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($paises_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $paises_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="paises">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($paises_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($paises->Codigo->Visible) { // Codigo ?>
		<th class="<?php echo $paises->Codigo->headerCellClass() ?>"><span id="elh_paises_Codigo" class="paises_Codigo"><?php echo $paises->Codigo->caption() ?></span></th>
<?php } ?>
<?php if ($paises->Pais->Visible) { // Pais ?>
		<th class="<?php echo $paises->Pais->headerCellClass() ?>"><span id="elh_paises_Pais" class="paises_Pais"><?php echo $paises->Pais->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$paises_delete->RecCnt = 0;
$i = 0;
while (!$paises_delete->Recordset->EOF) {
	$paises_delete->RecCnt++;
	$paises_delete->RowCnt++;

	// Set row properties
	$paises->resetAttributes();
	$paises->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$paises_delete->loadRowValues($paises_delete->Recordset);

	// Render row
	$paises_delete->renderRow();
?>
	<tr<?php echo $paises->rowAttributes() ?>>
<?php if ($paises->Codigo->Visible) { // Codigo ?>
		<td<?php echo $paises->Codigo->cellAttributes() ?>>
<span id="el<?php echo $paises_delete->RowCnt ?>_paises_Codigo" class="paises_Codigo">
<span<?php echo $paises->Codigo->viewAttributes() ?>>
<?php echo $paises->Codigo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($paises->Pais->Visible) { // Pais ?>
		<td<?php echo $paises->Pais->cellAttributes() ?>>
<span id="el<?php echo $paises_delete->RowCnt ?>_paises_Pais" class="paises_Pais">
<span<?php echo $paises->Pais->viewAttributes() ?>>
<?php echo $paises->Pais->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$paises_delete->Recordset->moveNext();
}
$paises_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $paises_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$paises_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$paises_delete->terminate();
?>