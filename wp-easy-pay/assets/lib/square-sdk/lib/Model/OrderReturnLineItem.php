<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * OrderReturnLineItem Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class OrderReturnLineItem implements ArrayAccess {

	/**
	 * Array of property to type mappings. Used for (de)serialization
	 *
	 * @var string[]
	 */
	static $swaggerTypes = array(
		'uid'                         => 'string',
		'source_line_item_uid'        => 'string',
		'name'                        => 'string',
		'quantity'                    => 'string',
		'quantity_unit'               => '\SquareConnect\Model\OrderQuantityUnit',
		'note'                        => 'string',
		'catalog_object_id'           => 'string',
		'variation_name'              => 'string',
		'return_modifiers'            => '\SquareConnect\Model\OrderReturnLineItemModifier[]',
		'return_taxes'                => '\SquareConnect\Model\OrderReturnTax[]',
		'return_discounts'            => '\SquareConnect\Model\OrderReturnDiscount[]',
		'applied_taxes'               => '\SquareConnect\Model\OrderLineItemAppliedTax[]',
		'applied_discounts'           => '\SquareConnect\Model\OrderLineItemAppliedDiscount[]',
		'base_price_money'            => '\SquareConnect\Model\Money',
		'variation_total_price_money' => '\SquareConnect\Model\Money',
		'gross_return_money'          => '\SquareConnect\Model\Money',
		'total_tax_money'             => '\SquareConnect\Model\Money',
		'total_discount_money'        => '\SquareConnect\Model\Money',
		'total_money'                 => '\SquareConnect\Model\Money',
	);

	/**
	 * Array of attributes where the key is the local name, and the value is the original name
	 *
	 * @var string[]
	 */
	static $attributeMap = array(
		'uid'                         => 'uid',
		'source_line_item_uid'        => 'source_line_item_uid',
		'name'                        => 'name',
		'quantity'                    => 'quantity',
		'quantity_unit'               => 'quantity_unit',
		'note'                        => 'note',
		'catalog_object_id'           => 'catalog_object_id',
		'variation_name'              => 'variation_name',
		'return_modifiers'            => 'return_modifiers',
		'return_taxes'                => 'return_taxes',
		'return_discounts'            => 'return_discounts',
		'applied_taxes'               => 'applied_taxes',
		'applied_discounts'           => 'applied_discounts',
		'base_price_money'            => 'base_price_money',
		'variation_total_price_money' => 'variation_total_price_money',
		'gross_return_money'          => 'gross_return_money',
		'total_tax_money'             => 'total_tax_money',
		'total_discount_money'        => 'total_discount_money',
		'total_money'                 => 'total_money',
	);

	/**
	 * Array of attributes to setter functions (for deserialization of responses)
	 *
	 * @var string[]
	 */
	static $setters = array(
		'uid'                         => 'setUid',
		'source_line_item_uid'        => 'setSourceLineItemUid',
		'name'                        => 'setName',
		'quantity'                    => 'setQuantity',
		'quantity_unit'               => 'setQuantityUnit',
		'note'                        => 'setNote',
		'catalog_object_id'           => 'setCatalogObjectId',
		'variation_name'              => 'setVariationName',
		'return_modifiers'            => 'setReturnModifiers',
		'return_taxes'                => 'setReturnTaxes',
		'return_discounts'            => 'setReturnDiscounts',
		'applied_taxes'               => 'setAppliedTaxes',
		'applied_discounts'           => 'setAppliedDiscounts',
		'base_price_money'            => 'setBasePriceMoney',
		'variation_total_price_money' => 'setVariationTotalPriceMoney',
		'gross_return_money'          => 'setGrossReturnMoney',
		'total_tax_money'             => 'setTotalTaxMoney',
		'total_discount_money'        => 'setTotalDiscountMoney',
		'total_money'                 => 'setTotalMoney',
	);

	/**
	 * Array of attributes to getter functions (for serialization of requests)
	 *
	 * @var string[]
	 */
	static $getters = array(
		'uid'                         => 'getUid',
		'source_line_item_uid'        => 'getSourceLineItemUid',
		'name'                        => 'getName',
		'quantity'                    => 'getQuantity',
		'quantity_unit'               => 'getQuantityUnit',
		'note'                        => 'getNote',
		'catalog_object_id'           => 'getCatalogObjectId',
		'variation_name'              => 'getVariationName',
		'return_modifiers'            => 'getReturnModifiers',
		'return_taxes'                => 'getReturnTaxes',
		'return_discounts'            => 'getReturnDiscounts',
		'applied_taxes'               => 'getAppliedTaxes',
		'applied_discounts'           => 'getAppliedDiscounts',
		'base_price_money'            => 'getBasePriceMoney',
		'variation_total_price_money' => 'getVariationTotalPriceMoney',
		'gross_return_money'          => 'getGrossReturnMoney',
		'total_tax_money'             => 'getTotalTaxMoney',
		'total_discount_money'        => 'getTotalDiscountMoney',
		'total_money'                 => 'getTotalMoney',
	);

	/**
	 * $uid Unique identifier for this return line item entry.
	 *
	 * @var string
	 */
	protected $uid;
	/**
	 * $source_line_item_uid `uid` of the LineItem in the original sale Order.
	 *
	 * @var string
	 */
	protected $source_line_item_uid;
	/**
	 * $name The name of the line item.
	 *
	 * @var string
	 */
	protected $name;
	/**
	 * $quantity The quantity returned, formatted as a decimal number. For example: `\"3\"`.  Line items with a `quantity_unit` can have non-integer quantities. For example: `\"1.70000\"`.
	 *
	 * @var string
	 */
	protected $quantity;
	/**
	 * $quantity_unit The unit and precision that this return line item's quantity is measured in.
	 *
	 * @var \SquareConnect\Model\OrderQuantityUnit
	 */
	protected $quantity_unit;
	/**
	 * $note The note of the returned line item.
	 *
	 * @var string
	 */
	protected $note;
	/**
	 * $catalog_object_id The [CatalogItemVariation](#type-catalogitemvariation) id applied to this returned line item.
	 *
	 * @var string
	 */
	protected $catalog_object_id;
	/**
	 * $variation_name The name of the variation applied to this returned line item.
	 *
	 * @var string
	 */
	protected $variation_name;
	/**
	 * $return_modifiers The [CatalogModifier](#type-catalogmodifier)s applied to this line item.
	 *
	 * @var \SquareConnect\Model\OrderReturnLineItemModifier[]
	 */
	protected $return_modifiers;
	/**
	 * $return_taxes A list of taxes applied to this line item. On read or retrieve, this list includes both item-level taxes and any return-level taxes apportioned to this item.  This field has been deprecated in favour of `applied_taxes`.
	 *
	 * @var \SquareConnect\Model\OrderReturnTax[]
	 */
	protected $return_taxes;
	/**
	 * $return_discounts A list of discounts applied to this line item. On read or retrieve, this list includes both item-level discounts and any return-level discounts apportioned to this item.  This field has been deprecated in favour of `applied_discounts`.
	 *
	 * @var \SquareConnect\Model\OrderReturnDiscount[]
	 */
	protected $return_discounts;
	/**
	 * $applied_taxes The list of references to `OrderReturnTax` entities applied to the returned line item. Each `OrderLineItemAppliedTax` has a `tax_uid` that references the `uid` of a top-level `OrderReturnTax` applied to the returned line item. On reads, the amount applied is populated.
	 *
	 * @var \SquareConnect\Model\OrderLineItemAppliedTax[]
	 */
	protected $applied_taxes;
	/**
	 * $applied_discounts The list of references to `OrderReturnDiscount` entities applied to the returned line item. Each `OrderLineItemAppliedDiscount` has a `discount_uid` that references the `uid` of a top-level `OrderReturnDiscount` applied to the returned line item. On reads, the amount applied is populated.
	 *
	 * @var \SquareConnect\Model\OrderLineItemAppliedDiscount[]
	 */
	protected $applied_discounts;
	/**
	 * $base_price_money The base price for a single unit of the line item.
	 *
	 * @var \SquareConnect\Model\Money
	 */
	protected $base_price_money;
	/**
	 * $variation_total_price_money The total price of all item variations returned in this line item. Calculated as `base_price_money` multiplied by `quantity`. Does not include modifiers.
	 *
	 * @var \SquareConnect\Model\Money
	 */
	protected $variation_total_price_money;
	/**
	 * $gross_return_money The gross return amount of money calculated as (item base price + modifiers price) * quantity.
	 *
	 * @var \SquareConnect\Model\Money
	 */
	protected $gross_return_money;
	/**
	 * $total_tax_money The total tax amount of money to return for the line item.
	 *
	 * @var \SquareConnect\Model\Money
	 */
	protected $total_tax_money;
	/**
	 * $total_discount_money The total discount amount of money to return for the line item.
	 *
	 * @var \SquareConnect\Model\Money
	 */
	protected $total_discount_money;
	/**
	 * $total_money The total amount of money to return for this line item.
	 *
	 * @var \SquareConnect\Model\Money
	 */
	protected $total_money;

	/**
	 * Constructor
	 *
	 * @param mixed[] $data Associated array of property value initializing the model
	 */
	public function __construct( array $data = null ) {
		if ( $data != null ) {
			if ( isset( $data['uid'] ) ) {
				$this->uid = $data['uid'];
			} else {
				$this->uid = null;
			}
			if ( isset( $data['source_line_item_uid'] ) ) {
				$this->source_line_item_uid = $data['source_line_item_uid'];
			} else {
				$this->source_line_item_uid = null;
			}
			if ( isset( $data['name'] ) ) {
				$this->name = $data['name'];
			} else {
				$this->name = null;
			}
			if ( isset( $data['quantity'] ) ) {
				$this->quantity = $data['quantity'];
			} else {
				$this->quantity = null;
			}
			if ( isset( $data['quantity_unit'] ) ) {
				$this->quantity_unit = $data['quantity_unit'];
			} else {
				$this->quantity_unit = null;
			}
			if ( isset( $data['note'] ) ) {
				$this->note = $data['note'];
			} else {
				$this->note = null;
			}
			if ( isset( $data['catalog_object_id'] ) ) {
				$this->catalog_object_id = $data['catalog_object_id'];
			} else {
				$this->catalog_object_id = null;
			}
			if ( isset( $data['variation_name'] ) ) {
				$this->variation_name = $data['variation_name'];
			} else {
				$this->variation_name = null;
			}
			if ( isset( $data['return_modifiers'] ) ) {
				$this->return_modifiers = $data['return_modifiers'];
			} else {
				$this->return_modifiers = null;
			}
			if ( isset( $data['return_taxes'] ) ) {
				$this->return_taxes = $data['return_taxes'];
			} else {
				$this->return_taxes = null;
			}
			if ( isset( $data['return_discounts'] ) ) {
				$this->return_discounts = $data['return_discounts'];
			} else {
				$this->return_discounts = null;
			}
			if ( isset( $data['applied_taxes'] ) ) {
				$this->applied_taxes = $data['applied_taxes'];
			} else {
				$this->applied_taxes = null;
			}
			if ( isset( $data['applied_discounts'] ) ) {
				$this->applied_discounts = $data['applied_discounts'];
			} else {
				$this->applied_discounts = null;
			}
			if ( isset( $data['base_price_money'] ) ) {
				$this->base_price_money = $data['base_price_money'];
			} else {
				$this->base_price_money = null;
			}
			if ( isset( $data['variation_total_price_money'] ) ) {
				$this->variation_total_price_money = $data['variation_total_price_money'];
			} else {
				$this->variation_total_price_money = null;
			}
			if ( isset( $data['gross_return_money'] ) ) {
				$this->gross_return_money = $data['gross_return_money'];
			} else {
				$this->gross_return_money = null;
			}
			if ( isset( $data['total_tax_money'] ) ) {
				$this->total_tax_money = $data['total_tax_money'];
			} else {
				$this->total_tax_money = null;
			}
			if ( isset( $data['total_discount_money'] ) ) {
				$this->total_discount_money = $data['total_discount_money'];
			} else {
				$this->total_discount_money = null;
			}
			if ( isset( $data['total_money'] ) ) {
				$this->total_money = $data['total_money'];
			} else {
				$this->total_money = null;
			}
		}
	}
	/**
	 * Gets uid
	 *
	 * @return string
	 */
	public function getUid() {
		return $this->uid;
	}

	/**
	 * Sets uid
	 *
	 * @param string $uid Unique identifier for this return line item entry.
	 * @return $this
	 */
	public function setUid( $uid ) {
		$this->uid = $uid;
		return $this;
	}
	/**
	 * Gets source_line_item_uid
	 *
	 * @return string
	 */
	public function getSourceLineItemUid() {
		return $this->source_line_item_uid;
	}

	/**
	 * Sets source_line_item_uid
	 *
	 * @param string $source_line_item_uid `uid` of the LineItem in the original sale Order.
	 * @return $this
	 */
	public function setSourceLineItemUid( $source_line_item_uid ) {
		$this->source_line_item_uid = $source_line_item_uid;
		return $this;
	}
	/**
	 * Gets name
	 *
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets name
	 *
	 * @param string $name The name of the line item.
	 * @return $this
	 */
	public function setName( $name ) {
		$this->name = $name;
		return $this;
	}
	/**
	 * Gets quantity
	 *
	 * @return string
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * Sets quantity
	 *
	 * @param string $quantity The quantity returned, formatted as a decimal number. For example: `\"3\"`.  Line items with a `quantity_unit` can have non-integer quantities. For example: `\"1.70000\"`.
	 * @return $this
	 */
	public function setQuantity( $quantity ) {
		$this->quantity = $quantity;
		return $this;
	}
	/**
	 * Gets quantity_unit
	 *
	 * @return \SquareConnect\Model\OrderQuantityUnit
	 */
	public function getQuantityUnit() {
		return $this->quantity_unit;
	}

	/**
	 * Sets quantity_unit
	 *
	 * @param \SquareConnect\Model\OrderQuantityUnit $quantity_unit The unit and precision that this return line item's quantity is measured in.
	 * @return $this
	 */
	public function setQuantityUnit( $quantity_unit ) {
		$this->quantity_unit = $quantity_unit;
		return $this;
	}
	/**
	 * Gets note
	 *
	 * @return string
	 */
	public function getNote() {
		return $this->note;
	}

	/**
	 * Sets note
	 *
	 * @param string $note The note of the returned line item.
	 * @return $this
	 */
	public function setNote( $note ) {
		$this->note = $note;
		return $this;
	}
	/**
	 * Gets catalog_object_id
	 *
	 * @return string
	 */
	public function getCatalogObjectId() {
		return $this->catalog_object_id;
	}

	/**
	 * Sets catalog_object_id
	 *
	 * @param string $catalog_object_id The [CatalogItemVariation](#type-catalogitemvariation) id applied to this returned line item.
	 * @return $this
	 */
	public function setCatalogObjectId( $catalog_object_id ) {
		$this->catalog_object_id = $catalog_object_id;
		return $this;
	}
	/**
	 * Gets variation_name
	 *
	 * @return string
	 */
	public function getVariationName() {
		return $this->variation_name;
	}

	/**
	 * Sets variation_name
	 *
	 * @param string $variation_name The name of the variation applied to this returned line item.
	 * @return $this
	 */
	public function setVariationName( $variation_name ) {
		$this->variation_name = $variation_name;
		return $this;
	}
	/**
	 * Gets return_modifiers
	 *
	 * @return \SquareConnect\Model\OrderReturnLineItemModifier[]
	 */
	public function getReturnModifiers() {
		return $this->return_modifiers;
	}

	/**
	 * Sets return_modifiers
	 *
	 * @param \SquareConnect\Model\OrderReturnLineItemModifier[] $return_modifiers The [CatalogModifier](#type-catalogmodifier)s applied to this line item.
	 * @return $this
	 */
	public function setReturnModifiers( $return_modifiers ) {
		$this->return_modifiers = $return_modifiers;
		return $this;
	}
	/**
	 * Gets return_taxes
	 *
	 * @return \SquareConnect\Model\OrderReturnTax[]
	 */
	public function getReturnTaxes() {
		return $this->return_taxes;
	}

	/**
	 * Sets return_taxes
	 *
	 * @param \SquareConnect\Model\OrderReturnTax[] $return_taxes A list of taxes applied to this line item. On read or retrieve, this list includes both item-level taxes and any return-level taxes apportioned to this item.  This field has been deprecated in favour of `applied_taxes`.
	 * @return $this
	 */
	public function setReturnTaxes( $return_taxes ) {
		$this->return_taxes = $return_taxes;
		return $this;
	}
	/**
	 * Gets return_discounts
	 *
	 * @return \SquareConnect\Model\OrderReturnDiscount[]
	 */
	public function getReturnDiscounts() {
		return $this->return_discounts;
	}

	/**
	 * Sets return_discounts
	 *
	 * @param \SquareConnect\Model\OrderReturnDiscount[] $return_discounts A list of discounts applied to this line item. On read or retrieve, this list includes both item-level discounts and any return-level discounts apportioned to this item.  This field has been deprecated in favour of `applied_discounts`.
	 * @return $this
	 */
	public function setReturnDiscounts( $return_discounts ) {
		$this->return_discounts = $return_discounts;
		return $this;
	}
	/**
	 * Gets applied_taxes
	 *
	 * @return \SquareConnect\Model\OrderLineItemAppliedTax[]
	 */
	public function getAppliedTaxes() {
		return $this->applied_taxes;
	}

	/**
	 * Sets applied_taxes
	 *
	 * @param \SquareConnect\Model\OrderLineItemAppliedTax[] $applied_taxes The list of references to `OrderReturnTax` entities applied to the returned line item. Each `OrderLineItemAppliedTax` has a `tax_uid` that references the `uid` of a top-level `OrderReturnTax` applied to the returned line item. On reads, the amount applied is populated.
	 * @return $this
	 */
	public function setAppliedTaxes( $applied_taxes ) {
		$this->applied_taxes = $applied_taxes;
		return $this;
	}
	/**
	 * Gets applied_discounts
	 *
	 * @return \SquareConnect\Model\OrderLineItemAppliedDiscount[]
	 */
	public function getAppliedDiscounts() {
		return $this->applied_discounts;
	}

	/**
	 * Sets applied_discounts
	 *
	 * @param \SquareConnect\Model\OrderLineItemAppliedDiscount[] $applied_discounts The list of references to `OrderReturnDiscount` entities applied to the returned line item. Each `OrderLineItemAppliedDiscount` has a `discount_uid` that references the `uid` of a top-level `OrderReturnDiscount` applied to the returned line item. On reads, the amount applied is populated.
	 * @return $this
	 */
	public function setAppliedDiscounts( $applied_discounts ) {
		$this->applied_discounts = $applied_discounts;
		return $this;
	}
	/**
	 * Gets base_price_money
	 *
	 * @return \SquareConnect\Model\Money
	 */
	public function getBasePriceMoney() {
		return $this->base_price_money;
	}

	/**
	 * Sets base_price_money
	 *
	 * @param \SquareConnect\Model\Money $base_price_money The base price for a single unit of the line item.
	 * @return $this
	 */
	public function setBasePriceMoney( $base_price_money ) {
		$this->base_price_money = $base_price_money;
		return $this;
	}
	/**
	 * Gets variation_total_price_money
	 *
	 * @return \SquareConnect\Model\Money
	 */
	public function getVariationTotalPriceMoney() {
		return $this->variation_total_price_money;
	}

	/**
	 * Sets variation_total_price_money
	 *
	 * @param \SquareConnect\Model\Money $variation_total_price_money The total price of all item variations returned in this line item. Calculated as `base_price_money` multiplied by `quantity`. Does not include modifiers.
	 * @return $this
	 */
	public function setVariationTotalPriceMoney( $variation_total_price_money ) {
		$this->variation_total_price_money = $variation_total_price_money;
		return $this;
	}
	/**
	 * Gets gross_return_money
	 *
	 * @return \SquareConnect\Model\Money
	 */
	public function getGrossReturnMoney() {
		return $this->gross_return_money;
	}

	/**
	 * Sets gross_return_money
	 *
	 * @param \SquareConnect\Model\Money $gross_return_money The gross return amount of money calculated as (item base price + modifiers price) * quantity.
	 * @return $this
	 */
	public function setGrossReturnMoney( $gross_return_money ) {
		$this->gross_return_money = $gross_return_money;
		return $this;
	}
	/**
	 * Gets total_tax_money
	 *
	 * @return \SquareConnect\Model\Money
	 */
	public function getTotalTaxMoney() {
		return $this->total_tax_money;
	}

	/**
	 * Sets total_tax_money
	 *
	 * @param \SquareConnect\Model\Money $total_tax_money The total tax amount of money to return for the line item.
	 * @return $this
	 */
	public function setTotalTaxMoney( $total_tax_money ) {
		$this->total_tax_money = $total_tax_money;
		return $this;
	}
	/**
	 * Gets total_discount_money
	 *
	 * @return \SquareConnect\Model\Money
	 */
	public function getTotalDiscountMoney() {
		return $this->total_discount_money;
	}

	/**
	 * Sets total_discount_money
	 *
	 * @param \SquareConnect\Model\Money $total_discount_money The total discount amount of money to return for the line item.
	 * @return $this
	 */
	public function setTotalDiscountMoney( $total_discount_money ) {
		$this->total_discount_money = $total_discount_money;
		return $this;
	}
	/**
	 * Gets total_money
	 *
	 * @return \SquareConnect\Model\Money
	 */
	public function getTotalMoney() {
		return $this->total_money;
	}

	/**
	 * Sets total_money
	 *
	 * @param \SquareConnect\Model\Money $total_money The total amount of money to return for this line item.
	 * @return $this
	 */
	public function setTotalMoney( $total_money ) {
		$this->total_money = $total_money;
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
