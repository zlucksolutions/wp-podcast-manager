<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * UpsertCatalogObjectRequest Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class UpsertCatalogObjectRequest implements ArrayAccess {

	/**
	 * Array of property to type mappings. Used for (de)serialization
	 *
	 * @var string[]
	 */
	static $swaggerTypes = array(
		'idempotency_key' => 'string',
		'object'          => '\SquareConnect\Model\CatalogObject',
	);

	/**
	 * Array of attributes where the key is the local name, and the value is the original name
	 *
	 * @var string[]
	 */
	static $attributeMap = array(
		'idempotency_key' => 'idempotency_key',
		'object'          => 'object',
	);

	/**
	 * Array of attributes to setter functions (for deserialization of responses)
	 *
	 * @var string[]
	 */
	static $setters = array(
		'idempotency_key' => 'setIdempotencyKey',
		'object'          => 'setObject',
	);

	/**
	 * Array of attributes to getter functions (for serialization of requests)
	 *
	 * @var string[]
	 */
	static $getters = array(
		'idempotency_key' => 'getIdempotencyKey',
		'object'          => 'getObject',
	);

	/**
	 * $idempotency_key A value you specify that uniquely identifies this request among all your requests. A common way to create a valid idempotency key is to use a Universally unique identifier (UUID).  If you're unsure whether a particular request was successful, you can reattempt it with the same idempotency key without worrying about creating duplicate objects.  See [Idempotency](/basics/api101/idempotency) for more information.
	 *
	 * @var string
	 */
	protected $idempotency_key;
	/**
	 * $object A [CatalogObject](#type-catalogobject) to be created or updated. - For updates, the object must be active (the `is_deleted` field is not `true`). - For creates, the object ID must start with `#`. The provided ID is replaced with a server-generated ID.
	 *
	 * @var \SquareConnect\Model\CatalogObject
	 */
	protected $object;

	/**
	 * Constructor
	 *
	 * @param mixed[] $data Associated array of property value initializing the model
	 */
	public function __construct( array $data = null ) {
		if ( $data != null ) {
			if ( isset( $data['idempotency_key'] ) ) {
				$this->idempotency_key = $data['idempotency_key'];
			} else {
				$this->idempotency_key = null;
			}
			if ( isset( $data['object'] ) ) {
				$this->object = $data['object'];
			} else {
				$this->object = null;
			}
		}
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
	 * @param string $idempotency_key A value you specify that uniquely identifies this request among all your requests. A common way to create a valid idempotency key is to use a Universally unique identifier (UUID).  If you're unsure whether a particular request was successful, you can reattempt it with the same idempotency key without worrying about creating duplicate objects.  See [Idempotency](/basics/api101/idempotency) for more information.
	 * @return $this
	 */
	public function setIdempotencyKey( $idempotency_key ) {
		$this->idempotency_key = $idempotency_key;
		return $this;
	}
	/**
	 * Gets object
	 *
	 * @return \SquareConnect\Model\CatalogObject
	 */
	public function getObject() {
		return $this->object;
	}

	/**
	 * Sets object
	 *
	 * @param \SquareConnect\Model\CatalogObject $object A [CatalogObject](#type-catalogobject) to be created or updated. - For updates, the object must be active (the `is_deleted` field is not `true`). - For creates, the object ID must start with `#`. The provided ID is replaced with a server-generated ID.
	 * @return $this
	 */
	public function setObject( $object ) {
		$this->object = $object;
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
