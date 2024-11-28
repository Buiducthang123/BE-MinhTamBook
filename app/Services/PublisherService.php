<?php
namespace App\Services;

use App\Repositories\Publisher\PublisherRepositoryInterface;

class PublisherService
{
    protected $publisherRepository;

    public function __construct(PublisherRepositoryInterface $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }
}
