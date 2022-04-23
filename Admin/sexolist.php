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
$sexo_list = new sexo_list();

// Run the page
$sexo_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sexo_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$sexo->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fsexolist = currentForm = new ew.Form("fsexolist", "list");
fsexolist.formKeyCountName = '<?php echo $sexo_list->FormKeyCountName ?>';

// Form_CustomValidate event
fsexolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsexolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fsexolistsrch = currentSearchForm = new ew.Form("fsexolistsrch");

// Filters
fsexolistsrch.filterList = <?php echo $sexo_list->getFilterList() ?>;
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
<?php if (!$sexo->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($sexo_list->TotalRecs > 0 && $sexo_list->ExportOptions->visible()) { ?>
<?php $sexo_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($sexo_list->ImportOptions->visible()) { ?>
<?php $sexo_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($sexo_list->SearchOptions->visible()) { ?>
<?php $sexo_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($sexo_list->FilterOptions->visible()) { ?>
<?php $sexo_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$sexo_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$sexo->isExport() && !$sexo->CurrentAction) { ?>
<form name="fsexolistsrch" id="fsexolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($sexo_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fsexolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="sexo">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($sexo_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($sexo_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $sexo_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($sexo_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($sexo_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($sexo_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($sexo_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $sexo_list->showPageHeader(); ?>
<?php
$sexo_list->showMessage();
?>
<?php if ($sexo_list->TotalRecs > 0 || $sexo->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($sexo_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> sexo">
<?php if (!$sexo->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$sexo->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($sexo_list->Pager)) $sexo_list->Pager = new PrevNextPager($sexo_list->StartRec, $sexo_list->DisplayRecs, $sexo_list->TotalRecs, $sexo_list->AutoHidePager) ?>
<?php if ($sexo_list->Pager->RecordCount > 0 && $sexo_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($sexo_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $sexo_list->pageUrl() ?>start=<?php echo $sexo_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($sexo_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $sexo_list->pageUrl() ?>start=<?php echo $sexo_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $sexo_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($sexo_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $sexo_list->pageUrl() ?>start=<?php echo $sexo_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($sexo_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $sexo_list->pageUrl() ?>start=<?php echo $sexo_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $sexo_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($sexo_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $sexo_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $sexo_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $sexo_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($sexo_list->TotalRecs > 0 && (!$sexo_list->AutoHidePageSizeSelector || $sexo_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="sexo">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($sexo_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($sexo_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($sexo_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($sexo->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sexo_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsexolist" id="fsexolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($sexo_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $sexo_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sexo">
<div id="gmp_sexo" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($sexo_list->TotalRecs > 0 || $sexo->isGridEdit()) { ?>
<table id="tbl_sexolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$sexo_list->RowType = ROWTYPE_HEADER;

// Render list options
$sexo_list->renderListOptions();

// Render list options (header, left)
$sexo_list->ListOptions->render("header", "left");
?>
<?php if ($sexo->SexoID->Visible) { // SexoID ?>
	<?php if ($sexo->sortUrl($sexo->SexoID) == "") { ?>
		<th data-name="SexoID" class="<?php echo $sexo->SexoID->headerCellClass() ?>"><div id="elh_sexo_SexoID" class="sexo_SexoID"><div class="ew-table-header-caption"><?php echo $sexo->SexoID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SexoID" class="<?php echo $sexo->SexoID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $sexo->SortUrl($sexo->SexoID) ?>',1);"><div id="elh_sexo_SexoID" class="sexo_SexoID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sexo->SexoID->caption() ?></span><span class="ew-table-header-sort"><?php if ($sexo->SexoID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($sexo->SexoID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($sexo->Sexo->Visible) { // Sexo ?>
	<?php if ($sexo->sortUrl($sexo->Sexo) == "") { ?>
		<th data-name="Sexo" class="<?php echo $sexo->Sexo->headerCellClass() ?>"><div id="elh_sexo_Sexo" class="sexo_Sexo"><div class="ew-table-header-caption"><?php echo $sexo->Sexo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sexo" class="<?php echo $sexo->Sexo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $sexo->SortUrl($sexo->Sexo) ?>',1);"><div id="elh_sexo_Sexo" class="sexo_Sexo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sexo->Sexo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sexo->Sexo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($sexo->Sexo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$sexo_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($sexo->ExportAll && $sexo->isExport()) {
	$sexo_list->StopRec = $sexo_list->TotalRecs;
} else {

	// Set the last record to display
	if ($sexo_list->TotalRecs > $sexo_list->StartRec + $sexo_list->DisplayRecs - 1)
		$sexo_list->StopRec = $sexo_list->StartRec + $sexo_list->DisplayRecs - 1;
	else
		$sexo_list->StopRec = $sexo_list->TotalRecs;
}
$sexo_list->RecCnt = $sexo_list->StartRec - 1;
if ($sexo_list->Recordset && !$sexo_list->Recordset->EOF) {
	$sexo_list->Recordset->moveFirst();
	$selectLimit = $sexo_list->UseSelectLimit;
	if (!$selectLimit && $sexo_list->StartRec > 1)
		$sexo_list->Recordset->move($sexo_list->StartRec - 1);
} elseif (!$sexo->AllowAddDeleteRow && $sexo_list->StopRec == 0) {
	$sexo_list->StopRec = $sexo->GridAddRowCount;
}

// Initialize aggregate
$sexo->RowType = ROWTYPE_AGGREGATEINIT;
$sexo->resetAttributes();
$sexo_list->renderRow();
while ($sexo_list->RecCnt < $sexo_list->StopRec) {
	$sexo_list->RecCnt++;
	if ($sexo_list->RecCnt >= $sexo_list->StartRec) {
		$sexo_list->RowCnt++;

		// Set up key count
		$sexo_list->KeyCount = $sexo_list->RowIndex;

		// Init row class and style
		$sexo->resetAttributes();
		$sexo->CssClass = "";
		if ($sexo->isGridAdd()) {
		} else {
			$sexo_list->loadRowValues($sexo_list->Recordset); // Load row values
		}
		$sexo->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$sexo->RowAttrs = array_merge($sexo->RowAttrs, array('data-rowindex'=>$sexo_list->RowCnt, 'id'=>'r' . $sexo_list->RowCnt . '_sexo', 'data-rowtype'=>$sexo->RowType));

		// Render row
		$sexo_list->renderRow();

		// Render list options
		$sexo_list->renderListOptions();
?>
	<tr<?php echo $sexo->rowAttributes() ?>>
<?php

// Render list options (body, left)
$sexo_list->ListOptions->render("body", "left", $sexo_list->RowCnt);
?>
	<?php if ($sexo->SexoID->Visible) { // SexoID ?>
		<td data-name="SexoID"<?php echo $sexo->SexoID->cellAttributes() ?>>
<span id="el<?php echo $sexo_list->RowCnt ?>_sexo_SexoID" class="sexo_SexoID">
<span<?php echo $sexo->SexoID->viewAttributes() ?>>
<?php echo $sexo->SexoID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($sexo->Sexo->Visible) { // Sexo ?>
		<td data-name="Sexo"<?php echo $sexo->Sexo->cellAttributes() ?>>
<span id="el<?php echo $sexo_list->RowCnt ?>_sexo_Sexo" class="sexo_Sexo">
<span<?php echo $sexo->Sexo->viewAttributes() ?>>
<?php echo $sexo->Sexo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sexo_list->ListOptions->render("body", "right", $sexo_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$sexo->isGridAdd())
		$sexo_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$sexo->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($sexo_list->Recordset)
	$sexo_list->Recordset->Close();
?>
<?php if (!$sexo->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$sexo->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($sexo_list->Pager)) $sexo_list->Pager = new PrevNextPager($sexo_list->StartRec, $sexo_list->DisplayRecs, $sexo_list->TotalRecs, $sexo_list->AutoHidePager) ?>
<?php if ($sexo_list->Pager->RecordCount > 0 && $sexo_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($sexo_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $sexo_list->pageUrl() ?>start=<?php echo $sexo_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($sexo_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $sexo_list->pageUrl() ?>start=<?php echo $sexo_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $sexo_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($sexo_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $sexo_list->pageUrl() ?>start=<?php echo $sexo_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($sexo_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $sexo_list->pageUrl() ?>start=<?php echo $sexo_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $sexo_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($sexo_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $sexo_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $sexo_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $sexo_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($sexo_list->TotalRecs > 0 && (!$sexo_list->AutoHidePageSizeSelector || $sexo_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="sexo">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($sexo_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($sexo_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($sexo_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($sexo->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sexo_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($sexo_list->TotalRecs == 0 && !$sexo->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $sexo_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$sexo_list->showPageFooter();
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
$sexo_list->terminate();
?>