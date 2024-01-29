<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BusinessRequest;
use App\Services\BusinessServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    protected $businessServices;

    public function __construct(
        BusinessServices $businessServices
    ) {
        $this->businessServices = $businessServices;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            if (!empty($request->input('location')) || (!empty($request->input('latitude')) && !empty($request->input('longitude')))) {
                $limit = $request->input('limit', 10);

                $business = $request->hasAny(['term', 'location', 'latitude', 'longtitude', 'radius', 'locale', 'limit'])
                    ? $this->businessServices->filter(
                        $request->input('term', ''),
                        $request->input('location', ''),
                        $request->input('latitude', ''),
                        $request->input('longtitude', ''),
                        $request->input('radius', ''),
                        $request->input('locale', ''),
                        $limit
                    ) : $this->businessServices->all($limit);

                return response()->json($business);
            } else {
                $data =  [
                    "error" =>
                    [
                        'code' => 'VALIDATION_ERROR',
                        'message' => 'Please specify a location or a latitude and longitude'
                    ]
                ];
                return response()->json($data);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $business = $this->businessServices->find($id);

            if (!$business) {
                return response()->json([
                    'error' => 'Business Not Found'
                ], Response::HTTP_NOT_FOUND);
            }

            return response()->json($business);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validation = Validator::make($request->all(), [
            'business_name' => 'required',
            'location' => 'required',
            'latitude' => 'required|min:-90|max:90',
            'longtitude' => 'required|min:-180|max:180',
            'term' => 'required',
            'radius' => 'required',
            'locale' => 'required',
            'price' => 'required|min:0',
        ]);

        if ($validation->fails()) {
            $responseArr['message'] = $validation->errors();
            return response()->json($responseArr, Response::HTTP_BAD_REQUEST);
        }

        try {
            $business = $this->businessServices->create($request->all());

            return response()->json($business, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            if (!$id) {
                return response()->json(['message' => 'id not found'], Response::HTTP_NOT_FOUND);
            }

            $business = $this->businessServices->update($id, $request->all());

            if (!$business) {
                return response()->json(['error' => 'business not found'], response::HTTP_NOT_FOUND);
            }

            return response()->json($business);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            if (!$id) {
                return response()->json(['message' => 'id not found'], Response::HTTP_NOT_FOUND);
            }

            $this->businessServices->delete($id);
            return response()->json(['message' => 'Business deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
