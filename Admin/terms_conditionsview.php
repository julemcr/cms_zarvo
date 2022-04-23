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
$terms_conditions_view = new terms_conditions_view();

// Run the page
$terms_conditions_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terms_conditions_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$terms_conditions->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fterms_conditionsview = currentForm = new ew.Form("fterms_conditionsview", "view");

// Form_CustomValidate event
fterms_conditionsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fterms_conditionsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Multi-Page
fterms_conditionsview.multiPage = new ew.MultiPage("fterms_conditionsview");

// Dynamic selection lists
fterms_conditionsview.lists["x_status[]"] = <?php echo $terms_conditions_view->status->Lookup->toClientList() ?>;
fterms_conditionsview.lists["x_status[]"].options = <?php echo JsonEncode($terms_conditions_view->status->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$terms_conditions->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $terms_conditions_view->ExportOptions->render("body") ?>
<?php $terms_conditions_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $terms_conditions_view->showPageHeader(); ?>
<?php
$terms_conditions_view->showMessage();
?>
<?php if (!$terms_conditions_view->IsModal) { ?>
<?php if (!$terms_conditions->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($terms_conditions_view->Pager)) $terms_conditions_view->Pager = new PrevNextPager($terms_conditions_view->StartRec, $terms_conditions_view->DisplayRecs, $terms_conditions_view->TotalRecs, $terms_conditions_view->AutoHidePager) ?>
<?php if ($terms_conditions_view->Pager->RecordCount > 0 && $terms_conditions_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($terms_conditions_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $terms_conditions_view->pageUrl() ?>start=<?php echo $terms_conditions_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($terms_conditions_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $terms_conditions_view->pageUrl() ?>start=<?php echo $terms_conditions_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $terms_conditions_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($terms_conditions_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $terms_conditions_view->pageUrl() ?>start=<?php echo $terms_conditions_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($terms_conditions_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $terms_conditions_view->pageUrl() ?>start=<?php echo $terms_conditions_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $terms_conditions_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fterms_conditionsview" id="fterms_conditionsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($terms_conditions_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $terms_conditions_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terms_conditions">
<input type="hidden" name="modal" value="<?php echo (int)$terms_conditions_view->IsModal ?>">
<?php if ($terms_conditions_view->MultiPages->Items[0]->Visible) { ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($terms_conditions->TermsConditionsID->Visible) { // TermsConditionsID ?>
	<tr id="r_TermsConditionsID">
		<td class="<?php echo $terms_conditions_view->TableLeftColumnClass ?>"><span id="elh_terms_conditions_TermsConditionsID"><?php echo $terms_conditions->TermsConditionsID->caption() ?></span></td>
		<td data-name="TermsConditionsID"<?php echo $terms_conditions->TermsConditionsID->cellAttributes() ?>>
<span id="el_terms_conditions_TermsConditionsID" data-page="0">
<span<?php echo $terms_conditions->TermsConditionsID->viewAttributes() ?>>
<?php echo $terms_conditions->TermsConditionsID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terms_conditions->dateupdate->Visible) { // dateupdate ?>
	<tr id="r_dateupdate">
		<td class="<?php echo $terms_conditions_view->TableLeftColumnClass ?>"><span id="elh_terms_conditions_dateupdate"><?php echo $terms_conditions->dateupdate->caption() ?></span></td>
		<td data-name="dateupdate"<?php echo $terms_conditions->dateupdate->cellAttributes() ?>>
<span id="el_terms_conditions_dateupdate" data-page="0">
<span<?php echo $terms_conditions->dateupdate->viewAttributes() ?>>
<?php echo $terms_conditions->dateupdate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terms_conditions->_userid->Visible) { // userid ?>
	<tr id="r__userid">
		<td class="<?php echo $terms_conditions_view->TableLeftColumnClass ?>"><span id="elh_terms_conditions__userid"><?php echo $terms_conditions->_userid->caption() ?></span></td>
		<td data-name="_userid"<?php echo $terms_conditions->_userid->cellAttributes() ?>>
<span id="el_terms_conditions__userid" data-page="0">
<span<?php echo $terms_conditions->_userid->viewAttributes() ?>>
<?php echo $terms_conditions->_userid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terms_conditions->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $terms_conditions_view->TableLeftColumnClass ?>"><span id="elh_terms_conditions_status"><?php echo $terms_conditions->status->caption() ?></span></td>
		<td data-name="status"<?php echo $terms_conditions->status->cellAttributes() ?>>
<span id="el_terms_conditions_status" data-page="0">
<span<?php echo $terms_conditions->status->viewAttributes() ?>>
<?php if (ConvertToBool($terms_conditions->status->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $terms_conditions->status->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $terms_conditions->status->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php } ?>
<?php if (!$terms_conditions->isExport()) { ?>
<div class="ew-multi-page">
<div class="ew-nav-tabs" id="terms_conditions_view"><!-- multi-page tabs -->
	<ul class="<?php echo $terms_conditions_view->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $terms_conditions_view->MultiPages->pageStyle("1") ?>" href="#tab_terms_conditions1" data-toggle="tab"><?php echo $terms_conditions->pageCaption(1) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if (!$terms_conditions->isExport()) { ?>
		<div class="tab-pane<?php echo $terms_conditions_view->MultiPages->pageStyle("1") ?>" id="tab_terms_conditions1"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($terms_conditions->name->Visible) { // name ?>
	<tr id="r_name">
		<td class="<?php echo $terms_conditions_view->TableLeftColumnClass ?>"><span id="elh_terms_conditions_name"><?php echo $terms_conditions->name->caption() ?></span></td>
		<td data-name="name"<?php echo $terms_conditions->name->cellAttributes() ?>>
<span id="el_terms_conditions_name" data-page="1">
<span<?php echo $terms_conditions->name->viewAttributes() ?>>
<?php echo $terms_conditions->name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terms_conditions->description->Visible) { // description ?>
	<tr id="r_description">
		<td class="<?php echo $terms_conditions_view->TableLeftColumnClass ?>"><span id="elh_terms_conditions_description"><?php echo $terms_conditions->description->caption() ?></span></td>
		<td data-name="description"<?php echo $terms_conditions->description->cellAttributes() ?>>
<span id="el_terms_conditions_description" data-page="1">
<span<?php echo $terms_conditions->description->viewAttributes() ?>>
<?php echo $terms_conditions->description->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$terms_conditions->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$terms_conditions->isExport()) { ?>
	</div>
</div>
</div>
<?php } ?>
<?php if (!$terms_conditions_view->IsModal) { ?>
<?php if (!$terms_conditions->isExport()) { ?>
<?php if (!isset($terms_conditions_view->Pager)) $terms_conditions_view->Pager = new PrevNextPager($terms_conditions_view->StartRec, $terms_conditions_view->DisplayRecs, $terms_conditions_view->TotalRecs, $terms_conditions_view->AutoHidePager) ?>
<?php if ($terms_conditions_view->Pager->RecordCount > 0 && $terms_conditions_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($terms_conditions_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $terms_conditions_view->pageUrl() ?>start=<?php echo $terms_conditions_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($terms_conditions_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $terms_conditions_view->pageUrl() ?>start=<?php echo $terms_conditions_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $terms_conditions_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($terms_conditions_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $terms_conditions_view->pageUrl() ?>start=<?php echo $terms_conditions_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($terms_conditions_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $terms_conditions_view->pageUrl() ?>start=<?php echo $terms_conditions_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $terms_conditions_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$terms_conditions_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$terms_conditions->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$terms_conditions_view->terminate();
?>