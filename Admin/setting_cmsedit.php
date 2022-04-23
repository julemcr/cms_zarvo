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
$setting_cms_edit = new setting_cms_edit();

// Run the page
$setting_cms_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$setting_cms_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fsetting_cmsedit = currentForm = new ew.Form("fsetting_cmsedit", "edit");

// Validate form
fsetting_cmsedit.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($setting_cms_edit->SettingcmsID->Required) { ?>
			elm = this.getElements("x" + infix + "_SettingcmsID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->SettingcmsID->caption(), $setting_cms->SettingcmsID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->seccion_slider->Required) { ?>
			elm = this.getElements("x" + infix + "_seccion_slider[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->seccion_slider->caption(), $setting_cms->seccion_slider->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->seccion_about->Required) { ?>
			elm = this.getElements("x" + infix + "_seccion_about[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->seccion_about->caption(), $setting_cms->seccion_about->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->seccion_service->Required) { ?>
			elm = this.getElements("x" + infix + "_seccion_service[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->seccion_service->caption(), $setting_cms->seccion_service->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->seccion_publicitaria->Required) { ?>
			elm = this.getElements("x" + infix + "_seccion_publicitaria[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->seccion_publicitaria->caption(), $setting_cms->seccion_publicitaria->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->banner_publicitario_titulo->Required) { ?>
			elm = this.getElements("x" + infix + "_banner_publicitario_titulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->banner_publicitario_titulo->caption(), $setting_cms->banner_publicitario_titulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->banner_publicitario_detalle->Required) { ?>
			elm = this.getElements("x" + infix + "_banner_publicitario_detalle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->banner_publicitario_detalle->caption(), $setting_cms->banner_publicitario_detalle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->banner_publicitario_btnNombre->Required) { ?>
			elm = this.getElements("x" + infix + "_banner_publicitario_btnNombre");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->banner_publicitario_btnNombre->caption(), $setting_cms->banner_publicitario_btnNombre->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->banner_publicitario_url->Required) { ?>
			elm = this.getElements("x" + infix + "_banner_publicitario_url");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->banner_publicitario_url->caption(), $setting_cms->banner_publicitario_url->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->seccion_portfolio->Required) { ?>
			elm = this.getElements("x" + infix + "_seccion_portfolio[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->seccion_portfolio->caption(), $setting_cms->seccion_portfolio->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->seccion_app->Required) { ?>
			elm = this.getElements("x" + infix + "_seccion_app[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->seccion_app->caption(), $setting_cms->seccion_app->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->link_app_android->Required) { ?>
			elm = this.getElements("x" + infix + "_link_app_android");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->link_app_android->caption(), $setting_cms->link_app_android->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->link_app_iphone->Required) { ?>
			elm = this.getElements("x" + infix + "_link_app_iphone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->link_app_iphone->caption(), $setting_cms->link_app_iphone->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->cookies_ley->Required) { ?>
			elm = this.getElements("x" + infix + "_cookies_ley[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->cookies_ley->caption(), $setting_cms->cookies_ley->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->cookies_questions->Required) { ?>
			elm = this.getElements("x" + infix + "_cookies_questions");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->cookies_questions->caption(), $setting_cms->cookies_questions->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->cookies_detalle->Required) { ?>
			elm = this.getElements("x" + infix + "_cookies_detalle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->cookies_detalle->caption(), $setting_cms->cookies_detalle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->seccion_contact->Required) { ?>
			elm = this.getElements("x" + infix + "_seccion_contact[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->seccion_contact->caption(), $setting_cms->seccion_contact->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->seccion_menufooter->Required) { ?>
			elm = this.getElements("x" + infix + "_seccion_menufooter[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->seccion_menufooter->caption(), $setting_cms->seccion_menufooter->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->updated_at->Required) { ?>
			elm = this.getElements("x" + infix + "_updated_at");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->updated_at->caption(), $setting_cms->updated_at->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($setting_cms_edit->usuario_id->Required) { ?>
			elm = this.getElements("x" + infix + "_usuario_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $setting_cms->usuario_id->caption(), $setting_cms->usuario_id->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fsetting_cmsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsetting_cmsedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Multi-Page
fsetting_cmsedit.multiPage = new ew.MultiPage("fsetting_cmsedit");

// Dynamic selection lists
fsetting_cmsedit.lists["x_seccion_slider[]"] = <?php echo $setting_cms_edit->seccion_slider->Lookup->toClientList() ?>;
fsetting_cmsedit.lists["x_seccion_slider[]"].options = <?php echo JsonEncode($setting_cms_edit->seccion_slider->options(FALSE, TRUE)) ?>;
fsetting_cmsedit.lists["x_seccion_about[]"] = <?php echo $setting_cms_edit->seccion_about->Lookup->toClientList() ?>;
fsetting_cmsedit.lists["x_seccion_about[]"].options = <?php echo JsonEncode($setting_cms_edit->seccion_about->options(FALSE, TRUE)) ?>;
fsetting_cmsedit.lists["x_seccion_service[]"] = <?php echo $setting_cms_edit->seccion_service->Lookup->toClientList() ?>;
fsetting_cmsedit.lists["x_seccion_service[]"].options = <?php echo JsonEncode($setting_cms_edit->seccion_service->options(FALSE, TRUE)) ?>;
fsetting_cmsedit.lists["x_seccion_publicitaria[]"] = <?php echo $setting_cms_edit->seccion_publicitaria->Lookup->toClientList() ?>;
fsetting_cmsedit.lists["x_seccion_publicitaria[]"].options = <?php echo JsonEncode($setting_cms_edit->seccion_publicitaria->options(FALSE, TRUE)) ?>;
fsetting_cmsedit.lists["x_seccion_portfolio[]"] = <?php echo $setting_cms_edit->seccion_portfolio->Lookup->toClientList() ?>;
fsetting_cmsedit.lists["x_seccion_portfolio[]"].options = <?php echo JsonEncode($setting_cms_edit->seccion_portfolio->options(FALSE, TRUE)) ?>;
fsetting_cmsedit.lists["x_seccion_app[]"] = <?php echo $setting_cms_edit->seccion_app->Lookup->toClientList() ?>;
fsetting_cmsedit.lists["x_seccion_app[]"].options = <?php echo JsonEncode($setting_cms_edit->seccion_app->options(FALSE, TRUE)) ?>;
fsetting_cmsedit.lists["x_cookies_ley[]"] = <?php echo $setting_cms_edit->cookies_ley->Lookup->toClientList() ?>;
fsetting_cmsedit.lists["x_cookies_ley[]"].options = <?php echo JsonEncode($setting_cms_edit->cookies_ley->options(FALSE, TRUE)) ?>;
fsetting_cmsedit.lists["x_seccion_contact[]"] = <?php echo $setting_cms_edit->seccion_contact->Lookup->toClientList() ?>;
fsetting_cmsedit.lists["x_seccion_contact[]"].options = <?php echo JsonEncode($setting_cms_edit->seccion_contact->options(FALSE, TRUE)) ?>;
fsetting_cmsedit.lists["x_seccion_menufooter[]"] = <?php echo $setting_cms_edit->seccion_menufooter->Lookup->toClientList() ?>;
fsetting_cmsedit.lists["x_seccion_menufooter[]"].options = <?php echo JsonEncode($setting_cms_edit->seccion_menufooter->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $setting_cms_edit->showPageHeader(); ?>
<?php
$setting_cms_edit->showMessage();
?>
<form name="fsetting_cmsedit" id="fsetting_cmsedit" class="<?php echo $setting_cms_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($setting_cms_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $setting_cms_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="setting_cms">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$setting_cms_edit->IsModal ?>">
<?php if (!$setting_cms_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($setting_cms_edit->MultiPages->Items[0]->Visible) { ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page0 -->
<?php } else { ?>
<table id="tbl_setting_cmsedit0" class="table table-striped table-sm ew-desktop-table"><!-- page0 table -->
<?php } ?>
<?php if ($setting_cms->SettingcmsID->Visible) { // SettingcmsID ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_SettingcmsID" class="form-group row">
		<label id="elh_setting_cms_SettingcmsID" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->SettingcmsID->caption() ?><?php echo ($setting_cms->SettingcmsID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->SettingcmsID->cellAttributes() ?>>
<span id="el_setting_cms_SettingcmsID">
<span<?php echo $setting_cms->SettingcmsID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($setting_cms->SettingcmsID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="setting_cms" data-field="x_SettingcmsID" data-page="0" name="x_SettingcmsID" id="x_SettingcmsID" value="<?php echo HtmlEncode($setting_cms->SettingcmsID->CurrentValue) ?>">
<?php echo $setting_cms->SettingcmsID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_SettingcmsID">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_SettingcmsID"><?php echo $setting_cms->SettingcmsID->caption() ?><?php echo ($setting_cms->SettingcmsID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->SettingcmsID->cellAttributes() ?>>
<span id="el_setting_cms_SettingcmsID">
<span<?php echo $setting_cms->SettingcmsID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($setting_cms->SettingcmsID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="setting_cms" data-field="x_SettingcmsID" data-page="0" name="x_SettingcmsID" id="x_SettingcmsID" value="<?php echo HtmlEncode($setting_cms->SettingcmsID->CurrentValue) ?>">
<?php echo $setting_cms->SettingcmsID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
</div><!-- /page0 -->
<?php } else { ?>
</table><!-- /page0 table -->
<?php } ?>
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="setting_cms_edit"><!-- multi-page tabs -->
	<ul class="<?php echo $setting_cms_edit->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $setting_cms_edit->MultiPages->pageStyle("1") ?>" href="#tab_setting_cms1" data-toggle="tab"><?php echo $setting_cms->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $setting_cms_edit->MultiPages->pageStyle("2") ?>" href="#tab_setting_cms2" data-toggle="tab"><?php echo $setting_cms->pageCaption(2) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $setting_cms_edit->MultiPages->pageStyle("3") ?>" href="#tab_setting_cms3" data-toggle="tab"><?php echo $setting_cms->pageCaption(3) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $setting_cms_edit->MultiPages->pageStyle("4") ?>" href="#tab_setting_cms4" data-toggle="tab"><?php echo $setting_cms->pageCaption(4) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $setting_cms_edit->MultiPages->pageStyle("1") ?>" id="tab_setting_cms1"><!-- multi-page .tab-pane -->
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_setting_cmsedit1" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($setting_cms->seccion_slider->Visible) { // seccion_slider ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_seccion_slider" class="form-group row">
		<label id="elh_setting_cms_seccion_slider" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->seccion_slider->caption() ?><?php echo ($setting_cms->seccion_slider->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->seccion_slider->cellAttributes() ?>>
<span id="el_setting_cms_seccion_slider">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_slider->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_slider" data-page="1" name="x_seccion_slider[]" id="x_seccion_slider[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_slider->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_slider->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_seccion_slider">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_slider"><?php echo $setting_cms->seccion_slider->caption() ?><?php echo ($setting_cms->seccion_slider->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->seccion_slider->cellAttributes() ?>>
<span id="el_setting_cms_seccion_slider">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_slider->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_slider" data-page="1" name="x_seccion_slider[]" id="x_seccion_slider[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_slider->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_slider->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms->seccion_about->Visible) { // seccion_about ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_seccion_about" class="form-group row">
		<label id="elh_setting_cms_seccion_about" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->seccion_about->caption() ?><?php echo ($setting_cms->seccion_about->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->seccion_about->cellAttributes() ?>>
<span id="el_setting_cms_seccion_about">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_about->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_about" data-page="1" name="x_seccion_about[]" id="x_seccion_about[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_about->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_about->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_seccion_about">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_about"><?php echo $setting_cms->seccion_about->caption() ?><?php echo ($setting_cms->seccion_about->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->seccion_about->cellAttributes() ?>>
<span id="el_setting_cms_seccion_about">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_about->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_about" data-page="1" name="x_seccion_about[]" id="x_seccion_about[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_about->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_about->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms->seccion_service->Visible) { // seccion_service ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_seccion_service" class="form-group row">
		<label id="elh_setting_cms_seccion_service" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->seccion_service->caption() ?><?php echo ($setting_cms->seccion_service->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->seccion_service->cellAttributes() ?>>
<span id="el_setting_cms_seccion_service">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_service->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_service" data-page="1" name="x_seccion_service[]" id="x_seccion_service[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_service->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_service->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_seccion_service">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_service"><?php echo $setting_cms->seccion_service->caption() ?><?php echo ($setting_cms->seccion_service->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->seccion_service->cellAttributes() ?>>
<span id="el_setting_cms_seccion_service">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_service->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_service" data-page="1" name="x_seccion_service[]" id="x_seccion_service[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_service->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_service->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms->seccion_portfolio->Visible) { // seccion_portfolio ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_seccion_portfolio" class="form-group row">
		<label id="elh_setting_cms_seccion_portfolio" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->seccion_portfolio->caption() ?><?php echo ($setting_cms->seccion_portfolio->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->seccion_portfolio->cellAttributes() ?>>
<span id="el_setting_cms_seccion_portfolio">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_portfolio->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_portfolio" data-page="1" name="x_seccion_portfolio[]" id="x_seccion_portfolio[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_portfolio->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_portfolio->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_seccion_portfolio">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_portfolio"><?php echo $setting_cms->seccion_portfolio->caption() ?><?php echo ($setting_cms->seccion_portfolio->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->seccion_portfolio->cellAttributes() ?>>
<span id="el_setting_cms_seccion_portfolio">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_portfolio->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_portfolio" data-page="1" name="x_seccion_portfolio[]" id="x_seccion_portfolio[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_portfolio->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_portfolio->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms->seccion_app->Visible) { // seccion_app ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_seccion_app" class="form-group row">
		<label id="elh_setting_cms_seccion_app" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->seccion_app->caption() ?><?php echo ($setting_cms->seccion_app->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->seccion_app->cellAttributes() ?>>
<span id="el_setting_cms_seccion_app">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_app->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_app" data-page="1" name="x_seccion_app[]" id="x_seccion_app[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_app->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_app->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_seccion_app">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_app"><?php echo $setting_cms->seccion_app->caption() ?><?php echo ($setting_cms->seccion_app->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->seccion_app->cellAttributes() ?>>
<span id="el_setting_cms_seccion_app">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_app->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_app" data-page="1" name="x_seccion_app[]" id="x_seccion_app[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_app->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_app->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms->seccion_contact->Visible) { // seccion_contact ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_seccion_contact" class="form-group row">
		<label id="elh_setting_cms_seccion_contact" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->seccion_contact->caption() ?><?php echo ($setting_cms->seccion_contact->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->seccion_contact->cellAttributes() ?>>
<span id="el_setting_cms_seccion_contact">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_contact->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_contact" data-page="1" name="x_seccion_contact[]" id="x_seccion_contact[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_contact->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_contact->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_seccion_contact">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_contact"><?php echo $setting_cms->seccion_contact->caption() ?><?php echo ($setting_cms->seccion_contact->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->seccion_contact->cellAttributes() ?>>
<span id="el_setting_cms_seccion_contact">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_contact->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_contact" data-page="1" name="x_seccion_contact[]" id="x_seccion_contact[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_contact->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_contact->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms->seccion_menufooter->Visible) { // seccion_menufooter ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_seccion_menufooter" class="form-group row">
		<label id="elh_setting_cms_seccion_menufooter" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->seccion_menufooter->caption() ?><?php echo ($setting_cms->seccion_menufooter->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->seccion_menufooter->cellAttributes() ?>>
<span id="el_setting_cms_seccion_menufooter">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_menufooter->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_menufooter" data-page="1" name="x_seccion_menufooter[]" id="x_seccion_menufooter[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_menufooter->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_menufooter->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_seccion_menufooter">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_menufooter"><?php echo $setting_cms->seccion_menufooter->caption() ?><?php echo ($setting_cms->seccion_menufooter->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->seccion_menufooter->cellAttributes() ?>>
<span id="el_setting_cms_seccion_menufooter">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_menufooter->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_menufooter" data-page="1" name="x_seccion_menufooter[]" id="x_seccion_menufooter[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_menufooter->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_menufooter->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $setting_cms_edit->MultiPages->pageStyle("2") ?>" id="tab_setting_cms2"><!-- multi-page .tab-pane -->
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_setting_cmsedit2" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($setting_cms->seccion_publicitaria->Visible) { // seccion_publicitaria ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_seccion_publicitaria" class="form-group row">
		<label id="elh_setting_cms_seccion_publicitaria" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->seccion_publicitaria->caption() ?><?php echo ($setting_cms->seccion_publicitaria->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->seccion_publicitaria->cellAttributes() ?>>
<span id="el_setting_cms_seccion_publicitaria">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_publicitaria->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_publicitaria" data-page="2" name="x_seccion_publicitaria[]" id="x_seccion_publicitaria[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_publicitaria->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_publicitaria->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_seccion_publicitaria">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_seccion_publicitaria"><?php echo $setting_cms->seccion_publicitaria->caption() ?><?php echo ($setting_cms->seccion_publicitaria->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->seccion_publicitaria->cellAttributes() ?>>
<span id="el_setting_cms_seccion_publicitaria">
<?php
$selwrk = (ConvertToBool($setting_cms->seccion_publicitaria->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_seccion_publicitaria" data-page="2" name="x_seccion_publicitaria[]" id="x_seccion_publicitaria[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->seccion_publicitaria->editAttributes() ?>>
</span>
<?php echo $setting_cms->seccion_publicitaria->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms->banner_publicitario_titulo->Visible) { // banner_publicitario_titulo ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_banner_publicitario_titulo" class="form-group row">
		<label id="elh_setting_cms_banner_publicitario_titulo" for="x_banner_publicitario_titulo" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->banner_publicitario_titulo->caption() ?><?php echo ($setting_cms->banner_publicitario_titulo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->banner_publicitario_titulo->cellAttributes() ?>>
<span id="el_setting_cms_banner_publicitario_titulo">
<input type="text" data-table="setting_cms" data-field="x_banner_publicitario_titulo" data-page="2" name="x_banner_publicitario_titulo" id="x_banner_publicitario_titulo" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($setting_cms->banner_publicitario_titulo->getPlaceHolder()) ?>" value="<?php echo $setting_cms->banner_publicitario_titulo->EditValue ?>"<?php echo $setting_cms->banner_publicitario_titulo->editAttributes() ?>>
</span>
<?php echo $setting_cms->banner_publicitario_titulo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_banner_publicitario_titulo">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_banner_publicitario_titulo"><?php echo $setting_cms->banner_publicitario_titulo->caption() ?><?php echo ($setting_cms->banner_publicitario_titulo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->banner_publicitario_titulo->cellAttributes() ?>>
<span id="el_setting_cms_banner_publicitario_titulo">
<input type="text" data-table="setting_cms" data-field="x_banner_publicitario_titulo" data-page="2" name="x_banner_publicitario_titulo" id="x_banner_publicitario_titulo" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($setting_cms->banner_publicitario_titulo->getPlaceHolder()) ?>" value="<?php echo $setting_cms->banner_publicitario_titulo->EditValue ?>"<?php echo $setting_cms->banner_publicitario_titulo->editAttributes() ?>>
</span>
<?php echo $setting_cms->banner_publicitario_titulo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms->banner_publicitario_detalle->Visible) { // banner_publicitario_detalle ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_banner_publicitario_detalle" class="form-group row">
		<label id="elh_setting_cms_banner_publicitario_detalle" for="x_banner_publicitario_detalle" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->banner_publicitario_detalle->caption() ?><?php echo ($setting_cms->banner_publicitario_detalle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->banner_publicitario_detalle->cellAttributes() ?>>
<span id="el_setting_cms_banner_publicitario_detalle">
<input type="text" data-table="setting_cms" data-field="x_banner_publicitario_detalle" data-page="2" name="x_banner_publicitario_detalle" id="x_banner_publicitario_detalle" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($setting_cms->banner_publicitario_detalle->getPlaceHolder()) ?>" value="<?php echo $setting_cms->banner_publicitario_detalle->EditValue ?>"<?php echo $setting_cms->banner_publicitario_detalle->editAttributes() ?>>
</span>
<?php echo $setting_cms->banner_publicitario_detalle->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_banner_publicitario_detalle">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_banner_publicitario_detalle"><?php echo $setting_cms->banner_publicitario_detalle->caption() ?><?php echo ($setting_cms->banner_publicitario_detalle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->banner_publicitario_detalle->cellAttributes() ?>>
<span id="el_setting_cms_banner_publicitario_detalle">
<input type="text" data-table="setting_cms" data-field="x_banner_publicitario_detalle" data-page="2" name="x_banner_publicitario_detalle" id="x_banner_publicitario_detalle" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($setting_cms->banner_publicitario_detalle->getPlaceHolder()) ?>" value="<?php echo $setting_cms->banner_publicitario_detalle->EditValue ?>"<?php echo $setting_cms->banner_publicitario_detalle->editAttributes() ?>>
</span>
<?php echo $setting_cms->banner_publicitario_detalle->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms->banner_publicitario_btnNombre->Visible) { // banner_publicitario_btnNombre ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_banner_publicitario_btnNombre" class="form-group row">
		<label id="elh_setting_cms_banner_publicitario_btnNombre" for="x_banner_publicitario_btnNombre" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->banner_publicitario_btnNombre->caption() ?><?php echo ($setting_cms->banner_publicitario_btnNombre->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->banner_publicitario_btnNombre->cellAttributes() ?>>
<span id="el_setting_cms_banner_publicitario_btnNombre">
<input type="text" data-table="setting_cms" data-field="x_banner_publicitario_btnNombre" data-page="2" name="x_banner_publicitario_btnNombre" id="x_banner_publicitario_btnNombre" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($setting_cms->banner_publicitario_btnNombre->getPlaceHolder()) ?>" value="<?php echo $setting_cms->banner_publicitario_btnNombre->EditValue ?>"<?php echo $setting_cms->banner_publicitario_btnNombre->editAttributes() ?>>
</span>
<?php echo $setting_cms->banner_publicitario_btnNombre->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_banner_publicitario_btnNombre">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_banner_publicitario_btnNombre"><?php echo $setting_cms->banner_publicitario_btnNombre->caption() ?><?php echo ($setting_cms->banner_publicitario_btnNombre->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->banner_publicitario_btnNombre->cellAttributes() ?>>
<span id="el_setting_cms_banner_publicitario_btnNombre">
<input type="text" data-table="setting_cms" data-field="x_banner_publicitario_btnNombre" data-page="2" name="x_banner_publicitario_btnNombre" id="x_banner_publicitario_btnNombre" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($setting_cms->banner_publicitario_btnNombre->getPlaceHolder()) ?>" value="<?php echo $setting_cms->banner_publicitario_btnNombre->EditValue ?>"<?php echo $setting_cms->banner_publicitario_btnNombre->editAttributes() ?>>
</span>
<?php echo $setting_cms->banner_publicitario_btnNombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms->banner_publicitario_url->Visible) { // banner_publicitario_url ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_banner_publicitario_url" class="form-group row">
		<label id="elh_setting_cms_banner_publicitario_url" for="x_banner_publicitario_url" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->banner_publicitario_url->caption() ?><?php echo ($setting_cms->banner_publicitario_url->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->banner_publicitario_url->cellAttributes() ?>>
<span id="el_setting_cms_banner_publicitario_url">
<input type="text" data-table="setting_cms" data-field="x_banner_publicitario_url" data-page="2" name="x_banner_publicitario_url" id="x_banner_publicitario_url" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($setting_cms->banner_publicitario_url->getPlaceHolder()) ?>" value="<?php echo $setting_cms->banner_publicitario_url->EditValue ?>"<?php echo $setting_cms->banner_publicitario_url->editAttributes() ?>>
</span>
<?php echo $setting_cms->banner_publicitario_url->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_banner_publicitario_url">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_banner_publicitario_url"><?php echo $setting_cms->banner_publicitario_url->caption() ?><?php echo ($setting_cms->banner_publicitario_url->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->banner_publicitario_url->cellAttributes() ?>>
<span id="el_setting_cms_banner_publicitario_url">
<input type="text" data-table="setting_cms" data-field="x_banner_publicitario_url" data-page="2" name="x_banner_publicitario_url" id="x_banner_publicitario_url" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($setting_cms->banner_publicitario_url->getPlaceHolder()) ?>" value="<?php echo $setting_cms->banner_publicitario_url->EditValue ?>"<?php echo $setting_cms->banner_publicitario_url->editAttributes() ?>>
</span>
<?php echo $setting_cms->banner_publicitario_url->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $setting_cms_edit->MultiPages->pageStyle("3") ?>" id="tab_setting_cms3"><!-- multi-page .tab-pane -->
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_setting_cmsedit3" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($setting_cms->link_app_android->Visible) { // link_app_android ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_link_app_android" class="form-group row">
		<label id="elh_setting_cms_link_app_android" for="x_link_app_android" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->link_app_android->caption() ?><?php echo ($setting_cms->link_app_android->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->link_app_android->cellAttributes() ?>>
<span id="el_setting_cms_link_app_android">
<input type="text" data-table="setting_cms" data-field="x_link_app_android" data-page="3" name="x_link_app_android" id="x_link_app_android" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($setting_cms->link_app_android->getPlaceHolder()) ?>" value="<?php echo $setting_cms->link_app_android->EditValue ?>"<?php echo $setting_cms->link_app_android->editAttributes() ?>>
</span>
<?php echo $setting_cms->link_app_android->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_link_app_android">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_link_app_android"><?php echo $setting_cms->link_app_android->caption() ?><?php echo ($setting_cms->link_app_android->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->link_app_android->cellAttributes() ?>>
<span id="el_setting_cms_link_app_android">
<input type="text" data-table="setting_cms" data-field="x_link_app_android" data-page="3" name="x_link_app_android" id="x_link_app_android" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($setting_cms->link_app_android->getPlaceHolder()) ?>" value="<?php echo $setting_cms->link_app_android->EditValue ?>"<?php echo $setting_cms->link_app_android->editAttributes() ?>>
</span>
<?php echo $setting_cms->link_app_android->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms->link_app_iphone->Visible) { // link_app_iphone ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_link_app_iphone" class="form-group row">
		<label id="elh_setting_cms_link_app_iphone" for="x_link_app_iphone" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->link_app_iphone->caption() ?><?php echo ($setting_cms->link_app_iphone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->link_app_iphone->cellAttributes() ?>>
<span id="el_setting_cms_link_app_iphone">
<input type="text" data-table="setting_cms" data-field="x_link_app_iphone" data-page="3" name="x_link_app_iphone" id="x_link_app_iphone" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($setting_cms->link_app_iphone->getPlaceHolder()) ?>" value="<?php echo $setting_cms->link_app_iphone->EditValue ?>"<?php echo $setting_cms->link_app_iphone->editAttributes() ?>>
</span>
<?php echo $setting_cms->link_app_iphone->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_link_app_iphone">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_link_app_iphone"><?php echo $setting_cms->link_app_iphone->caption() ?><?php echo ($setting_cms->link_app_iphone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->link_app_iphone->cellAttributes() ?>>
<span id="el_setting_cms_link_app_iphone">
<input type="text" data-table="setting_cms" data-field="x_link_app_iphone" data-page="3" name="x_link_app_iphone" id="x_link_app_iphone" size="30" maxlength="150" placeholder="<?php echo HtmlEncode($setting_cms->link_app_iphone->getPlaceHolder()) ?>" value="<?php echo $setting_cms->link_app_iphone->EditValue ?>"<?php echo $setting_cms->link_app_iphone->editAttributes() ?>>
</span>
<?php echo $setting_cms->link_app_iphone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $setting_cms_edit->MultiPages->pageStyle("4") ?>" id="tab_setting_cms4"><!-- multi-page .tab-pane -->
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_setting_cmsedit4" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($setting_cms->cookies_ley->Visible) { // cookies_ley ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_cookies_ley" class="form-group row">
		<label id="elh_setting_cms_cookies_ley" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->cookies_ley->caption() ?><?php echo ($setting_cms->cookies_ley->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->cookies_ley->cellAttributes() ?>>
<span id="el_setting_cms_cookies_ley">
<?php
$selwrk = (ConvertToBool($setting_cms->cookies_ley->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_cookies_ley" data-page="4" name="x_cookies_ley[]" id="x_cookies_ley[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->cookies_ley->editAttributes() ?>>
</span>
<?php echo $setting_cms->cookies_ley->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cookies_ley">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_cookies_ley"><?php echo $setting_cms->cookies_ley->caption() ?><?php echo ($setting_cms->cookies_ley->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->cookies_ley->cellAttributes() ?>>
<span id="el_setting_cms_cookies_ley">
<?php
$selwrk = (ConvertToBool($setting_cms->cookies_ley->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="setting_cms" data-field="x_cookies_ley" data-page="4" name="x_cookies_ley[]" id="x_cookies_ley[]" value="1"<?php echo $selwrk ?><?php echo $setting_cms->cookies_ley->editAttributes() ?>>
</span>
<?php echo $setting_cms->cookies_ley->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms->cookies_questions->Visible) { // cookies_questions ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_cookies_questions" class="form-group row">
		<label id="elh_setting_cms_cookies_questions" for="x_cookies_questions" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->cookies_questions->caption() ?><?php echo ($setting_cms->cookies_questions->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->cookies_questions->cellAttributes() ?>>
<span id="el_setting_cms_cookies_questions">
<input type="text" data-table="setting_cms" data-field="x_cookies_questions" data-page="4" name="x_cookies_questions" id="x_cookies_questions" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($setting_cms->cookies_questions->getPlaceHolder()) ?>" value="<?php echo $setting_cms->cookies_questions->EditValue ?>"<?php echo $setting_cms->cookies_questions->editAttributes() ?>>
</span>
<?php echo $setting_cms->cookies_questions->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cookies_questions">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_cookies_questions"><?php echo $setting_cms->cookies_questions->caption() ?><?php echo ($setting_cms->cookies_questions->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->cookies_questions->cellAttributes() ?>>
<span id="el_setting_cms_cookies_questions">
<input type="text" data-table="setting_cms" data-field="x_cookies_questions" data-page="4" name="x_cookies_questions" id="x_cookies_questions" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($setting_cms->cookies_questions->getPlaceHolder()) ?>" value="<?php echo $setting_cms->cookies_questions->EditValue ?>"<?php echo $setting_cms->cookies_questions->editAttributes() ?>>
</span>
<?php echo $setting_cms->cookies_questions->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms->cookies_detalle->Visible) { // cookies_detalle ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
	<div id="r_cookies_detalle" class="form-group row">
		<label id="elh_setting_cms_cookies_detalle" for="x_cookies_detalle" class="<?php echo $setting_cms_edit->LeftColumnClass ?>"><?php echo $setting_cms->cookies_detalle->caption() ?><?php echo ($setting_cms->cookies_detalle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $setting_cms_edit->RightColumnClass ?>"><div<?php echo $setting_cms->cookies_detalle->cellAttributes() ?>>
<span id="el_setting_cms_cookies_detalle">
<textarea data-table="setting_cms" data-field="x_cookies_detalle" data-page="4" name="x_cookies_detalle" id="x_cookies_detalle" cols="35" rows="4" placeholder="<?php echo HtmlEncode($setting_cms->cookies_detalle->getPlaceHolder()) ?>"<?php echo $setting_cms->cookies_detalle->editAttributes() ?>><?php echo $setting_cms->cookies_detalle->EditValue ?></textarea>
</span>
<?php echo $setting_cms->cookies_detalle->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cookies_detalle">
		<td class="<?php echo $setting_cms_edit->TableLeftColumnClass ?>"><span id="elh_setting_cms_cookies_detalle"><?php echo $setting_cms->cookies_detalle->caption() ?><?php echo ($setting_cms->cookies_detalle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $setting_cms->cookies_detalle->cellAttributes() ?>>
<span id="el_setting_cms_cookies_detalle">
<textarea data-table="setting_cms" data-field="x_cookies_detalle" data-page="4" name="x_cookies_detalle" id="x_cookies_detalle" cols="35" rows="4" placeholder="<?php echo HtmlEncode($setting_cms->cookies_detalle->getPlaceHolder()) ?>"<?php echo $setting_cms->cookies_detalle->editAttributes() ?>><?php echo $setting_cms->cookies_detalle->EditValue ?></textarea>
</span>
<?php echo $setting_cms->cookies_detalle->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($setting_cms_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
<span id="el_setting_cms_updated_at">
<input type="hidden" data-table="setting_cms" data-field="x_updated_at" data-page="0" name="x_updated_at" id="x_updated_at" value="<?php echo HtmlEncode($setting_cms->updated_at->CurrentValue) ?>">
</span>
<span id="el_setting_cms_usuario_id">
<input type="hidden" data-table="setting_cms" data-field="x_usuario_id" data-page="0" name="x_usuario_id" id="x_usuario_id" value="<?php echo HtmlEncode($setting_cms->usuario_id->CurrentValue) ?>">
</span>
<?php if (!$setting_cms_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $setting_cms_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $setting_cms_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$setting_cms_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$setting_cms_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$setting_cms_edit->terminate();
?>