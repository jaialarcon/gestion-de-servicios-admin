<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class ServicesController extends Controller
{
    protected $model = Service::class;

    protected $request = ServiceRequest::class;

    /**
     * The attributes that are used for searching.
     *
     * @return array
     */
    public function searchableBy(): array
    {
        return ['name'];
    }

    protected function afterStore(Request $request, $model)
    {
        $path = $request->image->store('services');
        $model->image = $path;
        $model->save();
    }

    protected function afterUpdate(Request $request, $model)
    {
        $path = $request->image->store('services');
        $model->image = $path;
        $model->save();
    }
}
