<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Sub_category;
use App\User;
use App\Variation_type;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::selectRaw('products.*,categories.category_name,sub_categories.sub_cat_name,users.name')
                        ->join('categories','categories.category_id','=','products.product_cat_id')
                        ->join('sub_categories','sub_categories.sub_id','=','products.product_sub_id')
                        ->join('users','users.id','=','products.product_user_id')->get()->toArray();


                        foreach ($data as $key => $value) {

                            $v_name = array();
                            $all_id = explode(',', $value['product_variation_id']);
                            foreach ($all_id as $k => $v) {
                                $demo = Variation_type::selectRaw('variation_types.*,variations.variation_name')
                                ->join('variations','variation_types.variation_id','=','variations.variation_id')
                                ->find($v)->toArray();

                                $v_name[$demo['variation_name']][] = $demo;
                                
                            }


                            $data[$key]['v_name'] = $v_name;

                        }
                            //     echo "<pre>";
                            //     print_r($v_name);
                            // die;
                        // echo "<pre>";
                        // print_r($data);
                        // die;


        
        return view('product.index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $udata = User::all();
        $cdata = Category::all();
        $sdata = Sub_category::all();
        $data =  Variation_type::selectRaw('variation_types.*,variations.variation_name')
                ->join('variations','variations.variation_id','=','variation_types.variation_id')
                ->get();
        $vdata = array();
        foreach ($data as $key => $value)
        {
            $vdata[$value->variation_name][] = $value->toArray();
        }
        return view('product.create',['udata' => $udata,'cdata' => $cdata,'sdata' => $sdata,'vdata' => $vdata]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj = new Product();
        unset($request['_token']);
        $request['product_variation_id'] = implode(',',$request->product_variation_id);
        foreach ($request->toArray() as $key => $value)
        {
            $obj->$key = $value;
        }
        $obj->save();
        return redirect('/product');
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
        $cdata = Category::all();
        $sdata = Sub_category::all();
        $udata = User::all();
        $pdata = Product::find($id);
        $data =  Variation_type::selectRaw('variation_types.*,variations.variation_name')
                ->join('variations','variations.variation_id','=','variation_types.variation_id')
                ->get();
        $vdata = array();
        foreach ($data as $key => $value)
        {
            $vdata[$value['variation_name']][] = $value->toArray();
        }
        return view('product.edit',['cdata' => $cdata,'sdata' => $sdata, 'udata' => $udata, 'pdata' => $pdata,'vdata' => $vdata]);
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
        $obj = Product::find($id);
        unset($request['_token']);
        unset($request['_method']);
        $request['product_variation_id'] = implode(',',$request->product_variation_id);
        foreach ($request->toArray() as $key => $value)
        {
            $obj->$key = $value;
        }
        $obj->save();

        return redirect('/product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('/product');
    }

    public function getsubcategory(Request $request)
    {
       $sdata =  Sub_category::where('sub_cat_id',$request->cat_id)->get();
            // echo "<pre>";
            // print_r($sdata->toArray());
            // die;
        echo '<option>------select subcategory---------</option>';
        foreach ($sdata as $key => $value) 
        {
           echo '<option value="'.$value['sub_id'].'">'.$value['sub_cat_name'].'</option>';
        }
    }
}

