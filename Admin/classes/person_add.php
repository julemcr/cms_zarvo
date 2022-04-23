<?php
namespace PHPMaker2019\cmsweb;

/**
 * Page class
 */
class person_add extends person
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{5ACD2586-5733-4EB1-9592-B819B3395C82}";

	// Table name
	public $TableName = 'person';

	// Page object name
	public $PageObjName = "person_add";

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

		// Table object (person)
		if (!isset($GLOBALS["person"]) || get_class($GLOBALS["person"]) == PROJECT_NAMESPACE . "person") {
			$GLOBALS["person"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["person"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'person');

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
		global $EXPORT, $person;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($person);
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
					if ($pageName == "personview.php")
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
			$key .= @$ar['PersonID'];
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
			$this->PersonID->Visible = FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRec;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;
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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("personlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
				if (strval($Security->currentUserID()) == "") {
					$this->setFailureMessage(DeniedMessage()); // Set no permission
					$this->terminate(GetUrl("personlist.php"));
					return;
				}
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
		$this->PersonID->Visible = FALSE;
		$this->Sexo->setVisibility();
		$this->Name->setVisibility();
		$this->LastName->setVisibility();
		$this->BirthDate->setVisibility();
		$this->Country->setVisibility();
		$this->City->setVisibility();
		$this->Address->setVisibility();
		$this->PostalCode->setVisibility();
		$this->Phone->setVisibility();
		$this->_Email->setVisibility();
		$this->Photo->setVisibility();
		$this->Notes->setVisibility();
		$this->Facebook->setVisibility();
		$this->Instagram->setVisibility();
		$this->Linkedin->setVisibility();
		$this->Username->setVisibility();
		$this->Password->setVisibility();
		$this->UserLevel->setVisibility();
		$this->Profile->setVisibility();
		$this->Activated->setVisibility();
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
		$this->setupLookupOptions($this->Sexo);
		$this->setupLookupOptions($this->Country);
		$this->setupLookupOptions($this->UserLevel);

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("PersonID") !== NULL) {
				$this->PersonID->setQueryStringValue(Get("PersonID"));
				$this->setKey("PersonID", $this->PersonID->CurrentValue); // Set up key
			} else {
				$this->setKey("PersonID", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("personlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "personlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "personview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
		$this->Photo->Upload->Index = $CurrentForm->Index;
		$this->Photo->Upload->uploadFile();
		$this->Photo->CurrentValue = $this->Photo->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->PersonID->CurrentValue = NULL;
		$this->PersonID->OldValue = $this->PersonID->CurrentValue;
		$this->Sexo->CurrentValue = NULL;
		$this->Sexo->OldValue = $this->Sexo->CurrentValue;
		$this->Name->CurrentValue = NULL;
		$this->Name->OldValue = $this->Name->CurrentValue;
		$this->LastName->CurrentValue = NULL;
		$this->LastName->OldValue = $this->LastName->CurrentValue;
		$this->BirthDate->CurrentValue = NULL;
		$this->BirthDate->OldValue = $this->BirthDate->CurrentValue;
		$this->Country->CurrentValue = NULL;
		$this->Country->OldValue = $this->Country->CurrentValue;
		$this->City->CurrentValue = NULL;
		$this->City->OldValue = $this->City->CurrentValue;
		$this->Address->CurrentValue = NULL;
		$this->Address->OldValue = $this->Address->CurrentValue;
		$this->PostalCode->CurrentValue = NULL;
		$this->PostalCode->OldValue = $this->PostalCode->CurrentValue;
		$this->Phone->CurrentValue = NULL;
		$this->Phone->OldValue = $this->Phone->CurrentValue;
		$this->_Email->CurrentValue = NULL;
		$this->_Email->OldValue = $this->_Email->CurrentValue;
		$this->Photo->Upload->DbValue = NULL;
		$this->Photo->OldValue = $this->Photo->Upload->DbValue;
		$this->Photo->CurrentValue = NULL; // Clear file related field
		$this->Notes->CurrentValue = NULL;
		$this->Notes->OldValue = $this->Notes->CurrentValue;
		$this->Facebook->CurrentValue = NULL;
		$this->Facebook->OldValue = $this->Facebook->CurrentValue;
		$this->Instagram->CurrentValue = NULL;
		$this->Instagram->OldValue = $this->Instagram->CurrentValue;
		$this->Linkedin->CurrentValue = NULL;
		$this->Linkedin->OldValue = $this->Linkedin->CurrentValue;
		$this->Username->CurrentValue = NULL;
		$this->Username->OldValue = $this->Username->CurrentValue;
		$this->Password->CurrentValue = NULL;
		$this->Password->OldValue = $this->Password->CurrentValue;
		$this->UserLevel->CurrentValue = NULL;
		$this->UserLevel->OldValue = $this->UserLevel->CurrentValue;
		$this->Profile->CurrentValue = NULL;
		$this->Profile->OldValue = $this->Profile->CurrentValue;
		$this->Activated->CurrentValue = "N";
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'Sexo' first before field var 'x_Sexo'
		$val = $CurrentForm->hasValue("Sexo") ? $CurrentForm->getValue("Sexo") : $CurrentForm->getValue("x_Sexo");
		if (!$this->Sexo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Sexo->Visible = FALSE; // Disable update for API request
			else
				$this->Sexo->setFormValue($val);
		}

		// Check field name 'Name' first before field var 'x_Name'
		$val = $CurrentForm->hasValue("Name") ? $CurrentForm->getValue("Name") : $CurrentForm->getValue("x_Name");
		if (!$this->Name->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Name->Visible = FALSE; // Disable update for API request
			else
				$this->Name->setFormValue($val);
		}

		// Check field name 'LastName' first before field var 'x_LastName'
		$val = $CurrentForm->hasValue("LastName") ? $CurrentForm->getValue("LastName") : $CurrentForm->getValue("x_LastName");
		if (!$this->LastName->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->LastName->Visible = FALSE; // Disable update for API request
			else
				$this->LastName->setFormValue($val);
		}

		// Check field name 'BirthDate' first before field var 'x_BirthDate'
		$val = $CurrentForm->hasValue("BirthDate") ? $CurrentForm->getValue("BirthDate") : $CurrentForm->getValue("x_BirthDate");
		if (!$this->BirthDate->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->BirthDate->Visible = FALSE; // Disable update for API request
			else
				$this->BirthDate->setFormValue($val);
			$this->BirthDate->CurrentValue = UnFormatDateTime($this->BirthDate->CurrentValue, 0);
		}

		// Check field name 'Country' first before field var 'x_Country'
		$val = $CurrentForm->hasValue("Country") ? $CurrentForm->getValue("Country") : $CurrentForm->getValue("x_Country");
		if (!$this->Country->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Country->Visible = FALSE; // Disable update for API request
			else
				$this->Country->setFormValue($val);
		}

		// Check field name 'City' first before field var 'x_City'
		$val = $CurrentForm->hasValue("City") ? $CurrentForm->getValue("City") : $CurrentForm->getValue("x_City");
		if (!$this->City->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->City->Visible = FALSE; // Disable update for API request
			else
				$this->City->setFormValue($val);
		}

		// Check field name 'Address' first before field var 'x_Address'
		$val = $CurrentForm->hasValue("Address") ? $CurrentForm->getValue("Address") : $CurrentForm->getValue("x_Address");
		if (!$this->Address->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Address->Visible = FALSE; // Disable update for API request
			else
				$this->Address->setFormValue($val);
		}

		// Check field name 'PostalCode' first before field var 'x_PostalCode'
		$val = $CurrentForm->hasValue("PostalCode") ? $CurrentForm->getValue("PostalCode") : $CurrentForm->getValue("x_PostalCode");
		if (!$this->PostalCode->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->PostalCode->Visible = FALSE; // Disable update for API request
			else
				$this->PostalCode->setFormValue($val);
		}

		// Check field name 'Phone' first before field var 'x_Phone'
		$val = $CurrentForm->hasValue("Phone") ? $CurrentForm->getValue("Phone") : $CurrentForm->getValue("x_Phone");
		if (!$this->Phone->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Phone->Visible = FALSE; // Disable update for API request
			else
				$this->Phone->setFormValue($val);
		}

		// Check field name 'Email' first before field var 'x__Email'
		$val = $CurrentForm->hasValue("Email") ? $CurrentForm->getValue("Email") : $CurrentForm->getValue("x__Email");
		if (!$this->_Email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_Email->Visible = FALSE; // Disable update for API request
			else
				$this->_Email->setFormValue($val);
		}

		// Check field name 'Notes' first before field var 'x_Notes'
		$val = $CurrentForm->hasValue("Notes") ? $CurrentForm->getValue("Notes") : $CurrentForm->getValue("x_Notes");
		if (!$this->Notes->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Notes->Visible = FALSE; // Disable update for API request
			else
				$this->Notes->setFormValue($val);
		}

		// Check field name 'Facebook' first before field var 'x_Facebook'
		$val = $CurrentForm->hasValue("Facebook") ? $CurrentForm->getValue("Facebook") : $CurrentForm->getValue("x_Facebook");
		if (!$this->Facebook->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Facebook->Visible = FALSE; // Disable update for API request
			else
				$this->Facebook->setFormValue($val);
		}

		// Check field name 'Instagram' first before field var 'x_Instagram'
		$val = $CurrentForm->hasValue("Instagram") ? $CurrentForm->getValue("Instagram") : $CurrentForm->getValue("x_Instagram");
		if (!$this->Instagram->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Instagram->Visible = FALSE; // Disable update for API request
			else
				$this->Instagram->setFormValue($val);
		}

		// Check field name 'Linkedin' first before field var 'x_Linkedin'
		$val = $CurrentForm->hasValue("Linkedin") ? $CurrentForm->getValue("Linkedin") : $CurrentForm->getValue("x_Linkedin");
		if (!$this->Linkedin->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Linkedin->Visible = FALSE; // Disable update for API request
			else
				$this->Linkedin->setFormValue($val);
		}

		// Check field name 'Username' first before field var 'x_Username'
		$val = $CurrentForm->hasValue("Username") ? $CurrentForm->getValue("Username") : $CurrentForm->getValue("x_Username");
		if (!$this->Username->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Username->Visible = FALSE; // Disable update for API request
			else
				$this->Username->setFormValue($val);
		}

		// Check field name 'Password' first before field var 'x_Password'
		$val = $CurrentForm->hasValue("Password") ? $CurrentForm->getValue("Password") : $CurrentForm->getValue("x_Password");
		if (!$this->Password->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Password->Visible = FALSE; // Disable update for API request
			else
				$this->Password->setFormValue($val);
		}

		// Check field name 'UserLevel' first before field var 'x_UserLevel'
		$val = $CurrentForm->hasValue("UserLevel") ? $CurrentForm->getValue("UserLevel") : $CurrentForm->getValue("x_UserLevel");
		if (!$this->UserLevel->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->UserLevel->Visible = FALSE; // Disable update for API request
			else
				$this->UserLevel->setFormValue($val);
		}

		// Check field name 'Profile' first before field var 'x_Profile'
		$val = $CurrentForm->hasValue("Profile") ? $CurrentForm->getValue("Profile") : $CurrentForm->getValue("x_Profile");
		if (!$this->Profile->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Profile->Visible = FALSE; // Disable update for API request
			else
				$this->Profile->setFormValue($val);
		}

		// Check field name 'Activated' first before field var 'x_Activated'
		$val = $CurrentForm->hasValue("Activated") ? $CurrentForm->getValue("Activated") : $CurrentForm->getValue("x_Activated");
		if (!$this->Activated->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->Activated->Visible = FALSE; // Disable update for API request
			else
				$this->Activated->setFormValue($val);
		}

		// Check field name 'PersonID' first before field var 'x_PersonID'
		$val = $CurrentForm->hasValue("PersonID") ? $CurrentForm->getValue("PersonID") : $CurrentForm->getValue("x_PersonID");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->Sexo->CurrentValue = $this->Sexo->FormValue;
		$this->Name->CurrentValue = $this->Name->FormValue;
		$this->LastName->CurrentValue = $this->LastName->FormValue;
		$this->BirthDate->CurrentValue = $this->BirthDate->FormValue;
		$this->BirthDate->CurrentValue = UnFormatDateTime($this->BirthDate->CurrentValue, 0);
		$this->Country->CurrentValue = $this->Country->FormValue;
		$this->City->CurrentValue = $this->City->FormValue;
		$this->Address->CurrentValue = $this->Address->FormValue;
		$this->PostalCode->CurrentValue = $this->PostalCode->FormValue;
		$this->Phone->CurrentValue = $this->Phone->FormValue;
		$this->_Email->CurrentValue = $this->_Email->FormValue;
		$this->Notes->CurrentValue = $this->Notes->FormValue;
		$this->Facebook->CurrentValue = $this->Facebook->FormValue;
		$this->Instagram->CurrentValue = $this->Instagram->FormValue;
		$this->Linkedin->CurrentValue = $this->Linkedin->FormValue;
		$this->Username->CurrentValue = $this->Username->FormValue;
		$this->Password->CurrentValue = $this->Password->FormValue;
		$this->UserLevel->CurrentValue = $this->UserLevel->FormValue;
		$this->Profile->CurrentValue = $this->Profile->FormValue;
		$this->Activated->CurrentValue = $this->Activated->FormValue;
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

		// Check if valid User ID
		if ($res) {
			$res = $this->showOptionLink('add');
			if (!$res) {
				$userIdMsg = DeniedMessage();
				$this->setFailureMessage($userIdMsg);
			}
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
		$this->PersonID->setDbValue($row['PersonID']);
		$this->Sexo->setDbValue($row['Sexo']);
		$this->Name->setDbValue($row['Name']);
		$this->LastName->setDbValue($row['LastName']);
		$this->BirthDate->setDbValue($row['BirthDate']);
		$this->Country->setDbValue($row['Country']);
		$this->City->setDbValue($row['City']);
		$this->Address->setDbValue($row['Address']);
		$this->PostalCode->setDbValue($row['PostalCode']);
		$this->Phone->setDbValue($row['Phone']);
		$this->_Email->setDbValue($row['Email']);
		$this->Photo->Upload->DbValue = $row['Photo'];
		$this->Photo->setDbValue($this->Photo->Upload->DbValue);
		$this->Notes->setDbValue($row['Notes']);
		$this->Facebook->setDbValue($row['Facebook']);
		$this->Instagram->setDbValue($row['Instagram']);
		$this->Linkedin->setDbValue($row['Linkedin']);
		$this->Username->setDbValue($row['Username']);
		$this->Password->setDbValue($row['Password']);
		$this->UserLevel->setDbValue($row['UserLevel']);
		$this->Profile->setDbValue($row['Profile']);
		$this->Activated->setDbValue($row['Activated']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['PersonID'] = $this->PersonID->CurrentValue;
		$row['Sexo'] = $this->Sexo->CurrentValue;
		$row['Name'] = $this->Name->CurrentValue;
		$row['LastName'] = $this->LastName->CurrentValue;
		$row['BirthDate'] = $this->BirthDate->CurrentValue;
		$row['Country'] = $this->Country->CurrentValue;
		$row['City'] = $this->City->CurrentValue;
		$row['Address'] = $this->Address->CurrentValue;
		$row['PostalCode'] = $this->PostalCode->CurrentValue;
		$row['Phone'] = $this->Phone->CurrentValue;
		$row['Email'] = $this->_Email->CurrentValue;
		$row['Photo'] = $this->Photo->Upload->DbValue;
		$row['Notes'] = $this->Notes->CurrentValue;
		$row['Facebook'] = $this->Facebook->CurrentValue;
		$row['Instagram'] = $this->Instagram->CurrentValue;
		$row['Linkedin'] = $this->Linkedin->CurrentValue;
		$row['Username'] = $this->Username->CurrentValue;
		$row['Password'] = $this->Password->CurrentValue;
		$row['UserLevel'] = $this->UserLevel->CurrentValue;
		$row['Profile'] = $this->Profile->CurrentValue;
		$row['Activated'] = $this->Activated->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("PersonID")) <> "")
			$this->PersonID->CurrentValue = $this->getKey("PersonID"); // PersonID
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
		// PersonID
		// Sexo
		// Name
		// LastName
		// BirthDate
		// Country
		// City
		// Address
		// PostalCode
		// Phone
		// Email
		// Photo
		// Notes
		// Facebook
		// Instagram
		// Linkedin
		// Username
		// Password
		// UserLevel
		// Profile
		// Activated

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// PersonID
			$this->PersonID->ViewValue = $this->PersonID->CurrentValue;
			$this->PersonID->ViewCustomAttributes = "";

			// Sexo
			$curVal = strval($this->Sexo->CurrentValue);
			if ($curVal <> "") {
				$this->Sexo->ViewValue = $this->Sexo->lookupCacheOption($curVal);
				if ($this->Sexo->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Sexo`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Sexo->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->Sexo->ViewValue = $this->Sexo->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Sexo->ViewValue = $this->Sexo->CurrentValue;
					}
				}
			} else {
				$this->Sexo->ViewValue = NULL;
			}
			$this->Sexo->ViewCustomAttributes = "";

			// Name
			$this->Name->ViewValue = $this->Name->CurrentValue;
			$this->Name->ViewCustomAttributes = "";

			// LastName
			$this->LastName->ViewValue = $this->LastName->CurrentValue;
			$this->LastName->ViewCustomAttributes = "";

			// BirthDate
			$this->BirthDate->ViewValue = $this->BirthDate->CurrentValue;
			$this->BirthDate->ViewValue = FormatDateTime($this->BirthDate->ViewValue, 0);
			$this->BirthDate->ViewCustomAttributes = "";

			// Country
			$curVal = strval($this->Country->CurrentValue);
			if ($curVal <> "") {
				$this->Country->ViewValue = $this->Country->lookupCacheOption($curVal);
				if ($this->Country->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`Codigo`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->Country->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->Country->ViewValue = $this->Country->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->Country->ViewValue = $this->Country->CurrentValue;
					}
				}
			} else {
				$this->Country->ViewValue = NULL;
			}
			$this->Country->ViewCustomAttributes = "";

			// City
			$this->City->ViewValue = $this->City->CurrentValue;
			$this->City->ViewCustomAttributes = "";

			// Address
			$this->Address->ViewValue = $this->Address->CurrentValue;
			$this->Address->ViewCustomAttributes = "";

			// PostalCode
			$this->PostalCode->ViewValue = $this->PostalCode->CurrentValue;
			$this->PostalCode->ViewCustomAttributes = "";

			// Phone
			$this->Phone->ViewValue = $this->Phone->CurrentValue;
			$this->Phone->ViewCustomAttributes = "";

			// Email
			$this->_Email->ViewValue = $this->_Email->CurrentValue;
			$this->_Email->ViewCustomAttributes = "";

			// Photo
			$this->Photo->UploadPath = "phpimages/Persona/";
			if (!EmptyValue($this->Photo->Upload->DbValue)) {
				$this->Photo->ImageWidth = 55;
				$this->Photo->ImageHeight = 80;
				$this->Photo->ImageAlt = $this->Photo->alt();
				$this->Photo->ViewValue = $this->Photo->Upload->DbValue;
			} else {
				$this->Photo->ViewValue = "";
			}
			$this->Photo->ViewCustomAttributes = "";

			// Notes
			$this->Notes->ViewValue = $this->Notes->CurrentValue;
			$this->Notes->ViewCustomAttributes = "";

			// Facebook
			$this->Facebook->ViewValue = $this->Facebook->CurrentValue;
			$this->Facebook->ViewCustomAttributes = "";

			// Instagram
			$this->Instagram->ViewValue = $this->Instagram->CurrentValue;
			$this->Instagram->ViewCustomAttributes = "";

			// Linkedin
			$this->Linkedin->ViewValue = $this->Linkedin->CurrentValue;
			$this->Linkedin->ViewCustomAttributes = "";

			// Username
			$this->Username->ViewValue = $this->Username->CurrentValue;
			$this->Username->ViewCustomAttributes = "";

			// Password
			$this->Password->ViewValue = $Language->phrase("PasswordMask");
			$this->Password->ViewCustomAttributes = "";

			// UserLevel
			if ($Security->canAdmin()) { // System admin
			$curVal = strval($this->UserLevel->CurrentValue);
			if ($curVal <> "") {
				$this->UserLevel->ViewValue = $this->UserLevel->lookupCacheOption($curVal);
				if ($this->UserLevel->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`userlevelid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->UserLevel->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = array();
						$arwrk[1] = $rswrk->fields('df');
						$this->UserLevel->ViewValue = $this->UserLevel->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->UserLevel->ViewValue = $this->UserLevel->CurrentValue;
					}
				}
			} else {
				$this->UserLevel->ViewValue = NULL;
			}
			} else {
				$this->UserLevel->ViewValue = $Language->phrase("PasswordMask");
			}
			$this->UserLevel->ViewCustomAttributes = "";

			// Profile
			$this->Profile->ViewValue = $this->Profile->CurrentValue;
			$this->Profile->ViewCustomAttributes = "";

			// Activated
			if (ConvertToBool($this->Activated->CurrentValue)) {
				$this->Activated->ViewValue = $this->Activated->tagCaption(1) <> "" ? $this->Activated->tagCaption(1) : "Y";
			} else {
				$this->Activated->ViewValue = $this->Activated->tagCaption(2) <> "" ? $this->Activated->tagCaption(2) : "N";
			}
			$this->Activated->ViewCustomAttributes = "";

			// Sexo
			$this->Sexo->LinkCustomAttributes = "";
			$this->Sexo->HrefValue = "";
			$this->Sexo->TooltipValue = "";

			// Name
			$this->Name->LinkCustomAttributes = "";
			$this->Name->HrefValue = "";
			$this->Name->TooltipValue = "";

			// LastName
			$this->LastName->LinkCustomAttributes = "";
			$this->LastName->HrefValue = "";
			$this->LastName->TooltipValue = "";

			// BirthDate
			$this->BirthDate->LinkCustomAttributes = "";
			$this->BirthDate->HrefValue = "";
			$this->BirthDate->TooltipValue = "";

			// Country
			$this->Country->LinkCustomAttributes = "";
			$this->Country->HrefValue = "";
			$this->Country->TooltipValue = "";

			// City
			$this->City->LinkCustomAttributes = "";
			$this->City->HrefValue = "";
			$this->City->TooltipValue = "";

			// Address
			$this->Address->LinkCustomAttributes = "";
			$this->Address->HrefValue = "";
			$this->Address->TooltipValue = "";

			// PostalCode
			$this->PostalCode->LinkCustomAttributes = "";
			$this->PostalCode->HrefValue = "";
			$this->PostalCode->TooltipValue = "";

			// Phone
			$this->Phone->LinkCustomAttributes = "";
			$this->Phone->HrefValue = "";
			$this->Phone->TooltipValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";
			$this->_Email->TooltipValue = "";

			// Photo
			$this->Photo->LinkCustomAttributes = "";
			$this->Photo->UploadPath = "phpimages/Persona/";
			if (!EmptyValue($this->Photo->Upload->DbValue)) {
				$this->Photo->HrefValue = GetFileUploadUrl($this->Photo, $this->Photo->Upload->DbValue); // Add prefix/suffix
				$this->Photo->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->Photo->HrefValue = FullUrl($this->Photo->HrefValue, "href");
			} else {
				$this->Photo->HrefValue = "";
			}
			$this->Photo->ExportHrefValue = $this->Photo->UploadPath . $this->Photo->Upload->DbValue;
			$this->Photo->TooltipValue = "";
			if ($this->Photo->UseColorbox) {
				if (EmptyValue($this->Photo->TooltipValue))
					$this->Photo->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
				$this->Photo->LinkAttrs["data-rel"] = "person_x_Photo";
				AppendClass($this->Photo->LinkAttrs["class"], "ew-lightbox");
			}

			// Notes
			$this->Notes->LinkCustomAttributes = "";
			$this->Notes->HrefValue = "";
			$this->Notes->TooltipValue = "";

			// Facebook
			$this->Facebook->LinkCustomAttributes = "";
			$this->Facebook->HrefValue = "";
			$this->Facebook->TooltipValue = "";

			// Instagram
			$this->Instagram->LinkCustomAttributes = "";
			$this->Instagram->HrefValue = "";
			$this->Instagram->TooltipValue = "";

			// Linkedin
			$this->Linkedin->LinkCustomAttributes = "";
			$this->Linkedin->HrefValue = "";
			$this->Linkedin->TooltipValue = "";

			// Username
			$this->Username->LinkCustomAttributes = "";
			$this->Username->HrefValue = "";
			$this->Username->TooltipValue = "";

			// Password
			$this->Password->LinkCustomAttributes = "";
			$this->Password->HrefValue = "";
			$this->Password->TooltipValue = "";

			// UserLevel
			$this->UserLevel->LinkCustomAttributes = "";
			$this->UserLevel->HrefValue = "";
			$this->UserLevel->TooltipValue = "";

			// Profile
			$this->Profile->LinkCustomAttributes = "";
			$this->Profile->HrefValue = "";
			$this->Profile->TooltipValue = "";

			// Activated
			$this->Activated->LinkCustomAttributes = "";
			$this->Activated->HrefValue = "";
			$this->Activated->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// Sexo
			$this->Sexo->EditAttrs["class"] = "form-control";
			$this->Sexo->EditCustomAttributes = "";
			$curVal = trim(strval($this->Sexo->CurrentValue));
			if ($curVal <> "")
				$this->Sexo->ViewValue = $this->Sexo->lookupCacheOption($curVal);
			else
				$this->Sexo->ViewValue = $this->Sexo->Lookup !== NULL && is_array($this->Sexo->Lookup->Options) ? $curVal : NULL;
			if ($this->Sexo->ViewValue !== NULL) { // Load from cache
				$this->Sexo->EditValue = array_values($this->Sexo->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Sexo`" . SearchString("=", $this->Sexo->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Sexo->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->Sexo->EditValue = $arwrk;
			}

			// Name
			$this->Name->EditAttrs["class"] = "form-control";
			$this->Name->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Name->CurrentValue = HtmlDecode($this->Name->CurrentValue);
			$this->Name->EditValue = HtmlEncode($this->Name->CurrentValue);
			$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

			// LastName
			$this->LastName->EditAttrs["class"] = "form-control";
			$this->LastName->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->LastName->CurrentValue = HtmlDecode($this->LastName->CurrentValue);
			$this->LastName->EditValue = HtmlEncode($this->LastName->CurrentValue);
			$this->LastName->PlaceHolder = RemoveHtml($this->LastName->caption());

			// BirthDate
			$this->BirthDate->EditAttrs["class"] = "form-control";
			$this->BirthDate->EditCustomAttributes = "";
			$this->BirthDate->EditValue = HtmlEncode(FormatDateTime($this->BirthDate->CurrentValue, 8));
			$this->BirthDate->PlaceHolder = RemoveHtml($this->BirthDate->caption());

			// Country
			$this->Country->EditAttrs["class"] = "form-control";
			$this->Country->EditCustomAttributes = "";
			$curVal = trim(strval($this->Country->CurrentValue));
			if ($curVal <> "")
				$this->Country->ViewValue = $this->Country->lookupCacheOption($curVal);
			else
				$this->Country->ViewValue = $this->Country->Lookup !== NULL && is_array($this->Country->Lookup->Options) ? $curVal : NULL;
			if ($this->Country->ViewValue !== NULL) { // Load from cache
				$this->Country->EditValue = array_values($this->Country->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`Codigo`" . SearchString("=", $this->Country->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->Country->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->Country->EditValue = $arwrk;
			}

			// City
			$this->City->EditAttrs["class"] = "form-control";
			$this->City->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->City->CurrentValue = HtmlDecode($this->City->CurrentValue);
			$this->City->EditValue = HtmlEncode($this->City->CurrentValue);
			$this->City->PlaceHolder = RemoveHtml($this->City->caption());

			// Address
			$this->Address->EditAttrs["class"] = "form-control";
			$this->Address->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Address->CurrentValue = HtmlDecode($this->Address->CurrentValue);
			$this->Address->EditValue = HtmlEncode($this->Address->CurrentValue);
			$this->Address->PlaceHolder = RemoveHtml($this->Address->caption());

			// PostalCode
			$this->PostalCode->EditAttrs["class"] = "form-control";
			$this->PostalCode->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->PostalCode->CurrentValue = HtmlDecode($this->PostalCode->CurrentValue);
			$this->PostalCode->EditValue = HtmlEncode($this->PostalCode->CurrentValue);
			$this->PostalCode->PlaceHolder = RemoveHtml($this->PostalCode->caption());

			// Phone
			$this->Phone->EditAttrs["class"] = "form-control";
			$this->Phone->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Phone->CurrentValue = HtmlDecode($this->Phone->CurrentValue);
			$this->Phone->EditValue = HtmlEncode($this->Phone->CurrentValue);
			$this->Phone->PlaceHolder = RemoveHtml($this->Phone->caption());

			// Email
			$this->_Email->EditAttrs["class"] = "form-control";
			$this->_Email->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
			$this->_Email->EditValue = HtmlEncode($this->_Email->CurrentValue);
			$this->_Email->PlaceHolder = RemoveHtml($this->_Email->caption());

			// Photo
			$this->Photo->EditAttrs["class"] = "form-control";
			$this->Photo->EditCustomAttributes = "";
			$this->Photo->UploadPath = "phpimages/Persona/";
			if (!EmptyValue($this->Photo->Upload->DbValue)) {
				$this->Photo->ImageWidth = 55;
				$this->Photo->ImageHeight = 80;
				$this->Photo->ImageAlt = $this->Photo->alt();
				$this->Photo->EditValue = $this->Photo->Upload->DbValue;
			} else {
				$this->Photo->EditValue = "";
			}
			if (!EmptyValue($this->Photo->CurrentValue))
					$this->Photo->Upload->FileName = $this->Photo->CurrentValue;
			if (($this->isShow() || $this->isCopy()) && !$this->EventCancelled)
				RenderUploadField($this->Photo);

			// Notes
			$this->Notes->EditAttrs["class"] = "form-control";
			$this->Notes->EditCustomAttributes = "";
			$this->Notes->EditValue = HtmlEncode($this->Notes->CurrentValue);
			$this->Notes->PlaceHolder = RemoveHtml($this->Notes->caption());

			// Facebook
			$this->Facebook->EditAttrs["class"] = "form-control";
			$this->Facebook->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Facebook->CurrentValue = HtmlDecode($this->Facebook->CurrentValue);
			$this->Facebook->EditValue = HtmlEncode($this->Facebook->CurrentValue);
			$this->Facebook->PlaceHolder = RemoveHtml($this->Facebook->caption());

			// Instagram
			$this->Instagram->EditAttrs["class"] = "form-control";
			$this->Instagram->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Instagram->CurrentValue = HtmlDecode($this->Instagram->CurrentValue);
			$this->Instagram->EditValue = HtmlEncode($this->Instagram->CurrentValue);
			$this->Instagram->PlaceHolder = RemoveHtml($this->Instagram->caption());

			// Linkedin
			$this->Linkedin->EditAttrs["class"] = "form-control";
			$this->Linkedin->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Linkedin->CurrentValue = HtmlDecode($this->Linkedin->CurrentValue);
			$this->Linkedin->EditValue = HtmlEncode($this->Linkedin->CurrentValue);
			$this->Linkedin->PlaceHolder = RemoveHtml($this->Linkedin->caption());

			// Username
			$this->Username->EditAttrs["class"] = "form-control";
			$this->Username->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->Username->CurrentValue = HtmlDecode($this->Username->CurrentValue);
			$this->Username->EditValue = HtmlEncode($this->Username->CurrentValue);
			$this->Username->PlaceHolder = RemoveHtml($this->Username->caption());

			// Password
			$this->Password->EditAttrs["class"] = "form-control";
			$this->Password->EditCustomAttributes = "";
			$this->Password->EditValue = HtmlEncode($this->Password->CurrentValue);
			$this->Password->PlaceHolder = RemoveHtml($this->Password->caption());

			// UserLevel
			$this->UserLevel->EditAttrs["class"] = "form-control";
			$this->UserLevel->EditCustomAttributes = "";
			if (!$Security->canAdmin()) { // System admin
				$this->UserLevel->EditValue = $Language->phrase("PasswordMask");
			} else {
			$curVal = trim(strval($this->UserLevel->CurrentValue));
			if ($curVal <> "")
				$this->UserLevel->ViewValue = $this->UserLevel->lookupCacheOption($curVal);
			else
				$this->UserLevel->ViewValue = $this->UserLevel->Lookup !== NULL && is_array($this->UserLevel->Lookup->Options) ? $curVal : NULL;
			if ($this->UserLevel->ViewValue !== NULL) { // Load from cache
				$this->UserLevel->EditValue = array_values($this->UserLevel->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`userlevelid`" . SearchString("=", $this->UserLevel->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->UserLevel->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
				if ($rswrk) $rswrk->Close();
				$this->UserLevel->EditValue = $arwrk;
			}
			}

			// Profile
			$this->Profile->EditAttrs["class"] = "form-control";
			$this->Profile->EditCustomAttributes = "";
			$this->Profile->EditValue = HtmlEncode($this->Profile->CurrentValue);
			$this->Profile->PlaceHolder = RemoveHtml($this->Profile->caption());

			// Activated
			$this->Activated->EditCustomAttributes = "";
			$this->Activated->EditValue = $this->Activated->options(FALSE);

			// Add refer script
			// Sexo

			$this->Sexo->LinkCustomAttributes = "";
			$this->Sexo->HrefValue = "";

			// Name
			$this->Name->LinkCustomAttributes = "";
			$this->Name->HrefValue = "";

			// LastName
			$this->LastName->LinkCustomAttributes = "";
			$this->LastName->HrefValue = "";

			// BirthDate
			$this->BirthDate->LinkCustomAttributes = "";
			$this->BirthDate->HrefValue = "";

			// Country
			$this->Country->LinkCustomAttributes = "";
			$this->Country->HrefValue = "";

			// City
			$this->City->LinkCustomAttributes = "";
			$this->City->HrefValue = "";

			// Address
			$this->Address->LinkCustomAttributes = "";
			$this->Address->HrefValue = "";

			// PostalCode
			$this->PostalCode->LinkCustomAttributes = "";
			$this->PostalCode->HrefValue = "";

			// Phone
			$this->Phone->LinkCustomAttributes = "";
			$this->Phone->HrefValue = "";

			// Email
			$this->_Email->LinkCustomAttributes = "";
			$this->_Email->HrefValue = "";

			// Photo
			$this->Photo->LinkCustomAttributes = "";
			$this->Photo->UploadPath = "phpimages/Persona/";
			if (!EmptyValue($this->Photo->Upload->DbValue)) {
				$this->Photo->HrefValue = GetFileUploadUrl($this->Photo, $this->Photo->Upload->DbValue); // Add prefix/suffix
				$this->Photo->LinkAttrs["target"] = ""; // Add target
				if ($this->isExport()) $this->Photo->HrefValue = FullUrl($this->Photo->HrefValue, "href");
			} else {
				$this->Photo->HrefValue = "";
			}
			$this->Photo->ExportHrefValue = $this->Photo->UploadPath . $this->Photo->Upload->DbValue;

			// Notes
			$this->Notes->LinkCustomAttributes = "";
			$this->Notes->HrefValue = "";

			// Facebook
			$this->Facebook->LinkCustomAttributes = "";
			$this->Facebook->HrefValue = "";

			// Instagram
			$this->Instagram->LinkCustomAttributes = "";
			$this->Instagram->HrefValue = "";

			// Linkedin
			$this->Linkedin->LinkCustomAttributes = "";
			$this->Linkedin->HrefValue = "";

			// Username
			$this->Username->LinkCustomAttributes = "";
			$this->Username->HrefValue = "";

			// Password
			$this->Password->LinkCustomAttributes = "";
			$this->Password->HrefValue = "";

			// UserLevel
			$this->UserLevel->LinkCustomAttributes = "";
			$this->UserLevel->HrefValue = "";

			// Profile
			$this->Profile->LinkCustomAttributes = "";
			$this->Profile->HrefValue = "";

			// Activated
			$this->Activated->LinkCustomAttributes = "";
			$this->Activated->HrefValue = "";
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
		if ($this->PersonID->Required) {
			if (!$this->PersonID->IsDetailKey && $this->PersonID->FormValue != NULL && $this->PersonID->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PersonID->caption(), $this->PersonID->RequiredErrorMessage));
			}
		}
		if ($this->Sexo->Required) {
			if (!$this->Sexo->IsDetailKey && $this->Sexo->FormValue != NULL && $this->Sexo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Sexo->caption(), $this->Sexo->RequiredErrorMessage));
			}
		}
		if ($this->Name->Required) {
			if (!$this->Name->IsDetailKey && $this->Name->FormValue != NULL && $this->Name->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Name->caption(), $this->Name->RequiredErrorMessage));
			}
		}
		if ($this->LastName->Required) {
			if (!$this->LastName->IsDetailKey && $this->LastName->FormValue != NULL && $this->LastName->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->LastName->caption(), $this->LastName->RequiredErrorMessage));
			}
		}
		if ($this->BirthDate->Required) {
			if (!$this->BirthDate->IsDetailKey && $this->BirthDate->FormValue != NULL && $this->BirthDate->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->BirthDate->caption(), $this->BirthDate->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->BirthDate->FormValue)) {
			AddMessage($FormError, $this->BirthDate->errorMessage());
		}
		if ($this->Country->Required) {
			if (!$this->Country->IsDetailKey && $this->Country->FormValue != NULL && $this->Country->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Country->caption(), $this->Country->RequiredErrorMessage));
			}
		}
		if ($this->City->Required) {
			if (!$this->City->IsDetailKey && $this->City->FormValue != NULL && $this->City->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->City->caption(), $this->City->RequiredErrorMessage));
			}
		}
		if ($this->Address->Required) {
			if (!$this->Address->IsDetailKey && $this->Address->FormValue != NULL && $this->Address->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Address->caption(), $this->Address->RequiredErrorMessage));
			}
		}
		if ($this->PostalCode->Required) {
			if (!$this->PostalCode->IsDetailKey && $this->PostalCode->FormValue != NULL && $this->PostalCode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->PostalCode->caption(), $this->PostalCode->RequiredErrorMessage));
			}
		}
		if ($this->Phone->Required) {
			if (!$this->Phone->IsDetailKey && $this->Phone->FormValue != NULL && $this->Phone->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Phone->caption(), $this->Phone->RequiredErrorMessage));
			}
		}
		if ($this->_Email->Required) {
			if (!$this->_Email->IsDetailKey && $this->_Email->FormValue != NULL && $this->_Email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_Email->caption(), $this->_Email->RequiredErrorMessage));
			}
		}
		if ($this->Photo->Required) {
			if ($this->Photo->Upload->FileName == "" && !$this->Photo->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->Photo->caption(), $this->Photo->RequiredErrorMessage));
			}
		}
		if ($this->Notes->Required) {
			if (!$this->Notes->IsDetailKey && $this->Notes->FormValue != NULL && $this->Notes->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Notes->caption(), $this->Notes->RequiredErrorMessage));
			}
		}
		if ($this->Facebook->Required) {
			if (!$this->Facebook->IsDetailKey && $this->Facebook->FormValue != NULL && $this->Facebook->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Facebook->caption(), $this->Facebook->RequiredErrorMessage));
			}
		}
		if ($this->Instagram->Required) {
			if (!$this->Instagram->IsDetailKey && $this->Instagram->FormValue != NULL && $this->Instagram->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Instagram->caption(), $this->Instagram->RequiredErrorMessage));
			}
		}
		if ($this->Linkedin->Required) {
			if (!$this->Linkedin->IsDetailKey && $this->Linkedin->FormValue != NULL && $this->Linkedin->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Linkedin->caption(), $this->Linkedin->RequiredErrorMessage));
			}
		}
		if ($this->Username->Required) {
			if (!$this->Username->IsDetailKey && $this->Username->FormValue != NULL && $this->Username->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Username->caption(), $this->Username->RequiredErrorMessage));
			}
		}
		if ($this->Password->Required) {
			if (!$this->Password->IsDetailKey && $this->Password->FormValue != NULL && $this->Password->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Password->caption(), $this->Password->RequiredErrorMessage));
			}
		}
		if ($this->UserLevel->Required) {
			if (!$this->UserLevel->IsDetailKey && $this->UserLevel->FormValue != NULL && $this->UserLevel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->UserLevel->caption(), $this->UserLevel->RequiredErrorMessage));
			}
		}
		if ($this->Profile->Required) {
			if (!$this->Profile->IsDetailKey && $this->Profile->FormValue != NULL && $this->Profile->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Profile->caption(), $this->Profile->RequiredErrorMessage));
			}
		}
		if ($this->Activated->Required) {
			if ($this->Activated->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->Activated->caption(), $this->Activated->RequiredErrorMessage));
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Check if valid User ID
		$validUser = FALSE;
		if ($Security->currentUserID() <> "" && !EmptyValue($this->PersonID->CurrentValue) && !$Security->isAdmin()) { // Non system admin
			$validUser = $Security->isValidUserID($this->PersonID->CurrentValue);
			if (!$validUser) {
				$userIdMsg = str_replace("%c", CurrentUserID(), $Language->phrase("UnAuthorizedUserID"));
				$userIdMsg = str_replace("%u", $this->PersonID->CurrentValue, $userIdMsg);
				$this->setFailureMessage($userIdMsg);
				return FALSE;
			}
		}
		if ($this->_Email->CurrentValue <> "") { // Check field with unique index
			$filter = "(Email = '" . AdjustSql($this->_Email->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->_Email->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->_Email->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
		}
		if ($this->Username->CurrentValue <> "") { // Check field with unique index
			$filter = "(Username = '" . AdjustSql($this->Username->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->Username->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->Username->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
		}
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
			$this->Photo->OldUploadPath = "phpimages/Persona/";
			$this->Photo->UploadPath = $this->Photo->OldUploadPath;
		}
		$rsnew = [];

		// Sexo
		$this->Sexo->setDbValueDef($rsnew, $this->Sexo->CurrentValue, NULL, FALSE);

		// Name
		$this->Name->setDbValueDef($rsnew, $this->Name->CurrentValue, NULL, FALSE);

		// LastName
		$this->LastName->setDbValueDef($rsnew, $this->LastName->CurrentValue, NULL, FALSE);

		// BirthDate
		$this->BirthDate->setDbValueDef($rsnew, UnFormatDateTime($this->BirthDate->CurrentValue, 0), NULL, FALSE);

		// Country
		$this->Country->setDbValueDef($rsnew, $this->Country->CurrentValue, NULL, FALSE);

		// City
		$this->City->setDbValueDef($rsnew, $this->City->CurrentValue, NULL, FALSE);

		// Address
		$this->Address->setDbValueDef($rsnew, $this->Address->CurrentValue, NULL, FALSE);

		// PostalCode
		$this->PostalCode->setDbValueDef($rsnew, $this->PostalCode->CurrentValue, NULL, FALSE);

		// Phone
		$this->Phone->setDbValueDef($rsnew, $this->Phone->CurrentValue, NULL, FALSE);

		// Email
		$this->_Email->setDbValueDef($rsnew, $this->_Email->CurrentValue, NULL, FALSE);

		// Photo
		if ($this->Photo->Visible && !$this->Photo->Upload->KeepFile) {
			$this->Photo->Upload->DbValue = ""; // No need to delete old file
			if ($this->Photo->Upload->FileName == "") {
				$rsnew['Photo'] = NULL;
			} else {
				$rsnew['Photo'] = $this->Photo->Upload->FileName;
			}
			$this->Photo->ImageWidth = THUMBNAIL_DEFAULT_WIDTH; // Resize width
			$this->Photo->ImageHeight = THUMBNAIL_DEFAULT_HEIGHT; // Resize height
		}

		// Notes
		$this->Notes->setDbValueDef($rsnew, $this->Notes->CurrentValue, NULL, FALSE);

		// Facebook
		$this->Facebook->setDbValueDef($rsnew, $this->Facebook->CurrentValue, NULL, FALSE);

		// Instagram
		$this->Instagram->setDbValueDef($rsnew, $this->Instagram->CurrentValue, NULL, FALSE);

		// Linkedin
		$this->Linkedin->setDbValueDef($rsnew, $this->Linkedin->CurrentValue, NULL, FALSE);

		// Username
		$this->Username->setDbValueDef($rsnew, $this->Username->CurrentValue, "", FALSE);

		// Password
		$this->Password->setDbValueDef($rsnew, $this->Password->CurrentValue, "", FALSE);

		// UserLevel
		if ($Security->canAdmin()) { // System admin
			$this->UserLevel->setDbValueDef($rsnew, $this->UserLevel->CurrentValue, NULL, FALSE);
		}

		// Profile
		$this->Profile->setDbValueDef($rsnew, $this->Profile->CurrentValue, NULL, FALSE);

		// Activated
		$tmpBool = $this->Activated->CurrentValue;
		if ($tmpBool <> "Y" && $tmpBool <> "N")
			$tmpBool = !empty($tmpBool) ? "Y" : "N";
		$this->Activated->setDbValueDef($rsnew, $tmpBool, "N", strval($this->Activated->CurrentValue) == "");

		// PersonID
		if ($this->Photo->Visible && !$this->Photo->Upload->KeepFile) {
			$this->Photo->UploadPath = "phpimages/Persona/";
			$oldFiles = EmptyValue($this->Photo->Upload->DbValue) ? array() : array($this->Photo->Upload->DbValue);
			if (!EmptyValue($this->Photo->Upload->FileName)) {
				$newFiles = array($this->Photo->Upload->FileName);
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] <> "") {
						$file = $newFiles[$i];
						if (file_exists(UploadTempPath($this->Photo, $this->Photo->Upload->Index) . $file)) {
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
							$file1 = UniqueFilename($this->Photo->physicalUploadPath(), $file); // Get new file name
							if ($file1 <> $file) { // Rename temp file
								while (file_exists(UploadTempPath($this->Photo, $this->Photo->Upload->Index) . $file1) || file_exists($this->Photo->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->Photo->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename(UploadTempPath($this->Photo, $this->Photo->Upload->Index) . $file, UploadTempPath($this->Photo, $this->Photo->Upload->Index) . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->Photo->Upload->DbValue = empty($oldFiles) ? "" : implode(MULTIPLE_UPLOAD_SEPARATOR, $oldFiles);
				$this->Photo->Upload->FileName = implode(MULTIPLE_UPLOAD_SEPARATOR, $newFiles);
				$this->Photo->setDbValueDef($rsnew, $this->Photo->Upload->FileName, NULL, FALSE);
			}
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
				if ($this->Photo->Visible && !$this->Photo->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->Photo->Upload->DbValue) ? array() : array($this->Photo->Upload->DbValue);
					if (!EmptyValue($this->Photo->Upload->FileName)) {
						$newFiles = array($this->Photo->Upload->FileName);
						$newFiles2 = array($rsnew['Photo']);
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] <> "") {
								$file = UploadTempPath($this->Photo, $this->Photo->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] <> "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->Photo->Upload->resizeAndSaveToFile($this->Photo->ImageWidth, $this->Photo->ImageHeight, THUMBNAIL_DEFAULT_QUALITY, $newFiles[$i], TRUE, $i)) {
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
								@unlink($this->Photo->oldPhysicalUploadPath() . $oldFile);
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
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Photo
		if ($this->Photo->Upload->FileToken <> "")
			CleanUploadTempPath($this->Photo->Upload->FileToken, $this->Photo->Upload->Index);
		else
			CleanUploadTempPath($this->Photo, $this->Photo->Upload->Index);

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Show link optionally based on User ID
	protected function showOptionLink($id = "")
	{
		global $Security;
		if ($Security->isLoggedIn() && !$Security->isAdmin() && !$this->userIDAllow($id))
			return $Security->isValidUserID($this->PersonID->CurrentValue);
		return TRUE;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("personlist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
		$pages->add(5);
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
						case "x_Sexo":
							break;
						case "x_Country":
							break;
						case "x_UserLevel":
							break;
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