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
$portafolio_categoria_edit = new portafolio_categoria_edit();

// Run the page
$portafolio_categoria_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$portafolio_categoria_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fportafolio_categoriaedit = currentForm = new ew.Form("fportafolio_categoriaedit", "edit");

// Validate form
fportafolio_categoriaedit.validate = function() {
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
		<?php if ($portafolio_categoria_edit->PortafolioCategoriaID->Required) { ?>
			elm = this.getElements("x" + infix + "_PortafolioCategoriaID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $portafolio_categoria->PortafolioCategoriaID->caption(), $portafolio_categoria->PortafolioCategoriaID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($portafolio_categoria_edit->Categoria->Required) { ?>
			elm = this.getElements("x" + infix + "_Categoria");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $portafolio_categoria->Categoria->caption(), $portafolio_categoria->Categoria->RequiredErrorMessage)) ?>");
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
fportafolio_categoriaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fportafolio_categoriaedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $portafolio_categoria_edit->showPageHeader(); ?>
<?php
$portafolio_categoria_edit->showMessage();
?>
<form name="fportafolio_categoriaedit" id="fportafolio_categoriaedit" class="<?php echo $portafolio_categoria_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($portafolio_categoria_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $portafolio_categoria_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="portafolio_categoria">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$portafolio_categoria_edit->IsModal ?>">
<?php if (!$portafolio_categoria_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($portafolio_categoria_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_portafolio_categoriaedit" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($portafolio_categoria->PortafolioCategoriaID->Visible) { // PortafolioCategoriaID ?>
<?php if ($portafolio_categoria_edit->IsMobileOrModal) { ?>
	<div id="r_PortafolioCategoriaID" class="form-group row">
		<label id="elh_portafolio_categoria_PortafolioCategoriaID" class="<?php echo $portafolio_categoria_edit->LeftColumnClass ?>"><?php echo $portafolio_categoria->PortafolioCategoriaID->caption() ?><?php echo ($portafolio_categoria->PortafolioCategoriaID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $portafolio_categoria_edit->RightColumnClass ?>"><div<?php echo $portafolio_categoria->PortafolioCategoriaID->cellAttributes() ?>>
<span id="el_portafolio_categoria_PortafolioCategoriaID">
<span<?php echo $portafolio_categoria->PortafolioCategoriaID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($portafolio_categoria->PortafolioCategoriaID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="portafolio_categoria" data-field="x_PortafolioCategoriaID" name="x_PortafolioCategoriaID" id="x_PortafolioCategoriaID" value="<?php echo HtmlEncode($portafolio_categoria->PortafolioCategoriaID->CurrentValue) ?>">
<?php echo $portafolio_categoria->PortafolioCategoriaID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_PortafolioCategoriaID">
		<td class="<?php echo $portafolio_categoria_edit->TableLeftColumnClass ?>"><span id="elh_portafolio_categoria_PortafolioCategoriaID"><?php echo $portafolio_categoria->PortafolioCategoriaID->caption() ?><?php echo ($portafolio_categoria->PortafolioCategoriaID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $portafolio_categoria->PortafolioCategoriaID->cellAttributes() ?>>
<span id="el_portafolio_categoria_PortafolioCategoriaID">
<span<?php echo $portafolio_categoria->PortafolioCategoriaID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($portafolio_categoria->PortafolioCategoriaID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="portafolio_categoria" data-field="x_PortafolioCategoriaID" name="x_PortafolioCategoriaID" id="x_PortafolioCategoriaID" value="<?php echo HtmlEncode($portafolio_categoria->PortafolioCategoriaID->CurrentValue) ?>">
<?php echo $portafolio_categoria->PortafolioCategoriaID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($portafolio_categoria->Categoria->Visible) { // Categoria ?>
<?php if ($portafolio_categoria_edit->IsMobileOrModal) { ?>
	<div id="r_Categoria" class="form-group row">
		<label id="elh_portafolio_categoria_Categoria" for="x_Categoria" class="<?php echo $portafolio_categoria_edit->LeftColumnClass ?>"><?php echo $portafolio_categoria->Categoria->caption() ?><?php echo ($portafolio_categoria->Categoria->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $portafolio_categoria_edit->RightColumnClass ?>"><div<?php echo $portafolio_categoria->Categoria->cellAttributes() ?>>
<span id="el_portafolio_categoria_Categoria">
<input type="text" data-table="portafolio_categoria" data-field="x_Categoria" name="x_Categoria" id="x_Categoria" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($portafolio_categoria->Categoria->getPlaceHolder()) ?>" value="<?php echo $portafolio_categoria->Categoria->EditValue ?>"<?php echo $portafolio_categoria->Categoria->editAttributes() ?>>
</span>
<?php echo $portafolio_categoria->Categoria->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Categoria">
		<td class="<?php echo $portafolio_categoria_edit->TableLeftColumnClass ?>"><span id="elh_portafolio_categoria_Categoria"><?php echo $portafolio_categoria->Categoria->caption() ?><?php echo ($portafolio_categoria->Categoria->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $portafolio_categoria->Categoria->cellAttributes() ?>>
<span id="el_portafolio_categoria_Categoria">
<input type="text" data-table="portafolio_categoria" data-field="x_Categoria" name="x_Categoria" id="x_Categoria" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($portafolio_categoria->Categoria->getPlaceHolder()) ?>" value="<?php echo $portafolio_categoria->Categoria->EditValue ?>"<?php echo $portafolio_categoria->Categoria->editAttributes() ?>>
</span>
<?php echo $portafolio_categoria->Categoria->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($portafolio_categoria_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$portafolio_categoria_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $portafolio_categoria_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $portafolio_categoria_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$portafolio_categoria_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$portafolio_categoria_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$portafolio_categoria_edit->terminate();
?>