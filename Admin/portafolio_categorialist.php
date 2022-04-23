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
$portafolio_categoria_list = new portafolio_categoria_list();

// Run the page
$portafolio_categoria_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$portafolio_categoria_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$portafolio_categoria->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fportafolio_categorialist = currentForm = new ew.Form("fportafolio_categorialist", "list");
fportafolio_categorialist.formKeyCountName = '<?php echo $portafolio_categoria_list->FormKeyCountName ?>';

// Form_CustomValidate event
fportafolio_categorialist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fportafolio_categorialist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fportafolio_categorialistsrch = currentSearchForm = new ew.Form("fportafolio_categorialistsrch");

// Filters
fportafolio_categorialistsrch.filterList = <?php echo $portafolio_categoria_list->getFilterList() ?>;
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
<?php if (!$portafolio_categoria->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($portafolio_categoria_list->TotalRecs > 0 && $portafolio_categoria_list->ExportOptions->visible()) { ?>
<?php $portafolio_categoria_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($portafolio_categoria_list->ImportOptions->visible()) { ?>
<?php $portafolio_categoria_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($portafolio_categoria_list->SearchOptions->visible()) { ?>
<?php $portafolio_categoria_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($portafolio_categoria_list->FilterOptions->visible()) { ?>
<?php $portafolio_categoria_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$portafolio_categoria_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$portafolio_categoria->isExport() && !$portafolio_categoria->CurrentAction) { ?>
<form name="fportafolio_categorialistsrch" id="fportafolio_categorialistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($portafolio_categoria_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fportafolio_categorialistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="portafolio_categoria">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($portafolio_categoria_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($portafolio_categoria_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $portafolio_categoria_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($portafolio_categoria_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($portafolio_categoria_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($portafolio_categoria_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($portafolio_categoria_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $portafolio_categoria_list->showPageHeader(); ?>
<?php
$portafolio_categoria_list->showMessage();
?>
<?php if ($portafolio_categoria_list->TotalRecs > 0 || $portafolio_categoria->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($portafolio_categoria_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> portafolio_categoria">
<?php if (!$portafolio_categoria->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$portafolio_categoria->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($portafolio_categoria_list->Pager)) $portafolio_categoria_list->Pager = new PrevNextPager($portafolio_categoria_list->StartRec, $portafolio_categoria_list->DisplayRecs, $portafolio_categoria_list->TotalRecs, $portafolio_categoria_list->AutoHidePager) ?>
<?php if ($portafolio_categoria_list->Pager->RecordCount > 0 && $portafolio_categoria_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($portafolio_categoria_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $portafolio_categoria_list->pageUrl() ?>start=<?php echo $portafolio_categoria_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($portafolio_categoria_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $portafolio_categoria_list->pageUrl() ?>start=<?php echo $portafolio_categoria_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $portafolio_categoria_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($portafolio_categoria_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $portafolio_categoria_list->pageUrl() ?>start=<?php echo $portafolio_categoria_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($portafolio_categoria_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $portafolio_categoria_list->pageUrl() ?>start=<?php echo $portafolio_categoria_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $portafolio_categoria_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($portafolio_categoria_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $portafolio_categoria_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $portafolio_categoria_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $portafolio_categoria_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($portafolio_categoria_list->TotalRecs > 0 && (!$portafolio_categoria_list->AutoHidePageSizeSelector || $portafolio_categoria_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="portafolio_categoria">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($portafolio_categoria_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($portafolio_categoria_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($portafolio_categoria_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($portafolio_categoria->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $portafolio_categoria_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fportafolio_categorialist" id="fportafolio_categorialist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($portafolio_categoria_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $portafolio_categoria_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="portafolio_categoria">
<div id="gmp_portafolio_categoria" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($portafolio_categoria_list->TotalRecs > 0 || $portafolio_categoria->isGridEdit()) { ?>
<table id="tbl_portafolio_categorialist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$portafolio_categoria_list->RowType = ROWTYPE_HEADER;

// Render list options
$portafolio_categoria_list->renderListOptions();

// Render list options (header, left)
$portafolio_categoria_list->ListOptions->render("header", "left");
?>
<?php if ($portafolio_categoria->PortafolioCategoriaID->Visible) { // PortafolioCategoriaID ?>
	<?php if ($portafolio_categoria->sortUrl($portafolio_categoria->PortafolioCategoriaID) == "") { ?>
		<th data-name="PortafolioCategoriaID" class="<?php echo $portafolio_categoria->PortafolioCategoriaID->headerCellClass() ?>"><div id="elh_portafolio_categoria_PortafolioCategoriaID" class="portafolio_categoria_PortafolioCategoriaID"><div class="ew-table-header-caption"><?php echo $portafolio_categoria->PortafolioCategoriaID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PortafolioCategoriaID" class="<?php echo $portafolio_categoria->PortafolioCategoriaID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $portafolio_categoria->SortUrl($portafolio_categoria->PortafolioCategoriaID) ?>',1);"><div id="elh_portafolio_categoria_PortafolioCategoriaID" class="portafolio_categoria_PortafolioCategoriaID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $portafolio_categoria->PortafolioCategoriaID->caption() ?></span><span class="ew-table-header-sort"><?php if ($portafolio_categoria->PortafolioCategoriaID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($portafolio_categoria->PortafolioCategoriaID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($portafolio_categoria->Categoria->Visible) { // Categoria ?>
	<?php if ($portafolio_categoria->sortUrl($portafolio_categoria->Categoria) == "") { ?>
		<th data-name="Categoria" class="<?php echo $portafolio_categoria->Categoria->headerCellClass() ?>"><div id="elh_portafolio_categoria_Categoria" class="portafolio_categoria_Categoria"><div class="ew-table-header-caption"><?php echo $portafolio_categoria->Categoria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Categoria" class="<?php echo $portafolio_categoria->Categoria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $portafolio_categoria->SortUrl($portafolio_categoria->Categoria) ?>',1);"><div id="elh_portafolio_categoria_Categoria" class="portafolio_categoria_Categoria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $portafolio_categoria->Categoria->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($portafolio_categoria->Categoria->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($portafolio_categoria->Categoria->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$portafolio_categoria_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($portafolio_categoria->ExportAll && $portafolio_categoria->isExport()) {
	$portafolio_categoria_list->StopRec = $portafolio_categoria_list->TotalRecs;
} else {

	// Set the last record to display
	if ($portafolio_categoria_list->TotalRecs > $portafolio_categoria_list->StartRec + $portafolio_categoria_list->DisplayRecs - 1)
		$portafolio_categoria_list->StopRec = $portafolio_categoria_list->StartRec + $portafolio_categoria_list->DisplayRecs - 1;
	else
		$portafolio_categoria_list->StopRec = $portafolio_categoria_list->TotalRecs;
}
$portafolio_categoria_list->RecCnt = $portafolio_categoria_list->StartRec - 1;
if ($portafolio_categoria_list->Recordset && !$portafolio_categoria_list->Recordset->EOF) {
	$portafolio_categoria_list->Recordset->moveFirst();
	$selectLimit = $portafolio_categoria_list->UseSelectLimit;
	if (!$selectLimit && $portafolio_categoria_list->StartRec > 1)
		$portafolio_categoria_list->Recordset->move($portafolio_categoria_list->StartRec - 1);
} elseif (!$portafolio_categoria->AllowAddDeleteRow && $portafolio_categoria_list->StopRec == 0) {
	$portafolio_categoria_list->StopRec = $portafolio_categoria->GridAddRowCount;
}

// Initialize aggregate
$portafolio_categoria->RowType = ROWTYPE_AGGREGATEINIT;
$portafolio_categoria->resetAttributes();
$portafolio_categoria_list->renderRow();
while ($portafolio_categoria_list->RecCnt < $portafolio_categoria_list->StopRec) {
	$portafolio_categoria_list->RecCnt++;
	if ($portafolio_categoria_list->RecCnt >= $portafolio_categoria_list->StartRec) {
		$portafolio_categoria_list->RowCnt++;

		// Set up key count
		$portafolio_categoria_list->KeyCount = $portafolio_categoria_list->RowIndex;

		// Init row class and style
		$portafolio_categoria->resetAttributes();
		$portafolio_categoria->CssClass = "";
		if ($portafolio_categoria->isGridAdd()) {
		} else {
			$portafolio_categoria_list->loadRowValues($portafolio_categoria_list->Recordset); // Load row values
		}
		$portafolio_categoria->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$portafolio_categoria->RowAttrs = array_merge($portafolio_categoria->RowAttrs, array('data-rowindex'=>$portafolio_categoria_list->RowCnt, 'id'=>'r' . $portafolio_categoria_list->RowCnt . '_portafolio_categoria', 'data-rowtype'=>$portafolio_categoria->RowType));

		// Render row
		$portafolio_categoria_list->renderRow();

		// Render list options
		$portafolio_categoria_list->renderListOptions();
?>
	<tr<?php echo $portafolio_categoria->rowAttributes() ?>>
<?php

// Render list options (body, left)
$portafolio_categoria_list->ListOptions->render("body", "left", $portafolio_categoria_list->RowCnt);
?>
	<?php if ($portafolio_categoria->PortafolioCategoriaID->Visible) { // PortafolioCategoriaID ?>
		<td data-name="PortafolioCategoriaID"<?php echo $portafolio_categoria->PortafolioCategoriaID->cellAttributes() ?>>
<span id="el<?php echo $portafolio_categoria_list->RowCnt ?>_portafolio_categoria_PortafolioCategoriaID" class="portafolio_categoria_PortafolioCategoriaID">
<span<?php echo $portafolio_categoria->PortafolioCategoriaID->viewAttributes() ?>>
<?php echo $portafolio_categoria->PortafolioCategoriaID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($portafolio_categoria->Categoria->Visible) { // Categoria ?>
		<td data-name="Categoria"<?php echo $portafolio_categoria->Categoria->cellAttributes() ?>>
<span id="el<?php echo $portafolio_categoria_list->RowCnt ?>_portafolio_categoria_Categoria" class="portafolio_categoria_Categoria">
<span<?php echo $portafolio_categoria->Categoria->viewAttributes() ?>>
<?php echo $portafolio_categoria->Categoria->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$portafolio_categoria_list->ListOptions->render("body", "right", $portafolio_categoria_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$portafolio_categoria->isGridAdd())
		$portafolio_categoria_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$portafolio_categoria->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($portafolio_categoria_list->Recordset)
	$portafolio_categoria_list->Recordset->Close();
?>
<?php if (!$portafolio_categoria->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$portafolio_categoria->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($portafolio_categoria_list->Pager)) $portafolio_categoria_list->Pager = new PrevNextPager($portafolio_categoria_list->StartRec, $portafolio_categoria_list->DisplayRecs, $portafolio_categoria_list->TotalRecs, $portafolio_categoria_list->AutoHidePager) ?>
<?php if ($portafolio_categoria_list->Pager->RecordCount > 0 && $portafolio_categoria_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($portafolio_categoria_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $portafolio_categoria_list->pageUrl() ?>start=<?php echo $portafolio_categoria_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($portafolio_categoria_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $portafolio_categoria_list->pageUrl() ?>start=<?php echo $portafolio_categoria_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $portafolio_categoria_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($portafolio_categoria_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $portafolio_categoria_list->pageUrl() ?>start=<?php echo $portafolio_categoria_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($portafolio_categoria_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $portafolio_categoria_list->pageUrl() ?>start=<?php echo $portafolio_categoria_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $portafolio_categoria_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($portafolio_categoria_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $portafolio_categoria_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $portafolio_categoria_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $portafolio_categoria_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($portafolio_categoria_list->TotalRecs > 0 && (!$portafolio_categoria_list->AutoHidePageSizeSelector || $portafolio_categoria_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="portafolio_categoria">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($portafolio_categoria_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($portafolio_categoria_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($portafolio_categoria_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($portafolio_categoria->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $portafolio_categoria_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($portafolio_categoria_list->TotalRecs == 0 && !$portafolio_categoria->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $portafolio_categoria_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$portafolio_categoria_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$portafolio_categoria->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$portafolio_categoria_list->terminate();
?>