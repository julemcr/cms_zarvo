<?php
namespace PHPMaker2019\cmsweb;

/**
 * Table class for person
 */
class person extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $PersonID;
	public $Sexo;
	public $Name;
	public $LastName;
	public $BirthDate;
	public $Country;
	public $City;
	public $Address;
	public $PostalCode;
	public $Phone;
	public $_Email;
	public $Photo;
	public $Notes;
	public $Facebook;
	public $Instagram;
	public $Linkedin;
	public $Username;
	public $Password;
	public $UserLevel;
	public $Profile;
	public $Activated;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'person';
		$this->TableName = 'person';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`person`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// PersonID
		$this->PersonID = new DbField('person', 'person', 'x_PersonID', 'PersonID', '`PersonID`', '`PersonID`', 21, -1, FALSE, '`PersonID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->PersonID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->PersonID->IsPrimaryKey = TRUE; // Primary key field
		$this->PersonID->Sortable = TRUE; // Allow sort
		$this->PersonID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['PersonID'] = &$this->PersonID;

		// Sexo
		$this->Sexo = new DbField('person', 'person', 'x_Sexo', 'Sexo', '`Sexo`', '`Sexo`', 200, -1, FALSE, '`Sexo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Sexo->Sortable = TRUE; // Allow sort
		$this->Sexo->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Sexo->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->Sexo->Lookup = new Lookup('Sexo', 'sexo', FALSE, 'Sexo', ["Sexo","","",""], [], [], [], [], [], [], '', '');
		$this->fields['Sexo'] = &$this->Sexo;

		// Name
		$this->Name = new DbField('person', 'person', 'x_Name', 'Name', '`Name`', '`Name`', 200, -1, FALSE, '`Name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Name->Sortable = TRUE; // Allow sort
		$this->fields['Name'] = &$this->Name;

		// LastName
		$this->LastName = new DbField('person', 'person', 'x_LastName', 'LastName', '`LastName`', '`LastName`', 200, -1, FALSE, '`LastName`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->LastName->Sortable = TRUE; // Allow sort
		$this->fields['LastName'] = &$this->LastName;

		// BirthDate
		$this->BirthDate = new DbField('person', 'person', 'x_BirthDate', 'BirthDate', '`BirthDate`', CastDateFieldForLike('`BirthDate`', 0, "DB"), 135, 0, FALSE, '`BirthDate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->BirthDate->Sortable = TRUE; // Allow sort
		$this->BirthDate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['BirthDate'] = &$this->BirthDate;

		// Country
		$this->Country = new DbField('person', 'person', 'x_Country', 'Country', '`Country`', '`Country`', 200, -1, FALSE, '`Country`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Country->Sortable = TRUE; // Allow sort
		$this->Country->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Country->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->Country->Lookup = new Lookup('Country', 'paises', FALSE, 'Codigo', ["Pais","","",""], [], [], [], [], [], [], '', '');
		$this->fields['Country'] = &$this->Country;

		// City
		$this->City = new DbField('person', 'person', 'x_City', 'City', '`City`', '`City`', 200, -1, FALSE, '`City`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->City->Sortable = TRUE; // Allow sort
		$this->fields['City'] = &$this->City;

		// Address
		$this->Address = new DbField('person', 'person', 'x_Address', 'Address', '`Address`', '`Address`', 200, -1, FALSE, '`Address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Address->Sortable = TRUE; // Allow sort
		$this->fields['Address'] = &$this->Address;

		// PostalCode
		$this->PostalCode = new DbField('person', 'person', 'x_PostalCode', 'PostalCode', '`PostalCode`', '`PostalCode`', 200, -1, FALSE, '`PostalCode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->PostalCode->Sortable = TRUE; // Allow sort
		$this->fields['PostalCode'] = &$this->PostalCode;

		// Phone
		$this->Phone = new DbField('person', 'person', 'x_Phone', 'Phone', '`Phone`', '`Phone`', 200, -1, FALSE, '`Phone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Phone->Sortable = TRUE; // Allow sort
		$this->fields['Phone'] = &$this->Phone;

		// Email
		$this->_Email = new DbField('person', 'person', 'x__Email', 'Email', '`Email`', '`Email`', 200, -1, FALSE, '`Email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_Email->Sortable = TRUE; // Allow sort
		$this->fields['Email'] = &$this->_Email;

		// Photo
		$this->Photo = new DbField('person', 'person', 'x_Photo', 'Photo', '`Photo`', '`Photo`', 200, -1, TRUE, '`Photo`', FALSE, FALSE, FALSE, 'IMAGE', 'FILE');
		$this->Photo->Sortable = TRUE; // Allow sort
		$this->fields['Photo'] = &$this->Photo;

		// Notes
		$this->Notes = new DbField('person', 'person', 'x_Notes', 'Notes', '`Notes`', '`Notes`', 201, -1, FALSE, '`Notes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Notes->Sortable = TRUE; // Allow sort
		$this->fields['Notes'] = &$this->Notes;

		// Facebook
		$this->Facebook = new DbField('person', 'person', 'x_Facebook', 'Facebook', '`Facebook`', '`Facebook`', 200, -1, FALSE, '`Facebook`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Facebook->Sortable = TRUE; // Allow sort
		$this->fields['Facebook'] = &$this->Facebook;

		// Instagram
		$this->Instagram = new DbField('person', 'person', 'x_Instagram', 'Instagram', '`Instagram`', '`Instagram`', 200, -1, FALSE, '`Instagram`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Instagram->Sortable = TRUE; // Allow sort
		$this->fields['Instagram'] = &$this->Instagram;

		// Linkedin
		$this->Linkedin = new DbField('person', 'person', 'x_Linkedin', 'Linkedin', '`Linkedin`', '`Linkedin`', 200, -1, FALSE, '`Linkedin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Linkedin->Sortable = TRUE; // Allow sort
		$this->fields['Linkedin'] = &$this->Linkedin;

		// Username
		$this->Username = new DbField('person', 'person', 'x_Username', 'Username', '`Username`', '`Username`', 200, -1, FALSE, '`Username`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Username->Nullable = FALSE; // NOT NULL field
		$this->Username->Required = TRUE; // Required field
		$this->Username->Sortable = TRUE; // Allow sort
		$this->fields['Username'] = &$this->Username;

		// Password
		$this->Password = new DbField('person', 'person', 'x_Password', 'Password', '`Password`', '`Password`', 200, -1, FALSE, '`Password`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'PASSWORD');
		$this->Password->Nullable = FALSE; // NOT NULL field
		$this->Password->Required = TRUE; // Required field
		$this->Password->Sortable = TRUE; // Allow sort
		$this->fields['Password'] = &$this->Password;

		// UserLevel
		$this->UserLevel = new DbField('person', 'person', 'x_UserLevel', 'UserLevel', '`UserLevel`', '`UserLevel`', 3, -1, FALSE, '`UserLevel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->UserLevel->Sortable = TRUE; // Allow sort
		$this->UserLevel->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->UserLevel->PleaseSelectText = $Language->phrase("PleaseSelect"); // PleaseSelect text
		$this->UserLevel->Lookup = new Lookup('UserLevel', 'userlevels', FALSE, 'userlevelid', ["userlevelname","","",""], [], [], [], [], [], [], '', '');
		$this->UserLevel->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['UserLevel'] = &$this->UserLevel;

		// Profile
		$this->Profile = new DbField('person', 'person', 'x_Profile', 'Profile', '`Profile`', '`Profile`', 201, -1, FALSE, '`Profile`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->Profile->Sortable = TRUE; // Allow sort
		$this->fields['Profile'] = &$this->Profile;

		// Activated
		$this->Activated = new DbField('person', 'person', 'x_Activated', 'Activated', '`Activated`', '`Activated`', 202, -1, FALSE, '`Activated`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->Activated->Nullable = FALSE; // NOT NULL field
		$this->Activated->Sortable = TRUE; // Allow sort
		$this->Activated->DataType = DATATYPE_BOOLEAN;
		$this->Activated->TrueValue = 'Y';
		$this->Activated->FalseValue = 'N';
		$this->Activated->Lookup = new Lookup('Activated', 'person', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->Activated->OptionCount = 2;
		$this->fields['Activated'] = &$this->Activated;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`person`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect <> "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere <> "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy <> "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving <> "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "`PersonID` DESC";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter)
	{
		global $Security;

		// Add User ID filter
		if ($Security->currentUserID() <> "" && !$Security->isAdmin()) { // Non system admin
			$filter = $this->addUserIDFilter($filter);
		}
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count
	public function getRecordCount($sql)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery and SELECT DISTINCT
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) && !preg_match('/^\s*select\s+distinct\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = &$this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			if (ENCRYPTED_PASSWORD && $name == 'Password')
				$value = (CASE_SENSITIVE_PASSWORD) ? EncryptPassword($value) : EncryptPassword(strtolower($value));
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->PersonID->setDbValue($conn->insert_ID());
			$rs['PersonID'] = $this->PersonID->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsPrimaryKey)
				continue;
			if (ENCRYPTED_PASSWORD && $name == 'Password') {
				if ($value == $this->fields[$name]->OldValue) // No need to update hashed password if not changed
					continue;
				$value = (CASE_SENSITIVE_PASSWORD) ? EncryptPassword($value) : EncryptPassword(strtolower($value));
			}
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = &$this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('PersonID', $rs))
				AddFilter($where, QuotedName('PersonID', $this->Dbid) . '=' . QuotedValue($rs['PersonID'], $this->PersonID->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = &$this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->PersonID->DbValue = $row['PersonID'];
		$this->Sexo->DbValue = $row['Sexo'];
		$this->Name->DbValue = $row['Name'];
		$this->LastName->DbValue = $row['LastName'];
		$this->BirthDate->DbValue = $row['BirthDate'];
		$this->Country->DbValue = $row['Country'];
		$this->City->DbValue = $row['City'];
		$this->Address->DbValue = $row['Address'];
		$this->PostalCode->DbValue = $row['PostalCode'];
		$this->Phone->DbValue = $row['Phone'];
		$this->_Email->DbValue = $row['Email'];
		$this->Photo->Upload->DbValue = $row['Photo'];
		$this->Notes->DbValue = $row['Notes'];
		$this->Facebook->DbValue = $row['Facebook'];
		$this->Instagram->DbValue = $row['Instagram'];
		$this->Linkedin->DbValue = $row['Linkedin'];
		$this->Username->DbValue = $row['Username'];
		$this->Password->DbValue = $row['Password'];
		$this->UserLevel->DbValue = $row['UserLevel'];
		$this->Profile->DbValue = $row['Profile'];
		$this->Activated->DbValue = $row['Activated'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$this->Photo->OldUploadPath = "phpimages/Persona/";
		$oldFiles = EmptyValue($row['Photo']) ? [] : [$row['Photo']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->Photo->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->Photo->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`PersonID` = @PersonID@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('PersonID', $row) ? $row['PersonID'] : NULL) : $this->PersonID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@PersonID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") <> "" && ReferPageName() <> CurrentPageName() && ReferPageName() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "personlist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "personview.php")
			return $Language->phrase("View");
		elseif ($pageName == "personedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "personadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "personlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("personview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("personview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "personadd.php?" . $this->getUrlParm($parm);
		else
			$url = "personadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("personedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("personadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("persondelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "PersonID:" . JsonEncode($this->PersonID->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm <> "")
			$url .= $parm . "&";
		if ($this->PersonID->CurrentValue != NULL) {
			$url .= "PersonID=" . urlencode($this->PersonID->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("PersonID") !== NULL)
				$arKeys[] = Param("PersonID");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys()
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter <> "") $keyFilter .= " OR ";
			$this->PersonID->CurrentValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = &$this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->PersonID->setDbValue($rs->fields('PersonID'));
		$this->Sexo->setDbValue($rs->fields('Sexo'));
		$this->Name->setDbValue($rs->fields('Name'));
		$this->LastName->setDbValue($rs->fields('LastName'));
		$this->BirthDate->setDbValue($rs->fields('BirthDate'));
		$this->Country->setDbValue($rs->fields('Country'));
		$this->City->setDbValue($rs->fields('City'));
		$this->Address->setDbValue($rs->fields('Address'));
		$this->PostalCode->setDbValue($rs->fields('PostalCode'));
		$this->Phone->setDbValue($rs->fields('Phone'));
		$this->_Email->setDbValue($rs->fields('Email'));
		$this->Photo->Upload->DbValue = $rs->fields('Photo');
		$this->Notes->setDbValue($rs->fields('Notes'));
		$this->Facebook->setDbValue($rs->fields('Facebook'));
		$this->Instagram->setDbValue($rs->fields('Instagram'));
		$this->Linkedin->setDbValue($rs->fields('Linkedin'));
		$this->Username->setDbValue($rs->fields('Username'));
		$this->Password->setDbValue($rs->fields('Password'));
		$this->UserLevel->setDbValue($rs->fields('UserLevel'));
		$this->Profile->setDbValue($rs->fields('Profile'));
		$this->Activated->setDbValue($rs->fields('Activated'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
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

		// PersonID
		$this->PersonID->LinkCustomAttributes = "";
		$this->PersonID->HrefValue = "";
		$this->PersonID->TooltipValue = "";

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

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// PersonID
		$this->PersonID->EditAttrs["class"] = "form-control";
		$this->PersonID->EditCustomAttributes = "";
		$this->PersonID->EditValue = $this->PersonID->CurrentValue;
		$this->PersonID->ViewCustomAttributes = "";

		// Sexo
		$this->Sexo->EditAttrs["class"] = "form-control";
		$this->Sexo->EditCustomAttributes = "";

		// Name
		$this->Name->EditAttrs["class"] = "form-control";
		$this->Name->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Name->CurrentValue = HtmlDecode($this->Name->CurrentValue);
		$this->Name->EditValue = $this->Name->CurrentValue;
		$this->Name->PlaceHolder = RemoveHtml($this->Name->caption());

		// LastName
		$this->LastName->EditAttrs["class"] = "form-control";
		$this->LastName->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->LastName->CurrentValue = HtmlDecode($this->LastName->CurrentValue);
		$this->LastName->EditValue = $this->LastName->CurrentValue;
		$this->LastName->PlaceHolder = RemoveHtml($this->LastName->caption());

		// BirthDate
		$this->BirthDate->EditAttrs["class"] = "form-control";
		$this->BirthDate->EditCustomAttributes = "";
		$this->BirthDate->EditValue = FormatDateTime($this->BirthDate->CurrentValue, 8);
		$this->BirthDate->PlaceHolder = RemoveHtml($this->BirthDate->caption());

		// Country
		$this->Country->EditAttrs["class"] = "form-control";
		$this->Country->EditCustomAttributes = "";

		// City
		$this->City->EditAttrs["class"] = "form-control";
		$this->City->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->City->CurrentValue = HtmlDecode($this->City->CurrentValue);
		$this->City->EditValue = $this->City->CurrentValue;
		$this->City->PlaceHolder = RemoveHtml($this->City->caption());

		// Address
		$this->Address->EditAttrs["class"] = "form-control";
		$this->Address->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Address->CurrentValue = HtmlDecode($this->Address->CurrentValue);
		$this->Address->EditValue = $this->Address->CurrentValue;
		$this->Address->PlaceHolder = RemoveHtml($this->Address->caption());

		// PostalCode
		$this->PostalCode->EditAttrs["class"] = "form-control";
		$this->PostalCode->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->PostalCode->CurrentValue = HtmlDecode($this->PostalCode->CurrentValue);
		$this->PostalCode->EditValue = $this->PostalCode->CurrentValue;
		$this->PostalCode->PlaceHolder = RemoveHtml($this->PostalCode->caption());

		// Phone
		$this->Phone->EditAttrs["class"] = "form-control";
		$this->Phone->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Phone->CurrentValue = HtmlDecode($this->Phone->CurrentValue);
		$this->Phone->EditValue = $this->Phone->CurrentValue;
		$this->Phone->PlaceHolder = RemoveHtml($this->Phone->caption());

		// Email
		$this->_Email->EditAttrs["class"] = "form-control";
		$this->_Email->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->_Email->CurrentValue = HtmlDecode($this->_Email->CurrentValue);
		$this->_Email->EditValue = $this->_Email->CurrentValue;
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

		// Notes
		$this->Notes->EditAttrs["class"] = "form-control";
		$this->Notes->EditCustomAttributes = "";
		$this->Notes->EditValue = $this->Notes->CurrentValue;
		$this->Notes->PlaceHolder = RemoveHtml($this->Notes->caption());

		// Facebook
		$this->Facebook->EditAttrs["class"] = "form-control";
		$this->Facebook->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Facebook->CurrentValue = HtmlDecode($this->Facebook->CurrentValue);
		$this->Facebook->EditValue = $this->Facebook->CurrentValue;
		$this->Facebook->PlaceHolder = RemoveHtml($this->Facebook->caption());

		// Instagram
		$this->Instagram->EditAttrs["class"] = "form-control";
		$this->Instagram->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Instagram->CurrentValue = HtmlDecode($this->Instagram->CurrentValue);
		$this->Instagram->EditValue = $this->Instagram->CurrentValue;
		$this->Instagram->PlaceHolder = RemoveHtml($this->Instagram->caption());

		// Linkedin
		$this->Linkedin->EditAttrs["class"] = "form-control";
		$this->Linkedin->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Linkedin->CurrentValue = HtmlDecode($this->Linkedin->CurrentValue);
		$this->Linkedin->EditValue = $this->Linkedin->CurrentValue;
		$this->Linkedin->PlaceHolder = RemoveHtml($this->Linkedin->caption());

		// Username
		$this->Username->EditAttrs["class"] = "form-control";
		$this->Username->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->Username->CurrentValue = HtmlDecode($this->Username->CurrentValue);
		$this->Username->EditValue = $this->Username->CurrentValue;
		$this->Username->PlaceHolder = RemoveHtml($this->Username->caption());

		// Password
		$this->Password->EditAttrs["class"] = "form-control";
		$this->Password->EditCustomAttributes = "";
		$this->Password->EditValue = $this->Password->CurrentValue;
		$this->Password->PlaceHolder = RemoveHtml($this->Password->caption());

		// UserLevel
		$this->UserLevel->EditAttrs["class"] = "form-control";
		$this->UserLevel->EditCustomAttributes = "";
		if (!$Security->canAdmin()) { // System admin
			$this->UserLevel->EditValue = $Language->phrase("PasswordMask");
		} else {
		}

		// Profile
		$this->Profile->EditAttrs["class"] = "form-control";
		$this->Profile->EditCustomAttributes = "";
		$this->Profile->EditValue = $this->Profile->CurrentValue;
		$this->Profile->PlaceHolder = RemoveHtml($this->Profile->caption());

		// Activated
		$this->Activated->EditCustomAttributes = "";
		$this->Activated->EditValue = $this->Activated->options(FALSE);

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->PersonID);
					$doc->exportCaption($this->Sexo);
					$doc->exportCaption($this->Name);
					$doc->exportCaption($this->LastName);
					$doc->exportCaption($this->BirthDate);
					$doc->exportCaption($this->Country);
					$doc->exportCaption($this->City);
					$doc->exportCaption($this->Address);
					$doc->exportCaption($this->PostalCode);
					$doc->exportCaption($this->Phone);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->Photo);
					$doc->exportCaption($this->Notes);
					$doc->exportCaption($this->Facebook);
					$doc->exportCaption($this->Instagram);
					$doc->exportCaption($this->Linkedin);
					$doc->exportCaption($this->Username);
					$doc->exportCaption($this->Password);
					$doc->exportCaption($this->UserLevel);
					$doc->exportCaption($this->Profile);
					$doc->exportCaption($this->Activated);
				} else {
					$doc->exportCaption($this->PersonID);
					$doc->exportCaption($this->Sexo);
					$doc->exportCaption($this->Name);
					$doc->exportCaption($this->LastName);
					$doc->exportCaption($this->BirthDate);
					$doc->exportCaption($this->Country);
					$doc->exportCaption($this->City);
					$doc->exportCaption($this->Address);
					$doc->exportCaption($this->PostalCode);
					$doc->exportCaption($this->Phone);
					$doc->exportCaption($this->_Email);
					$doc->exportCaption($this->Photo);
					$doc->exportCaption($this->Facebook);
					$doc->exportCaption($this->Instagram);
					$doc->exportCaption($this->Linkedin);
					$doc->exportCaption($this->Username);
					$doc->exportCaption($this->Password);
					$doc->exportCaption($this->UserLevel);
					$doc->exportCaption($this->Activated);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->PersonID);
						$doc->exportField($this->Sexo);
						$doc->exportField($this->Name);
						$doc->exportField($this->LastName);
						$doc->exportField($this->BirthDate);
						$doc->exportField($this->Country);
						$doc->exportField($this->City);
						$doc->exportField($this->Address);
						$doc->exportField($this->PostalCode);
						$doc->exportField($this->Phone);
						$doc->exportField($this->_Email);
						$doc->exportField($this->Photo);
						$doc->exportField($this->Notes);
						$doc->exportField($this->Facebook);
						$doc->exportField($this->Instagram);
						$doc->exportField($this->Linkedin);
						$doc->exportField($this->Username);
						$doc->exportField($this->Password);
						$doc->exportField($this->UserLevel);
						$doc->exportField($this->Profile);
						$doc->exportField($this->Activated);
					} else {
						$doc->exportField($this->PersonID);
						$doc->exportField($this->Sexo);
						$doc->exportField($this->Name);
						$doc->exportField($this->LastName);
						$doc->exportField($this->BirthDate);
						$doc->exportField($this->Country);
						$doc->exportField($this->City);
						$doc->exportField($this->Address);
						$doc->exportField($this->PostalCode);
						$doc->exportField($this->Phone);
						$doc->exportField($this->_Email);
						$doc->exportField($this->Photo);
						$doc->exportField($this->Facebook);
						$doc->exportField($this->Instagram);
						$doc->exportField($this->Linkedin);
						$doc->exportField($this->Username);
						$doc->exportField($this->Password);
						$doc->exportField($this->UserLevel);
						$doc->exportField($this->Activated);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// User ID filter
	public function getUserIDFilter($userId)
	{
		$userIdFilter = '`PersonID` = ' . QuotedValue($userId, DATATYPE_NUMBER, USER_TABLE_DBID);
		return $userIdFilter;
	}

	// Add User ID filter
	public function addUserIDFilter($filter = "")
	{
		global $Security;
		$filterWrk = "";
		$id = (CurrentPageID() == "list") ? $this->CurrentAction : CurrentPageID();
		if (!$this->userIdAllow($id) && !$Security->isAdmin()) {
			$filterWrk = $Security->userIdList();
			if ($filterWrk <> "")
				$filterWrk = '`PersonID` IN (' . $filterWrk . ')';
		}

		// Call User ID Filtering event
		$this->UserID_Filtering($filterWrk);
		AddFilter($filter, $filterWrk);
		return $filter;
	}

	// User ID subquery
	public function getUserIDSubquery(&$fld, &$masterfld)
	{
		global $UserTableConn;
		$wrk = "";
		$sql = "SELECT " . $masterfld->Expression . " FROM `person`";
		$filter = $this->addUserIDFilter("");
		if ($filter <> "")
			$sql .= " WHERE " . $filter;

		// Use subquery
		if (USE_SUBQUERY_FOR_MASTER_USER_ID) {
			$wrk = $sql;
		} else {

			// List all values
			if ($rs = $UserTableConn->execute($sql)) {
				while (!$rs->EOF) {
					if ($wrk <> "")
						$wrk .= ",";
					$wrk .= QuotedValue($rs->fields[0], $masterfld->DataType, USER_TABLE_DBID);
					$rs->moveNext();
				}
				$rs->close();
			}
		}
		if ($wrk <> "")
			$wrk = $fld->Expression . " IN (" . $wrk . ")";
		return $wrk;
	}

	// Lookup data from table
	public function lookup()
	{
		global $Language, $LANGUAGE_FOLDER, $PROJECT_ID;
		if (!isset($Language))
			$Language = new Language($LANGUAGE_FOLDER, Post("language", ""));
		global $Security, $RequestSecurity;

		// Check token first
		$func = PROJECT_NAMESPACE . "CheckToken";
		$validRequest = FALSE;
		if (is_callable($func) && Post(TOKEN_NAME) !== NULL) {
			$validRequest = $func(Post(TOKEN_NAME), SessionTimeoutTime());
			if ($validRequest) {
				if (!isset($Security)) {
					if (session_status() !== PHP_SESSION_ACTIVE)
						session_start(); // Init session data
					$Security = new AdvancedSecurity();
					if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
					$Security->loadCurrentUserLevel($PROJECT_ID . $this->TableName);
					if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
					$validRequest = $Security->canList(); // List permission
					if ($validRequest) {
						$Security->UserID_Loading();
						$Security->loadUserID();
						$Security->UserID_Loaded();
					}
				}
			}
		} else {

			// User profile
			$UserProfile = new UserProfile();

			// Security
			$Security = new AdvancedSecurity();
			if (is_array($RequestSecurity)) // Login user for API request
				$Security->loginUser(@$RequestSecurity["username"], @$RequestSecurity["userid"], @$RequestSecurity["parentuserid"], @$RequestSecurity["userlevelid"]);
			$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel(CurrentProjectID() . $this->TableName);
			$Security->TablePermission_Loaded();
			$validRequest = $Security->canList(); // List permission
		}

		// Reject invalid request
		if (!$validRequest)
			return FALSE;

		// Load lookup parameters
		$distinct = ConvertToBool(Post("distinct"));
		$linkField = Post("linkField");
		$displayFields = Post("displayFields");
		$parentFields = Post("parentFields");
		if (!is_array($parentFields))
			$parentFields = [];
		$childFields = Post("childFields");
		if (!is_array($childFields))
			$childFields = [];
		$filterFields = Post("filterFields");
		if (!is_array($filterFields))
			$filterFields = [];
		$filterFieldVars = Post("filterFieldVars");
		if (!is_array($filterFieldVars))
			$filterFieldVars = [];
		$filterOperators = Post("filterOperators");
		if (!is_array($filterOperators))
			$filterOperators = [];
		$autoFillSourceFields = Post("autoFillSourceFields");
		if (!is_array($autoFillSourceFields))
			$autoFillSourceFields = [];
		$formatAutoFill = FALSE;
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = AUTO_SUGGEST_MAX_ENTRIES;
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");

		// Selected records from modal, skip parent/filter fields and show all records
		if ($keys !== NULL) {
			$parentFields = [];
			$filterFields = [];
			$filterFieldVars = [];
			$offset = 0;
			$pageSize = 0;
		}

		// Create lookup object and output JSON
		$lookup = new Lookup($linkField, $this->TableVar, $distinct, $linkField, $displayFields, $parentFields, $childFields, $filterFields, $filterFieldVars, $autoFillSourceFields);
		foreach ($filterFields as $i => $filterField) { // Set up filter operators
			if (@$filterOperators[$i] <> "")
				$lookup->setFilterOperator($filterField, $filterOperators[$i]);
		}
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(LOOKUP_FILTER_VALUE_SEPARATOR, $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($filterFields) ? count($filterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect <> "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter <> "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy <> "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson();
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = THUMBNAIL_DEFAULT_WIDTH, $height = THUMBNAIL_DEFAULT_HEIGHT)
	{
		global $COMPOSITE_KEY_SEPARATOR;

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'Photo') {
			$fldName = "Photo";
			$fileNameFld = "Photo";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode($COMPOSITE_KEY_SEPARATOR, $key);
		if (count($ar) == 1) {
			$this->PersonID->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype <> "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld <> "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					if ($fileNameFld <> "" && !EmptyValue($rs->fields($fileNameFld)))
						AddHeader("Content-Disposition", "attachment; filename=\"" . $rs->fields($fileNameFld) . "\"");

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear output buffer
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>