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
$portafolio_categoria_delete = new portafolio_categoria_delete();

// Run the page
$portafolio_categoria_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$portafolio_categoria_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fportafolio_categoriadelete = currentForm = new ew.Form("fportafolio_categoriadelete", "delete");

// Form_CustomValidate event
fportafolio_categoriadelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fportafolio_categoriadelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $portafolio_categoria_delete->showPageHeader(); ?>
<?php
$portafolio_categoria_delete->showMessage();
?>
<form name="fportafolio_categoriadelete" id="fportafolio_categoriadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($portafolio_categoria_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $portafolio_categoria_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="portafolio_categoria">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($portafolio_categoria_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($portafolio_categoria->PortafolioCategoriaID->Visible) { // PortafolioCategoriaID ?>
		<th class="<?php echo $portafolio_categoria->PortafolioCategoriaID->headerCellClass() ?>"><span id="elh_portafolio_categoria_PortafolioCategoriaID" class="portafolio_categoria_PortafolioCategoriaID"><?php echo $portafolio_categoria->PortafolioCategoriaID->caption() ?></span></th>
<?php } ?>
<?php if ($portafolio_categoria->Categoria->Visible) { // Categoria ?>
		<th class="<?php echo $portafolio_categoria->Categoria->headerCellClass() ?>"><span id="elh_portafolio_categoria_Categoria" class="portafolio_categoria_Categoria"><?php echo $portafolio_categoria->Categoria->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$portafolio_categoria_delete->RecCnt = 0;
$i = 0;
while (!$portafolio_categoria_delete->Recordset->EOF) {
	$portafolio_categoria_delete->RecCnt++;
	$portafolio_categoria_delete->RowCnt++;

	// Set row properties
	$portafolio_categoria->resetAttributes();
	$portafolio_categoria->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$portafolio_categoria_delete->loadRowValues($portafolio_categoria_delete->Recordset);

	// Render row
	$portafolio_categoria_delete->renderRow();
?>
	<tr<?php echo $portafolio_categoria->rowAttributes() ?>>
<?php if ($portafolio_categoria->PortafolioCategoriaID->Visible) { // PortafolioCategoriaID ?>
		<td<?php echo $portafolio_categoria->PortafolioCategoriaID->cellAttributes() ?>>
<span id="el<?php echo $portafolio_categoria_delete->RowCnt ?>_portafolio_categoria_PortafolioCategoriaID" class="portafolio_categoria_PortafolioCategoriaID">
<span<?php echo $portafolio_categoria->PortafolioCategoriaID->viewAttributes() ?>>
<?php echo $portafolio_categoria->PortafolioCategoriaID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($portafolio_categoria->Categoria->Visible) { // Categoria ?>
		<td<?php echo $portafolio_categoria->Categoria->cellAttributes() ?>>
<span id="el<?php echo $portafolio_categoria_delete->RowCnt ?>_portafolio_categoria_Categoria" class="portafolio_categoria_Categoria">
<span<?php echo $portafolio_categoria->Categoria->viewAttributes() ?>>
<?php echo $portafolio_categoria->Categoria->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$portafolio_categoria_delete->Recordset->moveNext();
}
$portafolio_categoria_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $portafolio_categoria_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$portafolio_categoria_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$portafolio_categoria_delete->terminate();
?>