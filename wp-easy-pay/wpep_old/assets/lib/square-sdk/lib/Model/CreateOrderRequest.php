<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * CreateOrderRequest Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class CreateOrderRequest implements ArrayAccess {

	/**
	 * Array of property to type mappings. Used for (de)serialization
	 *
	 * @var string[]
	 */
	static $swaggerTypes = array(
		'order'           => '\SquareConnect\Model\Order',
		'idempotency_key' => 'string',
		'reference_id'    => 'string',
		'line_items'      => '\SquareConnect\Model\CreateOrderRequestLineItem[]',
		'taxes'           => '\SquareConnect\Model\CreateOrderRequestTax[]',
		'discounts'       => '\SquareConnect\Model\CreateOrderRequestDiscount[]',
	);

	/**
	 * Array of attributes where the key is the local name, and the value is the original name
	 *
	 * @var string[]
	 */
	static $attributeMap = array(
		'order'           => 'order',
		'idempotency_key' => 'idempotency_key',
		'reference_id'    => 'reference_id',
		'line_items'      => 'line_items',
		'taxes'           => 'taxes',
		'discounts'       => 'discounts',
	);

	/**
	 * Array of attributes to setter functions (for deserialization of responses)
	 *
	 * @var string[]
	 */
	static $setters = array(
		'order'           => 'setOrder',
		'idempotency_key' => 'setIdempotencyKey',
		'reference_id'    => 'setReferenceId',
		'line_items'      => 'setLineItems',
		'taxes'           => 'setTaxes',
		'discounts'       => 'setDiscounts',
	);

	/**
	 * Array of attributes to getter functions (for serialization of requests)
	 *
	 * @var string[]
	 */
	static $getters = array(
		'order'           => 'getOrder',
		'idempotency_key' => 'getIdempotencyKey',
		'reference_id'    => 'getReferenceId',
		'line_items'      => 'getLineItems',
		'taxes'           => 'getTaxes',
		'discounts'       => 'getDiscounts',
	);

	/**
	 * $order The order to create. If this field is set, then the only other top-level field that can be set is the idempotency_key.
	 *
	 * @var \SquareConnect\Model\Order
	 */
	protected $order;
	/**
	 * $idempotency_key A value you specify that uniquely identifies this order among orders you've created.  If you're unsure whether a particular order was created successfully, you can reattempt it with the same idempotency key without worrying about creating duplicate orders.  See [Idempotency](/basics/api101/idempotency) for more information.
	 *
	 * @var string
	 */
	protected $idempotency_key;
	/**
	 * $reference_id __Deprecated__: Please set the reference_id on the nested [order](#type-order) field instead.  An optional ID you can associate with the order for your own purposes (such as to associate the order with an entity ID in your own database).  This value cannot exceed 40 characters.
	 *
	 * @var string
	 */
	protected $reference_id;
	/**
	 * $line_items __Deprecated__: Please set the line_items on the nested [order](#type-order) field instead.  The line items to associate with this order.  Each line item represents a different product to include in a purchase.
	 *
	 * @var \SquareConnect\Model\CreateOrderRequestLineItem[]
	 */
	protected $line_items;
	/**
	 * $taxes __Deprecated__: Please set the taxes on the nested [order](#type-order) field instead.  The taxes to include on the order.
	 *
	 * @var \SquareConnect\Model\CreateOrderRequestTax[]
	 */
	protected $taxes;
	/**
	 * $discounts __Deprecated__: Please set the discounts on the nested [order](#type-order) field instead.  The discounts to include on the order.
	 *
	 * @var \SquareConnect\Model\CreateOrderRequestDiscount[]
	 */
	protected $discounts;

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
			if ( isset( $data['idempotency_key'] ) ) {
				$this->idempotency_key = $data['idempotency_key'];
			} else {
				$this->idempotency_key = null;
			}
			if ( isset( $data['reference_id'] ) ) {
				$this->reference_id = $data['reference_id'];
			} else {
				$this->reference_id = null;
			}
			if ( isset( $data['line_items'] ) ) {
				$this->line_items = $data['line_items'];
			} else {
				$this->line_items = null;
			}
			if ( isset( $data['taxes'] ) ) {
				$this->taxes = $data['taxes'];
			} else {
				$this->taxes = null;
			}
			if ( isset( $data['discounts'] ) ) {
				$this->discounts = $data['discounts'];
			} else {
				$this->discounts = null;
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
	 * @param \SquareConnect\Model\Order $order The order to create. If this field is set, then the only other top-level field that can be set is the idempotency_key.
	 * @return $this
	 */
	public function setOrder( $order ) {
		$this->order = $order;
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
	 * @param string $idempotency_key A value you specify that uniquely identifies this order among orders you've created.  If you're unsure whether a particular order was created successfully, you can reattempt it with the same idempotency key without worrying about creating duplicate orders.  See [Idempotency](/basics/api101/idempotency) for more information.
	 * @return $this
	 */
	public function setIdempotencyKey( $idempotency_key ) {
		$this->idempotency_key = $idempotency_key;
		return $this;
	}
	/**
	 * Gets reference_id
	 *
	 * @return string
	 */
	public function getReferenceId() {
		return $this->reference_id;
	}

	/**
	 * Sets reference_id
	 *
	 * @param string $reference_id __Deprecated__: Please set the reference_id on the nested [order](#type-order) field instead.  An optional ID you can associate with the order for your own purposes (such as to associate the order with an entity ID in your own database).  This value cannot exceed 40 characters.
	 * @return $this
	 */
	public function setReferenceId( $reference_id ) {
		$this->reference_id = $reference_id;
		return $this;
	}
	/**
	 * Gets line_items
	 *
	 * @return \SquareConnect\Model\CreateOrderRequestLineItem[]
	 */
	public function getLineItems() {
		return $this->line_items;
	}

	/**
	 * Sets line_items
	 *
	 * @param \SquareConnect\Model\CreateOrderRequestLineItem[] $line_items __Deprecated__: Please set the line_items on the nested [order](#type-order) field instead.  The line items to associate with this order.  Each line item represents a different product to include in a purchase.
	 * @return $this
	 */
	public function setLineItems( $line_items ) {
		$this->line_items = $line_items;
		return $this;
	}
	/**
	 * Gets taxes
	 *
	 * @return \SquareConnect\Model\CreateOrderRequestTax[]
	 */
	public function getTaxes() {
		return $this->taxes;
	}

	/**
	 * Sets taxes
	 *
	 * @param \SquareConnect\Model\CreateOrderRequestTax[] $taxes __Deprecated__: Please set the taxes on the nested [order](#type-order) field instead.  The taxes to include on the order.
	 * @return $this
	 */
	public function setTaxes( $taxes ) {
		$this->taxes = $taxes;
		return $this;
	}
	/**
	 * Gets discounts
	 *
	 * @return \SquareConnect\Model\CreateOrderRequestDiscount[]
	 */
	public function getDiscounts() {
		return $this->discounts;
	}

	/**
	 * Sets discounts
	 *
	 * @param \SquareConnect\Model\CreateOrderRequestDiscount[] $discounts __Deprecated__: Please set the discounts on the nested [order](#type-order) field instead.  The discounts to include on the order.
	 * @return $this
	 */
	public function setDiscounts( $discounts ) {
		$this->discounts = $discounts;
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
