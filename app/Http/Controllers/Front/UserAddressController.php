<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\UserAddress;
use App\Http\Requests\UserAddressRequest;
class UserAddressController extends Controller
{
    private $field = [
      'city',
      'district',
      'address',
      'zip_code',
      'contact_name',
      'contact_phone'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('Front.user_addresses.index',[
           'addresses' => $request->user()->addresses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Front.user_addresses.create_and_edit',[
            'address' => new UserAddress()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAddressRequest $request)
    {
        $request->user()->addresses()->create($request->only($this->field));

        return redirect()->route('user_addresses.index')
              ->with('alert', __('crud.success.create'));
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
        $user_address = UserAddress::find($id);
        $this->authorize('own', $user_address);

        return view('Front.user_addresses.create_and_edit', [
           'address' => $user_address
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserAddressRequest $request, $id)
    {
        $user_address = UserAddress::find($id);
        $this->authorize('own', $user_address);
        $user_address->update($request->only($this->field));
        return redirect()->route('user_addresses.index')
              ->with('alerts', __('crud.success.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_address = UserAddress::find($id);
        $this->authorize('own', $user_address);
        $user_address->delete();
        return redirect()->route('user_addresses.index')->with('alerts', __('crud.success.delete'));    }
}
