<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TripFormRequest;
use App\Http\Requests\JsonFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Trip;


class TripsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $user = Auth::user();
        $trips = $user->trips()->orderBy('id')->get();
        $adresses = $user->adresses()->orderBy('id')->get();
        $alerts = $request->session()->get('alerts');
        $json_command = $request->session()->get('json_command');
        return view("trips.index",compact('trips','alerts','adresses','json_command'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("trips.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TripFormRequest $request)
    {
        $user = Auth::user();
        $trip = new Trip();
        $trip->fill($request->all());
        $trip->user_id = $user->id;
        $trip->save();

        $request->session()->flash('alerts',[['style' => 'success', 'text' => 'Trip "'.$trip->id.'" included with success!']]);
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
        $trip = Trip::find($request->id);
        $this->usersAutenticator->owner($trip);
        $jsonExampleFull = json_encode($trip);
        $fillable = $trip->getFillable();
        $jsonExampleAttributes = [];
        foreach($fillable as $field){
            $jsonExampleAttributes[$field] = $trip->$field;
        }
        $jsonExampleAttributes = json_encode($jsonExampleAttributes);
        return view("trips.show", compact('trip','jsonExampleFull','jsonExampleAttributes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $trip = Trip::find($request->id);
        $this->usersAutenticator->owner($trip);
        return view("trips.create", compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TripFormRequest $request)
    {
        $trip = Trip::find($request->id);
        $this->usersAutenticator->owner($trip);
        $trip->fill($request->all());
        $trip->save();
        $request->session()->flash('alerts',[['style' => 'success', 'text' => 'Trip "'.$trip->id.'" edited with success!']]);
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
        $trip = Trip::find($request->id);
        if(isset($trip)){
            $this->usersAutenticator->owner($trip);
            Trip::destroy($request->id);
            $request->session()->flash('alerts',[['style' => 'info', 'text' => 'Trip deleted with success!']]);
        }
        return to_route('trips.index'); 
    }

    public function showJson()
    {
        $user = Auth::user();
        $trips = $user->trips()->orderBy('id')->get();
        $jsonList = null;
        if(count($trips) > 0){
            $jsonList = json_encode($trips);
        }
        return view("trips.json", compact('jsonList')); 
    }

    public function showExampleJson()
    {
        return view("trips.jsonexample"); 
    }

    public function executeJson(JsonFormRequest $request)
    {
        $jsonDecode = json_decode($request->json_command);
        if(json_last_error()){
            $request->session()->flash('alerts',[['style' => 'danger', 'text' => 'JSON code is invalid!']]);
            $request->session()->flash('json_command',$request->json_command);
            return redirect()->route('trips.index'); 
        } 

        $list_result = [];
        foreach($jsonDecode as $i => $jfield){
            $list_result[$i] = $jfield;
        }
        
        if(isset($list_result[0]) && isset($list_result[1])){
            $new_requests = [];
            foreach($list_result[1] as $i => $item){
                $new_requests[$i] = $item;
            }

            if($list_result[0] == "create-trip"){
                return redirect()->action(
                    [TripsController::class, 'store'], $new_requests
                );
            }
            if($list_result[0] == "delete-trip" && $new_requests["id"] > 0){
                return redirect()->action(
                    [TripsController::class, 'destroy'], $new_requests
                );
            }
        }

        $request->session()->flash('alerts', [
            ['style' => 'success', 'text' => 'JSON decode with success!'],
            ['style' => 'danger', 'text' => "Command is invalid! Try insert 'create-trip' or 'delete-trip' in the first position of JSON"]
        ]);
        $request->session()->flash('json_command',$request->json_command);
        return redirect()->route('trips.index');  
    }

    public function decodeJson()
    {
        $trip = Trip::find(1);
        $fillable = $trip->getFillable();
        $jsonExampleAttributes = [];
        foreach($fillable as $field){
            $jsonExampleAttributes[$field] = $trip->$field;
        }
        $teste = [
            "create-trip",
            $jsonExampleAttributes
        ];
        echo json_encode($teste); die();
    }
}
