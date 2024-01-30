<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleShowCollection;
use App\Models\Articel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

use function App\Helpers\generateSlug;

class ArticleController extends Controller
{
    protected $articelModel;

    public function __construct(
        Articel $articelModel
    ) {
        $this->articelModel = $articelModel;
        $this->middleware('jwt.auth:api', ['except' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        try {
            $limit = $request->input('limit', 10);
            $limit = max(1, (int)$limit);

            $article = $this->articelModel->query()
                ->select('*', 'articels.id as idsArticle')
                ->join('users', 'users.id', '=', 'articels.user_id');

            if ($request->has('title')) {
                $article->where('title', 'like', '%' . $request->title . '%');
            }

            if ($request->has('alias')) {
                $article->where('alias', 'like', '%' . $request->alias . '%');
            }
            $article->orderBy('publish_at', 'DESC');
            $data = $article->paginate($limit);
            return new ArticleCollection($data);
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(
                ['message' => $e],
                201
            );
        }
    }

    public function show($identifier)
    {
        try {
            $article = $this->articelModel->join('users', 'users.id', '=', 'articels.user_id');
            if (is_numeric($identifier)) {
                $articleData = $article->findOrFail($identifier);
            } else {
                $articleData = $article->where('articels.alias', $identifier)->firstOrFail();
            }

            return new ArticleShowCollection($articleData);
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(
                ['message' => $e],
                201
            );
        }
    }

    public function store(Request $request): JsonResponse
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2080',
        ]);

        if ($validation->fails()) {
            $responseArr['message'] = $validation->errors();
            return response()->json($responseArr, Response::HTTP_BAD_REQUEST);
        }

        try {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/images', $imageName);

            $article = Articel::create([
                'alias' => generateSlug($request->title),
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => $request->user_id,
                'image' => $imageName,
                'publish_at' => now(),
            ]);

            return response()->json(['data' => $article], 201);
        } catch (\PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(
                ['message' => $e],
                201
            );
        }
    }
}
