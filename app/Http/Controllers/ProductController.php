<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Libraries\Codes\ResponseCodes;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try{

            $products = Product::all();

            return $this->sendResponse('All products', $products, true, ResponseCodes::SUCCESS);

        } catch (\Exception $e) {

            return $this->sendResponse($e->getMessage(), null, false, ResponseCodes::FAILED_RESULT);

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param StoreProduct $request
     * @param Product $product
     * @return string
     */
    public function store(StoreProduct $request, Product $product)
    {
        $data = $request->all();

        try {

            $result = $product->storeProduct($data);

            return $this->sendResponse('Product created', $result, true, ResponseCodes::CREATED);

        } catch (\Exception $e) {

            return $this->sendResponse($e->getMessage(), null, false, ResponseCodes::FAILED_RESULT);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        try{

            $product = Product::find($id);

            return $this->sendResponse('Product found', $product, true, ResponseCodes::SUCCESS);

        } catch (\Exception $e) {

            return $this->sendResponse($e->getMessage(), null, false, ResponseCodes::FAILED_RESULT);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id, Product $product)
    {
        $data = $request->all();

        try{
            $result = $product->updateProduct($id, $data);

            return $this->sendResponse('Product updated', $result, true, ResponseCodes::SUCCESS);

        } catch (\Exception $e) {

            return $this->sendResponse($e->getMessage(), null, false, ResponseCodes::FAILED_RESULT);

        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try{
            $product = Product::find($id);

            $product->delete();

            return $this->sendResponse('Product deleted', $product, true, ResponseCodes::SUCCESS);

        } catch (\Exception $e) {

            return $this->sendResponse($e->getMessage(), null, false, ResponseCodes::FAILED_RESULT);

        }
    }
}
