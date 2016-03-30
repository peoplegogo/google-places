<?php

use Peoplegogo\GooglePlaces\GooglePlaces;

class GooglePlacesTest extends PHPUnit_Framework_TestCase
{
    // Api key used to authenticate in front of Google and also the format of the output data
    private $apiKey = 'MY-API-KEY';
    private $format = 'json';

    /**
     * @desc Test the Nearby Search
     */
    public function testGetNearbySearch()
    {
        // Get instance
        $google_places = new GooglePlaces($this->apiKey);

        // Prepare input parameters
        $params = [
            'location' => '-33.8670522,151.1957362',
            'radius' => 500,
            'type' => 'restaurant',
            'name' => 'cruise'
        ];

        // Get the results
        $results = $google_places->getNearbySearch($params);
    }

    /**
     * @desc Test the Text Search
     */
    public function testGetTextSearch()
    {
        // Get instance
        $google_places = new GooglePlaces();
        $google_places->setApiKey($this->apiKey);
        $google_places->setFormat($this->format);
        $google_places->setLanguage('de');

        // Prepare input parameters
        $params = [
            'query' => 'restaurants+in+Sydney'
        ];

        // Get the results
        $results = $google_places->getTextSearch($params);
    }

    /**
     * @desc Test the Radar Search
     */
    public function testGetRadarSearch()
    {
        // Get instance
        $google_places = new GooglePlaces($this->apiKey);

        // Prepare input parameters
        $params = [
            'location' => '48.859294,2.347589',
            'radius' => 500,
            'type' => 'cafe',
            'keyword' => 'vegetarian'
        ];

        // Get the results
        $results = $google_places->getRadarSearch($params);
    }

    /**
     * @desc Test the Details Search
     */
    public function testGetDetails()
    {
        // Get instance
        $google_places = new GooglePlaces($this->apiKey);

        // Prepare input parameters
        $params = [
            'placeid' => 'ChIJN1t_tDeuEmsRUsoyG83frY4'
        ];

        // Get the results
        $results = $google_places->getDetails($params);
    }

    /**
     * @desc Test the adding of a place
     */
    public function testAddPlace()
    {
        // Get instance
        $google_places = new GooglePlaces($this->apiKey);

        // Prepare input parameters
        $params = [
            'location' => [
                'lat' => -33.8669710,
                'lng' => 151.1958750
            ],
            'accuracy' => 50,
            'name' => 'Google Shoes!',
            'phone_number' => '(02) 9374 4000',
            'address' => '48 Pirrama Road, Pyrmont, NSW 2009, Australia',
            'types' => [
                'shoe_store'
            ],
            'website' => 'http://www.google.com.au/',
            'language' => 'en-AU'
        ];

        // Get the results
        $results = $google_places->addPlace($params);
    }

    /**
     * @desc Test the deletion of a place
     */
    public function testDeletePlace()
    {
        // Get instance
        $google_places = new GooglePlaces($this->apiKey);

        // Prepare input parameters
        $params = [
            'place_id' => 'SOME-ID'
        ];

        // Get the results
        $results = $google_places->deletePlace($params);
    }

    /**
     * @desc Test get photos
     */
    public function testGetPhotos()
    {
        // Get instance
        $google_places = new GooglePlaces($this->apiKey);

        // Prepare input parameters
        $params = [
            'maxwidth' => 400,
            'photoreference' => 'CnRtAAAATLZNl354RwP_9UKbQ_5Psy40texXePv4oAlgP4qNEkdIrkyse7rPXYGd9D_Uj1rVsQdWT4oRz4QrYAJNpFX7rzqqMlZw2h2E2y5IKMUZ7ouD_SlcHxYq1yL4KbKUv3qtWgTK0A6QbGh87GB3sscrHRIQiG2RrmU_jF4tENr9wGS_YxoUSSDrYjWmrNfeEHSGSc3FyhNLlBU'
        ];

        // Get the results
        $results = $google_places->getPhotos($params);
    }

    /**
     * @desc Test the autocompletion
     */
    public function testGetAutocomplete()
    {
        // Get instance
        $google_places = new GooglePlaces($this->apiKey);

        // Prepare input parameters
        $params = [
            'input' => 'Vict',
            'types' => '(cities)',
            'language' => 'pt_BR'
        ];

        // Get the results
        $results = $google_places->getAutocomplete($params);
    }

    /**
     * @desc Test the query autocompletion
     */
    public function testGetQueryAutocomplete()
    {
        // Get instance
        $google_places = new GooglePlaces($this->apiKey);

        // Prepare input parameters
        $params = [
            'language' => 'fr',
            'input' => 'pizza+near+par'
        ];

        // Get the results
        $results = $google_places->getQueryAutocomplete($params);
    }
}

