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
$paises_add = new paises_add();

// Run the page
$paises_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$paises_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fpaisesadd = currentForm = new ew.Form("fpaisesadd", "add");

// Validate form
fpaisesadd.validate = function() {
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
		<?php if ($paises_add->Codigo->Required) { ?>
			elm = this.getElements("x" + infix + "_Codigo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $paises->Codigo->caption(), $paises->Codigo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($paises_add->Pais->Required) { ?>
			elm = this.getElements("x" + infix + "_Pais");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $paises->Pais->caption(), $paises->Pais->RequiredErrorMessage)) ?>");
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
fpaisesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpaisesadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $paises_add->showPageHeader(); ?>
<?php
$paises_add->showMessage();
?>
<form name="fpaisesadd" id="fpaisesadd" class="<?php echo $paises_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($paises_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $paises_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="paises">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$paises_add->IsModal ?>">
<?php if (!$paises_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($paises_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_paisesadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($paises->Codigo->Visible) { // Codigo ?>
<?php if ($paises_add->IsMobileOrModal) { ?>
	<div id="r_Codigo" class="form-group row">
		<label id="elh_paises_Codigo" for="x_Codigo" class="<?php echo $paises_add->LeftColumnClass ?>"><?php echo $paises->Codigo->caption() ?><?php echo ($paises->Codigo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $paises_add->RightColumnClass ?>"><div<?php echo $paises->Codigo->cellAttributes() ?>>
<span id="el_paises_Codigo">
<input type="text" data-table="paises" data-field="x_Codigo" name="x_Codigo" id="x_Codigo" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($paises->Codigo->getPlaceHolder()) ?>" value="<?php echo $paises->Codigo->EditValue ?>"<?php echo $paises->Codigo->editAttributes() ?>>
</span>
<?php echo $paises->Codigo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Codigo">
		<td class="<?php echo $paises_add->TableLeftColumnClass ?>"><span id="elh_paises_Codigo"><?php echo $paises->Codigo->caption() ?><?php echo ($paises->Codigo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $paises->Codigo->cellAttributes() ?>>
<span id="el_paises_Codigo">
<input type="text" data-table="paises" data-field="x_Codigo" name="x_Codigo" id="x_Codigo" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($paises->Codigo->getPlaceHolder()) ?>" value="<?php echo $paises->Codigo->EditValue ?>"<?php echo $paises->Codigo->editAttributes() ?>>
</span>
<?php echo $paises->Codigo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($paises->Pais->Visible) { // Pais ?>
<?php if ($paises_add->IsMobileOrModal) { ?>
	<div id="r_Pais" class="form-group row">
		<label id="elh_paises_Pais" for="x_Pais" class="<?php echo $paises_add->LeftColumnClass ?>"><?php echo $paises->Pais->caption() ?><?php echo ($paises->Pais->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $paises_add->RightColumnClass ?>"><div<?php echo $paises->Pais->cellAttributes() ?>>
<span id="el_paises_Pais">
<input type="text" data-table="paises" data-field="x_Pais" name="x_Pais" id="x_Pais" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($paises->Pais->getPlaceHolder()) ?>" value="<?php echo $paises->Pais->EditValue ?>"<?php echo $paises->Pais->editAttributes() ?>>
</span>
<?php echo $paises->Pais->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Pais">
		<td class="<?php echo $paises_add->TableLeftColumnClass ?>"><span id="elh_paises_Pais"><?php echo $paises->Pais->caption() ?><?php echo ($paises->Pais->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $paises->Pais->cellAttributes() ?>>
<span id="el_paises_Pais">
<input type="text" data-table="paises" data-field="x_Pais" name="x_Pais" id="x_Pais" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($paises->Pais->getPlaceHolder()) ?>" value="<?php echo $paises->Pais->EditValue ?>"<?php echo $paises->Pais->editAttributes() ?>>
</span>
<?php echo $paises->Pais->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($paises_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$paises_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $paises_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $paises_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$paises_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$paises_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$paises_add->terminate();
?>