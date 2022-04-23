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
$profiles_delete = new profiles_delete();

// Run the page
$profiles_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$profiles_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fprofilesdelete = currentForm = new ew.Form("fprofilesdelete", "delete");

// Form_CustomValidate event
fprofilesdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fprofilesdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $profiles_delete->showPageHeader(); ?>
<?php
$profiles_delete->showMessage();
?>
<form name="fprofilesdelete" id="fprofilesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($profiles_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $profiles_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="profiles">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($profiles_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($profiles->id->Visible) { // id ?>
		<th class="<?php echo $profiles->id->headerCellClass() ?>"><span id="elh_profiles_id" class="profiles_id"><?php echo $profiles->id->caption() ?></span></th>
<?php } ?>
<?php if ($profiles->title->Visible) { // title ?>
		<th class="<?php echo $profiles->title->headerCellClass() ?>"><span id="elh_profiles_title" class="profiles_title"><?php echo $profiles->title->caption() ?></span></th>
<?php } ?>
<?php if ($profiles->imagen->Visible) { // imagen ?>
		<th class="<?php echo $profiles->imagen->headerCellClass() ?>"><span id="elh_profiles_imagen" class="profiles_imagen"><?php echo $profiles->imagen->caption() ?></span></th>
<?php } ?>
<?php if ($profiles->website->Visible) { // website ?>
		<th class="<?php echo $profiles->website->headerCellClass() ?>"><span id="elh_profiles_website" class="profiles_website"><?php echo $profiles->website->caption() ?></span></th>
<?php } ?>
<?php if ($profiles->facebook->Visible) { // facebook ?>
		<th class="<?php echo $profiles->facebook->headerCellClass() ?>"><span id="elh_profiles_facebook" class="profiles_facebook"><?php echo $profiles->facebook->caption() ?></span></th>
<?php } ?>
<?php if ($profiles->linkedin->Visible) { // linkedin ?>
		<th class="<?php echo $profiles->linkedin->headerCellClass() ?>"><span id="elh_profiles_linkedin" class="profiles_linkedin"><?php echo $profiles->linkedin->caption() ?></span></th>
<?php } ?>
<?php if ($profiles->youtube->Visible) { // youtube ?>
		<th class="<?php echo $profiles->youtube->headerCellClass() ?>"><span id="elh_profiles_youtube" class="profiles_youtube"><?php echo $profiles->youtube->caption() ?></span></th>
<?php } ?>
<?php if ($profiles->instagram->Visible) { // instagram ?>
		<th class="<?php echo $profiles->instagram->headerCellClass() ?>"><span id="elh_profiles_instagram" class="profiles_instagram"><?php echo $profiles->instagram->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$profiles_delete->RecCnt = 0;
$i = 0;
while (!$profiles_delete->Recordset->EOF) {
	$profiles_delete->RecCnt++;
	$profiles_delete->RowCnt++;

	// Set row properties
	$profiles->resetAttributes();
	$profiles->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$profiles_delete->loadRowValues($profiles_delete->Recordset);

	// Render row
	$profiles_delete->renderRow();
?>
	<tr<?php echo $profiles->rowAttributes() ?>>
<?php if ($profiles->id->Visible) { // id ?>
		<td<?php echo $profiles->id->cellAttributes() ?>>
<span id="el<?php echo $profiles_delete->RowCnt ?>_profiles_id" class="profiles_id">
<span<?php echo $profiles->id->viewAttributes() ?>>
<?php echo $profiles->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($profiles->title->Visible) { // title ?>
		<td<?php echo $profiles->title->cellAttributes() ?>>
<span id="el<?php echo $profiles_delete->RowCnt ?>_profiles_title" class="profiles_title">
<span<?php echo $profiles->title->viewAttributes() ?>>
<?php echo $profiles->title->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($profiles->imagen->Visible) { // imagen ?>
		<td<?php echo $profiles->imagen->cellAttributes() ?>>
<span id="el<?php echo $profiles_delete->RowCnt ?>_profiles_imagen" class="profiles_imagen">
<span<?php echo $profiles->imagen->viewAttributes() ?>>
<?php echo $profiles->imagen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($profiles->website->Visible) { // website ?>
		<td<?php echo $profiles->website->cellAttributes() ?>>
<span id="el<?php echo $profiles_delete->RowCnt ?>_profiles_website" class="profiles_website">
<span<?php echo $profiles->website->viewAttributes() ?>>
<?php echo $profiles->website->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($profiles->facebook->Visible) { // facebook ?>
		<td<?php echo $profiles->facebook->cellAttributes() ?>>
<span id="el<?php echo $profiles_delete->RowCnt ?>_profiles_facebook" class="profiles_facebook">
<span<?php echo $profiles->facebook->viewAttributes() ?>>
<?php echo $profiles->facebook->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($profiles->linkedin->Visible) { // linkedin ?>
		<td<?php echo $profiles->linkedin->cellAttributes() ?>>
<span id="el<?php echo $profiles_delete->RowCnt ?>_profiles_linkedin" class="profiles_linkedin">
<span<?php echo $profiles->linkedin->viewAttributes() ?>>
<?php echo $profiles->linkedin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($profiles->youtube->Visible) { // youtube ?>
		<td<?php echo $profiles->youtube->cellAttributes() ?>>
<span id="el<?php echo $profiles_delete->RowCnt ?>_profiles_youtube" class="profiles_youtube">
<span<?php echo $profiles->youtube->viewAttributes() ?>>
<?php echo $profiles->youtube->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($profiles->instagram->Visible) { // instagram ?>
		<td<?php echo $profiles->instagram->cellAttributes() ?>>
<span id="el<?php echo $profiles_delete->RowCnt ?>_profiles_instagram" class="profiles_instagram">
<span<?php echo $profiles->instagram->viewAttributes() ?>>
<?php echo $profiles->instagram->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$profiles_delete->Recordset->moveNext();
}
$profiles_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $profiles_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$profiles_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$profiles_delete->terminate();
?>