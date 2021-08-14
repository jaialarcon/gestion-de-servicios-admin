<?php

namespace App\Http\Controllers;

use App\Models\Request;
use Orion\Http\Controllers\Controller;

class RequestsController extends Controller
{
    protected $model = Request::class;

    /**
     * The attributes that are used for searching.
     *
     * @return array
     */
    public function searchableBy(): array
    {
        return ['address', 'description'];
    }

    public function includes(): array
    {
        return ['category', 'service', 'user', 'media'];
    }
}
