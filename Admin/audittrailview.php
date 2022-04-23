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
$audittrail_view = new audittrail_view();

// Run the page
$audittrail_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$audittrail_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$audittrail->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var faudittrailview = currentForm = new ew.Form("faudittrailview", "view");

// Form_CustomValidate event
faudittrailview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
faudittrailview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$audittrail->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $audittrail_view->ExportOptions->render("body") ?>
<?php $audittrail_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $audittrail_view->showPageHeader(); ?>
<?php
$audittrail_view->showMessage();
?>
<?php if (!$audittrail_view->IsModal) { ?>
<?php if (!$audittrail->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($audittrail_view->Pager)) $audittrail_view->Pager = new PrevNextPager($audittrail_view->StartRec, $audittrail_view->DisplayRecs, $audittrail_view->TotalRecs, $audittrail_view->AutoHidePager) ?>
<?php if ($audittrail_view->Pager->RecordCount > 0 && $audittrail_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($audittrail_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $audittrail_view->pageUrl() ?>start=<?php echo $audittrail_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($audittrail_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $audittrail_view->pageUrl() ?>start=<?php echo $audittrail_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $audittrail_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($audittrail_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $audittrail_view->pageUrl() ?>start=<?php echo $audittrail_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($audittrail_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $audittrail_view->pageUrl() ?>start=<?php echo $audittrail_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $audittrail_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="faudittrailview" id="faudittrailview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($audittrail_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $audittrail_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="audittrail">
<input type="hidden" name="modal" value="<?php echo (int)$audittrail_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($audittrail->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_id"><?php echo $audittrail->id->caption() ?></span></td>
		<td data-name="id"<?php echo $audittrail->id->cellAttributes() ?>>
<span id="el_audittrail_id">
<span<?php echo $audittrail->id->viewAttributes() ?>>
<?php echo $audittrail->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail->datetime->Visible) { // datetime ?>
	<tr id="r_datetime">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_datetime"><?php echo $audittrail->datetime->caption() ?></span></td>
		<td data-name="datetime"<?php echo $audittrail->datetime->cellAttributes() ?>>
<span id="el_audittrail_datetime">
<span<?php echo $audittrail->datetime->viewAttributes() ?>>
<?php echo $audittrail->datetime->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail->script->Visible) { // script ?>
	<tr id="r_script">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_script"><?php echo $audittrail->script->caption() ?></span></td>
		<td data-name="script"<?php echo $audittrail->script->cellAttributes() ?>>
<span id="el_audittrail_script">
<span<?php echo $audittrail->script->viewAttributes() ?>>
<?php echo $audittrail->script->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail->user->Visible) { // user ?>
	<tr id="r_user">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_user"><?php echo $audittrail->user->caption() ?></span></td>
		<td data-name="user"<?php echo $audittrail->user->cellAttributes() ?>>
<span id="el_audittrail_user">
<span<?php echo $audittrail->user->viewAttributes() ?>>
<?php echo $audittrail->user->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail->_action->Visible) { // action ?>
	<tr id="r__action">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail__action"><?php echo $audittrail->_action->caption() ?></span></td>
		<td data-name="_action"<?php echo $audittrail->_action->cellAttributes() ?>>
<span id="el_audittrail__action">
<span<?php echo $audittrail->_action->viewAttributes() ?>>
<?php echo $audittrail->_action->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail->_table->Visible) { // table ?>
	<tr id="r__table">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail__table"><?php echo $audittrail->_table->caption() ?></span></td>
		<td data-name="_table"<?php echo $audittrail->_table->cellAttributes() ?>>
<span id="el_audittrail__table">
<span<?php echo $audittrail->_table->viewAttributes() ?>>
<?php echo $audittrail->_table->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail->field->Visible) { // field ?>
	<tr id="r_field">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_field"><?php echo $audittrail->field->caption() ?></span></td>
		<td data-name="field"<?php echo $audittrail->field->cellAttributes() ?>>
<span id="el_audittrail_field">
<span<?php echo $audittrail->field->viewAttributes() ?>>
<?php echo $audittrail->field->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail->keyvalue->Visible) { // keyvalue ?>
	<tr id="r_keyvalue">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_keyvalue"><?php echo $audittrail->keyvalue->caption() ?></span></td>
		<td data-name="keyvalue"<?php echo $audittrail->keyvalue->cellAttributes() ?>>
<span id="el_audittrail_keyvalue">
<span<?php echo $audittrail->keyvalue->viewAttributes() ?>>
<?php echo $audittrail->keyvalue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail->oldvalue->Visible) { // oldvalue ?>
	<tr id="r_oldvalue">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_oldvalue"><?php echo $audittrail->oldvalue->caption() ?></span></td>
		<td data-name="oldvalue"<?php echo $audittrail->oldvalue->cellAttributes() ?>>
<span id="el_audittrail_oldvalue">
<span<?php echo $audittrail->oldvalue->viewAttributes() ?>>
<?php echo $audittrail->oldvalue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($audittrail->newvalue->Visible) { // newvalue ?>
	<tr id="r_newvalue">
		<td class="<?php echo $audittrail_view->TableLeftColumnClass ?>"><span id="elh_audittrail_newvalue"><?php echo $audittrail->newvalue->caption() ?></span></td>
		<td data-name="newvalue"<?php echo $audittrail->newvalue->cellAttributes() ?>>
<span id="el_audittrail_newvalue">
<span<?php echo $audittrail->newvalue->viewAttributes() ?>>
<?php echo $audittrail->newvalue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$audittrail_view->IsModal) { ?>
<?php if (!$audittrail->isExport()) { ?>
<?php if (!isset($audittrail_view->Pager)) $audittrail_view->Pager = new PrevNextPager($audittrail_view->StartRec, $audittrail_view->DisplayRecs, $audittrail_view->TotalRecs, $audittrail_view->AutoHidePager) ?>
<?php if ($audittrail_view->Pager->RecordCount > 0 && $audittrail_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($audittrail_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $audittrail_view->pageUrl() ?>start=<?php echo $audittrail_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($audittrail_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $audittrail_view->pageUrl() ?>start=<?php echo $audittrail_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $audittrail_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($audittrail_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $audittrail_view->pageUrl() ?>start=<?php echo $audittrail_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($audittrail_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $audittrail_view->pageUrl() ?>start=<?php echo $audittrail_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $audittrail_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$audittrail_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$audittrail->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$audittrail_view->terminate();
?>