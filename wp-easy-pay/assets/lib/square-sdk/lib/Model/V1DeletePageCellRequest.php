<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * V1DeletePageCellRequest Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class V1DeletePageCellRequest implements ArrayAccess {

	/**
	 * Array of property to type mappings. Used for (de)serialization
	 *
	 * @var string[]
	 */
	static $swaggerTypes = array(
		'row'    => 'string',
		'column' => 'string',
	);

	/**
	 * Array of attributes where the key is the local name, and the value is the original name
	 *
	 * @var string[]
	 */
	static $attributeMap = array(
		'row'    => 'row',
		'column' => 'column',
	);

	/**
	 * Array of attributes to setter functions (for deserialization of responses)
	 *
	 * @var string[]
	 */
	static $setters = array(
		'row'    => 'setRow',
		'column' => 'setColumn',
	);

	/**
	 * Array of attributes to getter functions (for serialization of requests)
	 *
	 * @var string[]
	 */
	static $getters = array(
		'row'    => 'getRow',
		'column' => 'getColumn',
	);

	/**
	 * $row The row of the cell to clear. Always an integer between 0 and 4, inclusive. Row 0 is the top row.
	 *
	 * @var string
	 */
	protected $row;
	/**
	 * $column The column of the cell to clear. Always an integer between 0 and 4, inclusive. Column 0 is the leftmost column.
	 *
	 * @var string
	 */
	protected $column;

	/**
	 * Constructor
	 *
	 * @param mixed[] $data Associated array of property value initializing the model
	 */
	public function __construct( array $data = null ) {
		if ( $data != null ) {
			if ( isset( $data['row'] ) ) {
				$this->row = $data['row'];
			} else {
				$this->row = null;
			}
			if ( isset( $data['column'] ) ) {
				$this->column = $data['column'];
			} else {
				$this->column = null;
			}
		}
	}
	/**
	 * Gets row
	 *
	 * @return string
	 */
	public function getRow() {
		return $this->row;
	}

	/**
	 * Sets row
	 *
	 * @param string $row The row of the cell to clear. Always an integer between 0 and 4, inclusive. Row 0 is the top row.
	 * @return $this
	 */
	public function setRow( $row ) {
		$this->row = $row;
		return $this;
	}
	/**
	 * Gets column
	 *
	 * @return string
	 */
	public function getColumn() {
		return $this->column;
	}

	/**
	 * Sets column
	 *
	 * @param string $column The column of the cell to clear. Always an integer between 0 and 4, inclusive. Column 0 is the leftmost column.
	 * @return $this
	 */
	public function setColumn( $column ) {
		$this->column = $column;
		return $this;
	}
	/**
	 * Returns true if offset exists. False otherwise.
	 *
	 * @param  integer $offset Offset
	 * @return boolean
	 */
	public function offsetExists( $offset ) {
		return isset( $this->$offset );
	}

	/**
	 * Gets offset.
	 *
	 * @param  integer $offset Offset
	 * @return mixed
	 */
	public function offsetGet( $offset ) {
		return $this->$offset;
	}

	/**
	 * Sets value based on offset.
	 *
	 * @param  integer $offset Offset
	 * @param  mixed   $value  Value to be set
	 * @return void
	 */
	public function offsetSet( $offset, $value ) {
		$this->$offset = $value;
	}

	/**
	 * Unsets offset.
	 *
	 * @param  integer $offset Offset
	 * @return void
	 */
	public function offsetUnset( $offset ) {
		unset( $this->$offset );
	}

	/**
	 * Gets the string presentation of the object
	 *
	 * @return string
	 */
	public function __toString() {
		if ( defined( 'JSON_PRETTY_PRINT' ) ) {
			return json_encode( \SquareConnect\ObjectSerializer::sanitizeForSerialization( $this ), JSON_PRETTY_PRINT );
		} else {
			return json_encode( \SquareConnect\ObjectSerializer::sanitizeForSerialization( $this ) );
		}
	}
}
