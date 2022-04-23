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
$page_service_view = new page_service_view();

// Run the page
$page_service_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$page_service_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$page_service->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fpage_serviceview = currentForm = new ew.Form("fpage_serviceview", "view");

// Form_CustomValidate event
fpage_serviceview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpage_serviceview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Multi-Page
fpage_serviceview.multiPage = new ew.MultiPage("fpage_serviceview");

// Dynamic selection lists
fpage_serviceview.lists["x_Estado"] = <?php echo $page_service_view->Estado->Lookup->toClientList() ?>;
fpage_serviceview.lists["x_Estado"].options = <?php echo JsonEncode($page_service_view->Estado->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$page_service->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $page_service_view->ExportOptions->render("body") ?>
<?php $page_service_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $page_service_view->showPageHeader(); ?>
<?php
$page_service_view->showMessage();
?>
<?php if (!$page_service_view->IsModal) { ?>
<?php if (!$page_service->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($page_service_view->Pager)) $page_service_view->Pager = new PrevNextPager($page_service_view->StartRec, $page_service_view->DisplayRecs, $page_service_view->TotalRecs, $page_service_view->AutoHidePager) ?>
<?php if ($page_service_view->Pager->RecordCount > 0 && $page_service_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($page_service_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $page_service_view->pageUrl() ?>start=<?php echo $page_service_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($page_service_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $page_service_view->pageUrl() ?>start=<?php echo $page_service_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $page_service_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($page_service_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $page_service_view->pageUrl() ?>start=<?php echo $page_service_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($page_service_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $page_service_view->pageUrl() ?>start=<?php echo $page_service_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $page_service_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fpage_serviceview" id="fpage_serviceview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($page_service_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $page_service_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="page_service">
<input type="hidden" name="modal" value="<?php echo (int)$page_service_view->IsModal ?>">
<?php if ($page_service_view->MultiPages->Items[0]->Visible) { ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($page_service->PageServiceID->Visible) { // PageServiceID ?>
	<tr id="r_PageServiceID">
		<td class="<?php echo $page_service_view->TableLeftColumnClass ?>"><span id="elh_page_service_PageServiceID"><?php echo $page_service->PageServiceID->caption() ?></span></td>
		<td data-name="PageServiceID"<?php echo $page_service->PageServiceID->cellAttributes() ?>>
<span id="el_page_service_PageServiceID" data-page="0">
<span<?php echo $page_service->PageServiceID->viewAttributes() ?>>
<?php echo $page_service->PageServiceID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($page_service->Estado->Visible) { // Estado ?>
	<tr id="r_Estado">
		<td class="<?php echo $page_service_view->TableLeftColumnClass ?>"><span id="elh_page_service_Estado"><?php echo $page_service->Estado->caption() ?></span></td>
		<td data-name="Estado"<?php echo $page_service->Estado->cellAttributes() ?>>
<span id="el_page_service_Estado" data-page="0">
<span<?php echo $page_service->Estado->viewAttributes() ?>>
<?php echo $page_service->Estado->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php } ?>
<?php if (!$page_service->isExport()) { ?>
<div class="ew-multi-page">
<div class="ew-nav-tabs" id="page_service_view"><!-- multi-page tabs -->
	<ul class="<?php echo $page_service_view->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $page_service_view->MultiPages->pageStyle("1") ?>" href="#tab_page_service1" data-toggle="tab"><?php echo $page_service->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $page_service_view->MultiPages->pageStyle("2") ?>" href="#tab_page_service2" data-toggle="tab"><?php echo $page_service->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if (!$page_service->isExport()) { ?>
		<div class="tab-pane<?php echo $page_service_view->MultiPages->pageStyle("1") ?>" id="tab_page_service1"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($page_service->Titulo->Visible) { // Titulo ?>
	<tr id="r_Titulo">
		<td class="<?php echo $page_service_view->TableLeftColumnClass ?>"><span id="elh_page_service_Titulo"><?php echo $page_service->Titulo->caption() ?></span></td>
		<td data-name="Titulo"<?php echo $page_service->Titulo->cellAttributes() ?>>
<span id="el_page_service_Titulo" data-page="1">
<span<?php echo $page_service->Titulo->viewAttributes() ?>>
<?php echo $page_service->Titulo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($page_service->Descripcion->Visible) { // Descripcion ?>
	<tr id="r_Descripcion">
		<td class="<?php echo $page_service_view->TableLeftColumnClass ?>"><span id="elh_page_service_Descripcion"><?php echo $page_service->Descripcion->caption() ?></span></td>
		<td data-name="Descripcion"<?php echo $page_service->Descripcion->cellAttributes() ?>>
<span id="el_page_service_Descripcion" data-page="1">
<span<?php echo $page_service->Descripcion->viewAttributes() ?>>
<?php echo $page_service->Descripcion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($page_service->Icono->Visible) { // Icono ?>
	<tr id="r_Icono">
		<td class="<?php echo $page_service_view->TableLeftColumnClass ?>"><span id="elh_page_service_Icono"><?php echo $page_service->Icono->caption() ?></span></td>
		<td data-name="Icono"<?php echo $page_service->Icono->cellAttributes() ?>>
<span id="el_page_service_Icono" data-page="1">
<span>
<?php echo GetFileViewTag($page_service->Icono, $page_service->Icono->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$page_service->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$page_service->isExport()) { ?>
		<div class="tab-pane<?php echo $page_service_view->MultiPages->pageStyle("2") ?>" id="tab_page_service2"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($page_service->Imagen->Visible) { // Imagen ?>
	<tr id="r_Imagen">
		<td class="<?php echo $page_service_view->TableLeftColumnClass ?>"><span id="elh_page_service_Imagen"><?php echo $page_service->Imagen->caption() ?></span></td>
		<td data-name="Imagen"<?php echo $page_service->Imagen->cellAttributes() ?>>
<span id="el_page_service_Imagen" data-page="2">
<span<?php echo $page_service->Imagen->viewAttributes() ?>>
<?php echo $page_service->Imagen->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$page_service->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$page_service->isExport()) { ?>
	</div>
</div>
</div>
<?php } ?>
<?php if (!$page_service_view->IsModal) { ?>
<?php if (!$page_service->isExport()) { ?>
<?php if (!isset($page_service_view->Pager)) $page_service_view->Pager = new PrevNextPager($page_service_view->StartRec, $page_service_view->DisplayRecs, $page_service_view->TotalRecs, $page_service_view->AutoHidePager) ?>
<?php if ($page_service_view->Pager->RecordCount > 0 && $page_service_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($page_service_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $page_service_view->pageUrl() ?>start=<?php echo $page_service_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($page_service_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $page_service_view->pageUrl() ?>start=<?php echo $page_service_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $page_service_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($page_service_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $page_service_view->pageUrl() ?>start=<?php echo $page_service_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($page_service_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $page_service_view->pageUrl() ?>start=<?php echo $page_service_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $page_service_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$page_service_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$page_service->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$page_service_view->terminate();
?>