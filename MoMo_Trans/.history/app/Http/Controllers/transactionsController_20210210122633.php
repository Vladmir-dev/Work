<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bmatovu\MtnMomo\Products\Collection;

class transactionsController extends Controller
{


    public function paymomo(Request $request) {
        $momo_number = $request->input('momo_number');
        $momo_amount = $request->input('momo_amount');

        $momo_checkout_pay = json_encode(
                [
                    $momo_number,
                    $momo_amount
                ]
            );
        
        $collection = new Collection();
        $momoTransactionId = $collection->requestToPay('20200210001', '46733123453', $momo_amount);

        $responseMsg = $collection->getTransactionStatus($momoTransactionId);

        dd($responseMsg);

        $token_status = $responseMsg['status'];
        $token

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
