<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Http\Request;
use App\Models\Account;
use DB;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $transfers = Transfer::select('transfers.*', 
            'accounts.name as account')
            ->join('accounts', 'accounts.id', '=', 'transfers.root_account_id')
            ->paginate(10);
        return response()->json($transfers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'balance' => 'required',
            'root_account_id' => 'required',
            'destination_account_id' => 'required',
        ];
        
        $validator = \Validator::make($request->all(),$rules);
        
        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ],400);
        }
        $transfer = Transfer::create($request->all());
        
        return response()->json([
                'status' => true,
                'message' => 'Transfer created successfully',
                'data' => $transfer,
        ],200);

    }

    /**
     * Display the specified resource.
     */
    public function show(transfer $transfer)
    {
        //
        return response()->json([
            'status' => true,
            'data' => $transfer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, transfer $transfer)
    {
        //
        $rules = [
            'balance' => 'required',
            'root_account_id' => 'required',
            'destination_account_id' => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ],400);
        }
        $transfer->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Transfer updated successfully',
        ],200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transfer $transfer)
    {
        //
        $transfer->delete();
        return response()->json([
            'status' => true,
            'message' => 'Transfer deleted successfully',
        ],200);
    }
}
