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
$paises_view = new paises_view();

// Run the page
$paises_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$paises_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$paises->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fpaisesview = currentForm = new ew.Form("fpaisesview", "view");

// Form_CustomValidate event
fpaisesview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpaisesview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$paises->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $paises_view->ExportOptions->render("body") ?>
<?php $paises_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $paises_view->showPageHeader(); ?>
<?php
$paises_view->showMessage();
?>
<?php if (!$paises_view->IsModal) { ?>
<?php if (!$paises->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($paises_view->Pager)) $paises_view->Pager = new PrevNextPager($paises_view->StartRec, $paises_view->DisplayRecs, $paises_view->TotalRecs, $paises_view->AutoHidePager) ?>
<?php if ($paises_view->Pager->RecordCount > 0 && $paises_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($paises_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $paises_view->pageUrl() ?>start=<?php echo $paises_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($paises_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $paises_view->pageUrl() ?>start=<?php echo $paises_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $paises_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($paises_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $paises_view->pageUrl() ?>start=<?php echo $paises_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($paises_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $paises_view->pageUrl() ?>start=<?php echo $paises_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $paises_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fpaisesview" id="fpaisesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($paises_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $paises_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="paises">
<input type="hidden" name="modal" value="<?php echo (int)$paises_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($paises->Codigo->Visible) { // Codigo ?>
	<tr id="r_Codigo">
		<td class="<?php echo $paises_view->TableLeftColumnClass ?>"><span id="elh_paises_Codigo"><?php echo $paises->Codigo->caption() ?></span></td>
		<td data-name="Codigo"<?php echo $paises->Codigo->cellAttributes() ?>>
<span id="el_paises_Codigo">
<span<?php echo $paises->Codigo->viewAttributes() ?>>
<?php echo $paises->Codigo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($paises->Pais->Visible) { // Pais ?>
	<tr id="r_Pais">
		<td class="<?php echo $paises_view->TableLeftColumnClass ?>"><span id="elh_paises_Pais"><?php echo $paises->Pais->caption() ?></span></td>
		<td data-name="Pais"<?php echo $paises->Pais->cellAttributes() ?>>
<span id="el_paises_Pais">
<span<?php echo $paises->Pais->viewAttributes() ?>>
<?php echo $paises->Pais->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$paises_view->IsModal) { ?>
<?php if (!$paises->isExport()) { ?>
<?php if (!isset($paises_view->Pager)) $paises_view->Pager = new PrevNextPager($paises_view->StartRec, $paises_view->DisplayRecs, $paises_view->TotalRecs, $paises_view->AutoHidePager) ?>
<?php if ($paises_view->Pager->RecordCount > 0 && $paises_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($paises_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $paises_view->pageUrl() ?>start=<?php echo $paises_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($paises_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $paises_view->pageUrl() ?>start=<?php echo $paises_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $paises_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($paises_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $paises_view->pageUrl() ?>start=<?php echo $paises_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($paises_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $paises_view->pageUrl() ?>start=<?php echo $paises_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $paises_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$paises_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$paises->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$paises_view->terminate();
?>