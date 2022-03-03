<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\ModelOfPhone;
use Illuminate\Http\Request;
use App\Http\Requests\BrandStoreRequest;
class BrandController extends Controller
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
    public function add_brand(Request $request)
    {
        $method = $request->method();
        if ($method=='POST')
        {
            return $this->store();
        }
        else if($method=='GET')
        {
            return $this->create();
        }
    }
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandStoreRequest $request)
    {
        $validated = $request->validated();
        // $brand = new Brand();
        // $brand->name = $request->txtBrandName;
        // $brand->save();
        // return back()->with('message','Add brand name successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
        return view('admin.brands.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit_brand($id,Request $request)
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
        $brand = Brand::find($id);
        return view('admin.brands.create',['brand'=>$brand,'check'=>'1']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $this->validate($request,
        [
            'txtBrandName'              =>      'required|min:3|max:100|unique:brands,name,'.$request->id,
        ],
        [
            'txtBrandName.required'     =>      'You must enter the brand name',
            'txtBrandName.min'          =>      'Brand name must be between 3 and 100 characters',
            'txtBrandName.max'          =>      'Brand name must be between 3 and 100 characters',
            'txtBrandName.unique'       =>      'This name already exists',
        ]
        );
        $brand = Brand::find($request->id);
        $brand->name = $request->txtBrandName;
        $brand->save();
        return back()->with(array('brand'=>$brand,'check'=>'1','message'=>'Update brand successfull'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list_model = ModelOfPhone::where('id_brand',$id)->get();
        if(count($list_model)>0)
        {
            return back()->with('error','You can not delete this brand');
        }
        else
        {
            Brand::destroy($id);
            return back()->with('message','Delete brand sucessfull');
        }
        
    }
}
