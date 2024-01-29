<?php

namespace App\Repositories;

use App\Models\Business;

class BusinessRepository
{
    protected $businessModel;

    public function __construct(
        Business $businessModel
    ) {
        $this->businessModel = $businessModel;
    }

    public function all($limit = 10)
    {
        return $this->businessModel->paginate($limit);
    }

    public function find($id)
    {
        return $this->businessModel->find($id);
    }

    public function create(array $data)
    {
        return $this->businessModel->create($data);
    }

    public function update(Business $business, array $data)
    {
        $business->update($data);
        return $business;
    }

    public function delete(Business $business)
    {
        $business->delete();
    }

    public function filter($term, $location, $latitude, $longtitude, $radius, $locale, $limit = 10)
    {
        $filter = $this->businessModel->where('term', 'like', "%$term%")
            ->where('location', 'like', "%$location%")
            ->where('latitude', 'like', "%$latitude%")
            ->where('longtitude', 'like', "%$longtitude%")
            ->where('radius', 'like', "%$radius%")
            ->where('locale', 'like', "%$locale%")
            ->paginate($limit);

        return $filter;
    }
}
