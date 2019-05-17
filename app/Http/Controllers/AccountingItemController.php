<?php

namespace App\Http\Controllers;

use App\Models\AccountingItem;
use Illuminate\Http\Request;

class AccountingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categoryList = AccountingItem::all();

        return view('popup.list')->with('categoryList', $categoryList);
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
     * @param  \App\Models\AccountingItem  $accountingItem
     * @return \Illuminate\Http\Response
     */
    public function show(AccountingItem $accountingItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountingItem  $accountingItem
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountingItem $accountingItem)
    {
          return view('popup.edit')->with('catagory', $accountingItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountingItem  $accountingItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccountingItem $accountingItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountingItem  $accountingItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id )
    {
        $accountItem = AccountingItem::findOrFail($id);
        $accountItem->delete();
        return back();
    }
}
