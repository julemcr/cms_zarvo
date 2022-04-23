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
$sexo_edit = new sexo_edit();

// Run the page
$sexo_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sexo_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fsexoedit = currentForm = new ew.Form("fsexoedit", "edit");

// Validate form
fsexoedit.validate = function() {
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
		<?php if ($sexo_edit->SexoID->Required) { ?>
			elm = this.getElements("x" + infix + "_SexoID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sexo->SexoID->caption(), $sexo->SexoID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($sexo_edit->Sexo->Required) { ?>
			elm = this.getElements("x" + infix + "_Sexo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sexo->Sexo->caption(), $sexo->Sexo->RequiredErrorMessage)) ?>");
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
fsexoedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fsexoedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $sexo_edit->showPageHeader(); ?>
<?php
$sexo_edit->showMessage();
?>
<form name="fsexoedit" id="fsexoedit" class="<?php echo $sexo_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($sexo_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $sexo_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sexo">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$sexo_edit->IsModal ?>">
<?php if (!$sexo_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($sexo_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_sexoedit" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($sexo->SexoID->Visible) { // SexoID ?>
<?php if ($sexo_edit->IsMobileOrModal) { ?>
	<div id="r_SexoID" class="form-group row">
		<label id="elh_sexo_SexoID" class="<?php echo $sexo_edit->LeftColumnClass ?>"><?php echo $sexo->SexoID->caption() ?><?php echo ($sexo->SexoID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sexo_edit->RightColumnClass ?>"><div<?php echo $sexo->SexoID->cellAttributes() ?>>
<span id="el_sexo_SexoID">
<span<?php echo $sexo->SexoID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($sexo->SexoID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="sexo" data-field="x_SexoID" name="x_SexoID" id="x_SexoID" value="<?php echo HtmlEncode($sexo->SexoID->CurrentValue) ?>">
<?php echo $sexo->SexoID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_SexoID">
		<td class="<?php echo $sexo_edit->TableLeftColumnClass ?>"><span id="elh_sexo_SexoID"><?php echo $sexo->SexoID->caption() ?><?php echo ($sexo->SexoID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $sexo->SexoID->cellAttributes() ?>>
<span id="el_sexo_SexoID">
<span<?php echo $sexo->SexoID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($sexo->SexoID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="sexo" data-field="x_SexoID" name="x_SexoID" id="x_SexoID" value="<?php echo HtmlEncode($sexo->SexoID->CurrentValue) ?>">
<?php echo $sexo->SexoID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($sexo->Sexo->Visible) { // Sexo ?>
<?php if ($sexo_edit->IsMobileOrModal) { ?>
	<div id="r_Sexo" class="form-group row">
		<label id="elh_sexo_Sexo" for="x_Sexo" class="<?php echo $sexo_edit->LeftColumnClass ?>"><?php echo $sexo->Sexo->caption() ?><?php echo ($sexo->Sexo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $sexo_edit->RightColumnClass ?>"><div<?php echo $sexo->Sexo->cellAttributes() ?>>
<span id="el_sexo_Sexo">
<input type="text" data-table="sexo" data-field="x_Sexo" name="x_Sexo" id="x_Sexo" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($sexo->Sexo->getPlaceHolder()) ?>" value="<?php echo $sexo->Sexo->EditValue ?>"<?php echo $sexo->Sexo->editAttributes() ?>>
</span>
<?php echo $sexo->Sexo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Sexo">
		<td class="<?php echo $sexo_edit->TableLeftColumnClass ?>"><span id="elh_sexo_Sexo"><?php echo $sexo->Sexo->caption() ?><?php echo ($sexo->Sexo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $sexo->Sexo->cellAttributes() ?>>
<span id="el_sexo_Sexo">
<input type="text" data-table="sexo" data-field="x_Sexo" name="x_Sexo" id="x_Sexo" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($sexo->Sexo->getPlaceHolder()) ?>" value="<?php echo $sexo->Sexo->EditValue ?>"<?php echo $sexo->Sexo->editAttributes() ?>>
</span>
<?php echo $sexo->Sexo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($sexo_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$sexo_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $sexo_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sexo_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$sexo_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$sexo_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$sexo_edit->terminate();
?>