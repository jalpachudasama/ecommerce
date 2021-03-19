<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\User_image;
use App\State;
use App\City;
use Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::selectRaw('users.*,states.state_name,cities.city_name')->join('states','states.state_id','=','users.state_id')->join('cities','cities.city_id','=','users.city_id')->paginate(1);
        foreach ($data as $key => $value)
        {
            $idata = User_image::where('user_id',$value->id)->get()->toArray();
            $value->multiple = $idata;
        }
        $sdata = State::all();
        return view('admin.index',['data' => $data,'sdata' => $sdata]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sdata = State::all();
        $cdata = City::all();
        return view('admin.create',['sdata' => $sdata,'cdata' => $cdata]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

  /*    echo "<pre>";
      print_r($request->toArray());
      die;
*/

        $messages = [
          'name.required' => 'Fname filed is required....',
          'name.alpha' => 'Plz enter only alphabet..',
          'n_password.required' => 'Password filed is required...!',
          'state_id.not_in' => 'state filed is required..',

      ];
      $rules = [
            'name' => 'required|alpha',
            'n_password' => 'required',
            'gender' => 'required',
            'hobby' => 'required',
            'state_id' => 'required|not_in:-1'


        ];
        $validator = Validator::make($request->all(),$rules ,$messages);

         if ($validator->fails()) {
            return redirect('admin/create')
                        ->withErrors($validator)
                        ->withInput();
        }
        // $request->validate([
        //   'name' => 'required|alpha',
        //   'email'=> 'required|email|unique:users',
        //   'n_password' => 'required|regex:/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/'

        // ]);


        $obj = new User();
        $obj->name = $request->name;
        $obj->email = $request->email;
        $obj->password = Hash::make($request->n_password);
        $obj->gender = $request->gender;
        $obj->hobby = implode(',',$request->hobby);
        $obj->dob = $request->dob;
        $obj->state_id = $request->state_id;
        $obj->city_id = $request->city_id;
        $obj->address = $request->address;
        $img = "";
        if($request->hasFile('profile'))
        {
            $img = time()."_".$request->profile->getClientOriginalName();
            $request->profile->move(public_path('image'),$img);
        }
        $obj->profile = $img;
        $obj->save();
        if($request->hasFile('user'))
        {
            foreach ($request->user as $key => $value)
            {
                $user = new User_image();
                $user_img = time()."_".$value->getClientOriginalName();
                $value->move(public_path('user_image'),$user_img);
                $user->user_id = $obj->id;
                $user->user_image_name = $user_img;
                $user->save();
            }
        }
        return redirect('/admin')->with('msg','Inserted...');
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
        $sdata = State::all();
        $cdata = City::all();
        $data = User::find($id);
        $data->multiple = User_image::where('user_id',$id)->get()->toArray();

        return view('admin.edit',['data' => $data,'sdata' => $sdata, 'cdata' => $cdata]);
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

        $obj = User::find($id);
        $obj->name = $request->name;
        $obj->email = $request->email;
        $obj->gender = $request->gender;
        $obj->hobby = implode(',',$request->hobby);
        $obj->dob = $request->dob;
        $obj->state_id = $request->state_id;
        $obj->city_id = $request->city_id;
        $obj->address = $request->address;
        if ($request->hasFile('profile'))
        {
          if(!empty($obj->profile))
          {
            unlink(public_path("image/".$obj->profile));
          }
          $img = time()."_".$request->profile->getClientOriginalName();
          $request->profile->move(public_path("image"),$img);
          $obj->profile = $img;
        }

        if($request->hasFile('user'))
        {
            foreach ($request->user as $key => $value)
            {
                $img = time()."_".$value->getClientOriginalName();
                $value->move(public_path('user_image/'),$img);
                $iobj = new User_image();
                $iobj->user_id = $id;
                $iobj->user_image_name = $img;
                $iobj->save();
            }
        }

        if(!empty($request->choice))
        {
            foreach ($request->choice as $key => $value)
            {
                $idata = User_image::find($value);
                if($idata)
                {
                    unlink(public_path('user_image/'.$idata->user_image_name));
                    User_image::destroy($idata->user_image_id);
                }
            }
        }
        $obj->save();
        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::find($id);
        $img_data = User_image::all();
        foreach ($img_data as $key => $value)
        {
            if($value->user_id == $data->id)
            {
                unlink(public_path('user_image/'.$value->user_image_name));
            }
        }
        if (!empty($data->profile))
        {
           unlink(public_path("image/".$data->profile));
        }
        $data->delete();
        return redirect('/admin')->with('msg','Deleted...');
    }

    public function statedata(Request $request)
    {
        $data = City::where('city_state_id',$request->id)->get();

        return view('admin.state',['data' => $data]);
    }

    public function citydata(Request $request)
    {
        $sdata = State::all();
        $cdata = City::find($request->id);

        return view('admin.city',['cdata' => $cdata, 'sdata' => $sdata]);
    }

    public function searching(Request $request)
    {
        $data = User::selectRaw('users.*,states.state_name,cities.city_name')
        ->join('states','states.state_id','=','users.state_id')
        ->join('cities','cities.city_id','=','users.city_id')
        ->where('name','LIKE',"%$request->search_name%")
        ->where('email','LIKE',"%$request->search_name%")
        ->where('users.state_id',$request->search_state)
        ->paginate(1);
        foreach ($data as $key => $value)
        {
            $value->multiple = User_image::where('user_id',$value->id)->get();
        }

        $data->appends(['search_name' => $request->search_name,'search_state' => $request->search_state]);
        $sdata = State::all();
        return view('admin.index',['data' => $data,'sdata' => $sdata,'s_key' => $request]);
    }


    public function profile()
    {
      $id = Auth::user()->id;
      $all = User::find($id);
      return view('admin.profile',['all'=>$all]);
    }

    public function change_pass(Request $request)
    {
        $old_db =  Auth::user()->password;
        if(Hash::check($request->opass,$old_db))
        {
            if($request->opass != $request->npass)
            {
                if($request->npass == $request->cpass)
                {

                      $data = User::find(Auth::user()->id);
                      $data->password = Hash::make($request->cpass);
                      $data->save();

                      Session::flush();
                      Auth::logout();
                      return redirect('/');
                }
                else
                {
                    return back()->with('msg','Npass and Cpass not match');
                }
            }
            else
            {
                 return back()->with('msg','Opass and Npass are match');
            }
        }
        else
        {
            return back()->with('msg','Old password not match');
        }
    }
}
