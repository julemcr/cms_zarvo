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
$portafolio_categoria_view = new portafolio_categoria_view();

// Run the page
$portafolio_categoria_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$portafolio_categoria_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$portafolio_categoria->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fportafolio_categoriaview = currentForm = new ew.Form("fportafolio_categoriaview", "view");

// Form_CustomValidate event
fportafolio_categoriaview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fportafolio_categoriaview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$portafolio_categoria->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $portafolio_categoria_view->ExportOptions->render("body") ?>
<?php $portafolio_categoria_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $portafolio_categoria_view->showPageHeader(); ?>
<?php
$portafolio_categoria_view->showMessage();
?>
<?php if (!$portafolio_categoria_view->IsModal) { ?>
<?php if (!$portafolio_categoria->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($portafolio_categoria_view->Pager)) $portafolio_categoria_view->Pager = new PrevNextPager($portafolio_categoria_view->StartRec, $portafolio_categoria_view->DisplayRecs, $portafolio_categoria_view->TotalRecs, $portafolio_categoria_view->AutoHidePager) ?>
<?php if ($portafolio_categoria_view->Pager->RecordCount > 0 && $portafolio_categoria_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($portafolio_categoria_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $portafolio_categoria_view->pageUrl() ?>start=<?php echo $portafolio_categoria_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($portafolio_categoria_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $portafolio_categoria_view->pageUrl() ?>start=<?php echo $portafolio_categoria_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $portafolio_categoria_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($portafolio_categoria_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $portafolio_categoria_view->pageUrl() ?>start=<?php echo $portafolio_categoria_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($portafolio_categoria_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $portafolio_categoria_view->pageUrl() ?>start=<?php echo $portafolio_categoria_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $portafolio_categoria_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fportafolio_categoriaview" id="fportafolio_categoriaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($portafolio_categoria_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $portafolio_categoria_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="portafolio_categoria">
<input type="hidden" name="modal" value="<?php echo (int)$portafolio_categoria_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($portafolio_categoria->PortafolioCategoriaID->Visible) { // PortafolioCategoriaID ?>
	<tr id="r_PortafolioCategoriaID">
		<td class="<?php echo $portafolio_categoria_view->TableLeftColumnClass ?>"><span id="elh_portafolio_categoria_PortafolioCategoriaID"><?php echo $portafolio_categoria->PortafolioCategoriaID->caption() ?></span></td>
		<td data-name="PortafolioCategoriaID"<?php echo $portafolio_categoria->PortafolioCategoriaID->cellAttributes() ?>>
<span id="el_portafolio_categoria_PortafolioCategoriaID">
<span<?php echo $portafolio_categoria->PortafolioCategoriaID->viewAttributes() ?>>
<?php echo $portafolio_categoria->PortafolioCategoriaID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($portafolio_categoria->Categoria->Visible) { // Categoria ?>
	<tr id="r_Categoria">
		<td class="<?php echo $portafolio_categoria_view->TableLeftColumnClass ?>"><span id="elh_portafolio_categoria_Categoria"><?php echo $portafolio_categoria->Categoria->caption() ?></span></td>
		<td data-name="Categoria"<?php echo $portafolio_categoria->Categoria->cellAttributes() ?>>
<span id="el_portafolio_categoria_Categoria">
<span<?php echo $portafolio_categoria->Categoria->viewAttributes() ?>>
<?php echo $portafolio_categoria->Categoria->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$portafolio_categoria_view->IsModal) { ?>
<?php if (!$portafolio_categoria->isExport()) { ?>
<?php if (!isset($portafolio_categoria_view->Pager)) $portafolio_categoria_view->Pager = new PrevNextPager($portafolio_categoria_view->StartRec, $portafolio_categoria_view->DisplayRecs, $portafolio_categoria_view->TotalRecs, $portafolio_categoria_view->AutoHidePager) ?>
<?php if ($portafolio_categoria_view->Pager->RecordCount > 0 && $portafolio_categoria_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($portafolio_categoria_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $portafolio_categoria_view->pageUrl() ?>start=<?php echo $portafolio_categoria_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($portafolio_categoria_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $portafolio_categoria_view->pageUrl() ?>start=<?php echo $portafolio_categoria_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $portafolio_categoria_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($portafolio_categoria_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $portafolio_categoria_view->pageUrl() ?>start=<?php echo $portafolio_categoria_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($portafolio_categoria_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $portafolio_categoria_view->pageUrl() ?>start=<?php echo $portafolio_categoria_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $portafolio_categoria_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$portafolio_categoria_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$portafolio_categoria->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$portafolio_categoria_view->terminate();
?>