<?php

namespace Human018\LaravelAusPost;

use Human018\LaravelAusPost\Client\Http;
use Human018\LaravelAusPost\Exceptions\InvalidForDomesticServiceException;
use Human018\LaravelAusPost\Exceptions\InvalidForInternationalServiceException;

class AusPost
{
    private $client;
    private static $target;
    private $url;
    private $query;
    private $measurements = 'mm';
    private $weights = 'g';

    const DOMESTIC_POSTCODE_SEARCH = '/postcode/search.json';
    const INTL_COUNTRIES = '/postage/country.json';
    const DOMESTIC_LETTER_THICKNESS = '/postage/letter/domestic/thickness.json';
    const DOMESTIC_LETTER_WEIGHT = '/postage/letter/domestic/weight.json';
    const DOMESTIC_LETTER_SIZE = '/postage/letter/domestic/size.json';
    const INTL_LETTER_WEIGHT = '/postage/letter/international/weight.json';
    const INTL_PARCEL_WEIGHT = '/postage/parcel/international/weight.json';
    const DOMESTIC_PARCEL_WEIGHT = '/postage/parcel/domestic/weight.json';
    const DOMESTIC_PARCEL_TYPE = '/postage/parcel/domestic/type.json';
    const DOMESTIC_PARCEL_SIZE = '/postage/parcel/domestic/size.json';
    const DOMESTIC_LETTER_SERVICE = '/postage/letter/domestic/service.json';
    const DOMESTIC_PARCEL_SERVICE = '/postage/parcel/domestic/service.json';
    const INTL_LETTER_SERVICE = '/postage/letter/international/service.json';
    const INTL_PARCEL_SERVICE = '/postage/parcel/international/service.json';
    const DOMESTIC_PARCEL_CALCULATE = '/postage/parcel/domestic/calculate.json';
    const INTL_PARCEL_CALCULATE = '/postage/parcel/international/calculate.json';
    const DOMESTIC_LETTER_CALCULATE = '/postage/letter/domestic/calculate.json';
    const INTL_LETTER_CALCULATE = '/postage/letter/international/calculate.json';

    public function __construct()
    {
        $this->client = new Http();
    }

    public static function domestic(): AusPost
    {
        self::$target = 'domestic';
        return new self();
    }

    public static function intl(): AusPost
    {
        self::$target = 'intl';
        return new self();
    }

    public static function international(): AusPost
    {
        self::$target = 'intl';
        return new self();
    }

    public function toCountry($countryCode)
    {
        if (self::$target == 'domestic')
            throw new InvalidForDomesticServiceException('The \'toCountry\' method is not available for domestic services');
        $this->query['country_code'] = $countryCode;
        return $this;
    }

    public function fromPostcode($postcode)
    {
        $this->query['from_postcode'] = $postcode;
        return $this;
    }

    public function toPostcode($postcode)
    {
        $this->query['to_postcode'] = $postcode;
        return $this;
    }

    public function length($lengthInMillimetres)
    {
        $this->query['length'] = $lengthInMillimetres;
        return $this;
    }

    public function width($widthInMillimetres)
    {
        $this->query['width'] = $widthInMillimetres;
        return $this;
    }

    public function height($heightInMillimetres)
    {
        $this->query['height'] = $heightInMillimetres;
        return $this;
    }

    public function thickness($thicknessInMillimetres)
    {
        $this->query['thickness'] = $thicknessInMillimetres;
        return $this;
    }

    public function weight($weightInGrams)
    {
        $this->query['weight'] = $weightInGrams;
        return $this;
    }

    public function for($query)
    {
        $this->query['q'] = $query;
        return $this;
    }

    public function usingService($serviceCode)
    {
        $this->query['service_code'] = $serviceCode;
        return $this;
    }

    public function inState($stateAbbreviation)
    {
        $this->query['state'] = $stateAbbreviation;
        return $this;
    }

    public function postcodeSearch()
    {
        if (self::$target == 'intl')
            throw new InvalidForInternationalServiceException('The \'postcodeSearch\' method is not available for international services');
        $this->url = self::DOMESTIC_POSTCODE_SEARCH;
        return $this;
    }

    public function countries()
    {
        if (self::$target == 'domestic')
            throw new InvalidForDomesticServiceException('The \'countries\' method is not available for domestic services');
        $this->url = self::INTL_COUNTRIES;
        return $this;
    }

    public function letterThicknesses()
    {
        if (self::$target == 'intl')
            throw new InvalidForInternationalServiceException('The \'letterThickness\' method is not available for international services');
        $this->url = self::DOMESTIC_LETTER_THICKNESS;
        return $this;
    }

    public function letterWeights()
    {
        $this->url = self::$target == 'intl' ? self::INTL_LETTER_WEIGHT : self::DOMESTIC_LETTER_WEIGHT;
        return $this;
    }

    public function letterSizes()
    {
        if (self::$target == 'intl')
            throw new InvalidForInternationalServiceException('The \'letterSizes\' method is not available for international services');
        $this->url = self::DOMESTIC_LETTER_SIZE;
        return $this;
    }

    public function parcelWeights()
    {
        $this->url = self::$target == 'intl' ? self::INTL_PARCEL_WEIGHT : self::DOMESTIC_PARCEL_WEIGHT;
        return $this;
    }

    public function parcelTypes()
    {
        if (self::$target == 'intl')
            throw new InvalidForInternationalServiceException('The \'parcelTypes\' method is not available for international services');
        $this->url = self::DOMESTIC_PARCEL_TYPE;
        return $this;
    }

    public function parcelSizes()
    {
        if (self::$target == 'intl')
            throw new InvalidForInternationalServiceException('The \'parcelSizes\' method is not available for international services');
        $this->url = self::DOMESTIC_PARCEL_SIZE;
        return $this;
    }

    public function letterServices()
    {
        $this->url = self::$target == 'intl' ? self::INTL_LETTER_SERVICE : self::DOMESTIC_LETTER_SERVICE;
        return $this;
    }

    public function parcelServices()
    {
        $this->url = self::$target == 'intl' ? self::INTL_PARCEL_SERVICE : self::DOMESTIC_PARCEL_SERVICE;
        $this->measurements = 'cm';
        $this->weights = 'kg';
        return $this;
    }

    public function parcelCalculate()
    {
        $this->url = self::$target == 'intl' ? self::INTL_PARCEL_CALCULATE : self::DOMESTIC_PARCEL_CALCULATE;
        $this->measurements = 'cm';
        $this->weights = 'kg';
        return $this;
    }

    public function letterCalculate()
    {
        $this->url = self::$target == 'intl' ? self::INTL_LETTER_CALCULATE : self::DOMESTIC_LETTER_CALCULATE;
        return $this;
    }

    public function get()
    {
        if ($this->measurements == 'cm') {
            if (isset($this->query['length']))
                $this->query['length'] = $this->query['length'] / 10;
            if (isset($this->query['width']))
                $this->query['width'] = $this->query['width'] / 10;
            if (isset($this->query['thickness']))
                $this->query['thickness'] = $this->query['thickness'] / 10;
            if (isset($this->query['height']))
                $this->query['height'] = $this->query['height'] / 10;
        }

        if ($this->weights == 'kg') {
            if (isset($this->query['weight']))
                $this->query['weight'] = $this->query['weight'] / 1000;
        }

        return $this->client->get($this->url, $this->query);
    }
}
