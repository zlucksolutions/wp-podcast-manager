<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * ProcessingFee Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class ProcessingFee implements ArrayAccess {

	/**
	 * Array of property to type mappings. Used for (de)serialization
	 *
	 * @var string[]
	 */
	static $swaggerTypes = array(
		'effective_at' => 'string',
		'type'         => 'string',
		'amount_money' => '\SquareConnect\Model\Money',
	);

	/**
	 * Array of attributes where the key is the local name, and the value is the original name
	 *
	 * @var string[]
	 */
	static $attributeMap = array(
		'effective_at' => 'effective_at',
		'type'         => 'type',
		'amount_money' => 'amount_money',
	);

	/**
	 * Array of attributes to setter functions (for deserialization of responses)
	 *
	 * @var string[]
	 */
	static $setters = array(
		'effective_at' => 'setEffectiveAt',
		'type'         => 'setType',
		'amount_money' => 'setAmountMoney',
	);

	/**
	 * Array of attributes to getter functions (for serialization of requests)
	 *
	 * @var string[]
	 */
	static $getters = array(
		'effective_at' => 'getEffectiveAt',
		'type'         => 'getType',
		'amount_money' => 'getAmountMoney',
	);

	/**
	 * $effective_at Timestamp of when the fee takes effect, in RFC 3339 format.
	 *
	 * @var string
	 */
	protected $effective_at;
	/**
	 * $type The type of fee assessed or adjusted. Can be one of: `INITIAL`, `ADJUSTMENT`.
	 *
	 * @var string
	 */
	protected $type;
	/**
	 * $amount_money The fee amount assessed or adjusted by Square. May be negative.  Positive values represent funds being assessed, while negative values represent funds being returned.
	 *
	 * @var \SquareConnect\Model\Money
	 */
	protected $amount_money;

	/**
	 * Constructor
	 *
	 * @param mixed[] $data Associated array of property value initializing the model
	 */
	public function __construct( array $data = null ) {
		if ( $data != null ) {
			if ( isset( $data['effective_at'] ) ) {
				$this->effective_at = $data['effective_at'];
			} else {
				$this->effective_at = null;
			}
			if ( isset( $data['type'] ) ) {
				$this->type = $data['type'];
			} else {
				$this->type = null;
			}
			if ( isset( $data['amount_money'] ) ) {
				$this->amount_money = $data['amount_money'];
			} else {
				$this->amount_money = null;
			}
		}
	}
	/**
	 * Gets effective_at
	 *
	 * @return string
	 */
	public function getEffectiveAt() {
		return $this->effective_at;
	}

	/**
	 * Sets effective_at
	 *
	 * @param string $effective_at Timestamp of when the fee takes effect, in RFC 3339 format.
	 * @return $this
	 */
	public function setEffectiveAt( $effective_at ) {
		$this->effective_at = $effective_at;
		return $this;
	}
	/**
	 * Gets type
	 *
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets type
	 *
	 * @param string $type The type of fee assessed or adjusted. Can be one of: `INITIAL`, `ADJUSTMENT`.
	 * @return $this
	 */
	public function setType( $type ) {
		$this->type = $type;
		return $this;
	}
	/**
	 * Gets amount_money
	 *
	 * @return \SquareConnect\Model\Money
	 */
	public function getAmountMoney() {
		return $this->amount_money;
	}

	/**
	 * Sets amount_money
	 *
	 * @param \SquareConnect\Model\Money $amount_money The fee amount assessed or adjusted by Square. May be negative.  Positive values represent funds being assessed, while negative values represent funds being returned.
	 * @return $this
	 */
	public function setAmountMoney( $amount_money ) {
		$this->amount_money = $amount_money;
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
