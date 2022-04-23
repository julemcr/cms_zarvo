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
$slidercm_view = new slidercm_view();

// Run the page
$slidercm_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$slidercm_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$slidercm->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fslidercmview = currentForm = new ew.Form("fslidercmview", "view");

// Form_CustomValidate event
fslidercmview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fslidercmview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Multi-Page
fslidercmview.multiPage = new ew.MultiPage("fslidercmview");

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$slidercm->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $slidercm_view->ExportOptions->render("body") ?>
<?php $slidercm_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $slidercm_view->showPageHeader(); ?>
<?php
$slidercm_view->showMessage();
?>
<?php if (!$slidercm_view->IsModal) { ?>
<?php if (!$slidercm->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($slidercm_view->Pager)) $slidercm_view->Pager = new PrevNextPager($slidercm_view->StartRec, $slidercm_view->DisplayRecs, $slidercm_view->TotalRecs, $slidercm_view->AutoHidePager) ?>
<?php if ($slidercm_view->Pager->RecordCount > 0 && $slidercm_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($slidercm_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $slidercm_view->pageUrl() ?>start=<?php echo $slidercm_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($slidercm_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $slidercm_view->pageUrl() ?>start=<?php echo $slidercm_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $slidercm_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($slidercm_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $slidercm_view->pageUrl() ?>start=<?php echo $slidercm_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($slidercm_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $slidercm_view->pageUrl() ?>start=<?php echo $slidercm_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $slidercm_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fslidercmview" id="fslidercmview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($slidercm_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $slidercm_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="slidercm">
<input type="hidden" name="modal" value="<?php echo (int)$slidercm_view->IsModal ?>">
<?php if ($slidercm_view->MultiPages->Items[0]->Visible) { ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($slidercm->SlidercmID->Visible) { // SlidercmID ?>
	<tr id="r_SlidercmID">
		<td class="<?php echo $slidercm_view->TableLeftColumnClass ?>"><span id="elh_slidercm_SlidercmID"><?php echo $slidercm->SlidercmID->caption() ?></span></td>
		<td data-name="SlidercmID"<?php echo $slidercm->SlidercmID->cellAttributes() ?>>
<span id="el_slidercm_SlidercmID" data-page="0">
<span<?php echo $slidercm->SlidercmID->viewAttributes() ?>>
<?php echo $slidercm->SlidercmID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($slidercm->Estado->Visible) { // Estado ?>
	<tr id="r_Estado">
		<td class="<?php echo $slidercm_view->TableLeftColumnClass ?>"><span id="elh_slidercm_Estado"><?php echo $slidercm->Estado->caption() ?></span></td>
		<td data-name="Estado"<?php echo $slidercm->Estado->cellAttributes() ?>>
<span id="el_slidercm_Estado" data-page="0">
<span<?php echo $slidercm->Estado->viewAttributes() ?>>
<?php echo $slidercm->Estado->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php } ?>
<?php if (!$slidercm->isExport()) { ?>
<div class="ew-multi-page">
<div class="ew-nav-tabs" id="slidercm_view"><!-- multi-page tabs -->
	<ul class="<?php echo $slidercm_view->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $slidercm_view->MultiPages->pageStyle("1") ?>" href="#tab_slidercm1" data-toggle="tab"><?php echo $slidercm->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $slidercm_view->MultiPages->pageStyle("2") ?>" href="#tab_slidercm2" data-toggle="tab"><?php echo $slidercm->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if (!$slidercm->isExport()) { ?>
		<div class="tab-pane<?php echo $slidercm_view->MultiPages->pageStyle("1") ?>" id="tab_slidercm1"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($slidercm->Titulo->Visible) { // Titulo ?>
	<tr id="r_Titulo">
		<td class="<?php echo $slidercm_view->TableLeftColumnClass ?>"><span id="elh_slidercm_Titulo"><?php echo $slidercm->Titulo->caption() ?></span></td>
		<td data-name="Titulo"<?php echo $slidercm->Titulo->cellAttributes() ?>>
<span id="el_slidercm_Titulo" data-page="1">
<span<?php echo $slidercm->Titulo->viewAttributes() ?>>
<?php echo $slidercm->Titulo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($slidercm->Detalle->Visible) { // Detalle ?>
	<tr id="r_Detalle">
		<td class="<?php echo $slidercm_view->TableLeftColumnClass ?>"><span id="elh_slidercm_Detalle"><?php echo $slidercm->Detalle->caption() ?></span></td>
		<td data-name="Detalle"<?php echo $slidercm->Detalle->cellAttributes() ?>>
<span id="el_slidercm_Detalle" data-page="1">
<span<?php echo $slidercm->Detalle->viewAttributes() ?>>
<?php echo $slidercm->Detalle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($slidercm->Orden->Visible) { // Orden ?>
	<tr id="r_Orden">
		<td class="<?php echo $slidercm_view->TableLeftColumnClass ?>"><span id="elh_slidercm_Orden"><?php echo $slidercm->Orden->caption() ?></span></td>
		<td data-name="Orden"<?php echo $slidercm->Orden->cellAttributes() ?>>
<span id="el_slidercm_Orden" data-page="1">
<span<?php echo $slidercm->Orden->viewAttributes() ?>>
<?php echo $slidercm->Orden->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$slidercm->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$slidercm->isExport()) { ?>
		<div class="tab-pane<?php echo $slidercm_view->MultiPages->pageStyle("2") ?>" id="tab_slidercm2"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($slidercm->Url_image->Visible) { // Url_image ?>
	<tr id="r_Url_image">
		<td class="<?php echo $slidercm_view->TableLeftColumnClass ?>"><span id="elh_slidercm_Url_image"><?php echo $slidercm->Url_image->caption() ?></span></td>
		<td data-name="Url_image"<?php echo $slidercm->Url_image->cellAttributes() ?>>
<span id="el_slidercm_Url_image" data-page="2">
<span>
<?php echo GetFileViewTag($slidercm->Url_image, $slidercm->Url_image->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$slidercm->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$slidercm->isExport()) { ?>
	</div>
</div>
</div>
<?php } ?>
<?php if (!$slidercm_view->IsModal) { ?>
<?php if (!$slidercm->isExport()) { ?>
<?php if (!isset($slidercm_view->Pager)) $slidercm_view->Pager = new PrevNextPager($slidercm_view->StartRec, $slidercm_view->DisplayRecs, $slidercm_view->TotalRecs, $slidercm_view->AutoHidePager) ?>
<?php if ($slidercm_view->Pager->RecordCount > 0 && $slidercm_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($slidercm_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $slidercm_view->pageUrl() ?>start=<?php echo $slidercm_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($slidercm_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $slidercm_view->pageUrl() ?>start=<?php echo $slidercm_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $slidercm_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($slidercm_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $slidercm_view->pageUrl() ?>start=<?php echo $slidercm_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($slidercm_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $slidercm_view->pageUrl() ?>start=<?php echo $slidercm_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $slidercm_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$slidercm_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$slidercm->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$slidercm_view->terminate();
?>