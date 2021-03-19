<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Sub_category;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sub_category::selectRaw('sub_categories.*,categories.category_name')->join('categories','sub_categories.sub_cat_id','=','categories.category_id')->get();

        return view('subcategory.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Category::all();
        return view('subcategory.create',['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj = new Sub_category();
        $obj->sub_cat_id = $request->sub_cat_id;
        $obj->sub_cat_name = $request->sub_cat_name;
        $obj->save();

        return redirect('/subcategory');
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
        $data = Sub_category::find($id);
        $cdata = Category::all();

        return view('subcategory.edit',['data' => $data,'cdata' => $cdata]);
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
        $obj = Sub_category::find($id);
        $obj->sub_cat_id = $request->sub_cat_id;
        $obj->sub_cat_name = $request->sub_cat_name;
        $obj->save();

        return redirect('/subcategory');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sub_category::destroy($id);

        return redirect('/subcategory');
    }
}
