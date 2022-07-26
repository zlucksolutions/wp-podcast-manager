<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Api;

use \SquareConnect\Configuration;
use \SquareConnect\ApiClient;
use \SquareConnect\ApiException;
use \SquareConnect\ObjectSerializer;

/**
 * ReportingApi Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache Licene v2
 * @link     https://squareup.com/developers
 */
class ReportingApi {


	/**
	 * API Client
	 *
	 * @var \SquareConnect\ApiClient instance of the ApiClient
	 */
	protected $apiClient;

	/**
	 * Constructor
	 *
	 * @param \SquareConnect\ApiClient|null $apiClient The api client to use
	 */
	function __construct( $apiClient = null ) {
		if ( $apiClient == null ) {
			$apiClient = new ApiClient();
			$apiClient->getConfig()->setHost( 'https://connect.squareup.com' );
		}

		$this->apiClient = $apiClient;
	}

	/**
	 * Get API client
	 *
	 * @return \SquareConnect\ApiClient get the API client
	 */
	public function getApiClient() {
		return $this->apiClient;
	}

	/**
	 * Set the API client
	 *
	 * @param \SquareConnect\ApiClient $apiClient set the API client
	 * @return ReportingApi
	 */
	public function setApiClient( ApiClient $apiClient ) {
		$this->apiClient = $apiClient;
		return $this;
	}

	/**
	 * @deprecated
	 * listAdditionalRecipientReceivableRefunds
	 *
	 * ListAdditionalRecipientReceivableRefunds
	 *
	 * @param string $location_id The ID of the location to list AdditionalRecipientReceivableRefunds for. (required)
	 * @param string $begin_time The beginning of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time minus one year. (optional)
	 * @param string $end_time The end of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time. (optional)
	 * @param string $sort_order The order in which results are listed in the response (&#x60;ASC&#x60; for oldest first, &#x60;DESC&#x60; for newest first).  Default value: &#x60;DESC&#x60; (optional)
	 * @param string $cursor A pagination cursor returned by a previous call to this endpoint. Provide this to retrieve the next set of results for your original query.  See [Pagination](/basics/api101/pagination) for more information. (optional)
	 * @return \SquareConnect\Model\ListAdditionalRecipientReceivableRefundsResponse
	 * @throws \SquareConnect\ApiException on non-2xx response
	 */
	public function listAdditionalRecipientReceivableRefunds( $location_id, $begin_time = null, $end_time = null, $sort_order = null, $cursor = null ) {
		trigger_error( 'Calling deprecated API: ReportingApi.listAdditionalRecipientReceivableRefunds', E_USER_DEPRECATED );
		list($response, $statusCode, $httpHeader) = $this->listAdditionalRecipientReceivableRefundsWithHttpInfo( $location_id, $begin_time, $end_time, $sort_order, $cursor );
		return $response;
	}


	/**
	 * listAdditionalRecipientReceivableRefundsWithHttpInfo
	 *
	 * ListAdditionalRecipientReceivableRefunds
	 *
	 * @param string $location_id The ID of the location to list AdditionalRecipientReceivableRefunds for. (required)
	 * @param string $begin_time The beginning of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time minus one year. (optional)
	 * @param string $end_time The end of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time. (optional)
	 * @param string $sort_order The order in which results are listed in the response (&#x60;ASC&#x60; for oldest first, &#x60;DESC&#x60; for newest first).  Default value: &#x60;DESC&#x60; (optional)
	 * @param string $cursor A pagination cursor returned by a previous call to this endpoint. Provide this to retrieve the next set of results for your original query.  See [Pagination](/basics/api101/pagination) for more information. (optional)
	 * @return Array of \SquareConnect\Model\ListAdditionalRecipientReceivableRefundsResponse, HTTP status code, HTTP response headers (array of strings)
	 * @throws \SquareConnect\ApiException on non-2xx response
	 */
	public function listAdditionalRecipientReceivableRefundsWithHttpInfo( $location_id, $begin_time = null, $end_time = null, $sort_order = null, $cursor = null ) {

		// verify the required parameter 'location_id' is set
		if ( $location_id === null ) {
			throw new \InvalidArgumentException( 'Missing the required parameter $location_id when calling listAdditionalRecipientReceivableRefunds' );
		}

		// parse inputs
		$resourcePath   = '/v2/locations/{location_id}/additional-recipient-receivable-refunds';
		$httpBody       = '';
		$queryParams    = array();
		$headerParams   = array();
		$formParams     = array();
		$_header_accept = ApiClient::selectHeaderAccept( array( 'application/json' ) );
		if ( ! is_null( $_header_accept ) ) {
			$headerParams['Accept'] = $_header_accept;
		}
		$headerParams['Content-Type']   = ApiClient::selectHeaderContentType( array( 'application/json' ) );
		$headerParams['Square-Version'] = '2019-08-14';

		// query params
		if ( $begin_time !== null ) {
			$queryParams['begin_time'] = $this->apiClient->getSerializer()->toQueryValue( $begin_time );
		}// query params
		if ( $end_time !== null ) {
			$queryParams['end_time'] = $this->apiClient->getSerializer()->toQueryValue( $end_time );
		}// query params
		if ( $sort_order !== null ) {
			$queryParams['sort_order'] = $this->apiClient->getSerializer()->toQueryValue( $sort_order );
		}// query params
		if ( $cursor !== null ) {
			$queryParams['cursor'] = $this->apiClient->getSerializer()->toQueryValue( $cursor );
		}

		// path params
		if ( $location_id !== null ) {
			$resourcePath = str_replace(
				'{' . 'location_id' . '}',
				$this->apiClient->getSerializer()->toPathValue( $location_id ),
				$resourcePath
			);
		}
		// default format to json
		$resourcePath = str_replace( '{format}', 'json', $resourcePath );

		// for model (json/xml)
		if ( isset( $_tempBody ) ) {
			$httpBody = $_tempBody; // $_tempBody is the method argument, if present
		} elseif ( count( $formParams ) > 0 ) {
			$httpBody = $formParams; // for HTTP post (form)
		}

		// this endpoint requires OAuth (access token)
		if ( strlen( $this->apiClient->getConfig()->getAccessToken() ) !== 0 ) {
			$headerParams['Authorization'] = 'Bearer ' . $this->apiClient->getConfig()->getAccessToken();
		}
		// make the API Call
		try {
			list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
				$resourcePath,
				'GET',
				$queryParams,
				$httpBody,
				$headerParams,
				'\SquareConnect\Model\ListAdditionalRecipientReceivableRefundsResponse'
			);
			if ( ! $response ) {
				return array( null, $statusCode, $httpHeader );
			}

			return array( \SquareConnect\ObjectSerializer::deserialize( $response, '\SquareConnect\Model\ListAdditionalRecipientReceivableRefundsResponse', $httpHeader ), $statusCode, $httpHeader );
		} catch ( ApiException $e ) {
			switch ( $e->getCode() ) {
				case 200:
					$data = \SquareConnect\ObjectSerializer::deserialize( $e->getResponseBody(), '\SquareConnect\Model\ListAdditionalRecipientReceivableRefundsResponse', $e->getResponseHeaders() );
					$e->setResponseObject( $data );
					break;
			}

			throw $e;
		}
	}
	/**
	 * @deprecated
	 * listAdditionalRecipientReceivables
	 *
	 * ListAdditionalRecipientReceivables
	 *
	 * @param string $location_id The ID of the location to list AdditionalRecipientReceivables for. (required)
	 * @param string $begin_time The beginning of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time minus one year. (optional)
	 * @param string $end_time The end of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time. (optional)
	 * @param string $sort_order The order in which results are listed in the response (&#x60;ASC&#x60; for oldest first, &#x60;DESC&#x60; for newest first).  Default value: &#x60;DESC&#x60; (optional)
	 * @param string $cursor A pagination cursor returned by a previous call to this endpoint. Provide this to retrieve the next set of results for your original query.  See [Pagination](/basics/api101/pagination) for more information. (optional)
	 * @return \SquareConnect\Model\ListAdditionalRecipientReceivablesResponse
	 * @throws \SquareConnect\ApiException on non-2xx response
	 */
	public function listAdditionalRecipientReceivables( $location_id, $begin_time = null, $end_time = null, $sort_order = null, $cursor = null ) {
		trigger_error( 'Calling deprecated API: ReportingApi.listAdditionalRecipientReceivables', E_USER_DEPRECATED );
		list($response, $statusCode, $httpHeader) = $this->listAdditionalRecipientReceivablesWithHttpInfo( $location_id, $begin_time, $end_time, $sort_order, $cursor );
		return $response;
	}


	/**
	 * listAdditionalRecipientReceivablesWithHttpInfo
	 *
	 * ListAdditionalRecipientReceivables
	 *
	 * @param string $location_id The ID of the location to list AdditionalRecipientReceivables for. (required)
	 * @param string $begin_time The beginning of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time minus one year. (optional)
	 * @param string $end_time The end of the requested reporting period, in RFC 3339 format.  See [Date ranges](#dateranges) for details on date inclusivity/exclusivity.  Default value: The current time. (optional)
	 * @param string $sort_order The order in which results are listed in the response (&#x60;ASC&#x60; for oldest first, &#x60;DESC&#x60; for newest first).  Default value: &#x60;DESC&#x60; (optional)
	 * @param string $cursor A pagination cursor returned by a previous call to this endpoint. Provide this to retrieve the next set of results for your original query.  See [Pagination](/basics/api101/pagination) for more information. (optional)
	 * @return Array of \SquareConnect\Model\ListAdditionalRecipientReceivablesResponse, HTTP status code, HTTP response headers (array of strings)
	 * @throws \SquareConnect\ApiException on non-2xx response
	 */
	public function listAdditionalRecipientReceivablesWithHttpInfo( $location_id, $begin_time = null, $end_time = null, $sort_order = null, $cursor = null ) {

		// verify the required parameter 'location_id' is set
		if ( $location_id === null ) {
			throw new \InvalidArgumentException( 'Missing the required parameter $location_id when calling listAdditionalRecipientReceivables' );
		}

		// parse inputs
		$resourcePath   = '/v2/locations/{location_id}/additional-recipient-receivables';
		$httpBody       = '';
		$queryParams    = array();
		$headerParams   = array();
		$formParams     = array();
		$_header_accept = ApiClient::selectHeaderAccept( array( 'application/json' ) );
		if ( ! is_null( $_header_accept ) ) {
			$headerParams['Accept'] = $_header_accept;
		}
		$headerParams['Content-Type']   = ApiClient::selectHeaderContentType( array( 'application/json' ) );
		$headerParams['Square-Version'] = '2019-08-14';

		// query params
		if ( $begin_time !== null ) {
			$queryParams['begin_time'] = $this->apiClient->getSerializer()->toQueryValue( $begin_time );
		}// query params
		if ( $end_time !== null ) {
			$queryParams['end_time'] = $this->apiClient->getSerializer()->toQueryValue( $end_time );
		}// query params
		if ( $sort_order !== null ) {
			$queryParams['sort_order'] = $this->apiClient->getSerializer()->toQueryValue( $sort_order );
		}// query params
		if ( $cursor !== null ) {
			$queryParams['cursor'] = $this->apiClient->getSerializer()->toQueryValue( $cursor );
		}

		// path params
		if ( $location_id !== null ) {
			$resourcePath = str_replace(
				'{' . 'location_id' . '}',
				$this->apiClient->getSerializer()->toPathValue( $location_id ),
				$resourcePath
			);
		}
		// default format to json
		$resourcePath = str_replace( '{format}', 'json', $resourcePath );

		// for model (json/xml)
		if ( isset( $_tempBody ) ) {
			$httpBody = $_tempBody; // $_tempBody is the method argument, if present
		} elseif ( count( $formParams ) > 0 ) {
			$httpBody = $formParams; // for HTTP post (form)
		}

		// this endpoint requires OAuth (access token)
		if ( strlen( $this->apiClient->getConfig()->getAccessToken() ) !== 0 ) {
			$headerParams['Authorization'] = 'Bearer ' . $this->apiClient->getConfig()->getAccessToken();
		}
		// make the API Call
		try {
			list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
				$resourcePath,
				'GET',
				$queryParams,
				$httpBody,
				$headerParams,
				'\SquareConnect\Model\ListAdditionalRecipientReceivablesResponse'
			);
			if ( ! $response ) {
				return array( null, $statusCode, $httpHeader );
			}

			return array( \SquareConnect\ObjectSerializer::deserialize( $response, '\SquareConnect\Model\ListAdditionalRecipientReceivablesResponse', $httpHeader ), $statusCode, $httpHeader );
		} catch ( ApiException $e ) {
			switch ( $e->getCode() ) {
				case 200:
					$data = \SquareConnect\ObjectSerializer::deserialize( $e->getResponseBody(), '\SquareConnect\Model\ListAdditionalRecipientReceivablesResponse', $e->getResponseHeaders() );
					$e->setResponseObject( $data );
					break;
			}

			throw $e;
		}
	}
}
