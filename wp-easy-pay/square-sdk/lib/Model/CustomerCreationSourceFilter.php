<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * CustomerCreationSourceFilter Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class CustomerCreationSourceFilter implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'values' => 'string[]',
        'rule' => 'string'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'values' => 'values',
        'rule' => 'rule'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'values' => 'setValues',
        'rule' => 'setRule'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'values' => 'getValues',
        'rule' => 'getRule'
    );
  
    /**
      * $values The list of creation sources used as filtering criteria. See [CustomerCreationSource](#type-customercreationsource) for possible values
      * @var string[]
      */
    protected $values;
    /**
      * $rule Indicates whether a customer profile matching the filter criteria should be included in the result or excluded from the result. Default: `INCLUDE`. See [CustomerInclusionExclusion](#type-customerinclusionexclusion) for possible values
      * @var string
      */
    protected $rule;

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initializing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            if (isset($data["values"])) {
              $this->values = $data["values"];
            } else {
              $this->values = null;
            }
            if (isset($data["rule"])) {
              $this->rule = $data["rule"];
            } else {
              $this->rule = null;
            }
        }
    }
    /**
     * Gets values
     * @return string[]
     */
    public function getValues()
    {
        return $this->values;
    }
  
    /**
     * Sets values
     * @param string[] $values The list of creation sources used as filtering criteria. See [CustomerCreationSource](#type-customercreationsource) for possible values
     * @return $this
     */
    public function setValues($values)
    {
        $this->values = $values;
        return $this;
    }
    /**
     * Gets rule
     * @return string
     */
    public function getRule()
    {
        return $this->rule;
    }
  
    /**
     * Sets rule
     * @param string $rule Indicates whether a customer profile matching the filter criteria should be included in the result or excluded from the result. Default: `INCLUDE`. See [CustomerInclusionExclusion](#type-customerinclusionexclusion) for possible values
     * @return $this
     */
    public function setRule($rule)
    {
        $this->rule = $rule;
        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset 
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }
  
    /**
     * Gets offset.
     * @param  integer $offset Offset 
     * @return mixed 
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }
  
    /**
     * Sets value based on offset.
     * @param  integer $offset Offset 
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }
  
    /**
     * Unsets offset.
     * @param  integer $offset Offset 
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
  
    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        } else {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this));
        }
    }
}
