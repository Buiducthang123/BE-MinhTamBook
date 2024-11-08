<?php
namespace App\Services;

use App\Repositories\Role\RoleRepositoryInterface;

class RoleService {
     protected $roleRepository;

     /**
      * Class constructor.
      */
     public function __construct(RoleRepositoryInterface $roleRepository)
     {
         $this->roleRepository = $roleRepository;
     }
}
