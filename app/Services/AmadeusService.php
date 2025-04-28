<?php

namespace App\Services;

use Amadeus\Amadeus;
use Amadeus\Exceptions\ResponseException;

class AmadeusService
{
    protected $amadeus;

    public function __construct()
    {
        $this->amadeus = Amadeus::builder(
            env('AMADEUS_API_KEY'),
            env('AMADEUS_API_SECRET')
        )->build();
    }

    public function searchFlights($origin, $destination, $departureDate, $returnDate = null, $adults = 1)
    {
        try {
            return $this->amadeus->getShopping()->getFlightOffers()->get([
                'originLocationCode' => $origin,
                'destinationLocationCode' => $destination,
                'departureDate' => $departureDate,
                'returnDate' => $returnDate,
                'adults' => $adults,
                'max' => 5,
                'currencyCode' => 'NPR'
            ]);
        } catch (ResponseException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getAirlineName($carrierCode)
    {
        try {
            $response = $this->amadeus->getReferenceData()->getAirlines()->get([
                'airlineCodes' => $carrierCode
            ]);
    
            if (!empty($response)) {
                return $response[0]->getBusinessName();
            }
        } catch (\Exception $e) {}
    
        return $carrierCode; 
    }

}
