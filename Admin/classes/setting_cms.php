<?php
namespace PHPMaker2019\cmsweb;

/**
 * Table class for setting_cms
 */
class setting_cms extends DbTable
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
	public $SettingcmsID;
	public $seccion_slider;
	public $seccion_about;
	public $seccion_service;
	public $seccion_publicitaria;
	public $banner_publicitario_titulo;
	public $banner_publicitario_detalle;
	public $banner_publicitario_btnNombre;
	public $banner_publicitario_url;
	public $seccion_portfolio;
	public $seccion_app;
	public $link_app_android;
	public $link_app_iphone;
	public $cookies_ley;
	public $cookies_questions;
	public $cookies_detalle;
	public $seccion_contact;
	public $seccion_menufooter;
	public $updated_at;
	public $usuario_id;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'setting_cms';
		$this->TableName = 'setting_cms';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`setting_cms`";
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

		// SettingcmsID
		$this->SettingcmsID = new DbField('setting_cms', 'setting_cms', 'x_SettingcmsID', 'SettingcmsID', '`SettingcmsID`', '`SettingcmsID`', 3, -1, FALSE, '`SettingcmsID`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->SettingcmsID->IsAutoIncrement = TRUE; // Autoincrement field
		$this->SettingcmsID->IsPrimaryKey = TRUE; // Primary key field
		$this->SettingcmsID->Sortable = TRUE; // Allow sort
		$this->SettingcmsID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['SettingcmsID'] = &$this->SettingcmsID;

		// seccion_slider
		$this->seccion_slider = new DbField('setting_cms', 'setting_cms', 'x_seccion_slider', 'seccion_slider', '`seccion_slider`', '`seccion_slider`', 202, -1, FALSE, '`seccion_slider`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->seccion_slider->Nullable = FALSE; // NOT NULL field
		$this->seccion_slider->Sortable = TRUE; // Allow sort
		$this->seccion_slider->DataType = DATATYPE_BOOLEAN;
		$this->seccion_slider->Lookup = new Lookup('seccion_slider', 'setting_cms', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->seccion_slider->OptionCount = 2;
		$this->fields['seccion_slider'] = &$this->seccion_slider;

		// seccion_about
		$this->seccion_about = new DbField('setting_cms', 'setting_cms', 'x_seccion_about', 'seccion_about', '`seccion_about`', '`seccion_about`', 202, -1, FALSE, '`seccion_about`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->seccion_about->Nullable = FALSE; // NOT NULL field
		$this->seccion_about->Sortable = TRUE; // Allow sort
		$this->seccion_about->DataType = DATATYPE_BOOLEAN;
		$this->seccion_about->Lookup = new Lookup('seccion_about', 'setting_cms', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->seccion_about->OptionCount = 2;
		$this->fields['seccion_about'] = &$this->seccion_about;

		// seccion_service
		$this->seccion_service = new DbField('setting_cms', 'setting_cms', 'x_seccion_service', 'seccion_service', '`seccion_service`', '`seccion_service`', 202, -1, FALSE, '`seccion_service`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->seccion_service->Nullable = FALSE; // NOT NULL field
		$this->seccion_service->Sortable = TRUE; // Allow sort
		$this->seccion_service->DataType = DATATYPE_BOOLEAN;
		$this->seccion_service->Lookup = new Lookup('seccion_service', 'setting_cms', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->seccion_service->OptionCount = 2;
		$this->fields['seccion_service'] = &$this->seccion_service;

		// seccion_publicitaria
		$this->seccion_publicitaria = new DbField('setting_cms', 'setting_cms', 'x_seccion_publicitaria', 'seccion_publicitaria', '`seccion_publicitaria`', '`seccion_publicitaria`', 202, -1, FALSE, '`seccion_publicitaria`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->seccion_publicitaria->Nullable = FALSE; // NOT NULL field
		$this->seccion_publicitaria->Sortable = TRUE; // Allow sort
		$this->seccion_publicitaria->DataType = DATATYPE_BOOLEAN;
		$this->seccion_publicitaria->Lookup = new Lookup('seccion_publicitaria', 'setting_cms', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->seccion_publicitaria->OptionCount = 2;
		$this->fields['seccion_publicitaria'] = &$this->seccion_publicitaria;

		// banner_publicitario_titulo
		$this->banner_publicitario_titulo = new DbField('setting_cms', 'setting_cms', 'x_banner_publicitario_titulo', 'banner_publicitario_titulo', '`banner_publicitario_titulo`', '`banner_publicitario_titulo`', 200, -1, FALSE, '`banner_publicitario_titulo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->banner_publicitario_titulo->Sortable = TRUE; // Allow sort
		$this->fields['banner_publicitario_titulo'] = &$this->banner_publicitario_titulo;

		// banner_publicitario_detalle
		$this->banner_publicitario_detalle = new DbField('setting_cms', 'setting_cms', 'x_banner_publicitario_detalle', 'banner_publicitario_detalle', '`banner_publicitario_detalle`', '`banner_publicitario_detalle`', 200, -1, FALSE, '`banner_publicitario_detalle`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->banner_publicitario_detalle->Sortable = TRUE; // Allow sort
		$this->fields['banner_publicitario_detalle'] = &$this->banner_publicitario_detalle;

		// banner_publicitario_btnNombre
		$this->banner_publicitario_btnNombre = new DbField('setting_cms', 'setting_cms', 'x_banner_publicitario_btnNombre', 'banner_publicitario_btnNombre', '`banner_publicitario_btnNombre`', '`banner_publicitario_btnNombre`', 200, -1, FALSE, '`banner_publicitario_btnNombre`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->banner_publicitario_btnNombre->Sortable = TRUE; // Allow sort
		$this->fields['banner_publicitario_btnNombre'] = &$this->banner_publicitario_btnNombre;

		// banner_publicitario_url
		$this->banner_publicitario_url = new DbField('setting_cms', 'setting_cms', 'x_banner_publicitario_url', 'banner_publicitario_url', '`banner_publicitario_url`', '`banner_publicitario_url`', 200, -1, FALSE, '`banner_publicitario_url`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->banner_publicitario_url->Sortable = TRUE; // Allow sort
		$this->fields['banner_publicitario_url'] = &$this->banner_publicitario_url;

		// seccion_portfolio
		$this->seccion_portfolio = new DbField('setting_cms', 'setting_cms', 'x_seccion_portfolio', 'seccion_portfolio', '`seccion_portfolio`', '`seccion_portfolio`', 202, -1, FALSE, '`seccion_portfolio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->seccion_portfolio->Nullable = FALSE; // NOT NULL field
		$this->seccion_portfolio->Sortable = TRUE; // Allow sort
		$this->seccion_portfolio->DataType = DATATYPE_BOOLEAN;
		$this->seccion_portfolio->Lookup = new Lookup('seccion_portfolio', 'setting_cms', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->seccion_portfolio->OptionCount = 2;
		$this->fields['seccion_portfolio'] = &$this->seccion_portfolio;

		// seccion_app
		$this->seccion_app = new DbField('setting_cms', 'setting_cms', 'x_seccion_app', 'seccion_app', '`seccion_app`', '`seccion_app`', 202, -1, FALSE, '`seccion_app`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->seccion_app->Nullable = FALSE; // NOT NULL field
		$this->seccion_app->Sortable = TRUE; // Allow sort
		$this->seccion_app->DataType = DATATYPE_BOOLEAN;
		$this->seccion_app->Lookup = new Lookup('seccion_app', 'setting_cms', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->seccion_app->OptionCount = 2;
		$this->fields['seccion_app'] = &$this->seccion_app;

		// link_app_android
		$this->link_app_android = new DbField('setting_cms', 'setting_cms', 'x_link_app_android', 'link_app_android', '`link_app_android`', '`link_app_android`', 200, -1, FALSE, '`link_app_android`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->link_app_android->Sortable = TRUE; // Allow sort
		$this->fields['link_app_android'] = &$this->link_app_android;

		// link_app_iphone
		$this->link_app_iphone = new DbField('setting_cms', 'setting_cms', 'x_link_app_iphone', 'link_app_iphone', '`link_app_iphone`', '`link_app_iphone`', 200, -1, FALSE, '`link_app_iphone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->link_app_iphone->Sortable = TRUE; // Allow sort
		$this->fields['link_app_iphone'] = &$this->link_app_iphone;

		// cookies_ley
		$this->cookies_ley = new DbField('setting_cms', 'setting_cms', 'x_cookies_ley', 'cookies_ley', '`cookies_ley`', '`cookies_ley`', 202, -1, FALSE, '`cookies_ley`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->cookies_ley->Sortable = TRUE; // Allow sort
		$this->cookies_ley->DataType = DATATYPE_BOOLEAN;
		$this->cookies_ley->Lookup = new Lookup('cookies_ley', 'setting_cms', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->cookies_ley->OptionCount = 2;
		$this->fields['cookies_ley'] = &$this->cookies_ley;

		// cookies_questions
		$this->cookies_questions = new DbField('setting_cms', 'setting_cms', 'x_cookies_questions', 'cookies_questions', '`cookies_questions`', '`cookies_questions`', 200, -1, FALSE, '`cookies_questions`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cookies_questions->Sortable = TRUE; // Allow sort
		$this->fields['cookies_questions'] = &$this->cookies_questions;

		// cookies_detalle
		$this->cookies_detalle = new DbField('setting_cms', 'setting_cms', 'x_cookies_detalle', 'cookies_detalle', '`cookies_detalle`', '`cookies_detalle`', 201, -1, FALSE, '`cookies_detalle`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->cookies_detalle->Sortable = TRUE; // Allow sort
		$this->fields['cookies_detalle'] = &$this->cookies_detalle;

		// seccion_contact
		$this->seccion_contact = new DbField('setting_cms', 'setting_cms', 'x_seccion_contact', 'seccion_contact', '`seccion_contact`', '`seccion_contact`', 202, -1, FALSE, '`seccion_contact`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->seccion_contact->Nullable = FALSE; // NOT NULL field
		$this->seccion_contact->Sortable = TRUE; // Allow sort
		$this->seccion_contact->DataType = DATATYPE_BOOLEAN;
		$this->seccion_contact->Lookup = new Lookup('seccion_contact', 'setting_cms', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->seccion_contact->OptionCount = 2;
		$this->fields['seccion_contact'] = &$this->seccion_contact;

		// seccion_menufooter
		$this->seccion_menufooter = new DbField('setting_cms', 'setting_cms', 'x_seccion_menufooter', 'seccion_menufooter', '`seccion_menufooter`', '`seccion_menufooter`', 202, -1, FALSE, '`seccion_menufooter`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->seccion_menufooter->Nullable = FALSE; // NOT NULL field
		$this->seccion_menufooter->Sortable = TRUE; // Allow sort
		$this->seccion_menufooter->DataType = DATATYPE_BOOLEAN;
		$this->seccion_menufooter->Lookup = new Lookup('seccion_menufooter', 'setting_cms', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->seccion_menufooter->OptionCount = 2;
		$this->fields['seccion_menufooter'] = &$this->seccion_menufooter;

		// updated_at
		$this->updated_at = new DbField('setting_cms', 'setting_cms', 'x_updated_at', 'updated_at', '`updated_at`', CastDateFieldForLike('`updated_at`', 0, "DB"), 135, 0, FALSE, '`updated_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->updated_at->Sortable = TRUE; // Allow sort
		$this->updated_at->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['updated_at'] = &$this->updated_at;

		// usuario_id
		$this->usuario_id = new DbField('setting_cms', 'setting_cms', 'x_usuario_id', 'usuario_id', '`usuario_id`', '`usuario_id`', 20, -1, FALSE, '`usuario_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->usuario_id->Nullable = FALSE; // NOT NULL field
		$this->usuario_id->Sortable = TRUE; // Allow sort
		$this->usuario_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['usuario_id'] = &$this->usuario_id;
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
		return ($this->SqlFrom <> "") ? $this->SqlFrom : "`setting_cms`";
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
		return ($this->SqlOrderBy <> "") ? $this->SqlOrderBy : "";
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
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = USER_ID_ALLOW;
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
			$this->SettingcmsID->setDbValue($conn->insert_ID());
			$rs['SettingcmsID'] = $this->SettingcmsID->DbValue;
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
			if (array_key_exists('SettingcmsID', $rs))
				AddFilter($where, QuotedName('SettingcmsID', $this->Dbid) . '=' . QuotedValue($rs['SettingcmsID'], $this->SettingcmsID->DataType, $this->Dbid));
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
		$this->SettingcmsID->DbValue = $row['SettingcmsID'];
		$this->seccion_slider->DbValue = $row['seccion_slider'];
		$this->seccion_about->DbValue = $row['seccion_about'];
		$this->seccion_service->DbValue = $row['seccion_service'];
		$this->seccion_publicitaria->DbValue = $row['seccion_publicitaria'];
		$this->banner_publicitario_titulo->DbValue = $row['banner_publicitario_titulo'];
		$this->banner_publicitario_detalle->DbValue = $row['banner_publicitario_detalle'];
		$this->banner_publicitario_btnNombre->DbValue = $row['banner_publicitario_btnNombre'];
		$this->banner_publicitario_url->DbValue = $row['banner_publicitario_url'];
		$this->seccion_portfolio->DbValue = $row['seccion_portfolio'];
		$this->seccion_app->DbValue = $row['seccion_app'];
		$this->link_app_android->DbValue = $row['link_app_android'];
		$this->link_app_iphone->DbValue = $row['link_app_iphone'];
		$this->cookies_ley->DbValue = $row['cookies_ley'];
		$this->cookies_questions->DbValue = $row['cookies_questions'];
		$this->cookies_detalle->DbValue = $row['cookies_detalle'];
		$this->seccion_contact->DbValue = $row['seccion_contact'];
		$this->seccion_menufooter->DbValue = $row['seccion_menufooter'];
		$this->updated_at->DbValue = $row['updated_at'];
		$this->usuario_id->DbValue = $row['usuario_id'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`SettingcmsID` = @SettingcmsID@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		$val = is_array($row) ? (array_key_exists('SettingcmsID', $row) ? $row['SettingcmsID'] : NULL) : $this->SettingcmsID->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@SettingcmsID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "setting_cmslist.php";
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
		if ($pageName == "setting_cmsview.php")
			return $Language->phrase("View");
		elseif ($pageName == "setting_cmsedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "setting_cmsadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "setting_cmslist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm <> "")
			$url = $this->keyUrl("setting_cmsview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("setting_cmsview.php", $this->getUrlParm(TABLE_SHOW_DETAIL . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm <> "")
			$url = "setting_cmsadd.php?" . $this->getUrlParm($parm);
		else
			$url = "setting_cmsadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("setting_cmsedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("setting_cmsadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("setting_cmsdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "SettingcmsID:" . JsonEncode($this->SettingcmsID->CurrentValue, "number");
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
		if ($this->SettingcmsID->CurrentValue != NULL) {
			$url .= "SettingcmsID=" . urlencode($this->SettingcmsID->CurrentValue);
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
			if (Param("SettingcmsID") !== NULL)
				$arKeys[] = Param("SettingcmsID");
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
			$this->SettingcmsID->CurrentValue = $key;
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
		$this->SettingcmsID->setDbValue($rs->fields('SettingcmsID'));
		$this->seccion_slider->setDbValue($rs->fields('seccion_slider'));
		$this->seccion_about->setDbValue($rs->fields('seccion_about'));
		$this->seccion_service->setDbValue($rs->fields('seccion_service'));
		$this->seccion_publicitaria->setDbValue($rs->fields('seccion_publicitaria'));
		$this->banner_publicitario_titulo->setDbValue($rs->fields('banner_publicitario_titulo'));
		$this->banner_publicitario_detalle->setDbValue($rs->fields('banner_publicitario_detalle'));
		$this->banner_publicitario_btnNombre->setDbValue($rs->fields('banner_publicitario_btnNombre'));
		$this->banner_publicitario_url->setDbValue($rs->fields('banner_publicitario_url'));
		$this->seccion_portfolio->setDbValue($rs->fields('seccion_portfolio'));
		$this->seccion_app->setDbValue($rs->fields('seccion_app'));
		$this->link_app_android->setDbValue($rs->fields('link_app_android'));
		$this->link_app_iphone->setDbValue($rs->fields('link_app_iphone'));
		$this->cookies_ley->setDbValue($rs->fields('cookies_ley'));
		$this->cookies_questions->setDbValue($rs->fields('cookies_questions'));
		$this->cookies_detalle->setDbValue($rs->fields('cookies_detalle'));
		$this->seccion_contact->setDbValue($rs->fields('seccion_contact'));
		$this->seccion_menufooter->setDbValue($rs->fields('seccion_menufooter'));
		$this->updated_at->setDbValue($rs->fields('updated_at'));
		$this->usuario_id->setDbValue($rs->fields('usuario_id'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
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
		$this->banner_publicitario_titulo->EditValue = $this->banner_publicitario_titulo->CurrentValue;
		$this->banner_publicitario_titulo->PlaceHolder = RemoveHtml($this->banner_publicitario_titulo->caption());

		// banner_publicitario_detalle
		$this->banner_publicitario_detalle->EditAttrs["class"] = "form-control";
		$this->banner_publicitario_detalle->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->banner_publicitario_detalle->CurrentValue = HtmlDecode($this->banner_publicitario_detalle->CurrentValue);
		$this->banner_publicitario_detalle->EditValue = $this->banner_publicitario_detalle->CurrentValue;
		$this->banner_publicitario_detalle->PlaceHolder = RemoveHtml($this->banner_publicitario_detalle->caption());

		// banner_publicitario_btnNombre
		$this->banner_publicitario_btnNombre->EditAttrs["class"] = "form-control";
		$this->banner_publicitario_btnNombre->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->banner_publicitario_btnNombre->CurrentValue = HtmlDecode($this->banner_publicitario_btnNombre->CurrentValue);
		$this->banner_publicitario_btnNombre->EditValue = $this->banner_publicitario_btnNombre->CurrentValue;
		$this->banner_publicitario_btnNombre->PlaceHolder = RemoveHtml($this->banner_publicitario_btnNombre->caption());

		// banner_publicitario_url
		$this->banner_publicitario_url->EditAttrs["class"] = "form-control";
		$this->banner_publicitario_url->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->banner_publicitario_url->CurrentValue = HtmlDecode($this->banner_publicitario_url->CurrentValue);
		$this->banner_publicitario_url->EditValue = $this->banner_publicitario_url->CurrentValue;
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
		$this->link_app_android->EditValue = $this->link_app_android->CurrentValue;
		$this->link_app_android->PlaceHolder = RemoveHtml($this->link_app_android->caption());

		// link_app_iphone
		$this->link_app_iphone->EditAttrs["class"] = "form-control";
		$this->link_app_iphone->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->link_app_iphone->CurrentValue = HtmlDecode($this->link_app_iphone->CurrentValue);
		$this->link_app_iphone->EditValue = $this->link_app_iphone->CurrentValue;
		$this->link_app_iphone->PlaceHolder = RemoveHtml($this->link_app_iphone->caption());

		// cookies_ley
		$this->cookies_ley->EditCustomAttributes = "";
		$this->cookies_ley->EditValue = $this->cookies_ley->options(FALSE);

		// cookies_questions
		$this->cookies_questions->EditAttrs["class"] = "form-control";
		$this->cookies_questions->EditCustomAttributes = "";
		if (REMOVE_XSS)
			$this->cookies_questions->CurrentValue = HtmlDecode($this->cookies_questions->CurrentValue);
		$this->cookies_questions->EditValue = $this->cookies_questions->CurrentValue;
		$this->cookies_questions->PlaceHolder = RemoveHtml($this->cookies_questions->caption());

		// cookies_detalle
		$this->cookies_detalle->EditAttrs["class"] = "form-control";
		$this->cookies_detalle->EditCustomAttributes = "";
		$this->cookies_detalle->EditValue = $this->cookies_detalle->CurrentValue;
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
					$doc->exportCaption($this->SettingcmsID);
					$doc->exportCaption($this->seccion_slider);
					$doc->exportCaption($this->seccion_about);
					$doc->exportCaption($this->seccion_service);
					$doc->exportCaption($this->seccion_publicitaria);
					$doc->exportCaption($this->banner_publicitario_titulo);
					$doc->exportCaption($this->banner_publicitario_detalle);
					$doc->exportCaption($this->banner_publicitario_btnNombre);
					$doc->exportCaption($this->banner_publicitario_url);
					$doc->exportCaption($this->seccion_portfolio);
					$doc->exportCaption($this->seccion_app);
					$doc->exportCaption($this->link_app_android);
					$doc->exportCaption($this->link_app_iphone);
					$doc->exportCaption($this->cookies_ley);
					$doc->exportCaption($this->cookies_questions);
					$doc->exportCaption($this->cookies_detalle);
					$doc->exportCaption($this->seccion_contact);
					$doc->exportCaption($this->seccion_menufooter);
					$doc->exportCaption($this->updated_at);
					$doc->exportCaption($this->usuario_id);
				} else {
					$doc->exportCaption($this->SettingcmsID);
					$doc->exportCaption($this->seccion_slider);
					$doc->exportCaption($this->seccion_about);
					$doc->exportCaption($this->seccion_service);
					$doc->exportCaption($this->seccion_publicitaria);
					$doc->exportCaption($this->banner_publicitario_titulo);
					$doc->exportCaption($this->banner_publicitario_detalle);
					$doc->exportCaption($this->banner_publicitario_btnNombre);
					$doc->exportCaption($this->banner_publicitario_url);
					$doc->exportCaption($this->seccion_portfolio);
					$doc->exportCaption($this->seccion_app);
					$doc->exportCaption($this->link_app_android);
					$doc->exportCaption($this->link_app_iphone);
					$doc->exportCaption($this->cookies_ley);
					$doc->exportCaption($this->cookies_questions);
					$doc->exportCaption($this->seccion_contact);
					$doc->exportCaption($this->seccion_menufooter);
					$doc->exportCaption($this->updated_at);
					$doc->exportCaption($this->usuario_id);
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
						$doc->exportField($this->SettingcmsID);
						$doc->exportField($this->seccion_slider);
						$doc->exportField($this->seccion_about);
						$doc->exportField($this->seccion_service);
						$doc->exportField($this->seccion_publicitaria);
						$doc->exportField($this->banner_publicitario_titulo);
						$doc->exportField($this->banner_publicitario_detalle);
						$doc->exportField($this->banner_publicitario_btnNombre);
						$doc->exportField($this->banner_publicitario_url);
						$doc->exportField($this->seccion_portfolio);
						$doc->exportField($this->seccion_app);
						$doc->exportField($this->link_app_android);
						$doc->exportField($this->link_app_iphone);
						$doc->exportField($this->cookies_ley);
						$doc->exportField($this->cookies_questions);
						$doc->exportField($this->cookies_detalle);
						$doc->exportField($this->seccion_contact);
						$doc->exportField($this->seccion_menufooter);
						$doc->exportField($this->updated_at);
						$doc->exportField($this->usuario_id);
					} else {
						$doc->exportField($this->SettingcmsID);
						$doc->exportField($this->seccion_slider);
						$doc->exportField($this->seccion_about);
						$doc->exportField($this->seccion_service);
						$doc->exportField($this->seccion_publicitaria);
						$doc->exportField($this->banner_publicitario_titulo);
						$doc->exportField($this->banner_publicitario_detalle);
						$doc->exportField($this->banner_publicitario_btnNombre);
						$doc->exportField($this->banner_publicitario_url);
						$doc->exportField($this->seccion_portfolio);
						$doc->exportField($this->seccion_app);
						$doc->exportField($this->link_app_android);
						$doc->exportField($this->link_app_iphone);
						$doc->exportField($this->cookies_ley);
						$doc->exportField($this->cookies_questions);
						$doc->exportField($this->seccion_contact);
						$doc->exportField($this->seccion_menufooter);
						$doc->exportField($this->updated_at);
						$doc->exportField($this->usuario_id);
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

		// No binary fields
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