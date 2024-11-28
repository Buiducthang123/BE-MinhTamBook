<?php

namespace App\Services;

use App\Repositories\ShippingAddress\ShippingAddressRepositoryInterface;

class ShippingAddressService {
    protected $shippingAddressRepository;

    public function __construct(ShippingAddressRepositoryInterface $shippingAddressRepository){
        $this->shippingAddressRepository = $shippingAddressRepository;
    }
}
