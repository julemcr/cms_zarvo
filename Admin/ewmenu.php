<?php
namespace PHPMaker2019\cmsweb;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(17, "mci_AJUSTES", $MenuLanguage->MenuPhrase("17", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "fa fa-wrench", "", FALSE);
$sideMenu->addMenuItem(9, "mi_profiles", $MenuLanguage->MenuPhrase("9", "MenuText"), "profileslist.php", 17, "", AllowListMenu('{5ACD2586-5733-4EB1-9592-B819B3395C82}profiles'), FALSE, FALSE, "fa-file-text", "", FALSE);
$sideMenu->addMenuItem(12, "mi_slidercm", $MenuLanguage->MenuPhrase("12", "MenuText"), "slidercmlist.php", 17, "", AllowListMenu('{5ACD2586-5733-4EB1-9592-B819B3395C82}slidercm'), FALSE, FALSE, "fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(13, "mi_terms_conditions", $MenuLanguage->MenuPhrase("13", "MenuText"), "terms_conditionslist.php", 17, "", AllowListMenu('{5ACD2586-5733-4EB1-9592-B819B3395C82}terms_conditions'), FALSE, FALSE, "fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(5, "mi_page_service", $MenuLanguage->MenuPhrase("5", "MenuText"), "page_servicelist.php", 17, "", AllowListMenu('{5ACD2586-5733-4EB1-9592-B819B3395C82}page_service'), FALSE, FALSE, "fa-book", "", FALSE);
$sideMenu->addMenuItem(10, "mi_setting_cms", $MenuLanguage->MenuPhrase("10", "MenuText"), "setting_cmslist.php", 17, "", AllowListMenu('{5ACD2586-5733-4EB1-9592-B819B3395C82}setting_cms'), FALSE, FALSE, "fa-gears", "", FALSE);
$sideMenu->addMenuItem(16, "mi_setting_sistem", $MenuLanguage->MenuPhrase("16", "MenuText"), "setting_sistem.php", 17, "", AllowListMenu('{5ACD2586-5733-4EB1-9592-B819B3395C82}setting_sistem.php'), FALSE, FALSE, "fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(1, "mi_audittrail", $MenuLanguage->MenuPhrase("1", "MenuText"), "audittraillist.php", 17, "", AllowListMenu('{5ACD2586-5733-4EB1-9592-B819B3395C82}audittrail'), FALSE, FALSE, "fa-user-secret", "", FALSE);
$sideMenu->addMenuItem(20, "mci_PORTAFOLIO", $MenuLanguage->MenuPhrase("20", "MenuText"), "", 17, "", IsLoggedIn(), FALSE, TRUE, "fa fa-wpforms", "", FALSE);
$sideMenu->addMenuItem(8, "mi_portafolio_categoria", $MenuLanguage->MenuPhrase("8", "MenuText"), "portafolio_categorialist.php", 20, "", AllowListMenu('{5ACD2586-5733-4EB1-9592-B819B3395C82}portafolio_categoria'), FALSE, FALSE, "fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(19, "mci_USUARIO", $MenuLanguage->MenuPhrase("19", "MenuText"), "", 17, "", IsLoggedIn(), FALSE, TRUE, "fa fa-users", "", FALSE);
$sideMenu->addMenuItem(14, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("14", "MenuText"), "userlevelpermissionslist.php", 19, "", AllowListMenu('{5ACD2586-5733-4EB1-9592-B819B3395C82}userlevelpermissions'), FALSE, FALSE, "fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(15, "mi_userlevels", $MenuLanguage->MenuPhrase("15", "MenuText"), "userlevelslist.php", 19, "", AllowListMenu('{5ACD2586-5733-4EB1-9592-B819B3395C82}userlevels'), FALSE, FALSE, "fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(18, "mci_RRHH", $MenuLanguage->MenuPhrase("18", "MenuText"), "", 17, "", IsLoggedIn(), FALSE, TRUE, "fa fa-child", "", FALSE);
$sideMenu->addMenuItem(2, "mi_ciudades", $MenuLanguage->MenuPhrase("2", "MenuText"), "ciudadeslist.php", 18, "", AllowListMenu('{5ACD2586-5733-4EB1-9592-B819B3395C82}ciudades'), FALSE, FALSE, "fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(6, "mi_paises", $MenuLanguage->MenuPhrase("6", "MenuText"), "paiseslist.php", 18, "", AllowListMenu('{5ACD2586-5733-4EB1-9592-B819B3395C82}paises'), FALSE, FALSE, "fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(7, "mi_person", $MenuLanguage->MenuPhrase("7", "MenuText"), "personlist.php", 18, "", AllowListMenu('{5ACD2586-5733-4EB1-9592-B819B3395C82}person'), FALSE, FALSE, "fa-circle-o", "", FALSE);
$sideMenu->addMenuItem(11, "mi_sexo", $MenuLanguage->MenuPhrase("11", "MenuText"), "sexolist.php", 18, "", AllowListMenu('{5ACD2586-5733-4EB1-9592-B819B3395C82}sexo'), FALSE, FALSE, "fa-circle-o", "", FALSE);
echo $sideMenu->toScript();
?>