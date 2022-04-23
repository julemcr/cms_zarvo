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
$person_edit = new person_edit();

// Run the page
$person_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$person_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fpersonedit = currentForm = new ew.Form("fpersonedit", "edit");

// Validate form
fpersonedit.validate = function() {
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
		<?php if ($person_edit->PersonID->Required) { ?>
			elm = this.getElements("x" + infix + "_PersonID");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->PersonID->caption(), $person->PersonID->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->Sexo->Required) { ?>
			elm = this.getElements("x" + infix + "_Sexo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->Sexo->caption(), $person->Sexo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->Name->Required) { ?>
			elm = this.getElements("x" + infix + "_Name");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->Name->caption(), $person->Name->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->LastName->Required) { ?>
			elm = this.getElements("x" + infix + "_LastName");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->LastName->caption(), $person->LastName->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->BirthDate->Required) { ?>
			elm = this.getElements("x" + infix + "_BirthDate");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->BirthDate->caption(), $person->BirthDate->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_BirthDate");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($person->BirthDate->errorMessage()) ?>");
		<?php if ($person_edit->Country->Required) { ?>
			elm = this.getElements("x" + infix + "_Country");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->Country->caption(), $person->Country->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->City->Required) { ?>
			elm = this.getElements("x" + infix + "_City");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->City->caption(), $person->City->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->Address->Required) { ?>
			elm = this.getElements("x" + infix + "_Address");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->Address->caption(), $person->Address->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->PostalCode->Required) { ?>
			elm = this.getElements("x" + infix + "_PostalCode");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->PostalCode->caption(), $person->PostalCode->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->Phone->Required) { ?>
			elm = this.getElements("x" + infix + "_Phone");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->Phone->caption(), $person->Phone->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->_Email->Required) { ?>
			elm = this.getElements("x" + infix + "__Email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->_Email->caption(), $person->_Email->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->Photo->Required) { ?>
			felm = this.getElements("x" + infix + "_Photo");
			elm = this.getElements("fn_x" + infix + "_Photo");
			if (felm && elm && !ew.hasValue(elm))
				return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $person->Photo->caption(), $person->Photo->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->Notes->Required) { ?>
			elm = this.getElements("x" + infix + "_Notes");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->Notes->caption(), $person->Notes->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->Facebook->Required) { ?>
			elm = this.getElements("x" + infix + "_Facebook");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->Facebook->caption(), $person->Facebook->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->Instagram->Required) { ?>
			elm = this.getElements("x" + infix + "_Instagram");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->Instagram->caption(), $person->Instagram->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->Linkedin->Required) { ?>
			elm = this.getElements("x" + infix + "_Linkedin");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->Linkedin->caption(), $person->Linkedin->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->Username->Required) { ?>
			elm = this.getElements("x" + infix + "_Username");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->Username->caption(), $person->Username->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->Password->Required) { ?>
			elm = this.getElements("x" + infix + "_Password");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->Password->caption(), $person->Password->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->UserLevel->Required) { ?>
			elm = this.getElements("x" + infix + "_UserLevel");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->UserLevel->caption(), $person->UserLevel->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->Profile->Required) { ?>
			elm = this.getElements("x" + infix + "_Profile");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->Profile->caption(), $person->Profile->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($person_edit->Activated->Required) { ?>
			elm = this.getElements("x" + infix + "_Activated[]");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $person->Activated->caption(), $person->Activated->RequiredErrorMessage)) ?>");
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
fpersonedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpersonedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Multi-Page
fpersonedit.multiPage = new ew.MultiPage("fpersonedit");

// Dynamic selection lists
fpersonedit.lists["x_Sexo"] = <?php echo $person_edit->Sexo->Lookup->toClientList() ?>;
fpersonedit.lists["x_Sexo"].options = <?php echo JsonEncode($person_edit->Sexo->lookupOptions()) ?>;
fpersonedit.lists["x_Country"] = <?php echo $person_edit->Country->Lookup->toClientList() ?>;
fpersonedit.lists["x_Country"].options = <?php echo JsonEncode($person_edit->Country->lookupOptions()) ?>;
fpersonedit.lists["x_UserLevel"] = <?php echo $person_edit->UserLevel->Lookup->toClientList() ?>;
fpersonedit.lists["x_UserLevel"].options = <?php echo JsonEncode($person_edit->UserLevel->lookupOptions()) ?>;
fpersonedit.lists["x_Activated[]"] = <?php echo $person_edit->Activated->Lookup->toClientList() ?>;
fpersonedit.lists["x_Activated[]"].options = <?php echo JsonEncode($person_edit->Activated->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $person_edit->showPageHeader(); ?>
<?php
$person_edit->showMessage();
?>
<form name="fpersonedit" id="fpersonedit" class="<?php echo $person_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($person_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $person_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="person">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$person_edit->IsModal ?>">
<!-- Fields to prevent google autofill -->
<input class="d-none" type="text" name="<?php echo Encrypt(Random()) ?>">
<input class="d-none" type="password" name="<?php echo Encrypt(Random()) ?>">
<?php if (!$person_edit->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($person_edit->MultiPages->Items[0]->Visible) { ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page0 -->
<?php } else { ?>
<table id="tbl_personedit0" class="table table-striped table-sm ew-desktop-table"><!-- page0 table -->
<?php } ?>
<?php if ($person->PersonID->Visible) { // PersonID ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_PersonID" class="form-group row">
		<label id="elh_person_PersonID" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->PersonID->caption() ?><?php echo ($person->PersonID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->PersonID->cellAttributes() ?>>
<span id="el_person_PersonID">
<span<?php echo $person->PersonID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($person->PersonID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="person" data-field="x_PersonID" data-page="0" name="x_PersonID" id="x_PersonID" value="<?php echo HtmlEncode($person->PersonID->CurrentValue) ?>">
<?php echo $person->PersonID->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_PersonID">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_PersonID"><?php echo $person->PersonID->caption() ?><?php echo ($person->PersonID->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->PersonID->cellAttributes() ?>>
<span id="el_person_PersonID">
<span<?php echo $person->PersonID->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($person->PersonID->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="person" data-field="x_PersonID" data-page="0" name="x_PersonID" id="x_PersonID" value="<?php echo HtmlEncode($person->PersonID->CurrentValue) ?>">
<?php echo $person->PersonID->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person->Activated->Visible) { // Activated ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_Activated" class="form-group row">
		<label id="elh_person_Activated" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->Activated->caption() ?><?php echo ($person->Activated->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->Activated->cellAttributes() ?>>
<span id="el_person_Activated">
<?php
$selwrk = (ConvertToBool($person->Activated->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="person" data-field="x_Activated" data-page="0" name="x_Activated[]" id="x_Activated[]" value="1"<?php echo $selwrk ?><?php echo $person->Activated->editAttributes() ?>>
</span>
<?php echo $person->Activated->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Activated">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_Activated"><?php echo $person->Activated->caption() ?><?php echo ($person->Activated->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->Activated->cellAttributes() ?>>
<span id="el_person_Activated">
<?php
$selwrk = (ConvertToBool($person->Activated->CurrentValue)) ? " checked" : "";
?>
<input type="checkbox" data-table="person" data-field="x_Activated" data-page="0" name="x_Activated[]" id="x_Activated[]" value="1"<?php echo $selwrk ?><?php echo $person->Activated->editAttributes() ?>>
</span>
<?php echo $person->Activated->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
</div><!-- /page0 -->
<?php } else { ?>
</table><!-- /page0 table -->
<?php } ?>
<?php } ?>
<div class="ew-multi-page"><!-- multi-page -->
<div class="ew-nav-tabs" id="person_edit"><!-- multi-page tabs -->
	<ul class="<?php echo $person_edit->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $person_edit->MultiPages->pageStyle("1") ?>" href="#tab_person1" data-toggle="tab"><?php echo $person->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $person_edit->MultiPages->pageStyle("2") ?>" href="#tab_person2" data-toggle="tab"><?php echo $person->pageCaption(2) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $person_edit->MultiPages->pageStyle("3") ?>" href="#tab_person3" data-toggle="tab"><?php echo $person->pageCaption(3) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $person_edit->MultiPages->pageStyle("4") ?>" href="#tab_person4" data-toggle="tab"><?php echo $person->pageCaption(4) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $person_edit->MultiPages->pageStyle("5") ?>" href="#tab_person5" data-toggle="tab"><?php echo $person->pageCaption(5) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page tabs .tab-content -->
		<div class="tab-pane<?php echo $person_edit->MultiPages->pageStyle("1") ?>" id="tab_person1"><!-- multi-page .tab-pane -->
<?php if ($person_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_personedit1" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($person->Sexo->Visible) { // Sexo ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_Sexo" class="form-group row">
		<label id="elh_person_Sexo" for="x_Sexo" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->Sexo->caption() ?><?php echo ($person->Sexo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->Sexo->cellAttributes() ?>>
<span id="el_person_Sexo">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="person" data-field="x_Sexo" data-page="1" data-value-separator="<?php echo $person->Sexo->displayValueSeparatorAttribute() ?>" id="x_Sexo" name="x_Sexo"<?php echo $person->Sexo->editAttributes() ?>>
		<?php echo $person->Sexo->selectOptionListHtml("x_Sexo") ?>
	</select>
</div>
<?php echo $person->Sexo->Lookup->getParamTag("p_x_Sexo") ?>
</span>
<?php echo $person->Sexo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Sexo">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_Sexo"><?php echo $person->Sexo->caption() ?><?php echo ($person->Sexo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->Sexo->cellAttributes() ?>>
<span id="el_person_Sexo">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="person" data-field="x_Sexo" data-page="1" data-value-separator="<?php echo $person->Sexo->displayValueSeparatorAttribute() ?>" id="x_Sexo" name="x_Sexo"<?php echo $person->Sexo->editAttributes() ?>>
		<?php echo $person->Sexo->selectOptionListHtml("x_Sexo") ?>
	</select>
</div>
<?php echo $person->Sexo->Lookup->getParamTag("p_x_Sexo") ?>
</span>
<?php echo $person->Sexo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person->Name->Visible) { // Name ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_Name" class="form-group row">
		<label id="elh_person_Name" for="x_Name" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->Name->caption() ?><?php echo ($person->Name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->Name->cellAttributes() ?>>
<span id="el_person_Name">
<input type="text" data-table="person" data-field="x_Name" data-page="1" name="x_Name" id="x_Name" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($person->Name->getPlaceHolder()) ?>" value="<?php echo $person->Name->EditValue ?>"<?php echo $person->Name->editAttributes() ?>>
</span>
<?php echo $person->Name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Name">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_Name"><?php echo $person->Name->caption() ?><?php echo ($person->Name->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->Name->cellAttributes() ?>>
<span id="el_person_Name">
<input type="text" data-table="person" data-field="x_Name" data-page="1" name="x_Name" id="x_Name" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($person->Name->getPlaceHolder()) ?>" value="<?php echo $person->Name->EditValue ?>"<?php echo $person->Name->editAttributes() ?>>
</span>
<?php echo $person->Name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person->LastName->Visible) { // LastName ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_LastName" class="form-group row">
		<label id="elh_person_LastName" for="x_LastName" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->LastName->caption() ?><?php echo ($person->LastName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->LastName->cellAttributes() ?>>
<span id="el_person_LastName">
<input type="text" data-table="person" data-field="x_LastName" data-page="1" name="x_LastName" id="x_LastName" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($person->LastName->getPlaceHolder()) ?>" value="<?php echo $person->LastName->EditValue ?>"<?php echo $person->LastName->editAttributes() ?>>
</span>
<?php echo $person->LastName->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_LastName">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_LastName"><?php echo $person->LastName->caption() ?><?php echo ($person->LastName->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->LastName->cellAttributes() ?>>
<span id="el_person_LastName">
<input type="text" data-table="person" data-field="x_LastName" data-page="1" name="x_LastName" id="x_LastName" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($person->LastName->getPlaceHolder()) ?>" value="<?php echo $person->LastName->EditValue ?>"<?php echo $person->LastName->editAttributes() ?>>
</span>
<?php echo $person->LastName->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person->BirthDate->Visible) { // BirthDate ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_BirthDate" class="form-group row">
		<label id="elh_person_BirthDate" for="x_BirthDate" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->BirthDate->caption() ?><?php echo ($person->BirthDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->BirthDate->cellAttributes() ?>>
<span id="el_person_BirthDate">
<input type="text" data-table="person" data-field="x_BirthDate" data-page="1" name="x_BirthDate" id="x_BirthDate" placeholder="<?php echo HtmlEncode($person->BirthDate->getPlaceHolder()) ?>" value="<?php echo $person->BirthDate->EditValue ?>"<?php echo $person->BirthDate->editAttributes() ?>>
<?php if (!$person->BirthDate->ReadOnly && !$person->BirthDate->Disabled && !isset($person->BirthDate->EditAttrs["readonly"]) && !isset($person->BirthDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fpersonedit", "x_BirthDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $person->BirthDate->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_BirthDate">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_BirthDate"><?php echo $person->BirthDate->caption() ?><?php echo ($person->BirthDate->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->BirthDate->cellAttributes() ?>>
<span id="el_person_BirthDate">
<input type="text" data-table="person" data-field="x_BirthDate" data-page="1" name="x_BirthDate" id="x_BirthDate" placeholder="<?php echo HtmlEncode($person->BirthDate->getPlaceHolder()) ?>" value="<?php echo $person->BirthDate->EditValue ?>"<?php echo $person->BirthDate->editAttributes() ?>>
<?php if (!$person->BirthDate->ReadOnly && !$person->BirthDate->Disabled && !isset($person->BirthDate->EditAttrs["readonly"]) && !isset($person->BirthDate->EditAttrs["disabled"])) { ?>
<script>
ew.createDateTimePicker("fpersonedit", "x_BirthDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
</script>
<?php } ?>
</span>
<?php echo $person->BirthDate->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person->Country->Visible) { // Country ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_Country" class="form-group row">
		<label id="elh_person_Country" for="x_Country" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->Country->caption() ?><?php echo ($person->Country->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->Country->cellAttributes() ?>>
<span id="el_person_Country">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="person" data-field="x_Country" data-page="1" data-value-separator="<?php echo $person->Country->displayValueSeparatorAttribute() ?>" id="x_Country" name="x_Country"<?php echo $person->Country->editAttributes() ?>>
		<?php echo $person->Country->selectOptionListHtml("x_Country") ?>
	</select>
</div>
<?php echo $person->Country->Lookup->getParamTag("p_x_Country") ?>
</span>
<?php echo $person->Country->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Country">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_Country"><?php echo $person->Country->caption() ?><?php echo ($person->Country->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->Country->cellAttributes() ?>>
<span id="el_person_Country">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="person" data-field="x_Country" data-page="1" data-value-separator="<?php echo $person->Country->displayValueSeparatorAttribute() ?>" id="x_Country" name="x_Country"<?php echo $person->Country->editAttributes() ?>>
		<?php echo $person->Country->selectOptionListHtml("x_Country") ?>
	</select>
</div>
<?php echo $person->Country->Lookup->getParamTag("p_x_Country") ?>
</span>
<?php echo $person->Country->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person->City->Visible) { // City ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_City" class="form-group row">
		<label id="elh_person_City" for="x_City" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->City->caption() ?><?php echo ($person->City->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->City->cellAttributes() ?>>
<span id="el_person_City">
<input type="text" data-table="person" data-field="x_City" data-page="1" name="x_City" id="x_City" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($person->City->getPlaceHolder()) ?>" value="<?php echo $person->City->EditValue ?>"<?php echo $person->City->editAttributes() ?>>
</span>
<?php echo $person->City->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_City">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_City"><?php echo $person->City->caption() ?><?php echo ($person->City->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->City->cellAttributes() ?>>
<span id="el_person_City">
<input type="text" data-table="person" data-field="x_City" data-page="1" name="x_City" id="x_City" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($person->City->getPlaceHolder()) ?>" value="<?php echo $person->City->EditValue ?>"<?php echo $person->City->editAttributes() ?>>
</span>
<?php echo $person->City->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person->Address->Visible) { // Address ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_Address" class="form-group row">
		<label id="elh_person_Address" for="x_Address" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->Address->caption() ?><?php echo ($person->Address->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->Address->cellAttributes() ?>>
<span id="el_person_Address">
<input type="text" data-table="person" data-field="x_Address" data-page="1" name="x_Address" id="x_Address" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($person->Address->getPlaceHolder()) ?>" value="<?php echo $person->Address->EditValue ?>"<?php echo $person->Address->editAttributes() ?>>
</span>
<?php echo $person->Address->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Address">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_Address"><?php echo $person->Address->caption() ?><?php echo ($person->Address->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->Address->cellAttributes() ?>>
<span id="el_person_Address">
<input type="text" data-table="person" data-field="x_Address" data-page="1" name="x_Address" id="x_Address" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($person->Address->getPlaceHolder()) ?>" value="<?php echo $person->Address->EditValue ?>"<?php echo $person->Address->editAttributes() ?>>
</span>
<?php echo $person->Address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person->PostalCode->Visible) { // PostalCode ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_PostalCode" class="form-group row">
		<label id="elh_person_PostalCode" for="x_PostalCode" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->PostalCode->caption() ?><?php echo ($person->PostalCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->PostalCode->cellAttributes() ?>>
<span id="el_person_PostalCode">
<input type="text" data-table="person" data-field="x_PostalCode" data-page="1" name="x_PostalCode" id="x_PostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($person->PostalCode->getPlaceHolder()) ?>" value="<?php echo $person->PostalCode->EditValue ?>"<?php echo $person->PostalCode->editAttributes() ?>>
</span>
<?php echo $person->PostalCode->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_PostalCode">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_PostalCode"><?php echo $person->PostalCode->caption() ?><?php echo ($person->PostalCode->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->PostalCode->cellAttributes() ?>>
<span id="el_person_PostalCode">
<input type="text" data-table="person" data-field="x_PostalCode" data-page="1" name="x_PostalCode" id="x_PostalCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($person->PostalCode->getPlaceHolder()) ?>" value="<?php echo $person->PostalCode->EditValue ?>"<?php echo $person->PostalCode->editAttributes() ?>>
</span>
<?php echo $person->PostalCode->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person->Phone->Visible) { // Phone ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_Phone" class="form-group row">
		<label id="elh_person_Phone" for="x_Phone" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->Phone->caption() ?><?php echo ($person->Phone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->Phone->cellAttributes() ?>>
<span id="el_person_Phone">
<input type="text" data-table="person" data-field="x_Phone" data-page="1" name="x_Phone" id="x_Phone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($person->Phone->getPlaceHolder()) ?>" value="<?php echo $person->Phone->EditValue ?>"<?php echo $person->Phone->editAttributes() ?>>
</span>
<?php echo $person->Phone->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Phone">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_Phone"><?php echo $person->Phone->caption() ?><?php echo ($person->Phone->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->Phone->cellAttributes() ?>>
<span id="el_person_Phone">
<input type="text" data-table="person" data-field="x_Phone" data-page="1" name="x_Phone" id="x_Phone" size="30" maxlength="24" placeholder="<?php echo HtmlEncode($person->Phone->getPlaceHolder()) ?>" value="<?php echo $person->Phone->EditValue ?>"<?php echo $person->Phone->editAttributes() ?>>
</span>
<?php echo $person->Phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person->_Email->Visible) { // Email ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_person__Email" for="x__Email" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->_Email->caption() ?><?php echo ($person->_Email->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->_Email->cellAttributes() ?>>
<span id="el_person__Email">
<input type="text" data-table="person" data-field="x__Email" data-page="1" name="x__Email" id="x__Email" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($person->_Email->getPlaceHolder()) ?>" value="<?php echo $person->_Email->EditValue ?>"<?php echo $person->_Email->editAttributes() ?>>
</span>
<?php echo $person->_Email->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__Email">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person__Email"><?php echo $person->_Email->caption() ?><?php echo ($person->_Email->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->_Email->cellAttributes() ?>>
<span id="el_person__Email">
<input type="text" data-table="person" data-field="x__Email" data-page="1" name="x__Email" id="x__Email" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($person->_Email->getPlaceHolder()) ?>" value="<?php echo $person->_Email->EditValue ?>"<?php echo $person->_Email->editAttributes() ?>>
</span>
<?php echo $person->_Email->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $person_edit->MultiPages->pageStyle("2") ?>" id="tab_person2"><!-- multi-page .tab-pane -->
<?php if ($person_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_personedit2" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($person->Photo->Visible) { // Photo ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_Photo" class="form-group row">
		<label id="elh_person_Photo" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->Photo->caption() ?><?php echo ($person->Photo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->Photo->cellAttributes() ?>>
<span id="el_person_Photo">
<div id="fd_x_Photo">
<span title="<?php echo $person->Photo->title() ? $person->Photo->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($person->Photo->ReadOnly || $person->Photo->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="person" data-field="x_Photo" data-page="2" name="x_Photo" id="x_Photo"<?php echo $person->Photo->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_Photo" id= "fn_x_Photo" value="<?php echo $person->Photo->Upload->FileName ?>">
<?php if (Post("fa_x_Photo") == "0") { ?>
<input type="hidden" name="fa_x_Photo" id= "fa_x_Photo" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_Photo" id= "fa_x_Photo" value="1">
<?php } ?>
<input type="hidden" name="fs_x_Photo" id= "fs_x_Photo" value="255">
<input type="hidden" name="fx_x_Photo" id= "fx_x_Photo" value="<?php echo $person->Photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Photo" id= "fm_x_Photo" value="<?php echo $person->Photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Photo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $person->Photo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Photo">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_Photo"><?php echo $person->Photo->caption() ?><?php echo ($person->Photo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->Photo->cellAttributes() ?>>
<span id="el_person_Photo">
<div id="fd_x_Photo">
<span title="<?php echo $person->Photo->title() ? $person->Photo->title() : $Language->phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ew-tooltip<?php if ($person->Photo->ReadOnly || $person->Photo->Disabled) echo " d-none"; ?>">
	<span><?php echo $Language->phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="person" data-field="x_Photo" data-page="2" name="x_Photo" id="x_Photo"<?php echo $person->Photo->editAttributes() ?>>
</span>
<input type="hidden" name="fn_x_Photo" id= "fn_x_Photo" value="<?php echo $person->Photo->Upload->FileName ?>">
<?php if (Post("fa_x_Photo") == "0") { ?>
<input type="hidden" name="fa_x_Photo" id= "fa_x_Photo" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_Photo" id= "fa_x_Photo" value="1">
<?php } ?>
<input type="hidden" name="fs_x_Photo" id= "fs_x_Photo" value="255">
<input type="hidden" name="fx_x_Photo" id= "fx_x_Photo" value="<?php echo $person->Photo->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Photo" id= "fm_x_Photo" value="<?php echo $person->Photo->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Photo" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $person->Photo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $person_edit->MultiPages->pageStyle("3") ?>" id="tab_person3"><!-- multi-page .tab-pane -->
<?php if ($person_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_personedit3" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($person->Notes->Visible) { // Notes ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_Notes" class="form-group row">
		<label id="elh_person_Notes" for="x_Notes" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->Notes->caption() ?><?php echo ($person->Notes->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->Notes->cellAttributes() ?>>
<span id="el_person_Notes">
<textarea data-table="person" data-field="x_Notes" data-page="3" name="x_Notes" id="x_Notes" cols="35" rows="4" placeholder="<?php echo HtmlEncode($person->Notes->getPlaceHolder()) ?>"<?php echo $person->Notes->editAttributes() ?>><?php echo $person->Notes->EditValue ?></textarea>
</span>
<?php echo $person->Notes->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Notes">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_Notes"><?php echo $person->Notes->caption() ?><?php echo ($person->Notes->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->Notes->cellAttributes() ?>>
<span id="el_person_Notes">
<textarea data-table="person" data-field="x_Notes" data-page="3" name="x_Notes" id="x_Notes" cols="35" rows="4" placeholder="<?php echo HtmlEncode($person->Notes->getPlaceHolder()) ?>"<?php echo $person->Notes->editAttributes() ?>><?php echo $person->Notes->EditValue ?></textarea>
</span>
<?php echo $person->Notes->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $person_edit->MultiPages->pageStyle("4") ?>" id="tab_person4"><!-- multi-page .tab-pane -->
<?php if ($person_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_personedit4" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($person->Facebook->Visible) { // Facebook ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_Facebook" class="form-group row">
		<label id="elh_person_Facebook" for="x_Facebook" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->Facebook->caption() ?><?php echo ($person->Facebook->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->Facebook->cellAttributes() ?>>
<span id="el_person_Facebook">
<input type="text" data-table="person" data-field="x_Facebook" data-page="4" name="x_Facebook" id="x_Facebook" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($person->Facebook->getPlaceHolder()) ?>" value="<?php echo $person->Facebook->EditValue ?>"<?php echo $person->Facebook->editAttributes() ?>>
</span>
<?php echo $person->Facebook->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Facebook">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_Facebook"><?php echo $person->Facebook->caption() ?><?php echo ($person->Facebook->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->Facebook->cellAttributes() ?>>
<span id="el_person_Facebook">
<input type="text" data-table="person" data-field="x_Facebook" data-page="4" name="x_Facebook" id="x_Facebook" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($person->Facebook->getPlaceHolder()) ?>" value="<?php echo $person->Facebook->EditValue ?>"<?php echo $person->Facebook->editAttributes() ?>>
</span>
<?php echo $person->Facebook->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person->Instagram->Visible) { // Instagram ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_Instagram" class="form-group row">
		<label id="elh_person_Instagram" for="x_Instagram" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->Instagram->caption() ?><?php echo ($person->Instagram->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->Instagram->cellAttributes() ?>>
<span id="el_person_Instagram">
<input type="text" data-table="person" data-field="x_Instagram" data-page="4" name="x_Instagram" id="x_Instagram" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($person->Instagram->getPlaceHolder()) ?>" value="<?php echo $person->Instagram->EditValue ?>"<?php echo $person->Instagram->editAttributes() ?>>
</span>
<?php echo $person->Instagram->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Instagram">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_Instagram"><?php echo $person->Instagram->caption() ?><?php echo ($person->Instagram->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->Instagram->cellAttributes() ?>>
<span id="el_person_Instagram">
<input type="text" data-table="person" data-field="x_Instagram" data-page="4" name="x_Instagram" id="x_Instagram" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($person->Instagram->getPlaceHolder()) ?>" value="<?php echo $person->Instagram->EditValue ?>"<?php echo $person->Instagram->editAttributes() ?>>
</span>
<?php echo $person->Instagram->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person->Linkedin->Visible) { // Linkedin ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_Linkedin" class="form-group row">
		<label id="elh_person_Linkedin" for="x_Linkedin" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->Linkedin->caption() ?><?php echo ($person->Linkedin->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->Linkedin->cellAttributes() ?>>
<span id="el_person_Linkedin">
<input type="text" data-table="person" data-field="x_Linkedin" data-page="4" name="x_Linkedin" id="x_Linkedin" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($person->Linkedin->getPlaceHolder()) ?>" value="<?php echo $person->Linkedin->EditValue ?>"<?php echo $person->Linkedin->editAttributes() ?>>
</span>
<?php echo $person->Linkedin->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Linkedin">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_Linkedin"><?php echo $person->Linkedin->caption() ?><?php echo ($person->Linkedin->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->Linkedin->cellAttributes() ?>>
<span id="el_person_Linkedin">
<input type="text" data-table="person" data-field="x_Linkedin" data-page="4" name="x_Linkedin" id="x_Linkedin" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($person->Linkedin->getPlaceHolder()) ?>" value="<?php echo $person->Linkedin->EditValue ?>"<?php echo $person->Linkedin->editAttributes() ?>>
</span>
<?php echo $person->Linkedin->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $person_edit->MultiPages->pageStyle("5") ?>" id="tab_person5"><!-- multi-page .tab-pane -->
<?php if ($person_edit->IsMobileOrModal) { ?>
<div class="ew-edit-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_personedit5" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($person->Username->Visible) { // Username ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_Username" class="form-group row">
		<label id="elh_person_Username" for="x_Username" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->Username->caption() ?><?php echo ($person->Username->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->Username->cellAttributes() ?>>
<span id="el_person_Username">
<input type="text" data-table="person" data-field="x_Username" data-page="5" name="x_Username" id="x_Username" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($person->Username->getPlaceHolder()) ?>" value="<?php echo $person->Username->EditValue ?>"<?php echo $person->Username->editAttributes() ?>>
</span>
<?php echo $person->Username->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Username">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_Username"><?php echo $person->Username->caption() ?><?php echo ($person->Username->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->Username->cellAttributes() ?>>
<span id="el_person_Username">
<input type="text" data-table="person" data-field="x_Username" data-page="5" name="x_Username" id="x_Username" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($person->Username->getPlaceHolder()) ?>" value="<?php echo $person->Username->EditValue ?>"<?php echo $person->Username->editAttributes() ?>>
</span>
<?php echo $person->Username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person->Password->Visible) { // Password ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_Password" class="form-group row">
		<label id="elh_person_Password" for="x_Password" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->Password->caption() ?><?php echo ($person->Password->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->Password->cellAttributes() ?>>
<span id="el_person_Password">
<input type="password" data-field="x_Password" name="x_Password" id="x_Password" value="<?php echo $person->Password->EditValue ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($person->Password->getPlaceHolder()) ?>"<?php echo $person->Password->editAttributes() ?>>
</span>
<?php echo $person->Password->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Password">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_Password"><?php echo $person->Password->caption() ?><?php echo ($person->Password->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->Password->cellAttributes() ?>>
<span id="el_person_Password">
<input type="password" data-field="x_Password" name="x_Password" id="x_Password" value="<?php echo $person->Password->EditValue ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($person->Password->getPlaceHolder()) ?>"<?php echo $person->Password->editAttributes() ?>>
</span>
<?php echo $person->Password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person->UserLevel->Visible) { // UserLevel ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_UserLevel" class="form-group row">
		<label id="elh_person_UserLevel" for="x_UserLevel" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->UserLevel->caption() ?><?php echo ($person->UserLevel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->UserLevel->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_person_UserLevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($person->UserLevel->EditValue) ?>">
</span>
<?php } else { ?>
<span id="el_person_UserLevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="person" data-field="x_UserLevel" data-page="5" data-value-separator="<?php echo $person->UserLevel->displayValueSeparatorAttribute() ?>" id="x_UserLevel" name="x_UserLevel"<?php echo $person->UserLevel->editAttributes() ?>>
		<?php echo $person->UserLevel->selectOptionListHtml("x_UserLevel") ?>
	</select>
</div>
<?php echo $person->UserLevel->Lookup->getParamTag("p_x_UserLevel") ?>
</span>
<?php } ?>
<?php echo $person->UserLevel->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_UserLevel">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_UserLevel"><?php echo $person->UserLevel->caption() ?><?php echo ($person->UserLevel->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->UserLevel->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_person_UserLevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($person->UserLevel->EditValue) ?>">
</span>
<?php } else { ?>
<span id="el_person_UserLevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="person" data-field="x_UserLevel" data-page="5" data-value-separator="<?php echo $person->UserLevel->displayValueSeparatorAttribute() ?>" id="x_UserLevel" name="x_UserLevel"<?php echo $person->UserLevel->editAttributes() ?>>
		<?php echo $person->UserLevel->selectOptionListHtml("x_UserLevel") ?>
	</select>
</div>
<?php echo $person->UserLevel->Lookup->getParamTag("p_x_UserLevel") ?>
</span>
<?php } ?>
<?php echo $person->UserLevel->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person->Profile->Visible) { // Profile ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
	<div id="r_Profile" class="form-group row">
		<label id="elh_person_Profile" for="x_Profile" class="<?php echo $person_edit->LeftColumnClass ?>"><?php echo $person->Profile->caption() ?><?php echo ($person->Profile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $person_edit->RightColumnClass ?>"><div<?php echo $person->Profile->cellAttributes() ?>>
<span id="el_person_Profile">
<textarea data-table="person" data-field="x_Profile" data-page="5" name="x_Profile" id="x_Profile" cols="35" rows="4" placeholder="<?php echo HtmlEncode($person->Profile->getPlaceHolder()) ?>"<?php echo $person->Profile->editAttributes() ?>><?php echo $person->Profile->EditValue ?></textarea>
</span>
<?php echo $person->Profile->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_Profile">
		<td class="<?php echo $person_edit->TableLeftColumnClass ?>"><span id="elh_person_Profile"><?php echo $person->Profile->caption() ?><?php echo ($person->Profile->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $person->Profile->cellAttributes() ?>>
<span id="el_person_Profile">
<textarea data-table="person" data-field="x_Profile" data-page="5" name="x_Profile" id="x_Profile" cols="35" rows="4" placeholder="<?php echo HtmlEncode($person->Profile->getPlaceHolder()) ?>"<?php echo $person->Profile->editAttributes() ?>><?php echo $person->Profile->EditValue ?></textarea>
</span>
<?php echo $person->Profile->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($person_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page tabs .tab-content -->
</div><!-- /multi-page tabs -->
</div><!-- /multi-page -->
<?php if (!$person_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $person_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $person_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$person_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$person_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$person_edit->terminate();
?>