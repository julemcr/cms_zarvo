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
$person_list = new person_list();

// Run the page
$person_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$person_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$person->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fpersonlist = currentForm = new ew.Form("fpersonlist", "list");
fpersonlist.formKeyCountName = '<?php echo $person_list->FormKeyCountName ?>';

// Form_CustomValidate event
fpersonlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpersonlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpersonlist.lists["x_Sexo"] = <?php echo $person_list->Sexo->Lookup->toClientList() ?>;
fpersonlist.lists["x_Sexo"].options = <?php echo JsonEncode($person_list->Sexo->lookupOptions()) ?>;
fpersonlist.lists["x_Country"] = <?php echo $person_list->Country->Lookup->toClientList() ?>;
fpersonlist.lists["x_Country"].options = <?php echo JsonEncode($person_list->Country->lookupOptions()) ?>;
fpersonlist.lists["x_Activated[]"] = <?php echo $person_list->Activated->Lookup->toClientList() ?>;
fpersonlist.lists["x_Activated[]"].options = <?php echo JsonEncode($person_list->Activated->options(FALSE, TRUE)) ?>;

// Form object for search
var fpersonlistsrch = currentSearchForm = new ew.Form("fpersonlistsrch");

// Filters
fpersonlistsrch.filterList = <?php echo $person_list->getFilterList() ?>;
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
<?php if (!$person->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($person_list->TotalRecs > 0 && $person_list->ExportOptions->visible()) { ?>
<?php $person_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($person_list->ImportOptions->visible()) { ?>
<?php $person_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($person_list->SearchOptions->visible()) { ?>
<?php $person_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($person_list->FilterOptions->visible()) { ?>
<?php $person_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$person_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$person->isExport() && !$person->CurrentAction) { ?>
<form name="fpersonlistsrch" id="fpersonlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($person_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fpersonlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="person">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($person_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($person_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $person_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($person_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($person_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($person_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($person_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $person_list->showPageHeader(); ?>
<?php
$person_list->showMessage();
?>
<?php if ($person_list->TotalRecs > 0 || $person->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($person_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> person">
<?php if (!$person->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$person->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($person_list->Pager)) $person_list->Pager = new PrevNextPager($person_list->StartRec, $person_list->DisplayRecs, $person_list->TotalRecs, $person_list->AutoHidePager) ?>
<?php if ($person_list->Pager->RecordCount > 0 && $person_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($person_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $person_list->pageUrl() ?>start=<?php echo $person_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($person_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $person_list->pageUrl() ?>start=<?php echo $person_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $person_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($person_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $person_list->pageUrl() ?>start=<?php echo $person_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($person_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $person_list->pageUrl() ?>start=<?php echo $person_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $person_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($person_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $person_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $person_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $person_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($person_list->TotalRecs > 0 && (!$person_list->AutoHidePageSizeSelector || $person_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="person">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($person_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($person_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($person_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($person->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $person_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpersonlist" id="fpersonlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($person_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $person_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="person">
<div id="gmp_person" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($person_list->TotalRecs > 0 || $person->isGridEdit()) { ?>
<table id="tbl_personlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$person_list->RowType = ROWTYPE_HEADER;

// Render list options
$person_list->renderListOptions();

// Render list options (header, left)
$person_list->ListOptions->render("header", "left");
?>
<?php if ($person->PersonID->Visible) { // PersonID ?>
	<?php if ($person->sortUrl($person->PersonID) == "") { ?>
		<th data-name="PersonID" class="<?php echo $person->PersonID->headerCellClass() ?>"><div id="elh_person_PersonID" class="person_PersonID"><div class="ew-table-header-caption"><?php echo $person->PersonID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PersonID" class="<?php echo $person->PersonID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $person->SortUrl($person->PersonID) ?>',1);"><div id="elh_person_PersonID" class="person_PersonID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $person->PersonID->caption() ?></span><span class="ew-table-header-sort"><?php if ($person->PersonID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($person->PersonID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($person->Sexo->Visible) { // Sexo ?>
	<?php if ($person->sortUrl($person->Sexo) == "") { ?>
		<th data-name="Sexo" class="<?php echo $person->Sexo->headerCellClass() ?>"><div id="elh_person_Sexo" class="person_Sexo"><div class="ew-table-header-caption"><?php echo $person->Sexo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sexo" class="<?php echo $person->Sexo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $person->SortUrl($person->Sexo) ?>',1);"><div id="elh_person_Sexo" class="person_Sexo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $person->Sexo->caption() ?></span><span class="ew-table-header-sort"><?php if ($person->Sexo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($person->Sexo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($person->Name->Visible) { // Name ?>
	<?php if ($person->sortUrl($person->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $person->Name->headerCellClass() ?>"><div id="elh_person_Name" class="person_Name"><div class="ew-table-header-caption"><?php echo $person->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $person->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $person->SortUrl($person->Name) ?>',1);"><div id="elh_person_Name" class="person_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $person->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($person->Name->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($person->Name->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($person->LastName->Visible) { // LastName ?>
	<?php if ($person->sortUrl($person->LastName) == "") { ?>
		<th data-name="LastName" class="<?php echo $person->LastName->headerCellClass() ?>"><div id="elh_person_LastName" class="person_LastName"><div class="ew-table-header-caption"><?php echo $person->LastName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastName" class="<?php echo $person->LastName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $person->SortUrl($person->LastName) ?>',1);"><div id="elh_person_LastName" class="person_LastName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $person->LastName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($person->LastName->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($person->LastName->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($person->Country->Visible) { // Country ?>
	<?php if ($person->sortUrl($person->Country) == "") { ?>
		<th data-name="Country" class="<?php echo $person->Country->headerCellClass() ?>"><div id="elh_person_Country" class="person_Country"><div class="ew-table-header-caption"><?php echo $person->Country->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Country" class="<?php echo $person->Country->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $person->SortUrl($person->Country) ?>',1);"><div id="elh_person_Country" class="person_Country">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $person->Country->caption() ?></span><span class="ew-table-header-sort"><?php if ($person->Country->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($person->Country->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($person->City->Visible) { // City ?>
	<?php if ($person->sortUrl($person->City) == "") { ?>
		<th data-name="City" class="<?php echo $person->City->headerCellClass() ?>"><div id="elh_person_City" class="person_City"><div class="ew-table-header-caption"><?php echo $person->City->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="City" class="<?php echo $person->City->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $person->SortUrl($person->City) ?>',1);"><div id="elh_person_City" class="person_City">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $person->City->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($person->City->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($person->City->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($person->Address->Visible) { // Address ?>
	<?php if ($person->sortUrl($person->Address) == "") { ?>
		<th data-name="Address" class="<?php echo $person->Address->headerCellClass() ?>"><div id="elh_person_Address" class="person_Address"><div class="ew-table-header-caption"><?php echo $person->Address->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Address" class="<?php echo $person->Address->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $person->SortUrl($person->Address) ?>',1);"><div id="elh_person_Address" class="person_Address">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $person->Address->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($person->Address->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($person->Address->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($person->Username->Visible) { // Username ?>
	<?php if ($person->sortUrl($person->Username) == "") { ?>
		<th data-name="Username" class="<?php echo $person->Username->headerCellClass() ?>"><div id="elh_person_Username" class="person_Username"><div class="ew-table-header-caption"><?php echo $person->Username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Username" class="<?php echo $person->Username->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $person->SortUrl($person->Username) ?>',1);"><div id="elh_person_Username" class="person_Username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $person->Username->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($person->Username->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($person->Username->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($person->Activated->Visible) { // Activated ?>
	<?php if ($person->sortUrl($person->Activated) == "") { ?>
		<th data-name="Activated" class="<?php echo $person->Activated->headerCellClass() ?>"><div id="elh_person_Activated" class="person_Activated"><div class="ew-table-header-caption"><?php echo $person->Activated->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Activated" class="<?php echo $person->Activated->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $person->SortUrl($person->Activated) ?>',1);"><div id="elh_person_Activated" class="person_Activated">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $person->Activated->caption() ?></span><span class="ew-table-header-sort"><?php if ($person->Activated->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($person->Activated->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$person_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($person->ExportAll && $person->isExport()) {
	$person_list->StopRec = $person_list->TotalRecs;
} else {

	// Set the last record to display
	if ($person_list->TotalRecs > $person_list->StartRec + $person_list->DisplayRecs - 1)
		$person_list->StopRec = $person_list->StartRec + $person_list->DisplayRecs - 1;
	else
		$person_list->StopRec = $person_list->TotalRecs;
}
$person_list->RecCnt = $person_list->StartRec - 1;
if ($person_list->Recordset && !$person_list->Recordset->EOF) {
	$person_list->Recordset->moveFirst();
	$selectLimit = $person_list->UseSelectLimit;
	if (!$selectLimit && $person_list->StartRec > 1)
		$person_list->Recordset->move($person_list->StartRec - 1);
} elseif (!$person->AllowAddDeleteRow && $person_list->StopRec == 0) {
	$person_list->StopRec = $person->GridAddRowCount;
}

// Initialize aggregate
$person->RowType = ROWTYPE_AGGREGATEINIT;
$person->resetAttributes();
$person_list->renderRow();
while ($person_list->RecCnt < $person_list->StopRec) {
	$person_list->RecCnt++;
	if ($person_list->RecCnt >= $person_list->StartRec) {
		$person_list->RowCnt++;

		// Set up key count
		$person_list->KeyCount = $person_list->RowIndex;

		// Init row class and style
		$person->resetAttributes();
		$person->CssClass = "";
		if ($person->isGridAdd()) {
		} else {
			$person_list->loadRowValues($person_list->Recordset); // Load row values
		}
		$person->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$person->RowAttrs = array_merge($person->RowAttrs, array('data-rowindex'=>$person_list->RowCnt, 'id'=>'r' . $person_list->RowCnt . '_person', 'data-rowtype'=>$person->RowType));

		// Render row
		$person_list->renderRow();

		// Render list options
		$person_list->renderListOptions();
?>
	<tr<?php echo $person->rowAttributes() ?>>
<?php

// Render list options (body, left)
$person_list->ListOptions->render("body", "left", $person_list->RowCnt);
?>
	<?php if ($person->PersonID->Visible) { // PersonID ?>
		<td data-name="PersonID"<?php echo $person->PersonID->cellAttributes() ?>>
<span id="el<?php echo $person_list->RowCnt ?>_person_PersonID" class="person_PersonID">
<span<?php echo $person->PersonID->viewAttributes() ?>>
<?php echo $person->PersonID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($person->Sexo->Visible) { // Sexo ?>
		<td data-name="Sexo"<?php echo $person->Sexo->cellAttributes() ?>>
<span id="el<?php echo $person_list->RowCnt ?>_person_Sexo" class="person_Sexo">
<span<?php echo $person->Sexo->viewAttributes() ?>>
<?php echo $person->Sexo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($person->Name->Visible) { // Name ?>
		<td data-name="Name"<?php echo $person->Name->cellAttributes() ?>>
<span id="el<?php echo $person_list->RowCnt ?>_person_Name" class="person_Name">
<span<?php echo $person->Name->viewAttributes() ?>>
<?php echo $person->Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($person->LastName->Visible) { // LastName ?>
		<td data-name="LastName"<?php echo $person->LastName->cellAttributes() ?>>
<span id="el<?php echo $person_list->RowCnt ?>_person_LastName" class="person_LastName">
<span<?php echo $person->LastName->viewAttributes() ?>>
<?php echo $person->LastName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($person->Country->Visible) { // Country ?>
		<td data-name="Country"<?php echo $person->Country->cellAttributes() ?>>
<span id="el<?php echo $person_list->RowCnt ?>_person_Country" class="person_Country">
<span<?php echo $person->Country->viewAttributes() ?>>
<?php echo $person->Country->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($person->City->Visible) { // City ?>
		<td data-name="City"<?php echo $person->City->cellAttributes() ?>>
<span id="el<?php echo $person_list->RowCnt ?>_person_City" class="person_City">
<span<?php echo $person->City->viewAttributes() ?>>
<?php echo $person->City->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($person->Address->Visible) { // Address ?>
		<td data-name="Address"<?php echo $person->Address->cellAttributes() ?>>
<span id="el<?php echo $person_list->RowCnt ?>_person_Address" class="person_Address">
<span<?php echo $person->Address->viewAttributes() ?>>
<?php echo $person->Address->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($person->Username->Visible) { // Username ?>
		<td data-name="Username"<?php echo $person->Username->cellAttributes() ?>>
<span id="el<?php echo $person_list->RowCnt ?>_person_Username" class="person_Username">
<span<?php echo $person->Username->viewAttributes() ?>>
<?php echo $person->Username->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($person->Activated->Visible) { // Activated ?>
		<td data-name="Activated"<?php echo $person->Activated->cellAttributes() ?>>
<span id="el<?php echo $person_list->RowCnt ?>_person_Activated" class="person_Activated">
<span<?php echo $person->Activated->viewAttributes() ?>>
<?php if (ConvertToBool($person->Activated->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $person->Activated->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $person->Activated->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$person_list->ListOptions->render("body", "right", $person_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$person->isGridAdd())
		$person_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$person->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($person_list->Recordset)
	$person_list->Recordset->Close();
?>
<?php if (!$person->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$person->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($person_list->Pager)) $person_list->Pager = new PrevNextPager($person_list->StartRec, $person_list->DisplayRecs, $person_list->TotalRecs, $person_list->AutoHidePager) ?>
<?php if ($person_list->Pager->RecordCount > 0 && $person_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($person_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $person_list->pageUrl() ?>start=<?php echo $person_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($person_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $person_list->pageUrl() ?>start=<?php echo $person_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $person_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($person_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $person_list->pageUrl() ?>start=<?php echo $person_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($person_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $person_list->pageUrl() ?>start=<?php echo $person_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $person_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($person_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $person_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $person_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $person_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($person_list->TotalRecs > 0 && (!$person_list->AutoHidePageSizeSelector || $person_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="person">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($person_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($person_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($person_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($person->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $person_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($person_list->TotalRecs == 0 && !$person->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $person_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$person_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$person->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$person_list->terminate();
?>