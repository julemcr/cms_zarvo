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
$person_view = new person_view();

// Run the page
$person_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$person_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$person->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fpersonview = currentForm = new ew.Form("fpersonview", "view");

// Form_CustomValidate event
fpersonview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpersonview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Multi-Page
fpersonview.multiPage = new ew.MultiPage("fpersonview");

// Dynamic selection lists
fpersonview.lists["x_Sexo"] = <?php echo $person_view->Sexo->Lookup->toClientList() ?>;
fpersonview.lists["x_Sexo"].options = <?php echo JsonEncode($person_view->Sexo->lookupOptions()) ?>;
fpersonview.lists["x_Country"] = <?php echo $person_view->Country->Lookup->toClientList() ?>;
fpersonview.lists["x_Country"].options = <?php echo JsonEncode($person_view->Country->lookupOptions()) ?>;
fpersonview.lists["x_UserLevel"] = <?php echo $person_view->UserLevel->Lookup->toClientList() ?>;
fpersonview.lists["x_UserLevel"].options = <?php echo JsonEncode($person_view->UserLevel->lookupOptions()) ?>;
fpersonview.lists["x_Activated[]"] = <?php echo $person_view->Activated->Lookup->toClientList() ?>;
fpersonview.lists["x_Activated[]"].options = <?php echo JsonEncode($person_view->Activated->options(FALSE, TRUE)) ?>;

// Form object for search
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$person->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $person_view->ExportOptions->render("body") ?>
<?php $person_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $person_view->showPageHeader(); ?>
<?php
$person_view->showMessage();
?>
<?php if (!$person_view->IsModal) { ?>
<?php if (!$person->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($person_view->Pager)) $person_view->Pager = new PrevNextPager($person_view->StartRec, $person_view->DisplayRecs, $person_view->TotalRecs, $person_view->AutoHidePager) ?>
<?php if ($person_view->Pager->RecordCount > 0 && $person_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($person_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $person_view->pageUrl() ?>start=<?php echo $person_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($person_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $person_view->pageUrl() ?>start=<?php echo $person_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $person_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($person_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $person_view->pageUrl() ?>start=<?php echo $person_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($person_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $person_view->pageUrl() ?>start=<?php echo $person_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $person_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fpersonview" id="fpersonview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($person_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $person_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="person">
<input type="hidden" name="modal" value="<?php echo (int)$person_view->IsModal ?>">
<?php if ($person_view->MultiPages->Items[0]->Visible) { ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($person->PersonID->Visible) { // PersonID ?>
	<tr id="r_PersonID">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_PersonID"><?php echo $person->PersonID->caption() ?></span></td>
		<td data-name="PersonID"<?php echo $person->PersonID->cellAttributes() ?>>
<span id="el_person_PersonID" data-page="0">
<span<?php echo $person->PersonID->viewAttributes() ?>>
<?php echo $person->PersonID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($person->Activated->Visible) { // Activated ?>
	<tr id="r_Activated">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_Activated"><?php echo $person->Activated->caption() ?></span></td>
		<td data-name="Activated"<?php echo $person->Activated->cellAttributes() ?>>
<span id="el_person_Activated" data-page="0">
<span<?php echo $person->Activated->viewAttributes() ?>>
<?php if (ConvertToBool($person->Activated->CurrentValue)) { ?>
<input type="checkbox" value="<?php echo $person->Activated->getViewValue() ?>" disabled checked>
<?php } else { ?>
<input type="checkbox" value="<?php echo $person->Activated->getViewValue() ?>" disabled>
<?php } ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php } ?>
<?php if (!$person->isExport()) { ?>
<div class="ew-multi-page">
<div class="ew-nav-tabs" id="person_view"><!-- multi-page tabs -->
	<ul class="<?php echo $person_view->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $person_view->MultiPages->pageStyle("1") ?>" href="#tab_person1" data-toggle="tab"><?php echo $person->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $person_view->MultiPages->pageStyle("2") ?>" href="#tab_person2" data-toggle="tab"><?php echo $person->pageCaption(2) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $person_view->MultiPages->pageStyle("3") ?>" href="#tab_person3" data-toggle="tab"><?php echo $person->pageCaption(3) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $person_view->MultiPages->pageStyle("4") ?>" href="#tab_person4" data-toggle="tab"><?php echo $person->pageCaption(4) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $person_view->MultiPages->pageStyle("5") ?>" href="#tab_person5" data-toggle="tab"><?php echo $person->pageCaption(5) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if (!$person->isExport()) { ?>
		<div class="tab-pane<?php echo $person_view->MultiPages->pageStyle("1") ?>" id="tab_person1"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($person->Sexo->Visible) { // Sexo ?>
	<tr id="r_Sexo">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_Sexo"><?php echo $person->Sexo->caption() ?></span></td>
		<td data-name="Sexo"<?php echo $person->Sexo->cellAttributes() ?>>
<span id="el_person_Sexo" data-page="1">
<span<?php echo $person->Sexo->viewAttributes() ?>>
<?php echo $person->Sexo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($person->Name->Visible) { // Name ?>
	<tr id="r_Name">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_Name"><?php echo $person->Name->caption() ?></span></td>
		<td data-name="Name"<?php echo $person->Name->cellAttributes() ?>>
<span id="el_person_Name" data-page="1">
<span<?php echo $person->Name->viewAttributes() ?>>
<?php echo $person->Name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($person->LastName->Visible) { // LastName ?>
	<tr id="r_LastName">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_LastName"><?php echo $person->LastName->caption() ?></span></td>
		<td data-name="LastName"<?php echo $person->LastName->cellAttributes() ?>>
<span id="el_person_LastName" data-page="1">
<span<?php echo $person->LastName->viewAttributes() ?>>
<?php echo $person->LastName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($person->BirthDate->Visible) { // BirthDate ?>
	<tr id="r_BirthDate">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_BirthDate"><?php echo $person->BirthDate->caption() ?></span></td>
		<td data-name="BirthDate"<?php echo $person->BirthDate->cellAttributes() ?>>
<span id="el_person_BirthDate" data-page="1">
<span<?php echo $person->BirthDate->viewAttributes() ?>>
<?php echo $person->BirthDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($person->Country->Visible) { // Country ?>
	<tr id="r_Country">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_Country"><?php echo $person->Country->caption() ?></span></td>
		<td data-name="Country"<?php echo $person->Country->cellAttributes() ?>>
<span id="el_person_Country" data-page="1">
<span<?php echo $person->Country->viewAttributes() ?>>
<?php echo $person->Country->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($person->City->Visible) { // City ?>
	<tr id="r_City">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_City"><?php echo $person->City->caption() ?></span></td>
		<td data-name="City"<?php echo $person->City->cellAttributes() ?>>
<span id="el_person_City" data-page="1">
<span<?php echo $person->City->viewAttributes() ?>>
<?php echo $person->City->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($person->Address->Visible) { // Address ?>
	<tr id="r_Address">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_Address"><?php echo $person->Address->caption() ?></span></td>
		<td data-name="Address"<?php echo $person->Address->cellAttributes() ?>>
<span id="el_person_Address" data-page="1">
<span<?php echo $person->Address->viewAttributes() ?>>
<?php echo $person->Address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($person->PostalCode->Visible) { // PostalCode ?>
	<tr id="r_PostalCode">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_PostalCode"><?php echo $person->PostalCode->caption() ?></span></td>
		<td data-name="PostalCode"<?php echo $person->PostalCode->cellAttributes() ?>>
<span id="el_person_PostalCode" data-page="1">
<span<?php echo $person->PostalCode->viewAttributes() ?>>
<?php echo $person->PostalCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($person->Phone->Visible) { // Phone ?>
	<tr id="r_Phone">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_Phone"><?php echo $person->Phone->caption() ?></span></td>
		<td data-name="Phone"<?php echo $person->Phone->cellAttributes() ?>>
<span id="el_person_Phone" data-page="1">
<span<?php echo $person->Phone->viewAttributes() ?>>
<?php echo $person->Phone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($person->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person__Email"><?php echo $person->_Email->caption() ?></span></td>
		<td data-name="_Email"<?php echo $person->_Email->cellAttributes() ?>>
<span id="el_person__Email" data-page="1">
<span<?php echo $person->_Email->viewAttributes() ?>>
<?php echo $person->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$person->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$person->isExport()) { ?>
		<div class="tab-pane<?php echo $person_view->MultiPages->pageStyle("2") ?>" id="tab_person2"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($person->Photo->Visible) { // Photo ?>
	<tr id="r_Photo">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_Photo"><?php echo $person->Photo->caption() ?></span></td>
		<td data-name="Photo"<?php echo $person->Photo->cellAttributes() ?>>
<span id="el_person_Photo" data-page="2">
<span>
<?php echo GetFileViewTag($person->Photo, $person->Photo->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$person->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$person->isExport()) { ?>
		<div class="tab-pane<?php echo $person_view->MultiPages->pageStyle("3") ?>" id="tab_person3"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($person->Notes->Visible) { // Notes ?>
	<tr id="r_Notes">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_Notes"><?php echo $person->Notes->caption() ?></span></td>
		<td data-name="Notes"<?php echo $person->Notes->cellAttributes() ?>>
<span id="el_person_Notes" data-page="3">
<span<?php echo $person->Notes->viewAttributes() ?>>
<?php echo $person->Notes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$person->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$person->isExport()) { ?>
		<div class="tab-pane<?php echo $person_view->MultiPages->pageStyle("4") ?>" id="tab_person4"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($person->Facebook->Visible) { // Facebook ?>
	<tr id="r_Facebook">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_Facebook"><?php echo $person->Facebook->caption() ?></span></td>
		<td data-name="Facebook"<?php echo $person->Facebook->cellAttributes() ?>>
<span id="el_person_Facebook" data-page="4">
<span<?php echo $person->Facebook->viewAttributes() ?>>
<?php echo $person->Facebook->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($person->Instagram->Visible) { // Instagram ?>
	<tr id="r_Instagram">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_Instagram"><?php echo $person->Instagram->caption() ?></span></td>
		<td data-name="Instagram"<?php echo $person->Instagram->cellAttributes() ?>>
<span id="el_person_Instagram" data-page="4">
<span<?php echo $person->Instagram->viewAttributes() ?>>
<?php echo $person->Instagram->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($person->Linkedin->Visible) { // Linkedin ?>
	<tr id="r_Linkedin">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_Linkedin"><?php echo $person->Linkedin->caption() ?></span></td>
		<td data-name="Linkedin"<?php echo $person->Linkedin->cellAttributes() ?>>
<span id="el_person_Linkedin" data-page="4">
<span<?php echo $person->Linkedin->viewAttributes() ?>>
<?php echo $person->Linkedin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$person->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$person->isExport()) { ?>
		<div class="tab-pane<?php echo $person_view->MultiPages->pageStyle("5") ?>" id="tab_person5"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($person->Username->Visible) { // Username ?>
	<tr id="r_Username">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_Username"><?php echo $person->Username->caption() ?></span></td>
		<td data-name="Username"<?php echo $person->Username->cellAttributes() ?>>
<span id="el_person_Username" data-page="5">
<span<?php echo $person->Username->viewAttributes() ?>>
<?php echo $person->Username->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($person->Password->Visible) { // Password ?>
	<tr id="r_Password">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_Password"><?php echo $person->Password->caption() ?></span></td>
		<td data-name="Password"<?php echo $person->Password->cellAttributes() ?>>
<span id="el_person_Password" data-page="5">
<span<?php echo $person->Password->viewAttributes() ?>>
<?php echo $person->Password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($person->UserLevel->Visible) { // UserLevel ?>
	<tr id="r_UserLevel">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_UserLevel"><?php echo $person->UserLevel->caption() ?></span></td>
		<td data-name="UserLevel"<?php echo $person->UserLevel->cellAttributes() ?>>
<span id="el_person_UserLevel" data-page="5">
<span<?php echo $person->UserLevel->viewAttributes() ?>>
<?php echo $person->UserLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($person->Profile->Visible) { // Profile ?>
	<tr id="r_Profile">
		<td class="<?php echo $person_view->TableLeftColumnClass ?>"><span id="elh_person_Profile"><?php echo $person->Profile->caption() ?></span></td>
		<td data-name="Profile"<?php echo $person->Profile->cellAttributes() ?>>
<span id="el_person_Profile" data-page="5">
<span<?php echo $person->Profile->viewAttributes() ?>>
<?php echo $person->Profile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$person->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$person->isExport()) { ?>
	</div>
</div>
</div>
<?php } ?>
<?php if (!$person_view->IsModal) { ?>
<?php if (!$person->isExport()) { ?>
<?php if (!isset($person_view->Pager)) $person_view->Pager = new PrevNextPager($person_view->StartRec, $person_view->DisplayRecs, $person_view->TotalRecs, $person_view->AutoHidePager) ?>
<?php if ($person_view->Pager->RecordCount > 0 && $person_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($person_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $person_view->pageUrl() ?>start=<?php echo $person_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($person_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $person_view->pageUrl() ?>start=<?php echo $person_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $person_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($person_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $person_view->pageUrl() ?>start=<?php echo $person_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($person_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $person_view->pageUrl() ?>start=<?php echo $person_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $person_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$person_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$person->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$person_view->terminate();
?>