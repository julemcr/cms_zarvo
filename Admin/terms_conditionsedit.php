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
$terms_conditions_edit = new terms_conditions_edit();

// Run the page
$terms_conditions_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terms_conditions_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fterms_conditionsedit = currentForm = new ew.Form("fterms_conditionsedit", "edit");

// Validate form
fterms_conditionsedit.validate = function() {
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
		<?php if ($terms_conditions_edit->TermsConditionsID->Required) { ?>
			elm = this.getElements("x" + infix + "_TermsConditionsID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terms_conditions->TermsConditionsID->caption(), $terms_conditions->TermsConditionsID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($terms_conditions_edit->name->Required) { ?>
			elm = this.getElements("x" + infix + "_name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terms_conditions->name->caption(), $terms_conditions->name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($terms_conditions_edit->description->Required) { ?>
			elm = this.getElements("x" + infix + "_description");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terms_conditions->description->caption(), $terms_conditions->description->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($terms_conditions_edit->dateupdate->Required) { ?>
			elm = this.getElements("x" + infix + "_dateupdate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terms_conditions->dateupdate->caption(), $terms_conditions->dateupdate->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($terms_conditions_edit->_userid->Required) { ?>
			elm = this.getElements("x" + infix + "__userid");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terms_conditions->_userid->caption(), $terms_conditions->_userid->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($terms_conditions_edit->status->Required) { ?>
			elm = this.getElements("x" + infix + "_status[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terms_conditions->status->caption(), $terms_conditions->status->RequiredErrorMessage)) ?>");
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
fterms_conditionsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fterms_conditionsedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Multi-Page
fterms_conditionsedit.multiPage = new ew.MultiPage("fterms_conditionsedit");

// Dynamic selection lists
fterms_conditionsedit.lists["x_status[]"] = <?php echo $terms_conditions_edit->status->Lookup->toClientList() ?>;
fterms_conditionsedit.lists["x_status[]"].options = <?php echo JsonEncode($terms_conditions_edit->status->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $terms_conditions_edit->showPageHeader(); ?>
<?php
$terms_conditions_edit->showMessage();
?>
<form name="fterms_conditionsedit" id="fterms_conditionsedit" class="<?php echo $terms_conditions_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($terms_conditions_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $terms_conditions_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terms_conditions">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$terms_conditions_edit->IsModal ?>">
<?php if (!$terms_conditions_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($terms_conditions_edit->MultiPages->Items[0]->Visible) { ?>
<?php if ($terms_conditions_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page0 -->
<?php } else { ?>
<table id="tbl_terms_conditionsedit0" class="table table-striped table-sm ew-desktop-table"><!-- page0 table -->
<?php } ?>
<?php if ($terms_conditions->TermsConditionsID->Visible) { // TermsConditionsID ?>
<?php if ($terms_conditions_edit->IsMobileOrModal) { ?>
	<div id="r_TermsConditionsID" class="form-group row">
		<label id="elh_terms_conditions_TermsConditionsID" class="<?php echo $terms_conditions_edit->LeftColumnClass ?>"><?php echo $terms_conditions->TermsConditionsID->caption() ?><?php echo ($terms_conditions->TermsConditionsID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terms_conditions_edit->RightColumnClass ?>"><div<?php echo $terms_conditions->TermsConditionsID->cellAttributes() ?>>
<span id="el_terms_conditions_TermsConditionsID">
<span<?php echo $terms_conditions->TermsConditionsID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($terms_conditions->TermsConditionsID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="terms_conditions" data-field="x_TermsConditionsID" data-page="0" name="x_TermsConditionsID" id="x_TermsConditionsID" value="<?php echo HtmlEncode($terms_conditions->TermsConditionsID->CurrentValue) ?>">
<?php echo $terms_conditions->TermsConditionsID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_TermsConditionsID">
		<td class="<?php echo $terms_conditions_edit->TableLeftColumnClass ?>"><span id="elh_terms_conditions_TermsConditionsID"><?php echo $terms_conditions->TermsConditionsID->caption() ?><?php echo ($terms_conditions->TermsConditionsID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $terms_conditions->TermsConditionsID->cellAttributes() ?>>
<span id="el_terms_conditions_TermsConditionsID">
<span<?php echo $terms_conditions->TermsConditionsID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($terms_conditions->TermsConditionsID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="terms_conditions" data-field="x_TermsConditionsID" data-page="0" name="x_TermsConditionsID" id="x_TermsConditionsID" value="<?php echo HtmlEncode($terms_conditions->TermsConditionsID->CurrentValue) ?>">
<?php echo $terms_conditions->TermsConditionsID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($terms_conditions->status->Visible) { // status ?>
<?php if ($terms_conditions_edit->IsMobileOrModal) { ?>
	<div id="r_status" class="form-group row">
		<label id="elh_terms_conditions_status" class="<?php echo $terms_conditions_edit->LeftColumnClass ?>"><?php echo $terms_conditions->status->caption() ?><?php echo ($terms_conditions->status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terms_conditions_edit->RightColumnClass ?>"><div<?php echo $terms_conditions->status->cellAttributes() ?>>
<span id="el_terms_conditions_status">
<?php
$selwrk = (ConvertToBool($terms_conditions->status->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="terms_conditions" data-field="x_status" data-page="0" name="x_status[]" id="x_status[]" value="1"<?php echo $selwrk ?><?php echo $terms_conditions->status->editAttributes() ?>>
</span>
<?php echo $terms_conditions->status->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_status">
		<td class="<?php echo $terms_conditions_edit->TableLeftColumnClass ?>"><span id="elh_terms_conditions_status"><?php echo $terms_conditions->status->caption() ?><?php echo ($terms_conditions->status->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $terms_conditions->status->cellAttributes() ?>>
<span id="el_terms_conditions_status">
<?php
$selwrk = (ConvertToBool($terms_conditions->status->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="terms_conditions" data-field="x_status" data-page="0" name="x_status[]" id="x_status[]" value="1"<?php echo $selwrk ?><?php echo $terms_conditions->status->editAttributes() ?>>
</span>
<?php echo $terms_conditions->status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($terms_conditions_edit->IsMobileOrModal) { ?>
</div><!-- /page0 -->
<?php } else { ?>
</table><!-- /page0 table -->
<?php } ?>
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="terms_conditions_edit"><!-- multi-page tabs -->
	<ul class="<?php echo $terms_conditions_edit->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $terms_conditions_edit->MultiPages->pageStyle("1") ?>" href="#tab_terms_conditions1" data-toggle="tab"><?php echo $terms_conditions->pageCaption(1) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $terms_conditions_edit->MultiPages->pageStyle("1") ?>" id="tab_terms_conditions1"><!-- multi-page .tab-pane -->
<?php if ($terms_conditions_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_terms_conditionsedit1" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($terms_conditions->name->Visible) { // name ?>
<?php if ($terms_conditions_edit->IsMobileOrModal) { ?>
	<div id="r_name" class="form-group row">
		<label id="elh_terms_conditions_name" for="x_name" class="<?php echo $terms_conditions_edit->LeftColumnClass ?>"><?php echo $terms_conditions->name->caption() ?><?php echo ($terms_conditions->name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terms_conditions_edit->RightColumnClass ?>"><div<?php echo $terms_conditions->name->cellAttributes() ?>>
<span id="el_terms_conditions_name">
<input type="text" data-table="terms_conditions" data-field="x_name" data-page="1" name="x_name" id="x_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($terms_conditions->name->getPlaceHolder()) ?>" value="<?php echo $terms_conditions->name->EditValue ?>"<?php echo $terms_conditions->name->editAttributes() ?>>
</span>
<?php echo $terms_conditions->name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_name">
		<td class="<?php echo $terms_conditions_edit->TableLeftColumnClass ?>"><span id="elh_terms_conditions_name"><?php echo $terms_conditions->name->caption() ?><?php echo ($terms_conditions->name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $terms_conditions->name->cellAttributes() ?>>
<span id="el_terms_conditions_name">
<input type="text" data-table="terms_conditions" data-field="x_name" data-page="1" name="x_name" id="x_name" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($terms_conditions->name->getPlaceHolder()) ?>" value="<?php echo $terms_conditions->name->EditValue ?>"<?php echo $terms_conditions->name->editAttributes() ?>>
</span>
<?php echo $terms_conditions->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($terms_conditions->description->Visible) { // description ?>
<?php if ($terms_conditions_edit->IsMobileOrModal) { ?>
	<div id="r_description" class="form-group row">
		<label id="elh_terms_conditions_description" class="<?php echo $terms_conditions_edit->LeftColumnClass ?>"><?php echo $terms_conditions->description->caption() ?><?php echo ($terms_conditions->description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terms_conditions_edit->RightColumnClass ?>"><div<?php echo $terms_conditions->description->cellAttributes() ?>>
<span id="el_terms_conditions_description">
<?php AppendClass($terms_conditions->description->EditAttrs["class"], "editor"); ?>
<textarea data-table="terms_conditions" data-field="x_description" data-page="1" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($terms_conditions->description->getPlaceHolder()) ?>"<?php echo $terms_conditions->description->editAttributes() ?>><?php echo $terms_conditions->description->EditValue ?></textarea>
<script>
ew.createEditor("fterms_conditionsedit", "x_description", 35, 4, <?php echo ($terms_conditions->description->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $terms_conditions->description->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_description">
		<td class="<?php echo $terms_conditions_edit->TableLeftColumnClass ?>"><span id="elh_terms_conditions_description"><?php echo $terms_conditions->description->caption() ?><?php echo ($terms_conditions->description->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $terms_conditions->description->cellAttributes() ?>>
<span id="el_terms_conditions_description">
<?php AppendClass($terms_conditions->description->EditAttrs["class"], "editor"); ?>
<textarea data-table="terms_conditions" data-field="x_description" data-page="1" name="x_description" id="x_description" cols="35" rows="4" placeholder="<?php echo HtmlEncode($terms_conditions->description->getPlaceHolder()) ?>"<?php echo $terms_conditions->description->editAttributes() ?>><?php echo $terms_conditions->description->EditValue ?></textarea>
<script>
ew.createEditor("fterms_conditionsedit", "x_description", 35, 4, <?php echo ($terms_conditions->description->ReadOnly || FALSE) ? "true" : "false" ?>);
</script>
</span>
<?php echo $terms_conditions->description->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($terms_conditions_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
<span id="el_terms_conditions_dateupdate">
<input type="hidden" data-table="terms_conditions" data-field="x_dateupdate" data-page="0" name="x_dateupdate" id="x_dateupdate" value="<?php echo HtmlEncode($terms_conditions->dateupdate->CurrentValue) ?>">
</span>
<span id="el_terms_conditions__userid">
<input type="hidden" data-table="terms_conditions" data-field="x__userid" data-page="0" name="x__userid" id="x__userid" value="<?php echo HtmlEncode($terms_conditions->_userid->CurrentValue) ?>">
</span>
<?php if (!$terms_conditions_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $terms_conditions_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $terms_conditions_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$terms_conditions_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$terms_conditions_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$terms_conditions_edit->terminate();
?>