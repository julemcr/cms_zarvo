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
$ciudades_delete = new ciudades_delete();

// Run the page
$ciudades_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ciudades_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fciudadesdelete = currentForm = new ew.Form("fciudadesdelete", "delete");

// Form_CustomValidate event
fciudadesdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fciudadesdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $ciudades_delete->showPageHeader(); ?>
<?php
$ciudades_delete->showMessage();
?>
<form name="fciudadesdelete" id="fciudadesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ciudades_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ciudades_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ciudades">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ciudades_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ciudades->CiudadID->Visible) { // CiudadID ?>
		<th class="<?php echo $ciudades->CiudadID->headerCellClass() ?>"><span id="elh_ciudades_CiudadID" class="ciudades_CiudadID"><?php echo $ciudades->CiudadID->caption() ?></span></th>
<?php } ?>
<?php if ($ciudades->Paises_Codigo->Visible) { // Paises_Codigo ?>
		<th class="<?php echo $ciudades->Paises_Codigo->headerCellClass() ?>"><span id="elh_ciudades_Paises_Codigo" class="ciudades_Paises_Codigo"><?php echo $ciudades->Paises_Codigo->caption() ?></span></th>
<?php } ?>
<?php if ($ciudades->Ciudad->Visible) { // Ciudad ?>
		<th class="<?php echo $ciudades->Ciudad->headerCellClass() ?>"><span id="elh_ciudades_Ciudad" class="ciudades_Ciudad"><?php echo $ciudades->Ciudad->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ciudades_delete->RecCnt = 0;
$i = 0;
while (!$ciudades_delete->Recordset->EOF) {
	$ciudades_delete->RecCnt++;
	$ciudades_delete->RowCnt++;

	// Set row properties
	$ciudades->resetAttributes();
	$ciudades->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ciudades_delete->loadRowValues($ciudades_delete->Recordset);

	// Render row
	$ciudades_delete->renderRow();
?>
	<tr<?php echo $ciudades->rowAttributes() ?>>
<?php if ($ciudades->CiudadID->Visible) { // CiudadID ?>
		<td<?php echo $ciudades->CiudadID->cellAttributes() ?>>
<span id="el<?php echo $ciudades_delete->RowCnt ?>_ciudades_CiudadID" class="ciudades_CiudadID">
<span<?php echo $ciudades->CiudadID->viewAttributes() ?>>
<?php echo $ciudades->CiudadID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ciudades->Paises_Codigo->Visible) { // Paises_Codigo ?>
		<td<?php echo $ciudades->Paises_Codigo->cellAttributes() ?>>
<span id="el<?php echo $ciudades_delete->RowCnt ?>_ciudades_Paises_Codigo" class="ciudades_Paises_Codigo">
<span<?php echo $ciudades->Paises_Codigo->viewAttributes() ?>>
<?php echo $ciudades->Paises_Codigo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ciudades->Ciudad->Visible) { // Ciudad ?>
		<td<?php echo $ciudades->Ciudad->cellAttributes() ?>>
<span id="el<?php echo $ciudades_delete->RowCnt ?>_ciudades_Ciudad" class="ciudades_Ciudad">
<span<?php echo $ciudades->Ciudad->viewAttributes() ?>>
<?php echo $ciudades->Ciudad->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ciudades_delete->Recordset->moveNext();
}
$ciudades_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ciudades_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ciudades_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$ciudades_delete->terminate();
?>