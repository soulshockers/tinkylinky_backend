<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class StoreUrlData extends Data
{
    public function __construct(
        #[Rule(['url'])]
        public string $url,
    ) {}
}
