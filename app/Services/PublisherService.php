<?php
namespace App\Services;

use App\Repositories\Publisher\PublisherRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PublisherService
{
    protected $publisherRepository;

    public function __construct(PublisherRepositoryInterface $publisherRepository)
    {
        $this->publisherRepository = $publisherRepository;
    }

    public function getAll($data)
    {
        $paginate = $data['paginate'] ?? null;
        $with = $data['with'] ?? [];
        return $this->publisherRepository->getAll($paginate, $with);
    }

    public function create($data)
    {
        $data = [
            'name' => $data['name'],
            'avatar' => $data['avatar'] ?? null,
            'description' => $data['description'] ?? null,
        ];

        return $this->publisherRepository->create($data);
    }

    public function update($id, $data)
    {
        return $this->publisherRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->publisherRepository->delete($id);
    }


}
