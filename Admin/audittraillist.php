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
$audittrail_list = new audittrail_list();

// Run the page
$audittrail_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$audittrail_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$audittrail->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var faudittraillist = currentForm = new ew.Form("faudittraillist", "list");
faudittraillist.formKeyCountName = '<?php echo $audittrail_list->FormKeyCountName ?>';

// Form_CustomValidate event
faudittraillist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
faudittraillist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var faudittraillistsrch = currentSearchForm = new ew.Form("faudittraillistsrch");

// Filters
faudittraillistsrch.filterList = <?php echo $audittrail_list->getFilterList() ?>;
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script src="phpjs/ewpreview.js"></script>
<script>
ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
ew.PREVIEW_SINGLE_ROW = false;
ew.PREVIEW_OVERLAY = false;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$audittrail->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($audittrail_list->TotalRecs > 0 && $audittrail_list->ExportOptions->visible()) { ?>
<?php $audittrail_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($audittrail_list->ImportOptions->visible()) { ?>
<?php $audittrail_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($audittrail_list->SearchOptions->visible()) { ?>
<?php $audittrail_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($audittrail_list->FilterOptions->visible()) { ?>
<?php $audittrail_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$audittrail_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$audittrail->isExport() && !$audittrail->CurrentAction) { ?>
<form name="faudittraillistsrch" id="faudittraillistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($audittrail_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="faudittraillistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="audittrail">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($audittrail_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($audittrail_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $audittrail_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($audittrail_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($audittrail_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($audittrail_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($audittrail_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $audittrail_list->showPageHeader(); ?>
<?php
$audittrail_list->showMessage();
?>
<?php if ($audittrail_list->TotalRecs > 0 || $audittrail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($audittrail_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> audittrail">
<?php if (!$audittrail->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$audittrail->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($audittrail_list->Pager)) $audittrail_list->Pager = new PrevNextPager($audittrail_list->StartRec, $audittrail_list->DisplayRecs, $audittrail_list->TotalRecs, $audittrail_list->AutoHidePager) ?>
<?php if ($audittrail_list->Pager->RecordCount > 0 && $audittrail_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($audittrail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $audittrail_list->pageUrl() ?>start=<?php echo $audittrail_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($audittrail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $audittrail_list->pageUrl() ?>start=<?php echo $audittrail_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $audittrail_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($audittrail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $audittrail_list->pageUrl() ?>start=<?php echo $audittrail_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($audittrail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $audittrail_list->pageUrl() ?>start=<?php echo $audittrail_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $audittrail_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($audittrail_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $audittrail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $audittrail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $audittrail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($audittrail_list->TotalRecs > 0 && (!$audittrail_list->AutoHidePageSizeSelector || $audittrail_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="audittrail">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($audittrail_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($audittrail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($audittrail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($audittrail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $audittrail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="faudittraillist" id="faudittraillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($audittrail_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $audittrail_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="audittrail">
<div id="gmp_audittrail" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($audittrail_list->TotalRecs > 0 || $audittrail->isGridEdit()) { ?>
<table id="tbl_audittraillist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$audittrail_list->RowType = ROWTYPE_HEADER;

// Render list options
$audittrail_list->renderListOptions();

// Render list options (header, left)
$audittrail_list->ListOptions->render("header", "left");
?>
<?php if ($audittrail->id->Visible) { // id ?>
	<?php if ($audittrail->sortUrl($audittrail->id) == "") { ?>
		<th data-name="id" class="<?php echo $audittrail->id->headerCellClass() ?>"><div id="elh_audittrail_id" class="audittrail_id"><div class="ew-table-header-caption"><?php echo $audittrail->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $audittrail->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $audittrail->SortUrl($audittrail->id) ?>',1);"><div id="elh_audittrail_id" class="audittrail_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrail->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($audittrail->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($audittrail->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrail->datetime->Visible) { // datetime ?>
	<?php if ($audittrail->sortUrl($audittrail->datetime) == "") { ?>
		<th data-name="datetime" class="<?php echo $audittrail->datetime->headerCellClass() ?>"><div id="elh_audittrail_datetime" class="audittrail_datetime"><div class="ew-table-header-caption"><?php echo $audittrail->datetime->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="datetime" class="<?php echo $audittrail->datetime->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $audittrail->SortUrl($audittrail->datetime) ?>',1);"><div id="elh_audittrail_datetime" class="audittrail_datetime">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrail->datetime->caption() ?></span><span class="ew-table-header-sort"><?php if ($audittrail->datetime->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($audittrail->datetime->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrail->script->Visible) { // script ?>
	<?php if ($audittrail->sortUrl($audittrail->script) == "") { ?>
		<th data-name="script" class="<?php echo $audittrail->script->headerCellClass() ?>"><div id="elh_audittrail_script" class="audittrail_script"><div class="ew-table-header-caption"><?php echo $audittrail->script->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="script" class="<?php echo $audittrail->script->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $audittrail->SortUrl($audittrail->script) ?>',1);"><div id="elh_audittrail_script" class="audittrail_script">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrail->script->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrail->script->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($audittrail->script->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrail->user->Visible) { // user ?>
	<?php if ($audittrail->sortUrl($audittrail->user) == "") { ?>
		<th data-name="user" class="<?php echo $audittrail->user->headerCellClass() ?>"><div id="elh_audittrail_user" class="audittrail_user"><div class="ew-table-header-caption"><?php echo $audittrail->user->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user" class="<?php echo $audittrail->user->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $audittrail->SortUrl($audittrail->user) ?>',1);"><div id="elh_audittrail_user" class="audittrail_user">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrail->user->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrail->user->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($audittrail->user->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrail->_action->Visible) { // action ?>
	<?php if ($audittrail->sortUrl($audittrail->_action) == "") { ?>
		<th data-name="_action" class="<?php echo $audittrail->_action->headerCellClass() ?>"><div id="elh_audittrail__action" class="audittrail__action"><div class="ew-table-header-caption"><?php echo $audittrail->_action->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_action" class="<?php echo $audittrail->_action->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $audittrail->SortUrl($audittrail->_action) ?>',1);"><div id="elh_audittrail__action" class="audittrail__action">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrail->_action->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrail->_action->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($audittrail->_action->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrail->_table->Visible) { // table ?>
	<?php if ($audittrail->sortUrl($audittrail->_table) == "") { ?>
		<th data-name="_table" class="<?php echo $audittrail->_table->headerCellClass() ?>"><div id="elh_audittrail__table" class="audittrail__table"><div class="ew-table-header-caption"><?php echo $audittrail->_table->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_table" class="<?php echo $audittrail->_table->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $audittrail->SortUrl($audittrail->_table) ?>',1);"><div id="elh_audittrail__table" class="audittrail__table">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrail->_table->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrail->_table->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($audittrail->_table->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($audittrail->field->Visible) { // field ?>
	<?php if ($audittrail->sortUrl($audittrail->field) == "") { ?>
		<th data-name="field" class="<?php echo $audittrail->field->headerCellClass() ?>"><div id="elh_audittrail_field" class="audittrail_field"><div class="ew-table-header-caption"><?php echo $audittrail->field->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="field" class="<?php echo $audittrail->field->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $audittrail->SortUrl($audittrail->field) ?>',1);"><div id="elh_audittrail_field" class="audittrail_field">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $audittrail->field->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($audittrail->field->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($audittrail->field->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$audittrail_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($audittrail->ExportAll && $audittrail->isExport()) {
	$audittrail_list->StopRec = $audittrail_list->TotalRecs;
} else {

	// Set the last record to display
	if ($audittrail_list->TotalRecs > $audittrail_list->StartRec + $audittrail_list->DisplayRecs - 1)
		$audittrail_list->StopRec = $audittrail_list->StartRec + $audittrail_list->DisplayRecs - 1;
	else
		$audittrail_list->StopRec = $audittrail_list->TotalRecs;
}
$audittrail_list->RecCnt = $audittrail_list->StartRec - 1;
if ($audittrail_list->Recordset && !$audittrail_list->Recordset->EOF) {
	$audittrail_list->Recordset->moveFirst();
	$selectLimit = $audittrail_list->UseSelectLimit;
	if (!$selectLimit && $audittrail_list->StartRec > 1)
		$audittrail_list->Recordset->move($audittrail_list->StartRec - 1);
} elseif (!$audittrail->AllowAddDeleteRow && $audittrail_list->StopRec == 0) {
	$audittrail_list->StopRec = $audittrail->GridAddRowCount;
}

// Initialize aggregate
$audittrail->RowType = ROWTYPE_AGGREGATEINIT;
$audittrail->resetAttributes();
$audittrail_list->renderRow();
while ($audittrail_list->RecCnt < $audittrail_list->StopRec) {
	$audittrail_list->RecCnt++;
	if ($audittrail_list->RecCnt >= $audittrail_list->StartRec) {
		$audittrail_list->RowCnt++;

		// Set up key count
		$audittrail_list->KeyCount = $audittrail_list->RowIndex;

		// Init row class and style
		$audittrail->resetAttributes();
		$audittrail->CssClass = "";
		if ($audittrail->isGridAdd()) {
		} else {
			$audittrail_list->loadRowValues($audittrail_list->Recordset); // Load row values
		}
		$audittrail->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$audittrail->RowAttrs = array_merge($audittrail->RowAttrs, array('data-rowindex'=>$audittrail_list->RowCnt, 'id'=>'r' . $audittrail_list->RowCnt . '_audittrail', 'data-rowtype'=>$audittrail->RowType));

		// Render row
		$audittrail_list->renderRow();

		// Render list options
		$audittrail_list->renderListOptions();
?>
	<tr<?php echo $audittrail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$audittrail_list->ListOptions->render("body", "left", $audittrail_list->RowCnt);
?>
	<?php if ($audittrail->id->Visible) { // id ?>
		<td data-name="id"<?php echo $audittrail->id->cellAttributes() ?>>
<span id="el<?php echo $audittrail_list->RowCnt ?>_audittrail_id" class="audittrail_id">
<span<?php echo $audittrail->id->viewAttributes() ?>>
<?php echo $audittrail->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrail->datetime->Visible) { // datetime ?>
		<td data-name="datetime"<?php echo $audittrail->datetime->cellAttributes() ?>>
<span id="el<?php echo $audittrail_list->RowCnt ?>_audittrail_datetime" class="audittrail_datetime">
<span<?php echo $audittrail->datetime->viewAttributes() ?>>
<?php echo $audittrail->datetime->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrail->script->Visible) { // script ?>
		<td data-name="script"<?php echo $audittrail->script->cellAttributes() ?>>
<span id="el<?php echo $audittrail_list->RowCnt ?>_audittrail_script" class="audittrail_script">
<span<?php echo $audittrail->script->viewAttributes() ?>>
<?php echo $audittrail->script->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrail->user->Visible) { // user ?>
		<td data-name="user"<?php echo $audittrail->user->cellAttributes() ?>>
<span id="el<?php echo $audittrail_list->RowCnt ?>_audittrail_user" class="audittrail_user">
<span<?php echo $audittrail->user->viewAttributes() ?>>
<?php echo $audittrail->user->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrail->_action->Visible) { // action ?>
		<td data-name="_action"<?php echo $audittrail->_action->cellAttributes() ?>>
<span id="el<?php echo $audittrail_list->RowCnt ?>_audittrail__action" class="audittrail__action">
<span<?php echo $audittrail->_action->viewAttributes() ?>>
<?php echo $audittrail->_action->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrail->_table->Visible) { // table ?>
		<td data-name="_table"<?php echo $audittrail->_table->cellAttributes() ?>>
<span id="el<?php echo $audittrail_list->RowCnt ?>_audittrail__table" class="audittrail__table">
<span<?php echo $audittrail->_table->viewAttributes() ?>>
<?php echo $audittrail->_table->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($audittrail->field->Visible) { // field ?>
		<td data-name="field"<?php echo $audittrail->field->cellAttributes() ?>>
<span id="el<?php echo $audittrail_list->RowCnt ?>_audittrail_field" class="audittrail_field">
<span<?php echo $audittrail->field->viewAttributes() ?>>
<?php echo $audittrail->field->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$audittrail_list->ListOptions->render("body", "right", $audittrail_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$audittrail->isGridAdd())
		$audittrail_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$audittrail->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($audittrail_list->Recordset)
	$audittrail_list->Recordset->Close();
?>
<?php if (!$audittrail->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$audittrail->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($audittrail_list->Pager)) $audittrail_list->Pager = new PrevNextPager($audittrail_list->StartRec, $audittrail_list->DisplayRecs, $audittrail_list->TotalRecs, $audittrail_list->AutoHidePager) ?>
<?php if ($audittrail_list->Pager->RecordCount > 0 && $audittrail_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($audittrail_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $audittrail_list->pageUrl() ?>start=<?php echo $audittrail_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($audittrail_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $audittrail_list->pageUrl() ?>start=<?php echo $audittrail_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $audittrail_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($audittrail_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $audittrail_list->pageUrl() ?>start=<?php echo $audittrail_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($audittrail_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $audittrail_list->pageUrl() ?>start=<?php echo $audittrail_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $audittrail_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($audittrail_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $audittrail_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $audittrail_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $audittrail_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($audittrail_list->TotalRecs > 0 && (!$audittrail_list->AutoHidePageSizeSelector || $audittrail_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="audittrail">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($audittrail_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($audittrail_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($audittrail_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($audittrail->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $audittrail_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($audittrail_list->TotalRecs == 0 && !$audittrail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $audittrail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$audittrail_list->showPageFooter();
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
$audittrail_list->terminate();
?>