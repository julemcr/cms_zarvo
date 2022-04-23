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
$slidercm_list = new slidercm_list();

// Run the page
$slidercm_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$slidercm_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$slidercm->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fslidercmlist = currentForm = new ew.Form("fslidercmlist", "list");
fslidercmlist.formKeyCountName = '<?php echo $slidercm_list->FormKeyCountName ?>';

// Form_CustomValidate event
fslidercmlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fslidercmlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fslidercmlistsrch = currentSearchForm = new ew.Form("fslidercmlistsrch");

// Filters
fslidercmlistsrch.filterList = <?php echo $slidercm_list->getFilterList() ?>;
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
<?php if (!$slidercm->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($slidercm_list->TotalRecs > 0 && $slidercm_list->ExportOptions->visible()) { ?>
<?php $slidercm_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($slidercm_list->ImportOptions->visible()) { ?>
<?php $slidercm_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($slidercm_list->SearchOptions->visible()) { ?>
<?php $slidercm_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($slidercm_list->FilterOptions->visible()) { ?>
<?php $slidercm_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$slidercm_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$slidercm->isExport() && !$slidercm->CurrentAction) { ?>
<form name="fslidercmlistsrch" id="fslidercmlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($slidercm_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fslidercmlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="slidercm">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($slidercm_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($slidercm_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $slidercm_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($slidercm_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($slidercm_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($slidercm_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($slidercm_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $slidercm_list->showPageHeader(); ?>
<?php
$slidercm_list->showMessage();
?>
<?php if ($slidercm_list->TotalRecs > 0 || $slidercm->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($slidercm_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> slidercm">
<?php if (!$slidercm->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$slidercm->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($slidercm_list->Pager)) $slidercm_list->Pager = new PrevNextPager($slidercm_list->StartRec, $slidercm_list->DisplayRecs, $slidercm_list->TotalRecs, $slidercm_list->AutoHidePager) ?>
<?php if ($slidercm_list->Pager->RecordCount > 0 && $slidercm_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($slidercm_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $slidercm_list->pageUrl() ?>start=<?php echo $slidercm_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($slidercm_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $slidercm_list->pageUrl() ?>start=<?php echo $slidercm_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $slidercm_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($slidercm_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $slidercm_list->pageUrl() ?>start=<?php echo $slidercm_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($slidercm_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $slidercm_list->pageUrl() ?>start=<?php echo $slidercm_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $slidercm_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($slidercm_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $slidercm_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $slidercm_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $slidercm_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($slidercm_list->TotalRecs > 0 && (!$slidercm_list->AutoHidePageSizeSelector || $slidercm_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="slidercm">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($slidercm_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($slidercm_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($slidercm_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($slidercm->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $slidercm_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fslidercmlist" id="fslidercmlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($slidercm_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $slidercm_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="slidercm">
<div id="gmp_slidercm" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($slidercm_list->TotalRecs > 0 || $slidercm->isGridEdit()) { ?>
<table id="tbl_slidercmlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$slidercm_list->RowType = ROWTYPE_HEADER;

// Render list options
$slidercm_list->renderListOptions();

// Render list options (header, left)
$slidercm_list->ListOptions->render("header", "left");
?>
<?php if ($slidercm->SlidercmID->Visible) { // SlidercmID ?>
	<?php if ($slidercm->sortUrl($slidercm->SlidercmID) == "") { ?>
		<th data-name="SlidercmID" class="<?php echo $slidercm->SlidercmID->headerCellClass() ?>"><div id="elh_slidercm_SlidercmID" class="slidercm_SlidercmID"><div class="ew-table-header-caption"><?php echo $slidercm->SlidercmID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SlidercmID" class="<?php echo $slidercm->SlidercmID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $slidercm->SortUrl($slidercm->SlidercmID) ?>',1);"><div id="elh_slidercm_SlidercmID" class="slidercm_SlidercmID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $slidercm->SlidercmID->caption() ?></span><span class="ew-table-header-sort"><?php if ($slidercm->SlidercmID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($slidercm->SlidercmID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($slidercm->Titulo->Visible) { // Titulo ?>
	<?php if ($slidercm->sortUrl($slidercm->Titulo) == "") { ?>
		<th data-name="Titulo" class="<?php echo $slidercm->Titulo->headerCellClass() ?>"><div id="elh_slidercm_Titulo" class="slidercm_Titulo"><div class="ew-table-header-caption"><?php echo $slidercm->Titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Titulo" class="<?php echo $slidercm->Titulo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $slidercm->SortUrl($slidercm->Titulo) ?>',1);"><div id="elh_slidercm_Titulo" class="slidercm_Titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $slidercm->Titulo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($slidercm->Titulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($slidercm->Titulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($slidercm->Detalle->Visible) { // Detalle ?>
	<?php if ($slidercm->sortUrl($slidercm->Detalle) == "") { ?>
		<th data-name="Detalle" class="<?php echo $slidercm->Detalle->headerCellClass() ?>"><div id="elh_slidercm_Detalle" class="slidercm_Detalle"><div class="ew-table-header-caption"><?php echo $slidercm->Detalle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Detalle" class="<?php echo $slidercm->Detalle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $slidercm->SortUrl($slidercm->Detalle) ?>',1);"><div id="elh_slidercm_Detalle" class="slidercm_Detalle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $slidercm->Detalle->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($slidercm->Detalle->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($slidercm->Detalle->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($slidercm->Url_image->Visible) { // Url_image ?>
	<?php if ($slidercm->sortUrl($slidercm->Url_image) == "") { ?>
		<th data-name="Url_image" class="<?php echo $slidercm->Url_image->headerCellClass() ?>"><div id="elh_slidercm_Url_image" class="slidercm_Url_image"><div class="ew-table-header-caption"><?php echo $slidercm->Url_image->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Url_image" class="<?php echo $slidercm->Url_image->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $slidercm->SortUrl($slidercm->Url_image) ?>',1);"><div id="elh_slidercm_Url_image" class="slidercm_Url_image">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $slidercm->Url_image->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($slidercm->Url_image->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($slidercm->Url_image->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($slidercm->Orden->Visible) { // Orden ?>
	<?php if ($slidercm->sortUrl($slidercm->Orden) == "") { ?>
		<th data-name="Orden" class="<?php echo $slidercm->Orden->headerCellClass() ?>"><div id="elh_slidercm_Orden" class="slidercm_Orden"><div class="ew-table-header-caption"><?php echo $slidercm->Orden->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Orden" class="<?php echo $slidercm->Orden->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $slidercm->SortUrl($slidercm->Orden) ?>',1);"><div id="elh_slidercm_Orden" class="slidercm_Orden">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $slidercm->Orden->caption() ?></span><span class="ew-table-header-sort"><?php if ($slidercm->Orden->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($slidercm->Orden->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($slidercm->Estado->Visible) { // Estado ?>
	<?php if ($slidercm->sortUrl($slidercm->Estado) == "") { ?>
		<th data-name="Estado" class="<?php echo $slidercm->Estado->headerCellClass() ?>"><div id="elh_slidercm_Estado" class="slidercm_Estado"><div class="ew-table-header-caption"><?php echo $slidercm->Estado->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Estado" class="<?php echo $slidercm->Estado->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $slidercm->SortUrl($slidercm->Estado) ?>',1);"><div id="elh_slidercm_Estado" class="slidercm_Estado">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $slidercm->Estado->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($slidercm->Estado->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($slidercm->Estado->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$slidercm_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($slidercm->ExportAll && $slidercm->isExport()) {
	$slidercm_list->StopRec = $slidercm_list->TotalRecs;
} else {

	// Set the last record to display
	if ($slidercm_list->TotalRecs > $slidercm_list->StartRec + $slidercm_list->DisplayRecs - 1)
		$slidercm_list->StopRec = $slidercm_list->StartRec + $slidercm_list->DisplayRecs - 1;
	else
		$slidercm_list->StopRec = $slidercm_list->TotalRecs;
}
$slidercm_list->RecCnt = $slidercm_list->StartRec - 1;
if ($slidercm_list->Recordset && !$slidercm_list->Recordset->EOF) {
	$slidercm_list->Recordset->moveFirst();
	$selectLimit = $slidercm_list->UseSelectLimit;
	if (!$selectLimit && $slidercm_list->StartRec > 1)
		$slidercm_list->Recordset->move($slidercm_list->StartRec - 1);
} elseif (!$slidercm->AllowAddDeleteRow && $slidercm_list->StopRec == 0) {
	$slidercm_list->StopRec = $slidercm->GridAddRowCount;
}

// Initialize aggregate
$slidercm->RowType = ROWTYPE_AGGREGATEINIT;
$slidercm->resetAttributes();
$slidercm_list->renderRow();
while ($slidercm_list->RecCnt < $slidercm_list->StopRec) {
	$slidercm_list->RecCnt++;
	if ($slidercm_list->RecCnt >= $slidercm_list->StartRec) {
		$slidercm_list->RowCnt++;

		// Set up key count
		$slidercm_list->KeyCount = $slidercm_list->RowIndex;

		// Init row class and style
		$slidercm->resetAttributes();
		$slidercm->CssClass = "";
		if ($slidercm->isGridAdd()) {
		} else {
			$slidercm_list->loadRowValues($slidercm_list->Recordset); // Load row values
		}
		$slidercm->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$slidercm->RowAttrs = array_merge($slidercm->RowAttrs, array('data-rowindex'=>$slidercm_list->RowCnt, 'id'=>'r' . $slidercm_list->RowCnt . '_slidercm', 'data-rowtype'=>$slidercm->RowType));

		// Render row
		$slidercm_list->renderRow();

		// Render list options
		$slidercm_list->renderListOptions();
?>
	<tr<?php echo $slidercm->rowAttributes() ?>>
<?php

// Render list options (body, left)
$slidercm_list->ListOptions->render("body", "left", $slidercm_list->RowCnt);
?>
	<?php if ($slidercm->SlidercmID->Visible) { // SlidercmID ?>
		<td data-name="SlidercmID"<?php echo $slidercm->SlidercmID->cellAttributes() ?>>
<span id="el<?php echo $slidercm_list->RowCnt ?>_slidercm_SlidercmID" class="slidercm_SlidercmID">
<span<?php echo $slidercm->SlidercmID->viewAttributes() ?>>
<?php echo $slidercm->SlidercmID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($slidercm->Titulo->Visible) { // Titulo ?>
		<td data-name="Titulo"<?php echo $slidercm->Titulo->cellAttributes() ?>>
<span id="el<?php echo $slidercm_list->RowCnt ?>_slidercm_Titulo" class="slidercm_Titulo">
<span<?php echo $slidercm->Titulo->viewAttributes() ?>>
<?php echo $slidercm->Titulo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($slidercm->Detalle->Visible) { // Detalle ?>
		<td data-name="Detalle"<?php echo $slidercm->Detalle->cellAttributes() ?>>
<span id="el<?php echo $slidercm_list->RowCnt ?>_slidercm_Detalle" class="slidercm_Detalle">
<span<?php echo $slidercm->Detalle->viewAttributes() ?>>
<?php echo $slidercm->Detalle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($slidercm->Url_image->Visible) { // Url_image ?>
		<td data-name="Url_image"<?php echo $slidercm->Url_image->cellAttributes() ?>>
<span id="el<?php echo $slidercm_list->RowCnt ?>_slidercm_Url_image" class="slidercm_Url_image">
<span>
<?php echo GetFileViewTag($slidercm->Url_image, $slidercm->Url_image->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($slidercm->Orden->Visible) { // Orden ?>
		<td data-name="Orden"<?php echo $slidercm->Orden->cellAttributes() ?>>
<span id="el<?php echo $slidercm_list->RowCnt ?>_slidercm_Orden" class="slidercm_Orden">
<span<?php echo $slidercm->Orden->viewAttributes() ?>>
<?php echo $slidercm->Orden->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($slidercm->Estado->Visible) { // Estado ?>
		<td data-name="Estado"<?php echo $slidercm->Estado->cellAttributes() ?>>
<span id="el<?php echo $slidercm_list->RowCnt ?>_slidercm_Estado" class="slidercm_Estado">
<span<?php echo $slidercm->Estado->viewAttributes() ?>>
<?php echo $slidercm->Estado->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$slidercm_list->ListOptions->render("body", "right", $slidercm_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$slidercm->isGridAdd())
		$slidercm_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$slidercm->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($slidercm_list->Recordset)
	$slidercm_list->Recordset->Close();
?>
<?php if (!$slidercm->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$slidercm->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($slidercm_list->Pager)) $slidercm_list->Pager = new PrevNextPager($slidercm_list->StartRec, $slidercm_list->DisplayRecs, $slidercm_list->TotalRecs, $slidercm_list->AutoHidePager) ?>
<?php if ($slidercm_list->Pager->RecordCount > 0 && $slidercm_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($slidercm_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $slidercm_list->pageUrl() ?>start=<?php echo $slidercm_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($slidercm_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $slidercm_list->pageUrl() ?>start=<?php echo $slidercm_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $slidercm_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($slidercm_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $slidercm_list->pageUrl() ?>start=<?php echo $slidercm_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($slidercm_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $slidercm_list->pageUrl() ?>start=<?php echo $slidercm_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $slidercm_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($slidercm_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $slidercm_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $slidercm_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $slidercm_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($slidercm_list->TotalRecs > 0 && (!$slidercm_list->AutoHidePageSizeSelector || $slidercm_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="slidercm">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($slidercm_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($slidercm_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($slidercm_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($slidercm->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $slidercm_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($slidercm_list->TotalRecs == 0 && !$slidercm->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $slidercm_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$slidercm_list->showPageFooter();
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
$slidercm_list->terminate();
?>