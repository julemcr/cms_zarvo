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
$userlevels_add = new userlevels_add();

// Run the page
$userlevels_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$userlevels_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fuserlevelsadd = currentForm = new ew.Form("fuserlevelsadd", "add");

// Validate form
fuserlevelsadd.validate = function() {
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
		<?php if ($userlevels_add->userlevelid->Required) { ?>
			elm = this.getElements("x" + infix + "_userlevelid");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $userlevels->userlevelid->caption(), $userlevels->userlevelid->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_userlevelid");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($userlevels->userlevelid->errorMessage()) ?>");
		<?php if ($userlevels_add->userlevelname->Required) { ?>
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
fuserlevelsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fuserlevelsadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fuserlevelsadd.lists["x_userlevelname"] = <?php echo $userlevels_add->userlevelname->Lookup->toClientList() ?>;
fuserlevelsadd.lists["x_userlevelname"].options = <?php echo JsonEncode($userlevels_add->userlevelname->lookupOptions()) ?>;
fuserlevelsadd.autoSuggests["x_userlevelname"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $userlevels_add->showPageHeader(); ?>
<?php
$userlevels_add->showMessage();
?>
<form name="fuserlevelsadd" id="fuserlevelsadd" class="<?php echo $userlevels_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($userlevels_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $userlevels_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="userlevels">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$userlevels_add->IsModal ?>">
<?php if (!$userlevels_add->IsMobileOrModal) { ?>
<div class="ew-desktop"><!-- desktop -->
<?php } ?>
<?php if ($userlevels_add->IsMobileOrModal) { ?>
<div class="ew-add-div"><!-- page* -->
<?php } else { ?>
<table id="tbl_userlevelsadd" class="table table-striped table-sm ew-desktop-table"><!-- table* -->
<?php } ?>
<?php if ($userlevels->userlevelid->Visible) { // userlevelid ?>
<?php if ($userlevels_add->IsMobileOrModal) { ?>
	<div id="r_userlevelid" class="form-group row">
		<label id="elh_userlevels_userlevelid" for="x_userlevelid" class="<?php echo $userlevels_add->LeftColumnClass ?>"><?php echo $userlevels->userlevelid->caption() ?><?php echo ($userlevels->userlevelid->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $userlevels_add->RightColumnClass ?>"><div<?php echo $userlevels->userlevelid->cellAttributes() ?>>
<span id="el_userlevels_userlevelid">
<input type="text" data-table="userlevels" data-field="x_userlevelid" name="x_userlevelid" id="x_userlevelid" size="30" placeholder="<?php echo HtmlEncode($userlevels->userlevelid->getPlaceHolder()) ?>" value="<?php echo $userlevels->userlevelid->EditValue ?>"<?php echo $userlevels->userlevelid->editAttributes() ?>>
</span>
<?php echo $userlevels->userlevelid->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_userlevelid">
		<td class="<?php echo $userlevels_add->TableLeftColumnClass ?>"><span id="elh_userlevels_userlevelid"><?php echo $userlevels->userlevelid->caption() ?><?php echo ($userlevels->userlevelid->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
		<td<?php echo $userlevels->userlevelid->cellAttributes() ?>>
<span id="el_userlevels_userlevelid">
<input type="text" data-table="userlevels" data-field="x_userlevelid" name="x_userlevelid" id="x_userlevelid" size="30" placeholder="<?php echo HtmlEncode($userlevels->userlevelid->getPlaceHolder()) ?>" value="<?php echo $userlevels->userlevelid->EditValue ?>"<?php echo $userlevels->userlevelid->editAttributes() ?>>
</span>
<?php echo $userlevels->userlevelid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($userlevels->userlevelname->Visible) { // userlevelname ?>
<?php if ($userlevels_add->IsMobileOrModal) { ?>
	<div id="r_userlevelname" class="form-group row">
		<label id="elh_userlevels_userlevelname" class="<?php echo $userlevels_add->LeftColumnClass ?>"><?php echo $userlevels->userlevelname->caption() ?><?php echo ($userlevels->userlevelname->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $userlevels_add->RightColumnClass ?>"><div<?php echo $userlevels->userlevelname->cellAttributes() ?>>
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
fuserlevelsadd.createAutoSuggest({"id":"x_userlevelname","forceSelect":false});
</script>
<?php echo $userlevels->userlevelname->Lookup->getParamTag("p_x_userlevelname") ?>
</span>
<?php echo $userlevels->userlevelname->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_userlevelname">
		<td class="<?php echo $userlevels_add->TableLeftColumnClass ?>"><span id="elh_userlevels_userlevelname"><?php echo $userlevels->userlevelname->caption() ?><?php echo ($userlevels->userlevelname->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></span></td>
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
fuserlevelsadd.createAutoSuggest({"id":"x_userlevelname","forceSelect":false});
</script>
<?php echo $userlevels->userlevelname->Lookup->getParamTag("p_x_userlevelname") ?>
</span>
<?php echo $userlevels->userlevelname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
	<!-- row for permission values -->
<?php if ($userlevels_add->IsMobileOrModal) { ?>
	<div id="rp_permission" class="form-group row">
		<label id="elh_permission" class="<?php echo $userlevels_add->LeftColumnClass ?>"><?php echo HtmlTitle($Language->phrase("Permission")) ?></label>
		<div class="<?php echo $userlevels_add->RightColumnClass ?>">
			<div class="form-check form-check-inline">
				<input type="checkbox" class="form-check-input" name="x__AllowAdd" id="Add" value="<?php echo ALLOW_ADD ?>"><label class="form-check-label" for="Add"><?php echo $Language->Phrase("PermissionAddCopy") ?></label>
			</div>
			<div class="form-check form-check-inline">
				<input type="checkbox" class="form-check-input" name="x__AllowDelete" id="Delete" value="<?php echo ALLOW_DELETE ?>"><label class="form-check-label" for="Delete"><?php echo $Language->Phrase("PermissionDelete") ?></label>
			</div>
			<div class="form-check form-check-inline">
				<input type="checkbox" class="form-check-input" name="x__AllowEdit" id="Edit" value="<?php echo ALLOW_EDIT ?>"><label class="form-check-label" for="Edit"><?php echo $Language->Phrase("PermissionEdit") ?></label>
			</div>
			<?php if (defined(PROJECT_NAMESPACE . "USER_LEVEL_COMPAT")) { ?>
			<div class="form-check form-check-inline">
				<input type="checkbox" class="form-check-input" name="x__AllowList" id="List" value="<?php echo ALLOW_LIST ?>"><label class="form-check-label" for="List"><?php echo $Language->Phrase("PermissionListSearchView") ?></label>
			</div>
			<?php } else { ?>
			<div class="form-check form-check-inline">
				<input type="checkbox" class="form-check-input" name="x__AllowList" id="List" value="<?php echo ALLOW_LIST ?>"><label class="form-check-label" for="List"><?php echo $Language->Phrase("PermissionList") ?></label>
			</div>
			<div class="form-check form-check-inline">
				<input type="checkbox" class="form-check-input" name="x__AllowView" id="View" value="<?php echo ALLOW_VIEW ?>"><label class="form-check-label" for="View"><?php echo $Language->Phrase("PermissionView") ?></label>
			</div>
			<div class="form-check form-check-inline">
				<input type="checkbox" class="form-check-input" name="x__AllowSearch" id="Search" value="<?php echo ALLOW_SEARCH ?>"><label class="form-check-label" for="Search"><?php echo $Language->Phrase("PermissionSearch") ?></label>
			</div>
<?php } ?>
		</div>
	</div>
<?php } else { ?>
	<tr id="rp_permission">
		<td class="<?php echo $userlevels_add->TableLeftColumnClass ?>"><span id="elh_permission"><?php echo HtmlTitle($Language->phrase("Permission")) ?></span></td>
		<td>
		<div class="form-check form-check-inline">
			<input type="checkbox" class="form-check-input" name="x__AllowAdd" id="Add" value="<?php echo ALLOW_ADD ?>" /><label class="form-check-label" for="Add"><?php echo $Language->Phrase("PermissionAddCopy") ?></label>
			</div>
		<div class="form-check form-check-inline">
			<input type="checkbox" class="form-check-input" name="x__AllowDelete" id="Delete" value="<?php echo ALLOW_DELETE ?>" /><label class="form-check-label" for="Delete"><?php echo $Language->Phrase("PermissionDelete") ?></label>
		</div>
		<div class="form-check form-check-inline">
			<input type="checkbox" class="form-check-input" name="x__AllowEdit" id="Edit" value="<?php echo ALLOW_EDIT ?>" /><label class="form-check-label" for="Edit"><?php echo $Language->Phrase("PermissionEdit") ?></label>
		</div>
		<?php if (defined(PROJECT_NAMESPACE . "USER_LEVEL_COMPAT")) { ?>
		<div class="form-check form-check-inline">
			<input type="checkbox" class="form-check-input" name="x__AllowList" id="List" value="<?php echo ALLOW_LIST ?>" /><label class="form-check-label" for="List"><?php echo $Language->Phrase("PermissionListSearchView") ?></label>
		</div>
		<?php } else { ?>
		<div class="form-check form-check-inline">
			<input type="checkbox" class="form-check-input" name="x__AllowList" id="List" value="<?php echo ALLOW_LIST ?>" /><label class="form-check-label" for="List"><?php echo $Language->Phrase("PermissionList") ?></label>
		</div>
		<div class="form-check form-check-inline">
			<input type="checkbox" class="form-check-input" name="x__AllowView" id="View" value="<?php echo ALLOW_VIEW ?>" /><label class="form-check-label" for="View"><?php echo $Language->Phrase("PermissionView") ?></label>
		</div>
		<div class="form-check form-check-inline">
			<input type="checkbox" class="form-check-input" name="x__AllowSearch" id="Search" value="<?php echo ALLOW_SEARCH ?>" /><label class="form-check-label" for="Search"><?php echo $Language->Phrase("PermissionSearch") ?></label>
		</div>
<?php } ?>
		</td>
	</tr>
<?php } ?>
<?php if ($userlevels_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$userlevels_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $userlevels_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $userlevels_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$userlevels_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<?php
$userlevels_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$userlevels_add->terminate();
?>