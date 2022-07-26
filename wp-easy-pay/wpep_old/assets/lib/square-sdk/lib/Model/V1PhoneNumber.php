<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * V1PhoneNumber Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class V1PhoneNumber implements ArrayAccess {

	/**
	 * Array of property to type mappings. Used for (de)serialization
	 *
	 * @var string[]
	 */
	static $swaggerTypes = array(
		'calling_code' => 'string',
		'number'       => 'string',
	);

	/**
	 * Array of attributes where the key is the local name, and the value is the original name
	 *
	 * @var string[]
	 */
	static $attributeMap = array(
		'calling_code' => 'calling_code',
		'number'       => 'number',
	);

	/**
	 * Array of attributes to setter functions (for deserialization of responses)
	 *
	 * @var string[]
	 */
	static $setters = array(
		'calling_code' => 'setCallingCode',
		'number'       => 'setNumber',
	);

	/**
	 * Array of attributes to getter functions (for serialization of requests)
	 *
	 * @var string[]
	 */
	static $getters = array(
		'calling_code' => 'getCallingCode',
		'number'       => 'getNumber',
	);

	/**
	 * $calling_code The phone number's international calling code. For US phone numbers, this value is +1.
	 *
	 * @var string
	 */
	protected $calling_code;
	/**
	 * $number The phone number.
	 *
	 * @var string
	 */
	protected $number;

	/**
	 * Constructor
	 *
	 * @param mixed[] $data Associated array of property value initializing the model
	 */
	public function __construct( array $data = null ) {
		if ( $data != null ) {
			if ( isset( $data['calling_code'] ) ) {
				$this->calling_code = $data['calling_code'];
			} else {
				$this->calling_code = null;
			}
			if ( isset( $data['number'] ) ) {
				$this->number = $data['number'];
			} else {
				$this->number = null;
			}
		}
	}
	/**
	 * Gets calling_code
	 *
	 * @return string
	 */
	public function getCallingCode() {
		return $this->calling_code;
	}

	/**
	 * Sets calling_code
	 *
	 * @param string $calling_code The phone number's international calling code. For US phone numbers, this value is +1.
	 * @return $this
	 */
	public function setCallingCode( $calling_code ) {
		$this->calling_code = $calling_code;
		return $this;
	}
	/**
	 * Gets number
	 *
	 * @return string
	 */
	public function getNumber() {
		return $this->number;
	}

	/**
	 * Sets number
	 *
	 * @param string $number The phone number.
	 * @return $this
	 */
	public function setNumber( $number ) {
		$this->number = $number;
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
