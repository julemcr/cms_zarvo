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
$profiles_view = new profiles_view();

// Run the page
$profiles_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$profiles_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$profiles->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fprofilesview = currentForm = new ew.Form("fprofilesview", "view");

// Form_CustomValidate event
fprofilesview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fprofilesview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Multi-Page
fprofilesview.multiPage = new ew.MultiPage("fprofilesview");

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$profiles->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $profiles_view->ExportOptions->render("body") ?>
<?php $profiles_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $profiles_view->showPageHeader(); ?>
<?php
$profiles_view->showMessage();
?>
<?php if (!$profiles_view->IsModal) { ?>
<?php if (!$profiles->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($profiles_view->Pager)) $profiles_view->Pager = new PrevNextPager($profiles_view->StartRec, $profiles_view->DisplayRecs, $profiles_view->TotalRecs, $profiles_view->AutoHidePager) ?>
<?php if ($profiles_view->Pager->RecordCount > 0 && $profiles_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($profiles_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $profiles_view->pageUrl() ?>start=<?php echo $profiles_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($profiles_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $profiles_view->pageUrl() ?>start=<?php echo $profiles_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $profiles_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($profiles_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $profiles_view->pageUrl() ?>start=<?php echo $profiles_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($profiles_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $profiles_view->pageUrl() ?>start=<?php echo $profiles_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $profiles_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fprofilesview" id="fprofilesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($profiles_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $profiles_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="profiles">
<input type="hidden" name="modal" value="<?php echo (int)$profiles_view->IsModal ?>">
<?php if (!$profiles->isExport()) { ?>
<div class="ew-multi-page">
<div class="ew-nav-tabs" id="profiles_view"><!-- multi-page tabs -->
	<ul class="<?php echo $profiles_view->MultiPages->navStyle() ?>">
		<li class="nav-item"><a class="nav-link<?php echo $profiles_view->MultiPages->pageStyle("1") ?>" href="#tab_profiles1" data-toggle="tab"><?php echo $profiles->pageCaption(1) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $profiles_view->MultiPages->pageStyle("2") ?>" href="#tab_profiles2" data-toggle="tab"><?php echo $profiles->pageCaption(2) ?></a></li>
		<li class="nav-item"><a class="nav-link<?php echo $profiles_view->MultiPages->pageStyle("3") ?>" href="#tab_profiles3" data-toggle="tab"><?php echo $profiles->pageCaption(3) ?></a></li>
	</ul>
	<div class="tab-content">
<?php } ?>
<?php if (!$profiles->isExport()) { ?>
		<div class="tab-pane<?php echo $profiles_view->MultiPages->pageStyle("1") ?>" id="tab_profiles1"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($profiles->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $profiles_view->TableLeftColumnClass ?>"><span id="elh_profiles_id"><?php echo $profiles->id->caption() ?></span></td>
		<td data-name="id"<?php echo $profiles->id->cellAttributes() ?>>
<span id="el_profiles_id" data-page="1">
<span<?php echo $profiles->id->viewAttributes() ?>>
<?php echo $profiles->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($profiles->title->Visible) { // title ?>
	<tr id="r_title">
		<td class="<?php echo $profiles_view->TableLeftColumnClass ?>"><span id="elh_profiles_title"><?php echo $profiles->title->caption() ?></span></td>
		<td data-name="title"<?php echo $profiles->title->cellAttributes() ?>>
<span id="el_profiles_title" data-page="1">
<span<?php echo $profiles->title->viewAttributes() ?>>
<?php echo $profiles->title->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($profiles->biography->Visible) { // biography ?>
	<tr id="r_biography">
		<td class="<?php echo $profiles_view->TableLeftColumnClass ?>"><span id="elh_profiles_biography"><?php echo $profiles->biography->caption() ?></span></td>
		<td data-name="biography"<?php echo $profiles->biography->cellAttributes() ?>>
<span id="el_profiles_biography" data-page="1">
<span<?php echo $profiles->biography->viewAttributes() ?>>
<?php echo $profiles->biography->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($profiles->imagen->Visible) { // imagen ?>
	<tr id="r_imagen">
		<td class="<?php echo $profiles_view->TableLeftColumnClass ?>"><span id="elh_profiles_imagen"><?php echo $profiles->imagen->caption() ?></span></td>
		<td data-name="imagen"<?php echo $profiles->imagen->cellAttributes() ?>>
<span id="el_profiles_imagen" data-page="1">
<span>
<?php echo GetFileViewTag($profiles->imagen, $profiles->imagen->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($profiles->user_id->Visible) { // user_id ?>
	<tr id="r_user_id">
		<td class="<?php echo $profiles_view->TableLeftColumnClass ?>"><span id="elh_profiles_user_id"><?php echo $profiles->user_id->caption() ?></span></td>
		<td data-name="user_id"<?php echo $profiles->user_id->cellAttributes() ?>>
<span id="el_profiles_user_id" data-page="1">
<span<?php echo $profiles->user_id->viewAttributes() ?>>
<?php echo $profiles->user_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($profiles->created_at->Visible) { // created_at ?>
	<tr id="r_created_at">
		<td class="<?php echo $profiles_view->TableLeftColumnClass ?>"><span id="elh_profiles_created_at"><?php echo $profiles->created_at->caption() ?></span></td>
		<td data-name="created_at"<?php echo $profiles->created_at->cellAttributes() ?>>
<span id="el_profiles_created_at" data-page="1">
<span<?php echo $profiles->created_at->viewAttributes() ?>>
<?php echo $profiles->created_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($profiles->updated_at->Visible) { // updated_at ?>
	<tr id="r_updated_at">
		<td class="<?php echo $profiles_view->TableLeftColumnClass ?>"><span id="elh_profiles_updated_at"><?php echo $profiles->updated_at->caption() ?></span></td>
		<td data-name="updated_at"<?php echo $profiles->updated_at->cellAttributes() ?>>
<span id="el_profiles_updated_at" data-page="1">
<span<?php echo $profiles->updated_at->viewAttributes() ?>>
<?php echo $profiles->updated_at->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$profiles->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$profiles->isExport()) { ?>
		<div class="tab-pane<?php echo $profiles_view->MultiPages->pageStyle("2") ?>" id="tab_profiles2"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($profiles->website->Visible) { // website ?>
	<tr id="r_website">
		<td class="<?php echo $profiles_view->TableLeftColumnClass ?>"><span id="elh_profiles_website"><?php echo $profiles->website->caption() ?></span></td>
		<td data-name="website"<?php echo $profiles->website->cellAttributes() ?>>
<span id="el_profiles_website" data-page="2">
<span<?php echo $profiles->website->viewAttributes() ?>>
<?php echo $profiles->website->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($profiles->facebook->Visible) { // facebook ?>
	<tr id="r_facebook">
		<td class="<?php echo $profiles_view->TableLeftColumnClass ?>"><span id="elh_profiles_facebook"><?php echo $profiles->facebook->caption() ?></span></td>
		<td data-name="facebook"<?php echo $profiles->facebook->cellAttributes() ?>>
<span id="el_profiles_facebook" data-page="2">
<span<?php echo $profiles->facebook->viewAttributes() ?>>
<?php echo $profiles->facebook->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($profiles->linkedin->Visible) { // linkedin ?>
	<tr id="r_linkedin">
		<td class="<?php echo $profiles_view->TableLeftColumnClass ?>"><span id="elh_profiles_linkedin"><?php echo $profiles->linkedin->caption() ?></span></td>
		<td data-name="linkedin"<?php echo $profiles->linkedin->cellAttributes() ?>>
<span id="el_profiles_linkedin" data-page="2">
<span<?php echo $profiles->linkedin->viewAttributes() ?>>
<?php echo $profiles->linkedin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($profiles->youtube->Visible) { // youtube ?>
	<tr id="r_youtube">
		<td class="<?php echo $profiles_view->TableLeftColumnClass ?>"><span id="elh_profiles_youtube"><?php echo $profiles->youtube->caption() ?></span></td>
		<td data-name="youtube"<?php echo $profiles->youtube->cellAttributes() ?>>
<span id="el_profiles_youtube" data-page="2">
<span<?php echo $profiles->youtube->viewAttributes() ?>>
<?php echo $profiles->youtube->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($profiles->instagram->Visible) { // instagram ?>
	<tr id="r_instagram">
		<td class="<?php echo $profiles_view->TableLeftColumnClass ?>"><span id="elh_profiles_instagram"><?php echo $profiles->instagram->caption() ?></span></td>
		<td data-name="instagram"<?php echo $profiles->instagram->cellAttributes() ?>>
<span id="el_profiles_instagram" data-page="2">
<span<?php echo $profiles->instagram->viewAttributes() ?>>
<?php echo $profiles->instagram->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$profiles->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$profiles->isExport()) { ?>
		<div class="tab-pane<?php echo $profiles_view->MultiPages->pageStyle("3") ?>" id="tab_profiles3"><!-- multi-page .tab-pane -->
<?php } ?>
<table class="table table-striped table-sm ew-view-table">
<?php if ($profiles->maps_iframe->Visible) { // maps_iframe ?>
	<tr id="r_maps_iframe">
		<td class="<?php echo $profiles_view->TableLeftColumnClass ?>"><span id="elh_profiles_maps_iframe"><?php echo $profiles->maps_iframe->caption() ?></span></td>
		<td data-name="maps_iframe"<?php echo $profiles->maps_iframe->cellAttributes() ?>>
<span id="el_profiles_maps_iframe" data-page="3">
<span<?php echo $profiles->maps_iframe->viewAttributes() ?>>
<?php echo $profiles->maps_iframe->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$profiles->isExport()) { ?>
		</div>
<?php } ?>
<?php if (!$profiles->isExport()) { ?>
	</div>
</div>
</div>
<?php } ?>
<?php if (!$profiles_view->IsModal) { ?>
<?php if (!$profiles->isExport()) { ?>
<?php if (!isset($profiles_view->Pager)) $profiles_view->Pager = new PrevNextPager($profiles_view->StartRec, $profiles_view->DisplayRecs, $profiles_view->TotalRecs, $profiles_view->AutoHidePager) ?>
<?php if ($profiles_view->Pager->RecordCount > 0 && $profiles_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($profiles_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $profiles_view->pageUrl() ?>start=<?php echo $profiles_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($profiles_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $profiles_view->pageUrl() ?>start=<?php echo $profiles_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $profiles_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($profiles_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $profiles_view->pageUrl() ?>start=<?php echo $profiles_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($profiles_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $profiles_view->pageUrl() ?>start=<?php echo $profiles_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $profiles_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$profiles_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$profiles->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$profiles_view->terminate();
?>