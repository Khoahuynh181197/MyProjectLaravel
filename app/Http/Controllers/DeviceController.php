<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Models\ModelOfPhone;
use App\Models\Brand;
class DeviceController extends Controller
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
    public function add_device(Request $request)
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
        return view('admin.devices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,
        [
            'id_brand'                  =>      'required',
            'id_model'                  =>      'required',
            'txtDeviceName'             =>      'required|max:100',
            'screen'                    =>      'required|min:3|max:100',
            'ram'                       =>      'required|min:3|max:100',
            'battery_capacity'          =>      'required|min:3|max:100',
            'cpu'                       =>      'required|min:3|max:100',
            'image_device'              =>      'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],
        [
            'id_brand.required'         =>  'You must choose Brand',
            'id_model.required'         =>  'You must choose Model',
            'txtDeviceName.required'    =>  'You must enter device name',
            'txtDeviceName.max'         =>  'Maximum device name is 100 characters',
            'screen.required'           =>  'You must enter information of screen',
            'screen.min'                =>  'Information of screen must between 3 and 100 characters',
            'screen.max'                =>  'Information of screen must between 3 and 100 characters',
            'ram.required'              =>  'You must enter information of ram',
            'ram.min'                   =>  'Information of ram must between 3 and 100 characters',
            'ram.max'                   =>  'Information of ram must between 3 and 100 characters',
            'battery_capacity.required' =>  'You must enter information of battery capacity',
            'battery_capacity.min'      =>  'Information of battery capacity must between 3 and 100 characters',
            'battery_capacity.max'      =>  'Information of battery capacity must between 3 and 100 characters',
            'cpu.required'              =>  'You must enter information of cpu',
            'cpu.min'                   =>  'Information of cpu must between 3 and 100 characters',
            'cpu.max'                   =>  'Information of cpu must between 3 and 100 characters',
            'image_device.required'     =>  'You must upload image of device',
            'image_device.image'        =>  'You must choose the correct image format',
            'image_device.mimes'        =>  'You must choose the correct image format',
            'image_device.max'          =>  'Maximum image size is 2048 Byte'
        ]
        );
        if($request->hasFile('image_device'))
        {
            $image_device = $request->file('image_device');
            $image_device->move(public_path('admin/upload/device'),$request->image_device->getClientOriginalName());
            $device = new Device();
            $device->id_model                   =   $request->id_model;
            $device->name                       =   $request->txtDeviceName;
            $device->screen                     =   $request->screen;
            $device->ram                        =   $request->ram;
            $device->battery_capacity           =   $request->battery_capacity;
            $device->cpu                        =   $request->cpu;
            $device->image                      =   $request->image_device->getClientOriginalName();
            $device->save();
            $message                            = 'Add device successfull';
            $error                              = '';
        }
        else
        {
            $message    =   '';
            $error      =   'Image not found';
        }
        return redirect()->route('add_device')->with(array('message'=>$message,'error'=>$error));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        //
        $devices = Device::all();
        return view('admin.devices.show',['list_device'=>$devices]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit_device(Request $request,$id)
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
        $device         =   Device::find($id);
        $model_list     =   ModelOfPhone::where('id_brand',$device->ModelOfPhone->id_brand)->get();
        return view('admin.devices.create',['check'=>'1','device'=>$device,'model_list'=>$model_list]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $this->validate($request,
        [
            'id_brand'                  =>      'required',
            'id_model'                  =>      'required',
            'txtDeviceName'             =>      'required|max:100',
            'screen'                    =>      'required|min:3|max:100',
            'ram'                       =>      'required|min:3|max:100',
            'battery_capacity'          =>      'required|min:3|max:100',
            'cpu'                       =>      'required|min:3|max:100',
            'image_device'              =>      'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],
        [
            'id_brand.required'         =>  'You must choose Brand',
            'id_model.required'         =>  'You must choose Model',
            'txtDeviceName.required'    =>  'You must enter device name',
            'txtDeviceName.max'         =>  'Maximum device name is 100 characters',
            'screen.required'           =>  'You must enter information of screen',
            'screen.min'                =>  'Information of screen must between 3 and 100 characters',
            'screen.max'                =>  'Information of screen must between 3 and 100 characters',
            'ram.required'              =>  'You must enter information of ram',
            'ram.min'                   =>  'Information of ram must between 3 and 100 characters',
            'ram.max'                   =>  'Information of ram must between 3 and 100 characters',
            'battery_capacity.required' =>  'You must enter information of battery capacity',
            'battery_capacity.min'      =>  'Information of battery capacity must between 3 and 100 characters',
            'battery_capacity.max'      =>  'Information of battery capacity must between 3 and 100 characters',
            'cpu.required'              =>  'You must enter information of cpu',
            'cpu.min'                   =>  'Information of cpu must between 3 and 100 characters',
            'cpu.max'                   =>  'Information of cpu must between 3 and 100 characters',
            'image_device.image'        =>  'You must choose the correct image format',
            'image_device.mimes'        =>  'You must choose the correct image format',
            'image_device.max'          =>  'Maximum image size is 2048 Byte'
        ]
        );
        $device                             =   Device::find($request->id);
        $device->id_model                   =   $request->id_model;
        $device->name                       =   $request->txtDeviceName;
        $device->screen                     =   $request->screen;
        $device->ram                        =   $request->ram;
        $device->battery_capacity           =   $request->battery_capacity;
        $device->cpu                        =   $request->cpu;
        if($request->hasFile('image_device'))
        {
            $image_device = $request->file('image_device');
            $image_device->move(public_path('admin/upload/device'),$request->image_device->getClientOriginalName());
            $device->image                      =   $request->image_device->getClientOriginalName();
        }
        $device->save();
        $message                            =   'Update device successfull';
        $error                              =   '';
        $device                             =   Device::find($request->id);
        $model_list                         =   ModelOfPhone::where('id_brand',$device->ModelOfPhone->id_brand)->get();
        return redirect('admin/devices/edit_device/'.$request->id)->with(array('message'=>$message,'error'=>$error,'check'=>'1','device'=>$device,'model_list'=>$model_list));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Device::destroy($id);
        return back()->with('message','Delete device successfull');
    }
}
