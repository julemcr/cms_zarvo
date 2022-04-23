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
$slidercm_add = new slidercm_add();

// Run the page
$slidercm_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$slidercm_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fslidercmadd = currentForm = new ew.Form("fslidercmadd", "add");

// Validate form
fslidercmadd.validate = function() {
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
		<?php if ($slidercm_add->Titulo->Required) { ?>
			elm = this.getElements("x" + infix + "_Titulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $slidercm->Titulo->caption(), $slidercm->Titulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($slidercm_add->Detalle->Required) { ?>
			elm = this.getElements("x" + infix + "_Detalle");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $slidercm->Detalle->caption(), $slidercm->Detalle->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($slidercm_add->Url_image->Required) { ?>
			felm = this.getElements("x" + infix + "_Url_image");
			elm = this.getElements("fn_x" + infix + "_Url_image");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $slidercm->Url_image->caption(), $slidercm->Url_image->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($slidercm_add->Orden->Required) { ?>
			elm = this.getElements("x" + infix + "_Orden");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $slidercm->Orden->caption(), $slidercm->Orden->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_Orden");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($slidercm->Orden->errorMessage()) ?>");
		<?php if ($slidercm_add->Estado->Required) { ?>
			elm = this.getElements("x" + infix + "_Estado");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $slidercm->Estado->caption(), $slidercm->Estado->RequiredErrorMessage)) ?>");
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
fslidercmadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fslidercmadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Multi-Page
fslidercmadd.multiPage = new ew.MultiPage("fslidercmadd");

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $slidercm_add->showPageHeader(); ?>
<?php
$slidercm_add->showMessage();
?>
<form name="fslidercmadd" id="fslidercmadd" class="<?php echo $slidercm_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($slidercm_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $slidercm_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="slidercm">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$slidercm_add->IsModal ?>">
<?php if (!$slidercm_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($slidercm_add->MultiPages->Items[0]->Visible) { ?>
<?php if ($slidercm_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page0 -->
<?php } else { ?>
<table id="tbl_slidercmadd0" class="table table-striped table-sm ew-desktop-table"><!-- page0 table -->
<?php } ?>
<?php if ($slidercm->Estado->Visible) { // Estado ?>
<?php if ($slidercm_add->IsMobileOrModal) { ?>
	<div id="r_Estado" class="form-group row">
		<label id="elh_slidercm_Estado" for="x_Estado" class="<?php echo $slidercm_add->LeftColumnClass ?>"><?php echo $slidercm->Estado->caption() ?><?php echo ($slidercm->Estado->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $slidercm_add->RightColumnClass ?>"><div<?php echo $slidercm->Estado->cellAttributes() ?>>
<span id="el_slidercm_Estado">
<input type="text" data-table="slidercm" data-field="x_Estado" data-page="0" name="x_Estado" id="x_Estado" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($slidercm->Estado->getPlaceHolder()) ?>" value="<?php echo $slidercm->Estado->EditValue ?>"<?php echo $slidercm->Estado->editAttributes() ?>>
</span>
<?php echo $slidercm->Estado->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Estado">
		<td class="<?php echo $slidercm_add->TableLeftColumnClass ?>"><span id="elh_slidercm_Estado"><?php echo $slidercm->Estado->caption() ?><?php echo ($slidercm->Estado->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $slidercm->Estado->cellAttributes() ?>>
<span id="el_slidercm_Estado">
<input type="text" data-table="slidercm" data-field="x_Estado" data-page="0" name="x_Estado" id="x_Estado" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($slidercm->Estado->getPlaceHolder()) ?>" value="<?php echo $slidercm->Estado->EditValue ?>"<?php echo $slidercm->Estado->editAttributes() ?>>
</span>
<?php echo $slidercm->Estado->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($slidercm_add->IsMobileOrModal) { ?>
</div><!-- /page0 -->
<?php } else { ?>
</table><!-- /page0 table -->
<?php } ?>
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="slidercm_add"><!-- multi-page tabs -->
	<ul class="<?php echo $slidercm_add->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $slidercm_add->MultiPages->pageStyle("1") ?>" href="#tab_slidercm1" data-toggle="tab"><?php echo $slidercm->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $slidercm_add->MultiPages->pageStyle("2") ?>" href="#tab_slidercm2" data-toggle="tab"><?php echo $slidercm->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $slidercm_add->MultiPages->pageStyle("1") ?>" id="tab_slidercm1"><!-- multi-page .tab-pane -->
<?php if ($slidercm_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_slidercmadd1" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($slidercm->Titulo->Visible) { // Titulo ?>
<?php if ($slidercm_add->IsMobileOrModal) { ?>
	<div id="r_Titulo" class="form-group row">
		<label id="elh_slidercm_Titulo" for="x_Titulo" class="<?php echo $slidercm_add->LeftColumnClass ?>"><?php echo $slidercm->Titulo->caption() ?><?php echo ($slidercm->Titulo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $slidercm_add->RightColumnClass ?>"><div<?php echo $slidercm->Titulo->cellAttributes() ?>>
<span id="el_slidercm_Titulo">
<input type="text" data-table="slidercm" data-field="x_Titulo" data-page="1" name="x_Titulo" id="x_Titulo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($slidercm->Titulo->getPlaceHolder()) ?>" value="<?php echo $slidercm->Titulo->EditValue ?>"<?php echo $slidercm->Titulo->editAttributes() ?>>
</span>
<?php echo $slidercm->Titulo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Titulo">
		<td class="<?php echo $slidercm_add->TableLeftColumnClass ?>"><span id="elh_slidercm_Titulo"><?php echo $slidercm->Titulo->caption() ?><?php echo ($slidercm->Titulo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $slidercm->Titulo->cellAttributes() ?>>
<span id="el_slidercm_Titulo">
<input type="text" data-table="slidercm" data-field="x_Titulo" data-page="1" name="x_Titulo" id="x_Titulo" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($slidercm->Titulo->getPlaceHolder()) ?>" value="<?php echo $slidercm->Titulo->EditValue ?>"<?php echo $slidercm->Titulo->editAttributes() ?>>
</span>
<?php echo $slidercm->Titulo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($slidercm->Detalle->Visible) { // Detalle ?>
<?php if ($slidercm_add->IsMobileOrModal) { ?>
	<div id="r_Detalle" class="form-group row">
		<label id="elh_slidercm_Detalle" for="x_Detalle" class="<?php echo $slidercm_add->LeftColumnClass ?>"><?php echo $slidercm->Detalle->caption() ?><?php echo ($slidercm->Detalle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $slidercm_add->RightColumnClass ?>"><div<?php echo $slidercm->Detalle->cellAttributes() ?>>
<span id="el_slidercm_Detalle">
<input type="text" data-table="slidercm" data-field="x_Detalle" data-page="1" name="x_Detalle" id="x_Detalle" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($slidercm->Detalle->getPlaceHolder()) ?>" value="<?php echo $slidercm->Detalle->EditValue ?>"<?php echo $slidercm->Detalle->editAttributes() ?>>
</span>
<?php echo $slidercm->Detalle->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Detalle">
		<td class="<?php echo $slidercm_add->TableLeftColumnClass ?>"><span id="elh_slidercm_Detalle"><?php echo $slidercm->Detalle->caption() ?><?php echo ($slidercm->Detalle->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $slidercm->Detalle->cellAttributes() ?>>
<span id="el_slidercm_Detalle">
<input type="text" data-table="slidercm" data-field="x_Detalle" data-page="1" name="x_Detalle" id="x_Detalle" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($slidercm->Detalle->getPlaceHolder()) ?>" value="<?php echo $slidercm->Detalle->EditValue ?>"<?php echo $slidercm->Detalle->editAttributes() ?>>
</span>
<?php echo $slidercm->Detalle->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($slidercm->Orden->Visible) { // Orden ?>
<?php if ($slidercm_add->IsMobileOrModal) { ?>
	<div id="r_Orden" class="form-group row">
		<label id="elh_slidercm_Orden" for="x_Orden" class="<?php echo $slidercm_add->LeftColumnClass ?>"><?php echo $slidercm->Orden->caption() ?><?php echo ($slidercm->Orden->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $slidercm_add->RightColumnClass ?>"><div<?php echo $slidercm->Orden->cellAttributes() ?>>
<span id="el_slidercm_Orden">
<input type="text" data-table="slidercm" data-field="x_Orden" data-page="1" name="x_Orden" id="x_Orden" size="30" placeholder="<?php echo HtmlEncode($slidercm->Orden->getPlaceHolder()) ?>" value="<?php echo $slidercm->Orden->EditValue ?>"<?php echo $slidercm->Orden->editAttributes() ?>>
</span>
<?php echo $slidercm->Orden->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Orden">
		<td class="<?php echo $slidercm_add->TableLeftColumnClass ?>"><span id="elh_slidercm_Orden"><?php echo $slidercm->Orden->caption() ?><?php echo ($slidercm->Orden->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $slidercm->Orden->cellAttributes() ?>>
<span id="el_slidercm_Orden">
<input type="text" data-table="slidercm" data-field="x_Orden" data-page="1" name="x_Orden" id="x_Orden" size="30" placeholder="<?php echo HtmlEncode($slidercm->Orden->getPlaceHolder()) ?>" value="<?php echo $slidercm->Orden->EditValue ?>"<?php echo $slidercm->Orden->editAttributes() ?>>
</span>
<?php echo $slidercm->Orden->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($slidercm_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $slidercm_add->MultiPages->pageStyle("2") ?>" id="tab_slidercm2"><!-- multi-page .tab-pane -->
<?php if ($slidercm_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_slidercmadd2" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($slidercm->Url_image->Visible) { // Url_image ?>
<?php if ($slidercm_add->IsMobileOrModal) { ?>
	<div id="r_Url_image" class="form-group row">
		<label id="elh_slidercm_Url_image" class="<?php echo $slidercm_add->LeftColumnClass ?>"><?php echo $slidercm->Url_image->caption() ?><?php echo ($slidercm->Url_image->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $slidercm_add->RightColumnClass ?>"><div<?php echo $slidercm->Url_image->cellAttributes() ?>>
<span id="el_slidercm_Url_image">
<div id="fd_x_Url_image">
<span title="<?php echo $slidercm->Url_image->title() ? $slidercm->Url_image->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($slidercm->Url_image->ReadOnly || $slidercm->Url_image->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="slidercm" data-field="x_Url_image" data-page="2" name="x_Url_image" id="x_Url_image"<?php echo $slidercm->Url_image->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_Url_image" id= "fn_x_Url_image" value="<?php echo $slidercm->Url_image->Upload->FileName ?>">
<input type="hidden" name="fa_x_Url_image" id= "fa_x_Url_image" value="0">
<input type="hidden" name="fs_x_Url_image" id= "fs_x_Url_image" value="255">
<input type="hidden" name="fx_x_Url_image" id= "fx_x_Url_image" value="<?php echo $slidercm->Url_image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Url_image" id= "fm_x_Url_image" value="<?php echo $slidercm->Url_image->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Url_image" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $slidercm->Url_image->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Url_image">
		<td class="<?php echo $slidercm_add->TableLeftColumnClass ?>"><span id="elh_slidercm_Url_image"><?php echo $slidercm->Url_image->caption() ?><?php echo ($slidercm->Url_image->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $slidercm->Url_image->cellAttributes() ?>>
<span id="el_slidercm_Url_image">
<div id="fd_x_Url_image">
<span title="<?php echo $slidercm->Url_image->title() ? $slidercm->Url_image->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($slidercm->Url_image->ReadOnly || $slidercm->Url_image->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="slidercm" data-field="x_Url_image" data-page="2" name="x_Url_image" id="x_Url_image"<?php echo $slidercm->Url_image->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_Url_image" id= "fn_x_Url_image" value="<?php echo $slidercm->Url_image->Upload->FileName ?>">
<input type="hidden" name="fa_x_Url_image" id= "fa_x_Url_image" value="0">
<input type="hidden" name="fs_x_Url_image" id= "fs_x_Url_image" value="255">
<input type="hidden" name="fx_x_Url_image" id= "fx_x_Url_image" value="<?php echo $slidercm->Url_image->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Url_image" id= "fm_x_Url_image" value="<?php echo $slidercm->Url_image->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Url_image" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $slidercm->Url_image->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($slidercm_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
<?php if (!$slidercm_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $slidercm_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $slidercm_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$slidercm_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$slidercm_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$slidercm_add->terminate();
?>