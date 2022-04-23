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
$ciudades_add = new ciudades_add();

// Run the page
$ciudades_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ciudades_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fciudadesadd = currentForm = new ew.Form("fciudadesadd", "add");

// Validate form
fciudadesadd.validate = function() {
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
		<?php if ($ciudades_add->Paises_Codigo->Required) { ?>
			elm = this.getElements("x" + infix + "_Paises_Codigo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ciudades->Paises_Codigo->caption(), $ciudades->Paises_Codigo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($ciudades_add->Ciudad->Required) { ?>
			elm = this.getElements("x" + infix + "_Ciudad");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ciudades->Ciudad->caption(), $ciudades->Ciudad->RequiredErrorMessage)) ?>");
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
fciudadesadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fciudadesadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $ciudades_add->showPageHeader(); ?>
<?php
$ciudades_add->showMessage();
?>
<form name="fciudadesadd" id="fciudadesadd" class="<?php echo $ciudades_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($ciudades_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $ciudades_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ciudades">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ciudades_add->IsModal ?>">
<?php if (!$ciudades_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($ciudades_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_ciudadesadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($ciudades->Paises_Codigo->Visible) { // Paises_Codigo ?>
<?php if ($ciudades_add->IsMobileOrModal) { ?>
	<div id="r_Paises_Codigo" class="form-group row">
		<label id="elh_ciudades_Paises_Codigo" for="x_Paises_Codigo" class="<?php echo $ciudades_add->LeftColumnClass ?>"><?php echo $ciudades->Paises_Codigo->caption() ?><?php echo ($ciudades->Paises_Codigo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ciudades_add->RightColumnClass ?>"><div<?php echo $ciudades->Paises_Codigo->cellAttributes() ?>>
<span id="el_ciudades_Paises_Codigo">
<input type="text" data-table="ciudades" data-field="x_Paises_Codigo" name="x_Paises_Codigo" id="x_Paises_Codigo" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($ciudades->Paises_Codigo->getPlaceHolder()) ?>" value="<?php echo $ciudades->Paises_Codigo->EditValue ?>"<?php echo $ciudades->Paises_Codigo->editAttributes() ?>>
</span>
<?php echo $ciudades->Paises_Codigo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Paises_Codigo">
		<td class="<?php echo $ciudades_add->TableLeftColumnClass ?>"><span id="elh_ciudades_Paises_Codigo"><?php echo $ciudades->Paises_Codigo->caption() ?><?php echo ($ciudades->Paises_Codigo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $ciudades->Paises_Codigo->cellAttributes() ?>>
<span id="el_ciudades_Paises_Codigo">
<input type="text" data-table="ciudades" data-field="x_Paises_Codigo" name="x_Paises_Codigo" id="x_Paises_Codigo" size="30" maxlength="2" placeholder="<?php echo HtmlEncode($ciudades->Paises_Codigo->getPlaceHolder()) ?>" value="<?php echo $ciudades->Paises_Codigo->EditValue ?>"<?php echo $ciudades->Paises_Codigo->editAttributes() ?>>
</span>
<?php echo $ciudades->Paises_Codigo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($ciudades->Ciudad->Visible) { // Ciudad ?>
<?php if ($ciudades_add->IsMobileOrModal) { ?>
	<div id="r_Ciudad" class="form-group row">
		<label id="elh_ciudades_Ciudad" for="x_Ciudad" class="<?php echo $ciudades_add->LeftColumnClass ?>"><?php echo $ciudades->Ciudad->caption() ?><?php echo ($ciudades->Ciudad->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ciudades_add->RightColumnClass ?>"><div<?php echo $ciudades->Ciudad->cellAttributes() ?>>
<span id="el_ciudades_Ciudad">
<input type="text" data-table="ciudades" data-field="x_Ciudad" name="x_Ciudad" id="x_Ciudad" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ciudades->Ciudad->getPlaceHolder()) ?>" value="<?php echo $ciudades->Ciudad->EditValue ?>"<?php echo $ciudades->Ciudad->editAttributes() ?>>
</span>
<?php echo $ciudades->Ciudad->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Ciudad">
		<td class="<?php echo $ciudades_add->TableLeftColumnClass ?>"><span id="elh_ciudades_Ciudad"><?php echo $ciudades->Ciudad->caption() ?><?php echo ($ciudades->Ciudad->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $ciudades->Ciudad->cellAttributes() ?>>
<span id="el_ciudades_Ciudad">
<input type="text" data-table="ciudades" data-field="x_Ciudad" name="x_Ciudad" id="x_Ciudad" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ciudades->Ciudad->getPlaceHolder()) ?>" value="<?php echo $ciudades->Ciudad->EditValue ?>"<?php echo $ciudades->Ciudad->editAttributes() ?>>
</span>
<?php echo $ciudades->Ciudad->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($ciudades_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$ciudades_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ciudades_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ciudades_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$ciudades_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$ciudades_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$ciudades_add->terminate();
?>