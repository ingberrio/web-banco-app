<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $accounts = Account::all(); 
        //return response()->json($accounts);      
        // $url = env('URL_SERVER_API', 'http://127.0.0.1');
        // $response = Http::get($url.'/accounts');
        // $accounts = $response->json();
        return view('livewire.account', compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $rules = [
            'name' => 'required|string|min:1|max:100',
            'identification' => 'required|numeric',
            'balance' => 'required',
        ];
        
        $validator = \Validator::make($request->all(),$rules);
        
        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ],400);
        }
        
        $account = Account::create($request->all());
        
        return response()->json([
                'status' => true,
                'message' => 'Account created successfully',
                'data' => $account,
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        //
        return response()->json([
            'status' => true,
            'data' => $account,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        //
        $rules = [
            'name' => 'required|string|min:1|max:100',
            'identification' => 'required|numeric',
            'balance' => 'required',
        ];
        
        $validator = \Validator::make($request->all(),$rules);
        
        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ],400);
        }

        $account->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Account updated successfully',
            'data' => $account,
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        //
        $account->delete();
        return response()->json([
            'status' => true,
            'message' => 'Account deleted successfully',
        ],200);
    }

}
