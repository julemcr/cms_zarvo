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
$sexo_view = new sexo_view();

// Run the page
$sexo_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sexo_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$sexo->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fsexoview = currentForm = new ew.Form("fsexoview", "view");

// Form_CustomValidate event
fsexoview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsexoview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$sexo->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $sexo_view->ExportOptions->render("body") ?>
<?php $sexo_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $sexo_view->showPageHeader(); ?>
<?php
$sexo_view->showMessage();
?>
<?php if (!$sexo_view->IsModal) { ?>
<?php if (!$sexo->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($sexo_view->Pager)) $sexo_view->Pager = new PrevNextPager($sexo_view->StartRec, $sexo_view->DisplayRecs, $sexo_view->TotalRecs, $sexo_view->AutoHidePager) ?>
<?php if ($sexo_view->Pager->RecordCount > 0 && $sexo_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($sexo_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $sexo_view->pageUrl() ?>start=<?php echo $sexo_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($sexo_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $sexo_view->pageUrl() ?>start=<?php echo $sexo_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $sexo_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($sexo_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $sexo_view->pageUrl() ?>start=<?php echo $sexo_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($sexo_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $sexo_view->pageUrl() ?>start=<?php echo $sexo_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $sexo_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fsexoview" id="fsexoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($sexo_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $sexo_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sexo">
<input type="hidden" name="modal" value="<?php echo (int)$sexo_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($sexo->SexoID->Visible) { // SexoID ?>
	<tr id="r_SexoID">
		<td class="<?php echo $sexo_view->TableLeftColumnClass ?>"><span id="elh_sexo_SexoID"><?php echo $sexo->SexoID->caption() ?></span></td>
		<td data-name="SexoID"<?php echo $sexo->SexoID->cellAttributes() ?>>
<span id="el_sexo_SexoID">
<span<?php echo $sexo->SexoID->viewAttributes() ?>>
<?php echo $sexo->SexoID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sexo->Sexo->Visible) { // Sexo ?>
	<tr id="r_Sexo">
		<td class="<?php echo $sexo_view->TableLeftColumnClass ?>"><span id="elh_sexo_Sexo"><?php echo $sexo->Sexo->caption() ?></span></td>
		<td data-name="Sexo"<?php echo $sexo->Sexo->cellAttributes() ?>>
<span id="el_sexo_Sexo">
<span<?php echo $sexo->Sexo->viewAttributes() ?>>
<?php echo $sexo->Sexo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$sexo_view->IsModal) { ?>
<?php if (!$sexo->isExport()) { ?>
<?php if (!isset($sexo_view->Pager)) $sexo_view->Pager = new PrevNextPager($sexo_view->StartRec, $sexo_view->DisplayRecs, $sexo_view->TotalRecs, $sexo_view->AutoHidePager) ?>
<?php if ($sexo_view->Pager->RecordCount > 0 && $sexo_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($sexo_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $sexo_view->pageUrl() ?>start=<?php echo $sexo_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($sexo_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $sexo_view->pageUrl() ?>start=<?php echo $sexo_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $sexo_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($sexo_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $sexo_view->pageUrl() ?>start=<?php echo $sexo_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($sexo_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $sexo_view->pageUrl() ?>start=<?php echo $sexo_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $sexo_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$sexo_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$sexo->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$sexo_view->terminate();
?>