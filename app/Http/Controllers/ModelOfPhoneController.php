<?php

namespace App\Http\Controllers;

use App\Models\ModelOfPhone;
use App\Models\Device;
use Illuminate\Http\Request;
use App\Models\Brand;
class ModelOfPhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_model(Request $request)
    {
        $method = $request->method();
        if ($method=='POST')
        {
            return $this->store($request);
        }
        else if($method=='GET')
        {
            return $this->create();
        }
    }
    public function create()
    {
        //
        return view('admin.models.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'txtModelName'          =>  'required|min:3|max:100|unique:model_of_phones,name',
            'id_brand'              =>  'required',
        ],
        [
            'txtModelName.required' =>  'You must enter the model name',
            'txtModelName.min'      =>  'Model name must be between 3 and 100 characters',
            'txtModelName.max'      =>  'Model name must be between 3 and 100 characters',
            'txtModelName.unique'   =>  'This name already exists',
            'id_brand.required'     =>  'You must choose the brand',
        ]
        );
        $model              = new ModelOfPhone();
        $model->name        = $request->txtModelName;
        $model->id_brand    = $request->id_brand;
        $model->save();
        return redirect()->route('add_model')->with('message','Add Model Successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModelOfPhone  $modelOfPhone
     * @return \Illuminate\Http\Response
     */
    public function show(ModelOfPhone $modelOfPhone)
    {
        //
        $models = ModelOfPhone::all();
        return view('admin.models.show',['list_model'=>$models]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModelOfPhone  $modelOfPhone
     * @return \Illuminate\Http\Response
     */
    public function edit_model(Request $request,$id)
    {
        $method = $request->method();
        if ($method=='POST')
        {
            return $this->update($request,$id);
        }
        else if($method=='GET')
        {
            return $this->edit($id);
        }
    }
    public function edit($id)
    {
        //
        $model = ModelOfPhone::find($id);
        return view('admin.models.create',['model'=>$model,'check'=>'1']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModelOfPhone  $modelOfPhone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,
        [
            'txtModelName'          =>  'required|min:3|max:100|unique:model_of_phones,name,'.$request->id,
            'id_brand'              =>  'required',
        ],
        [
            'txtModelName.required' =>  'You must enter the model name',
            'txtModelName.min'      =>  'Model name must be between 3 and 100 characters',
            'txtModelName.max'      =>  'Model name must be between 3 and 100 characters',
            'txtModelName.unique'   =>  'This name already exists',
            'id_brand.required'     =>  'You must choose the brand',
        ]
        );
        $model = ModelOfPhone::find($request->id);
        $model->id_brand = $request->id_brand;
        $model->name = $request->txtModelName;
        $model->save();
        return redirect('admin/models/edit_model/'.$request->id)->with(array('model'=>$model,'check'=>'1','message'=>'Update model successfull'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModelOfPhone  $modelOfPhone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $arr_device = Device::where('id_model',$id)->get();
        if(count($arr_device)>0)
        {
            return back()->with('error','You can not delete this model');
        }
        else
        {
            ModelOfPhone::destroy($id);
            return back()->with('message','Delete model successfull');
        }
        
    }
}
