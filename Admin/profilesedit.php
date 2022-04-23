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
$profiles_edit = new profiles_edit();

// Run the page
$profiles_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$profiles_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fprofilesedit = currentForm = new ew.Form("fprofilesedit", "edit");

// Validate form
fprofilesedit.validate = function() {
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
		<?php if ($profiles_edit->id->Required) { ?>
			elm = this.getElements("x" + infix + "_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profiles->id->caption(), $profiles->id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($profiles_edit->title->Required) { ?>
			elm = this.getElements("x" + infix + "_title");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profiles->title->caption(), $profiles->title->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($profiles_edit->biography->Required) { ?>
			elm = this.getElements("x" + infix + "_biography");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profiles->biography->caption(), $profiles->biography->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($profiles_edit->imagen->Required) { ?>
			felm = this.getElements("x" + infix + "_imagen");
			elm = this.getElements("fn_x" + infix + "_imagen");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $profiles->imagen->caption(), $profiles->imagen->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($profiles_edit->maps_iframe->Required) { ?>
			elm = this.getElements("x" + infix + "_maps_iframe");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profiles->maps_iframe->caption(), $profiles->maps_iframe->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($profiles_edit->website->Required) { ?>
			elm = this.getElements("x" + infix + "_website");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profiles->website->caption(), $profiles->website->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($profiles_edit->facebook->Required) { ?>
			elm = this.getElements("x" + infix + "_facebook");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profiles->facebook->caption(), $profiles->facebook->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($profiles_edit->linkedin->Required) { ?>
			elm = this.getElements("x" + infix + "_linkedin");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profiles->linkedin->caption(), $profiles->linkedin->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($profiles_edit->youtube->Required) { ?>
			elm = this.getElements("x" + infix + "_youtube");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profiles->youtube->caption(), $profiles->youtube->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($profiles_edit->instagram->Required) { ?>
			elm = this.getElements("x" + infix + "_instagram");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profiles->instagram->caption(), $profiles->instagram->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($profiles_edit->user_id->Required) { ?>
			elm = this.getElements("x" + infix + "_user_id");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profiles->user_id->caption(), $profiles->user_id->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($profiles_edit->created_at->Required) { ?>
			elm = this.getElements("x" + infix + "_created_at");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profiles->created_at->caption(), $profiles->created_at->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($profiles_edit->updated_at->Required) { ?>
			elm = this.getElements("x" + infix + "_updated_at");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $profiles->updated_at->caption(), $profiles->updated_at->RequiredErrorMessage)) ?>");
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
fprofilesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fprofilesedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Multi-Page
fprofilesedit.multiPage = new ew.MultiPage("fprofilesedit");

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $profiles_edit->showPageHeader(); ?>
<?php
$profiles_edit->showMessage();
?>
<form name="fprofilesedit" id="fprofilesedit" class="<?php echo $profiles_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($profiles_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $profiles_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="profiles">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$profiles_edit->IsModal ?>">
<?php if (!$profiles_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="profiles_edit"><!-- multi-page tabs -->
	<ul class="<?php echo $profiles_edit->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $profiles_edit->MultiPages->pageStyle("1") ?>" href="#tab_profiles1" data-toggle="tab"><?php echo $profiles->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $profiles_edit->MultiPages->pageStyle("2") ?>" href="#tab_profiles2" data-toggle="tab"><?php echo $profiles->pageCaption(2) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $profiles_edit->MultiPages->pageStyle("3") ?>" href="#tab_profiles3" data-toggle="tab"><?php echo $profiles->pageCaption(3) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $profiles_edit->MultiPages->pageStyle("1") ?>" id="tab_profiles1"><!-- multi-page .tab-pane -->
<?php if ($profiles_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_profilesedit1" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($profiles->id->Visible) { // id ?>
<?php if ($profiles_edit->IsMobileOrModal) { ?>
	<div id="r_id" class="form-group row">
		<label id="elh_profiles_id" class="<?php echo $profiles_edit->LeftColumnClass ?>"><?php echo $profiles->id->caption() ?><?php echo ($profiles->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $profiles_edit->RightColumnClass ?>"><div<?php echo $profiles->id->cellAttributes() ?>>
<span id="el_profiles_id">
<span<?php echo $profiles->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($profiles->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="profiles" data-field="x_id" data-page="1" name="x_id" id="x_id" value="<?php echo HtmlEncode($profiles->id->CurrentValue) ?>">
<?php echo $profiles->id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id">
		<td class="<?php echo $profiles_edit->TableLeftColumnClass ?>"><span id="elh_profiles_id"><?php echo $profiles->id->caption() ?><?php echo ($profiles->id->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $profiles->id->cellAttributes() ?>>
<span id="el_profiles_id">
<span<?php echo $profiles->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($profiles->id->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="profiles" data-field="x_id" data-page="1" name="x_id" id="x_id" value="<?php echo HtmlEncode($profiles->id->CurrentValue) ?>">
<?php echo $profiles->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($profiles->title->Visible) { // title ?>
<?php if ($profiles_edit->IsMobileOrModal) { ?>
	<div id="r_title" class="form-group row">
		<label id="elh_profiles_title" for="x_title" class="<?php echo $profiles_edit->LeftColumnClass ?>"><?php echo $profiles->title->caption() ?><?php echo ($profiles->title->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $profiles_edit->RightColumnClass ?>"><div<?php echo $profiles->title->cellAttributes() ?>>
<span id="el_profiles_title">
<input type="text" data-table="profiles" data-field="x_title" data-page="1" name="x_title" id="x_title" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($profiles->title->getPlaceHolder()) ?>" value="<?php echo $profiles->title->EditValue ?>"<?php echo $profiles->title->editAttributes() ?>>
</span>
<?php echo $profiles->title->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_title">
		<td class="<?php echo $profiles_edit->TableLeftColumnClass ?>"><span id="elh_profiles_title"><?php echo $profiles->title->caption() ?><?php echo ($profiles->title->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $profiles->title->cellAttributes() ?>>
<span id="el_profiles_title">
<input type="text" data-table="profiles" data-field="x_title" data-page="1" name="x_title" id="x_title" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($profiles->title->getPlaceHolder()) ?>" value="<?php echo $profiles->title->EditValue ?>"<?php echo $profiles->title->editAttributes() ?>>
</span>
<?php echo $profiles->title->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($profiles->biography->Visible) { // biography ?>
<?php if ($profiles_edit->IsMobileOrModal) { ?>
	<div id="r_biography" class="form-group row">
		<label id="elh_profiles_biography" for="x_biography" class="<?php echo $profiles_edit->LeftColumnClass ?>"><?php echo $profiles->biography->caption() ?><?php echo ($profiles->biography->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $profiles_edit->RightColumnClass ?>"><div<?php echo $profiles->biography->cellAttributes() ?>>
<span id="el_profiles_biography">
<textarea data-table="profiles" data-field="x_biography" data-page="1" name="x_biography" id="x_biography" cols="35" rows="4" placeholder="<?php echo HtmlEncode($profiles->biography->getPlaceHolder()) ?>"<?php echo $profiles->biography->editAttributes() ?>><?php echo $profiles->biography->EditValue ?></textarea>
</span>
<?php echo $profiles->biography->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_biography">
		<td class="<?php echo $profiles_edit->TableLeftColumnClass ?>"><span id="elh_profiles_biography"><?php echo $profiles->biography->caption() ?><?php echo ($profiles->biography->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $profiles->biography->cellAttributes() ?>>
<span id="el_profiles_biography">
<textarea data-table="profiles" data-field="x_biography" data-page="1" name="x_biography" id="x_biography" cols="35" rows="4" placeholder="<?php echo HtmlEncode($profiles->biography->getPlaceHolder()) ?>"<?php echo $profiles->biography->editAttributes() ?>><?php echo $profiles->biography->EditValue ?></textarea>
</span>
<?php echo $profiles->biography->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($profiles->imagen->Visible) { // imagen ?>
<?php if ($profiles_edit->IsMobileOrModal) { ?>
	<div id="r_imagen" class="form-group row">
		<label id="elh_profiles_imagen" class="<?php echo $profiles_edit->LeftColumnClass ?>"><?php echo $profiles->imagen->caption() ?><?php echo ($profiles->imagen->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $profiles_edit->RightColumnClass ?>"><div<?php echo $profiles->imagen->cellAttributes() ?>>
<span id="el_profiles_imagen">
<div id="fd_x_imagen">
<span title="<?php echo $profiles->imagen->title() ? $profiles->imagen->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($profiles->imagen->ReadOnly || $profiles->imagen->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="profiles" data-field="x_imagen" data-page="1" name="x_imagen" id="x_imagen"<?php echo $profiles->imagen->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen" id= "fn_x_imagen" value="<?php echo $profiles->imagen->Upload->FileName ?>">
<?php if (Post("fa_x_imagen") == "0") { ?>
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen" id= "fs_x_imagen" value="250">
<input type="hidden" name="fx_x_imagen" id= "fx_x_imagen" value="<?php echo $profiles->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen" id= "fm_x_imagen" value="<?php echo $profiles->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $profiles->imagen->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen">
		<td class="<?php echo $profiles_edit->TableLeftColumnClass ?>"><span id="elh_profiles_imagen"><?php echo $profiles->imagen->caption() ?><?php echo ($profiles->imagen->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $profiles->imagen->cellAttributes() ?>>
<span id="el_profiles_imagen">
<div id="fd_x_imagen">
<span title="<?php echo $profiles->imagen->title() ? $profiles->imagen->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($profiles->imagen->ReadOnly || $profiles->imagen->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="profiles" data-field="x_imagen" data-page="1" name="x_imagen" id="x_imagen"<?php echo $profiles->imagen->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen" id= "fn_x_imagen" value="<?php echo $profiles->imagen->Upload->FileName ?>">
<?php if (Post("fa_x_imagen") == "0") { ?>
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen" id= "fs_x_imagen" value="250">
<input type="hidden" name="fx_x_imagen" id= "fx_x_imagen" value="<?php echo $profiles->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen" id= "fm_x_imagen" value="<?php echo $profiles->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $profiles->imagen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($profiles_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $profiles_edit->MultiPages->pageStyle("2") ?>" id="tab_profiles2"><!-- multi-page .tab-pane -->
<?php if ($profiles_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_profilesedit2" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($profiles->website->Visible) { // website ?>
<?php if ($profiles_edit->IsMobileOrModal) { ?>
	<div id="r_website" class="form-group row">
		<label id="elh_profiles_website" for="x_website" class="<?php echo $profiles_edit->LeftColumnClass ?>"><?php echo $profiles->website->caption() ?><?php echo ($profiles->website->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $profiles_edit->RightColumnClass ?>"><div<?php echo $profiles->website->cellAttributes() ?>>
<span id="el_profiles_website">
<input type="text" data-table="profiles" data-field="x_website" data-page="2" name="x_website" id="x_website" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($profiles->website->getPlaceHolder()) ?>" value="<?php echo $profiles->website->EditValue ?>"<?php echo $profiles->website->editAttributes() ?>>
</span>
<?php echo $profiles->website->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_website">
		<td class="<?php echo $profiles_edit->TableLeftColumnClass ?>"><span id="elh_profiles_website"><?php echo $profiles->website->caption() ?><?php echo ($profiles->website->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $profiles->website->cellAttributes() ?>>
<span id="el_profiles_website">
<input type="text" data-table="profiles" data-field="x_website" data-page="2" name="x_website" id="x_website" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($profiles->website->getPlaceHolder()) ?>" value="<?php echo $profiles->website->EditValue ?>"<?php echo $profiles->website->editAttributes() ?>>
</span>
<?php echo $profiles->website->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($profiles->facebook->Visible) { // facebook ?>
<?php if ($profiles_edit->IsMobileOrModal) { ?>
	<div id="r_facebook" class="form-group row">
		<label id="elh_profiles_facebook" for="x_facebook" class="<?php echo $profiles_edit->LeftColumnClass ?>"><?php echo $profiles->facebook->caption() ?><?php echo ($profiles->facebook->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $profiles_edit->RightColumnClass ?>"><div<?php echo $profiles->facebook->cellAttributes() ?>>
<span id="el_profiles_facebook">
<input type="text" data-table="profiles" data-field="x_facebook" data-page="2" name="x_facebook" id="x_facebook" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($profiles->facebook->getPlaceHolder()) ?>" value="<?php echo $profiles->facebook->EditValue ?>"<?php echo $profiles->facebook->editAttributes() ?>>
</span>
<?php echo $profiles->facebook->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_facebook">
		<td class="<?php echo $profiles_edit->TableLeftColumnClass ?>"><span id="elh_profiles_facebook"><?php echo $profiles->facebook->caption() ?><?php echo ($profiles->facebook->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $profiles->facebook->cellAttributes() ?>>
<span id="el_profiles_facebook">
<input type="text" data-table="profiles" data-field="x_facebook" data-page="2" name="x_facebook" id="x_facebook" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($profiles->facebook->getPlaceHolder()) ?>" value="<?php echo $profiles->facebook->EditValue ?>"<?php echo $profiles->facebook->editAttributes() ?>>
</span>
<?php echo $profiles->facebook->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($profiles->linkedin->Visible) { // linkedin ?>
<?php if ($profiles_edit->IsMobileOrModal) { ?>
	<div id="r_linkedin" class="form-group row">
		<label id="elh_profiles_linkedin" for="x_linkedin" class="<?php echo $profiles_edit->LeftColumnClass ?>"><?php echo $profiles->linkedin->caption() ?><?php echo ($profiles->linkedin->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $profiles_edit->RightColumnClass ?>"><div<?php echo $profiles->linkedin->cellAttributes() ?>>
<span id="el_profiles_linkedin">
<input type="text" data-table="profiles" data-field="x_linkedin" data-page="2" name="x_linkedin" id="x_linkedin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($profiles->linkedin->getPlaceHolder()) ?>" value="<?php echo $profiles->linkedin->EditValue ?>"<?php echo $profiles->linkedin->editAttributes() ?>>
</span>
<?php echo $profiles->linkedin->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_linkedin">
		<td class="<?php echo $profiles_edit->TableLeftColumnClass ?>"><span id="elh_profiles_linkedin"><?php echo $profiles->linkedin->caption() ?><?php echo ($profiles->linkedin->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $profiles->linkedin->cellAttributes() ?>>
<span id="el_profiles_linkedin">
<input type="text" data-table="profiles" data-field="x_linkedin" data-page="2" name="x_linkedin" id="x_linkedin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($profiles->linkedin->getPlaceHolder()) ?>" value="<?php echo $profiles->linkedin->EditValue ?>"<?php echo $profiles->linkedin->editAttributes() ?>>
</span>
<?php echo $profiles->linkedin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($profiles->youtube->Visible) { // youtube ?>
<?php if ($profiles_edit->IsMobileOrModal) { ?>
	<div id="r_youtube" class="form-group row">
		<label id="elh_profiles_youtube" for="x_youtube" class="<?php echo $profiles_edit->LeftColumnClass ?>"><?php echo $profiles->youtube->caption() ?><?php echo ($profiles->youtube->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $profiles_edit->RightColumnClass ?>"><div<?php echo $profiles->youtube->cellAttributes() ?>>
<span id="el_profiles_youtube">
<input type="text" data-table="profiles" data-field="x_youtube" data-page="2" name="x_youtube" id="x_youtube" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($profiles->youtube->getPlaceHolder()) ?>" value="<?php echo $profiles->youtube->EditValue ?>"<?php echo $profiles->youtube->editAttributes() ?>>
</span>
<?php echo $profiles->youtube->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_youtube">
		<td class="<?php echo $profiles_edit->TableLeftColumnClass ?>"><span id="elh_profiles_youtube"><?php echo $profiles->youtube->caption() ?><?php echo ($profiles->youtube->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $profiles->youtube->cellAttributes() ?>>
<span id="el_profiles_youtube">
<input type="text" data-table="profiles" data-field="x_youtube" data-page="2" name="x_youtube" id="x_youtube" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($profiles->youtube->getPlaceHolder()) ?>" value="<?php echo $profiles->youtube->EditValue ?>"<?php echo $profiles->youtube->editAttributes() ?>>
</span>
<?php echo $profiles->youtube->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($profiles->instagram->Visible) { // instagram ?>
<?php if ($profiles_edit->IsMobileOrModal) { ?>
	<div id="r_instagram" class="form-group row">
		<label id="elh_profiles_instagram" for="x_instagram" class="<?php echo $profiles_edit->LeftColumnClass ?>"><?php echo $profiles->instagram->caption() ?><?php echo ($profiles->instagram->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $profiles_edit->RightColumnClass ?>"><div<?php echo $profiles->instagram->cellAttributes() ?>>
<span id="el_profiles_instagram">
<input type="text" data-table="profiles" data-field="x_instagram" data-page="2" name="x_instagram" id="x_instagram" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($profiles->instagram->getPlaceHolder()) ?>" value="<?php echo $profiles->instagram->EditValue ?>"<?php echo $profiles->instagram->editAttributes() ?>>
</span>
<?php echo $profiles->instagram->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_instagram">
		<td class="<?php echo $profiles_edit->TableLeftColumnClass ?>"><span id="elh_profiles_instagram"><?php echo $profiles->instagram->caption() ?><?php echo ($profiles->instagram->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $profiles->instagram->cellAttributes() ?>>
<span id="el_profiles_instagram">
<input type="text" data-table="profiles" data-field="x_instagram" data-page="2" name="x_instagram" id="x_instagram" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($profiles->instagram->getPlaceHolder()) ?>" value="<?php echo $profiles->instagram->EditValue ?>"<?php echo $profiles->instagram->editAttributes() ?>>
</span>
<?php echo $profiles->instagram->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($profiles_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $profiles_edit->MultiPages->pageStyle("3") ?>" id="tab_profiles3"><!-- multi-page .tab-pane -->
<?php if ($profiles_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_profilesedit3" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($profiles->maps_iframe->Visible) { // maps_iframe ?>
<?php if ($profiles_edit->IsMobileOrModal) { ?>
	<div id="r_maps_iframe" class="form-group row">
		<label id="elh_profiles_maps_iframe" for="x_maps_iframe" class="<?php echo $profiles_edit->LeftColumnClass ?>"><?php echo $profiles->maps_iframe->caption() ?><?php echo ($profiles->maps_iframe->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $profiles_edit->RightColumnClass ?>"><div<?php echo $profiles->maps_iframe->cellAttributes() ?>>
<span id="el_profiles_maps_iframe">
<textarea data-table="profiles" data-field="x_maps_iframe" data-page="3" name="x_maps_iframe" id="x_maps_iframe" cols="35" rows="4" placeholder="<?php echo HtmlEncode($profiles->maps_iframe->getPlaceHolder()) ?>"<?php echo $profiles->maps_iframe->editAttributes() ?>><?php echo $profiles->maps_iframe->EditValue ?></textarea>
</span>
<?php echo $profiles->maps_iframe->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_maps_iframe">
		<td class="<?php echo $profiles_edit->TableLeftColumnClass ?>"><span id="elh_profiles_maps_iframe"><?php echo $profiles->maps_iframe->caption() ?><?php echo ($profiles->maps_iframe->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $profiles->maps_iframe->cellAttributes() ?>>
<span id="el_profiles_maps_iframe">
<textarea data-table="profiles" data-field="x_maps_iframe" data-page="3" name="x_maps_iframe" id="x_maps_iframe" cols="35" rows="4" placeholder="<?php echo HtmlEncode($profiles->maps_iframe->getPlaceHolder()) ?>"<?php echo $profiles->maps_iframe->editAttributes() ?>><?php echo $profiles->maps_iframe->EditValue ?></textarea>
</span>
<?php echo $profiles->maps_iframe->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($profiles_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
<span id="el_profiles_user_id">
<input type="hidden" data-table="profiles" data-field="x_user_id" data-page="1" name="x_user_id" id="x_user_id" value="<?php echo HtmlEncode($profiles->user_id->CurrentValue) ?>">
</span>
<span id="el_profiles_created_at">
<input type="hidden" data-table="profiles" data-field="x_created_at" data-page="1" name="x_created_at" id="x_created_at" value="<?php echo HtmlEncode($profiles->created_at->CurrentValue) ?>">
</span>
<span id="el_profiles_updated_at">
<input type="hidden" data-table="profiles" data-field="x_updated_at" data-page="1" name="x_updated_at" id="x_updated_at" value="<?php echo HtmlEncode($profiles->updated_at->CurrentValue) ?>">
</span>
<?php if (!$profiles_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $profiles_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $profiles_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$profiles_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$profiles_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$profiles_edit->terminate();
?>