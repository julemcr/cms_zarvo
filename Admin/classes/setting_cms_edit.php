<?php
namespace PHPMaker2019\cmsweb;

/**
 * Page class
 */
class setting_cms_edit extends setting_cms
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{5ACD2586-5733-4EB1-9592-B819B3395C82}";

	// Table name
	public $TableName = 'setting_cms';

	// Page object name
	public $PageObjName = "setting_cms_edit";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Page URL
	private $_pageUrl = "";

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		if ($this->_pageUrl == "") {
			$this->_pageUrl = CurrentPageName() . "?";
			if ($this->UseTokenInUrl)
				$this->_pageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		}
		return $this->_pageUrl;
	}

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = array();

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message <> "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage <> "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage <> "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage <> "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = PROJECT_NAMESPACE . CREATE_TOKEN_FUNC; // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $COMPOSITE_KEY_SEPARATOR;
		global $UserTable, $UserTableConn;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (setting_cms)
		if (!isset($GLOBALS["setting_cms"]) || get_class($GLOBALS["setting_cms"]) == PROJECT_NAMESPACE . "setting_cms") {
			$GLOBALS["setting_cms"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["setting_cms"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Table object (person)
		if (!isset($GLOBALS['person']))
			$GLOBALS['person'] = new person();

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'setting_cms');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &$this->getConnection();

		// User table object (person)
		if (!isset($UserTable)) {
			$UserTable = new person();
			$UserTableConn = Conn($UserTable->Dbid);
		}
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT, $setting_cms;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($setting_cms);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "setting_cmsview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = array();
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = array();
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {

								//$url = FullUrl($fld->TableVar . "/" . API_FILE_ACTION . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))); // URL rewrite format
								$url = FullUrl(GetPageName(API_URL) . "?" . API_OBJECT_NAME . "=" . $fld->TableVar . "&" . API_ACTION_NAME . "=" . API_FILE_ACTION . "&" . API_FIELD_NAME . "=" . $fld->Param . "&" . API_KEY_NAME . "=" . rawurlencode($this->getRecordKeyValue($ar))); // Query string format
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, MULTIPLE_UPLOAD_SEPARATOR)) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['SettingcmsID'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->SettingcmsID->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $MultiPages; // Multi pages object

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		$Security = new AdvancedSecurity();
		$validRequest = FALSE;

		// Check security for API request
		If (IsApi()) {

			// Check token first
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Post(TOKEN_NAME) !== NULL)
				$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			elseif (is_array($RequestSecurity) && @$RequestSecurity["username"] <> "") // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
		}
		if (!$validRequest) {
			if (IsPasswordExpired())
				$this->terminate(GetUrl("changepwd.php"));
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("setting_cmslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Update last accessed time
		if ($UserProfile->isValidUser(CurrentUserName(), session_id())) {
		} else {
			Write($Language->phrase("UserProfileCorrupted"));
			$this->terminate();
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->SettingcmsID->setVisibility();
		$this->seccion_slider->setVisibility();
		$this->seccion_about->setVisibility();
		$this->seccion_service->setVisibility();
		$this->seccion_publicitaria->setVisibility();
		$this->banner_publicitario_titulo->setVisibility();
		$this->banner_publicitario_detalle->setVisibility();
		$this->banner_publicitario_btnNombre->setVisibility();
		$this->banner_publicitario_url->setVisibility();
		$this->seccion_portfolio->setVisibility();
		$this->seccion_app->setVisibility();
		$this->link_app_android->setVisibility();
		$this->link_app_iphone->setVisibility();
		$this->cookies_ley->setVisibility();
		$this->cookies_questions->setVisibility();
		$this->cookies_detalle->setVisibility();
		$this->seccion_contact->setVisibility();
		$this->seccion_menufooter->setVisibility();
		$this->updated_at->setVisibility();
		$this->usuario_id->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Set up multi page object
		$this->setupMultiPages();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get action code
			if (!$this->isShow()) // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($CurrentForm->hasValue("x_SettingcmsID")) {
				$this->SettingcmsID->setFormValue($CurrentForm->getValue("x_SettingcmsID"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("SettingcmsID") !== NULL) {
				$this->SettingcmsID->setQueryStringValue(Get("SettingcmsID"));
				$loadByQuery = TRUE;
			} else {
				$this->SettingcmsID->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->loadRow();

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("setting_cmslist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "setting_cmslist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Set up starting record parameters
	public function setupStartRec()
	{
		if ($this->DisplayRecs == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			if (Get(TABLE_START_REC) !== NULL) { // Check for "start" parameter
				$this->StartRec = Get(TABLE_START_REC);
				$this->setStartRecordNumber($this->StartRec);
			} elseif (Get(TABLE_PAGE_NO) !== NULL) {
				$pageNo = Get(TABLE_PAGE_NO);
				if (is_numeric($pageNo)) {
					$this->StartRec = ($pageNo - 1) * $this->DisplayRecs + 1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1) {
						$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->StartRec > $this->TotalRecs) { // Avoid starting record > total records
			$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
			$this->StartRec = (int)(($this->StartRec - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'SettingcmsID' first before field var 'x_SettingcmsID'
		$val = $CurrentForm->hasValue("SettingcmsID") ? $CurrentForm->getValue("SettingcmsID") : $CurrentForm->getValue("x_SettingcmsID");
		if (!$this->SettingcmsID->IsDetailKey)
			$this->SettingcmsID->setFormValue($val);

		// Check field name 'seccion_slider' first before field var 'x_seccion_slider'
		$val = $CurrentForm->hasValue("seccion_slider") ? $CurrentForm->getValue("seccion_slider") : $CurrentForm->getValue("x_seccion_slider");
		if (!$this->seccion_slider->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->seccion_slider->Visible = FALSE; // Disable update for API request
			else
				$this->seccion_slider->setFormValue($val);
		}

		// Check field name 'seccion_about' first before field var 'x_seccion_about'
		$val = $CurrentForm->hasValue("seccion_about") ? $CurrentForm->getValue("seccion_about") : $CurrentForm->getValue("x_seccion_about");
		if (!$this->seccion_about->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->seccion_about->Visible = FALSE; // Disable update for API request
			else
				$this->seccion_about->setFormValue($val);
		}

		// Check field name 'seccion_service' first before field var 'x_seccion_service'
		$val = $CurrentForm->hasValue("seccion_service") ? $CurrentForm->getValue("seccion_service") : $CurrentForm->getValue("x_seccion_service");
		if (!$this->seccion_service->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->seccion_service->Visible = FALSE; // Disable update for API request
			else
				$this->seccion_service->setFormValue($val);
		}

		// Check field name 'seccion_publicitaria' first before field var 'x_seccion_publicitaria'
		$val = $CurrentForm->hasValue("seccion_publicitaria") ? $CurrentForm->getValue("seccion_publicitaria") : $CurrentForm->getValue("x_seccion_publicitaria");
		if (!$this->seccion_publicitaria->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->seccion_publicitaria->Visible = FALSE; // Disable update for API request
			else
				$this->seccion_publicitaria->setFormValue($val);
		}

		// Check field name 'banner_publicitario_titulo' first before field var 'x_banner_publicitario_titulo'
		$val = $CurrentForm->hasValue("banner_publicitario_titulo") ? $CurrentForm->getValue("banner_publicitario_titulo") : $CurrentForm->getValue("x_banner_publicitario_titulo");
		if (!$this->banner_publicitario_titulo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->banner_publicitario_titulo->Visible = FALSE; // Disable update for API request
			else
				$this->banner_publicitario_titulo->setFormValue($val);
		}

		// Check field name 'banner_publicitario_detalle' first before field var 'x_banner_publicitario_detalle'
		$val = $CurrentForm->hasValue("banner_publicitario_detalle") ? $CurrentForm->getValue("banner_publicitario_detalle") : $CurrentForm->getValue("x_banner_publicitario_detalle");
		if (!$this->banner_publicitario_detalle->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->banner_publicitario_detalle->Visible = FALSE; // Disable update for API request
			else
				$this->banner_publicitario_detalle->setFormValue($val);
		}

		// Check field name 'banner_publicitario_btnNombre' first before field var 'x_banner_publicitario_btnNombre'
		$val = $CurrentForm->hasValue("banner_publicitario_btnNombre") ? $CurrentForm->getValue("banner_publicitario_btnNombre") : $CurrentForm->getValue("x_banner_publicitario_btnNombre");
		if (!$this->banner_publicitario_btnNombre->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->banner_publicitario_btnNombre->Visible = FALSE; // Disable update for API request
			else
				$this->banner_publicitario_btnNombre->setFormValue($val);
		}

		// Check field name 'banner_publicitario_url' first before field var 'x_banner_publicitario_url'
		$val = $CurrentForm->hasValue("banner_publicitario_url") ? $CurrentForm->getValue("banner_publicitario_url") : $CurrentForm->getValue("x_banner_publicitario_url");
		if (!$this->banner_publicitario_url->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->banner_publicitario_url->Visible = FALSE; // Disable update for API request
			else
				$this->banner_publicitario_url->setFormValue($val);
		}

		// Check field name 'seccion_portfolio' first before field var 'x_seccion_portfolio'
		$val = $CurrentForm->hasValue("seccion_portfolio") ? $CurrentForm->getValue("seccion_portfolio") : $CurrentForm->getValue("x_seccion_portfolio");
		if (!$this->seccion_portfolio->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->seccion_portfolio->Visible = FALSE; // Disable update for API request
			else
				$this->seccion_portfolio->setFormValue($val);
		}

		// Check field name 'seccion_app' first before field var 'x_seccion_app'
		$val = $CurrentForm->hasValue("seccion_app") ? $CurrentForm->getValue("seccion_app") : $CurrentForm->getValue("x_seccion_app");
		if (!$this->seccion_app->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->seccion_app->Visible = FALSE; // Disable update for API request
			else
				$this->seccion_app->setFormValue($val);
		}

		// Check field name 'link_app_android' first before field var 'x_link_app_android'
		$val = $CurrentForm->hasValue("link_app_android") ? $CurrentForm->getValue("link_app_android") : $CurrentForm->getValue("x_link_app_android");
		if (!$this->link_app_android->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->link_app_android->Visible = FALSE; // Disable update for API request
			else
				$this->link_app_android->setFormValue($val);
		}

		// Check field name 'link_app_iphone' first before field var 'x_link_app_iphone'
		$val = $CurrentForm->hasValue("link_app_iphone") ? $CurrentForm->getValue("link_app_iphone") : $CurrentForm->getValue("x_link_app_iphone");
		if (!$this->link_app_iphone->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->link_app_iphone->Visible = FALSE; // Disable update for API request
			else
				$this->link_app_iphone->setFormValue($val);
		}

		// Check field name 'cookies_ley' first before field var 'x_cookies_ley'
		$val = $CurrentForm->hasValue("cookies_ley") ? $CurrentForm->getValue("cookies_ley") : $CurrentForm->getValue("x_cookies_ley");
		if (!$this->cookies_ley->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cookies_ley->Visible = FALSE; // Disable update for API request
			else
				$this->cookies_ley->setFormValue($val);
		}

		// Check field name 'cookies_questions' first before field var 'x_cookies_questions'
		$val = $CurrentForm->hasValue("cookies_questions") ? $CurrentForm->getValue("cookies_questions") : $CurrentForm->getValue("x_cookies_questions");
		if (!$this->cookies_questions->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cookies_questions->Visible = FALSE; // Disable update for API request
			else
				$this->cookies_questions->setFormValue($val);
		}

		// Check field name 'cookies_detalle' first before field var 'x_cookies_detalle'
		$val = $CurrentForm->hasValue("cookies_detalle") ? $CurrentForm->getValue("cookies_detalle") : $CurrentForm->getValue("x_cookies_detalle");
		if (!$this->cookies_detalle->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cookies_detalle->Visible = FALSE; // Disable update for API request
			else
				$this->cookies_detalle->setFormValue($val);
		}

		// Check field name 'seccion_contact' first before field var 'x_seccion_contact'
		$val = $CurrentForm->hasValue("seccion_contact") ? $CurrentForm->getValue("seccion_contact") : $CurrentForm->getValue("x_seccion_contact");
		if (!$this->seccion_contact->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->seccion_contact->Visible = FALSE; // Disable update for API request
			else
				$this->seccion_contact->setFormValue($val);
		}

		// Check field name 'seccion_menufooter' first before field var 'x_seccion_menufooter'
		$val = $CurrentForm->hasValue("seccion_menufooter") ? $CurrentForm->getValue("seccion_menufooter") : $CurrentForm->getValue("x_seccion_menufooter");
		if (!$this->seccion_menufooter->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->seccion_menufooter->Visible = FALSE; // Disable update for API request
			else
				$this->seccion_menufooter->setFormValue($val);
		}

		// Check field name 'updated_at' first before field var 'x_updated_at'
		$val = $CurrentForm->hasValue("updated_at") ? $CurrentForm->getValue("updated_at") : $CurrentForm->getValue("x_updated_at");
		if (!$this->updated_at->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->updated_at->Visible = FALSE; // Disable update for API request
			else
				$this->updated_at->setFormValue($val);
			$this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, 0);
		}

		// Check field name 'usuario_id' first before field var 'x_usuario_id'
		$val = $CurrentForm->hasValue("usuario_id") ? $CurrentForm->getValue("usuario_id") : $CurrentForm->getValue("x_usuario_id");
		if (!$this->usuario_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->usuario_id->Visible = FALSE; // Disable update for API request
			else
				$this->usuario_id->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->SettingcmsID->CurrentValue = $this->SettingcmsID->FormValue;
		$this->seccion_slider->CurrentValue = $this->seccion_slider->FormValue;
		$this->seccion_about->CurrentValue = $this->seccion_about->FormValue;
		$this->seccion_service->CurrentValue = $this->seccion_service->FormValue;
		$this->seccion_publicitaria->CurrentValue = $this->seccion_publicitaria->FormValue;
		$this->banner_publicitario_titulo->CurrentValue = $this->banner_publicitario_titulo->FormValue;
		$this->banner_publicitario_detalle->CurrentValue = $this->banner_publicitario_detalle->FormValue;
		$this->banner_publicitario_btnNombre->CurrentValue = $this->banner_publicitario_btnNombre->FormValue;
		$this->banner_publicitario_url->CurrentValue = $this->banner_publicitario_url->FormValue;
		$this->seccion_portfolio->CurrentValue = $this->seccion_portfolio->FormValue;
		$this->seccion_app->CurrentValue = $this->seccion_app->FormValue;
		$this->link_app_android->CurrentValue = $this->link_app_android->FormValue;
		$this->link_app_iphone->CurrentValue = $this->link_app_iphone->FormValue;
		$this->cookies_ley->CurrentValue = $this->cookies_ley->FormValue;
		$this->cookies_questions->CurrentValue = $this->cookies_questions->FormValue;
		$this->cookies_detalle->CurrentValue = $this->cookies_detalle->FormValue;
		$this->seccion_contact->CurrentValue = $this->seccion_contact->FormValue;
		$this->seccion_menufooter->CurrentValue = $this->seccion_menufooter->FormValue;
		$this->updated_at->CurrentValue = $this->updated_at->FormValue;
		$this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, 0);
		$this->usuario_id->CurrentValue = $this->usuario_id->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->SettingcmsID->setDbValue($row['SettingcmsID']);
		$this->seccion_slider->setDbValue($row['seccion_slider']);
		$this->seccion_about->setDbValue($row['seccion_about']);
		$this->seccion_service->setDbValue($row['seccion_service']);
		$this->seccion_publicitaria->setDbValue($row['seccion_publicitaria']);
		$this->banner_publicitario_titulo->setDbValue($row['banner_publicitario_titulo']);
		$this->banner_publicitario_detalle->setDbValue($row['banner_publicitario_detalle']);
		$this->banner_publicitario_btnNombre->setDbValue($row['banner_publicitario_btnNombre']);
		$this->banner_publicitario_url->setDbValue($row['banner_publicitario_url']);
		$this->seccion_portfolio->setDbValue($row['seccion_portfolio']);
		$this->seccion_app->setDbValue($row['seccion_app']);
		$this->link_app_android->setDbValue($row['link_app_android']);
		$this->link_app_iphone->setDbValue($row['link_app_iphone']);
		$this->cookies_ley->setDbValue($row['cookies_ley']);
		$this->cookies_questions->setDbValue($row['cookies_questions']);
		$this->cookies_detalle->setDbValue($row['cookies_detalle']);
		$this->seccion_contact->setDbValue($row['seccion_contact']);
		$this->seccion_menufooter->setDbValue($row['seccion_menufooter']);
		$this->updated_at->setDbValue($row['updated_at']);
		$this->usuario_id->setDbValue($row['usuario_id']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['SettingcmsID'] = NULL;
		$row['seccion_slider'] = NULL;
		$row['seccion_about'] = NULL;
		$row['seccion_service'] = NULL;
		$row['seccion_publicitaria'] = NULL;
		$row['banner_publicitario_titulo'] = NULL;
		$row['banner_publicitario_detalle'] = NULL;
		$row['banner_publicitario_btnNombre'] = NULL;
		$row['banner_publicitario_url'] = NULL;
		$row['seccion_portfolio'] = NULL;
		$row['seccion_app'] = NULL;
		$row['link_app_android'] = NULL;
		$row['link_app_iphone'] = NULL;
		$row['cookies_ley'] = NULL;
		$row['cookies_questions'] = NULL;
		$row['cookies_detalle'] = NULL;
		$row['seccion_contact'] = NULL;
		$row['seccion_menufooter'] = NULL;
		$row['updated_at'] = NULL;
		$row['usuario_id'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("SettingcmsID")) <> "")
			$this->SettingcmsID->CurrentValue = $this->getKey("SettingcmsID"); // SettingcmsID
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// SettingcmsID
		// seccion_slider
		// seccion_about
		// seccion_service
		// seccion_publicitaria
		// banner_publicitario_titulo
		// banner_publicitario_detalle
		// banner_publicitario_btnNombre
		// banner_publicitario_url
		// seccion_portfolio
		// seccion_app
		// link_app_android
		// link_app_iphone
		// cookies_ley
		// cookies_questions
		// cookies_detalle
		// seccion_contact
		// seccion_menufooter
		// updated_at
		// usuario_id

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// SettingcmsID
			$this->SettingcmsID->ViewValue = $this->SettingcmsID->CurrentValue;
			$this->SettingcmsID->ViewCustomAttributes = "";

			// seccion_slider
			if (ConvertToBool($this->seccion_slider->CurrentValue)) {
				$this->seccion_slider->ViewValue = $this->seccion_slider->tagCaption(2) <> "" ? $this->seccion_slider->tagCaption(2) : "1";
			} else {
				$this->seccion_slider->ViewValue = $this->seccion_slider->tagCaption(1) <> "" ? $this->seccion_slider->tagCaption(1) : "0";
			}
			$this->seccion_slider->ViewCustomAttributes = "";

			// seccion_about
			if (ConvertToBool($this->seccion_about->CurrentValue)) {
				$this->seccion_about->ViewValue = $this->seccion_about->tagCaption(2) <> "" ? $this->seccion_about->tagCaption(2) : "1";
			} else {
				$this->seccion_about->ViewValue = $this->seccion_about->tagCaption(1) <> "" ? $this->seccion_about->tagCaption(1) : "0";
			}
			$this->seccion_about->ViewCustomAttributes = "";

			// seccion_service
			if (ConvertToBool($this->seccion_service->CurrentValue)) {
				$this->seccion_service->ViewValue = $this->seccion_service->tagCaption(2) <> "" ? $this->seccion_service->tagCaption(2) : "1";
			} else {
				$this->seccion_service->ViewValue = $this->seccion_service->tagCaption(1) <> "" ? $this->seccion_service->tagCaption(1) : "0";
			}
			$this->seccion_service->ViewCustomAttributes = "";

			// seccion_publicitaria
			if (ConvertToBool($this->seccion_publicitaria->CurrentValue)) {
				$this->seccion_publicitaria->ViewValue = $this->seccion_publicitaria->tagCaption(2) <> "" ? $this->seccion_publicitaria->tagCaption(2) : "1";
			} else {
				$this->seccion_publicitaria->ViewValue = $this->seccion_publicitaria->tagCaption(1) <> "" ? $this->seccion_publicitaria->tagCaption(1) : "0";
			}
			$this->seccion_publicitaria->ViewCustomAttributes = "";

			// banner_publicitario_titulo
			$this->banner_publicitario_titulo->ViewValue = $this->banner_publicitario_titulo->CurrentValue;
			$this->banner_publicitario_titulo->ViewCustomAttributes = "";

			// banner_publicitario_detalle
			$this->banner_publicitario_detalle->ViewValue = $this->banner_publicitario_detalle->CurrentValue;
			$this->banner_publicitario_detalle->ViewCustomAttributes = "";

			// banner_publicitario_btnNombre
			$this->banner_publicitario_btnNombre->ViewValue = $this->banner_publicitario_btnNombre->CurrentValue;
			$this->banner_publicitario_btnNombre->ViewCustomAttributes = "";

			// banner_publicitario_url
			$this->banner_publicitario_url->ViewValue = $this->banner_publicitario_url->CurrentValue;
			$this->banner_publicitario_url->ViewCustomAttributes = "";

			// seccion_portfolio
			if (ConvertToBool($this->seccion_portfolio->CurrentValue)) {
				$this->seccion_portfolio->ViewValue = $this->seccion_portfolio->tagCaption(2) <> "" ? $this->seccion_portfolio->tagCaption(2) : "1";
			} else {
				$this->seccion_portfolio->ViewValue = $this->seccion_portfolio->tagCaption(1) <> "" ? $this->seccion_portfolio->tagCaption(1) : "0";
			}
			$this->seccion_portfolio->ViewCustomAttributes = "";

			// seccion_app
			if (ConvertToBool($this->seccion_app->CurrentValue)) {
				$this->seccion_app->ViewValue = $this->seccion_app->tagCaption(2) <> "" ? $this->seccion_app->tagCaption(2) : "1";
			} else {
				$this->seccion_app->ViewValue = $this->seccion_app->tagCaption(1) <> "" ? $this->seccion_app->tagCaption(1) : "0";
			}
			$this->seccion_app->ViewCustomAttributes = "";

			// link_app_android
			$this->link_app_android->ViewValue = $this->link_app_android->CurrentValue;
			$this->link_app_android->ViewCustomAttributes = "";

			// link_app_iphone
			$this->link_app_iphone->ViewValue = $this->link_app_iphone->CurrentValue;
			$this->link_app_iphone->ViewCustomAttributes = "";

			// cookies_ley
			if (ConvertToBool($this->cookies_ley->CurrentValue)) {
				$this->cookies_ley->ViewValue = $this->cookies_ley->tagCaption(2) <> "" ? $this->cookies_ley->tagCaption(2) : "1";
			} else {
				$this->cookies_ley->ViewValue = $this->cookies_ley->tagCaption(1) <> "" ? $this->cookies_ley->tagCaption(1) : "0";
			}
			$this->cookies_ley->ViewCustomAttributes = "";

			// cookies_questions
			$this->cookies_questions->ViewValue = $this->cookies_questions->CurrentValue;
			$this->cookies_questions->ViewCustomAttributes = "";

			// cookies_detalle
			$this->cookies_detalle->ViewValue = $this->cookies_detalle->CurrentValue;
			$this->cookies_detalle->ViewCustomAttributes = "";

			// seccion_contact
			if (ConvertToBool($this->seccion_contact->CurrentValue)) {
				$this->seccion_contact->ViewValue = $this->seccion_contact->tagCaption(2) <> "" ? $this->seccion_contact->tagCaption(2) : "1";
			} else {
				$this->seccion_contact->ViewValue = $this->seccion_contact->tagCaption(1) <> "" ? $this->seccion_contact->tagCaption(1) : "0";
			}
			$this->seccion_contact->ViewCustomAttributes = "";

			// seccion_menufooter
			if (ConvertToBool($this->seccion_menufooter->CurrentValue)) {
				$this->seccion_menufooter->ViewValue = $this->seccion_menufooter->tagCaption(2) <> "" ? $this->seccion_menufooter->tagCaption(2) : "1";
			} else {
				$this->seccion_menufooter->ViewValue = $this->seccion_menufooter->tagCaption(1) <> "" ? $this->seccion_menufooter->tagCaption(1) : "0";
			}
			$this->seccion_menufooter->ViewCustomAttributes = "";

			// updated_at
			$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
			$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
			$this->updated_at->ViewCustomAttributes = "";

			// usuario_id
			$this->usuario_id->ViewValue = $this->usuario_id->CurrentValue;
			$this->usuario_id->ViewValue = FormatNumber($this->usuario_id->ViewValue, 0, -2, -2, -2);
			$this->usuario_id->ViewCustomAttributes = "";

			// SettingcmsID
			$this->SettingcmsID->LinkCustomAttributes = "";
			$this->SettingcmsID->HrefValue = "";
			$this->SettingcmsID->TooltipValue = "";

			// seccion_slider
			$this->seccion_slider->LinkCustomAttributes = "";
			$this->seccion_slider->HrefValue = "";
			$this->seccion_slider->TooltipValue = "";

			// seccion_about
			$this->seccion_about->LinkCustomAttributes = "";
			$this->seccion_about->HrefValue = "";
			$this->seccion_about->TooltipValue = "";

			// seccion_service
			$this->seccion_service->LinkCustomAttributes = "";
			$this->seccion_service->HrefValue = "";
			$this->seccion_service->TooltipValue = "";

			// seccion_publicitaria
			$this->seccion_publicitaria->LinkCustomAttributes = "";
			$this->seccion_publicitaria->HrefValue = "";
			$this->seccion_publicitaria->TooltipValue = "";

			// banner_publicitario_titulo
			$this->banner_publicitario_titulo->LinkCustomAttributes = "";
			$this->banner_publicitario_titulo->HrefValue = "";
			$this->banner_publicitario_titulo->TooltipValue = "";

			// banner_publicitario_detalle
			$this->banner_publicitario_detalle->LinkCustomAttributes = "";
			$this->banner_publicitario_detalle->HrefValue = "";
			$this->banner_publicitario_detalle->TooltipValue = "";

			// banner_publicitario_btnNombre
			$this->banner_publicitario_btnNombre->LinkCustomAttributes = "";
			$this->banner_publicitario_btnNombre->HrefValue = "";
			$this->banner_publicitario_btnNombre->TooltipValue = "";

			// banner_publicitario_url
			$this->banner_publicitario_url->LinkCustomAttributes = "";
			$this->banner_publicitario_url->HrefValue = "";
			$this->banner_publicitario_url->TooltipValue = "";

			// seccion_portfolio
			$this->seccion_portfolio->LinkCustomAttributes = "";
			$this->seccion_portfolio->HrefValue = "";
			$this->seccion_portfolio->TooltipValue = "";

			// seccion_app
			$this->seccion_app->LinkCustomAttributes = "";
			$this->seccion_app->HrefValue = "";
			$this->seccion_app->TooltipValue = "";

			// link_app_android
			$this->link_app_android->LinkCustomAttributes = "";
			$this->link_app_android->HrefValue = "";
			$this->link_app_android->TooltipValue = "";

			// link_app_iphone
			$this->link_app_iphone->LinkCustomAttributes = "";
			$this->link_app_iphone->HrefValue = "";
			$this->link_app_iphone->TooltipValue = "";

			// cookies_ley
			$this->cookies_ley->LinkCustomAttributes = "";
			$this->cookies_ley->HrefValue = "";
			$this->cookies_ley->TooltipValue = "";

			// cookies_questions
			$this->cookies_questions->LinkCustomAttributes = "";
			$this->cookies_questions->HrefValue = "";
			$this->cookies_questions->TooltipValue = "";

			// cookies_detalle
			$this->cookies_detalle->LinkCustomAttributes = "";
			$this->cookies_detalle->HrefValue = "";
			$this->cookies_detalle->TooltipValue = "";

			// seccion_contact
			$this->seccion_contact->LinkCustomAttributes = "";
			$this->seccion_contact->HrefValue = "";
			$this->seccion_contact->TooltipValue = "";

			// seccion_menufooter
			$this->seccion_menufooter->LinkCustomAttributes = "";
			$this->seccion_menufooter->HrefValue = "";
			$this->seccion_menufooter->TooltipValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";
			$this->updated_at->TooltipValue = "";

			// usuario_id
			$this->usuario_id->LinkCustomAttributes = "";
			$this->usuario_id->HrefValue = "";
			$this->usuario_id->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// SettingcmsID
			$this->SettingcmsID->EditAttrs["class"] = "form-control";
			$this->SettingcmsID->EditCustomAttributes = "";
			$this->SettingcmsID->EditValue = $this->SettingcmsID->CurrentValue;
			$this->SettingcmsID->ViewCustomAttributes = "";

			// seccion_slider
			$this->seccion_slider->EditCustomAttributes = "";
			$this->seccion_slider->EditValue = $this->seccion_slider->options(FALSE);

			// seccion_about
			$this->seccion_about->EditCustomAttributes = "";
			$this->seccion_about->EditValue = $this->seccion_about->options(FALSE);

			// seccion_service
			$this->seccion_service->EditCustomAttributes = "";
			$this->seccion_service->EditValue = $this->seccion_service->options(FALSE);

			// seccion_publicitaria
			$this->seccion_publicitaria->EditCustomAttributes = "";
			$this->seccion_publicitaria->EditValue = $this->seccion_publicitaria->options(FALSE);

			// banner_publicitario_titulo
			$this->banner_publicitario_titulo->EditAttrs["class"] = "form-control";
			$this->banner_publicitario_titulo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->banner_publicitario_titulo->CurrentValue = HtmlDecode($this->banner_publicitario_titulo->CurrentValue);
			$this->banner_publicitario_titulo->EditValue = HtmlEncode($this->banner_publicitario_titulo->CurrentValue);
			$this->banner_publicitario_titulo->PlaceHolder = RemoveHtml($this->banner_publicitario_titulo->caption());

			// banner_publicitario_detalle
			$this->banner_publicitario_detalle->EditAttrs["class"] = "form-control";
			$this->banner_publicitario_detalle->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->banner_publicitario_detalle->CurrentValue = HtmlDecode($this->banner_publicitario_detalle->CurrentValue);
			$this->banner_publicitario_detalle->EditValue = HtmlEncode($this->banner_publicitario_detalle->CurrentValue);
			$this->banner_publicitario_detalle->PlaceHolder = RemoveHtml($this->banner_publicitario_detalle->caption());

			// banner_publicitario_btnNombre
			$this->banner_publicitario_btnNombre->EditAttrs["class"] = "form-control";
			$this->banner_publicitario_btnNombre->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->banner_publicitario_btnNombre->CurrentValue = HtmlDecode($this->banner_publicitario_btnNombre->CurrentValue);
			$this->banner_publicitario_btnNombre->EditValue = HtmlEncode($this->banner_publicitario_btnNombre->CurrentValue);
			$this->banner_publicitario_btnNombre->PlaceHolder = RemoveHtml($this->banner_publicitario_btnNombre->caption());

			// banner_publicitario_url
			$this->banner_publicitario_url->EditAttrs["class"] = "form-control";
			$this->banner_publicitario_url->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->banner_publicitario_url->CurrentValue = HtmlDecode($this->banner_publicitario_url->CurrentValue);
			$this->banner_publicitario_url->EditValue = HtmlEncode($this->banner_publicitario_url->CurrentValue);
			$this->banner_publicitario_url->PlaceHolder = RemoveHtml($this->banner_publicitario_url->caption());

			// seccion_portfolio
			$this->seccion_portfolio->EditCustomAttributes = "";
			$this->seccion_portfolio->EditValue = $this->seccion_portfolio->options(FALSE);

			// seccion_app
			$this->seccion_app->EditCustomAttributes = "";
			$this->seccion_app->EditValue = $this->seccion_app->options(FALSE);

			// link_app_android
			$this->link_app_android->EditAttrs["class"] = "form-control";
			$this->link_app_android->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->link_app_android->CurrentValue = HtmlDecode($this->link_app_android->CurrentValue);
			$this->link_app_android->EditValue = HtmlEncode($this->link_app_android->CurrentValue);
			$this->link_app_android->PlaceHolder = RemoveHtml($this->link_app_android->caption());

			// link_app_iphone
			$this->link_app_iphone->EditAttrs["class"] = "form-control";
			$this->link_app_iphone->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->link_app_iphone->CurrentValue = HtmlDecode($this->link_app_iphone->CurrentValue);
			$this->link_app_iphone->EditValue = HtmlEncode($this->link_app_iphone->CurrentValue);
			$this->link_app_iphone->PlaceHolder = RemoveHtml($this->link_app_iphone->caption());

			// cookies_ley
			$this->cookies_ley->EditCustomAttributes = "";
			$this->cookies_ley->EditValue = $this->cookies_ley->options(FALSE);

			// cookies_questions
			$this->cookies_questions->EditAttrs["class"] = "form-control";
			$this->cookies_questions->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->cookies_questions->CurrentValue = HtmlDecode($this->cookies_questions->CurrentValue);
			$this->cookies_questions->EditValue = HtmlEncode($this->cookies_questions->CurrentValue);
			$this->cookies_questions->PlaceHolder = RemoveHtml($this->cookies_questions->caption());

			// cookies_detalle
			$this->cookies_detalle->EditAttrs["class"] = "form-control";
			$this->cookies_detalle->EditCustomAttributes = "";
			$this->cookies_detalle->EditValue = HtmlEncode($this->cookies_detalle->CurrentValue);
			$this->cookies_detalle->PlaceHolder = RemoveHtml($this->cookies_detalle->caption());

			// seccion_contact
			$this->seccion_contact->EditCustomAttributes = "";
			$this->seccion_contact->EditValue = $this->seccion_contact->options(FALSE);

			// seccion_menufooter
			$this->seccion_menufooter->EditCustomAttributes = "";
			$this->seccion_menufooter->EditValue = $this->seccion_menufooter->options(FALSE);

			// updated_at
			$this->updated_at->EditAttrs["class"] = "form-control";
			$this->updated_at->EditCustomAttributes = "";
			$this->updated_at->CurrentValue = FormatDateTime($this->updated_at->CurrentValue, 8);

			// usuario_id
			$this->usuario_id->EditAttrs["class"] = "form-control";
			$this->usuario_id->EditCustomAttributes = "";

			// Edit refer script
			// SettingcmsID

			$this->SettingcmsID->LinkCustomAttributes = "";
			$this->SettingcmsID->HrefValue = "";

			// seccion_slider
			$this->seccion_slider->LinkCustomAttributes = "";
			$this->seccion_slider->HrefValue = "";

			// seccion_about
			$this->seccion_about->LinkCustomAttributes = "";
			$this->seccion_about->HrefValue = "";

			// seccion_service
			$this->seccion_service->LinkCustomAttributes = "";
			$this->seccion_service->HrefValue = "";

			// seccion_publicitaria
			$this->seccion_publicitaria->LinkCustomAttributes = "";
			$this->seccion_publicitaria->HrefValue = "";

			// banner_publicitario_titulo
			$this->banner_publicitario_titulo->LinkCustomAttributes = "";
			$this->banner_publicitario_titulo->HrefValue = "";

			// banner_publicitario_detalle
			$this->banner_publicitario_detalle->LinkCustomAttributes = "";
			$this->banner_publicitario_detalle->HrefValue = "";

			// banner_publicitario_btnNombre
			$this->banner_publicitario_btnNombre->LinkCustomAttributes = "";
			$this->banner_publicitario_btnNombre->HrefValue = "";

			// banner_publicitario_url
			$this->banner_publicitario_url->LinkCustomAttributes = "";
			$this->banner_publicitario_url->HrefValue = "";

			// seccion_portfolio
			$this->seccion_portfolio->LinkCustomAttributes = "";
			$this->seccion_portfolio->HrefValue = "";

			// seccion_app
			$this->seccion_app->LinkCustomAttributes = "";
			$this->seccion_app->HrefValue = "";

			// link_app_android
			$this->link_app_android->LinkCustomAttributes = "";
			$this->link_app_android->HrefValue = "";

			// link_app_iphone
			$this->link_app_iphone->LinkCustomAttributes = "";
			$this->link_app_iphone->HrefValue = "";

			// cookies_ley
			$this->cookies_ley->LinkCustomAttributes = "";
			$this->cookies_ley->HrefValue = "";

			// cookies_questions
			$this->cookies_questions->LinkCustomAttributes = "";
			$this->cookies_questions->HrefValue = "";

			// cookies_detalle
			$this->cookies_detalle->LinkCustomAttributes = "";
			$this->cookies_detalle->HrefValue = "";

			// seccion_contact
			$this->seccion_contact->LinkCustomAttributes = "";
			$this->seccion_contact->HrefValue = "";

			// seccion_menufooter
			$this->seccion_menufooter->LinkCustomAttributes = "";
			$this->seccion_menufooter->HrefValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";

			// usuario_id
			$this->usuario_id->LinkCustomAttributes = "";
			$this->usuario_id->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->SettingcmsID->Required) {
			if (!$this->SettingcmsID->IsDetailKey && $this->SettingcmsID->FormValue != NULL && $this->SettingcmsID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SettingcmsID->caption(), $this->SettingcmsID->RequiredErrorMessage));
			}
		}
		if ($this->seccion_slider->Required) {
			if ($this->seccion_slider->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->seccion_slider->caption(), $this->seccion_slider->RequiredErrorMessage));
			}
		}
		if ($this->seccion_about->Required) {
			if ($this->seccion_about->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->seccion_about->caption(), $this->seccion_about->RequiredErrorMessage));
			}
		}
		if ($this->seccion_service->Required) {
			if ($this->seccion_service->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->seccion_service->caption(), $this->seccion_service->RequiredErrorMessage));
			}
		}
		if ($this->seccion_publicitaria->Required) {
			if ($this->seccion_publicitaria->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->seccion_publicitaria->caption(), $this->seccion_publicitaria->RequiredErrorMessage));
			}
		}
		if ($this->banner_publicitario_titulo->Required) {
			if (!$this->banner_publicitario_titulo->IsDetailKey && $this->banner_publicitario_titulo->FormValue != NULL && $this->banner_publicitario_titulo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->banner_publicitario_titulo->caption(), $this->banner_publicitario_titulo->RequiredErrorMessage));
			}
		}
		if ($this->banner_publicitario_detalle->Required) {
			if (!$this->banner_publicitario_detalle->IsDetailKey && $this->banner_publicitario_detalle->FormValue != NULL && $this->banner_publicitario_detalle->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->banner_publicitario_detalle->caption(), $this->banner_publicitario_detalle->RequiredErrorMessage));
			}
		}
		if ($this->banner_publicitario_btnNombre->Required) {
			if (!$this->banner_publicitario_btnNombre->IsDetailKey && $this->banner_publicitario_btnNombre->FormValue != NULL && $this->banner_publicitario_btnNombre->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->banner_publicitario_btnNombre->caption(), $this->banner_publicitario_btnNombre->RequiredErrorMessage));
			}
		}
		if ($this->banner_publicitario_url->Required) {
			if (!$this->banner_publicitario_url->IsDetailKey && $this->banner_publicitario_url->FormValue != NULL && $this->banner_publicitario_url->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->banner_publicitario_url->caption(), $this->banner_publicitario_url->RequiredErrorMessage));
			}
		}
		if ($this->seccion_portfolio->Required) {
			if ($this->seccion_portfolio->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->seccion_portfolio->caption(), $this->seccion_portfolio->RequiredErrorMessage));
			}
		}
		if ($this->seccion_app->Required) {
			if ($this->seccion_app->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->seccion_app->caption(), $this->seccion_app->RequiredErrorMessage));
			}
		}
		if ($this->link_app_android->Required) {
			if (!$this->link_app_android->IsDetailKey && $this->link_app_android->FormValue != NULL && $this->link_app_android->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->link_app_android->caption(), $this->link_app_android->RequiredErrorMessage));
			}
		}
		if ($this->link_app_iphone->Required) {
			if (!$this->link_app_iphone->IsDetailKey && $this->link_app_iphone->FormValue != NULL && $this->link_app_iphone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->link_app_iphone->caption(), $this->link_app_iphone->RequiredErrorMessage));
			}
		}
		if ($this->cookies_ley->Required) {
			if ($this->cookies_ley->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cookies_ley->caption(), $this->cookies_ley->RequiredErrorMessage));
			}
		}
		if ($this->cookies_questions->Required) {
			if (!$this->cookies_questions->IsDetailKey && $this->cookies_questions->FormValue != NULL && $this->cookies_questions->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cookies_questions->caption(), $this->cookies_questions->RequiredErrorMessage));
			}
		}
		if ($this->cookies_detalle->Required) {
			if (!$this->cookies_detalle->IsDetailKey && $this->cookies_detalle->FormValue != NULL && $this->cookies_detalle->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cookies_detalle->caption(), $this->cookies_detalle->RequiredErrorMessage));
			}
		}
		if ($this->seccion_contact->Required) {
			if ($this->seccion_contact->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->seccion_contact->caption(), $this->seccion_contact->RequiredErrorMessage));
			}
		}
		if ($this->seccion_menufooter->Required) {
			if ($this->seccion_menufooter->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->seccion_menufooter->caption(), $this->seccion_menufooter->RequiredErrorMessage));
			}
		}
		if ($this->updated_at->Required) {
			if (!$this->updated_at->IsDetailKey && $this->updated_at->FormValue != NULL && $this->updated_at->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
			}
		}
		if ($this->usuario_id->Required) {
			if (!$this->usuario_id->IsDetailKey && $this->usuario_id->FormValue != NULL && $this->usuario_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->usuario_id->caption(), $this->usuario_id->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($filter);
		$conn = &$this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// seccion_slider
			$tmpBool = $this->seccion_slider->CurrentValue;
			if ($tmpBool <> "1" && $tmpBool <> "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->seccion_slider->setDbValueDef($rsnew, $tmpBool, 0, $this->seccion_slider->ReadOnly);

			// seccion_about
			$tmpBool = $this->seccion_about->CurrentValue;
			if ($tmpBool <> "1" && $tmpBool <> "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->seccion_about->setDbValueDef($rsnew, $tmpBool, 0, $this->seccion_about->ReadOnly);

			// seccion_service
			$tmpBool = $this->seccion_service->CurrentValue;
			if ($tmpBool <> "1" && $tmpBool <> "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->seccion_service->setDbValueDef($rsnew, $tmpBool, 0, $this->seccion_service->ReadOnly);

			// seccion_publicitaria
			$tmpBool = $this->seccion_publicitaria->CurrentValue;
			if ($tmpBool <> "1" && $tmpBool <> "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->seccion_publicitaria->setDbValueDef($rsnew, $tmpBool, 0, $this->seccion_publicitaria->ReadOnly);

			// banner_publicitario_titulo
			$this->banner_publicitario_titulo->setDbValueDef($rsnew, $this->banner_publicitario_titulo->CurrentValue, NULL, $this->banner_publicitario_titulo->ReadOnly);

			// banner_publicitario_detalle
			$this->banner_publicitario_detalle->setDbValueDef($rsnew, $this->banner_publicitario_detalle->CurrentValue, NULL, $this->banner_publicitario_detalle->ReadOnly);

			// banner_publicitario_btnNombre
			$this->banner_publicitario_btnNombre->setDbValueDef($rsnew, $this->banner_publicitario_btnNombre->CurrentValue, NULL, $this->banner_publicitario_btnNombre->ReadOnly);

			// banner_publicitario_url
			$this->banner_publicitario_url->setDbValueDef($rsnew, $this->banner_publicitario_url->CurrentValue, NULL, $this->banner_publicitario_url->ReadOnly);

			// seccion_portfolio
			$tmpBool = $this->seccion_portfolio->CurrentValue;
			if ($tmpBool <> "1" && $tmpBool <> "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->seccion_portfolio->setDbValueDef($rsnew, $tmpBool, 0, $this->seccion_portfolio->ReadOnly);

			// seccion_app
			$tmpBool = $this->seccion_app->CurrentValue;
			if ($tmpBool <> "1" && $tmpBool <> "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->seccion_app->setDbValueDef($rsnew, $tmpBool, 0, $this->seccion_app->ReadOnly);

			// link_app_android
			$this->link_app_android->setDbValueDef($rsnew, $this->link_app_android->CurrentValue, NULL, $this->link_app_android->ReadOnly);

			// link_app_iphone
			$this->link_app_iphone->setDbValueDef($rsnew, $this->link_app_iphone->CurrentValue, NULL, $this->link_app_iphone->ReadOnly);

			// cookies_ley
			$tmpBool = $this->cookies_ley->CurrentValue;
			if ($tmpBool <> "1" && $tmpBool <> "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->cookies_ley->setDbValueDef($rsnew, $tmpBool, NULL, $this->cookies_ley->ReadOnly);

			// cookies_questions
			$this->cookies_questions->setDbValueDef($rsnew, $this->cookies_questions->CurrentValue, NULL, $this->cookies_questions->ReadOnly);

			// cookies_detalle
			$this->cookies_detalle->setDbValueDef($rsnew, $this->cookies_detalle->CurrentValue, NULL, $this->cookies_detalle->ReadOnly);

			// seccion_contact
			$tmpBool = $this->seccion_contact->CurrentValue;
			if ($tmpBool <> "1" && $tmpBool <> "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->seccion_contact->setDbValueDef($rsnew, $tmpBool, 0, $this->seccion_contact->ReadOnly);

			// seccion_menufooter
			$tmpBool = $this->seccion_menufooter->CurrentValue;
			if ($tmpBool <> "1" && $tmpBool <> "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->seccion_menufooter->setDbValueDef($rsnew, $tmpBool, 0, $this->seccion_menufooter->ReadOnly);

			// updated_at
			$this->updated_at->setDbValueDef($rsnew, UnFormatDateTime($this->updated_at->CurrentValue, 0), NULL, $this->updated_at->ReadOnly);

			// usuario_id
			$this->usuario_id->setDbValueDef($rsnew, $this->usuario_id->CurrentValue, 0, $this->usuario_id->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);
			if ($updateRow) {
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("setting_cmslist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Set up multi pages
	protected function setupMultiPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add(0);
		$pages->add(1);
		$pages->add(2);
		$pages->add(3);
		$pages->add(4);
		$this->MultiPages = $pages;
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->ParentFields) == 0 && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>