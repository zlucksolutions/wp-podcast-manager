<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * CatalogQuerySortedAttribute Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class CatalogQuerySortedAttribute implements ArrayAccess {

	/**
	 * Array of property to type mappings. Used for (de)serialization
	 *
	 * @var string[]
	 */
	static $swaggerTypes = array(
		'attribute_name'          => 'string',
		'initial_attribute_value' => 'string',
		'sort_order'              => 'string',
	);

	/**
	 * Array of attributes where the key is the local name, and the value is the original name
	 *
	 * @var string[]
	 */
	static $attributeMap = array(
		'attribute_name'          => 'attribute_name',
		'initial_attribute_value' => 'initial_attribute_value',
		'sort_order'              => 'sort_order',
	);

	/**
	 * Array of attributes to setter functions (for deserialization of responses)
	 *
	 * @var string[]
	 */
	static $setters = array(
		'attribute_name'          => 'setAttributeName',
		'initial_attribute_value' => 'setInitialAttributeValue',
		'sort_order'              => 'setSortOrder',
	);

	/**
	 * Array of attributes to getter functions (for serialization of requests)
	 *
	 * @var string[]
	 */
	static $getters = array(
		'attribute_name'          => 'getAttributeName',
		'initial_attribute_value' => 'getInitialAttributeValue',
		'sort_order'              => 'getSortOrder',
	);

	/**
	 * $attribute_name The attribute whose value should be used as the sort key.
	 *
	 * @var string
	 */
	protected $attribute_name;
	/**
	 * $initial_attribute_value The first attribute value to be returned by the query. Ascending sorts will return only objects with this value or greater, while descending sorts will return only objects with this value or less. If unset, start at the beginning (for ascending sorts) or end (for descending sorts).
	 *
	 * @var string
	 */
	protected $initial_attribute_value;
	/**
	 * $sort_order The desired [SortOrder](#type-sortorder), `\"ASC\"` (ascending) or `\"DESC\"` (descending). See [SortOrder](#type-sortorder) for possible values
	 *
	 * @var string
	 */
	protected $sort_order;

	/**
	 * Constructor
	 *
	 * @param mixed[] $data Associated array of property value initializing the model
	 */
	public function __construct( array $data = null ) {
		if ( $data != null ) {
			if ( isset( $data['attribute_name'] ) ) {
				$this->attribute_name = $data['attribute_name'];
			} else {
				$this->attribute_name = null;
			}
			if ( isset( $data['initial_attribute_value'] ) ) {
				$this->initial_attribute_value = $data['initial_attribute_value'];
			} else {
				$this->initial_attribute_value = null;
			}
			if ( isset( $data['sort_order'] ) ) {
				$this->sort_order = $data['sort_order'];
			} else {
				$this->sort_order = null;
			}
		}
	}
	/**
	 * Gets attribute_name
	 *
	 * @return string
	 */
	public function getAttributeName() {
		return $this->attribute_name;
	}

	/**
	 * Sets attribute_name
	 *
	 * @param string $attribute_name The attribute whose value should be used as the sort key.
	 * @return $this
	 */
	public function setAttributeName( $attribute_name ) {
		$this->attribute_name = $attribute_name;
		return $this;
	}
	/**
	 * Gets initial_attribute_value
	 *
	 * @return string
	 */
	public function getInitialAttributeValue() {
		return $this->initial_attribute_value;
	}

	/**
	 * Sets initial_attribute_value
	 *
	 * @param string $initial_attribute_value The first attribute value to be returned by the query. Ascending sorts will return only objects with this value or greater, while descending sorts will return only objects with this value or less. If unset, start at the beginning (for ascending sorts) or end (for descending sorts).
	 * @return $this
	 */
	public function setInitialAttributeValue( $initial_attribute_value ) {
		$this->initial_attribute_value = $initial_attribute_value;
		return $this;
	}
	/**
	 * Gets sort_order
	 *
	 * @return string
	 */
	public function getSortOrder() {
		return $this->sort_order;
	}

	/**
	 * Sets sort_order
	 *
	 * @param string $sort_order The desired [SortOrder](#type-sortorder), `\"ASC\"` (ascending) or `\"DESC\"` (descending). See [SortOrder](#type-sortorder) for possible values
	 * @return $this
	 */
	public function setSortOrder( $sort_order ) {
		$this->sort_order = $sort_order;
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
