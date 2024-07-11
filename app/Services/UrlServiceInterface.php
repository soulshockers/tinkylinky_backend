<?php

namespace App\Services;

use App\Data\StoreUrlData;
use App\Models\Url;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UrlServiceInterface
{
    public function paginateUserUrls(User|Authenticatable $user): LengthAwarePaginator;

    public function findUserUrlById(User|Authenticatable $user, int $id): Url;

    public function createUserUrl(User|Authenticatable $user, StoreUrlData $data): Url;

    public function deleteUserUrl(User|Authenticatable $user, int $id): bool;
}
