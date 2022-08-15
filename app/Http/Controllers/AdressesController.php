<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressFormRequest;
use App\Http\Requests\JsonFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Address;


class AdressesController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("adresses.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressFormRequest $request)
    {
        $user = Auth::user();
        $address = new Address();
        $address->fill($request->all());
        $address->user_id = $user->id;
        $address->save();

        $request->session()->flash('alerts',[['style' => 'success', 'text' => 'Address "'.$address->name.'" included with success!']]);
        return redirect()->route('trips.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $address = Address::find($request->id);
        $this->usersAutenticator->owner($address); // verify if the user is owner of product
        $jsonExampleFull = json_encode($address);
        $fillable = $address->getFillable();
        $jsonExampleAttributes = [];
        foreach($fillable as $field){
            $jsonExampleAttributes[$field] = $address->$field;
        }
        $jsonExampleAttributes = json_encode($jsonExampleAttributes);
        return view("adresses.show", compact('address','jsonExampleFull','jsonExampleAttributes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $address = Address::find($request->id);
        $this->usersAutenticator->owner($address);
        return view("adresses.create", compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressFormRequest $request)
    {
        $address = Address::find($request->id);
        $this->usersAutenticator->owner($address);
        $address->fill($request->all());
        $address->save();
        $request->session()->flash('alerts',[['style' => 'success', 'text' => '"'.$address->name.'" edited with success!']]);
        return redirect()->route('trips.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $address = Address::find($request->id);
        $this->usersAutenticator->owner($address);
        Address::destroy($request->id);
        $request->session()->flash('alerts',[['style' => 'info', 'text' => 'Address deleted with success!']]);
        return to_route('trips.index'); 
    }

    public function showJson(Request $request)
    {
        $user = Auth::user();
        $adresses = $user->adresses()->orderBy('id')->get();
        $jsonList = null;
        if(count($adresses) > 0){
            $jsonList = json_encode($adresses);
        }
        return view("adresses.json", compact('jsonList')); 
    }
}
