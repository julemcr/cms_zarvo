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
$ciudades_list = new ciudades_list();

// Run the page
$ciudades_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ciudades_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$ciudades->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fciudadeslist = currentForm = new ew.Form("fciudadeslist", "list");
fciudadeslist.formKeyCountName = '<?php echo $ciudades_list->FormKeyCountName ?>';

// Form_CustomValidate event
fciudadeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fciudadeslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fciudadeslistsrch = currentSearchForm = new ew.Form("fciudadeslistsrch");

// Filters
fciudadeslistsrch.filterList = <?php echo $ciudades_list->getFilterList() ?>;
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
<?php if (!$ciudades->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ciudades_list->TotalRecs > 0 && $ciudades_list->ExportOptions->visible()) { ?>
<?php $ciudades_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ciudades_list->ImportOptions->visible()) { ?>
<?php $ciudades_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ciudades_list->SearchOptions->visible()) { ?>
<?php $ciudades_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ciudades_list->FilterOptions->visible()) { ?>
<?php $ciudades_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ciudades_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ciudades->isExport() && !$ciudades->CurrentAction) { ?>
<form name="fciudadeslistsrch" id="fciudadeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($ciudades_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fciudadeslistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ciudades">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($ciudades_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($ciudades_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ciudades_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ciudades_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ciudades_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ciudades_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ciudades_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $ciudades_list->showPageHeader(); ?>
<?php
$ciudades_list->showMessage();
?>
<?php if ($ciudades_list->TotalRecs > 0 || $ciudades->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ciudades_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ciudades">
<?php if (!$ciudades->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ciudades->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($ciudades_list->Pager)) $ciudades_list->Pager = new PrevNextPager($ciudades_list->StartRec, $ciudades_list->DisplayRecs, $ciudades_list->TotalRecs, $ciudades_list->AutoHidePager) ?>
<?php if ($ciudades_list->Pager->RecordCount > 0 && $ciudades_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($ciudades_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $ciudades_list->pageUrl() ?>start=<?php echo $ciudades_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($ciudades_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $ciudades_list->pageUrl() ?>start=<?php echo $ciudades_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $ciudades_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($ciudades_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $ciudades_list->pageUrl() ?>start=<?php echo $ciudades_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($ciudades_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $ciudades_list->pageUrl() ?>start=<?php echo $ciudades_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $ciudades_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($ciudades_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $ciudades_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $ciudades_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $ciudades_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($ciudades_list->TotalRecs > 0 && (!$ciudades_list->AutoHidePageSizeSelector || $ciudades_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="ciudades">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($ciudades_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($ciudades_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($ciudades_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($ciudades->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ciudades_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fciudadeslist" id="fciudadeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ciudades_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ciudades_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ciudades">
<div id="gmp_ciudades" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($ciudades_list->TotalRecs > 0 || $ciudades->isGridEdit()) { ?>
<table id="tbl_ciudadeslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ciudades_list->RowType = ROWTYPE_HEADER;

// Render list options
$ciudades_list->renderListOptions();

// Render list options (header, left)
$ciudades_list->ListOptions->render("header", "left");
?>
<?php if ($ciudades->CiudadID->Visible) { // CiudadID ?>
	<?php if ($ciudades->sortUrl($ciudades->CiudadID) == "") { ?>
		<th data-name="CiudadID" class="<?php echo $ciudades->CiudadID->headerCellClass() ?>"><div id="elh_ciudades_CiudadID" class="ciudades_CiudadID"><div class="ew-table-header-caption"><?php echo $ciudades->CiudadID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CiudadID" class="<?php echo $ciudades->CiudadID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ciudades->SortUrl($ciudades->CiudadID) ?>',1);"><div id="elh_ciudades_CiudadID" class="ciudades_CiudadID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ciudades->CiudadID->caption() ?></span><span class="ew-table-header-sort"><?php if ($ciudades->CiudadID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ciudades->CiudadID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ciudades->Paises_Codigo->Visible) { // Paises_Codigo ?>
	<?php if ($ciudades->sortUrl($ciudades->Paises_Codigo) == "") { ?>
		<th data-name="Paises_Codigo" class="<?php echo $ciudades->Paises_Codigo->headerCellClass() ?>"><div id="elh_ciudades_Paises_Codigo" class="ciudades_Paises_Codigo"><div class="ew-table-header-caption"><?php echo $ciudades->Paises_Codigo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Paises_Codigo" class="<?php echo $ciudades->Paises_Codigo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ciudades->SortUrl($ciudades->Paises_Codigo) ?>',1);"><div id="elh_ciudades_Paises_Codigo" class="ciudades_Paises_Codigo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ciudades->Paises_Codigo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ciudades->Paises_Codigo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ciudades->Paises_Codigo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ciudades->Ciudad->Visible) { // Ciudad ?>
	<?php if ($ciudades->sortUrl($ciudades->Ciudad) == "") { ?>
		<th data-name="Ciudad" class="<?php echo $ciudades->Ciudad->headerCellClass() ?>"><div id="elh_ciudades_Ciudad" class="ciudades_Ciudad"><div class="ew-table-header-caption"><?php echo $ciudades->Ciudad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Ciudad" class="<?php echo $ciudades->Ciudad->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $ciudades->SortUrl($ciudades->Ciudad) ?>',1);"><div id="elh_ciudades_Ciudad" class="ciudades_Ciudad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ciudades->Ciudad->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ciudades->Ciudad->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($ciudades->Ciudad->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ciudades_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ciudades->ExportAll && $ciudades->isExport()) {
	$ciudades_list->StopRec = $ciudades_list->TotalRecs;
} else {

	// Set the last record to display
	if ($ciudades_list->TotalRecs > $ciudades_list->StartRec + $ciudades_list->DisplayRecs - 1)
		$ciudades_list->StopRec = $ciudades_list->StartRec + $ciudades_list->DisplayRecs - 1;
	else
		$ciudades_list->StopRec = $ciudades_list->TotalRecs;
}
$ciudades_list->RecCnt = $ciudades_list->StartRec - 1;
if ($ciudades_list->Recordset && !$ciudades_list->Recordset->EOF) {
	$ciudades_list->Recordset->moveFirst();
	$selectLimit = $ciudades_list->UseSelectLimit;
	if (!$selectLimit && $ciudades_list->StartRec > 1)
		$ciudades_list->Recordset->move($ciudades_list->StartRec - 1);
} elseif (!$ciudades->AllowAddDeleteRow && $ciudades_list->StopRec == 0) {
	$ciudades_list->StopRec = $ciudades->GridAddRowCount;
}

// Initialize aggregate
$ciudades->RowType = ROWTYPE_AGGREGATEINIT;
$ciudades->resetAttributes();
$ciudades_list->renderRow();
while ($ciudades_list->RecCnt < $ciudades_list->StopRec) {
	$ciudades_list->RecCnt++;
	if ($ciudades_list->RecCnt >= $ciudades_list->StartRec) {
		$ciudades_list->RowCnt++;

		// Set up key count
		$ciudades_list->KeyCount = $ciudades_list->RowIndex;

		// Init row class and style
		$ciudades->resetAttributes();
		$ciudades->CssClass = "";
		if ($ciudades->isGridAdd()) {
		} else {
			$ciudades_list->loadRowValues($ciudades_list->Recordset); // Load row values
		}
		$ciudades->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ciudades->RowAttrs = array_merge($ciudades->RowAttrs, array('data-rowindex'=>$ciudades_list->RowCnt, 'id'=>'r' . $ciudades_list->RowCnt . '_ciudades', 'data-rowtype'=>$ciudades->RowType));

		// Render row
		$ciudades_list->renderRow();

		// Render list options
		$ciudades_list->renderListOptions();
?>
	<tr<?php echo $ciudades->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ciudades_list->ListOptions->render("body", "left", $ciudades_list->RowCnt);
?>
	<?php if ($ciudades->CiudadID->Visible) { // CiudadID ?>
		<td data-name="CiudadID"<?php echo $ciudades->CiudadID->cellAttributes() ?>>
<span id="el<?php echo $ciudades_list->RowCnt ?>_ciudades_CiudadID" class="ciudades_CiudadID">
<span<?php echo $ciudades->CiudadID->viewAttributes() ?>>
<?php echo $ciudades->CiudadID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ciudades->Paises_Codigo->Visible) { // Paises_Codigo ?>
		<td data-name="Paises_Codigo"<?php echo $ciudades->Paises_Codigo->cellAttributes() ?>>
<span id="el<?php echo $ciudades_list->RowCnt ?>_ciudades_Paises_Codigo" class="ciudades_Paises_Codigo">
<span<?php echo $ciudades->Paises_Codigo->viewAttributes() ?>>
<?php echo $ciudades->Paises_Codigo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ciudades->Ciudad->Visible) { // Ciudad ?>
		<td data-name="Ciudad"<?php echo $ciudades->Ciudad->cellAttributes() ?>>
<span id="el<?php echo $ciudades_list->RowCnt ?>_ciudades_Ciudad" class="ciudades_Ciudad">
<span<?php echo $ciudades->Ciudad->viewAttributes() ?>>
<?php echo $ciudades->Ciudad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ciudades_list->ListOptions->render("body", "right", $ciudades_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$ciudades->isGridAdd())
		$ciudades_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$ciudades->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ciudades_list->Recordset)
	$ciudades_list->Recordset->Close();
?>
<?php if (!$ciudades->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ciudades->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($ciudades_list->Pager)) $ciudades_list->Pager = new PrevNextPager($ciudades_list->StartRec, $ciudades_list->DisplayRecs, $ciudades_list->TotalRecs, $ciudades_list->AutoHidePager) ?>
<?php if ($ciudades_list->Pager->RecordCount > 0 && $ciudades_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($ciudades_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $ciudades_list->pageUrl() ?>start=<?php echo $ciudades_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($ciudades_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $ciudades_list->pageUrl() ?>start=<?php echo $ciudades_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $ciudades_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($ciudades_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $ciudades_list->pageUrl() ?>start=<?php echo $ciudades_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($ciudades_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $ciudades_list->pageUrl() ?>start=<?php echo $ciudades_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $ciudades_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($ciudades_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $ciudades_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $ciudades_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $ciudades_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($ciudades_list->TotalRecs > 0 && (!$ciudades_list->AutoHidePageSizeSelector || $ciudades_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="ciudades">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($ciudades_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($ciudades_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($ciudades_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($ciudades->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ciudades_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ciudades_list->TotalRecs == 0 && !$ciudades->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ciudades_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ciudades_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$ciudades->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$ciudades_list->terminate();
?>