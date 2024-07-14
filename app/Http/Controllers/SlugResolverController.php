<?php

namespace App\Http\Controllers;

use App\Models\Url;

class SlugResolverController extends Controller
{
    public function __invoke(string $slug)
    {
        return redirect(Url::where('slug', $slug)->firstOrFail()->url);
    }
}
