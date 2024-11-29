<?php
namespace App\Services;

use App\Repositories\Author\AuthorRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorService{
    protected $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository){
        $this->authorRepository = $authorRepository;
    }

    public function getAll($paginate = null, $with = []){
        return $this->authorRepository->getAll($paginate, $with);
    }

    public function create($data){
        $data = [
            'name' => $data['name'],
            'avatar' => $data['avatar'] ?? null,
            'description' => $data['description'] ?? null,
        ];
        return $this->authorRepository->create($data);
    }

    public function update($id, $data){
        $author = $this->authorRepository->find($id);
        if(!$author){
            return abort(404, 'Không tìm thấy tác giả');
        }
        return $this->authorRepository->update($id, $data);
    }

    public function delete($id)
    {
        $author = $this->authorRepository->find($id);

        if (!$author) {
            throw new ModelNotFoundException('Không tìm thấy tác giả');
        }

        $deleted = $this->authorRepository->delete($id);

        if (!$deleted) {
            throw new \Exception('Xóa tác giả thất bại');
        }

        return $author;
    }

}
