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
$ciudades_view = new ciudades_view();

// Run the page
$ciudades_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ciudades_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$ciudades->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fciudadesview = currentForm = new ew.Form("fciudadesview", "view");

// Form_CustomValidate event
fciudadesview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fciudadesview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$ciudades->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ciudades_view->ExportOptions->render("body") ?>
<?php $ciudades_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ciudades_view->showPageHeader(); ?>
<?php
$ciudades_view->showMessage();
?>
<?php if (!$ciudades_view->IsModal) { ?>
<?php if (!$ciudades->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($ciudades_view->Pager)) $ciudades_view->Pager = new PrevNextPager($ciudades_view->StartRec, $ciudades_view->DisplayRecs, $ciudades_view->TotalRecs, $ciudades_view->AutoHidePager) ?>
<?php if ($ciudades_view->Pager->RecordCount > 0 && $ciudades_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($ciudades_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $ciudades_view->pageUrl() ?>start=<?php echo $ciudades_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($ciudades_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $ciudades_view->pageUrl() ?>start=<?php echo $ciudades_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $ciudades_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($ciudades_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $ciudades_view->pageUrl() ?>start=<?php echo $ciudades_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($ciudades_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $ciudades_view->pageUrl() ?>start=<?php echo $ciudades_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $ciudades_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fciudadesview" id="fciudadesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ciudades_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ciudades_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ciudades">
<input type="hidden" name="modal" value="<?php echo (int)$ciudades_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ciudades->CiudadID->Visible) { // CiudadID ?>
	<tr id="r_CiudadID">
		<td class="<?php echo $ciudades_view->TableLeftColumnClass ?>"><span id="elh_ciudades_CiudadID"><?php echo $ciudades->CiudadID->caption() ?></span></td>
		<td data-name="CiudadID"<?php echo $ciudades->CiudadID->cellAttributes() ?>>
<span id="el_ciudades_CiudadID">
<span<?php echo $ciudades->CiudadID->viewAttributes() ?>>
<?php echo $ciudades->CiudadID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ciudades->Paises_Codigo->Visible) { // Paises_Codigo ?>
	<tr id="r_Paises_Codigo">
		<td class="<?php echo $ciudades_view->TableLeftColumnClass ?>"><span id="elh_ciudades_Paises_Codigo"><?php echo $ciudades->Paises_Codigo->caption() ?></span></td>
		<td data-name="Paises_Codigo"<?php echo $ciudades->Paises_Codigo->cellAttributes() ?>>
<span id="el_ciudades_Paises_Codigo">
<span<?php echo $ciudades->Paises_Codigo->viewAttributes() ?>>
<?php echo $ciudades->Paises_Codigo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ciudades->Ciudad->Visible) { // Ciudad ?>
	<tr id="r_Ciudad">
		<td class="<?php echo $ciudades_view->TableLeftColumnClass ?>"><span id="elh_ciudades_Ciudad"><?php echo $ciudades->Ciudad->caption() ?></span></td>
		<td data-name="Ciudad"<?php echo $ciudades->Ciudad->cellAttributes() ?>>
<span id="el_ciudades_Ciudad">
<span<?php echo $ciudades->Ciudad->viewAttributes() ?>>
<?php echo $ciudades->Ciudad->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ciudades_view->IsModal) { ?>
<?php if (!$ciudades->isExport()) { ?>
<?php if (!isset($ciudades_view->Pager)) $ciudades_view->Pager = new PrevNextPager($ciudades_view->StartRec, $ciudades_view->DisplayRecs, $ciudades_view->TotalRecs, $ciudades_view->AutoHidePager) ?>
<?php if ($ciudades_view->Pager->RecordCount > 0 && $ciudades_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($ciudades_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $ciudades_view->pageUrl() ?>start=<?php echo $ciudades_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($ciudades_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $ciudades_view->pageUrl() ?>start=<?php echo $ciudades_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $ciudades_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($ciudades_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $ciudades_view->pageUrl() ?>start=<?php echo $ciudades_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($ciudades_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $ciudades_view->pageUrl() ?>start=<?php echo $ciudades_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $ciudades_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$ciudades_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$ciudades->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$ciudades_view->terminate();
?>