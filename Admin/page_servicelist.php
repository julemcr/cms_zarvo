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
$page_service_list = new page_service_list();

// Run the page
$page_service_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$page_service_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$page_service->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fpage_servicelist = currentForm = new ew.Form("fpage_servicelist", "list");
fpage_servicelist.formKeyCountName = '<?php echo $page_service_list->FormKeyCountName ?>';

// Form_CustomValidate event
fpage_servicelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpage_servicelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpage_servicelist.lists["x_Estado"] = <?php echo $page_service_list->Estado->Lookup->toClientList() ?>;
fpage_servicelist.lists["x_Estado"].options = <?php echo JsonEncode($page_service_list->Estado->options(FALSE, TRUE)) ?>;

// Form object for search
var fpage_servicelistsrch = currentSearchForm = new ew.Form("fpage_servicelistsrch");

// Filters
fpage_servicelistsrch.filterList = <?php echo $page_service_list->getFilterList() ?>;
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
<?php if (!$page_service->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($page_service_list->TotalRecs > 0 && $page_service_list->ExportOptions->visible()) { ?>
<?php $page_service_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($page_service_list->ImportOptions->visible()) { ?>
<?php $page_service_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($page_service_list->SearchOptions->visible()) { ?>
<?php $page_service_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($page_service_list->FilterOptions->visible()) { ?>
<?php $page_service_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$page_service_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$page_service->isExport() && !$page_service->CurrentAction) { ?>
<form name="fpage_servicelistsrch" id="fpage_servicelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($page_service_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fpage_servicelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="page_service">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($page_service_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($page_service_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $page_service_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($page_service_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($page_service_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($page_service_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($page_service_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $page_service_list->showPageHeader(); ?>
<?php
$page_service_list->showMessage();
?>
<?php if ($page_service_list->TotalRecs > 0 || $page_service->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($page_service_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> page_service">
<?php if (!$page_service->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$page_service->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($page_service_list->Pager)) $page_service_list->Pager = new PrevNextPager($page_service_list->StartRec, $page_service_list->DisplayRecs, $page_service_list->TotalRecs, $page_service_list->AutoHidePager) ?>
<?php if ($page_service_list->Pager->RecordCount > 0 && $page_service_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($page_service_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $page_service_list->pageUrl() ?>start=<?php echo $page_service_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($page_service_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $page_service_list->pageUrl() ?>start=<?php echo $page_service_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $page_service_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($page_service_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $page_service_list->pageUrl() ?>start=<?php echo $page_service_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($page_service_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $page_service_list->pageUrl() ?>start=<?php echo $page_service_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $page_service_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($page_service_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $page_service_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $page_service_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $page_service_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($page_service_list->TotalRecs > 0 && (!$page_service_list->AutoHidePageSizeSelector || $page_service_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="page_service">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($page_service_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($page_service_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($page_service_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($page_service->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $page_service_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpage_servicelist" id="fpage_servicelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($page_service_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $page_service_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="page_service">
<div id="gmp_page_service" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($page_service_list->TotalRecs > 0 || $page_service->isGridEdit()) { ?>
<table id="tbl_page_servicelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$page_service_list->RowType = ROWTYPE_HEADER;

// Render list options
$page_service_list->renderListOptions();

// Render list options (header, left)
$page_service_list->ListOptions->render("header", "left");
?>
<?php if ($page_service->PageServiceID->Visible) { // PageServiceID ?>
	<?php if ($page_service->sortUrl($page_service->PageServiceID) == "") { ?>
		<th data-name="PageServiceID" class="<?php echo $page_service->PageServiceID->headerCellClass() ?>"><div id="elh_page_service_PageServiceID" class="page_service_PageServiceID"><div class="ew-table-header-caption"><?php echo $page_service->PageServiceID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PageServiceID" class="<?php echo $page_service->PageServiceID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $page_service->SortUrl($page_service->PageServiceID) ?>',1);"><div id="elh_page_service_PageServiceID" class="page_service_PageServiceID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $page_service->PageServiceID->caption() ?></span><span class="ew-table-header-sort"><?php if ($page_service->PageServiceID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($page_service->PageServiceID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($page_service->Titulo->Visible) { // Titulo ?>
	<?php if ($page_service->sortUrl($page_service->Titulo) == "") { ?>
		<th data-name="Titulo" class="<?php echo $page_service->Titulo->headerCellClass() ?>"><div id="elh_page_service_Titulo" class="page_service_Titulo"><div class="ew-table-header-caption"><?php echo $page_service->Titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Titulo" class="<?php echo $page_service->Titulo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $page_service->SortUrl($page_service->Titulo) ?>',1);"><div id="elh_page_service_Titulo" class="page_service_Titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $page_service->Titulo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($page_service->Titulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($page_service->Titulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($page_service->Icono->Visible) { // Icono ?>
	<?php if ($page_service->sortUrl($page_service->Icono) == "") { ?>
		<th data-name="Icono" class="<?php echo $page_service->Icono->headerCellClass() ?>"><div id="elh_page_service_Icono" class="page_service_Icono"><div class="ew-table-header-caption"><?php echo $page_service->Icono->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Icono" class="<?php echo $page_service->Icono->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $page_service->SortUrl($page_service->Icono) ?>',1);"><div id="elh_page_service_Icono" class="page_service_Icono">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $page_service->Icono->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($page_service->Icono->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($page_service->Icono->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($page_service->Imagen->Visible) { // Imagen ?>
	<?php if ($page_service->sortUrl($page_service->Imagen) == "") { ?>
		<th data-name="Imagen" class="<?php echo $page_service->Imagen->headerCellClass() ?>"><div id="elh_page_service_Imagen" class="page_service_Imagen"><div class="ew-table-header-caption"><?php echo $page_service->Imagen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Imagen" class="<?php echo $page_service->Imagen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $page_service->SortUrl($page_service->Imagen) ?>',1);"><div id="elh_page_service_Imagen" class="page_service_Imagen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $page_service->Imagen->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($page_service->Imagen->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($page_service->Imagen->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($page_service->Estado->Visible) { // Estado ?>
	<?php if ($page_service->sortUrl($page_service->Estado) == "") { ?>
		<th data-name="Estado" class="<?php echo $page_service->Estado->headerCellClass() ?>"><div id="elh_page_service_Estado" class="page_service_Estado"><div class="ew-table-header-caption"><?php echo $page_service->Estado->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Estado" class="<?php echo $page_service->Estado->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $page_service->SortUrl($page_service->Estado) ?>',1);"><div id="elh_page_service_Estado" class="page_service_Estado">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $page_service->Estado->caption() ?></span><span class="ew-table-header-sort"><?php if ($page_service->Estado->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($page_service->Estado->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$page_service_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($page_service->ExportAll && $page_service->isExport()) {
	$page_service_list->StopRec = $page_service_list->TotalRecs;
} else {

	// Set the last record to display
	if ($page_service_list->TotalRecs > $page_service_list->StartRec + $page_service_list->DisplayRecs - 1)
		$page_service_list->StopRec = $page_service_list->StartRec + $page_service_list->DisplayRecs - 1;
	else
		$page_service_list->StopRec = $page_service_list->TotalRecs;
}
$page_service_list->RecCnt = $page_service_list->StartRec - 1;
if ($page_service_list->Recordset && !$page_service_list->Recordset->EOF) {
	$page_service_list->Recordset->moveFirst();
	$selectLimit = $page_service_list->UseSelectLimit;
	if (!$selectLimit && $page_service_list->StartRec > 1)
		$page_service_list->Recordset->move($page_service_list->StartRec - 1);
} elseif (!$page_service->AllowAddDeleteRow && $page_service_list->StopRec == 0) {
	$page_service_list->StopRec = $page_service->GridAddRowCount;
}

// Initialize aggregate
$page_service->RowType = ROWTYPE_AGGREGATEINIT;
$page_service->resetAttributes();
$page_service_list->renderRow();
while ($page_service_list->RecCnt < $page_service_list->StopRec) {
	$page_service_list->RecCnt++;
	if ($page_service_list->RecCnt >= $page_service_list->StartRec) {
		$page_service_list->RowCnt++;

		// Set up key count
		$page_service_list->KeyCount = $page_service_list->RowIndex;

		// Init row class and style
		$page_service->resetAttributes();
		$page_service->CssClass = "";
		if ($page_service->isGridAdd()) {
		} else {
			$page_service_list->loadRowValues($page_service_list->Recordset); // Load row values
		}
		$page_service->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$page_service->RowAttrs = array_merge($page_service->RowAttrs, array('data-rowindex'=>$page_service_list->RowCnt, 'id'=>'r' . $page_service_list->RowCnt . '_page_service', 'data-rowtype'=>$page_service->RowType));

		// Render row
		$page_service_list->renderRow();

		// Render list options
		$page_service_list->renderListOptions();
?>
	<tr<?php echo $page_service->rowAttributes() ?>>
<?php

// Render list options (body, left)
$page_service_list->ListOptions->render("body", "left", $page_service_list->RowCnt);
?>
	<?php if ($page_service->PageServiceID->Visible) { // PageServiceID ?>
		<td data-name="PageServiceID"<?php echo $page_service->PageServiceID->cellAttributes() ?>>
<span id="el<?php echo $page_service_list->RowCnt ?>_page_service_PageServiceID" class="page_service_PageServiceID">
<span<?php echo $page_service->PageServiceID->viewAttributes() ?>>
<?php echo $page_service->PageServiceID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($page_service->Titulo->Visible) { // Titulo ?>
		<td data-name="Titulo"<?php echo $page_service->Titulo->cellAttributes() ?>>
<span id="el<?php echo $page_service_list->RowCnt ?>_page_service_Titulo" class="page_service_Titulo">
<span<?php echo $page_service->Titulo->viewAttributes() ?>>
<?php echo $page_service->Titulo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($page_service->Icono->Visible) { // Icono ?>
		<td data-name="Icono"<?php echo $page_service->Icono->cellAttributes() ?>>
<span id="el<?php echo $page_service_list->RowCnt ?>_page_service_Icono" class="page_service_Icono">
<span>
<?php echo GetFileViewTag($page_service->Icono, $page_service->Icono->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($page_service->Imagen->Visible) { // Imagen ?>
		<td data-name="Imagen"<?php echo $page_service->Imagen->cellAttributes() ?>>
<span id="el<?php echo $page_service_list->RowCnt ?>_page_service_Imagen" class="page_service_Imagen">
<span<?php echo $page_service->Imagen->viewAttributes() ?>>
<?php echo $page_service->Imagen->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($page_service->Estado->Visible) { // Estado ?>
		<td data-name="Estado"<?php echo $page_service->Estado->cellAttributes() ?>>
<span id="el<?php echo $page_service_list->RowCnt ?>_page_service_Estado" class="page_service_Estado">
<span<?php echo $page_service->Estado->viewAttributes() ?>>
<?php echo $page_service->Estado->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$page_service_list->ListOptions->render("body", "right", $page_service_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$page_service->isGridAdd())
		$page_service_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$page_service->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($page_service_list->Recordset)
	$page_service_list->Recordset->Close();
?>
<?php if (!$page_service->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$page_service->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($page_service_list->Pager)) $page_service_list->Pager = new PrevNextPager($page_service_list->StartRec, $page_service_list->DisplayRecs, $page_service_list->TotalRecs, $page_service_list->AutoHidePager) ?>
<?php if ($page_service_list->Pager->RecordCount > 0 && $page_service_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($page_service_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $page_service_list->pageUrl() ?>start=<?php echo $page_service_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($page_service_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $page_service_list->pageUrl() ?>start=<?php echo $page_service_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $page_service_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($page_service_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $page_service_list->pageUrl() ?>start=<?php echo $page_service_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($page_service_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $page_service_list->pageUrl() ?>start=<?php echo $page_service_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $page_service_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($page_service_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $page_service_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $page_service_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $page_service_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($page_service_list->TotalRecs > 0 && (!$page_service_list->AutoHidePageSizeSelector || $page_service_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="page_service">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($page_service_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($page_service_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($page_service_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($page_service->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $page_service_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($page_service_list->TotalRecs == 0 && !$page_service->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $page_service_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$page_service_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$page_service->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$page_service_list->terminate();
?>