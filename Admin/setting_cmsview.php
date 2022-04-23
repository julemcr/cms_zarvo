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
$setting_cms_view = new setting_cms_view();

// Run the page
$setting_cms_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$setting_cms_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$setting_cms->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fsetting_cmsview = currentForm = new ew.Form("fsetting_cmsview", "view");

// Form_CustomValidate event
fsetting_cmsview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsetting_cmsview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Multi-Page
fsetting_cmsview.multiPage = new ew.MultiPage("fsetting_cmsview");

// Dynamic selection lists
fsetting_cmsview.lists["x_seccion_slider[]"] = <?php echo $setting_cms_view->seccion_slider->Lookup->toClientList() ?>;
fsetting_cmsview.lists["x_seccion_slider[]"].options = <?php echo JsonEncode($setting_cms_view->seccion_slider->options(FALSE, TRUE)) ?>;
fsetting_cmsview.lists["x_seccion_about[]"] = <?php echo $setting_cms_view->seccion_about->Lookup->toClientList() ?>;
fsetting_cmsview.lists["x_seccion_about[]"].options = <?php echo JsonEncode($setting_cms_view->seccion_about->options(FALSE, TRUE)) ?>;
fsetting_cmsview.lists["x_seccion_service[]"] = <?php echo $setting_cms_view->seccion_service->Lookup->toClientList() ?>;
fsetting_cmsview.lists["x_seccion_service[]"].options = <?php echo JsonEncode($setting_cms_view->seccion_service->options(FALSE, TRUE)) ?>;
fsetting_cmsview.lists["x_seccion_publicitaria[]"] = <?php echo $setting_cms_view->seccion_publicitaria->Lookup->toClientList() ?>;
fsetting_cmsview.lists["x_seccion_publicitaria[]"].options = <?php echo JsonEncode($setting_cms_view->seccion_publicitaria->options(FALSE, TRUE)) ?>;
fsetting_cmsview.lists["x_seccion_portfolio[]"] = <?php echo $setting_cms_view->seccion_portfolio->Lookup->toClientList() ?>;
fsetting_cmsview.lists["x_seccion_portfolio[]"].options = <?php echo JsonEncode($setting_cms_view->seccion_portfolio->options(FALSE, TRUE)) ?>;
fsetting_cmsview.lists["x_seccion_app[]"] = <?php echo $setting_cms_view->seccion_app->Lookup->toClientList() ?>;
fsetting_cmsview.lists["x_seccion_app[]"].options = <?php echo JsonEncode($setting_cms_view->seccion_app->options(FALSE, TRUE)) ?>;
fsetting_cmsview.lists["x_cookies_ley[]"] = <?php echo $setting_cms_view->cookies_ley->Lookup->toClientList() ?>;
fsetting_cmsview.lists["x_cookies_ley[]"].options = <?php echo JsonEncode($setting_cms_view->cookies_ley->options(FALSE, TRUE)) ?>;
fsetting_cmsview.lists["x_seccion_contact[]"] = <?php echo $setting_cms_view->seccion_contact->Lookup->toClientList() ?>;
fsetting_cmsview.lists["x_seccion_contact[]"].options = <?php echo JsonEncode($setting_cms_view->seccion_contact->options(FALSE, TRUE)) ?>;
fsetting_cmsview.lists["x_seccion_menufooter[]"] = <?php echo $setting_cms_view->seccion_menufooter->Lookup->toClientList() ?>;
fsetting_cmsview.lists["x_seccion_menufooter[]"].options = <?php echo JsonEncode($setting_cms_view->seccion_menufooter->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$setting_cms->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $setting_cms_view->ExportOptions->render("body") ?>
<?php $setting_cms_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $setting_cms_view->showPageHeader(); ?>
<?php
$setting_cms_view->showMessage();
?>
<?php if (!$setting_cms_view->IsModal) { ?>
<?php if (!$setting_cms->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($setting_cms_view->Pager)) $setting_cms_view->Pager = new PrevNextPager($setting_cms_view->StartRec, $setting_cms_view->DisplayRecs, $setting_cms_view->TotalRecs, $setting_cms_view->AutoHidePager) ?>
<?php if ($setting_cms_view->Pager->RecordCount > 0 && $setting_cms_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($setting_cms_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $setting_cms_view->pageUrl() ?>start=<?php echo $setting_cms_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($setting_cms_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $setting_cms_view->pageUrl() ?>start=<?php echo $setting_cms_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $setting_cms_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($setting_cms_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $setting_cms_view->pageUrl() ?>start=<?php echo $setting_cms_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($setting_cms_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $setting_cms_view->pageUrl() ?>start=<?php echo $setting_cms_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $setting_cms_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fsetting_cmsview" id="fsetting_cmsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($setting_cms_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $setting_cms_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="setting_cms">
<input type="hidden" name="modal" value="<?php echo (int)$setting_cms_view->IsModal ?>">
<?php if ($setting_cms_view->MultiPages->Items[0]->Visible) { ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($setting_cms->SettingcmsID->Visible) { // SettingcmsID ?>
	<tr id="r_SettingcmsID">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_SettingcmsID"><?php echo $setting_cms->SettingcmsID->caption() ?></span></td>
		<td data-name="SettingcmsID"<?php echo $setting_cms->SettingcmsID->cellAttributes() ?>>
<span id="el_setting_cms_SettingcmsID" data-page="0">
<span<?php echo $setting_cms->SettingcmsID->viewAttributes() ?>>
<?php echo $setting_cms->SettingcmsID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setting_cms->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_updated_at"><?php echo $setting_cms->updated_at->caption() ?></span></td>
		<td data-name="updated_at"<?php echo $setting_cms->updated_at->cellAttributes() ?>>
<span id="el_setting_cms_updated_at" data-page="0">
<span<?php echo $setting_cms->updated_at->viewAttributes() ?>>
<?php echo $setting_cms->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setting_cms->usuario_id->Visible) { // usuario_id ?>
	<tr id="r_usuario_id">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_usuario_id"><?php echo $setting_cms->usuario_id->caption() ?></span></td>
		<td data-name="usuario_id"<?php echo $setting_cms->usuario_id->cellAttributes() ?>>
<span id="el_setting_cms_usuario_id" data-page="0">
<span<?php echo $setting_cms->usuario_id->viewAttributes() ?>>
<?php echo $setting_cms->usuario_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php } ?>
<?php if (!$setting_cms->isExport()) { ?>
<div class="ew-multi-page">
<div class="ew-nav-tabs" id="setting_cms_view"><!-- multi-page tabs -->
	<ul class="<?php echo $setting_cms_view->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $setting_cms_view->MultiPages->pageStyle("1") ?>" href="#tab_setting_cms1" data-toggle="tab"><?php echo $setting_cms->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $setting_cms_view->MultiPages->pageStyle("2") ?>" href="#tab_setting_cms2" data-toggle="tab"><?php echo $setting_cms->pageCaption(2) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $setting_cms_view->MultiPages->pageStyle("3") ?>" href="#tab_setting_cms3" data-toggle="tab"><?php echo $setting_cms->pageCaption(3) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $setting_cms_view->MultiPages->pageStyle("4") ?>" href="#tab_setting_cms4" data-toggle="tab"><?php echo $setting_cms->pageCaption(4) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if (!$setting_cms->isExport()) { ?>
		<div class="tab-pane<?php echo $setting_cms_view->MultiPages->pageStyle("1") ?>" id="tab_setting_cms1"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($setting_cms->seccion_slider->Visible) { // seccion_slider ?>
	<tr id="r_seccion_slider">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_slider"><?php echo $setting_cms->seccion_slider->caption() ?></span></td>
		<td data-name="seccion_slider"<?php echo $setting_cms->seccion_slider->cellAttributes() ?>>
<span id="el_setting_cms_seccion_slider" data-page="1">
<span<?php echo $setting_cms->seccion_slider->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_slider->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_slider->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_slider->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setting_cms->seccion_about->Visible) { // seccion_about ?>
	<tr id="r_seccion_about">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_about"><?php echo $setting_cms->seccion_about->caption() ?></span></td>
		<td data-name="seccion_about"<?php echo $setting_cms->seccion_about->cellAttributes() ?>>
<span id="el_setting_cms_seccion_about" data-page="1">
<span<?php echo $setting_cms->seccion_about->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_about->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_about->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_about->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setting_cms->seccion_service->Visible) { // seccion_service ?>
	<tr id="r_seccion_service">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_service"><?php echo $setting_cms->seccion_service->caption() ?></span></td>
		<td data-name="seccion_service"<?php echo $setting_cms->seccion_service->cellAttributes() ?>>
<span id="el_setting_cms_seccion_service" data-page="1">
<span<?php echo $setting_cms->seccion_service->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_service->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_service->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_service->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setting_cms->seccion_portfolio->Visible) { // seccion_portfolio ?>
	<tr id="r_seccion_portfolio">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_portfolio"><?php echo $setting_cms->seccion_portfolio->caption() ?></span></td>
		<td data-name="seccion_portfolio"<?php echo $setting_cms->seccion_portfolio->cellAttributes() ?>>
<span id="el_setting_cms_seccion_portfolio" data-page="1">
<span<?php echo $setting_cms->seccion_portfolio->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_portfolio->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_portfolio->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_portfolio->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setting_cms->seccion_app->Visible) { // seccion_app ?>
	<tr id="r_seccion_app">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_app"><?php echo $setting_cms->seccion_app->caption() ?></span></td>
		<td data-name="seccion_app"<?php echo $setting_cms->seccion_app->cellAttributes() ?>>
<span id="el_setting_cms_seccion_app" data-page="1">
<span<?php echo $setting_cms->seccion_app->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_app->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_app->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_app->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setting_cms->seccion_contact->Visible) { // seccion_contact ?>
	<tr id="r_seccion_contact">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_contact"><?php echo $setting_cms->seccion_contact->caption() ?></span></td>
		<td data-name="seccion_contact"<?php echo $setting_cms->seccion_contact->cellAttributes() ?>>
<span id="el_setting_cms_seccion_contact" data-page="1">
<span<?php echo $setting_cms->seccion_contact->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_contact->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_contact->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_contact->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setting_cms->seccion_menufooter->Visible) { // seccion_menufooter ?>
	<tr id="r_seccion_menufooter">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_menufooter"><?php echo $setting_cms->seccion_menufooter->caption() ?></span></td>
		<td data-name="seccion_menufooter"<?php echo $setting_cms->seccion_menufooter->cellAttributes() ?>>
<span id="el_setting_cms_seccion_menufooter" data-page="1">
<span<?php echo $setting_cms->seccion_menufooter->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_menufooter->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_menufooter->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_menufooter->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$setting_cms->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$setting_cms->isExport()) { ?>
		<div class="tab-pane<?php echo $setting_cms_view->MultiPages->pageStyle("2") ?>" id="tab_setting_cms2"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($setting_cms->seccion_publicitaria->Visible) { // seccion_publicitaria ?>
	<tr id="r_seccion_publicitaria">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_publicitaria"><?php echo $setting_cms->seccion_publicitaria->caption() ?></span></td>
		<td data-name="seccion_publicitaria"<?php echo $setting_cms->seccion_publicitaria->cellAttributes() ?>>
<span id="el_setting_cms_seccion_publicitaria" data-page="2">
<span<?php echo $setting_cms->seccion_publicitaria->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->seccion_publicitaria->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_publicitaria->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->seccion_publicitaria->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setting_cms->banner_publicitario_titulo->Visible) { // banner_publicitario_titulo ?>
	<tr id="r_banner_publicitario_titulo">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_banner_publicitario_titulo"><?php echo $setting_cms->banner_publicitario_titulo->caption() ?></span></td>
		<td data-name="banner_publicitario_titulo"<?php echo $setting_cms->banner_publicitario_titulo->cellAttributes() ?>>
<span id="el_setting_cms_banner_publicitario_titulo" data-page="2">
<span<?php echo $setting_cms->banner_publicitario_titulo->viewAttributes() ?>>
<?php echo $setting_cms->banner_publicitario_titulo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setting_cms->banner_publicitario_detalle->Visible) { // banner_publicitario_detalle ?>
	<tr id="r_banner_publicitario_detalle">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_banner_publicitario_detalle"><?php echo $setting_cms->banner_publicitario_detalle->caption() ?></span></td>
		<td data-name="banner_publicitario_detalle"<?php echo $setting_cms->banner_publicitario_detalle->cellAttributes() ?>>
<span id="el_setting_cms_banner_publicitario_detalle" data-page="2">
<span<?php echo $setting_cms->banner_publicitario_detalle->viewAttributes() ?>>
<?php echo $setting_cms->banner_publicitario_detalle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setting_cms->banner_publicitario_btnNombre->Visible) { // banner_publicitario_btnNombre ?>
	<tr id="r_banner_publicitario_btnNombre">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_banner_publicitario_btnNombre"><?php echo $setting_cms->banner_publicitario_btnNombre->caption() ?></span></td>
		<td data-name="banner_publicitario_btnNombre"<?php echo $setting_cms->banner_publicitario_btnNombre->cellAttributes() ?>>
<span id="el_setting_cms_banner_publicitario_btnNombre" data-page="2">
<span<?php echo $setting_cms->banner_publicitario_btnNombre->viewAttributes() ?>>
<?php echo $setting_cms->banner_publicitario_btnNombre->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setting_cms->banner_publicitario_url->Visible) { // banner_publicitario_url ?>
	<tr id="r_banner_publicitario_url">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_banner_publicitario_url"><?php echo $setting_cms->banner_publicitario_url->caption() ?></span></td>
		<td data-name="banner_publicitario_url"<?php echo $setting_cms->banner_publicitario_url->cellAttributes() ?>>
<span id="el_setting_cms_banner_publicitario_url" data-page="2">
<span<?php echo $setting_cms->banner_publicitario_url->viewAttributes() ?>>
<?php echo $setting_cms->banner_publicitario_url->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$setting_cms->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$setting_cms->isExport()) { ?>
		<div class="tab-pane<?php echo $setting_cms_view->MultiPages->pageStyle("3") ?>" id="tab_setting_cms3"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($setting_cms->link_app_android->Visible) { // link_app_android ?>
	<tr id="r_link_app_android">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_link_app_android"><?php echo $setting_cms->link_app_android->caption() ?></span></td>
		<td data-name="link_app_android"<?php echo $setting_cms->link_app_android->cellAttributes() ?>>
<span id="el_setting_cms_link_app_android" data-page="3">
<span<?php echo $setting_cms->link_app_android->viewAttributes() ?>>
<?php echo $setting_cms->link_app_android->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setting_cms->link_app_iphone->Visible) { // link_app_iphone ?>
	<tr id="r_link_app_iphone">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_link_app_iphone"><?php echo $setting_cms->link_app_iphone->caption() ?></span></td>
		<td data-name="link_app_iphone"<?php echo $setting_cms->link_app_iphone->cellAttributes() ?>>
<span id="el_setting_cms_link_app_iphone" data-page="3">
<span<?php echo $setting_cms->link_app_iphone->viewAttributes() ?>>
<?php echo $setting_cms->link_app_iphone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$setting_cms->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$setting_cms->isExport()) { ?>
		<div class="tab-pane<?php echo $setting_cms_view->MultiPages->pageStyle("4") ?>" id="tab_setting_cms4"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($setting_cms->cookies_ley->Visible) { // cookies_ley ?>
	<tr id="r_cookies_ley">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_cookies_ley"><?php echo $setting_cms->cookies_ley->caption() ?></span></td>
		<td data-name="cookies_ley"<?php echo $setting_cms->cookies_ley->cellAttributes() ?>>
<span id="el_setting_cms_cookies_ley" data-page="4">
<span<?php echo $setting_cms->cookies_ley->viewAttributes() ?>>
<?php if (ConvertToBool($setting_cms->cookies_ley->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $setting_cms->cookies_ley->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $setting_cms->cookies_ley->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setting_cms->cookies_questions->Visible) { // cookies_questions ?>
	<tr id="r_cookies_questions">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_cookies_questions"><?php echo $setting_cms->cookies_questions->caption() ?></span></td>
		<td data-name="cookies_questions"<?php echo $setting_cms->cookies_questions->cellAttributes() ?>>
<span id="el_setting_cms_cookies_questions" data-page="4">
<span<?php echo $setting_cms->cookies_questions->viewAttributes() ?>>
<?php echo $setting_cms->cookies_questions->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($setting_cms->cookies_detalle->Visible) { // cookies_detalle ?>
	<tr id="r_cookies_detalle">
		<td class="<?php echo $setting_cms_view->TableLeftColumnClass ?>"><span id="elh_setting_cms_cookies_detalle"><?php echo $setting_cms->cookies_detalle->caption() ?></span></td>
		<td data-name="cookies_detalle"<?php echo $setting_cms->cookies_detalle->cellAttributes() ?>>
<span id="el_setting_cms_cookies_detalle" data-page="4">
<span<?php echo $setting_cms->cookies_detalle->viewAttributes() ?>>
<?php echo $setting_cms->cookies_detalle->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$setting_cms->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$setting_cms->isExport()) { ?>
	</div>
</div>
</div>
<?php } ?>
<?php if (!$setting_cms_view->IsModal) { ?>
<?php if (!$setting_cms->isExport()) { ?>
<?php if (!isset($setting_cms_view->Pager)) $setting_cms_view->Pager = new PrevNextPager($setting_cms_view->StartRec, $setting_cms_view->DisplayRecs, $setting_cms_view->TotalRecs, $setting_cms_view->AutoHidePager) ?>
<?php if ($setting_cms_view->Pager->RecordCount > 0 && $setting_cms_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($setting_cms_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $setting_cms_view->pageUrl() ?>start=<?php echo $setting_cms_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($setting_cms_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $setting_cms_view->pageUrl() ?>start=<?php echo $setting_cms_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $setting_cms_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($setting_cms_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $setting_cms_view->pageUrl() ?>start=<?php echo $setting_cms_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($setting_cms_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $setting_cms_view->pageUrl() ?>start=<?php echo $setting_cms_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $setting_cms_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$setting_cms_view->showPageFooter();
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
$setting_cms_view->terminate();
?>