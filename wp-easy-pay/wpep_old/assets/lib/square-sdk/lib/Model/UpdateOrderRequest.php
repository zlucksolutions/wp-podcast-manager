<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * UpdateOrderRequest Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class UpdateOrderRequest implements ArrayAccess {

	/**
	 * Array of property to type mappings. Used for (de)serialization
	 *
	 * @var string[]
	 */
	static $swaggerTypes = array(
		'order'           => '\SquareConnect\Model\Order',
		'fields_to_clear' => 'string[]',
		'idempotency_key' => 'string',
	);

	/**
	 * Array of attributes where the key is the local name, and the value is the original name
	 *
	 * @var string[]
	 */
	static $attributeMap = array(
		'order'           => 'order',
		'fields_to_clear' => 'fields_to_clear',
		'idempotency_key' => 'idempotency_key',
	);

	/**
	 * Array of attributes to setter functions (for deserialization of responses)
	 *
	 * @var string[]
	 */
	static $setters = array(
		'order'           => 'setOrder',
		'fields_to_clear' => 'setFieldsToClear',
		'idempotency_key' => 'setIdempotencyKey',
	);

	/**
	 * Array of attributes to getter functions (for serialization of requests)
	 *
	 * @var string[]
	 */
	static $getters = array(
		'order'           => 'getOrder',
		'fields_to_clear' => 'getFieldsToClear',
		'idempotency_key' => 'getIdempotencyKey',
	);

	/**
	 * $order The [sparse order](/orders-api/manage-orders#sparse-order-objects) containing only the fields to update and the version the update is being applied to.
	 *
	 * @var \SquareConnect\Model\Order
	 */
	protected $order;
	/**
	 * $fields_to_clear The [dot notation paths](/orders-api/manage-orders#on-dot-notation) fields to clear. For example, `line_items[uid].note` [Read more about Deleting fields](/orders-api/manage-orders#delete-fields).
	 *
	 * @var string[]
	 */
	protected $fields_to_clear;
	/**
	 * $idempotency_key A value you specify that uniquely identifies this update request  If you're unsure whether a particular update was applied to an order successfully, you can reattempt it with the same idempotency key without worrying about creating duplicate updates to the order. The latest order version will be returned.  See [Idempotency](/basics/api101/idempotency) for more information.
	 *
	 * @var string
	 */
	protected $idempotency_key;

	/**
	 * Constructor
	 *
	 * @param mixed[] $data Associated array of property value initializing the model
	 */
	public function __construct( array $data = null ) {
		if ( $data != null ) {
			if ( isset( $data['order'] ) ) {
				$this->order = $data['order'];
			} else {
				$this->order = null;
			}
			if ( isset( $data['fields_to_clear'] ) ) {
				$this->fields_to_clear = $data['fields_to_clear'];
			} else {
				$this->fields_to_clear = null;
			}
			if ( isset( $data['idempotency_key'] ) ) {
				$this->idempotency_key = $data['idempotency_key'];
			} else {
				$this->idempotency_key = null;
			}
		}
	}
	/**
	 * Gets order
	 *
	 * @return \SquareConnect\Model\Order
	 */
	public function getOrder() {
		return $this->order;
	}

	/**
	 * Sets order
	 *
	 * @param \SquareConnect\Model\Order $order The [sparse order](/orders-api/manage-orders#sparse-order-objects) containing only the fields to update and the version the update is being applied to.
	 * @return $this
	 */
	public function setOrder( $order ) {
		$this->order = $order;
		return $this;
	}
	/**
	 * Gets fields_to_clear
	 *
	 * @return string[]
	 */
	public function getFieldsToClear() {
		return $this->fields_to_clear;
	}

	/**
	 * Sets fields_to_clear
	 *
	 * @param string[] $fields_to_clear The [dot notation paths](/orders-api/manage-orders#on-dot-notation) fields to clear. For example, `line_items[uid].note` [Read more about Deleting fields](/orders-api/manage-orders#delete-fields).
	 * @return $this
	 */
	public function setFieldsToClear( $fields_to_clear ) {
		$this->fields_to_clear = $fields_to_clear;
		return $this;
	}
	/**
	 * Gets idempotency_key
	 *
	 * @return string
	 */
	public function getIdempotencyKey() {
		return $this->idempotency_key;
	}

	/**
	 * Sets idempotency_key
	 *
	 * @param string $idempotency_key A value you specify that uniquely identifies this update request  If you're unsure whether a particular update was applied to an order successfully, you can reattempt it with the same idempotency key without worrying about creating duplicate updates to the order. The latest order version will be returned.  See [Idempotency](/basics/api101/idempotency) for more information.
	 * @return $this
	 */
	public function setIdempotencyKey( $idempotency_key ) {
		$this->idempotency_key = $idempotency_key;
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
