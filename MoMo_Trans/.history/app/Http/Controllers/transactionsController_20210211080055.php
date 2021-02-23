<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bmatovu\MtnMomo\Products\Collection;

class transactionsController extends Controller
{


    public function paymomo(Request $request) {
        $momo_number = $request->post('momo_number');
        $momo_amount = $request->post('momo_amount');
        $momo_amount_speech = $request->post('amount');

        $momo_checkout_pay = json_encode(
                [
                    $momo_number,
                    $momo_amount
                ]
            );
        
        $collection = new Collection();
        $momoTransactionId = $collection->requestToPay('20200210001', '46733123453', $momo_amount);

        $responseMsg = $collection->getTransactionStatus($momoTransactionId);

        // dd($responseMsg);

        $token_status = $responseMsg['status'];
        $token_payer_array = $responseMsg['payer'];
        $taken_payer_id = $token_payer_array['partyId'];
        $token_amount = $responseMsg['amount'];


        // $m_test = $collection->getAccountBalance();
        // dd($m_test);
        
        return response()->json(compact('files'));


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
