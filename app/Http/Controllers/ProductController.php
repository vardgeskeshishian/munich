<?php

namespace App\Http\Controllers;

use App\Actions\ProductActions\Store;
use App\Actions\ProductActions\Update;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$this->authorize('viewAny', Product::class);
        $query = (new Product())->newQuery();

        $query = $this->applyFilters($query, $request);

        $pages = $query->with('category')
            ->paginate(config('pagination.per_page'))
            ->onEachSide(config('pagination.each_side'));

        return ProductResource::collection(
            $pages
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Store $action): JsonResponse
    {
        //$this->authorize('store', Product::class);
        try{

            $action->handle($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Some detailed success message',
            ]);
        }catch(\Exception $e){

            Log::error($e->getMessage());

            return response()->json([
               'status' => false,
               'message' => 'Some detailed error',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //$this->authorize('store', Product::class);

        return new ProductResource(
            $product->load('category')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product, Update $action): JsonResponse
    {
        //$this->authorize('store', Product::class);

        try{

            $action->handle($request->validated(), $product);

            return response()->json([
                'status' => true,
                'message' => 'Some detailed success message',
            ]);
        }catch(\Exception $e){

            Log::error($e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Some detailed error',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        //$this->authorize('destroy', Product::class);

        try{

            //can be soft delete
            $product->delete();

            return response()->json([
                'status' => true,
                'message' => 'Some detailed success message',
            ]);
        }catch(\Exception $e){

            Log::error($e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Some detailed error',
            ]);
        }
    }
}
