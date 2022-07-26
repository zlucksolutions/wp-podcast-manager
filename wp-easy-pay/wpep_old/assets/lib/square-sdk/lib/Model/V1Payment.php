<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * V1Payment Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class V1Payment implements ArrayAccess {

	/**
	 * Array of property to type mappings. Used for (de)serialization
	 *
	 * @var string[]
	 */
	static $swaggerTypes = array(
		'id'                     => 'string',
		'merchant_id'            => 'string',
		'created_at'             => 'string',
		'creator_id'             => 'string',
		'device'                 => '\SquareConnect\Model\Device',
		'payment_url'            => 'string',
		'receipt_url'            => 'string',
		'inclusive_tax_money'    => '\SquareConnect\Model\V1Money',
		'additive_tax_money'     => '\SquareConnect\Model\V1Money',
		'tax_money'              => '\SquareConnect\Model\V1Money',
		'tip_money'              => '\SquareConnect\Model\V1Money',
		'discount_money'         => '\SquareConnect\Model\V1Money',
		'total_collected_money'  => '\SquareConnect\Model\V1Money',
		'processing_fee_money'   => '\SquareConnect\Model\V1Money',
		'net_total_money'        => '\SquareConnect\Model\V1Money',
		'refunded_money'         => '\SquareConnect\Model\V1Money',
		'swedish_rounding_money' => '\SquareConnect\Model\V1Money',
		'gross_sales_money'      => '\SquareConnect\Model\V1Money',
		'net_sales_money'        => '\SquareConnect\Model\V1Money',
		'inclusive_tax'          => '\SquareConnect\Model\V1PaymentTax[]',
		'additive_tax'           => '\SquareConnect\Model\V1PaymentTax[]',
		'tender'                 => '\SquareConnect\Model\V1Tender[]',
		'refunds'                => '\SquareConnect\Model\V1Refund[]',
		'itemizations'           => '\SquareConnect\Model\V1PaymentItemization[]',
		'surcharge_money'        => '\SquareConnect\Model\V1Money',
		'surcharges'             => '\SquareConnect\Model\V1PaymentSurcharge[]',
		'is_partial'             => 'bool',
	);

	/**
	 * Array of attributes where the key is the local name, and the value is the original name
	 *
	 * @var string[]
	 */
	static $attributeMap = array(
		'id'                     => 'id',
		'merchant_id'            => 'merchant_id',
		'created_at'             => 'created_at',
		'creator_id'             => 'creator_id',
		'device'                 => 'device',
		'payment_url'            => 'payment_url',
		'receipt_url'            => 'receipt_url',
		'inclusive_tax_money'    => 'inclusive_tax_money',
		'additive_tax_money'     => 'additive_tax_money',
		'tax_money'              => 'tax_money',
		'tip_money'              => 'tip_money',
		'discount_money'         => 'discount_money',
		'total_collected_money'  => 'total_collected_money',
		'processing_fee_money'   => 'processing_fee_money',
		'net_total_money'        => 'net_total_money',
		'refunded_money'         => 'refunded_money',
		'swedish_rounding_money' => 'swedish_rounding_money',
		'gross_sales_money'      => 'gross_sales_money',
		'net_sales_money'        => 'net_sales_money',
		'inclusive_tax'          => 'inclusive_tax',
		'additive_tax'           => 'additive_tax',
		'tender'                 => 'tender',
		'refunds'                => 'refunds',
		'itemizations'           => 'itemizations',
		'surcharge_money'        => 'surcharge_money',
		'surcharges'             => 'surcharges',
		'is_partial'             => 'is_partial',
	);

	/**
	 * Array of attributes to setter functions (for deserialization of responses)
	 *
	 * @var string[]
	 */
	static $setters = array(
		'id'                     => 'setId',
		'merchant_id'            => 'setMerchantId',
		'created_at'             => 'setCreatedAt',
		'creator_id'             => 'setCreatorId',
		'device'                 => 'setDevice',
		'payment_url'            => 'setPaymentUrl',
		'receipt_url'            => 'setReceiptUrl',
		'inclusive_tax_money'    => 'setInclusiveTaxMoney',
		'additive_tax_money'     => 'setAdditiveTaxMoney',
		'tax_money'              => 'setTaxMoney',
		'tip_money'              => 'setTipMoney',
		'discount_money'         => 'setDiscountMoney',
		'total_collected_money'  => 'setTotalCollectedMoney',
		'processing_fee_money'   => 'setProcessingFeeMoney',
		'net_total_money'        => 'setNetTotalMoney',
		'refunded_money'         => 'setRefundedMoney',
		'swedish_rounding_money' => 'setSwedishRoundingMoney',
		'gross_sales_money'      => 'setGrossSalesMoney',
		'net_sales_money'        => 'setNetSalesMoney',
		'inclusive_tax'          => 'setInclusiveTax',
		'additive_tax'           => 'setAdditiveTax',
		'tender'                 => 'setTender',
		'refunds'                => 'setRefunds',
		'itemizations'           => 'setItemizations',
		'surcharge_money'        => 'setSurchargeMoney',
		'surcharges'             => 'setSurcharges',
		'is_partial'             => 'setIsPartial',
	);

	/**
	 * Array of attributes to getter functions (for serialization of requests)
	 *
	 * @var string[]
	 */
	static $getters = array(
		'id'                     => 'getId',
		'merchant_id'            => 'getMerchantId',
		'created_at'             => 'getCreatedAt',
		'creator_id'             => 'getCreatorId',
		'device'                 => 'getDevice',
		'payment_url'            => 'getPaymentUrl',
		'receipt_url'            => 'getReceiptUrl',
		'inclusive_tax_money'    => 'getInclusiveTaxMoney',
		'additive_tax_money'     => 'getAdditiveTaxMoney',
		'tax_money'              => 'getTaxMoney',
		'tip_money'              => 'getTipMoney',
		'discount_money'         => 'getDiscountMoney',
		'total_collected_money'  => 'getTotalCollectedMoney',
		'processing_fee_money'   => 'getProcessingFeeMoney',
		'net_total_money'        => 'getNetTotalMoney',
		'refunded_money'         => 'getRefundedMoney',
		'swedish_rounding_money' => 'getSwedishRoundingMoney',
		'gross_sales_money'      => 'getGrossSalesMoney',
		'net_sales_money'        => 'getNetSalesMoney',
		'inclusive_tax'          => 'getInclusiveTax',
		'additive_tax'           => 'getAdditiveTax',
		'tender'                 => 'getTender',
		'refunds'                => 'getRefunds',
		'itemizations'           => 'getItemizations',
		'surcharge_money'        => 'getSurchargeMoney',
		'surcharges'             => 'getSurcharges',
		'is_partial'             => 'getIsPartial',
	);

	/**
	 * $id The payment's unique identifier.
	 *
	 * @var string
	 */
	protected $id;
	/**
	 * $merchant_id The unique identifier of the merchant that took the payment.
	 *
	 * @var string
	 */
	protected $merchant_id;
	/**
	 * $created_at The time when the payment was created, in ISO 8601 format. Reflects the time of the first payment if the object represents an incomplete partial payment, and the time of the last or complete payment otherwise.
	 *
	 * @var string
	 */
	protected $created_at;
	/**
	 * $creator_id The unique identifier of the Square account that took the payment.
	 *
	 * @var string
	 */
	protected $creator_id;
	/**
	 * $device The device that took the payment.
	 *
	 * @var \SquareConnect\Model\Device
	 */
	protected $device;
	/**
	 * $payment_url The URL of the payment's detail page in the merchant dashboard. The merchant must be signed in to the merchant dashboard to view this page.
	 *
	 * @var string
	 */
	protected $payment_url;
	/**
	 * $receipt_url The URL of the receipt for the payment. Note that for split tender payments, this URL corresponds to the receipt for the first tender listed in the payment's tender field. Each Tender object has its own receipt_url field you can use to get the other receipts associated with a split tender payment.
	 *
	 * @var string
	 */
	protected $receipt_url;
	/**
	 * $inclusive_tax_money The sum of all inclusive taxes associated with the payment.
	 *
	 * @var \SquareConnect\Model\V1Money
	 */
	protected $inclusive_tax_money;
	/**
	 * $additive_tax_money The sum of all additive taxes associated with the payment.
	 *
	 * @var \SquareConnect\Model\V1Money
	 */
	protected $additive_tax_money;
	/**
	 * $tax_money The total of all taxes applied to the payment. This is always the sum of inclusive_tax_money and additive_tax_money.
	 *
	 * @var \SquareConnect\Model\V1Money
	 */
	protected $tax_money;
	/**
	 * $tip_money The total of all tips applied to the payment.
	 *
	 * @var \SquareConnect\Model\V1Money
	 */
	protected $tip_money;
	/**
	 * $discount_money The total of all discounts applied to the payment.
	 *
	 * @var \SquareConnect\Model\V1Money
	 */
	protected $discount_money;
	/**
	 * $total_collected_money The total of all discounts applied to the payment.
	 *
	 * @var \SquareConnect\Model\V1Money
	 */
	protected $total_collected_money;
	/**
	 * $processing_fee_money The total of all processing fees collected by Square for the payment.
	 *
	 * @var \SquareConnect\Model\V1Money
	 */
	protected $processing_fee_money;
	/**
	 * $net_total_money The amount to be deposited into the merchant's bank account for the payment.
	 *
	 * @var \SquareConnect\Model\V1Money
	 */
	protected $net_total_money;
	/**
	 * $refunded_money The total of all refunds applied to the payment.
	 *
	 * @var \SquareConnect\Model\V1Money
	 */
	protected $refunded_money;
	/**
	 * $swedish_rounding_money The total of all sales, including any applicable taxes, rounded to the smallest legal unit of currency (e.g., the nearest penny in USD, the nearest nickel in CAD)
	 *
	 * @var \SquareConnect\Model\V1Money
	 */
	protected $swedish_rounding_money;
	/**
	 * $gross_sales_money The total of all sales, including any applicable taxes.
	 *
	 * @var \SquareConnect\Model\V1Money
	 */
	protected $gross_sales_money;
	/**
	 * $net_sales_money The total of all sales, minus any applicable taxes.
	 *
	 * @var \SquareConnect\Model\V1Money
	 */
	protected $net_sales_money;
	/**
	 * $inclusive_tax All of the inclusive taxes associated with the payment.
	 *
	 * @var \SquareConnect\Model\V1PaymentTax[]
	 */
	protected $inclusive_tax;
	/**
	 * $additive_tax All of the additive taxes associated with the payment.
	 *
	 * @var \SquareConnect\Model\V1PaymentTax[]
	 */
	protected $additive_tax;
	/**
	 * $tender All of the tenders associated with the payment.
	 *
	 * @var \SquareConnect\Model\V1Tender[]
	 */
	protected $tender;
	/**
	 * $refunds All of the refunds applied to the payment. Note that the value of all refunds on a payment can exceed the value of all tenders if a merchant chooses to refund money to a tender after previously accepting returned goods as part of an exchange.
	 *
	 * @var \SquareConnect\Model\V1Refund[]
	 */
	protected $refunds;
	/**
	 * $itemizations The items purchased in the payment.
	 *
	 * @var \SquareConnect\Model\V1PaymentItemization[]
	 */
	protected $itemizations;
	/**
	 * $surcharge_money The total of all surcharges applied to the payment.
	 *
	 * @var \SquareConnect\Model\V1Money
	 */
	protected $surcharge_money;
	/**
	 * $surcharges A list of all surcharges associated with the payment.
	 *
	 * @var \SquareConnect\Model\V1PaymentSurcharge[]
	 */
	protected $surcharges;
	/**
	 * $is_partial Indicates whether or not the payment is only partially paid for. If true, this payment will have the tenders collected so far, but the itemizations will be empty until the payment is completed.
	 *
	 * @var bool
	 */
	protected $is_partial;

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
			if ( isset( $data['merchant_id'] ) ) {
				$this->merchant_id = $data['merchant_id'];
			} else {
				$this->merchant_id = null;
			}
			if ( isset( $data['created_at'] ) ) {
				$this->created_at = $data['created_at'];
			} else {
				$this->created_at = null;
			}
			if ( isset( $data['creator_id'] ) ) {
				$this->creator_id = $data['creator_id'];
			} else {
				$this->creator_id = null;
			}
			if ( isset( $data['device'] ) ) {
				$this->device = $data['device'];
			} else {
				$this->device = null;
			}
			if ( isset( $data['payment_url'] ) ) {
				$this->payment_url = $data['payment_url'];
			} else {
				$this->payment_url = null;
			}
			if ( isset( $data['receipt_url'] ) ) {
				$this->receipt_url = $data['receipt_url'];
			} else {
				$this->receipt_url = null;
			}
			if ( isset( $data['inclusive_tax_money'] ) ) {
				$this->inclusive_tax_money = $data['inclusive_tax_money'];
			} else {
				$this->inclusive_tax_money = null;
			}
			if ( isset( $data['additive_tax_money'] ) ) {
				$this->additive_tax_money = $data['additive_tax_money'];
			} else {
				$this->additive_tax_money = null;
			}
			if ( isset( $data['tax_money'] ) ) {
				$this->tax_money = $data['tax_money'];
			} else {
				$this->tax_money = null;
			}
			if ( isset( $data['tip_money'] ) ) {
				$this->tip_money = $data['tip_money'];
			} else {
				$this->tip_money = null;
			}
			if ( isset( $data['discount_money'] ) ) {
				$this->discount_money = $data['discount_money'];
			} else {
				$this->discount_money = null;
			}
			if ( isset( $data['total_collected_money'] ) ) {
				$this->total_collected_money = $data['total_collected_money'];
			} else {
				$this->total_collected_money = null;
			}
			if ( isset( $data['processing_fee_money'] ) ) {
				$this->processing_fee_money = $data['processing_fee_money'];
			} else {
				$this->processing_fee_money = null;
			}
			if ( isset( $data['net_total_money'] ) ) {
				$this->net_total_money = $data['net_total_money'];
			} else {
				$this->net_total_money = null;
			}
			if ( isset( $data['refunded_money'] ) ) {
				$this->refunded_money = $data['refunded_money'];
			} else {
				$this->refunded_money = null;
			}
			if ( isset( $data['swedish_rounding_money'] ) ) {
				$this->swedish_rounding_money = $data['swedish_rounding_money'];
			} else {
				$this->swedish_rounding_money = null;
			}
			if ( isset( $data['gross_sales_money'] ) ) {
				$this->gross_sales_money = $data['gross_sales_money'];
			} else {
				$this->gross_sales_money = null;
			}
			if ( isset( $data['net_sales_money'] ) ) {
				$this->net_sales_money = $data['net_sales_money'];
			} else {
				$this->net_sales_money = null;
			}
			if ( isset( $data['inclusive_tax'] ) ) {
				$this->inclusive_tax = $data['inclusive_tax'];
			} else {
				$this->inclusive_tax = null;
			}
			if ( isset( $data['additive_tax'] ) ) {
				$this->additive_tax = $data['additive_tax'];
			} else {
				$this->additive_tax = null;
			}
			if ( isset( $data['tender'] ) ) {
				$this->tender = $data['tender'];
			} else {
				$this->tender = null;
			}
			if ( isset( $data['refunds'] ) ) {
				$this->refunds = $data['refunds'];
			} else {
				$this->refunds = null;
			}
			if ( isset( $data['itemizations'] ) ) {
				$this->itemizations = $data['itemizations'];
			} else {
				$this->itemizations = null;
			}
			if ( isset( $data['surcharge_money'] ) ) {
				$this->surcharge_money = $data['surcharge_money'];
			} else {
				$this->surcharge_money = null;
			}
			if ( isset( $data['surcharges'] ) ) {
				$this->surcharges = $data['surcharges'];
			} else {
				$this->surcharges = null;
			}
			if ( isset( $data['is_partial'] ) ) {
				$this->is_partial = $data['is_partial'];
			} else {
				$this->is_partial = null;
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
	 * @param string $id The payment's unique identifier.
	 * @return $this
	 */
	public function setId( $id ) {
		$this->id = $id;
		return $this;
	}
	/**
	 * Gets merchant_id
	 *
	 * @return string
	 */
	public function getMerchantId() {
		return $this->merchant_id;
	}

	/**
	 * Sets merchant_id
	 *
	 * @param string $merchant_id The unique identifier of the merchant that took the payment.
	 * @return $this
	 */
	public function setMerchantId( $merchant_id ) {
		$this->merchant_id = $merchant_id;
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
	 * @param string $created_at The time when the payment was created, in ISO 8601 format. Reflects the time of the first payment if the object represents an incomplete partial payment, and the time of the last or complete payment otherwise.
	 * @return $this
	 */
	public function setCreatedAt( $created_at ) {
		$this->created_at = $created_at;
		return $this;
	}
	/**
	 * Gets creator_id
	 *
	 * @return string
	 */
	public function getCreatorId() {
		return $this->creator_id;
	}

	/**
	 * Sets creator_id
	 *
	 * @param string $creator_id The unique identifier of the Square account that took the payment.
	 * @return $this
	 */
	public function setCreatorId( $creator_id ) {
		$this->creator_id = $creator_id;
		return $this;
	}
	/**
	 * Gets device
	 *
	 * @return \SquareConnect\Model\Device
	 */
	public function getDevice() {
		return $this->device;
	}

	/**
	 * Sets device
	 *
	 * @param \SquareConnect\Model\Device $device The device that took the payment.
	 * @return $this
	 */
	public function setDevice( $device ) {
		$this->device = $device;
		return $this;
	}
	/**
	 * Gets payment_url
	 *
	 * @return string
	 */
	public function getPaymentUrl() {
		return $this->payment_url;
	}

	/**
	 * Sets payment_url
	 *
	 * @param string $payment_url The URL of the payment's detail page in the merchant dashboard. The merchant must be signed in to the merchant dashboard to view this page.
	 * @return $this
	 */
	public function setPaymentUrl( $payment_url ) {
		$this->payment_url = $payment_url;
		return $this;
	}
	/**
	 * Gets receipt_url
	 *
	 * @return string
	 */
	public function getReceiptUrl() {
		return $this->receipt_url;
	}

	/**
	 * Sets receipt_url
	 *
	 * @param string $receipt_url The URL of the receipt for the payment. Note that for split tender payments, this URL corresponds to the receipt for the first tender listed in the payment's tender field. Each Tender object has its own receipt_url field you can use to get the other receipts associated with a split tender payment.
	 * @return $this
	 */
	public function setReceiptUrl( $receipt_url ) {
		$this->receipt_url = $receipt_url;
		return $this;
	}
	/**
	 * Gets inclusive_tax_money
	 *
	 * @return \SquareConnect\Model\V1Money
	 */
	public function getInclusiveTaxMoney() {
		return $this->inclusive_tax_money;
	}

	/**
	 * Sets inclusive_tax_money
	 *
	 * @param \SquareConnect\Model\V1Money $inclusive_tax_money The sum of all inclusive taxes associated with the payment.
	 * @return $this
	 */
	public function setInclusiveTaxMoney( $inclusive_tax_money ) {
		$this->inclusive_tax_money = $inclusive_tax_money;
		return $this;
	}
	/**
	 * Gets additive_tax_money
	 *
	 * @return \SquareConnect\Model\V1Money
	 */
	public function getAdditiveTaxMoney() {
		return $this->additive_tax_money;
	}

	/**
	 * Sets additive_tax_money
	 *
	 * @param \SquareConnect\Model\V1Money $additive_tax_money The sum of all additive taxes associated with the payment.
	 * @return $this
	 */
	public function setAdditiveTaxMoney( $additive_tax_money ) {
		$this->additive_tax_money = $additive_tax_money;
		return $this;
	}
	/**
	 * Gets tax_money
	 *
	 * @return \SquareConnect\Model\V1Money
	 */
	public function getTaxMoney() {
		return $this->tax_money;
	}

	/**
	 * Sets tax_money
	 *
	 * @param \SquareConnect\Model\V1Money $tax_money The total of all taxes applied to the payment. This is always the sum of inclusive_tax_money and additive_tax_money.
	 * @return $this
	 */
	public function setTaxMoney( $tax_money ) {
		$this->tax_money = $tax_money;
		return $this;
	}
	/**
	 * Gets tip_money
	 *
	 * @return \SquareConnect\Model\V1Money
	 */
	public function getTipMoney() {
		return $this->tip_money;
	}

	/**
	 * Sets tip_money
	 *
	 * @param \SquareConnect\Model\V1Money $tip_money The total of all tips applied to the payment.
	 * @return $this
	 */
	public function setTipMoney( $tip_money ) {
		$this->tip_money = $tip_money;
		return $this;
	}
	/**
	 * Gets discount_money
	 *
	 * @return \SquareConnect\Model\V1Money
	 */
	public function getDiscountMoney() {
		return $this->discount_money;
	}

	/**
	 * Sets discount_money
	 *
	 * @param \SquareConnect\Model\V1Money $discount_money The total of all discounts applied to the payment.
	 * @return $this
	 */
	public function setDiscountMoney( $discount_money ) {
		$this->discount_money = $discount_money;
		return $this;
	}
	/**
	 * Gets total_collected_money
	 *
	 * @return \SquareConnect\Model\V1Money
	 */
	public function getTotalCollectedMoney() {
		return $this->total_collected_money;
	}

	/**
	 * Sets total_collected_money
	 *
	 * @param \SquareConnect\Model\V1Money $total_collected_money The total of all discounts applied to the payment.
	 * @return $this
	 */
	public function setTotalCollectedMoney( $total_collected_money ) {
		$this->total_collected_money = $total_collected_money;
		return $this;
	}
	/**
	 * Gets processing_fee_money
	 *
	 * @return \SquareConnect\Model\V1Money
	 */
	public function getProcessingFeeMoney() {
		return $this->processing_fee_money;
	}

	/**
	 * Sets processing_fee_money
	 *
	 * @param \SquareConnect\Model\V1Money $processing_fee_money The total of all processing fees collected by Square for the payment.
	 * @return $this
	 */
	public function setProcessingFeeMoney( $processing_fee_money ) {
		$this->processing_fee_money = $processing_fee_money;
		return $this;
	}
	/**
	 * Gets net_total_money
	 *
	 * @return \SquareConnect\Model\V1Money
	 */
	public function getNetTotalMoney() {
		return $this->net_total_money;
	}

	/**
	 * Sets net_total_money
	 *
	 * @param \SquareConnect\Model\V1Money $net_total_money The amount to be deposited into the merchant's bank account for the payment.
	 * @return $this
	 */
	public function setNetTotalMoney( $net_total_money ) {
		$this->net_total_money = $net_total_money;
		return $this;
	}
	/**
	 * Gets refunded_money
	 *
	 * @return \SquareConnect\Model\V1Money
	 */
	public function getRefundedMoney() {
		return $this->refunded_money;
	}

	/**
	 * Sets refunded_money
	 *
	 * @param \SquareConnect\Model\V1Money $refunded_money The total of all refunds applied to the payment.
	 * @return $this
	 */
	public function setRefundedMoney( $refunded_money ) {
		$this->refunded_money = $refunded_money;
		return $this;
	}
	/**
	 * Gets swedish_rounding_money
	 *
	 * @return \SquareConnect\Model\V1Money
	 */
	public function getSwedishRoundingMoney() {
		return $this->swedish_rounding_money;
	}

	/**
	 * Sets swedish_rounding_money
	 *
	 * @param \SquareConnect\Model\V1Money $swedish_rounding_money The total of all sales, including any applicable taxes, rounded to the smallest legal unit of currency (e.g., the nearest penny in USD, the nearest nickel in CAD)
	 * @return $this
	 */
	public function setSwedishRoundingMoney( $swedish_rounding_money ) {
		$this->swedish_rounding_money = $swedish_rounding_money;
		return $this;
	}
	/**
	 * Gets gross_sales_money
	 *
	 * @return \SquareConnect\Model\V1Money
	 */
	public function getGrossSalesMoney() {
		return $this->gross_sales_money;
	}

	/**
	 * Sets gross_sales_money
	 *
	 * @param \SquareConnect\Model\V1Money $gross_sales_money The total of all sales, including any applicable taxes.
	 * @return $this
	 */
	public function setGrossSalesMoney( $gross_sales_money ) {
		$this->gross_sales_money = $gross_sales_money;
		return $this;
	}
	/**
	 * Gets net_sales_money
	 *
	 * @return \SquareConnect\Model\V1Money
	 */
	public function getNetSalesMoney() {
		return $this->net_sales_money;
	}

	/**
	 * Sets net_sales_money
	 *
	 * @param \SquareConnect\Model\V1Money $net_sales_money The total of all sales, minus any applicable taxes.
	 * @return $this
	 */
	public function setNetSalesMoney( $net_sales_money ) {
		$this->net_sales_money = $net_sales_money;
		return $this;
	}
	/**
	 * Gets inclusive_tax
	 *
	 * @return \SquareConnect\Model\V1PaymentTax[]
	 */
	public function getInclusiveTax() {
		return $this->inclusive_tax;
	}

	/**
	 * Sets inclusive_tax
	 *
	 * @param \SquareConnect\Model\V1PaymentTax[] $inclusive_tax All of the inclusive taxes associated with the payment.
	 * @return $this
	 */
	public function setInclusiveTax( $inclusive_tax ) {
		$this->inclusive_tax = $inclusive_tax;
		return $this;
	}
	/**
	 * Gets additive_tax
	 *
	 * @return \SquareConnect\Model\V1PaymentTax[]
	 */
	public function getAdditiveTax() {
		return $this->additive_tax;
	}

	/**
	 * Sets additive_tax
	 *
	 * @param \SquareConnect\Model\V1PaymentTax[] $additive_tax All of the additive taxes associated with the payment.
	 * @return $this
	 */
	public function setAdditiveTax( $additive_tax ) {
		$this->additive_tax = $additive_tax;
		return $this;
	}
	/**
	 * Gets tender
	 *
	 * @return \SquareConnect\Model\V1Tender[]
	 */
	public function getTender() {
		return $this->tender;
	}

	/**
	 * Sets tender
	 *
	 * @param \SquareConnect\Model\V1Tender[] $tender All of the tenders associated with the payment.
	 * @return $this
	 */
	public function setTender( $tender ) {
		$this->tender = $tender;
		return $this;
	}
	/**
	 * Gets refunds
	 *
	 * @return \SquareConnect\Model\V1Refund[]
	 */
	public function getRefunds() {
		return $this->refunds;
	}

	/**
	 * Sets refunds
	 *
	 * @param \SquareConnect\Model\V1Refund[] $refunds All of the refunds applied to the payment. Note that the value of all refunds on a payment can exceed the value of all tenders if a merchant chooses to refund money to a tender after previously accepting returned goods as part of an exchange.
	 * @return $this
	 */
	public function setRefunds( $refunds ) {
		$this->refunds = $refunds;
		return $this;
	}
	/**
	 * Gets itemizations
	 *
	 * @return \SquareConnect\Model\V1PaymentItemization[]
	 */
	public function getItemizations() {
		return $this->itemizations;
	}

	/**
	 * Sets itemizations
	 *
	 * @param \SquareConnect\Model\V1PaymentItemization[] $itemizations The items purchased in the payment.
	 * @return $this
	 */
	public function setItemizations( $itemizations ) {
		$this->itemizations = $itemizations;
		return $this;
	}
	/**
	 * Gets surcharge_money
	 *
	 * @return \SquareConnect\Model\V1Money
	 */
	public function getSurchargeMoney() {
		return $this->surcharge_money;
	}

	/**
	 * Sets surcharge_money
	 *
	 * @param \SquareConnect\Model\V1Money $surcharge_money The total of all surcharges applied to the payment.
	 * @return $this
	 */
	public function setSurchargeMoney( $surcharge_money ) {
		$this->surcharge_money = $surcharge_money;
		return $this;
	}
	/**
	 * Gets surcharges
	 *
	 * @return \SquareConnect\Model\V1PaymentSurcharge[]
	 */
	public function getSurcharges() {
		return $this->surcharges;
	}

	/**
	 * Sets surcharges
	 *
	 * @param \SquareConnect\Model\V1PaymentSurcharge[] $surcharges A list of all surcharges associated with the payment.
	 * @return $this
	 */
	public function setSurcharges( $surcharges ) {
		$this->surcharges = $surcharges;
		return $this;
	}
	/**
	 * Gets is_partial
	 *
	 * @return bool
	 */
	public function getIsPartial() {
		return $this->is_partial;
	}

	/**
	 * Sets is_partial
	 *
	 * @param bool $is_partial Indicates whether or not the payment is only partially paid for. If true, this payment will have the tenders collected so far, but the itemizations will be empty until the payment is completed.
	 * @return $this
	 */
	public function setIsPartial( $is_partial ) {
		$this->is_partial = $is_partial;
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
