<?php

namespace App\Services;

use App\Repositories\BusinessRepository;

class BusinessServices
{
    protected $businessRepository;

    public function __construct(BusinessRepository $businessRepository)
    {
        $this->businessRepository = $businessRepository;
    }

    public function all($limit = 10)
    {
        return $this->businessRepository->all($limit);
    }

    public function find($id)
    {
        return $this->businessRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->businessRepository->create($data);
    }

    public function update($id, array $data)
    {
        $find = $this->businessRepository->find($id);
        return $this->businessRepository->update($find, $data);
    }

    public function delete($id)
    {
        $find = $this->businessRepository->find($id);
        $this->businessRepository->delete($find);
    }

    public function filter($term, $location, $latitude, $longtitude, $radius, $locale, $limit = 10)
    {
        return $this->businessRepository->filter($term, $location, $latitude, $longtitude, $radius, $locale, $limit);
    }
}
