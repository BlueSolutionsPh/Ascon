<?php
require_once(dirname(__FILE__) . "/../common/define.php");

class Db{
	private static $_con = null;		// DB connection
	private static $_tranStatus;		// Transaction state
	private static $_inTran;			// Whether the transaction is in progress
	private static $_displayErrMessage = false;			// Whether to output error message screen output
	private $_connect_dsn;				// DB connection information
	private $_connect_user;				// DB connection user
	private $_connect_password;			// DB connection password
	private $_fetchCallback = null;		// Callback function when fetching
	private $_effectedRowCount;			// Number of rows affected by the most recent DELETE, INSERT, and UPDATE statements
	private $_statement;				// Query string
	private $_params;					// Parameters to embed in the query
	private $_errorMsg = array();		// Error message
	
	// Error status
	const DB_NO_ERROR = 0;				// No error
	const DB_ERROR = 1;					// There is an error
	
	/**
	 * constructor
	 */
	function __construct()
	{
		$this->_connect_dsn			= CONNECT_DSN;				// DB connection information
		$this->_connect_user		= CONNECT_USER;				// DB connection user
		$this->_connect_password	= CONNECT_PASSWORD;			// DB connection password
	}
	/**
	 * Destructor
	 */
	function __destruct()
	{
	}
	/**
	 * Initialization method
	 *
	 * Invoke when attribute parameter of DB is required
	 */
	function init()
	{
		self::_getConnection();
	}
	/**
	 * Obtain DB connection connection
	 *
	 * @return PDO 			Connection connection objects
	 */
	function _getConnection()
	{
		if (self::$_con == null){
			try {
				self::$_con = new PDO($this->_connect_dsn, $this->_connect_user, $this->_connect_password);
				self::$_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				// Common error handling
				self::_onError($e, 'DSN=' . $this->_connect_dsn . ';' . 'USER=' . $this->_connect_user . ';' . 'PWD=' . $this->_connect_password);
			}
		}
		return self::$_con;
	}
	/**
	 * Create DB connection connection
	 *
	 * @param  string $dsn			DB connection information
	 * @param  string $user			DB connection user
	 * @param  string $password		DB connection password
	 * @return PDO 			Connection connection object
	 */
	function _createConnection($dsn, $user, $password)
	{
		try {
			$con = new PDO($dsn, $user, $password);
			$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			// Common error handling
			self::_onError($e, 'DSN=' . $dsn . ';' . 'USER=' . $user . ';' . 'PWD=' . $password);
		}
		return $con;
	}
	/**
	 * Retrieve the connection DB name
	 *
	 * @return string 			DB name
	 */
	function getDbName()
	{
		$dbName = '';
		$dsnArray = explode(';', $this->_connect_dsn);
		for ($i = 0; $i < count($dsnArray); $i++){
			$pos = strpos($dsnArray[$i], '=');
			if ($pos === false) continue;
			
			list($key, $value) = explode('=', $dsnArray[$i]);
			$key = trim($key);
			$value = trim($value);
			if (strcasecmp($key, 'dbname') == 0){
				$dbName =$value;
				break;
			}
		}
		return $dbName;
	}
	/**
	 * Set callback function at fetch
	 */
	function _setFetchCallback($func)
	{
		$this->_fetchCallback = $func;
	}
	
	/**
	 * Fetch processing
	 */
	function _fetch($stmt, $param = null)
	{
		$index = 0;// What line is it?
		
		// Process the acquired data
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			if (is_callable($this->_fetchCallback)){
				// Execute callback function
				// When false is returned, it ends
				$result = call_user_func($this->_fetchCallback, $index, $row, $param);
				if (!$result) break;
			}
			$index++;
		}
	}
	/**
	 * Set SQL statement
	 */
	function _setStatement($stmt, $params = null)
	{
		$this->_statement = $stmt;
		$this->_params = $params;
	}
	/**
	 * Execute SQL statement
	 *
	 * @param  string $statement		Execute SQL statement
	 */
	function _execStatement()
	{
		// Return value Initialization
		$retValue = false;
		
		try {
			// Connect to DB
			$con = self::_getConnection();

			if ($con != null){
				// SQL execution
				$stmt = $con->prepare($this->_statement);
				$stmt->execute($this->_params);
				$this->_effectedRowCount = $stmt->rowCount();	// Number of rows affected by the most recent DELETE, INSERT, and UPDATE statements

				// Open statement
				$stmt = null;
			
				// Successful completion
				$retValue = true;
			}
		} catch (PDOException $e) {
			// Common error handling
			self::_onError($e);
			
			// Open statement
			$stmt = null;
		}
		return $retValue;
	}
	/**
	 * After SELECT, fetch line by line and pass it to the callback function
	 *
	 * @param  object		Value passed to the callback function
	 * @return bool			true = normal completion, false = abnormal end
	 */
	function _execLoop($param = null)
	{
		// Return value Initialization
		$retValue = false;
		
		try {
			// Connect to DB
			$con = self::_getConnection();
			
			if ($con != null){
				// SQL execution
				$stmt = $con->prepare($this->_statement);
				$stmt->execute($this->_params);
				$this->_effectedRowCount = $stmt->rowCount();	// Number of rows affected by the most recent DELETE, INSERT, and UPDATE statements
			
				// Fetch processing
				self::_fetch($stmt, $param);

				// Open statement
				$stmt = null;
			
				// Successful completion
				$retValue = true;
			}
		} catch (PDOException $e) {
			// Common error handling
			self::_onError($e);
			
			// Open statement
			$stmt = null;
		}	
		return $retValue;
	}
	/**
	 * Transaction start
	 *
	 * @return bool			true = normal completion, false = abnormal end
	 */
	function _beginTransaction()
	{
		// Return value Initialization
		$retValue = false;
		
		try {
			// Connect to DB
			$con = self::_getConnection();
			
			if ($con != null){
				// Transaction start
				$con->beginTransaction();

				// Successful completion
				$retValue = true;
			}
		} catch (PDOException $e) {
			// Common error handling
			self::_onError($e);
		}	
		return $retValue;
	}
	/**
	 * Transaction commit
	 *
	 * @return bool			true = normal completion, false = abnormal end
	 */
	function _commit()
	{
		// Return value Initialization
		$retValue = false;
		
		try {
			// Connect to DB
			$con = self::_getConnection();
			
			if ($con != null){
				// commit
				$con->commit();

				// Successful completion
				$retValue = true;
			}
		} catch (PDOException $e) {
			// Common error handling
			self::_onError($e);
		}	
		return $retValue;
	}
	/**
	 * Transaction rollback
	 *
	 * @return bool			true = normal completion, false = abnormal end
	 */
	function _rollBack()
	{
		// Return value Initialization
		$retValue = false;
		
		try {
			// Connect to DB
			$con = self::_getConnection();
			
			if ($con != null){
				// roll back
				$con->rollBack();

				// Successful completion
				$retValue = true;
			}
		} catch (PDOException $e) {
			// Common error handling
			self::_onError($e);
		}	
		return $retValue;
	}
	/**
	 * Common error handling
	 *
	 * @param exception $ex		Exception object
	 * @param string $message	Additional messages
	 */
	function _onError($ex, $message = '')
	{
		// Error status set
		self::$_tranStatus = self::DB_ERROR;
	
		if (self::$_displayErrMessage){		// When outputting an error message
			echo 'DB failed: ' . $ex->getMessage();
			echo '    error code: ' . $ex->getCode();
		}
		array_push($this->_errorMsg, $ex->getMessage());
		
		// Output error message to log
		if (!empty($message)) $msg = ': ' . $message;
	}
	/**
	 * Whether to output error message
	 *
	 * @param bool $status	true = Output error message, false = No error message is output
	 */
	function displayErrMessage($status)
	{	
		self::$_displayErrMessage = $status;
	}
	/**
	 * Get output status of error message
	 *
	 * @return bool 		true = Output error message, false = No error message is output
	 */
	function getDisplayErrMessage()
	{	
		return self::$_displayErrMessage;
	}
	/**
	 * Transaction start
	 *
	 * @return None
	 */
	function startTransaction()
	{
		self::$_tranStatus = self::DB_NO_ERROR;
		self::_beginTransaction();
		
		// Set transaction state
		self::$_inTran = true;			// Transaction in progress
	}
	/**
	 * End transaction
	 *
	 * @return bool		true = complete until commit, false = if an error occurs rollback and return value
	 */
	function endTransaction()
	{
		if (self::$_tranStatus == self::DB_NO_ERROR){
			self::_commit();
		} else {
			self::_rollback();
		}
		
		// Cancel transaction state
		self::$_inTran = false;
		
		// Returns true if the commit succeeded
		if (self::$_tranStatus == self::DB_NO_ERROR){
			return true;
		} else {
			return false;
		}
	}
	/**
	 * Stop transaction
	 */
	function cancelTransaction()
	{
		// Error status set
		self::$_tranStatus = self::DB_ERROR;
	}
	/**
	 * Retrieve whether transaction is in progress
	 *
	 * @return bool			true = during transaction, false = not in transaction
	 */
	function isInTransaction()
	{
		return self::$_inTran;
	}
	/**
	 * Acquire error message
	 *
	 * @return string			Error message
	 */
	function getErrMsg()
	{
		return $this->_errorMsg;
	}
	/**
	 * Execute SQL
	 *
	 * @param  string $query			SQL text
	 * @param  array  $querryParams		Parameters to embed in the query
	 * @return bool						true = normal completion, false = abnormal end
	 */
	function execStatement($query, $queryParams)
	{
		// Set SQL to execute
		self::_setStatement($query, $queryParams);
		
		return self::_execStatement();
	}
	/**
	 * After executing SELECT statement, fetch line by line and pass it to the callback function
	 *
	 * @param  string $query			SELECT text
	 * @param  array  $querryParams		Parameters to embed in the query
	 * @param  function  $callback		Callback function
	 * @param  array  $param			Value passed to the callback function
	 * @return 							None
	 */
	function selectLoop($query, $queryParams, $callback, $param = null)
	{
		// Set SQL to execute
		self::_setStatement($query, $queryParams);
		
		// Set callback function
		self::_setFetchCallback($callback);
		
		// Execute SQL and process it line by line
		self::_execLoop($param);
	}
	/**
	 * After executing the SELECT statement, acquire one row
	 *
	 * @param  string $query			SELECT text
	 * @param  array  $querryParams		Parameters to embed in the query
	 * @param  array  $row				Row acquired
	 * @return bool						true = data exists, false = no data
	 */
	function selectRecord($query, $queryParams, &$row)
	{
		// Return value Initialization
		$retValue = false;
		
		try {
			// Connect to DB
			$con = self::_getConnection();
			
			if ($con != null){
				// SQL execution
				$stmt = $con->prepare($query);
				$stmt->execute($queryParams);
			
				// Fetch processing
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				if ($row) $retValue = true;// Successful completion

				// Open statement
				$stmt = null;
			}
		} catch (PDOException $e) {
			// Common error handling
			self::_onError($e);
			
			// Open statement
			$stmt = null;
		}	
		return $retValue;
	}
	/**
	 * Execute a SELECT statement to get all the rows
	 *
	 * @param  string $query			SELECT text
	 * @param  array  $querryParams		Parameters to embed in the query
	 * @param  array  $rows				Row acquired
	 * @return bool						true = data exists, false = no data
	 */
	function selectRecords($query, $queryParams, &$rows)
	{
		// Return value Initialization
		$retValue = false;
		
		try {
			// Connect to DB
			$con = self::_getConnection();
			
			if ($con != null){
				// SQL execution
				$stmt = $con->prepare($query);
				$stmt->execute($queryParams);
			
				// Perform fetch processing, copy data
				$retRows = array();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$retRows[] = $row;
					$retValue = true;// With data
				}
				$rows = $retRows;
			
				// Open statement
				$stmt = null;
			}
		} catch (PDOException $e) {
			// Common error handling
			self::_onError($e);
			
			// Open statements
			$stmt = null;
		}	
		return $retValue;
	}
	/**
	 * Open statement
	 *
	 * @param  string $query			SELECT text
	 * @param  array  $querryParams		Parameters to embed in the query
	 * @param  string $keyField			Table field name to be key
	 * @param  string $valueField		Table field name to be value
	 * @param  array  $destArray		Associative array data of SELECT result
	 * @return bool						true = data exists, false = no data
	 */
	function selectRecordsToArray($query, $queryParams, $keyField, $valueField, &$destArray)
	{
		// Return value Initialization
		$retValue = false;
		
		try {
			// Connect to DB
			$con = self::_getConnection();
			
			if ($con != null){
				// SQL execution
				$stmt = $con->prepare($query);
				$stmt->execute($queryParams);
			
				// Perform fetch processing, copy data
				$retArray = array();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$retArray[$row[$keyField]] = $row[$valueField];
					$retValue = true;// With data
				}
				$destArray = $retArray;
			
				// Open statement
				$stmt = null;
			}
		} catch (PDOException $e) {
			// Common error handling
			self::_onError($e);
			
			// Open statement
			$stmt = null;
		}	
		return $retValue;
	}
	/**
	 * Execute a SELECT statement to get the number of rows
	 *
	 * @param  string $query			SELECT text
	 * @param  array  $querryParams		Parameters to embed in the query
	 * @return int						Rows
	 */
	function selectRecordCount($query, $queryParams)
	{
		// Return value Initialization
		$retValue = 0;
		
		try {
			// Connect to DB
			$con = self::_getConnection();
			
			if ($con != null){
				// SQL execution
				$stmt = $con->prepare($query);
				$stmt->execute($queryParams);
			
				// Get number of rows
				$retValue = $stmt->rowCount();
			
				// Open statement
				$stmt = null;
			}
		} catch (PDOException $e) {
			// Common error handling
			self::_onError($e);
			
			// Open statement
			$stmt = null;
		}	
		return $retValue;
	}
	/**
	 * Check if there is a records
	 *
	 * @param  string $query			SELECT text
	 * @param  array  $querryParams		Parameters to embed in the query
	 * @return bool						true = recorded, false = no record
	 */
	function isRecordExists($query, $queryParams)
	{
		// Return value Initialization
		$retValue = false;
		
		try {
			// Connect to DB
			$con = self::_getConnection();
			
			if ($con != null){
				// SQL execution
				$stmt = $con->prepare($query);
				$stmt->execute($queryParams);
			
				// Fetch processing
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				if ($row) $retValue = true;

				// Open statement
				$stmt = null;
			}
		} catch (PDOException $e) {
			// Common error handling
			self::_onError($e);
			
			// Open statement
			$stmt = null;
		}	
		return $retValue;
	}
	/**
	 * Returns the number of rows affected by the most recent DELETE, INSERT, and UPDATE statements
	 *
	 * @return int						Rows
	 */
	function getEffectedRowCount()
	{
		return $this->_effectedRowCount;
	}
}
?>
