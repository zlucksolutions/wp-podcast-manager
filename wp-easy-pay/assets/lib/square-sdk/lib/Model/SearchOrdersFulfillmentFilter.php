<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * SearchOrdersFulfillmentFilter Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class SearchOrdersFulfillmentFilter implements ArrayAccess {

	/**
	 * Array of property to type mappings. Used for (de)serialization
	 *
	 * @var string[]
	 */
	static $swaggerTypes = array(
		'fulfillment_types'  => 'string[]',
		'fulfillment_states' => 'string[]',
	);

	/**
	 * Array of attributes where the key is the local name, and the value is the original name
	 *
	 * @var string[]
	 */
	static $attributeMap = array(
		'fulfillment_types'  => 'fulfillment_types',
		'fulfillment_states' => 'fulfillment_states',
	);

	/**
	 * Array of attributes to setter functions (for deserialization of responses)
	 *
	 * @var string[]
	 */
	static $setters = array(
		'fulfillment_types'  => 'setFulfillmentTypes',
		'fulfillment_states' => 'setFulfillmentStates',
	);

	/**
	 * Array of attributes to getter functions (for serialization of requests)
	 *
	 * @var string[]
	 */
	static $getters = array(
		'fulfillment_types'  => 'getFulfillmentTypes',
		'fulfillment_states' => 'getFulfillmentStates',
	);

	/**
	 * $fulfillment_types List of [fulfillment types](#type-orderfulfillmenttype) to filter for. Will return orders if any of its fulfillments match any of the fulfillment types listed in this field. See [OrderFulfillmentType](#type-orderfulfillmenttype) for possible values
	 *
	 * @var string[]
	 */
	protected $fulfillment_types;
	/**
	 * $fulfillment_states List of [fulfillment states](#type-orderfulfillmentstate) to filter for. Will return orders if any of its fulfillments match any of the fulfillment states listed in this field. See [OrderFulfillmentState](#type-orderfulfillmentstate) for possible values
	 *
	 * @var string[]
	 */
	protected $fulfillment_states;

	/**
	 * Constructor
	 *
	 * @param mixed[] $data Associated array of property value initializing the model
	 */
	public function __construct( array $data = null ) {
		if ( $data != null ) {
			if ( isset( $data['fulfillment_types'] ) ) {
				$this->fulfillment_types = $data['fulfillment_types'];
			} else {
				$this->fulfillment_types = null;
			}
			if ( isset( $data['fulfillment_states'] ) ) {
				$this->fulfillment_states = $data['fulfillment_states'];
			} else {
				$this->fulfillment_states = null;
			}
		}
	}
	/**
	 * Gets fulfillment_types
	 *
	 * @return string[]
	 */
	public function getFulfillmentTypes() {
		return $this->fulfillment_types;
	}

	/**
	 * Sets fulfillment_types
	 *
	 * @param string[] $fulfillment_types List of [fulfillment types](#type-orderfulfillmenttype) to filter for. Will return orders if any of its fulfillments match any of the fulfillment types listed in this field. See [OrderFulfillmentType](#type-orderfulfillmenttype) for possible values
	 * @return $this
	 */
	public function setFulfillmentTypes( $fulfillment_types ) {
		$this->fulfillment_types = $fulfillment_types;
		return $this;
	}
	/**
	 * Gets fulfillment_states
	 *
	 * @return string[]
	 */
	public function getFulfillmentStates() {
		return $this->fulfillment_states;
	}

	/**
	 * Sets fulfillment_states
	 *
	 * @param string[] $fulfillment_states List of [fulfillment states](#type-orderfulfillmentstate) to filter for. Will return orders if any of its fulfillments match any of the fulfillment states listed in this field. See [OrderFulfillmentState](#type-orderfulfillmentstate) for possible values
	 * @return $this
	 */
	public function setFulfillmentStates( $fulfillment_states ) {
		$this->fulfillment_states = $fulfillment_states;
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
