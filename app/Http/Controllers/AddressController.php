<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddress;
use App\Http\Requests\UpdateAddress;
use App\Libraries\Codes\ResponseCodes;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * @param Address $addressModel
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Address $addressModel)
    {
        try{

            $addresses = $addressModel->getAddresses();

            return $this->sendResponse('All addresses', $addresses, true, ResponseCodes::SUCCESS);

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
     * @param StoreAddress $request
     * @param Address $addressModel
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAddress $request, Address $addressModel)
    {
        $data = $request->all();

        try {

            $result = $addressModel->storeAddress($data);

            return $this->sendResponse('Address created', $result, true, ResponseCodes::CREATED);

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

            $address = Address::find($id);

            return $this->sendResponse('Address found', $address, true, ResponseCodes::SUCCESS);

        } catch (\Exception $e) {

            return $this->sendResponse($e->getMessage(), null, false, ResponseCodes::FAILED_RESULT);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAddress $request
     * @param int $id
     * @param Address $addressModel
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAddress $request, $id, Address $addressModel)
    {
        $data = $request->all();

        try{

            $address = $addressModel->updateAddress($id, $data);

            return $this->sendResponse('Address updated', $address, true, ResponseCodes::SUCCESS);

        } catch (\Exception $e) {

            return $this->sendResponse($e->getMessage(), null, false, ResponseCodes::FAILED_RESULT);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try{

            $address = Address::find($id);

            $address->delete();

            return $this->sendResponse('Address deleted', $address, true, ResponseCodes::SUCCESS);

        } catch (\Exception $e) {

            return $this->sendResponse($e->getMessage(), null, false, ResponseCodes::FAILED_RESULT);

        }
    }
}
