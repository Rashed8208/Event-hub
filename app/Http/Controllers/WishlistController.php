<?php

namespace App\Http\Controllers;

use App\Models\wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $data=wishlist::get();
        return view('wishlist.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('wishlist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Wishlist::create($request->all());
      return redirect()->route('wishlist.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(wishlist $wishlist)
    {
        return view('wishlist.edit',compact('wishlist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, wishlist $wishlist)
    {
          $wishlist->update($request->all());
      return redirect()->route('wishlist.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(wishlist $wishlist)
    {
        $wishlist->delete();
      return redirect()->route('wishlist.index');
    }
}
