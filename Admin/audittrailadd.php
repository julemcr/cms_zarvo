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
$audittrail_add = new audittrail_add();

// Run the page
$audittrail_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$audittrail_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var faudittrailadd = currentForm = new ew.Form("faudittrailadd", "add");

// Validate form
faudittrailadd.validate = function() {
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
		<?php if ($audittrail_add->datetime->Required) { ?>
			elm = this.getElements("x" + infix + "_datetime");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $audittrail->datetime->caption(), $audittrail->datetime->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_datetime");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($audittrail->datetime->errorMessage()) ?>");
		<?php if ($audittrail_add->script->Required) { ?>
			elm = this.getElements("x" + infix + "_script");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $audittrail->script->caption(), $audittrail->script->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($audittrail_add->user->Required) { ?>
			elm = this.getElements("x" + infix + "_user");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $audittrail->user->caption(), $audittrail->user->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($audittrail_add->_action->Required) { ?>
			elm = this.getElements("x" + infix + "__action");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $audittrail->_action->caption(), $audittrail->_action->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($audittrail_add->_table->Required) { ?>
			elm = this.getElements("x" + infix + "__table");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $audittrail->_table->caption(), $audittrail->_table->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($audittrail_add->field->Required) { ?>
			elm = this.getElements("x" + infix + "_field");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $audittrail->field->caption(), $audittrail->field->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($audittrail_add->keyvalue->Required) { ?>
			elm = this.getElements("x" + infix + "_keyvalue");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $audittrail->keyvalue->caption(), $audittrail->keyvalue->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($audittrail_add->oldvalue->Required) { ?>
			elm = this.getElements("x" + infix + "_oldvalue");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $audittrail->oldvalue->caption(), $audittrail->oldvalue->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($audittrail_add->newvalue->Required) { ?>
			elm = this.getElements("x" + infix + "_newvalue");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $audittrail->newvalue->caption(), $audittrail->newvalue->RequiredErrorMessage)) ?>");
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
faudittrailadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
faudittrailadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $audittrail_add->showPageHeader(); ?>
<?php
$audittrail_add->showMessage();
?>
<form name="faudittrailadd" id="faudittrailadd" class="<?php echo $audittrail_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($audittrail_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $audittrail_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="audittrail">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$audittrail_add->IsModal ?>">
<?php if (!$audittrail_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($audittrail_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_audittrailadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($audittrail->datetime->Visible) { // datetime ?>
<?php if ($audittrail_add->IsMobileOrModal) { ?>
	<div id="r_datetime" class="form-group row">
		<label id="elh_audittrail_datetime" for="x_datetime" class="<?php echo $audittrail_add->LeftColumnClass ?>"><?php echo $audittrail->datetime->caption() ?><?php echo ($audittrail->datetime->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $audittrail_add->RightColumnClass ?>"><div<?php echo $audittrail->datetime->cellAttributes() ?>>
<span id="el_audittrail_datetime">
<input type="text" data-table="audittrail" data-field="x_datetime" name="x_datetime" id="x_datetime" placeholder="<?php echo HtmlEncode($audittrail->datetime->getPlaceHolder()) ?>" value="<?php echo $audittrail->datetime->EditValue ?>"<?php echo $audittrail->datetime->editAttributes() ?>>
<?php if (!$audittrail->datetime->ReadOnly && !$audittrail->datetime->Disabled && !isset($audittrail->datetime->EditAttrs["readonly"]) && !isset($audittrail->datetime->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("faudittrailadd", "x_datetime", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $audittrail->datetime->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_datetime">
		<td class="<?php echo $audittrail_add->TableLeftColumnClass ?>"><span id="elh_audittrail_datetime"><?php echo $audittrail->datetime->caption() ?><?php echo ($audittrail->datetime->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $audittrail->datetime->cellAttributes() ?>>
<span id="el_audittrail_datetime">
<input type="text" data-table="audittrail" data-field="x_datetime" name="x_datetime" id="x_datetime" placeholder="<?php echo HtmlEncode($audittrail->datetime->getPlaceHolder()) ?>" value="<?php echo $audittrail->datetime->EditValue ?>"<?php echo $audittrail->datetime->editAttributes() ?>>
<?php if (!$audittrail->datetime->ReadOnly && !$audittrail->datetime->Disabled && !isset($audittrail->datetime->EditAttrs["readonly"]) && !isset($audittrail->datetime->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("faudittrailadd", "x_datetime", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $audittrail->datetime->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($audittrail->script->Visible) { // script ?>
<?php if ($audittrail_add->IsMobileOrModal) { ?>
	<div id="r_script" class="form-group row">
		<label id="elh_audittrail_script" for="x_script" class="<?php echo $audittrail_add->LeftColumnClass ?>"><?php echo $audittrail->script->caption() ?><?php echo ($audittrail->script->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $audittrail_add->RightColumnClass ?>"><div<?php echo $audittrail->script->cellAttributes() ?>>
<span id="el_audittrail_script">
<input type="text" data-table="audittrail" data-field="x_script" name="x_script" id="x_script" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($audittrail->script->getPlaceHolder()) ?>" value="<?php echo $audittrail->script->EditValue ?>"<?php echo $audittrail->script->editAttributes() ?>>
</span>
<?php echo $audittrail->script->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_script">
		<td class="<?php echo $audittrail_add->TableLeftColumnClass ?>"><span id="elh_audittrail_script"><?php echo $audittrail->script->caption() ?><?php echo ($audittrail->script->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $audittrail->script->cellAttributes() ?>>
<span id="el_audittrail_script">
<input type="text" data-table="audittrail" data-field="x_script" name="x_script" id="x_script" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($audittrail->script->getPlaceHolder()) ?>" value="<?php echo $audittrail->script->EditValue ?>"<?php echo $audittrail->script->editAttributes() ?>>
</span>
<?php echo $audittrail->script->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($audittrail->user->Visible) { // user ?>
<?php if ($audittrail_add->IsMobileOrModal) { ?>
	<div id="r_user" class="form-group row">
		<label id="elh_audittrail_user" for="x_user" class="<?php echo $audittrail_add->LeftColumnClass ?>"><?php echo $audittrail->user->caption() ?><?php echo ($audittrail->user->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $audittrail_add->RightColumnClass ?>"><div<?php echo $audittrail->user->cellAttributes() ?>>
<span id="el_audittrail_user">
<input type="text" data-table="audittrail" data-field="x_user" name="x_user" id="x_user" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($audittrail->user->getPlaceHolder()) ?>" value="<?php echo $audittrail->user->EditValue ?>"<?php echo $audittrail->user->editAttributes() ?>>
</span>
<?php echo $audittrail->user->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_user">
		<td class="<?php echo $audittrail_add->TableLeftColumnClass ?>"><span id="elh_audittrail_user"><?php echo $audittrail->user->caption() ?><?php echo ($audittrail->user->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $audittrail->user->cellAttributes() ?>>
<span id="el_audittrail_user">
<input type="text" data-table="audittrail" data-field="x_user" name="x_user" id="x_user" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($audittrail->user->getPlaceHolder()) ?>" value="<?php echo $audittrail->user->EditValue ?>"<?php echo $audittrail->user->editAttributes() ?>>
</span>
<?php echo $audittrail->user->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($audittrail->_action->Visible) { // action ?>
<?php if ($audittrail_add->IsMobileOrModal) { ?>
	<div id="r__action" class="form-group row">
		<label id="elh_audittrail__action" for="x__action" class="<?php echo $audittrail_add->LeftColumnClass ?>"><?php echo $audittrail->_action->caption() ?><?php echo ($audittrail->_action->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $audittrail_add->RightColumnClass ?>"><div<?php echo $audittrail->_action->cellAttributes() ?>>
<span id="el_audittrail__action">
<input type="text" data-table="audittrail" data-field="x__action" name="x__action" id="x__action" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($audittrail->_action->getPlaceHolder()) ?>" value="<?php echo $audittrail->_action->EditValue ?>"<?php echo $audittrail->_action->editAttributes() ?>>
</span>
<?php echo $audittrail->_action->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__action">
		<td class="<?php echo $audittrail_add->TableLeftColumnClass ?>"><span id="elh_audittrail__action"><?php echo $audittrail->_action->caption() ?><?php echo ($audittrail->_action->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $audittrail->_action->cellAttributes() ?>>
<span id="el_audittrail__action">
<input type="text" data-table="audittrail" data-field="x__action" name="x__action" id="x__action" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($audittrail->_action->getPlaceHolder()) ?>" value="<?php echo $audittrail->_action->EditValue ?>"<?php echo $audittrail->_action->editAttributes() ?>>
</span>
<?php echo $audittrail->_action->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($audittrail->_table->Visible) { // table ?>
<?php if ($audittrail_add->IsMobileOrModal) { ?>
	<div id="r__table" class="form-group row">
		<label id="elh_audittrail__table" for="x__table" class="<?php echo $audittrail_add->LeftColumnClass ?>"><?php echo $audittrail->_table->caption() ?><?php echo ($audittrail->_table->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $audittrail_add->RightColumnClass ?>"><div<?php echo $audittrail->_table->cellAttributes() ?>>
<span id="el_audittrail__table">
<input type="text" data-table="audittrail" data-field="x__table" name="x__table" id="x__table" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($audittrail->_table->getPlaceHolder()) ?>" value="<?php echo $audittrail->_table->EditValue ?>"<?php echo $audittrail->_table->editAttributes() ?>>
</span>
<?php echo $audittrail->_table->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__table">
		<td class="<?php echo $audittrail_add->TableLeftColumnClass ?>"><span id="elh_audittrail__table"><?php echo $audittrail->_table->caption() ?><?php echo ($audittrail->_table->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $audittrail->_table->cellAttributes() ?>>
<span id="el_audittrail__table">
<input type="text" data-table="audittrail" data-field="x__table" name="x__table" id="x__table" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($audittrail->_table->getPlaceHolder()) ?>" value="<?php echo $audittrail->_table->EditValue ?>"<?php echo $audittrail->_table->editAttributes() ?>>
</span>
<?php echo $audittrail->_table->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($audittrail->field->Visible) { // field ?>
<?php if ($audittrail_add->IsMobileOrModal) { ?>
	<div id="r_field" class="form-group row">
		<label id="elh_audittrail_field" for="x_field" class="<?php echo $audittrail_add->LeftColumnClass ?>"><?php echo $audittrail->field->caption() ?><?php echo ($audittrail->field->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $audittrail_add->RightColumnClass ?>"><div<?php echo $audittrail->field->cellAttributes() ?>>
<span id="el_audittrail_field">
<input type="text" data-table="audittrail" data-field="x_field" name="x_field" id="x_field" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($audittrail->field->getPlaceHolder()) ?>" value="<?php echo $audittrail->field->EditValue ?>"<?php echo $audittrail->field->editAttributes() ?>>
</span>
<?php echo $audittrail->field->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_field">
		<td class="<?php echo $audittrail_add->TableLeftColumnClass ?>"><span id="elh_audittrail_field"><?php echo $audittrail->field->caption() ?><?php echo ($audittrail->field->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $audittrail->field->cellAttributes() ?>>
<span id="el_audittrail_field">
<input type="text" data-table="audittrail" data-field="x_field" name="x_field" id="x_field" size="30" maxlength="80" placeholder="<?php echo HtmlEncode($audittrail->field->getPlaceHolder()) ?>" value="<?php echo $audittrail->field->EditValue ?>"<?php echo $audittrail->field->editAttributes() ?>>
</span>
<?php echo $audittrail->field->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($audittrail->keyvalue->Visible) { // keyvalue ?>
<?php if ($audittrail_add->IsMobileOrModal) { ?>
	<div id="r_keyvalue" class="form-group row">
		<label id="elh_audittrail_keyvalue" for="x_keyvalue" class="<?php echo $audittrail_add->LeftColumnClass ?>"><?php echo $audittrail->keyvalue->caption() ?><?php echo ($audittrail->keyvalue->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $audittrail_add->RightColumnClass ?>"><div<?php echo $audittrail->keyvalue->cellAttributes() ?>>
<span id="el_audittrail_keyvalue">
<textarea data-table="audittrail" data-field="x_keyvalue" name="x_keyvalue" id="x_keyvalue" cols="35" rows="4" placeholder="<?php echo HtmlEncode($audittrail->keyvalue->getPlaceHolder()) ?>"<?php echo $audittrail->keyvalue->editAttributes() ?>><?php echo $audittrail->keyvalue->EditValue ?></textarea>
</span>
<?php echo $audittrail->keyvalue->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_keyvalue">
		<td class="<?php echo $audittrail_add->TableLeftColumnClass ?>"><span id="elh_audittrail_keyvalue"><?php echo $audittrail->keyvalue->caption() ?><?php echo ($audittrail->keyvalue->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $audittrail->keyvalue->cellAttributes() ?>>
<span id="el_audittrail_keyvalue">
<textarea data-table="audittrail" data-field="x_keyvalue" name="x_keyvalue" id="x_keyvalue" cols="35" rows="4" placeholder="<?php echo HtmlEncode($audittrail->keyvalue->getPlaceHolder()) ?>"<?php echo $audittrail->keyvalue->editAttributes() ?>><?php echo $audittrail->keyvalue->EditValue ?></textarea>
</span>
<?php echo $audittrail->keyvalue->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($audittrail->oldvalue->Visible) { // oldvalue ?>
<?php if ($audittrail_add->IsMobileOrModal) { ?>
	<div id="r_oldvalue" class="form-group row">
		<label id="elh_audittrail_oldvalue" for="x_oldvalue" class="<?php echo $audittrail_add->LeftColumnClass ?>"><?php echo $audittrail->oldvalue->caption() ?><?php echo ($audittrail->oldvalue->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $audittrail_add->RightColumnClass ?>"><div<?php echo $audittrail->oldvalue->cellAttributes() ?>>
<span id="el_audittrail_oldvalue">
<textarea data-table="audittrail" data-field="x_oldvalue" name="x_oldvalue" id="x_oldvalue" cols="35" rows="4" placeholder="<?php echo HtmlEncode($audittrail->oldvalue->getPlaceHolder()) ?>"<?php echo $audittrail->oldvalue->editAttributes() ?>><?php echo $audittrail->oldvalue->EditValue ?></textarea>
</span>
<?php echo $audittrail->oldvalue->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_oldvalue">
		<td class="<?php echo $audittrail_add->TableLeftColumnClass ?>"><span id="elh_audittrail_oldvalue"><?php echo $audittrail->oldvalue->caption() ?><?php echo ($audittrail->oldvalue->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $audittrail->oldvalue->cellAttributes() ?>>
<span id="el_audittrail_oldvalue">
<textarea data-table="audittrail" data-field="x_oldvalue" name="x_oldvalue" id="x_oldvalue" cols="35" rows="4" placeholder="<?php echo HtmlEncode($audittrail->oldvalue->getPlaceHolder()) ?>"<?php echo $audittrail->oldvalue->editAttributes() ?>><?php echo $audittrail->oldvalue->EditValue ?></textarea>
</span>
<?php echo $audittrail->oldvalue->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($audittrail->newvalue->Visible) { // newvalue ?>
<?php if ($audittrail_add->IsMobileOrModal) { ?>
	<div id="r_newvalue" class="form-group row">
		<label id="elh_audittrail_newvalue" for="x_newvalue" class="<?php echo $audittrail_add->LeftColumnClass ?>"><?php echo $audittrail->newvalue->caption() ?><?php echo ($audittrail->newvalue->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $audittrail_add->RightColumnClass ?>"><div<?php echo $audittrail->newvalue->cellAttributes() ?>>
<span id="el_audittrail_newvalue">
<textarea data-table="audittrail" data-field="x_newvalue" name="x_newvalue" id="x_newvalue" cols="35" rows="4" placeholder="<?php echo HtmlEncode($audittrail->newvalue->getPlaceHolder()) ?>"<?php echo $audittrail->newvalue->editAttributes() ?>><?php echo $audittrail->newvalue->EditValue ?></textarea>
</span>
<?php echo $audittrail->newvalue->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_newvalue">
		<td class="<?php echo $audittrail_add->TableLeftColumnClass ?>"><span id="elh_audittrail_newvalue"><?php echo $audittrail->newvalue->caption() ?><?php echo ($audittrail->newvalue->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $audittrail->newvalue->cellAttributes() ?>>
<span id="el_audittrail_newvalue">
<textarea data-table="audittrail" data-field="x_newvalue" name="x_newvalue" id="x_newvalue" cols="35" rows="4" placeholder="<?php echo HtmlEncode($audittrail->newvalue->getPlaceHolder()) ?>"<?php echo $audittrail->newvalue->editAttributes() ?>><?php echo $audittrail->newvalue->EditValue ?></textarea>
</span>
<?php echo $audittrail->newvalue->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($audittrail_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$audittrail_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $audittrail_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $audittrail_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$audittrail_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$audittrail_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$audittrail_add->terminate();
?>