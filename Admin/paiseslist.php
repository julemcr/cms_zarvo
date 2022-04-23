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
$paises_list = new paises_list();

// Run the page
$paises_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$paises_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$paises->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fpaiseslist = currentForm = new ew.Form("fpaiseslist", "list");
fpaiseslist.formKeyCountName = '<?php echo $paises_list->FormKeyCountName ?>';

// Form_CustomValidate event
fpaiseslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpaiseslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fpaiseslistsrch = currentSearchForm = new ew.Form("fpaiseslistsrch");

// Filters
fpaiseslistsrch.filterList = <?php echo $paises_list->getFilterList() ?>;
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
<?php if (!$paises->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($paises_list->TotalRecs > 0 && $paises_list->ExportOptions->visible()) { ?>
<?php $paises_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($paises_list->ImportOptions->visible()) { ?>
<?php $paises_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($paises_list->SearchOptions->visible()) { ?>
<?php $paises_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($paises_list->FilterOptions->visible()) { ?>
<?php $paises_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$paises_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$paises->isExport() && !$paises->CurrentAction) { ?>
<form name="fpaiseslistsrch" id="fpaiseslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($paises_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fpaiseslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="paises">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($paises_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($paises_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $paises_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($paises_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($paises_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($paises_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($paises_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $paises_list->showPageHeader(); ?>
<?php
$paises_list->showMessage();
?>
<?php if ($paises_list->TotalRecs > 0 || $paises->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($paises_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> paises">
<?php if (!$paises->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$paises->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($paises_list->Pager)) $paises_list->Pager = new PrevNextPager($paises_list->StartRec, $paises_list->DisplayRecs, $paises_list->TotalRecs, $paises_list->AutoHidePager) ?>
<?php if ($paises_list->Pager->RecordCount > 0 && $paises_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($paises_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $paises_list->pageUrl() ?>start=<?php echo $paises_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($paises_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $paises_list->pageUrl() ?>start=<?php echo $paises_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $paises_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($paises_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $paises_list->pageUrl() ?>start=<?php echo $paises_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($paises_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $paises_list->pageUrl() ?>start=<?php echo $paises_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $paises_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($paises_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $paises_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $paises_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $paises_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($paises_list->TotalRecs > 0 && (!$paises_list->AutoHidePageSizeSelector || $paises_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="paises">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($paises_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($paises_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($paises_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($paises->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $paises_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpaiseslist" id="fpaiseslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($paises_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $paises_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="paises">
<div id="gmp_paises" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($paises_list->TotalRecs > 0 || $paises->isGridEdit()) { ?>
<table id="tbl_paiseslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$paises_list->RowType = ROWTYPE_HEADER;

// Render list options
$paises_list->renderListOptions();

// Render list options (header, left)
$paises_list->ListOptions->render("header", "left");
?>
<?php if ($paises->Codigo->Visible) { // Codigo ?>
	<?php if ($paises->sortUrl($paises->Codigo) == "") { ?>
		<th data-name="Codigo" class="<?php echo $paises->Codigo->headerCellClass() ?>"><div id="elh_paises_Codigo" class="paises_Codigo"><div class="ew-table-header-caption"><?php echo $paises->Codigo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Codigo" class="<?php echo $paises->Codigo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $paises->SortUrl($paises->Codigo) ?>',1);"><div id="elh_paises_Codigo" class="paises_Codigo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paises->Codigo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paises->Codigo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($paises->Codigo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paises->Pais->Visible) { // Pais ?>
	<?php if ($paises->sortUrl($paises->Pais) == "") { ?>
		<th data-name="Pais" class="<?php echo $paises->Pais->headerCellClass() ?>"><div id="elh_paises_Pais" class="paises_Pais"><div class="ew-table-header-caption"><?php echo $paises->Pais->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Pais" class="<?php echo $paises->Pais->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $paises->SortUrl($paises->Pais) ?>',1);"><div id="elh_paises_Pais" class="paises_Pais">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paises->Pais->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paises->Pais->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($paises->Pais->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$paises_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($paises->ExportAll && $paises->isExport()) {
	$paises_list->StopRec = $paises_list->TotalRecs;
} else {

	// Set the last record to display
	if ($paises_list->TotalRecs > $paises_list->StartRec + $paises_list->DisplayRecs - 1)
		$paises_list->StopRec = $paises_list->StartRec + $paises_list->DisplayRecs - 1;
	else
		$paises_list->StopRec = $paises_list->TotalRecs;
}
$paises_list->RecCnt = $paises_list->StartRec - 1;
if ($paises_list->Recordset && !$paises_list->Recordset->EOF) {
	$paises_list->Recordset->moveFirst();
	$selectLimit = $paises_list->UseSelectLimit;
	if (!$selectLimit && $paises_list->StartRec > 1)
		$paises_list->Recordset->move($paises_list->StartRec - 1);
} elseif (!$paises->AllowAddDeleteRow && $paises_list->StopRec == 0) {
	$paises_list->StopRec = $paises->GridAddRowCount;
}

// Initialize aggregate
$paises->RowType = ROWTYPE_AGGREGATEINIT;
$paises->resetAttributes();
$paises_list->renderRow();
while ($paises_list->RecCnt < $paises_list->StopRec) {
	$paises_list->RecCnt++;
	if ($paises_list->RecCnt >= $paises_list->StartRec) {
		$paises_list->RowCnt++;

		// Set up key count
		$paises_list->KeyCount = $paises_list->RowIndex;

		// Init row class and style
		$paises->resetAttributes();
		$paises->CssClass = "";
		if ($paises->isGridAdd()) {
		} else {
			$paises_list->loadRowValues($paises_list->Recordset); // Load row values
		}
		$paises->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$paises->RowAttrs = array_merge($paises->RowAttrs, array('data-rowindex'=>$paises_list->RowCnt, 'id'=>'r' . $paises_list->RowCnt . '_paises', 'data-rowtype'=>$paises->RowType));

		// Render row
		$paises_list->renderRow();

		// Render list options
		$paises_list->renderListOptions();
?>
	<tr<?php echo $paises->rowAttributes() ?>>
<?php

// Render list options (body, left)
$paises_list->ListOptions->render("body", "left", $paises_list->RowCnt);
?>
	<?php if ($paises->Codigo->Visible) { // Codigo ?>
		<td data-name="Codigo"<?php echo $paises->Codigo->cellAttributes() ?>>
<span id="el<?php echo $paises_list->RowCnt ?>_paises_Codigo" class="paises_Codigo">
<span<?php echo $paises->Codigo->viewAttributes() ?>>
<?php echo $paises->Codigo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paises->Pais->Visible) { // Pais ?>
		<td data-name="Pais"<?php echo $paises->Pais->cellAttributes() ?>>
<span id="el<?php echo $paises_list->RowCnt ?>_paises_Pais" class="paises_Pais">
<span<?php echo $paises->Pais->viewAttributes() ?>>
<?php echo $paises->Pais->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$paises_list->ListOptions->render("body", "right", $paises_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$paises->isGridAdd())
		$paises_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$paises->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($paises_list->Recordset)
	$paises_list->Recordset->Close();
?>
<?php if (!$paises->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$paises->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($paises_list->Pager)) $paises_list->Pager = new PrevNextPager($paises_list->StartRec, $paises_list->DisplayRecs, $paises_list->TotalRecs, $paises_list->AutoHidePager) ?>
<?php if ($paises_list->Pager->RecordCount > 0 && $paises_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($paises_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $paises_list->pageUrl() ?>start=<?php echo $paises_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($paises_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $paises_list->pageUrl() ?>start=<?php echo $paises_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $paises_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($paises_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $paises_list->pageUrl() ?>start=<?php echo $paises_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($paises_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $paises_list->pageUrl() ?>start=<?php echo $paises_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $paises_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($paises_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $paises_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $paises_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $paises_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($paises_list->TotalRecs > 0 && (!$paises_list->AutoHidePageSizeSelector || $paises_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="paises">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($paises_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($paises_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($paises_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($paises->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $paises_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($paises_list->TotalRecs == 0 && !$paises->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $paises_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$paises_list->showPageFooter();
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
$paises_list->terminate();
?>