<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * V1TimecardEvent Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class V1TimecardEvent implements ArrayAccess {

	/**
	 * Array of property to type mappings. Used for (de)serialization
	 *
	 * @var string[]
	 */
	static $swaggerTypes = array(
		'id'            => 'string',
		'event_type'    => 'string',
		'clockin_time'  => 'string',
		'clockout_time' => 'string',
		'created_at'    => 'string',
	);

	/**
	 * Array of attributes where the key is the local name, and the value is the original name
	 *
	 * @var string[]
	 */
	static $attributeMap = array(
		'id'            => 'id',
		'event_type'    => 'event_type',
		'clockin_time'  => 'clockin_time',
		'clockout_time' => 'clockout_time',
		'created_at'    => 'created_at',
	);

	/**
	 * Array of attributes to setter functions (for deserialization of responses)
	 *
	 * @var string[]
	 */
	static $setters = array(
		'id'            => 'setId',
		'event_type'    => 'setEventType',
		'clockin_time'  => 'setClockinTime',
		'clockout_time' => 'setClockoutTime',
		'created_at'    => 'setCreatedAt',
	);

	/**
	 * Array of attributes to getter functions (for serialization of requests)
	 *
	 * @var string[]
	 */
	static $getters = array(
		'id'            => 'getId',
		'event_type'    => 'getEventType',
		'clockin_time'  => 'getClockinTime',
		'clockout_time' => 'getClockoutTime',
		'created_at'    => 'getCreatedAt',
	);

	/**
	 * $id The event's unique ID.
	 *
	 * @var string
	 */
	protected $id;
	/**
	 * $event_type The ID of the timecard to list events for. See [V1TimecardEventEventType](#type-v1timecardeventeventtype) for possible values
	 *
	 * @var string
	 */
	protected $event_type;
	/**
	 * $clockin_time The time the employee clocked in, in ISO 8601 format.
	 *
	 * @var string
	 */
	protected $clockin_time;
	/**
	 * $clockout_time The time the employee clocked out, in ISO 8601 format.
	 *
	 * @var string
	 */
	protected $clockout_time;
	/**
	 * $created_at The time when the event was created, in ISO 8601 format.
	 *
	 * @var string
	 */
	protected $created_at;

	/**
	 * Constructor
	 *
	 * @param mixed[] $data Associated array of property value initializing the model
	 */
	public function __construct( array $data = null ) {
		if ( $data != null ) {
			if ( isset( $data['id'] ) ) {
				$this->id = $data['id'];
			} else {
				$this->id = null;
			}
			if ( isset( $data['event_type'] ) ) {
				$this->event_type = $data['event_type'];
			} else {
				$this->event_type = null;
			}
			if ( isset( $data['clockin_time'] ) ) {
				$this->clockin_time = $data['clockin_time'];
			} else {
				$this->clockin_time = null;
			}
			if ( isset( $data['clockout_time'] ) ) {
				$this->clockout_time = $data['clockout_time'];
			} else {
				$this->clockout_time = null;
			}
			if ( isset( $data['created_at'] ) ) {
				$this->created_at = $data['created_at'];
			} else {
				$this->created_at = null;
			}
		}
	}
	/**
	 * Gets id
	 *
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Sets id
	 *
	 * @param string $id The event's unique ID.
	 * @return $this
	 */
	public function setId( $id ) {
		$this->id = $id;
		return $this;
	}
	/**
	 * Gets event_type
	 *
	 * @return string
	 */
	public function getEventType() {
		return $this->event_type;
	}

	/**
	 * Sets event_type
	 *
	 * @param string $event_type The ID of the timecard to list events for. See [V1TimecardEventEventType](#type-v1timecardeventeventtype) for possible values
	 * @return $this
	 */
	public function setEventType( $event_type ) {
		$this->event_type = $event_type;
		return $this;
	}
	/**
	 * Gets clockin_time
	 *
	 * @return string
	 */
	public function getClockinTime() {
		return $this->clockin_time;
	}

	/**
	 * Sets clockin_time
	 *
	 * @param string $clockin_time The time the employee clocked in, in ISO 8601 format.
	 * @return $this
	 */
	public function setClockinTime( $clockin_time ) {
		$this->clockin_time = $clockin_time;
		return $this;
	}
	/**
	 * Gets clockout_time
	 *
	 * @return string
	 */
	public function getClockoutTime() {
		return $this->clockout_time;
	}

	/**
	 * Sets clockout_time
	 *
	 * @param string $clockout_time The time the employee clocked out, in ISO 8601 format.
	 * @return $this
	 */
	public function setClockoutTime( $clockout_time ) {
		$this->clockout_time = $clockout_time;
		return $this;
	}
	/**
	 * Gets created_at
	 *
	 * @return string
	 */
	public function getCreatedAt() {
		return $this->created_at;
	}

	/**
	 * Sets created_at
	 *
	 * @param string $created_at The time when the event was created, in ISO 8601 format.
	 * @return $this
	 */
	public function setCreatedAt( $created_at ) {
		$this->created_at = $created_at;
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
