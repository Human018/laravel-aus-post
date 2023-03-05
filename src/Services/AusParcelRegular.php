<?php

namespace Human018\LaravelAusPost\Services;

class AusParcelRegular implements Service
{
    use PrintTrait;

    const SERVICE = 'AUS_PARCEL_REGULAR';
    const NAME = 'Regular Post';
    const DESCRIPTION = 'Australia Post: Regular Parcel';
    const DELIVERY_TIME = '3-5 business days';
}
