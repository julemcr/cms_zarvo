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
$page_service_delete = new page_service_delete();

// Run the page
$page_service_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$page_service_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fpage_servicedelete = currentForm = new ew.Form("fpage_servicedelete", "delete");

// Form_CustomValidate event
fpage_servicedelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpage_servicedelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpage_servicedelete.lists["x_Estado"] = <?php echo $page_service_delete->Estado->Lookup->toClientList() ?>;
fpage_servicedelete.lists["x_Estado"].options = <?php echo JsonEncode($page_service_delete->Estado->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $page_service_delete->showPageHeader(); ?>
<?php
$page_service_delete->showMessage();
?>
<form name="fpage_servicedelete" id="fpage_servicedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($page_service_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $page_service_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="page_service">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($page_service_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($page_service->PageServiceID->Visible) { // PageServiceID ?>
		<th class="<?php echo $page_service->PageServiceID->headerCellClass() ?>"><span id="elh_page_service_PageServiceID" class="page_service_PageServiceID"><?php echo $page_service->PageServiceID->caption() ?></span></th>
<?php } ?>
<?php if ($page_service->Titulo->Visible) { // Titulo ?>
		<th class="<?php echo $page_service->Titulo->headerCellClass() ?>"><span id="elh_page_service_Titulo" class="page_service_Titulo"><?php echo $page_service->Titulo->caption() ?></span></th>
<?php } ?>
<?php if ($page_service->Icono->Visible) { // Icono ?>
		<th class="<?php echo $page_service->Icono->headerCellClass() ?>"><span id="elh_page_service_Icono" class="page_service_Icono"><?php echo $page_service->Icono->caption() ?></span></th>
<?php } ?>
<?php if ($page_service->Imagen->Visible) { // Imagen ?>
		<th class="<?php echo $page_service->Imagen->headerCellClass() ?>"><span id="elh_page_service_Imagen" class="page_service_Imagen"><?php echo $page_service->Imagen->caption() ?></span></th>
<?php } ?>
<?php if ($page_service->Estado->Visible) { // Estado ?>
		<th class="<?php echo $page_service->Estado->headerCellClass() ?>"><span id="elh_page_service_Estado" class="page_service_Estado"><?php echo $page_service->Estado->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$page_service_delete->RecCnt = 0;
$i = 0;
while (!$page_service_delete->Recordset->EOF) {
	$page_service_delete->RecCnt++;
	$page_service_delete->RowCnt++;

	// Set row properties
	$page_service->resetAttributes();
	$page_service->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$page_service_delete->loadRowValues($page_service_delete->Recordset);

	// Render row
	$page_service_delete->renderRow();
?>
	<tr<?php echo $page_service->rowAttributes() ?>>
<?php if ($page_service->PageServiceID->Visible) { // PageServiceID ?>
		<td<?php echo $page_service->PageServiceID->cellAttributes() ?>>
<span id="el<?php echo $page_service_delete->RowCnt ?>_page_service_PageServiceID" class="page_service_PageServiceID">
<span<?php echo $page_service->PageServiceID->viewAttributes() ?>>
<?php echo $page_service->PageServiceID->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($page_service->Titulo->Visible) { // Titulo ?>
		<td<?php echo $page_service->Titulo->cellAttributes() ?>>
<span id="el<?php echo $page_service_delete->RowCnt ?>_page_service_Titulo" class="page_service_Titulo">
<span<?php echo $page_service->Titulo->viewAttributes() ?>>
<?php echo $page_service->Titulo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($page_service->Icono->Visible) { // Icono ?>
		<td<?php echo $page_service->Icono->cellAttributes() ?>>
<span id="el<?php echo $page_service_delete->RowCnt ?>_page_service_Icono" class="page_service_Icono">
<span>
<?php echo GetFileViewTag($page_service->Icono, $page_service->Icono->getViewValue()) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($page_service->Imagen->Visible) { // Imagen ?>
		<td<?php echo $page_service->Imagen->cellAttributes() ?>>
<span id="el<?php echo $page_service_delete->RowCnt ?>_page_service_Imagen" class="page_service_Imagen">
<span<?php echo $page_service->Imagen->viewAttributes() ?>>
<?php echo $page_service->Imagen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($page_service->Estado->Visible) { // Estado ?>
		<td<?php echo $page_service->Estado->cellAttributes() ?>>
<span id="el<?php echo $page_service_delete->RowCnt ?>_page_service_Estado" class="page_service_Estado">
<span<?php echo $page_service->Estado->viewAttributes() ?>>
<?php echo $page_service->Estado->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$page_service_delete->Recordset->moveNext();
}
$page_service_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $page_service_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$page_service_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$page_service_delete->terminate();
?>