<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Variation;
use App\Variation_type;

class VariationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Variation_type::selectRaw('variation_types.*,variations.variation_name')->join('variations','variations.variation_id','=','variation_types.variation_id')->get()->toArray();
        // echo "<pre>";
        // print_r($data);
        // die;
        return view('variationtype.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Variation::all();

        return view('variationtype.create',['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        foreach ($request->variation_type_name as $key => $value)
        {
            $obj = new Variation_type();
            $obj->variation_id = $request->variation_id;
            $obj->variation_type_name = $value;
            $obj->save();
        }

        return redirect('/variationtype');
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
        $data = Variation_type::find($id);
        $vdata = Variation::all();
       //  echo "<pre>";
       // print_r($data->toArray());
       // die;
        return view('variationtype.edit',['data' => $data,'vdata' => $vdata]);
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
        // print_r($request->toArray());
        // die;
        // foreach ($request->variation_type_name as $key => $value)
        // {
        //     if(empty($key))
        //     {
        //         unset($key);;
        //     }
        // }
        $variation_type_name = implode(',',$request->variation_type_name);
        $obj = Variation_type::find($id);
        $obj->variation_id = $request->variation_id;
        $obj->variation_type_name = $variation_type_name;
        $obj->save();

        return redirect('/variationtype');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Variation_type::destroy($id);

        return redirect('/variationtype');
    }

    public function adddiv(Request $request)
    {
        $num = $request->number;
        return view('variationtype.jsmethod',['num' => $num]);
    }
}
