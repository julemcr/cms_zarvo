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
$profiles_list = new profiles_list();

// Run the page
$profiles_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$profiles_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$profiles->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fprofileslist = currentForm = new ew.Form("fprofileslist", "list");
fprofileslist.formKeyCountName = '<?php echo $profiles_list->FormKeyCountName ?>';

// Form_CustomValidate event
fprofileslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fprofileslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fprofileslistsrch = currentSearchForm = new ew.Form("fprofileslistsrch");

// Filters
fprofileslistsrch.filterList = <?php echo $profiles_list->getFilterList() ?>;
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
<?php if (!$profiles->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($profiles_list->TotalRecs > 0 && $profiles_list->ExportOptions->visible()) { ?>
<?php $profiles_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($profiles_list->ImportOptions->visible()) { ?>
<?php $profiles_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($profiles_list->SearchOptions->visible()) { ?>
<?php $profiles_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($profiles_list->FilterOptions->visible()) { ?>
<?php $profiles_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$profiles_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$profiles->isExport() && !$profiles->CurrentAction) { ?>
<form name="fprofileslistsrch" id="fprofileslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($profiles_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fprofileslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="profiles">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($profiles_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($profiles_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $profiles_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($profiles_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($profiles_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($profiles_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($profiles_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $profiles_list->showPageHeader(); ?>
<?php
$profiles_list->showMessage();
?>
<?php if ($profiles_list->TotalRecs > 0 || $profiles->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($profiles_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> profiles">
<?php if (!$profiles->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$profiles->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($profiles_list->Pager)) $profiles_list->Pager = new PrevNextPager($profiles_list->StartRec, $profiles_list->DisplayRecs, $profiles_list->TotalRecs, $profiles_list->AutoHidePager) ?>
<?php if ($profiles_list->Pager->RecordCount > 0 && $profiles_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($profiles_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $profiles_list->pageUrl() ?>start=<?php echo $profiles_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($profiles_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $profiles_list->pageUrl() ?>start=<?php echo $profiles_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $profiles_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($profiles_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $profiles_list->pageUrl() ?>start=<?php echo $profiles_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($profiles_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $profiles_list->pageUrl() ?>start=<?php echo $profiles_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $profiles_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($profiles_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $profiles_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $profiles_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $profiles_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($profiles_list->TotalRecs > 0 && (!$profiles_list->AutoHidePageSizeSelector || $profiles_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="profiles">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($profiles_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($profiles_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($profiles_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($profiles->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $profiles_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fprofileslist" id="fprofileslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($profiles_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $profiles_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="profiles">
<div id="gmp_profiles" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($profiles_list->TotalRecs > 0 || $profiles->isGridEdit()) { ?>
<table id="tbl_profileslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$profiles_list->RowType = ROWTYPE_HEADER;

// Render list options
$profiles_list->renderListOptions();

// Render list options (header, left)
$profiles_list->ListOptions->render("header", "left");
?>
<?php if ($profiles->id->Visible) { // id ?>
	<?php if ($profiles->sortUrl($profiles->id) == "") { ?>
		<th data-name="id" class="<?php echo $profiles->id->headerCellClass() ?>"><div id="elh_profiles_id" class="profiles_id"><div class="ew-table-header-caption"><?php echo $profiles->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $profiles->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $profiles->SortUrl($profiles->id) ?>',1);"><div id="elh_profiles_id" class="profiles_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profiles->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($profiles->id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($profiles->id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profiles->title->Visible) { // title ?>
	<?php if ($profiles->sortUrl($profiles->title) == "") { ?>
		<th data-name="title" class="<?php echo $profiles->title->headerCellClass() ?>"><div id="elh_profiles_title" class="profiles_title"><div class="ew-table-header-caption"><?php echo $profiles->title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="title" class="<?php echo $profiles->title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $profiles->SortUrl($profiles->title) ?>',1);"><div id="elh_profiles_title" class="profiles_title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profiles->title->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($profiles->title->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($profiles->title->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profiles->imagen->Visible) { // imagen ?>
	<?php if ($profiles->sortUrl($profiles->imagen) == "") { ?>
		<th data-name="imagen" class="<?php echo $profiles->imagen->headerCellClass() ?>"><div id="elh_profiles_imagen" class="profiles_imagen"><div class="ew-table-header-caption"><?php echo $profiles->imagen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="imagen" class="<?php echo $profiles->imagen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $profiles->SortUrl($profiles->imagen) ?>',1);"><div id="elh_profiles_imagen" class="profiles_imagen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profiles->imagen->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($profiles->imagen->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($profiles->imagen->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profiles->website->Visible) { // website ?>
	<?php if ($profiles->sortUrl($profiles->website) == "") { ?>
		<th data-name="website" class="<?php echo $profiles->website->headerCellClass() ?>"><div id="elh_profiles_website" class="profiles_website"><div class="ew-table-header-caption"><?php echo $profiles->website->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="website" class="<?php echo $profiles->website->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $profiles->SortUrl($profiles->website) ?>',1);"><div id="elh_profiles_website" class="profiles_website">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profiles->website->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($profiles->website->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($profiles->website->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profiles->facebook->Visible) { // facebook ?>
	<?php if ($profiles->sortUrl($profiles->facebook) == "") { ?>
		<th data-name="facebook" class="<?php echo $profiles->facebook->headerCellClass() ?>"><div id="elh_profiles_facebook" class="profiles_facebook"><div class="ew-table-header-caption"><?php echo $profiles->facebook->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="facebook" class="<?php echo $profiles->facebook->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $profiles->SortUrl($profiles->facebook) ?>',1);"><div id="elh_profiles_facebook" class="profiles_facebook">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profiles->facebook->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($profiles->facebook->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($profiles->facebook->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profiles->linkedin->Visible) { // linkedin ?>
	<?php if ($profiles->sortUrl($profiles->linkedin) == "") { ?>
		<th data-name="linkedin" class="<?php echo $profiles->linkedin->headerCellClass() ?>"><div id="elh_profiles_linkedin" class="profiles_linkedin"><div class="ew-table-header-caption"><?php echo $profiles->linkedin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="linkedin" class="<?php echo $profiles->linkedin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $profiles->SortUrl($profiles->linkedin) ?>',1);"><div id="elh_profiles_linkedin" class="profiles_linkedin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profiles->linkedin->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($profiles->linkedin->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($profiles->linkedin->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profiles->youtube->Visible) { // youtube ?>
	<?php if ($profiles->sortUrl($profiles->youtube) == "") { ?>
		<th data-name="youtube" class="<?php echo $profiles->youtube->headerCellClass() ?>"><div id="elh_profiles_youtube" class="profiles_youtube"><div class="ew-table-header-caption"><?php echo $profiles->youtube->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="youtube" class="<?php echo $profiles->youtube->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $profiles->SortUrl($profiles->youtube) ?>',1);"><div id="elh_profiles_youtube" class="profiles_youtube">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profiles->youtube->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($profiles->youtube->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($profiles->youtube->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($profiles->instagram->Visible) { // instagram ?>
	<?php if ($profiles->sortUrl($profiles->instagram) == "") { ?>
		<th data-name="instagram" class="<?php echo $profiles->instagram->headerCellClass() ?>"><div id="elh_profiles_instagram" class="profiles_instagram"><div class="ew-table-header-caption"><?php echo $profiles->instagram->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="instagram" class="<?php echo $profiles->instagram->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $profiles->SortUrl($profiles->instagram) ?>',1);"><div id="elh_profiles_instagram" class="profiles_instagram">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $profiles->instagram->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($profiles->instagram->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($profiles->instagram->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$profiles_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($profiles->ExportAll && $profiles->isExport()) {
	$profiles_list->StopRec = $profiles_list->TotalRecs;
} else {

	// Set the last record to display
	if ($profiles_list->TotalRecs > $profiles_list->StartRec + $profiles_list->DisplayRecs - 1)
		$profiles_list->StopRec = $profiles_list->StartRec + $profiles_list->DisplayRecs - 1;
	else
		$profiles_list->StopRec = $profiles_list->TotalRecs;
}
$profiles_list->RecCnt = $profiles_list->StartRec - 1;
if ($profiles_list->Recordset && !$profiles_list->Recordset->EOF) {
	$profiles_list->Recordset->moveFirst();
	$selectLimit = $profiles_list->UseSelectLimit;
	if (!$selectLimit && $profiles_list->StartRec > 1)
		$profiles_list->Recordset->move($profiles_list->StartRec - 1);
} elseif (!$profiles->AllowAddDeleteRow && $profiles_list->StopRec == 0) {
	$profiles_list->StopRec = $profiles->GridAddRowCount;
}

// Initialize aggregate
$profiles->RowType = ROWTYPE_AGGREGATEINIT;
$profiles->resetAttributes();
$profiles_list->renderRow();
while ($profiles_list->RecCnt < $profiles_list->StopRec) {
	$profiles_list->RecCnt++;
	if ($profiles_list->RecCnt >= $profiles_list->StartRec) {
		$profiles_list->RowCnt++;

		// Set up key count
		$profiles_list->KeyCount = $profiles_list->RowIndex;

		// Init row class and style
		$profiles->resetAttributes();
		$profiles->CssClass = "";
		if ($profiles->isGridAdd()) {
		} else {
			$profiles_list->loadRowValues($profiles_list->Recordset); // Load row values
		}
		$profiles->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$profiles->RowAttrs = array_merge($profiles->RowAttrs, array('data-rowindex'=>$profiles_list->RowCnt, 'id'=>'r' . $profiles_list->RowCnt . '_profiles', 'data-rowtype'=>$profiles->RowType));

		// Render row
		$profiles_list->renderRow();

		// Render list options
		$profiles_list->renderListOptions();
?>
	<tr<?php echo $profiles->rowAttributes() ?>>
<?php

// Render list options (body, left)
$profiles_list->ListOptions->render("body", "left", $profiles_list->RowCnt);
?>
	<?php if ($profiles->id->Visible) { // id ?>
		<td data-name="id"<?php echo $profiles->id->cellAttributes() ?>>
<span id="el<?php echo $profiles_list->RowCnt ?>_profiles_id" class="profiles_id">
<span<?php echo $profiles->id->viewAttributes() ?>>
<?php echo $profiles->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($profiles->title->Visible) { // title ?>
		<td data-name="title"<?php echo $profiles->title->cellAttributes() ?>>
<span id="el<?php echo $profiles_list->RowCnt ?>_profiles_title" class="profiles_title">
<span<?php echo $profiles->title->viewAttributes() ?>>
<?php echo $profiles->title->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($profiles->imagen->Visible) { // imagen ?>
		<td data-name="imagen"<?php echo $profiles->imagen->cellAttributes() ?>>
<span id="el<?php echo $profiles_list->RowCnt ?>_profiles_imagen" class="profiles_imagen">
<span>
<?php echo GetFileViewTag($profiles->imagen, $profiles->imagen->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($profiles->website->Visible) { // website ?>
		<td data-name="website"<?php echo $profiles->website->cellAttributes() ?>>
<span id="el<?php echo $profiles_list->RowCnt ?>_profiles_website" class="profiles_website">
<span<?php echo $profiles->website->viewAttributes() ?>>
<?php echo $profiles->website->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($profiles->facebook->Visible) { // facebook ?>
		<td data-name="facebook"<?php echo $profiles->facebook->cellAttributes() ?>>
<span id="el<?php echo $profiles_list->RowCnt ?>_profiles_facebook" class="profiles_facebook">
<span<?php echo $profiles->facebook->viewAttributes() ?>>
<?php echo $profiles->facebook->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($profiles->linkedin->Visible) { // linkedin ?>
		<td data-name="linkedin"<?php echo $profiles->linkedin->cellAttributes() ?>>
<span id="el<?php echo $profiles_list->RowCnt ?>_profiles_linkedin" class="profiles_linkedin">
<span<?php echo $profiles->linkedin->viewAttributes() ?>>
<?php echo $profiles->linkedin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($profiles->youtube->Visible) { // youtube ?>
		<td data-name="youtube"<?php echo $profiles->youtube->cellAttributes() ?>>
<span id="el<?php echo $profiles_list->RowCnt ?>_profiles_youtube" class="profiles_youtube">
<span<?php echo $profiles->youtube->viewAttributes() ?>>
<?php echo $profiles->youtube->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($profiles->instagram->Visible) { // instagram ?>
		<td data-name="instagram"<?php echo $profiles->instagram->cellAttributes() ?>>
<span id="el<?php echo $profiles_list->RowCnt ?>_profiles_instagram" class="profiles_instagram">
<span<?php echo $profiles->instagram->viewAttributes() ?>>
<?php echo $profiles->instagram->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$profiles_list->ListOptions->render("body", "right", $profiles_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$profiles->isGridAdd())
		$profiles_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$profiles->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($profiles_list->Recordset)
	$profiles_list->Recordset->Close();
?>
<?php if (!$profiles->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$profiles->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($profiles_list->Pager)) $profiles_list->Pager = new PrevNextPager($profiles_list->StartRec, $profiles_list->DisplayRecs, $profiles_list->TotalRecs, $profiles_list->AutoHidePager) ?>
<?php if ($profiles_list->Pager->RecordCount > 0 && $profiles_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($profiles_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $profiles_list->pageUrl() ?>start=<?php echo $profiles_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($profiles_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $profiles_list->pageUrl() ?>start=<?php echo $profiles_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $profiles_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($profiles_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $profiles_list->pageUrl() ?>start=<?php echo $profiles_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($profiles_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $profiles_list->pageUrl() ?>start=<?php echo $profiles_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $profiles_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($profiles_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $profiles_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $profiles_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $profiles_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($profiles_list->TotalRecs > 0 && (!$profiles_list->AutoHidePageSizeSelector || $profiles_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="profiles">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($profiles_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($profiles_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($profiles_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($profiles->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $profiles_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($profiles_list->TotalRecs == 0 && !$profiles->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $profiles_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$profiles_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$profiles->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$profiles_list->terminate();
?>