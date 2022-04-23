<?php
namespace PHPMaker2019\cmsweb;

/**
 * Page class
 */
class profiles_edit extends profiles
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{5ACD2586-5733-4EB1-9592-B819B3395C82}";

	// Table name
	public $TableName = 'profiles';

	// Page object name
	public $PageObjName = "profiles_edit";

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

		// Table object (profiles)
		if (!isset($GLOBALS["profiles"]) || get_class($GLOBALS["profiles"]) == PROJECT_NAMESPACE . "profiles") {
			$GLOBALS["profiles"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["profiles"];
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'profiles');

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
		global $EXPORT, $profiles;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($profiles);
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
					if ($pageName == "profilesview.php")
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
			$key .= @$ar['id'];
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
			$this->id->Visible = FALSE;
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
					$this->terminate(GetUrl("profileslist.php"));
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
		$this->id->setVisibility();
		$this->title->setVisibility();
		$this->biography->setVisibility();
		$this->imagen->setVisibility();
		$this->maps_iframe->setVisibility();
		$this->website->setVisibility();
		$this->facebook->setVisibility();
		$this->linkedin->setVisibility();
		$this->youtube->setVisibility();
		$this->instagram->setVisibility();
		$this->user_id->setVisibility();
		$this->created_at->setVisibility();
		$this->updated_at->setVisibility();
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
			if ($CurrentForm->hasValue("x_id")) {
				$this->id->setFormValue($CurrentForm->getValue("x_id"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$loadByQuery = TRUE;
			} else {
				$this->id->CurrentValue = NULL;
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
					$this->terminate("profileslist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "profileslist.php")
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
		$this->imagen->Upload->Index = $CurrentForm->Index;
		$this->imagen->Upload->uploadFile();
		$this->imagen->CurrentValue = $this->imagen->Upload->FileName;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey)
			$this->id->setFormValue($val);

		// Check field name 'title' first before field var 'x_title'
		$val = $CurrentForm->hasValue("title") ? $CurrentForm->getValue("title") : $CurrentForm->getValue("x_title");
		if (!$this->title->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->title->Visible = FALSE; // Disable update for API request
			else
				$this->title->setFormValue($val);
		}

		// Check field name 'biography' first before field var 'x_biography'
		$val = $CurrentForm->hasValue("biography") ? $CurrentForm->getValue("biography") : $CurrentForm->getValue("x_biography");
		if (!$this->biography->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->biography->Visible = FALSE; // Disable update for API request
			else
				$this->biography->setFormValue($val);
		}

		// Check field name 'maps_iframe' first before field var 'x_maps_iframe'
		$val = $CurrentForm->hasValue("maps_iframe") ? $CurrentForm->getValue("maps_iframe") : $CurrentForm->getValue("x_maps_iframe");
		if (!$this->maps_iframe->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->maps_iframe->Visible = FALSE; // Disable update for API request
			else
				$this->maps_iframe->setFormValue($val);
		}

		// Check field name 'website' first before field var 'x_website'
		$val = $CurrentForm->hasValue("website") ? $CurrentForm->getValue("website") : $CurrentForm->getValue("x_website");
		if (!$this->website->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->website->Visible = FALSE; // Disable update for API request
			else
				$this->website->setFormValue($val);
		}

		// Check field name 'facebook' first before field var 'x_facebook'
		$val = $CurrentForm->hasValue("facebook") ? $CurrentForm->getValue("facebook") : $CurrentForm->getValue("x_facebook");
		if (!$this->facebook->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->facebook->Visible = FALSE; // Disable update for API request
			else
				$this->facebook->setFormValue($val);
		}

		// Check field name 'linkedin' first before field var 'x_linkedin'
		$val = $CurrentForm->hasValue("linkedin") ? $CurrentForm->getValue("linkedin") : $CurrentForm->getValue("x_linkedin");
		if (!$this->linkedin->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->linkedin->Visible = FALSE; // Disable update for API request
			else
				$this->linkedin->setFormValue($val);
		}

		// Check field name 'youtube' first before field var 'x_youtube'
		$val = $CurrentForm->hasValue("youtube") ? $CurrentForm->getValue("youtube") : $CurrentForm->getValue("x_youtube");
		if (!$this->youtube->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->youtube->Visible = FALSE; // Disable update for API request
			else
				$this->youtube->setFormValue($val);
		}

		// Check field name 'instagram' first before field var 'x_instagram'
		$val = $CurrentForm->hasValue("instagram") ? $CurrentForm->getValue("instagram") : $CurrentForm->getValue("x_instagram");
		if (!$this->instagram->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->instagram->Visible = FALSE; // Disable update for API request
			else
				$this->instagram->setFormValue($val);
		}

		// Check field name 'user_id' first before field var 'x_user_id'
		$val = $CurrentForm->hasValue("user_id") ? $CurrentForm->getValue("user_id") : $CurrentForm->getValue("x_user_id");
		if (!$this->user_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->user_id->Visible = FALSE; // Disable update for API request
			else
				$this->user_id->setFormValue($val);
		}

		// Check field name 'created_at' first before field var 'x_created_at'
		$val = $CurrentForm->hasValue("created_at") ? $CurrentForm->getValue("created_at") : $CurrentForm->getValue("x_created_at");
		if (!$this->created_at->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->created_at->Visible = FALSE; // Disable update for API request
			else
				$this->created_at->setFormValue($val);
			$this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, 0);
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
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->title->CurrentValue = $this->title->FormValue;
		$this->biography->CurrentValue = $this->biography->FormValue;
		$this->maps_iframe->CurrentValue = $this->maps_iframe->FormValue;
		$this->website->CurrentValue = $this->website->FormValue;
		$this->facebook->CurrentValue = $this->facebook->FormValue;
		$this->linkedin->CurrentValue = $this->linkedin->FormValue;
		$this->youtube->CurrentValue = $this->youtube->FormValue;
		$this->instagram->CurrentValue = $this->instagram->FormValue;
		$this->user_id->CurrentValue = $this->user_id->FormValue;
		$this->created_at->CurrentValue = $this->created_at->FormValue;
		$this->created_at->CurrentValue = UnFormatDateTime($this->created_at->CurrentValue, 0);
		$this->updated_at->CurrentValue = $this->updated_at->FormValue;
		$this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, 0);
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
		$this->id->setDbValue($row['id']);
		$this->title->setDbValue($row['title']);
		$this->biography->setDbValue($row['biography']);
		$this->imagen->Upload->DbValue = $row['imagen'];
		$this->imagen->setDbValue($this->imagen->Upload->DbValue);
		$this->maps_iframe->setDbValue($row['maps_iframe']);
		$this->website->setDbValue($row['website']);
		$this->facebook->setDbValue($row['facebook']);
		$this->linkedin->setDbValue($row['linkedin']);
		$this->youtube->setDbValue($row['youtube']);
		$this->instagram->setDbValue($row['instagram']);
		$this->user_id->setDbValue($row['user_id']);
		$this->created_at->setDbValue($row['created_at']);
		$this->updated_at->setDbValue($row['updated_at']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['title'] = NULL;
		$row['biography'] = NULL;
		$row['imagen'] = NULL;
		$row['maps_iframe'] = NULL;
		$row['website'] = NULL;
		$row['facebook'] = NULL;
		$row['linkedin'] = NULL;
		$row['youtube'] = NULL;
		$row['instagram'] = NULL;
		$row['user_id'] = NULL;
		$row['created_at'] = NULL;
		$row['updated_at'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
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
		// id
		// title
		// biography
		// imagen
		// maps_iframe
		// website
		// facebook
		// linkedin
		// youtube
		// instagram
		// user_id
		// created_at
		// updated_at

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// title
			$this->title->ViewValue = $this->title->CurrentValue;
			$this->title->ViewCustomAttributes = "";

			// biography
			$this->biography->ViewValue = $this->biography->CurrentValue;
			$this->biography->ViewCustomAttributes = "";

			// imagen
			$this->imagen->UploadPath = "phpimages/Profiles/";
			if (!EmptyValue($this->imagen->Upload->DbValue)) {
				$this->imagen->ImageAlt = $this->imagen->alt();
				$this->imagen->ViewValue = $this->imagen->Upload->DbValue;
			} else {
				$this->imagen->ViewValue = "";
			}
			$this->imagen->ViewCustomAttributes = "";

			// maps_iframe
			$this->maps_iframe->ViewValue = $this->maps_iframe->CurrentValue;
			$this->maps_iframe->ViewCustomAttributes = "";

			// website
			$this->website->ViewValue = $this->website->CurrentValue;
			$this->website->ViewCustomAttributes = "";

			// facebook
			$this->facebook->ViewValue = $this->facebook->CurrentValue;
			$this->facebook->ViewCustomAttributes = "";

			// linkedin
			$this->linkedin->ViewValue = $this->linkedin->CurrentValue;
			$this->linkedin->ViewCustomAttributes = "";

			// youtube
			$this->youtube->ViewValue = $this->youtube->CurrentValue;
			$this->youtube->ViewCustomAttributes = "";

			// instagram
			$this->instagram->ViewValue = $this->instagram->CurrentValue;
			$this->instagram->ViewCustomAttributes = "";

			// user_id
			$this->user_id->ViewValue = $this->user_id->CurrentValue;
			$this->user_id->ViewValue = FormatNumber($this->user_id->ViewValue, 0, -2, -2, -2);
			$this->user_id->ViewCustomAttributes = "";

			// created_at
			$this->created_at->ViewValue = $this->created_at->CurrentValue;
			$this->created_at->ViewValue = FormatDateTime($this->created_at->ViewValue, 0);
			$this->created_at->ViewCustomAttributes = "";

			// updated_at
			$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
			$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 0);
			$this->updated_at->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// title
			$this->title->LinkCustomAttributes = "";
			$this->title->HrefValue = "";
			$this->title->TooltipValue = "";

			// biography
			$this->biography->LinkCustomAttributes = "";
			$this->biography->HrefValue = "";
			$this->biography->TooltipValue = "";

			// imagen
			$this->imagen->LinkCustomAttributes = "";
			$this->imagen->UploadPath = "phpimages/Profiles/";
			if (!EmptyValue($this->imagen->Upload->DbValue)) {
				$this->imagen->HrefValue = GetFileUploadUrl($this->imagen, $this->imagen->Upload->DbValue); // Add prefix/suffix
				$this->imagen->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->imagen->HrefValue = FullUrl($this->imagen->HrefValue, "href");
			} else {
				$this->imagen->HrefValue = "";
			}
			$this->imagen->ExportHrefValue = $this->imagen->UploadPath . $this->imagen->Upload->DbValue;
			$this->imagen->TooltipValue = "";
			if ($this->imagen->UseColorbox) {
				if (EmptyValue($this->imagen->TooltipValue))
					$this->imagen->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->imagen->LinkAttrs["data-rel"] = "profiles_x_imagen";
				AppendClass($this->imagen->LinkAttrs["class"], "ew-lightbox");
			}

			// maps_iframe
			$this->maps_iframe->LinkCustomAttributes = "";
			$this->maps_iframe->HrefValue = "";
			$this->maps_iframe->TooltipValue = "";

			// website
			$this->website->LinkCustomAttributes = "";
			$this->website->HrefValue = "";
			$this->website->TooltipValue = "";

			// facebook
			$this->facebook->LinkCustomAttributes = "";
			$this->facebook->HrefValue = "";
			$this->facebook->TooltipValue = "";

			// linkedin
			$this->linkedin->LinkCustomAttributes = "";
			$this->linkedin->HrefValue = "";
			$this->linkedin->TooltipValue = "";

			// youtube
			$this->youtube->LinkCustomAttributes = "";
			$this->youtube->HrefValue = "";
			$this->youtube->TooltipValue = "";

			// instagram
			$this->instagram->LinkCustomAttributes = "";
			$this->instagram->HrefValue = "";
			$this->instagram->TooltipValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";
			$this->user_id->TooltipValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";
			$this->created_at->TooltipValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";
			$this->updated_at->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// title
			$this->title->EditAttrs["class"] = "form-control";
			$this->title->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->title->CurrentValue = HtmlDecode($this->title->CurrentValue);
			$this->title->EditValue = HtmlEncode($this->title->CurrentValue);
			$this->title->PlaceHolder = RemoveHtml($this->title->caption());

			// biography
			$this->biography->EditAttrs["class"] = "form-control";
			$this->biography->EditCustomAttributes = "";
			$this->biography->EditValue = HtmlEncode($this->biography->CurrentValue);
			$this->biography->PlaceHolder = RemoveHtml($this->biography->caption());

			// imagen
			$this->imagen->EditAttrs["class"] = "form-control";
			$this->imagen->EditCustomAttributes = "";
			$this->imagen->UploadPath = "phpimages/Profiles/";
			if (!EmptyValue($this->imagen->Upload->DbValue)) {
				$this->imagen->ImageAlt = $this->imagen->alt();
				$this->imagen->EditValue = $this->imagen->Upload->DbValue;
			} else {
				$this->imagen->EditValue = "";
			}
			if (!EmptyValue($this->imagen->CurrentValue))
					$this->imagen->Upload->FileName = $this->imagen->CurrentValue;
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->imagen);

			// maps_iframe
			$this->maps_iframe->EditAttrs["class"] = "form-control";
			$this->maps_iframe->EditCustomAttributes = "";
			$this->maps_iframe->EditValue = HtmlEncode($this->maps_iframe->CurrentValue);
			$this->maps_iframe->PlaceHolder = RemoveHtml($this->maps_iframe->caption());

			// website
			$this->website->EditAttrs["class"] = "form-control";
			$this->website->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->website->CurrentValue = HtmlDecode($this->website->CurrentValue);
			$this->website->EditValue = HtmlEncode($this->website->CurrentValue);
			$this->website->PlaceHolder = RemoveHtml($this->website->caption());

			// facebook
			$this->facebook->EditAttrs["class"] = "form-control";
			$this->facebook->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->facebook->CurrentValue = HtmlDecode($this->facebook->CurrentValue);
			$this->facebook->EditValue = HtmlEncode($this->facebook->CurrentValue);
			$this->facebook->PlaceHolder = RemoveHtml($this->facebook->caption());

			// linkedin
			$this->linkedin->EditAttrs["class"] = "form-control";
			$this->linkedin->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->linkedin->CurrentValue = HtmlDecode($this->linkedin->CurrentValue);
			$this->linkedin->EditValue = HtmlEncode($this->linkedin->CurrentValue);
			$this->linkedin->PlaceHolder = RemoveHtml($this->linkedin->caption());

			// youtube
			$this->youtube->EditAttrs["class"] = "form-control";
			$this->youtube->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->youtube->CurrentValue = HtmlDecode($this->youtube->CurrentValue);
			$this->youtube->EditValue = HtmlEncode($this->youtube->CurrentValue);
			$this->youtube->PlaceHolder = RemoveHtml($this->youtube->caption());

			// instagram
			$this->instagram->EditAttrs["class"] = "form-control";
			$this->instagram->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->instagram->CurrentValue = HtmlDecode($this->instagram->CurrentValue);
			$this->instagram->EditValue = HtmlEncode($this->instagram->CurrentValue);
			$this->instagram->PlaceHolder = RemoveHtml($this->instagram->caption());

			// user_id
			$this->user_id->EditAttrs["class"] = "form-control";
			$this->user_id->EditCustomAttributes = "";

			// created_at
			$this->created_at->EditAttrs["class"] = "form-control";
			$this->created_at->EditCustomAttributes = "";
			$this->created_at->CurrentValue = FormatDateTime($this->created_at->CurrentValue, 8);

			// updated_at
			$this->updated_at->EditAttrs["class"] = "form-control";
			$this->updated_at->EditCustomAttributes = "";
			$this->updated_at->CurrentValue = FormatDateTime($this->updated_at->CurrentValue, 8);

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// title
			$this->title->LinkCustomAttributes = "";
			$this->title->HrefValue = "";

			// biography
			$this->biography->LinkCustomAttributes = "";
			$this->biography->HrefValue = "";

			// imagen
			$this->imagen->LinkCustomAttributes = "";
			$this->imagen->UploadPath = "phpimages/Profiles/";
			if (!EmptyValue($this->imagen->Upload->DbValue)) {
				$this->imagen->HrefValue = GetFileUploadUrl($this->imagen, $this->imagen->Upload->DbValue); // Add prefix/suffix
				$this->imagen->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->imagen->HrefValue = FullUrl($this->imagen->HrefValue, "href");
			} else {
				$this->imagen->HrefValue = "";
			}
			$this->imagen->ExportHrefValue = $this->imagen->UploadPath . $this->imagen->Upload->DbValue;

			// maps_iframe
			$this->maps_iframe->LinkCustomAttributes = "";
			$this->maps_iframe->HrefValue = "";

			// website
			$this->website->LinkCustomAttributes = "";
			$this->website->HrefValue = "";

			// facebook
			$this->facebook->LinkCustomAttributes = "";
			$this->facebook->HrefValue = "";

			// linkedin
			$this->linkedin->LinkCustomAttributes = "";
			$this->linkedin->HrefValue = "";

			// youtube
			$this->youtube->LinkCustomAttributes = "";
			$this->youtube->HrefValue = "";

			// instagram
			$this->instagram->LinkCustomAttributes = "";
			$this->instagram->HrefValue = "";

			// user_id
			$this->user_id->LinkCustomAttributes = "";
			$this->user_id->HrefValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";
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
		if ($this->id->Required) {
			if (!$this->id->IsDetailKey && $this->id->FormValue != NULL && $this->id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
			}
		}
		if ($this->title->Required) {
			if (!$this->title->IsDetailKey && $this->title->FormValue != NULL && $this->title->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->title->caption(), $this->title->RequiredErrorMessage));
			}
		}
		if ($this->biography->Required) {
			if (!$this->biography->IsDetailKey && $this->biography->FormValue != NULL && $this->biography->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->biography->caption(), $this->biography->RequiredErrorMessage));
			}
		}
		if ($this->imagen->Required) {
			if ($this->imagen->Upload->FileName == "" && !$this->imagen->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->imagen->caption(), $this->imagen->RequiredErrorMessage));
			}
		}
		if ($this->maps_iframe->Required) {
			if (!$this->maps_iframe->IsDetailKey && $this->maps_iframe->FormValue != NULL && $this->maps_iframe->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->maps_iframe->caption(), $this->maps_iframe->RequiredErrorMessage));
			}
		}
		if ($this->website->Required) {
			if (!$this->website->IsDetailKey && $this->website->FormValue != NULL && $this->website->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->website->caption(), $this->website->RequiredErrorMessage));
			}
		}
		if ($this->facebook->Required) {
			if (!$this->facebook->IsDetailKey && $this->facebook->FormValue != NULL && $this->facebook->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->facebook->caption(), $this->facebook->RequiredErrorMessage));
			}
		}
		if ($this->linkedin->Required) {
			if (!$this->linkedin->IsDetailKey && $this->linkedin->FormValue != NULL && $this->linkedin->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->linkedin->caption(), $this->linkedin->RequiredErrorMessage));
			}
		}
		if ($this->youtube->Required) {
			if (!$this->youtube->IsDetailKey && $this->youtube->FormValue != NULL && $this->youtube->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->youtube->caption(), $this->youtube->RequiredErrorMessage));
			}
		}
		if ($this->instagram->Required) {
			if (!$this->instagram->IsDetailKey && $this->instagram->FormValue != NULL && $this->instagram->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->instagram->caption(), $this->instagram->RequiredErrorMessage));
			}
		}
		if ($this->user_id->Required) {
			if (!$this->user_id->IsDetailKey && $this->user_id->FormValue != NULL && $this->user_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->user_id->caption(), $this->user_id->RequiredErrorMessage));
			}
		}
		if ($this->created_at->Required) {
			if (!$this->created_at->IsDetailKey && $this->created_at->FormValue != NULL && $this->created_at->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->created_at->caption(), $this->created_at->RequiredErrorMessage));
			}
		}
		if ($this->updated_at->Required) {
			if (!$this->updated_at->IsDetailKey && $this->updated_at->FormValue != NULL && $this->updated_at->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
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
			$this->imagen->OldUploadPath = "phpimages/Profiles/";
			$this->imagen->UploadPath = $this->imagen->OldUploadPath;
			$rsnew = [];

			// title
			$this->title->setDbValueDef($rsnew, $this->title->CurrentValue, NULL, $this->title->ReadOnly);

			// biography
			$this->biography->setDbValueDef($rsnew, $this->biography->CurrentValue, NULL, $this->biography->ReadOnly);

			// imagen
			if ($this->imagen->Visible && !$this->imagen->ReadOnly && !$this->imagen->Upload->KeepFile) {
				$this->imagen->Upload->DbValue = $rsold['imagen']; // Get original value
				if ($this->imagen->Upload->FileName == "") {
					$rsnew['imagen'] = NULL;
				} else {
					$rsnew['imagen'] = $this->imagen->Upload->FileName;
				}
				$this->imagen->ImageWidth = THUMBNAIL_DEFAULT_WIDTH; // Resize width
				$this->imagen->ImageHeight = THUMBNAIL_DEFAULT_HEIGHT; // Resize height
			}

			// maps_iframe
			$this->maps_iframe->setDbValueDef($rsnew, $this->maps_iframe->CurrentValue, "", $this->maps_iframe->ReadOnly);

			// website
			$this->website->setDbValueDef($rsnew, $this->website->CurrentValue, NULL, $this->website->ReadOnly);

			// facebook
			$this->facebook->setDbValueDef($rsnew, $this->facebook->CurrentValue, NULL, $this->facebook->ReadOnly);

			// linkedin
			$this->linkedin->setDbValueDef($rsnew, $this->linkedin->CurrentValue, NULL, $this->linkedin->ReadOnly);

			// youtube
			$this->youtube->setDbValueDef($rsnew, $this->youtube->CurrentValue, NULL, $this->youtube->ReadOnly);

			// instagram
			$this->instagram->setDbValueDef($rsnew, $this->instagram->CurrentValue, NULL, $this->instagram->ReadOnly);

			// user_id
			$this->user_id->setDbValueDef($rsnew, $this->user_id->CurrentValue, 0, $this->user_id->ReadOnly);

			// created_at
			$this->created_at->setDbValueDef($rsnew, UnFormatDateTime($this->created_at->CurrentValue, 0), NULL, $this->created_at->ReadOnly);

			// updated_at
			$this->updated_at->setDbValueDef($rsnew, UnFormatDateTime($this->updated_at->CurrentValue, 0), NULL, $this->updated_at->ReadOnly);
			if ($this->imagen->Visible && !$this->imagen->Upload->KeepFile) {
				$this->imagen->UploadPath = "phpimages/Profiles/";
				$oldFiles = EmptyValue($this->imagen->Upload->DbValue) ? array() : array($this->imagen->Upload->DbValue);
				if (!EmptyValue($this->imagen->Upload->FileName)) {
					$newFiles = array($this->imagen->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->imagen, $this->imagen->Upload->Index) . $file)) {
								if (DELETE_UPLOADED_FILES) {
									$oldFileFound = FALSE;
									$oldFileCount = count($oldFiles);
									for ($j = 0; $j < $oldFileCount; $j++) {
										$oldFile = $oldFiles[$j];
										if ($oldFile == $file) { // Old file found, no need to delete anymore
											unset($oldFiles[$j]);
											$oldFileFound = TRUE;
											break;
										}
									}
									if ($oldFileFound) // No need to check if file exists further
										continue;
								}
								$file1 = UniqueFilename($this->imagen->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->imagen, $this->imagen->Upload->Index) . $file1) || file_exists($this->imagen->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->imagen->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->imagen, $this->imagen->Upload->Index) . $file, UploadTempPath($this->imagen, $this->imagen->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->imagen->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->imagen->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->imagen->setDbValueDef($rsnew, $this->imagen->Upload->FileName, "", $this->imagen->ReadOnly);
				}
			}

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
					if ($this->imagen->Visible && !$this->imagen->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->imagen->Upload->DbValue) ? array() : array($this->imagen->Upload->DbValue);
						if (!EmptyValue($this->imagen->Upload->FileName)) {
							$newFiles = array($this->imagen->Upload->FileName);
							$newFiles2 = array($rsnew['imagen']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->imagen, $this->imagen->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->imagen->Upload->resizeAndSaveToFile($this->imagen->ImageWidth, $this->imagen->ImageHeight, THUMBNAIL_DEFAULT_QUALITY, $newFiles[$i], TRUE, $i)) {
											$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
											return FALSE;
										}
									}
								}
							}
						} else {
							$newFiles = array();
						}
						if (DELETE_UPLOADED_FILES) {
							foreach ($oldFiles as $oldFile) {
								if ($oldFile <> "" && !in_array($oldFile, $newFiles))
									@unlink($this->imagen->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
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

		// imagen
		if ($this->imagen->Upload->FileToken <> "")
			CleanUploadTempPath($this->imagen->Upload->FileToken, $this->imagen->Upload->Index);
		else
			CleanUploadTempPath($this->imagen, $this->imagen->Upload->Index);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("profileslist.php"), "", $this->TableVar, TRUE);
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