<?php
namespace PHPMaker2019\cmsweb;

/**
 * Page class
 */
class slidercm_edit extends slidercm
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{5ACD2586-5733-4EB1-9592-B819B3395C82}";

	// Table name
	public $TableName = 'slidercm';

	// Page object name
	public $PageObjName = "slidercm_edit";

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

		// Table object (slidercm)
		if (!isset($GLOBALS["slidercm"]) || get_class($GLOBALS["slidercm"]) == PROJECT_NAMESPACE . "slidercm") {
			$GLOBALS["slidercm"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["slidercm"];
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
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'slidercm');

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
		global $EXPORT, $slidercm;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($slidercm);
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
					if ($pageName == "slidercmview.php")
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
			$key .= @$ar['SlidercmID'];
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
			$this->SlidercmID->Visible = FALSE;
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
					$this->terminate(GetUrl("slidercmlist.php"));
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
		$this->SlidercmID->setVisibility();
		$this->Titulo->setVisibility();
		$this->Detalle->setVisibility();
		$this->Url_image->setVisibility();
		$this->Orden->setVisibility();
		$this->Estado->setVisibility();
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
			if ($CurrentForm->hasValue("x_SlidercmID")) {
				$this->SlidercmID->setFormValue($CurrentForm->getValue("x_SlidercmID"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("SlidercmID") !== NULL) {
				$this->SlidercmID->setQueryStringValue(Get("SlidercmID"));
				$loadByQuery = TRUE;
			} else {
				$this->SlidercmID->CurrentValue = NULL;
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
					$this->terminate("slidercmlist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "slidercmlist.php")
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
		$this->Url_image->Upload->Index = $CurrentForm->Index;
		$this->Url_image->Upload->uploadFile();
		$this->Url_image->CurrentValue = $this->Url_image->Upload->FileName;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'SlidercmID' first before field var 'x_SlidercmID'
		$val = $CurrentForm->hasValue("SlidercmID") ? $CurrentForm->getValue("SlidercmID") : $CurrentForm->getValue("x_SlidercmID");
		if (!$this->SlidercmID->IsDetailKey)
			$this->SlidercmID->setFormValue($val);

		// Check field name 'Titulo' first before field var 'x_Titulo'
		$val = $CurrentForm->hasValue("Titulo") ? $CurrentForm->getValue("Titulo") : $CurrentForm->getValue("x_Titulo");
		if (!$this->Titulo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Titulo->Visible = FALSE; // Disable update for API request
			else
				$this->Titulo->setFormValue($val);
		}

		// Check field name 'Detalle' first before field var 'x_Detalle'
		$val = $CurrentForm->hasValue("Detalle") ? $CurrentForm->getValue("Detalle") : $CurrentForm->getValue("x_Detalle");
		if (!$this->Detalle->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Detalle->Visible = FALSE; // Disable update for API request
			else
				$this->Detalle->setFormValue($val);
		}

		// Check field name 'Orden' first before field var 'x_Orden'
		$val = $CurrentForm->hasValue("Orden") ? $CurrentForm->getValue("Orden") : $CurrentForm->getValue("x_Orden");
		if (!$this->Orden->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Orden->Visible = FALSE; // Disable update for API request
			else
				$this->Orden->setFormValue($val);
		}

		// Check field name 'Estado' first before field var 'x_Estado'
		$val = $CurrentForm->hasValue("Estado") ? $CurrentForm->getValue("Estado") : $CurrentForm->getValue("x_Estado");
		if (!$this->Estado->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Estado->Visible = FALSE; // Disable update for API request
			else
				$this->Estado->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->SlidercmID->CurrentValue = $this->SlidercmID->FormValue;
		$this->Titulo->CurrentValue = $this->Titulo->FormValue;
		$this->Detalle->CurrentValue = $this->Detalle->FormValue;
		$this->Orden->CurrentValue = $this->Orden->FormValue;
		$this->Estado->CurrentValue = $this->Estado->FormValue;
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
		$this->SlidercmID->setDbValue($row['SlidercmID']);
		$this->Titulo->setDbValue($row['Titulo']);
		$this->Detalle->setDbValue($row['Detalle']);
		$this->Url_image->Upload->DbValue = $row['Url_image'];
		$this->Url_image->setDbValue($this->Url_image->Upload->DbValue);
		$this->Orden->setDbValue($row['Orden']);
		$this->Estado->setDbValue($row['Estado']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['SlidercmID'] = NULL;
		$row['Titulo'] = NULL;
		$row['Detalle'] = NULL;
		$row['Url_image'] = NULL;
		$row['Orden'] = NULL;
		$row['Estado'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("SlidercmID")) <> "")
			$this->SlidercmID->CurrentValue = $this->getKey("SlidercmID"); // SlidercmID
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
		// SlidercmID
		// Titulo
		// Detalle
		// Url_image
		// Orden
		// Estado

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// SlidercmID
			$this->SlidercmID->ViewValue = $this->SlidercmID->CurrentValue;
			$this->SlidercmID->ViewCustomAttributes = "";

			// Titulo
			$this->Titulo->ViewValue = $this->Titulo->CurrentValue;
			$this->Titulo->ViewCustomAttributes = "";

			// Detalle
			$this->Detalle->ViewValue = $this->Detalle->CurrentValue;
			$this->Detalle->ViewCustomAttributes = "";

			// Url_image
			$this->Url_image->UploadPath = "phpimages/Slider/";
			if (!EmptyValue($this->Url_image->Upload->DbValue)) {
				$this->Url_image->ImageWidth = 700;
				$this->Url_image->ImageHeight = 200;
				$this->Url_image->ImageAlt = $this->Url_image->alt();
				$this->Url_image->ViewValue = $this->Url_image->Upload->DbValue;
			} else {
				$this->Url_image->ViewValue = "";
			}
			$this->Url_image->ViewCustomAttributes = "";

			// Orden
			$this->Orden->ViewValue = $this->Orden->CurrentValue;
			$this->Orden->ViewValue = FormatNumber($this->Orden->ViewValue, 0, -2, -2, -2);
			$this->Orden->ViewCustomAttributes = "";

			// Estado
			$this->Estado->ViewValue = $this->Estado->CurrentValue;
			$this->Estado->ViewCustomAttributes = "";

			// SlidercmID
			$this->SlidercmID->LinkCustomAttributes = "";
			$this->SlidercmID->HrefValue = "";
			$this->SlidercmID->TooltipValue = "";

			// Titulo
			$this->Titulo->LinkCustomAttributes = "";
			$this->Titulo->HrefValue = "";
			$this->Titulo->TooltipValue = "";

			// Detalle
			$this->Detalle->LinkCustomAttributes = "";
			$this->Detalle->HrefValue = "";
			$this->Detalle->TooltipValue = "";

			// Url_image
			$this->Url_image->LinkCustomAttributes = "";
			$this->Url_image->UploadPath = "phpimages/Slider/";
			if (!EmptyValue($this->Url_image->Upload->DbValue)) {
				$this->Url_image->HrefValue = GetFileUploadUrl($this->Url_image, $this->Url_image->Upload->DbValue); // Add prefix/suffix
				$this->Url_image->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->Url_image->HrefValue = FullUrl($this->Url_image->HrefValue, "href");
			} else {
				$this->Url_image->HrefValue = "";
			}
			$this->Url_image->ExportHrefValue = $this->Url_image->UploadPath . $this->Url_image->Upload->DbValue;
			$this->Url_image->TooltipValue = "";
			if ($this->Url_image->UseColorbox) {
				if (EmptyValue($this->Url_image->TooltipValue))
					$this->Url_image->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->Url_image->LinkAttrs["data-rel"] = "slidercm_x_Url_image";
				AppendClass($this->Url_image->LinkAttrs["class"], "ew-lightbox");
			}

			// Orden
			$this->Orden->LinkCustomAttributes = "";
			$this->Orden->HrefValue = "";
			$this->Orden->TooltipValue = "";

			// Estado
			$this->Estado->LinkCustomAttributes = "";
			$this->Estado->HrefValue = "";
			$this->Estado->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// SlidercmID
			$this->SlidercmID->EditAttrs["class"] = "form-control";
			$this->SlidercmID->EditCustomAttributes = "";
			$this->SlidercmID->EditValue = $this->SlidercmID->CurrentValue;
			$this->SlidercmID->ViewCustomAttributes = "";

			// Titulo
			$this->Titulo->EditAttrs["class"] = "form-control";
			$this->Titulo->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Titulo->CurrentValue = HtmlDecode($this->Titulo->CurrentValue);
			$this->Titulo->EditValue = HtmlEncode($this->Titulo->CurrentValue);
			$this->Titulo->PlaceHolder = RemoveHtml($this->Titulo->caption());

			// Detalle
			$this->Detalle->EditAttrs["class"] = "form-control";
			$this->Detalle->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Detalle->CurrentValue = HtmlDecode($this->Detalle->CurrentValue);
			$this->Detalle->EditValue = HtmlEncode($this->Detalle->CurrentValue);
			$this->Detalle->PlaceHolder = RemoveHtml($this->Detalle->caption());

			// Url_image
			$this->Url_image->EditAttrs["class"] = "form-control";
			$this->Url_image->EditCustomAttributes = "";
			$this->Url_image->UploadPath = "phpimages/Slider/";
			if (!EmptyValue($this->Url_image->Upload->DbValue)) {
				$this->Url_image->ImageWidth = 700;
				$this->Url_image->ImageHeight = 200;
				$this->Url_image->ImageAlt = $this->Url_image->alt();
				$this->Url_image->EditValue = $this->Url_image->Upload->DbValue;
			} else {
				$this->Url_image->EditValue = "";
			}
			if (!EmptyValue($this->Url_image->CurrentValue))
					$this->Url_image->Upload->FileName = $this->Url_image->CurrentValue;
			if ($this->isShow() && !$this->EventCancelled)
				RenderUploadField($this->Url_image);

			// Orden
			$this->Orden->EditAttrs["class"] = "form-control";
			$this->Orden->EditCustomAttributes = "";
			$this->Orden->EditValue = HtmlEncode($this->Orden->CurrentValue);
			$this->Orden->PlaceHolder = RemoveHtml($this->Orden->caption());

			// Estado
			$this->Estado->EditAttrs["class"] = "form-control";
			$this->Estado->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Estado->CurrentValue = HtmlDecode($this->Estado->CurrentValue);
			$this->Estado->EditValue = HtmlEncode($this->Estado->CurrentValue);
			$this->Estado->PlaceHolder = RemoveHtml($this->Estado->caption());

			// Edit refer script
			// SlidercmID

			$this->SlidercmID->LinkCustomAttributes = "";
			$this->SlidercmID->HrefValue = "";

			// Titulo
			$this->Titulo->LinkCustomAttributes = "";
			$this->Titulo->HrefValue = "";

			// Detalle
			$this->Detalle->LinkCustomAttributes = "";
			$this->Detalle->HrefValue = "";

			// Url_image
			$this->Url_image->LinkCustomAttributes = "";
			$this->Url_image->UploadPath = "phpimages/Slider/";
			if (!EmptyValue($this->Url_image->Upload->DbValue)) {
				$this->Url_image->HrefValue = GetFileUploadUrl($this->Url_image, $this->Url_image->Upload->DbValue); // Add prefix/suffix
				$this->Url_image->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->Url_image->HrefValue = FullUrl($this->Url_image->HrefValue, "href");
			} else {
				$this->Url_image->HrefValue = "";
			}
			$this->Url_image->ExportHrefValue = $this->Url_image->UploadPath . $this->Url_image->Upload->DbValue;

			// Orden
			$this->Orden->LinkCustomAttributes = "";
			$this->Orden->HrefValue = "";

			// Estado
			$this->Estado->LinkCustomAttributes = "";
			$this->Estado->HrefValue = "";
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
		if ($this->SlidercmID->Required) {
			if (!$this->SlidercmID->IsDetailKey && $this->SlidercmID->FormValue != NULL && $this->SlidercmID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->SlidercmID->caption(), $this->SlidercmID->RequiredErrorMessage));
			}
		}
		if ($this->Titulo->Required) {
			if (!$this->Titulo->IsDetailKey && $this->Titulo->FormValue != NULL && $this->Titulo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Titulo->caption(), $this->Titulo->RequiredErrorMessage));
			}
		}
		if ($this->Detalle->Required) {
			if (!$this->Detalle->IsDetailKey && $this->Detalle->FormValue != NULL && $this->Detalle->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Detalle->caption(), $this->Detalle->RequiredErrorMessage));
			}
		}
		if ($this->Url_image->Required) {
			if ($this->Url_image->Upload->FileName == "" && !$this->Url_image->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->Url_image->caption(), $this->Url_image->RequiredErrorMessage));
			}
		}
		if ($this->Orden->Required) {
			if (!$this->Orden->IsDetailKey && $this->Orden->FormValue != NULL && $this->Orden->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Orden->caption(), $this->Orden->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->Orden->FormValue)) {
			AddMessage($FormError, $this->Orden->errorMessage());
		}
		if ($this->Estado->Required) {
			if (!$this->Estado->IsDetailKey && $this->Estado->FormValue != NULL && $this->Estado->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Estado->caption(), $this->Estado->RequiredErrorMessage));
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
			$this->Url_image->OldUploadPath = "phpimages/Slider/";
			$this->Url_image->UploadPath = $this->Url_image->OldUploadPath;
			$rsnew = [];

			// Titulo
			$this->Titulo->setDbValueDef($rsnew, $this->Titulo->CurrentValue, "", $this->Titulo->ReadOnly);

			// Detalle
			$this->Detalle->setDbValueDef($rsnew, $this->Detalle->CurrentValue, NULL, $this->Detalle->ReadOnly);

			// Url_image
			if ($this->Url_image->Visible && !$this->Url_image->ReadOnly && !$this->Url_image->Upload->KeepFile) {
				$this->Url_image->Upload->DbValue = $rsold['Url_image']; // Get original value
				if ($this->Url_image->Upload->FileName == "") {
					$rsnew['Url_image'] = NULL;
				} else {
					$rsnew['Url_image'] = $this->Url_image->Upload->FileName;
				}
				$this->Url_image->ImageWidth = 7000; // Resize width
				$this->Url_image->ImageHeight = 2800; // Resize height
			}

			// Orden
			$this->Orden->setDbValueDef($rsnew, $this->Orden->CurrentValue, 0, $this->Orden->ReadOnly);

			// Estado
			$this->Estado->setDbValueDef($rsnew, $this->Estado->CurrentValue, "", $this->Estado->ReadOnly);
			if ($this->Url_image->Visible && !$this->Url_image->Upload->KeepFile) {
				$this->Url_image->UploadPath = "phpimages/Slider/";
				$oldFiles = EmptyValue($this->Url_image->Upload->DbValue) ? array() : array($this->Url_image->Upload->DbValue);
				if (!EmptyValue($this->Url_image->Upload->FileName)) {
					$newFiles = array($this->Url_image->Upload->FileName);
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] <> "") {
							$file = $newFiles[$i];
							if (file_exists(UploadTempPath($this->Url_image, $this->Url_image->Upload->Index) . $file)) {
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
								$file1 = UniqueFilename($this->Url_image->physicalUploadPath(), $file); // Get new file name
								if ($file1 <> $file) { // Rename temp file
									while (file_exists(UploadTempPath($this->Url_image, $this->Url_image->Upload->Index) . $file1) || file_exists($this->Url_image->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->Url_image->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename(UploadTempPath($this->Url_image, $this->Url_image->Upload->Index) . $file, UploadTempPath($this->Url_image, $this->Url_image->Upload->Index) . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->Url_image->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
					$this->Url_image->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
					$this->Url_image->setDbValueDef($rsnew, $this->Url_image->Upload->FileName, "", $this->Url_image->ReadOnly);
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
					if ($this->Url_image->Visible && !$this->Url_image->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->Url_image->Upload->DbValue) ? array() : array($this->Url_image->Upload->DbValue);
						if (!EmptyValue($this->Url_image->Upload->FileName)) {
							$newFiles = array($this->Url_image->Upload->FileName);
							$newFiles2 = array($rsnew['Url_image']);
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] <> "") {
									$file = UploadTempPath($this->Url_image, $this->Url_image->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] <> "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->Url_image->Upload->resizeAndSaveToFile($this->Url_image->ImageWidth, $this->Url_image->ImageHeight, THUMBNAIL_DEFAULT_QUALITY, $newFiles[$i], TRUE, $i)) {
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
									@unlink($this->Url_image->oldPhysicalUploadPath() . $oldFile);
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

		// Url_image
		if ($this->Url_image->Upload->FileToken <> "")
			CleanUploadTempPath($this->Url_image->Upload->FileToken, $this->Url_image->Upload->Index);
		else
			CleanUploadTempPath($this->Url_image, $this->Url_image->Upload->Index);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("slidercmlist.php"), "", $this->TableVar, TRUE);
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