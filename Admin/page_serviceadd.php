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
$page_service_add = new page_service_add();

// Run the page
$page_service_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$page_service_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fpage_serviceadd = currentForm = new ew.Form("fpage_serviceadd", "add");

// Validate form
fpage_serviceadd.validate = function() {
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
		<?php if ($page_service_add->Titulo->Required) { ?>
			elm = this.getElements("x" + infix + "_Titulo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $page_service->Titulo->caption(), $page_service->Titulo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($page_service_add->Descripcion->Required) { ?>
			elm = this.getElements("x" + infix + "_Descripcion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $page_service->Descripcion->caption(), $page_service->Descripcion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($page_service_add->Icono->Required) { ?>
			felm = this.getElements("x" + infix + "_Icono");
			elm = this.getElements("fn_x" + infix + "_Icono");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $page_service->Icono->caption(), $page_service->Icono->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($page_service_add->Imagen->Required) { ?>
			elm = this.getElements("x" + infix + "_Imagen");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $page_service->Imagen->caption(), $page_service->Imagen->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($page_service_add->Estado->Required) { ?>
			elm = this.getElements("x" + infix + "_Estado");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $page_service->Estado->caption(), $page_service->Estado->RequiredErrorMessage)) ?>");
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
fpage_serviceadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpage_serviceadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Multi-Page
fpage_serviceadd.multiPage = new ew.MultiPage("fpage_serviceadd");

// Dynamic selection lists
fpage_serviceadd.lists["x_Estado"] = <?php echo $page_service_add->Estado->Lookup->toClientList() ?>;
fpage_serviceadd.lists["x_Estado"].options = <?php echo JsonEncode($page_service_add->Estado->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $page_service_add->showPageHeader(); ?>
<?php
$page_service_add->showMessage();
?>
<form name="fpage_serviceadd" id="fpage_serviceadd" class="<?php echo $page_service_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($page_service_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $page_service_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="page_service">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$page_service_add->IsModal ?>">
<?php if (!$page_service_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($page_service_add->MultiPages->Items[0]->Visible) { ?>
<?php if ($page_service_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page0 -->
<?php } else { ?>
<table id="tbl_page_serviceadd0" class="table table-striped table-sm ew-desktop-table"><!-- page0 table -->
<?php } ?>
<?php if ($page_service->Estado->Visible) { // Estado ?>
<?php if ($page_service_add->IsMobileOrModal) { ?>
	<div id="r_Estado" class="form-group row">
		<label id="elh_page_service_Estado" for="x_Estado" class="<?php echo $page_service_add->LeftColumnClass ?>"><?php echo $page_service->Estado->caption() ?><?php echo ($page_service->Estado->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $page_service_add->RightColumnClass ?>"><div<?php echo $page_service->Estado->cellAttributes() ?>>
<span id="el_page_service_Estado">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="page_service" data-field="x_Estado" data-page="0" data-value-separator="<?php echo $page_service->Estado->displayValueSeparatorAttribute() ?>" id="x_Estado" name="x_Estado"<?php echo $page_service->Estado->editAttributes() ?>>
		<?php echo $page_service->Estado->selectOptionListHtml("x_Estado") ?>
	</select>
</div>
</span>
<?php echo $page_service->Estado->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Estado">
		<td class="<?php echo $page_service_add->TableLeftColumnClass ?>"><span id="elh_page_service_Estado"><?php echo $page_service->Estado->caption() ?><?php echo ($page_service->Estado->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $page_service->Estado->cellAttributes() ?>>
<span id="el_page_service_Estado">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="page_service" data-field="x_Estado" data-page="0" data-value-separator="<?php echo $page_service->Estado->displayValueSeparatorAttribute() ?>" id="x_Estado" name="x_Estado"<?php echo $page_service->Estado->editAttributes() ?>>
		<?php echo $page_service->Estado->selectOptionListHtml("x_Estado") ?>
	</select>
</div>
</span>
<?php echo $page_service->Estado->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($page_service_add->IsMobileOrModal) { ?>
</div><!-- /page0 -->
<?php } else { ?>
</table><!-- /page0 table -->
<?php } ?>
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="page_service_add"><!-- multi-page tabs -->
	<ul class="<?php echo $page_service_add->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $page_service_add->MultiPages->pageStyle("1") ?>" href="#tab_page_service1" data-toggle="tab"><?php echo $page_service->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $page_service_add->MultiPages->pageStyle("2") ?>" href="#tab_page_service2" data-toggle="tab"><?php echo $page_service->pageCaption(2) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $page_service_add->MultiPages->pageStyle("1") ?>" id="tab_page_service1"><!-- multi-page .tab-pane -->
<?php if ($page_service_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_page_serviceadd1" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($page_service->Titulo->Visible) { // Titulo ?>
<?php if ($page_service_add->IsMobileOrModal) { ?>
	<div id="r_Titulo" class="form-group row">
		<label id="elh_page_service_Titulo" for="x_Titulo" class="<?php echo $page_service_add->LeftColumnClass ?>"><?php echo $page_service->Titulo->caption() ?><?php echo ($page_service->Titulo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $page_service_add->RightColumnClass ?>"><div<?php echo $page_service->Titulo->cellAttributes() ?>>
<span id="el_page_service_Titulo">
<input type="text" data-table="page_service" data-field="x_Titulo" data-page="1" name="x_Titulo" id="x_Titulo" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($page_service->Titulo->getPlaceHolder()) ?>" value="<?php echo $page_service->Titulo->EditValue ?>"<?php echo $page_service->Titulo->editAttributes() ?>>
</span>
<?php echo $page_service->Titulo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Titulo">
		<td class="<?php echo $page_service_add->TableLeftColumnClass ?>"><span id="elh_page_service_Titulo"><?php echo $page_service->Titulo->caption() ?><?php echo ($page_service->Titulo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $page_service->Titulo->cellAttributes() ?>>
<span id="el_page_service_Titulo">
<input type="text" data-table="page_service" data-field="x_Titulo" data-page="1" name="x_Titulo" id="x_Titulo" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($page_service->Titulo->getPlaceHolder()) ?>" value="<?php echo $page_service->Titulo->EditValue ?>"<?php echo $page_service->Titulo->editAttributes() ?>>
</span>
<?php echo $page_service->Titulo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($page_service->Descripcion->Visible) { // Descripcion ?>
<?php if ($page_service_add->IsMobileOrModal) { ?>
	<div id="r_Descripcion" class="form-group row">
		<label id="elh_page_service_Descripcion" class="<?php echo $page_service_add->LeftColumnClass ?>"><?php echo $page_service->Descripcion->caption() ?><?php echo ($page_service->Descripcion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $page_service_add->RightColumnClass ?>"><div<?php echo $page_service->Descripcion->cellAttributes() ?>>
<span id="el_page_service_Descripcion">
<?php AppendClass($page_service->Descripcion->EditAttrs["class"], "editor"); ?>
<textarea data-table="page_service" data-field="x_Descripcion" data-page="1" name="x_Descripcion" id="x_Descripcion" cols="35" rows="4" placeholder="<?php echo HtmlEncode($page_service->Descripcion->getPlaceHolder()) ?>"<?php echo $page_service->Descripcion->editAttributes() ?>><?php echo $page_service->Descripcion->EditValue ?></textarea>
<script>
ew.createEditor("fpage_serviceadd", "x_Descripcion", 35, 4, <?php echo ($page_service->Descripcion->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $page_service->Descripcion->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Descripcion">
		<td class="<?php echo $page_service_add->TableLeftColumnClass ?>"><span id="elh_page_service_Descripcion"><?php echo $page_service->Descripcion->caption() ?><?php echo ($page_service->Descripcion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $page_service->Descripcion->cellAttributes() ?>>
<span id="el_page_service_Descripcion">
<?php AppendClass($page_service->Descripcion->EditAttrs["class"], "editor"); ?>
<textarea data-table="page_service" data-field="x_Descripcion" data-page="1" name="x_Descripcion" id="x_Descripcion" cols="35" rows="4" placeholder="<?php echo HtmlEncode($page_service->Descripcion->getPlaceHolder()) ?>"<?php echo $page_service->Descripcion->editAttributes() ?>><?php echo $page_service->Descripcion->EditValue ?></textarea>
<script>
ew.createEditor("fpage_serviceadd", "x_Descripcion", 35, 4, <?php echo ($page_service->Descripcion->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $page_service->Descripcion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($page_service->Icono->Visible) { // Icono ?>
<?php if ($page_service_add->IsMobileOrModal) { ?>
	<div id="r_Icono" class="form-group row">
		<label id="elh_page_service_Icono" class="<?php echo $page_service_add->LeftColumnClass ?>"><?php echo $page_service->Icono->caption() ?><?php echo ($page_service->Icono->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $page_service_add->RightColumnClass ?>"><div<?php echo $page_service->Icono->cellAttributes() ?>>
<span id="el_page_service_Icono">
<div id="fd_x_Icono">
<span title="<?php echo $page_service->Icono->title() ? $page_service->Icono->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($page_service->Icono->ReadOnly || $page_service->Icono->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="page_service" data-field="x_Icono" data-page="1" name="x_Icono" id="x_Icono"<?php echo $page_service->Icono->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_Icono" id= "fn_x_Icono" value="<?php echo $page_service->Icono->Upload->FileName ?>">
<input type="hidden" name="fa_x_Icono" id= "fa_x_Icono" value="0">
<input type="hidden" name="fs_x_Icono" id= "fs_x_Icono" value="100">
<input type="hidden" name="fx_x_Icono" id= "fx_x_Icono" value="<?php echo $page_service->Icono->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Icono" id= "fm_x_Icono" value="<?php echo $page_service->Icono->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Icono" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $page_service->Icono->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Icono">
		<td class="<?php echo $page_service_add->TableLeftColumnClass ?>"><span id="elh_page_service_Icono"><?php echo $page_service->Icono->caption() ?><?php echo ($page_service->Icono->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $page_service->Icono->cellAttributes() ?>>
<span id="el_page_service_Icono">
<div id="fd_x_Icono">
<span title="<?php echo $page_service->Icono->title() ? $page_service->Icono->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($page_service->Icono->ReadOnly || $page_service->Icono->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="page_service" data-field="x_Icono" data-page="1" name="x_Icono" id="x_Icono"<?php echo $page_service->Icono->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_Icono" id= "fn_x_Icono" value="<?php echo $page_service->Icono->Upload->FileName ?>">
<input type="hidden" name="fa_x_Icono" id= "fa_x_Icono" value="0">
<input type="hidden" name="fs_x_Icono" id= "fs_x_Icono" value="100">
<input type="hidden" name="fx_x_Icono" id= "fx_x_Icono" value="<?php echo $page_service->Icono->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Icono" id= "fm_x_Icono" value="<?php echo $page_service->Icono->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Icono" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $page_service->Icono->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($page_service_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $page_service_add->MultiPages->pageStyle("2") ?>" id="tab_page_service2"><!-- multi-page .tab-pane -->
<?php if ($page_service_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_page_serviceadd2" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($page_service->Imagen->Visible) { // Imagen ?>
<?php if ($page_service_add->IsMobileOrModal) { ?>
	<div id="r_Imagen" class="form-group row">
		<label id="elh_page_service_Imagen" for="x_Imagen" class="<?php echo $page_service_add->LeftColumnClass ?>"><?php echo $page_service->Imagen->caption() ?><?php echo ($page_service->Imagen->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $page_service_add->RightColumnClass ?>"><div<?php echo $page_service->Imagen->cellAttributes() ?>>
<span id="el_page_service_Imagen">
<input type="text" data-table="page_service" data-field="x_Imagen" data-page="2" name="x_Imagen" id="x_Imagen" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($page_service->Imagen->getPlaceHolder()) ?>" value="<?php echo $page_service->Imagen->EditValue ?>"<?php echo $page_service->Imagen->editAttributes() ?>>
</span>
<?php echo $page_service->Imagen->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Imagen">
		<td class="<?php echo $page_service_add->TableLeftColumnClass ?>"><span id="elh_page_service_Imagen"><?php echo $page_service->Imagen->caption() ?><?php echo ($page_service->Imagen->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $page_service->Imagen->cellAttributes() ?>>
<span id="el_page_service_Imagen">
<input type="text" data-table="page_service" data-field="x_Imagen" data-page="2" name="x_Imagen" id="x_Imagen" size="30" maxlength="250" placeholder="<?php echo HtmlEncode($page_service->Imagen->getPlaceHolder()) ?>" value="<?php echo $page_service->Imagen->EditValue ?>"<?php echo $page_service->Imagen->editAttributes() ?>>
</span>
<?php echo $page_service->Imagen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($page_service_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
<?php if (!$page_service_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $page_service_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $page_service_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$page_service_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$page_service_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$page_service_add->terminate();
?>