<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use App\Services\UrlServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\QueryParam;
use Knuckles\Scribe\Attributes\Response;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;
use Symfony\Component\HttpFoundation\Response as ApiResponse;

class UrlController extends Controller
{
    public function __construct(
        private readonly UrlServiceInterface $urlService,
    ) {}

    #[Authenticated]
    #[ResponseFromApiResource(UrlResource::class, Url::class, collection: true, paginate: 15)]
    #[Response(['message' => 'Unauthenticated.'], ApiResponse::HTTP_UNAUTHORIZED, 'Unauthenticated')]
    #[QueryParam(name: 'page', type: 'int', example: 1)]
    public function index(): AnonymousResourceCollection
    {
        return UrlResource::collection($this->urlService->paginateUserUrls(Auth::user()));
    }

    #[Authenticated]
    #[ResponseFromApiResource(UrlResource::class, Url::class, status: ApiResponse::HTTP_CREATED)]
    #[Response(['message' => 'Unauthenticated.'], ApiResponse::HTTP_UNAUTHORIZED, 'Unauthenticated')]
    public function store(StoreUrlRequest $request): JsonResponse
    {
        return UrlResource::make($this->urlService->createUserUrl(Auth::user(), $request->getData()))
            ->response()
            ->setStatusCode(ApiResponse::HTTP_CREATED);
    }

    #[Authenticated]
    #[ResponseFromApiResource(UrlResource::class, Url::class)]
    #[Response(['message' => 'Unauthenticated.'], ApiResponse::HTTP_UNAUTHORIZED, 'Unauthenticated')]
    public function show(int $id): UrlResource
    {
        return UrlResource::make($this->urlService->findUserUrlById(Auth::user(), $id));
    }

    #[Authenticated]
    #[Response(status: ApiResponse::HTTP_NO_CONTENT)]
    #[Response(['message' => 'Unauthenticated.'], ApiResponse::HTTP_UNAUTHORIZED, 'Unauthenticated')]
    public function destroy(int $id): JsonResponse
    {
        $this->urlService->deleteUserUrl(Auth::user(), $id);

        return response()->json(null, ApiResponse::HTTP_NO_CONTENT);
    }
}
