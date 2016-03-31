<?php

namespace Peoplegogo\GooglePlaces;

/**
 * A PHP wrapper for the Google Places API.
 *
 * @author    Pavel Tashev
 * @copyright Copyright 2016 by Pavel Tashev
 * @license   https://github.com/peoplegogo/google-places/blob/master/LICENSE MIT
 * @link      https://developers.google.com/places/web-service/intro#Introduction
 * @package   Google Places API Web Service
 * @version   1.0.0
 */
class GooglePlaces
{
    // General
    const URL_DOMAIN = 'https://maps.googleapis.com';
    const URL_PATH = '/maps/api/place/';

    // Services
    const NEARBY_SEARCH_PATH = 'nearbysearch/';
    const TEXT_SEARCH_PATH = 'textsearch/';
    const RADAR_SEARCH_PATH = 'radarsearch/';
    const DETAILS_PATH = 'details/';
    const ADD_PATH = 'add/';
    const DELETE_PATH = 'delete/';
    const PHOTOS_PATH = 'photo';
    const AUTOCOMPLETE_PATH = 'autocomplete/';
    const QUERY_AUTOCOMPLETE_PATH = 'queryautocomplete/';

    // Formats
    const DEFAULT_FORMAT = 'json';
    const FORMAT_JSON = 'json';
    const FORMAT_XML = 'xml';

    /**
     * API key to authenticate with.
     * @var string
     */
    private $apiKey;

    /**
     * Response format.
     * @var string
     */
    private $format;

    /**
     * Language code in which to return results.
     * @var string
     */
    private $language;

    /**
     * HTTP code of the response.
     * @var integer
     */
    private $http_code;

    /**
     * Header of the response.
     * @var mixed
     */
    private $header;



    /**
     * @desc Constructor.
     * @param string $apiKey API key
     * @param boolean|string $format
     */
    public function __construct($apiKey = '', $format = false)
    {
        $this->apiKey = $apiKey;
        $this->format = $format ? $format : GooglePlaces::DEFAULT_FORMAT;
    }

    /**
     * @desc Set the API key to authenticate with.
     * @param string $apiKey API key
     * @return GooglePlaces
     */
    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @desc Get the API key to authenticate with.
     * @return string API key
     */
    public function getApiKey() {
        return $this->apiKey;
    }

    /**
     * @desc Set the response format.
     * @param string $format response format
     * @return GooglePlaces
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * @desc Get the response format.
     * @return string response format
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @desc Set the language code in which to return results.
     * @link https://developers.google.com/maps/faq#using-google-maps-apis
     * @param string $language language
     * @return GooglePlaces
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @desc Get the language code in which to return results.
     * @link https://developers.google.com/maps/faq#using-google-maps-apis
     * @return string language
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @desc Get HTTP response code
     * @return integer
     */
    public function getHttpCode()
    {
        return $this->http_code;
    }

    /**
     * @desc Get HTTP header
     * @return mixed
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @desc Check if the response format is JSON.
     * @return bool if it is JSON
     */
    public function isFormatJson()
    {
        return $this->getFormat() == self::FORMAT_JSON;
    }

    /**
     * @desc Check if the response format is XML.
     * @return bool if it is XML
     */
    public function isFormatXml()
    {
        return $this->getFormat() == self::FORMAT_XML;
    }

    /**
     * @desc Get nearby places.
     * @link https://developers.google.com/places/web-service/search#PlaceSearchRequests
     * @param array $params Array of input parameters.
     * @return mixed
     */
    public function getNearbySearch($params)
    {
        return $this->getContent(GooglePlaces::NEARBY_SEARCH_PATH, $params);
    }

    /**
     * @desc Text search.
     * @link https://developers.google.com/places/web-service/search#TextSearchRequests
     * @param array $params Array of input parameters.
     * @return mixed
     */
    public function getTextSearch($params)
    {
        return $this->getContent(GooglePlaces::TEXT_SEARCH_PATH, $params);
    }

    /**
     * @desc Radar search.
     * @link https://developers.google.com/places/web-service/search#RadarSearchRequests
     * @param array $params Array of input parameters.
     * @return mixed
     */
    public function getRadarSearch($params)
    {
        return $this->getContent(GooglePlaces::RADAR_SEARCH_PATH, $params);
    }

    /**
     * @desc Get more info of the place.
     * @link https://developers.google.com/places/web-service/details#PlaceDetailsRequests
     * @param array $params Array of input parameters.
     * @return mixed
     */
    public function getDetails($params)
    {
        return $this->getContent(GooglePlaces::DETAILS_PATH, $params);
    }

    /**
     * @desc Add a place.
     * @link https://developers.google.com/places/web-service/add-place#add-place-overview
     * @param array $params Array of input parameters.
     * @return mixed
     */
    public function addPlace($params)
    {
        return $this->postContent(GooglePlaces::ADD_PATH, $params);
    }

    /**
     * @desc Delete a place.
     * @link https://developers.google.com/places/web-service/add-place#delete-place
     * @param array $params Array of input parameters.
     * @return mixed
     */
    public function deletePlace($params)
    {
        return $this->deleteContent(GooglePlaces::DELETE_PATH, $params);
    }

    /**
     * @desc This request will return the referenced image, resizing it so that it is at most 400 pixels wide.
     * @link https://developers.google.com/places/web-service/photos#place_photo_requests
     * @param array $params Array of input parameters.
     * @return mixed
     */
    public function getPhotos($params)
    {
        return $this->getContent(GooglePlaces::PHOTOS_PATH, $params);
    }

    /**
     * @desc Get autocomplete suggestions by passing input parameters.
     * @link https://developers.google.com/places/web-service/autocomplete#place_autocomplete_results
     * @param array $params Array of input parameters.
     * @return mixed
     */
    public function getAutocomplete($params)
    {
        return $this->getContent(GooglePlaces::AUTOCOMPLETE_PATH, $params);
    }

    /**
     * @desc The Query Autocomplete service allows you to add on-the-fly geographic query predictions to your application.
     * @link https://developers.google.com/places/web-service/query#query_autocomplete_requests
     * @param array $params Array of input parameters.
     * @return mixed
     */
    public function getQueryAutocomplete($params)
    {
        return $this->getContent(GooglePlaces::QUERY_AUTOCOMPLETE_PATH, $params);
    }

    /**
     * @desc Get the content.
     * @param string $service Type of the Google service we are going to use
     * @param array $params Input parameters
     * @return mixed|SimpleXMLElement
     */
    private function getContent($service, $params)
    {
        // Add variables
        $params = $this->addParameters($params);

        // Send request to Google and return the content
        $response = $this->request('GET', $this->constructUrl($service), $params);
        return $this->decodeResponse($response);
    }

    /**
     * @desc Post content.
     * @param string $service Type of the Google service we are going to use
     * @param array $params Input parameters
     * @return SimpleXMLElement|mixed
     */
    private function postContent($service, $params)
    {
        // Add variables
        $params = $this->addParameters($params);

        // Send request to Google and return the content
        $response = $this->request('POST', $this->constructUrl($service), $params);
        return $this->decodeResponse($response);
    }

    /**
     * @desc Delete content.
     * @param string $service Type of the Google service we are going to use
     * @param array $params Input parameters
     * @return SimpleXMLElement|mixed
     */
    private function deleteContent($service, $params)
    {
        // Add variables
        $params = $this->addParameters($params);

        // Send request to Google and return the content
        $response = $this->request('DELETE', $this->constructUrl($service), $params);
        return $this->decodeResponse($response);
    }

    /**
     * @desc Construct URL address with the API key and the proper format.
     * @param string $service_path Path to the service
     * @return string
     */
    private function constructUrl($service_path)
    {
        // Check if we have to set the format or no
        $formatted = ($service_path == GooglePlaces::PHOTOS_PATH) ? false : true;

        return GooglePlaces::URL_DOMAIN.GooglePlaces::URL_PATH.$service_path.($formatted ? $this->format : '').'?key='.$this->apiKey;
    }

    /**
     * @desc Add to the input parameters additional parameters if there are any.
     * @param $params
     * @return mixed
     */
    private function addParameters($params)
    {
        if (!isset($params['language']) && $this->getLanguage()) {
            $params['language'] = $this->getLanguage();
        }

        return $params;
    }

    /**
     * @desc Decode the response and return it in the required format.
     * @param $response
     * @return SimpleXMLElement|mixed
     */
    private function decodeResponse($response)
    {
        if ($this->isFormatJson()) {
            return json_decode($response);
        } elseif ($this->isFormatXml()) {
            return (array) new SimpleXMLElement($response);
        }

        return $response;
    }

    /**
     * @desc Executes DELETE|GET|POST|PUT request.
     * @param $method Http method
     * @param $request_url URL
     * @param $params Input parameters
     * @return mixed
     */
    private function request($method, $request_url, $params)
    {
        // Initialize
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        // Prepare the query
        if ($method == 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        } else if ($method == 'GET') {
            $request_url .= '&' . http_build_query($params);
        } else if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        } else if ($method == 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/'.$this->format));
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Get the Response and info for the header and the http code
        $response = curl_exec($ch);
        $response_info = curl_getinfo($ch);

        // Close Curl
        curl_close($ch);

        // Get the HTTP code and separate the response header from the response body
        $this->http_code = $response_info['http_code'];
        $this->header = trim(substr($response, 0, $response_info['header_size']));
        $response_body = substr($response, $response_info['header_size']);

        return $response_body;
    }
}
