<?php
define( 'EZSQL_VERSION', 'EP1.00' );
define( 'OBJECT', 'OBJECT', true );
define( 'OBJECT_K', 'OBJECT_K' );
define( 'ARRAY_A', 'ARRAY_A' );
define( 'ARRAY_N', 'ARRAY_N' );
class epdb {
	var $show_errors = false;
	var $suppress_errors = false;
	var $last_error = '';
	var $num_queries = 0;
	var $num_rows = 0;
	var $rows_affected = 0;
	var $insert_id = 0;
	var $last_query;
	var $last_result;
	protected $result;
	protected $col_info;
	var $queries;
	var $prefix = TABLE_PREFIX;
	var $ready = false;
	var $blogid = 0;
	var $siteid = 0;
	var $tables = array( 'page', 'comments', 'news', 'options');	
	var $comments;
	var $commentmeta;
	var $links;
	var $options;
	var $postmeta;
	var $posts;
	var $terms;
	var $term_relationships;
	var $term_taxonomy;
	var $usermeta;
	var $users;
	var $blogs;
	var $blog_versions;
	var $registration_log;
	var $signups;
	var $site;
	var $sitecategories;
	var $sitemeta;
	var $field_types = array();
	var $charset;
	var $collate;
	var $real_escape = false;
	protected $dbuser;
	protected $dbpassword;
	protected $dbname;
	protected $dbhost;
	protected $dbh;
	var $func_call;
	public $is_mysql = null;
	function __construct( $dbuser, $dbpassword, $dbname, $dbhost ) {
		register_shutdown_function( array( $this, '__destruct' ) );

		if ( EP_DEBUG )
			$this->show_errors();

		$this->init_charset();

		$this->dbuser = $dbuser;
		$this->dbpassword = $dbpassword;
		$this->dbname = $dbname;
		$this->dbhost = $dbhost;

		$this->db_connect();
	}

	function __destruct() {
		return true;
	}

	function __get( $name ) {
		if ( 'col_info' == $name )
			$this->load_col_info();

		return $this->$name;
	}

	function __set( $name, $value ) {
		$this->$name = $value;
	}

	function __isset( $name ) {
		return isset( $this->$name );
	}

	function __unset( $name ) {
		unset( $this->$name );
	}

	function init_charset() {
		if ( defined( 'DB_CHARSET' ) )
			$this->charset = DB_CHARSET;
	}

	function set_charset($dbh, $charset = null, $collate = null) {
		if ( !isset($charset) )
			$charset = $this->charset;
		if ( !isset($collate) )
			$collate = $this->collate;
		if ( $this->has_cap( 'collation', $dbh ) && !empty( $charset ) ) {
			if ( function_exists( 'mysql_set_charset' ) && $this->has_cap( 'set_charset', $dbh ) ) {
				mysql_set_charset( $charset, $dbh );
				$this->real_escape = true;
			} else {
				$query = $this->prepare( 'SET NAMES %s', $charset );
				if ( ! empty( $collate ) )
					$query .= $this->prepare( ' COLLATE %s', $collate );
				mysql_query( $query, $dbh );
			}
		}
	}

	function set_prefix( $prefix, $set_table_names = true ) {
		return $this->prefix;
	}

	function select( $db, $dbh = null ) {
		if ( is_null($dbh) )
			$dbh = $this->dbh;

		if ( !@mysql_select_db( $db, $dbh ) ) {
			$this->ready = false;			
			$this->bail( '<h1>Can&#8217;t select database</h1>' );
			return;
		}
	}
	function _weak_escape( $string ) {
		return addslashes( $string );
	}


	function _real_escape( $string ) {
		if ( $this->dbh && $this->real_escape )
			return mysql_real_escape_string( $string, $this->dbh );
		else
			return addslashes( $string );
	}

	function _escape( $data ) {
		if ( is_array( $data ) ) {
			foreach ( (array) $data as $k => $v ) {
				if ( is_array($v) )
					$data[$k] = $this->_escape( $v );
				else
					$data[$k] = $this->_real_escape( $v );
			}
		} else {
			$data = $this->_real_escape( $data );
		}

		return $data;
	}

	function escape( $data ) {
		if ( is_array( $data ) ) {
			foreach ( (array) $data as $k => $v ) {
				if ( is_array( $v ) )
					$data[$k] = $this->escape( $v );
				else
					$data[$k] = $this->_weak_escape( $v );
			}
		} else {
			$data = $this->_weak_escape( $data );
		}

		return $data;
	}

	function escape_by_ref( &$string ) {
		if ( ! is_float( $string ) )
			$string = $this->_real_escape( $string );
	}

	function prepare( $query, $args = null ) {
		if ( is_null( $query ) )
			return;

		if ( func_num_args() < 2 )
			_doing_it_wrong( 'epdb::prepare', 'epdb::prepare() requires at least two arguments.', '3.5' );

		$args = func_get_args();
		array_shift( $args );
		// If args were passed as an array (as in vsprintf), move them up
		if ( isset( $args[0] ) && is_array($args[0]) )
			$args = $args[0];
		$query = str_replace( "'%s'", '%s', $query ); // in case someone mistakenly already singlequoted it
		$query = str_replace( '"%s"', '%s', $query ); // doublequote unquoting
		$query = preg_replace( '|(?<!%)%f|' , '%F', $query ); // Force floats to be locale unaware
		$query = preg_replace( '|(?<!%)%s|', "'%s'", $query ); // quote the strings, avoiding escaped strings like %%s
		array_walk( $args, array( $this, 'escape_by_ref' ) );
		return @vsprintf( $query, $args );
	}


	function print_error( $str = '' ) {
		global $EZSQL_ERROR;

		if ( !$str )
			$str = mysql_error( $this->dbh );
		$EZSQL_ERROR[] = array( 'query' => $this->last_query, 'error_str' => $str );

		if ( $this->suppress_errors )
			return false;
		

		if ( $caller = $this->get_caller() )
			$error_str = 'ePaper database error '.$str.' for query '.$this->last_query.' made by '.$caller;
		else
			$error_str = 'ePaper database error '.$str.' for query '.$this->last_query;

		error_log( $error_str );

		// Are we showing errors?
		if ( ! $this->show_errors )
			return false;

		// If there is an error then take note of it

			$str   = htmlspecialchars( $str, ENT_QUOTES );
			$query = htmlspecialchars( $this->last_query, ENT_QUOTES );

			print "<div id='error'>
			<p class='epdberror'><strong>ePaper database error:</strong> [$str]<br />
			<code>$query</code></p>
			</div>";
		
	}


	function show_errors( $show = true ) {
		$errors = $this->show_errors;
		$this->show_errors = $show;
		return $errors;
	}

	
	function hide_errors() {
		$show = $this->show_errors;
		$this->show_errors = false;
		return $show;
	}

	function suppress_errors( $suppress = true ) {
		$errors = $this->suppress_errors;
		$this->suppress_errors = (bool) $suppress;
		return $errors;
	}


	function flush() {
		$this->last_result = array();
		$this->col_info    = null;
		$this->last_query  = null;

		if ( is_resource( $this->result ) )
			mysql_free_result( $this->result );
	}

	function db_connect() {

		$this->is_mysql = true;

		$new_link = defined( 'MYSQL_NEW_LINK' ) ? MYSQL_NEW_LINK : true;
		$client_flags = defined( 'MYSQL_CLIENT_FLAGS' ) ? MYSQL_CLIENT_FLAGS : 0;

		if ( EP_DEBUG ) {
			$this->dbh = @mysql_connect( $this->dbhost, $this->dbuser, $this->dbpassword, $new_link, $client_flags );
		} else {
			$this->dbh = @mysql_connect( $this->dbhost, $this->dbuser, $this->dbpassword, $new_link, $client_flags );
		}

		if ( !$this->dbh ) {			
			return;
		}

		$this->set_charset( $this->dbh );

		$this->ready = true;

		$this->select( $this->dbname, $this->dbh );
	}

	function query( $query ) {
		
		 
		if ( ! $this->ready )
			return false;	
			
			 
 
 

 
 
		$return_val = 0;
		$this->flush();

		// Log how the function was called
		$this->func_call = "\$db->query(\"$query\")";

		// Keep track of the last query for debug..
		$this->last_query = $query;

		if ( defined( 'SAVEQUERIES' ) && SAVEQUERIES )
			$this->timer_start();

		$this->result = @mysql_query( $query, $this->dbh );
		$this->num_queries++;
		
		 
		

		if ( defined( 'SAVEQUERIES' ) && SAVEQUERIES )
			$this->queries[] = array( $query, $this->timer_stop(), $this->get_caller() );

		// If there is an error then take note of it..
		if ( $this->last_error = mysql_error( $this->dbh ) ) {
			$this->print_error();
			return false;
		}

		if ( preg_match( '/^\s*(create|alter|truncate|drop)\s/i', $query ) ) {
			$return_val = $this->result;
		} elseif ( preg_match( '/^\s*(insert|delete|update|replace)\s/i', $query ) ) {
			$this->rows_affected = mysql_affected_rows( $this->dbh );
			// Take note of the insert_id
			if ( preg_match( '/^\s*(insert|replace)\s/i', $query ) ) {
				$this->insert_id = mysql_insert_id($this->dbh);
			}
			// Return number of rows affected
			$return_val = $this->rows_affected;
		} else {
			$num_rows = 0;
			while ( $row = mysql_fetch_object( $this->result ) ) {
				$this->last_result[$num_rows] = $row;
				$num_rows++;
				 
			}



			// Log number of rows the query returned
			// and return number of rows selected
			$this->num_rows = $num_rows;
			$return_val     = $num_rows;
		}

		return $return_val;
	}


	function insert( $table, $data, $format = null ) {
		return $this->_insert_replace_helper( $table, $data, $format, 'INSERT' );
	}


	function replace( $table, $data, $format = null ) {
		return $this->_insert_replace_helper( $table, $data, $format, 'REPLACE' );
	}


	function _insert_replace_helper( $table, $data, $format = null, $type = 'INSERT' ) {
		if ( ! in_array( strtoupper( $type ), array( 'REPLACE', 'INSERT' ) ) )
			return false;
		$formats = $format = (array) $format;
		$fields = array_keys( $data );
		$formatted_fields = array();
		foreach ( $fields as $field ) {
			if ( !empty( $format ) )
				$form = ( $form = array_shift( $formats ) ) ? $form : $format[0];
			elseif ( isset( $this->field_types[$field] ) )
				$form = $this->field_types[$field];
			else
				$form = '%s';
			$formatted_fields[] = $form;
		}
		$sql = "{$type} INTO `$table` (`" . implode( '`,`', $fields ) . "`) VALUES (" . implode( ",", $formatted_fields ) . ")";
		return $this->query( $this->prepare( $sql, $data ) );
	}


	function update( $table, $data, $where, $format = null, $where_format = null ) {
		if ( ! is_array( $data ) || ! is_array( $where ) )
			return false;

		$formats = $format = (array) $format;
		$bits = $wheres = array();
		foreach ( (array) array_keys( $data ) as $field ) {
			if ( !empty( $format ) )
				$form = ( $form = array_shift( $formats ) ) ? $form : $format[0];
			elseif ( isset($this->field_types[$field]) )
				$form = $this->field_types[$field];
			else
				$form = '%s';
			$bits[] = "`$field` = {$form}";
		}

		$where_formats = $where_format = (array) $where_format;
		foreach ( (array) array_keys( $where ) as $field ) {
			if ( !empty( $where_format ) )
				$form = ( $form = array_shift( $where_formats ) ) ? $form : $where_format[0];
			elseif ( isset( $this->field_types[$field] ) )
				$form = $this->field_types[$field];
			else
				$form = '%s';
			$wheres[] = "`$field` = {$form}";
		}

		$sql = "UPDATE `$table` SET " . implode( ', ', $bits ) . ' WHERE ' . implode( ' AND ', $wheres );
		return $this->query( $this->prepare( $sql, array_merge( array_values( $data ), array_values( $where ) ) ) );
	}

	
	function delete( $table, $where, $where_format = null ) {
		if ( ! is_array( $where ) )
			return false;

		$bits = $wheres = array();

		$where_formats = $where_format = (array) $where_format;

		foreach ( array_keys( $where ) as $field ) {
			if ( !empty( $where_format ) ) {
				$form = ( $form = array_shift( $where_formats ) ) ? $form : $where_format[0];
			} elseif ( isset( $this->field_types[ $field ] ) ) {
				$form = $this->field_types[ $field ];
			} else {
				$form = '%s';
			}

			$wheres[] = "$field = $form";
		}

		$sql = "DELETE FROM $table WHERE " . implode( ' AND ', $wheres );
		return $this->query( $this->prepare( $sql, $where ) );
	}


	function get_var( $query = null, $x = 0, $y = 0 ) {
		$this->func_call = "\$db->get_var(\"$query\", $x, $y)";
		if ( $query )
			$this->query( $query );

		// Extract var out of cached results based x,y vals
		if ( !empty( $this->last_result[$y] ) ) {
			$values = array_values( get_object_vars( $this->last_result[$y] ) );
		}

		// If there is a value return it else return null
		return ( isset( $values[$x] ) && $values[$x] !== '' ) ? $values[$x] : null;
	}


	function get_row( $query = null, $output = OBJECT, $y = 0 ) {
		$this->func_call = "\$db->get_row(\"$query\",$output,$y)";
		
		 
		
		if ( $query )
			$this->query( $query );
		else
			return null;





		if ( !isset( $this->last_result[$y] ) )
			return null;

 

		if ( $output == OBJECT ) {
			return $this->last_result[$y] ? $this->last_result[$y] : null;
		} elseif ( $output == ARRAY_A ) {
			return $this->last_result[$y] ? get_object_vars( $this->last_result[$y] ) : null;
		} elseif ( $output == ARRAY_N ) {
			return $this->last_result[$y] ? array_values( get_object_vars( $this->last_result[$y] ) ) : null;
		} else {
			$this->print_error( " \$db->get_row(string query, output type, int offset) -- Output type must be one of: OBJECT, ARRAY_A, ARRAY_N" );
		}
	}


	function get_col( $query = null , $x = 0 ) {
		if ( $query )
			$this->query( $query );

		$new_array = array();
		// Extract the column values
		for ( $i = 0, $j = count( $this->last_result ); $i < $j; $i++ ) {
			$new_array[$i] = $this->get_var( null, $x, $i );
		}
		return $new_array;
	}


	function get_results( $query = null, $output = OBJECT ) {
		$this->func_call = "\$db->get_results(\"$query\", $output)";

		if ( $query )
			$this->query( $query );
		else
			return null;

		$new_array = array();
		if ( $output == OBJECT ) {
			// Return an integer-keyed array of row objects
			return $this->last_result;
		} elseif ( $output == OBJECT_K ) {
			// Return an array of row objects with keys from column 1
			// (Duplicates are discarded)
			foreach ( $this->last_result as $row ) {
				$var_by_ref = get_object_vars( $row );
				$key = array_shift( $var_by_ref );
				if ( ! isset( $new_array[ $key ] ) )
					$new_array[ $key ] = $row;
			}
			return $new_array;
		} elseif ( $output == ARRAY_A || $output == ARRAY_N ) {
			// Return an integer-keyed array of...
			if ( $this->last_result ) {
				foreach( (array) $this->last_result as $row ) {
					if ( $output == ARRAY_N ) {
						// ...integer-keyed row arrays
						$new_array[] = array_values( get_object_vars( $row ) );
					} else {
						// ...column name-keyed row arrays
						$new_array[] = get_object_vars( $row );
					}
				}
			}
			return $new_array;
		}
		return null;
	}

	protected function load_col_info() {
		if ( $this->col_info )
			return;

		for ( $i = 0; $i < @mysql_num_fields( $this->result ); $i++ ) {
			$this->col_info[ $i ] = @mysql_fetch_field( $this->result, $i );
		}
	}


	function get_col_info( $info_type = 'name', $col_offset = -1 ) {
		$this->load_col_info();

		if ( $this->col_info ) {
			if ( $col_offset == -1 ) {
				$i = 0;
				$new_array = array();
				foreach( (array) $this->col_info as $col ) {
					$new_array[$i] = $col->{$info_type};
					$i++;
				}
				return $new_array;
			} else {
				return $this->col_info[$col_offset]->{$info_type};
			}
		}
	}

	
	function timer_start() {
		$this->time_start = microtime( true );
		return true;
	}

	function timer_stop() {
		return ( microtime( true ) - $this->time_start );
	}


	function bail( $message, $error_code = '500' ) {	
		die($message);
	}


	function check_database_version() {	}
	
	function supports_collation() {
		_deprecated_function( __FUNCTION__, '3.5', 'epdb::has_cap( \'collation\' )' );
		return $this->has_cap( 'collation' );
	}


	public function get_charset_collate() {
		$charset_collate = '';

		if ( ! empty( $this->charset ) )
			$charset_collate = "DEFAULT CHARACTER SET $this->charset";
		if ( ! empty( $this->collate ) )
			$charset_collate .= " COLLATE $this->collate";

		return $charset_collate;
	}

	function has_cap( $db_cap ) {
		$version = $this->db_version();

		switch ( strtolower( $db_cap ) ) {
			case 'collation' :    // @since 2.5.0
			case 'group_concat' : // @since 2.7
			case 'subqueries' :   // @since 2.7
				return version_compare( $version, '4.1', '>=' );
			case 'set_charset' :
				return version_compare($version, '5.0.7', '>=');
		};

		return false;
	}


	function get_caller() {
		
	}

	function db_version() {
		return preg_replace( '/[^0-9.].*/', '', mysql_get_server_info( $this->dbh ) );
	}
}