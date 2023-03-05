<?php

namespace Human018\LaravelAusPost\Services;

class AusParcelExpress implements Service
{
    use PrintTrait;

    const SERVICE = 'AUS_PARCEL_EXPRESS';
    const NAME = 'Express Post';
    const DESCRIPTION = 'Australia Post: Express Parcel';
    const DELIVERY_TIME = '1-2 Business Days';
}
