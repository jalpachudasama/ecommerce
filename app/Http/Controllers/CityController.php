<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\State;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = City::selectRaw('cities.*,states.state_name')->join('states','states.state_id','=','cities.city_state_id')->paginate(2);

        $sdata = State::all();
        return view('city.index',['data' => $data,'sdata' => $sdata]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = State::all();
        return view('city.create',['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj = new City();
        $obj->city_state_id = $request->city_state_id;
        $obj->city_name = $request->city_name;
        $obj->save();

        return redirect('/city');
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
        $cdata = City::find($id);
        $sdata = State::all();

        return view('city.edit',['cdata' => $cdata,'sdata' => $sdata]);
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
        $obj = City::find($id);
        $obj->city_state_id = $request->city_state_id;
        $obj->city_name = $request->city_name;
        $obj->save();

        return redirect('/city');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        City::destroy($id);
        return redirect('/city');
    }

    public function searching(Request $request)
    {
        $data = City::selectRaw('cities.*,states.state_name')
                ->join('states','states.state_id','=','cities.city_state_id')
                ->where('city_name','LIKE',"%$request->search_city%")
                ->where('state_id',$request->search_state)
                ->paginate(2);

        $data->appends(['search_city' => $request->search_city,'search_state' => $request->search_state]);
        // echo "<pre>";
        // print_r($data->toArray());
        // die;
        $sdata = State::all();

        return view('city.index',['data' => $data,'sdata' => $sdata, 's_key' => $request]);
    }
}
