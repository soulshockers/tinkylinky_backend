<?php

namespace App\Services;

use App\Data\StoreUrlData;
use App\Models\Url;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class UrlService implements UrlServiceInterface
{
    public function paginateUserUrls(User|Authenticatable $user): LengthAwarePaginator
    {
        return $user->urls()->paginate();
    }

    public function createUserUrl(User|Authenticatable $user, StoreUrlData $data): Url
    {
        return Url::create([
            'url' => $data->url,
            'slug' => Str::random(6),
            'user_id' => $user->id
        ]);
    }

    public function deleteUserUrl(User|Authenticatable $user, int $id): bool
    {
        return $user->urls()->findOrFail($id)->delete();
    }

    public function findUserUrlById(User|Authenticatable $user, int $id): Url
    {
        return $user->urls()->findOrFail($id);
    }
}
