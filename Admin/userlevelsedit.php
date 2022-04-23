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
$userlevels_edit = new userlevels_edit();

// Run the page
$userlevels_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$userlevels_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fuserlevelsedit = currentForm = new ew.Form("fuserlevelsedit", "edit");

// Validate form
fuserlevelsedit.validate = function() {
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
		<?php if ($userlevels_edit->userlevelid->Required) { ?>
			elm = this.getElements("x" + infix + "_userlevelid");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $userlevels->userlevelid->caption(), $userlevels->userlevelid->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_userlevelid");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($userlevels->userlevelid->errorMessage()) ?>");
		<?php if ($userlevels_edit->userlevelname->Required) { ?>
			elm = this.getElements("x" + infix + "_userlevelname");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $userlevels->userlevelname->caption(), $userlevels->userlevelname->RequiredErrorMessage)) ?>");
		<?php } ?>
			var elId = fobj.elements["x" + infix + "_userlevelid"];
			var elName = fobj.elements["x" + infix + "_userlevelname"];
			if (elId && elName) {
				elId.value = $.trim(elId.value);
				elName.value = $.trim(elName.value);
				if (elId && !ew.checkInteger(elId.value))
					return this.onError(elId, ew.language.phrase("UserLevelIDInteger"));
				var level = parseInt(elId.value, 10);
				if (level == 0 && !ew.sameText(elName.value, "Default")) {
					return this.onError(elName, ew.language.phrase("UserLevelDefaultName"));
				} else if (level == -1 && !ew.sameText(elName.value, "Administrator")) {
					return this.onError(elName, ew.language.phrase("UserLevelAdministratorName"));
				} else if (level == -2 && !ew.sameText(elName.value, "Anonymous")) {
					return this.onError(elName, ew.language.phrase("UserLevelAnonymousName"));
				} else if (level < -2) {
					return this.onError(elId, ew.language.phrase("UserLevelIDIncorrect"));
				} else if (level > 0 && ["anonymous", "administrator", "default"].includes(elName.value.toLowerCase())) {
					return this.onError(elName, ew.language.phrase("UserLevelNameIncorrect"));
				}
			}

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
fuserlevelsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserlevelsedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fuserlevelsedit.lists["x_userlevelname"] = <?php echo $userlevels_edit->userlevelname->Lookup->toClientList() ?>;
fuserlevelsedit.lists["x_userlevelname"].options = <?php echo JsonEncode($userlevels_edit->userlevelname->lookupOptions()) ?>;
fuserlevelsedit.autoSuggests["x_userlevelname"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $userlevels_edit->showPageHeader(); ?>
<?php
$userlevels_edit->showMessage();
?>
<form name="fuserlevelsedit" id="fuserlevelsedit" class="<?php echo $userlevels_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($userlevels_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $userlevels_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="userlevels">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$userlevels_edit->IsModal ?>">
<?php if (!$userlevels_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($userlevels_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_userlevelsedit" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($userlevels->userlevelid->Visible) { // userlevelid ?>
<?php if ($userlevels_edit->IsMobileOrModal) { ?>
	<div id="r_userlevelid" class="form-group row">
		<label id="elh_userlevels_userlevelid" for="x_userlevelid" class="<?php echo $userlevels_edit->LeftColumnClass ?>"><?php echo $userlevels->userlevelid->caption() ?><?php echo ($userlevels->userlevelid->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $userlevels_edit->RightColumnClass ?>"><div<?php echo $userlevels->userlevelid->cellAttributes() ?>>
<span id="el_userlevels_userlevelid">
<span<?php echo $userlevels->userlevelid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($userlevels->userlevelid->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="userlevels" data-field="x_userlevelid" name="x_userlevelid" id="x_userlevelid" value="<?php echo HtmlEncode($userlevels->userlevelid->CurrentValue) ?>">
<?php echo $userlevels->userlevelid->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_userlevelid">
		<td class="<?php echo $userlevels_edit->TableLeftColumnClass ?>"><span id="elh_userlevels_userlevelid"><?php echo $userlevels->userlevelid->caption() ?><?php echo ($userlevels->userlevelid->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $userlevels->userlevelid->cellAttributes() ?>>
<span id="el_userlevels_userlevelid">
<span<?php echo $userlevels->userlevelid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($userlevels->userlevelid->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="userlevels" data-field="x_userlevelid" name="x_userlevelid" id="x_userlevelid" value="<?php echo HtmlEncode($userlevels->userlevelid->CurrentValue) ?>">
<?php echo $userlevels->userlevelid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($userlevels->userlevelname->Visible) { // userlevelname ?>
<?php if ($userlevels_edit->IsMobileOrModal) { ?>
	<div id="r_userlevelname" class="form-group row">
		<label id="elh_userlevels_userlevelname" class="<?php echo $userlevels_edit->LeftColumnClass ?>"><?php echo $userlevels->userlevelname->caption() ?><?php echo ($userlevels->userlevelname->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $userlevels_edit->RightColumnClass ?>"><div<?php echo $userlevels->userlevelname->cellAttributes() ?>>
<span id="el_userlevels_userlevelname">
<?php
$wrkonchange = "" . trim(@$userlevels->userlevelname->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$userlevels->userlevelname->EditAttrs["onchange"] = "";
?>
<span id="as_x_userlevelname" class="text-nowrap" style="z-index: 8980">
	<input type="text" class="form-control" name="sv_x_userlevelname" id="sv_x_userlevelname" value="<?php echo RemoveHtml($userlevels->userlevelname->EditValue) ?>" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($userlevels->userlevelname->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($userlevels->userlevelname->getPlaceHolder()) ?>"<?php echo $userlevels->userlevelname->editAttributes() ?>>
</span>
<input type="hidden" data-table="userlevels" data-field="x_userlevelname" data-value-separator="<?php echo $userlevels->userlevelname->displayValueSeparatorAttribute() ?>" name="x_userlevelname" id="x_userlevelname" value="<?php echo HtmlEncode($userlevels->userlevelname->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fuserlevelsedit.createAutoSuggest({"id":"x_userlevelname","forceSelect":false});
</script>
<?php echo $userlevels->userlevelname->Lookup->getParamTag("p_x_userlevelname") ?>
</span>
<?php echo $userlevels->userlevelname->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_userlevelname">
		<td class="<?php echo $userlevels_edit->TableLeftColumnClass ?>"><span id="elh_userlevels_userlevelname"><?php echo $userlevels->userlevelname->caption() ?><?php echo ($userlevels->userlevelname->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $userlevels->userlevelname->cellAttributes() ?>>
<span id="el_userlevels_userlevelname">
<?php
$wrkonchange = "" . trim(@$userlevels->userlevelname->EditAttrs["onchange"]);
if (trim($wrkonchange) <> "") $wrkonchange = " onchange=\"" . JsEncode($wrkonchange) . "\"";
$userlevels->userlevelname->EditAttrs["onchange"] = "";
?>
<span id="as_x_userlevelname" class="text-nowrap" style="z-index: 8980">
	<input type="text" class="form-control" name="sv_x_userlevelname" id="sv_x_userlevelname" value="<?php echo RemoveHtml($userlevels->userlevelname->EditValue) ?>" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($userlevels->userlevelname->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($userlevels->userlevelname->getPlaceHolder()) ?>"<?php echo $userlevels->userlevelname->editAttributes() ?>>
</span>
<input type="hidden" data-table="userlevels" data-field="x_userlevelname" data-value-separator="<?php echo $userlevels->userlevelname->displayValueSeparatorAttribute() ?>" name="x_userlevelname" id="x_userlevelname" value="<?php echo HtmlEncode($userlevels->userlevelname->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script>
fuserlevelsedit.createAutoSuggest({"id":"x_userlevelname","forceSelect":false});
</script>
<?php echo $userlevels->userlevelname->Lookup->getParamTag("p_x_userlevelname") ?>
</span>
<?php echo $userlevels->userlevelname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($userlevels_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$userlevels_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $userlevels_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $userlevels_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$userlevels_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$userlevels_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$userlevels_edit->terminate();
?>