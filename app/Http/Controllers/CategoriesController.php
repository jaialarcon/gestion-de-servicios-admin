<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    protected $model = Category::class;

    protected $request = CategoryRequest::class;

    protected $relation = 'services';

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
