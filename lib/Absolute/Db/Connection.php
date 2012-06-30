<?php 

namespace Absolute\Db;

use Adapter;

class Connection {

	/**
	* Connection list
	* @var array
	*/
	private static $_connections;

	/**
	* The adapter of connectio
	* @var Absolute\Db\Adapter
	*/
	private $_adapter;

	public function __construct(Adapter $adapter) {
		$this->_adapter = $adapter;
	}

	/**
	* Insert a new row in a table
	* @param string $table The table name
	* @param array $data The cols to be inserted
	* @return int inserted id
	* @throws \RunTimeException When a param is empty
	*/
	public function insert($table, array $data) {
		if( empty($table) )
			throw new \RunTimeException("The table cant not be empty.");

		if( empty( $data ) )
			throw new \RunTimeException("The data cant not be empty.");

		$query = " INSERT INTO " . $this->getAdapter()->getDatabase() . "." . $table . " SET " ;

		foreach( $data as $col => $val )
			$query .= " `{$col}` = '{$val}', ";

		$query = substr( $query, 0, -2 );

		$this->getAdapter()->execute($query);

		return $this->getAdapter()->getLastInsertedId();
	}

	/**
	* Update a row in a table
	* @param string $table The table name
	* @param array $keys Primaries keys from table
	* @param array $data The cols to be updated
	* @throws \RunTimeException When a param is empty
	*/
	public function update($table, array $keys, array $data) {
		if( empty($table) )
			throw new \RunTimeException("The table cant not be empty.");

		if( empty( $keys ) )
			throw new \RunTimeException("The keys cant not be empty.");

		if( empty( $data ) )
			throw new \RunTimeException("The data cant not be empty.");

		$query = "UPDATE " . $this->getAdapter()->getDatabase() . "." . $table . " SET " ;

		foreach( $data as $col => $val )
			$query .= " `{$col}` = '{$val}', ";

		$query = substr( $query, 0, -2 );

		$query .= " WHERE ";

		foreach($keys as $col => $val){
			$query .= " `{$col}` = '{$val}' AND ";
		}

		$query = substr( $query, 0, -4 );


		$this->getAdapter()->execute($query);
	}

}











