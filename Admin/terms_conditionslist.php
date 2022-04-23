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
$terms_conditions_list = new terms_conditions_list();

// Run the page
$terms_conditions_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terms_conditions_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$terms_conditions->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fterms_conditionslist = currentForm = new ew.Form("fterms_conditionslist", "list");
fterms_conditionslist.formKeyCountName = '<?php echo $terms_conditions_list->FormKeyCountName ?>';

// Form_CustomValidate event
fterms_conditionslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fterms_conditionslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fterms_conditionslist.lists["x_status[]"] = <?php echo $terms_conditions_list->status->Lookup->toClientList() ?>;
fterms_conditionslist.lists["x_status[]"].options = <?php echo JsonEncode($terms_conditions_list->status->options(FALSE, TRUE)) ?>;

// Form object for search
var fterms_conditionslistsrch = currentSearchForm = new ew.Form("fterms_conditionslistsrch");

// Validate function for search
fterms_conditionslistsrch.validate = function(fobj) {
	if (!this.validateRequired)
		return true; // Ignore validation
	fobj = fobj || this._form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fterms_conditionslistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fterms_conditionslistsrch.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fterms_conditionslistsrch.lists["x_status[]"] = <?php echo $terms_conditions_list->status->Lookup->toClientList() ?>;
fterms_conditionslistsrch.lists["x_status[]"].options = <?php echo JsonEncode($terms_conditions_list->status->options(FALSE, TRUE)) ?>;

// Filters
fterms_conditionslistsrch.filterList = <?php echo $terms_conditions_list->getFilterList() ?>;
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
<?php if (!$terms_conditions->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($terms_conditions_list->TotalRecs > 0 && $terms_conditions_list->ExportOptions->visible()) { ?>
<?php $terms_conditions_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($terms_conditions_list->ImportOptions->visible()) { ?>
<?php $terms_conditions_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($terms_conditions_list->SearchOptions->visible()) { ?>
<?php $terms_conditions_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($terms_conditions_list->FilterOptions->visible()) { ?>
<?php $terms_conditions_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$terms_conditions_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$terms_conditions->isExport() && !$terms_conditions->CurrentAction) { ?>
<form name="fterms_conditionslistsrch" id="fterms_conditionslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($terms_conditions_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fterms_conditionslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="terms_conditions">
	<div class="ew-basic-search">
<?php
if ($SearchError == "")
	$terms_conditions_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$terms_conditions->RowType = ROWTYPE_SEARCH;

// Render row
$terms_conditions->resetAttributes();
$terms_conditions_list->renderRow();
?>
<div id="xsr_1" class="ew-row d-sm-flex">
<?php if ($terms_conditions->status->Visible) { // status ?>
	<div id="xsc_status" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $terms_conditions->status->caption() ?></label>
		<span class="ew-search-operator"><?php echo $Language->phrase("=") ?><input type="hidden" name="z_status" id="z_status" value="="></span>
		<span class="ew-search-field">
<?php
$selwrk = (ConvertToBool($terms_conditions->status->AdvancedSearch->SearchValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="terms_conditions" data-field="x_status" name="x_status[]" id="x_status[]" value="1"<?php echo $selwrk ?><?php echo $terms_conditions->status->editAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($terms_conditions_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($terms_conditions_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $terms_conditions_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($terms_conditions_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($terms_conditions_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($terms_conditions_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($terms_conditions_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $terms_conditions_list->showPageHeader(); ?>
<?php
$terms_conditions_list->showMessage();
?>
<?php if ($terms_conditions_list->TotalRecs > 0 || $terms_conditions->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($terms_conditions_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> terms_conditions">
<?php if (!$terms_conditions->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$terms_conditions->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($terms_conditions_list->Pager)) $terms_conditions_list->Pager = new PrevNextPager($terms_conditions_list->StartRec, $terms_conditions_list->DisplayRecs, $terms_conditions_list->TotalRecs, $terms_conditions_list->AutoHidePager) ?>
<?php if ($terms_conditions_list->Pager->RecordCount > 0 && $terms_conditions_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($terms_conditions_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $terms_conditions_list->pageUrl() ?>start=<?php echo $terms_conditions_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($terms_conditions_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $terms_conditions_list->pageUrl() ?>start=<?php echo $terms_conditions_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $terms_conditions_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($terms_conditions_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $terms_conditions_list->pageUrl() ?>start=<?php echo $terms_conditions_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($terms_conditions_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $terms_conditions_list->pageUrl() ?>start=<?php echo $terms_conditions_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $terms_conditions_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($terms_conditions_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $terms_conditions_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $terms_conditions_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $terms_conditions_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($terms_conditions_list->TotalRecs > 0 && (!$terms_conditions_list->AutoHidePageSizeSelector || $terms_conditions_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="terms_conditions">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($terms_conditions_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($terms_conditions_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($terms_conditions_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($terms_conditions->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $terms_conditions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fterms_conditionslist" id="fterms_conditionslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($terms_conditions_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $terms_conditions_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terms_conditions">
<div id="gmp_terms_conditions" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($terms_conditions_list->TotalRecs > 0 || $terms_conditions->isGridEdit()) { ?>
<table id="tbl_terms_conditionslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$terms_conditions_list->RowType = ROWTYPE_HEADER;

// Render list options
$terms_conditions_list->renderListOptions();

// Render list options (header, left)
$terms_conditions_list->ListOptions->render("header", "left");
?>
<?php if ($terms_conditions->TermsConditionsID->Visible) { // TermsConditionsID ?>
	<?php if ($terms_conditions->sortUrl($terms_conditions->TermsConditionsID) == "") { ?>
		<th data-name="TermsConditionsID" class="<?php echo $terms_conditions->TermsConditionsID->headerCellClass() ?>"><div id="elh_terms_conditions_TermsConditionsID" class="terms_conditions_TermsConditionsID"><div class="ew-table-header-caption"><?php echo $terms_conditions->TermsConditionsID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TermsConditionsID" class="<?php echo $terms_conditions->TermsConditionsID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $terms_conditions->SortUrl($terms_conditions->TermsConditionsID) ?>',1);"><div id="elh_terms_conditions_TermsConditionsID" class="terms_conditions_TermsConditionsID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terms_conditions->TermsConditionsID->caption() ?></span><span class="ew-table-header-sort"><?php if ($terms_conditions->TermsConditionsID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($terms_conditions->TermsConditionsID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terms_conditions->name->Visible) { // name ?>
	<?php if ($terms_conditions->sortUrl($terms_conditions->name) == "") { ?>
		<th data-name="name" class="<?php echo $terms_conditions->name->headerCellClass() ?>"><div id="elh_terms_conditions_name" class="terms_conditions_name"><div class="ew-table-header-caption"><?php echo $terms_conditions->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $terms_conditions->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $terms_conditions->SortUrl($terms_conditions->name) ?>',1);"><div id="elh_terms_conditions_name" class="terms_conditions_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terms_conditions->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($terms_conditions->name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($terms_conditions->name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terms_conditions->dateupdate->Visible) { // dateupdate ?>
	<?php if ($terms_conditions->sortUrl($terms_conditions->dateupdate) == "") { ?>
		<th data-name="dateupdate" class="<?php echo $terms_conditions->dateupdate->headerCellClass() ?>"><div id="elh_terms_conditions_dateupdate" class="terms_conditions_dateupdate"><div class="ew-table-header-caption"><?php echo $terms_conditions->dateupdate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dateupdate" class="<?php echo $terms_conditions->dateupdate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $terms_conditions->SortUrl($terms_conditions->dateupdate) ?>',1);"><div id="elh_terms_conditions_dateupdate" class="terms_conditions_dateupdate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terms_conditions->dateupdate->caption() ?></span><span class="ew-table-header-sort"><?php if ($terms_conditions->dateupdate->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($terms_conditions->dateupdate->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terms_conditions->_userid->Visible) { // userid ?>
	<?php if ($terms_conditions->sortUrl($terms_conditions->_userid) == "") { ?>
		<th data-name="_userid" class="<?php echo $terms_conditions->_userid->headerCellClass() ?>"><div id="elh_terms_conditions__userid" class="terms_conditions__userid"><div class="ew-table-header-caption"><?php echo $terms_conditions->_userid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_userid" class="<?php echo $terms_conditions->_userid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $terms_conditions->SortUrl($terms_conditions->_userid) ?>',1);"><div id="elh_terms_conditions__userid" class="terms_conditions__userid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terms_conditions->_userid->caption() ?></span><span class="ew-table-header-sort"><?php if ($terms_conditions->_userid->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($terms_conditions->_userid->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terms_conditions->status->Visible) { // status ?>
	<?php if ($terms_conditions->sortUrl($terms_conditions->status) == "") { ?>
		<th data-name="status" class="<?php echo $terms_conditions->status->headerCellClass() ?>"><div id="elh_terms_conditions_status" class="terms_conditions_status"><div class="ew-table-header-caption"><?php echo $terms_conditions->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $terms_conditions->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $terms_conditions->SortUrl($terms_conditions->status) ?>',1);"><div id="elh_terms_conditions_status" class="terms_conditions_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terms_conditions->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($terms_conditions->status->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($terms_conditions->status->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$terms_conditions_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($terms_conditions->ExportAll && $terms_conditions->isExport()) {
	$terms_conditions_list->StopRec = $terms_conditions_list->TotalRecs;
} else {

	// Set the last record to display
	if ($terms_conditions_list->TotalRecs > $terms_conditions_list->StartRec + $terms_conditions_list->DisplayRecs - 1)
		$terms_conditions_list->StopRec = $terms_conditions_list->StartRec + $terms_conditions_list->DisplayRecs - 1;
	else
		$terms_conditions_list->StopRec = $terms_conditions_list->TotalRecs;
}
$terms_conditions_list->RecCnt = $terms_conditions_list->StartRec - 1;
if ($terms_conditions_list->Recordset && !$terms_conditions_list->Recordset->EOF) {
	$terms_conditions_list->Recordset->moveFirst();
	$selectLimit = $terms_conditions_list->UseSelectLimit;
	if (!$selectLimit && $terms_conditions_list->StartRec > 1)
		$terms_conditions_list->Recordset->move($terms_conditions_list->StartRec - 1);
} elseif (!$terms_conditions->AllowAddDeleteRow && $terms_conditions_list->StopRec == 0) {
	$terms_conditions_list->StopRec = $terms_conditions->GridAddRowCount;
}

// Initialize aggregate
$terms_conditions->RowType = ROWTYPE_AGGREGATEINIT;
$terms_conditions->resetAttributes();
$terms_conditions_list->renderRow();
while ($terms_conditions_list->RecCnt < $terms_conditions_list->StopRec) {
	$terms_conditions_list->RecCnt++;
	if ($terms_conditions_list->RecCnt >= $terms_conditions_list->StartRec) {
		$terms_conditions_list->RowCnt++;

		// Set up key count
		$terms_conditions_list->KeyCount = $terms_conditions_list->RowIndex;

		// Init row class and style
		$terms_conditions->resetAttributes();
		$terms_conditions->CssClass = "";
		if ($terms_conditions->isGridAdd()) {
		} else {
			$terms_conditions_list->loadRowValues($terms_conditions_list->Recordset); // Load row values
		}
		$terms_conditions->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$terms_conditions->RowAttrs = array_merge($terms_conditions->RowAttrs, array('data-rowindex'=>$terms_conditions_list->RowCnt, 'id'=>'r' . $terms_conditions_list->RowCnt . '_terms_conditions', 'data-rowtype'=>$terms_conditions->RowType));

		// Render row
		$terms_conditions_list->renderRow();

		// Render list options
		$terms_conditions_list->renderListOptions();
?>
	<tr<?php echo $terms_conditions->rowAttributes() ?>>
<?php

// Render list options (body, left)
$terms_conditions_list->ListOptions->render("body", "left", $terms_conditions_list->RowCnt);
?>
	<?php if ($terms_conditions->TermsConditionsID->Visible) { // TermsConditionsID ?>
		<td data-name="TermsConditionsID"<?php echo $terms_conditions->TermsConditionsID->cellAttributes() ?>>
<span id="el<?php echo $terms_conditions_list->RowCnt ?>_terms_conditions_TermsConditionsID" class="terms_conditions_TermsConditionsID">
<span<?php echo $terms_conditions->TermsConditionsID->viewAttributes() ?>>
<?php echo $terms_conditions->TermsConditionsID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terms_conditions->name->Visible) { // name ?>
		<td data-name="name"<?php echo $terms_conditions->name->cellAttributes() ?>>
<span id="el<?php echo $terms_conditions_list->RowCnt ?>_terms_conditions_name" class="terms_conditions_name">
<span<?php echo $terms_conditions->name->viewAttributes() ?>>
<?php echo $terms_conditions->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terms_conditions->dateupdate->Visible) { // dateupdate ?>
		<td data-name="dateupdate"<?php echo $terms_conditions->dateupdate->cellAttributes() ?>>
<span id="el<?php echo $terms_conditions_list->RowCnt ?>_terms_conditions_dateupdate" class="terms_conditions_dateupdate">
<span<?php echo $terms_conditions->dateupdate->viewAttributes() ?>>
<?php echo $terms_conditions->dateupdate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terms_conditions->_userid->Visible) { // userid ?>
		<td data-name="_userid"<?php echo $terms_conditions->_userid->cellAttributes() ?>>
<span id="el<?php echo $terms_conditions_list->RowCnt ?>_terms_conditions__userid" class="terms_conditions__userid">
<span<?php echo $terms_conditions->_userid->viewAttributes() ?>>
<?php echo $terms_conditions->_userid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terms_conditions->status->Visible) { // status ?>
		<td data-name="status"<?php echo $terms_conditions->status->cellAttributes() ?>>
<span id="el<?php echo $terms_conditions_list->RowCnt ?>_terms_conditions_status" class="terms_conditions_status">
<span<?php echo $terms_conditions->status->viewAttributes() ?>>
<?php if (ConvertToBool($terms_conditions->status->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $terms_conditions->status->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $terms_conditions->status->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$terms_conditions_list->ListOptions->render("body", "right", $terms_conditions_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$terms_conditions->isGridAdd())
		$terms_conditions_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$terms_conditions->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($terms_conditions_list->Recordset)
	$terms_conditions_list->Recordset->Close();
?>
<?php if (!$terms_conditions->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$terms_conditions->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($terms_conditions_list->Pager)) $terms_conditions_list->Pager = new PrevNextPager($terms_conditions_list->StartRec, $terms_conditions_list->DisplayRecs, $terms_conditions_list->TotalRecs, $terms_conditions_list->AutoHidePager) ?>
<?php if ($terms_conditions_list->Pager->RecordCount > 0 && $terms_conditions_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($terms_conditions_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $terms_conditions_list->pageUrl() ?>start=<?php echo $terms_conditions_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($terms_conditions_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $terms_conditions_list->pageUrl() ?>start=<?php echo $terms_conditions_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $terms_conditions_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($terms_conditions_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $terms_conditions_list->pageUrl() ?>start=<?php echo $terms_conditions_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($terms_conditions_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $terms_conditions_list->pageUrl() ?>start=<?php echo $terms_conditions_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $terms_conditions_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($terms_conditions_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $terms_conditions_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $terms_conditions_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $terms_conditions_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($terms_conditions_list->TotalRecs > 0 && (!$terms_conditions_list->AutoHidePageSizeSelector || $terms_conditions_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="terms_conditions">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($terms_conditions_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($terms_conditions_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($terms_conditions_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($terms_conditions->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $terms_conditions_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($terms_conditions_list->TotalRecs == 0 && !$terms_conditions->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $terms_conditions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$terms_conditions_list->showPageFooter();
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
$terms_conditions_list->terminate();
?>