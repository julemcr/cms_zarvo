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
$setting_cms_list = new setting_cms_list();

// Run the page
$setting_cms_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$setting_cms_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$setting_cms->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fsetting_cmslist = currentForm = new ew.Form("fsetting_cmslist", "list");
fsetting_cmslist.formKeyCountName = '<?php echo $setting_cms_list->FormKeyCountName ?>';

// Form_CustomValidate event
fsetting_cmslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsetting_cmslist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fsetting_cmslist.lists["x_seccion_slider[]"] = <?php echo $setting_cms_list->seccion_slider->Lookup->toClientList() ?>;
fsetting_cmslist.lists["x_seccion_slider[]"].options = <?php echo JsonEncode($setting_cms_list->seccion_slider->options(FALSE, TRUE)) ?>;
fsetting_cmslist.lists["x_seccion_about[]"] = <?php echo $setting_cms_list->seccion_about->Lookup->toClientList() ?>;
fsetting_cmslist.lists["x_seccion_about[]"].options = <?php echo JsonEncode($setting_cms_list->seccion_about->options(FALSE, TRUE)) ?>;
fsetting_cmslist.lists["x_seccion_service[]"] = <?php echo $setting_cms_list->seccion_service->Lookup->toClientList() ?>;
fsetting_cmslist.lists["x_seccion_service[]"].options = <?php echo JsonEncode($setting_cms_list->seccion_service->options(FALSE, TRUE)) ?>;
fsetting_cmslist.lists["x_seccion_publicitaria[]"] = <?php echo $setting_cms_list->seccion_publicitaria->Lookup->toClientList() ?>;
fsetting_cmslist.lists["x_seccion_publicitaria[]"].options = <?php echo JsonEncode($setting_cms_list->seccion_publicitaria->options(FALSE, TRUE)) ?>;
fsetting_cmslist.lists["x_seccion_portfolio[]"] = <?php echo $setting_cms_list->seccion_portfolio->Lookup->toClientList() ?>;
fsetting_cmslist.lists["x_seccion_portfolio[]"].options = <?php echo JsonEncode($setting_cms_list->seccion_portfolio->options(FALSE, TRUE)) ?>;
fsetting_cmslist.lists["x_seccion_app[]"] = <?php echo $setting_cms_list->seccion_app->Lookup->toClientList() ?>;
fsetting_cmslist.lists["x_seccion_app[]"].options = <?php echo JsonEncode($setting_cms_list->seccion_app->options(FALSE, TRUE)) ?>;
fsetting_cmslist.lists["x_cookies_ley[]"] = <?php echo $setting_cms_list->cookies_ley->Lookup->toClientList() ?>;
fsetting_cmslist.lists["x_cookies_ley[]"].options = <?php echo JsonEncode($setting_cms_list->cookies_ley->options(FALSE, TRUE)) ?>;
fsetting_cmslist.lists["x_seccion_contact[]"] = <?php echo $setting_cms_list->seccion_contact->Lookup->toClientList() ?>;
fsetting_cmslist.lists["x_seccion_contact[]"].options = <?php echo JsonEncode($setting_cms_list->seccion_contact->options(FALSE, TRUE)) ?>;
fsetting_cmslist.lists["x_seccion_menufooter[]"] = <?php echo $setting_cms_list->seccion_menufooter->Lookup->toClientList() ?>;
fsetting_cmslist.lists["x_seccion_menufooter[]"].options = <?php echo JsonEncode($setting_cms_list->seccion_menufooter->options(FALSE, TRUE)) ?>;

// Form object for search
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
<?php if (!$setting_cms->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($setting_cms_list->TotalRecs > 0 && $setting_cms_list->ExportOptions->visible()) { ?>
<?php $setting_cms_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($setting_cms_list->ImportOptions->visible()) { ?>
<?php $setting_cms_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$setting_cms_list->renderOtherOptions();
?>
<?php $setting_cms_list->showPageHeader(); ?>
<?php
$setting_cms_list->showMessage();
?>
<?php if ($setting_cms_list->TotalRecs > 0 || $setting_cms->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($setting_cms_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> setting_cms">
<?php if (!$setting_cms->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$setting_cms->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($setting_cms_list->Pager)) $setting_cms_list->Pager = new PrevNextPager($setting_cms_list->StartRec, $setting_cms_list->DisplayRecs, $setting_cms_list->TotalRecs, $setting_cms_list->AutoHidePager) ?>
<?php if ($setting_cms_list->Pager->RecordCount > 0 && $setting_cms_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($setting_cms_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $setting_cms_list->pageUrl() ?>start=<?php echo $setting_cms_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($setting_cms_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $setting_cms_list->pageUrl() ?>start=<?php echo $setting_cms_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $setting_cms_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($setting_cms_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $setting_cms_list->pageUrl() ?>start=<?php echo $setting_cms_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($setting_cms_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $setting_cms_list->pageUrl() ?>start=<?php echo $setting_cms_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $setting_cms_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($setting_cms_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $setting_cms_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $setting_cms_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $setting_cms_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($setting_cms_list->TotalRecs > 0 && (!$setting_cms_list->AutoHidePageSizeSelector || $setting_cms_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="setting_cms">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($setting_cms_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($setting_cms_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($setting_cms_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($setting_cms->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $setting_cms_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsetting_cmslist" id="fsetting_cmslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($setting_cms_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $setting_cms_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="setting_cms">
<div id="gmp_setting_cms" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($setting_cms_list->TotalRecs > 0 || $setting_cms->isGridEdit()) { ?>
<table id="tbl_setting_cmslist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$setting_cms_list->RowType = ROWTYPE_HEADER;

// Render list options
$setting_cms_list->renderListOptions();

// Render list options (header, left)
$setting_cms_list->ListOptions->render("header", "left");
?>
<?php if ($setting_cms->SettingcmsID->Visible) { // SettingcmsID ?>
	<?php if ($setting_cms->sortUrl($setting_cms->SettingcmsID) == "") { ?>
		<th data-name="SettingcmsID" class="<?php echo $setting_cms->SettingcmsID->headerCellClass() ?>"><div id="elh_setting_cms_SettingcmsID" class="setting_cms_SettingcmsID"><div class="ew-table-header-caption"><?php echo $setting_cms->SettingcmsID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SettingcmsID" class="<?php echo $setting_cms->SettingcmsID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->SettingcmsID) ?>',1);"><div id="elh_setting_cms_SettingcmsID" class="setting_cms_SettingcmsID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->SettingcmsID->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->SettingcmsID->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->SettingcmsID->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->seccion_slider->Visible) { // seccion_slider ?>
	<?php if ($setting_cms->sortUrl($setting_cms->seccion_slider) == "") { ?>
		<th data-name="seccion_slider" class="<?php echo $setting_cms->seccion_slider->headerCellClass() ?>"><div id="elh_setting_cms_seccion_slider" class="setting_cms_seccion_slider"><div class="ew-table-header-caption"><?php echo $setting_cms->seccion_slider->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="seccion_slider" class="<?php echo $setting_cms->seccion_slider->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->seccion_slider) ?>',1);"><div id="elh_setting_cms_seccion_slider" class="setting_cms_seccion_slider">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->seccion_slider->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->seccion_slider->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->seccion_slider->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->seccion_about->Visible) { // seccion_about ?>
	<?php if ($setting_cms->sortUrl($setting_cms->seccion_about) == "") { ?>
		<th data-name="seccion_about" class="<?php echo $setting_cms->seccion_about->headerCellClass() ?>"><div id="elh_setting_cms_seccion_about" class="setting_cms_seccion_about"><div class="ew-table-header-caption"><?php echo $setting_cms->seccion_about->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="seccion_about" class="<?php echo $setting_cms->seccion_about->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->seccion_about) ?>',1);"><div id="elh_setting_cms_seccion_about" class="setting_cms_seccion_about">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->seccion_about->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->seccion_about->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->seccion_about->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->seccion_service->Visible) { // seccion_service ?>
	<?php if ($setting_cms->sortUrl($setting_cms->seccion_service) == "") { ?>
		<th data-name="seccion_service" class="<?php echo $setting_cms->seccion_service->headerCellClass() ?>"><div id="elh_setting_cms_seccion_service" class="setting_cms_seccion_service"><div class="ew-table-header-caption"><?php echo $setting_cms->seccion_service->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="seccion_service" class="<?php echo $setting_cms->seccion_service->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->seccion_service) ?>',1);"><div id="elh_setting_cms_seccion_service" class="setting_cms_seccion_service">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->seccion_service->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->seccion_service->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->seccion_service->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->seccion_publicitaria->Visible) { // seccion_publicitaria ?>
	<?php if ($setting_cms->sortUrl($setting_cms->seccion_publicitaria) == "") { ?>
		<th data-name="seccion_publicitaria" class="<?php echo $setting_cms->seccion_publicitaria->headerCellClass() ?>"><div id="elh_setting_cms_seccion_publicitaria" class="setting_cms_seccion_publicitaria"><div class="ew-table-header-caption"><?php echo $setting_cms->seccion_publicitaria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="seccion_publicitaria" class="<?php echo $setting_cms->seccion_publicitaria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->seccion_publicitaria) ?>',1);"><div id="elh_setting_cms_seccion_publicitaria" class="setting_cms_seccion_publicitaria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->seccion_publicitaria->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->seccion_publicitaria->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->seccion_publicitaria->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->banner_publicitario_titulo->Visible) { // banner_publicitario_titulo ?>
	<?php if ($setting_cms->sortUrl($setting_cms->banner_publicitario_titulo) == "") { ?>
		<th data-name="banner_publicitario_titulo" class="<?php echo $setting_cms->banner_publicitario_titulo->headerCellClass() ?>"><div id="elh_setting_cms_banner_publicitario_titulo" class="setting_cms_banner_publicitario_titulo"><div class="ew-table-header-caption"><?php echo $setting_cms->banner_publicitario_titulo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="banner_publicitario_titulo" class="<?php echo $setting_cms->banner_publicitario_titulo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->banner_publicitario_titulo) ?>',1);"><div id="elh_setting_cms_banner_publicitario_titulo" class="setting_cms_banner_publicitario_titulo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->banner_publicitario_titulo->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->banner_publicitario_titulo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->banner_publicitario_titulo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->banner_publicitario_detalle->Visible) { // banner_publicitario_detalle ?>
	<?php if ($setting_cms->sortUrl($setting_cms->banner_publicitario_detalle) == "") { ?>
		<th data-name="banner_publicitario_detalle" class="<?php echo $setting_cms->banner_publicitario_detalle->headerCellClass() ?>"><div id="elh_setting_cms_banner_publicitario_detalle" class="setting_cms_banner_publicitario_detalle"><div class="ew-table-header-caption"><?php echo $setting_cms->banner_publicitario_detalle->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="banner_publicitario_detalle" class="<?php echo $setting_cms->banner_publicitario_detalle->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->banner_publicitario_detalle) ?>',1);"><div id="elh_setting_cms_banner_publicitario_detalle" class="setting_cms_banner_publicitario_detalle">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->banner_publicitario_detalle->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->banner_publicitario_detalle->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->banner_publicitario_detalle->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->banner_publicitario_btnNombre->Visible) { // banner_publicitario_btnNombre ?>
	<?php if ($setting_cms->sortUrl($setting_cms->banner_publicitario_btnNombre) == "") { ?>
		<th data-name="banner_publicitario_btnNombre" class="<?php echo $setting_cms->banner_publicitario_btnNombre->headerCellClass() ?>"><div id="elh_setting_cms_banner_publicitario_btnNombre" class="setting_cms_banner_publicitario_btnNombre"><div class="ew-table-header-caption"><?php echo $setting_cms->banner_publicitario_btnNombre->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="banner_publicitario_btnNombre" class="<?php echo $setting_cms->banner_publicitario_btnNombre->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->banner_publicitario_btnNombre) ?>',1);"><div id="elh_setting_cms_banner_publicitario_btnNombre" class="setting_cms_banner_publicitario_btnNombre">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->banner_publicitario_btnNombre->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->banner_publicitario_btnNombre->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->banner_publicitario_btnNombre->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->banner_publicitario_url->Visible) { // banner_publicitario_url ?>
	<?php if ($setting_cms->sortUrl($setting_cms->banner_publicitario_url) == "") { ?>
		<th data-name="banner_publicitario_url" class="<?php echo $setting_cms->banner_publicitario_url->headerCellClass() ?>"><div id="elh_setting_cms_banner_publicitario_url" class="setting_cms_banner_publicitario_url"><div class="ew-table-header-caption"><?php echo $setting_cms->banner_publicitario_url->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="banner_publicitario_url" class="<?php echo $setting_cms->banner_publicitario_url->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->banner_publicitario_url) ?>',1);"><div id="elh_setting_cms_banner_publicitario_url" class="setting_cms_banner_publicitario_url">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->banner_publicitario_url->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->banner_publicitario_url->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->banner_publicitario_url->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->seccion_portfolio->Visible) { // seccion_portfolio ?>
	<?php if ($setting_cms->sortUrl($setting_cms->seccion_portfolio) == "") { ?>
		<th data-name="seccion_portfolio" class="<?php echo $setting_cms->seccion_portfolio->headerCellClass() ?>"><div id="elh_setting_cms_seccion_portfolio" class="setting_cms_seccion_portfolio"><div class="ew-table-header-caption"><?php echo $setting_cms->seccion_portfolio->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="seccion_portfolio" class="<?php echo $setting_cms->seccion_portfolio->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->seccion_portfolio) ?>',1);"><div id="elh_setting_cms_seccion_portfolio" class="setting_cms_seccion_portfolio">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->seccion_portfolio->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->seccion_portfolio->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->seccion_portfolio->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->seccion_app->Visible) { // seccion_app ?>
	<?php if ($setting_cms->sortUrl($setting_cms->seccion_app) == "") { ?>
		<th data-name="seccion_app" class="<?php echo $setting_cms->seccion_app->headerCellClass() ?>"><div id="elh_setting_cms_seccion_app" class="setting_cms_seccion_app"><div class="ew-table-header-caption"><?php echo $setting_cms->seccion_app->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="seccion_app" class="<?php echo $setting_cms->seccion_app->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->seccion_app) ?>',1);"><div id="elh_setting_cms_seccion_app" class="setting_cms_seccion_app">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->seccion_app->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->seccion_app->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->seccion_app->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->link_app_android->Visible) { // link_app_android ?>
	<?php if ($setting_cms->sortUrl($setting_cms->link_app_android) == "") { ?>
		<th data-name="link_app_android" class="<?php echo $setting_cms->link_app_android->headerCellClass() ?>"><div id="elh_setting_cms_link_app_android" class="setting_cms_link_app_android"><div class="ew-table-header-caption"><?php echo $setting_cms->link_app_android->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="link_app_android" class="<?php echo $setting_cms->link_app_android->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->link_app_android) ?>',1);"><div id="elh_setting_cms_link_app_android" class="setting_cms_link_app_android">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->link_app_android->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->link_app_android->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->link_app_android->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->link_app_iphone->Visible) { // link_app_iphone ?>
	<?php if ($setting_cms->sortUrl($setting_cms->link_app_iphone) == "") { ?>
		<th data-name="link_app_iphone" class="<?php echo $setting_cms->link_app_iphone->headerCellClass() ?>"><div id="elh_setting_cms_link_app_iphone" class="setting_cms_link_app_iphone"><div class="ew-table-header-caption"><?php echo $setting_cms->link_app_iphone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="link_app_iphone" class="<?php echo $setting_cms->link_app_iphone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->link_app_iphone) ?>',1);"><div id="elh_setting_cms_link_app_iphone" class="setting_cms_link_app_iphone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->link_app_iphone->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->link_app_iphone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->link_app_iphone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->cookies_ley->Visible) { // cookies_ley ?>
	<?php if ($setting_cms->sortUrl($setting_cms->cookies_ley) == "") { ?>
		<th data-name="cookies_ley" class="<?php echo $setting_cms->cookies_ley->headerCellClass() ?>"><div id="elh_setting_cms_cookies_ley" class="setting_cms_cookies_ley"><div class="ew-table-header-caption"><?php echo $setting_cms->cookies_ley->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cookies_ley" class="<?php echo $setting_cms->cookies_ley->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->cookies_ley) ?>',1);"><div id="elh_setting_cms_cookies_ley" class="setting_cms_cookies_ley">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->cookies_ley->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->cookies_ley->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->cookies_ley->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->cookies_questions->Visible) { // cookies_questions ?>
	<?php if ($setting_cms->sortUrl($setting_cms->cookies_questions) == "") { ?>
		<th data-name="cookies_questions" class="<?php echo $setting_cms->cookies_questions->headerCellClass() ?>"><div id="elh_setting_cms_cookies_questions" class="setting_cms_cookies_questions"><div class="ew-table-header-caption"><?php echo $setting_cms->cookies_questions->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cookies_questions" class="<?php echo $setting_cms->cookies_questions->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->cookies_questions) ?>',1);"><div id="elh_setting_cms_cookies_questions" class="setting_cms_cookies_questions">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->cookies_questions->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->cookies_questions->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->cookies_questions->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->seccion_contact->Visible) { // seccion_contact ?>
	<?php if ($setting_cms->sortUrl($setting_cms->seccion_contact) == "") { ?>
		<th data-name="seccion_contact" class="<?php echo $setting_cms->seccion_contact->headerCellClass() ?>"><div id="elh_setting_cms_seccion_contact" class="setting_cms_seccion_contact"><div class="ew-table-header-caption"><?php echo $setting_cms->seccion_contact->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="seccion_contact" class="<?php echo $setting_cms->seccion_contact->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->seccion_contact) ?>',1);"><div id="elh_setting_cms_seccion_contact" class="setting_cms_seccion_contact">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->seccion_contact->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->seccion_contact->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->seccion_contact->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->seccion_menufooter->Visible) { // seccion_menufooter ?>
	<?php if ($setting_cms->sortUrl($setting_cms->seccion_menufooter) == "") { ?>
		<th data-name="seccion_menufooter" class="<?php echo $setting_cms->seccion_menufooter->headerCellClass() ?>"><div id="elh_setting_cms_seccion_menufooter" class="setting_cms_seccion_menufooter"><div class="ew-table-header-caption"><?php echo $setting_cms->seccion_menufooter->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="seccion_menufooter" class="<?php echo $setting_cms->seccion_menufooter->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->seccion_menufooter) ?>',1);"><div id="elh_setting_cms_seccion_menufooter" class="setting_cms_seccion_menufooter">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->seccion_menufooter->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->seccion_menufooter->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->seccion_menufooter->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->updated_at->Visible) { // updated_at ?>
	<?php if ($setting_cms->sortUrl($setting_cms->updated_at) == "") { ?>
		<th data-name="updated_at" class="<?php echo $setting_cms->updated_at->headerCellClass() ?>"><div id="elh_setting_cms_updated_at" class="setting_cms_updated_at"><div class="ew-table-header-caption"><?php echo $setting_cms->updated_at->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="updated_at" class="<?php echo $setting_cms->updated_at->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->updated_at) ?>',1);"><div id="elh_setting_cms_updated_at" class="setting_cms_updated_at">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->updated_at->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->updated_at->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->updated_at->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($setting_cms->usuario_id->Visible) { // usuario_id ?>
	<?php if ($setting_cms->sortUrl($setting_cms->usuario_id) == "") { ?>
		<th data-name="usuario_id" class="<?php echo $setting_cms->usuario_id->headerCellClass() ?>"><div id="elh_setting_cms_usuario_id" class="setting_cms_usuario_id"><div class="ew-table-header-caption"><?php echo $setting_cms->usuario_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="usuario_id" class="<?php echo $setting_cms->usuario_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $setting_cms->SortUrl($setting_cms->usuario_id) ?>',1);"><div id="elh_setting_cms_usuario_id" class="setting_cms_usuario_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setting_cms->usuario_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($setting_cms->usuario_id->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($setting_cms->usuario_id->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$setting_cms_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($setting_cms->ExportAll && $setting_cms->isExport()) {
	$setting_cms_list->StopRec = $setting_cms_list->TotalRecs;
} else {

	// Set the last record to display
	if ($setting_cms_list->TotalRecs > $setting_cms_list->StartRec + $setting_cms_list->DisplayRecs - 1)
		$setting_cms_list->StopRec = $setting_cms_list->StartRec + $setting_cms_list->DisplayRecs - 1;
	else
		$setting_cms_list->StopRec = $setting_cms_list->TotalRecs;
}
$setting_cms_list->RecCnt = $setting_cms_list->StartRec - 1;
if ($setting_cms_list->Recordset && !$setting_cms_list->Recordset->EOF) {
	$setting_cms_list->Recordset->moveFirst();
	$selectLimit = $setting_cms_list->UseSelectLimit;
	if (!$selectLimit && $setting_cms_list->StartRec > 1)
		$setting_cms_list->Recordset->move($setting_cms_list->StartRec - 1);
} elseif (!$setting_cms->AllowAddDeleteRow && $setting_cms_list->StopRec == 0) {
	$setting_cms_list->StopRec = $setting_cms->GridAddRowCount;
}

// Initialize aggregate
$setting_cms->RowType = ROWTYPE_AGGREGATEINIT;
$setting_cms->resetAttributes();
$setting_cms_list->renderRow();
while ($setting_cms_list->RecCnt < $setting_cms_list->StopRec) {
	$setting_cms_list->RecCnt++;
	if ($setting_cms_list->RecCnt >= $setting_cms_list->StartRec) {
		$setting_cms_list->RowCnt++;

		// Set up key count
		$setting_cms_list->KeyCount = $setting_cms_list->RowIndex;

		// Init row class and style
		$setting_cms->resetAttributes();
		$setting_cms->CssClass = "";
		if ($setting_cms->isGridAdd()) {
		} else {
			$setting_cms_list->loadRowValues($setting_cms_list->Recordset); // Load row values
		}
		$setting_cms->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$setting_cms->RowAttrs = array_merge($setting_cms->RowAttrs, array('data-rowindex'=>$setting_cms_list->RowCnt, 'id'=>'r' . $setting_cms_list->RowCnt . '_setting_cms', 'data-rowtype'=>$setting_cms->RowType));

		// Render row
		$setting_cms_list->renderRow();

		// Render list options
		$setting_cms_list->renderListOptions();
?>
	<tr<?php echo $setting_cms->rowAttributes() ?>>
<?php

// Render list options (body, left)
$setting_cms_list->ListOptions->render("body", "left", $setting_cms_list->RowCnt);
?>
	<?php if ($setting_cms->SettingcmsID->Visible) { // SettingcmsID ?>
		<td data-name="SettingcmsID"<?php echo $setting_cms->SettingcmsID->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_SettingcmsID" class="setting_cms_SettingcmsID">
<span<?php echo $setting_cms->SettingcmsID->viewAttributes() ?>>
<?php echo $setting_cms->SettingcmsID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->seccion_slider->Visible) { // seccion_slider ?>
		<td data-name="seccion_slider"<?php echo $setting_cms->seccion_slider->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_seccion_slider" class="setting_cms_seccion_slider">
<span<?php echo $setting_cms->seccion_slider->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_slider->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_slider->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_slider->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->seccion_about->Visible) { // seccion_about ?>
		<td data-name="seccion_about"<?php echo $setting_cms->seccion_about->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_seccion_about" class="setting_cms_seccion_about">
<span<?php echo $setting_cms->seccion_about->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_about->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_about->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_about->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->seccion_service->Visible) { // seccion_service ?>
		<td data-name="seccion_service"<?php echo $setting_cms->seccion_service->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_seccion_service" class="setting_cms_seccion_service">
<span<?php echo $setting_cms->seccion_service->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_service->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_service->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_service->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->seccion_publicitaria->Visible) { // seccion_publicitaria ?>
		<td data-name="seccion_publicitaria"<?php echo $setting_cms->seccion_publicitaria->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_seccion_publicitaria" class="setting_cms_seccion_publicitaria">
<span<?php echo $setting_cms->seccion_publicitaria->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_publicitaria->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_publicitaria->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_publicitaria->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->banner_publicitario_titulo->Visible) { // banner_publicitario_titulo ?>
		<td data-name="banner_publicitario_titulo"<?php echo $setting_cms->banner_publicitario_titulo->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_banner_publicitario_titulo" class="setting_cms_banner_publicitario_titulo">
<span<?php echo $setting_cms->banner_publicitario_titulo->viewAttributes() ?>>
<?php echo $setting_cms->banner_publicitario_titulo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->banner_publicitario_detalle->Visible) { // banner_publicitario_detalle ?>
		<td data-name="banner_publicitario_detalle"<?php echo $setting_cms->banner_publicitario_detalle->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_banner_publicitario_detalle" class="setting_cms_banner_publicitario_detalle">
<span<?php echo $setting_cms->banner_publicitario_detalle->viewAttributes() ?>>
<?php echo $setting_cms->banner_publicitario_detalle->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->banner_publicitario_btnNombre->Visible) { // banner_publicitario_btnNombre ?>
		<td data-name="banner_publicitario_btnNombre"<?php echo $setting_cms->banner_publicitario_btnNombre->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_banner_publicitario_btnNombre" class="setting_cms_banner_publicitario_btnNombre">
<span<?php echo $setting_cms->banner_publicitario_btnNombre->viewAttributes() ?>>
<?php echo $setting_cms->banner_publicitario_btnNombre->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->banner_publicitario_url->Visible) { // banner_publicitario_url ?>
		<td data-name="banner_publicitario_url"<?php echo $setting_cms->banner_publicitario_url->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_banner_publicitario_url" class="setting_cms_banner_publicitario_url">
<span<?php echo $setting_cms->banner_publicitario_url->viewAttributes() ?>>
<?php echo $setting_cms->banner_publicitario_url->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->seccion_portfolio->Visible) { // seccion_portfolio ?>
		<td data-name="seccion_portfolio"<?php echo $setting_cms->seccion_portfolio->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_seccion_portfolio" class="setting_cms_seccion_portfolio">
<span<?php echo $setting_cms->seccion_portfolio->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_portfolio->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_portfolio->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_portfolio->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->seccion_app->Visible) { // seccion_app ?>
		<td data-name="seccion_app"<?php echo $setting_cms->seccion_app->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_seccion_app" class="setting_cms_seccion_app">
<span<?php echo $setting_cms->seccion_app->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_app->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_app->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_app->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->link_app_android->Visible) { // link_app_android ?>
		<td data-name="link_app_android"<?php echo $setting_cms->link_app_android->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_link_app_android" class="setting_cms_link_app_android">
<span<?php echo $setting_cms->link_app_android->viewAttributes() ?>>
<?php echo $setting_cms->link_app_android->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->link_app_iphone->Visible) { // link_app_iphone ?>
		<td data-name="link_app_iphone"<?php echo $setting_cms->link_app_iphone->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_link_app_iphone" class="setting_cms_link_app_iphone">
<span<?php echo $setting_cms->link_app_iphone->viewAttributes() ?>>
<?php echo $setting_cms->link_app_iphone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->cookies_ley->Visible) { // cookies_ley ?>
		<td data-name="cookies_ley"<?php echo $setting_cms->cookies_ley->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_cookies_ley" class="setting_cms_cookies_ley">
<span<?php echo $setting_cms->cookies_ley->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->cookies_ley->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->cookies_ley->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->cookies_ley->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->cookies_questions->Visible) { // cookies_questions ?>
		<td data-name="cookies_questions"<?php echo $setting_cms->cookies_questions->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_cookies_questions" class="setting_cms_cookies_questions">
<span<?php echo $setting_cms->cookies_questions->viewAttributes() ?>>
<?php echo $setting_cms->cookies_questions->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->seccion_contact->Visible) { // seccion_contact ?>
		<td data-name="seccion_contact"<?php echo $setting_cms->seccion_contact->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_seccion_contact" class="setting_cms_seccion_contact">
<span<?php echo $setting_cms->seccion_contact->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_contact->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_contact->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_contact->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->seccion_menufooter->Visible) { // seccion_menufooter ?>
		<td data-name="seccion_menufooter"<?php echo $setting_cms->seccion_menufooter->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_seccion_menufooter" class="setting_cms_seccion_menufooter">
<span<?php echo $setting_cms->seccion_menufooter->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_menufooter->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_menufooter->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_menufooter->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->updated_at->Visible) { // updated_at ?>
		<td data-name="updated_at"<?php echo $setting_cms->updated_at->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_updated_at" class="setting_cms_updated_at">
<span<?php echo $setting_cms->updated_at->viewAttributes() ?>>
<?php echo $setting_cms->updated_at->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($setting_cms->usuario_id->Visible) { // usuario_id ?>
		<td data-name="usuario_id"<?php echo $setting_cms->usuario_id->cellAttributes() ?>>
<span id="el<?php echo $setting_cms_list->RowCnt ?>_setting_cms_usuario_id" class="setting_cms_usuario_id">
<span<?php echo $setting_cms->usuario_id->viewAttributes() ?>>
<?php echo $setting_cms->usuario_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$setting_cms_list->ListOptions->render("body", "right", $setting_cms_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$setting_cms->isGridAdd())
		$setting_cms_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$setting_cms->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($setting_cms_list->Recordset)
	$setting_cms_list->Recordset->Close();
?>
<?php if (!$setting_cms->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$setting_cms->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($setting_cms_list->Pager)) $setting_cms_list->Pager = new PrevNextPager($setting_cms_list->StartRec, $setting_cms_list->DisplayRecs, $setting_cms_list->TotalRecs, $setting_cms_list->AutoHidePager) ?>
<?php if ($setting_cms_list->Pager->RecordCount > 0 && $setting_cms_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($setting_cms_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $setting_cms_list->pageUrl() ?>start=<?php echo $setting_cms_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($setting_cms_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $setting_cms_list->pageUrl() ?>start=<?php echo $setting_cms_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $setting_cms_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($setting_cms_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $setting_cms_list->pageUrl() ?>start=<?php echo $setting_cms_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($setting_cms_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $setting_cms_list->pageUrl() ?>start=<?php echo $setting_cms_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $setting_cms_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($setting_cms_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $setting_cms_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $setting_cms_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $setting_cms_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($setting_cms_list->TotalRecs > 0 && (!$setting_cms_list->AutoHidePageSizeSelector || $setting_cms_list->Pager->Visible)) { ?>
<div class="ew-pager">
<input type="hidden" name="t" value="setting_cms">
<select name="<?php echo TABLE_REC_PER_PAGE ?>" class="form-control form-control-sm ew-tooltip" title="<?php echo $Language->phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($setting_cms_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($setting_cms_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($setting_cms_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($setting_cms->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $setting_cms_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($setting_cms_list->TotalRecs == 0 && !$setting_cms->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $setting_cms_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$setting_cms_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$setting_cms->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$setting_cms_list->terminate();
?>