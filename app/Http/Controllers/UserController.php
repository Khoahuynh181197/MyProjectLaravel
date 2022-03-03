<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
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
    public function add_user(Request $request)
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
        return view('admin.users.create');
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
            'txtUsername'               =>      'required|min:3|max:100',
            'txtAddress'                =>      'required|min:3|max:100',
            'txtPhone'                  =>      'required',
            'txtEmail'                  =>      'required|min:3|max:100|email|unique:users,email,'.$request->id,
            'txtPassword'               =>      'required|min:3|max:100',
            'day'                       =>      'required',
            'month'                     =>      'required',
            'year'                      =>      'required',
            'rdoLevel'                  =>      'required',
        ],
        [
            'txtUsername.required'      =>      'Please enter username',
            'txtUsername.min'           =>      'Username must between 3 and 100 characters',
            'txtUsername.max'           =>      'Username must between 3 and 100 characters',
            'txtAddress.required'       =>      'Please enter address',
            'txtAddress.min'            =>      'Address must between 3 and 100 characters',
            'txtAddress.max'            =>      'Address must between 3 and 100 characters',
            'txtPhone.required'         =>      'Please enter phone',
            'txtEmail.required'         =>      'Please enter email',
            'txtEmail.min'              =>      'E-Mail must between 3 and 100 characters',
            'txtEmail.max'              =>      'E-Mail must between 3 and 100 characters',
            'txtEmail.email'            =>      'Please enter correct email format',
            'txtEmail.unique'           =>      'This E-Mail has already exists',
            'txtPassword.required'      =>      'Please enter password',
            'txtPassword.min'           =>      'Password must between 3 and 100 characters',
            'txtPassword.max'           =>      'Password must between 3 and 100 characters',
            'day.required'              =>      'Please choose day',
            'month.required'            =>      'Please choose month',
            'year.required'             =>      'Please choose year',
            'rdoLevel.required'         =>      'Please choose level',
        ]);
        $user = new User();
        $user->name         =   $request->txtUsername;
        $user->birthday     =   $request->year.'-'.$request->month.'-'.$request->day;
        $user->address      =   $request->txtAddress;
        $user->phone        =   $request->txtPhone;
        $user->email        =   $request->txtEmail;
        $user->password     =   bcrypt($request->txtPassword);
        $user->level        =   $request->rdoLevel;
        $user->save();
        return redirect()->route('add_user')->with('message','Add user sucessfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $users = User::all();
        return view('admin.users.show',['list_user'=>$users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_user($id,Request $request)
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
        $user = User::findOrFail($id);
        return view('admin.users.create',['user'=>$user,'check'=>'1']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //
        $this->validate($request,
        [
            'txtUsername'               =>      'required|min:3|max:100',
            'txtAddress'                =>      'required|min:3|max:100',
            'txtPhone'                  =>      'required',
            'txtEmail'                  =>      'required|min:3|max:100|email|unique:users,email,'.$request->id,
            'day'                       =>      'required',
            'month'                     =>      'required',
            'year'                      =>      'required',
            'rdoLevel'                  =>      'required',
        ],
        [
            'txtUsername.required'      =>      'Please enter username',
            'txtUsername.min'           =>      'Username must between 3 and 100 characters',
            'txtUsername.max'           =>      'Username must between 3 and 100 characters',
            'txtAddress.required'       =>      'Please enter address',
            'txtAddress.min'            =>      'Address must between 3 and 100 characters',
            'txtAddress.max'            =>      'Address must between 3 and 100 characters',
            'txtPhone.required'         =>      'Please enter phone',
            'txtEmail.required'         =>      'Please enter email',
            'txtEmail.min'              =>      'E-Mail must between 3 and 100 characters',
            'txtEmail.max'              =>      'E-Mail must between 3 and 100 characters',
            'txtEmail.email'            =>      'Please enter correct email format',
            'txtEmail.unique'           =>      'This E-Mail has already exists',
            'day.required'              =>      'Please choose day',
            'month.required'            =>      'Please choose month',
            'year.required'             =>      'Please choose year',
            'rdoLevel.required'         =>      'Please choose level',
        ]);
        $user = User::find($request->id);
        $user->name         =   $request->txtUsername;
        $user->birthday     =   $request->year.'-'.$request->month.'-'.$request->day;
        $user->address      =   $request->txtAddress;
        $user->phone        =   $request->txtPhone;
        $user->email        =   $request->txtEmail;
        $user->level        =   $request->rdoLevel;
        $user->save();
        return redirect('admin/users/edit_user/'.$request->id)->with(array('message'=>'Update user sucessfull','user'=>$user,'check'=>'1'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        User::destroy($id);
        return back()->with('message','Delete user successfull');
    }
    public function register(Request $request)
    {
        $this->validate($request,
        [
            'txtName'                   =>      'required|min:3|max:100',
            'txtAddress'                =>      'required|min:3|max:100',
            'txtPhone'                  =>      'required|digits:9,11',
            'txtEmail'                  =>      'required|min:3|max:100|email|unique:users,email,$this->id,id',
            'txtPassword'               =>      'required|min:3|max:100',
            'txtRepassword'             =>      'required|min:3|max:100|same:txtPassword',
            'day'                       =>      'required',
            'month'                     =>      'required',
            'year'                      =>      'required',
        ],
        [
            'txtName.required'          =>      'You must enter Username',
            'txtName.min'               =>      'Username must between 3 and 100 characters',
            'txtName.max'               =>      'Username must between 3 and 100 characters',
            'txtAddress.required'       =>      'You must enter Address',
            'txtAddress.min'            =>      'Address must between 3 and 100 characters',
            'txtAddress.max'            =>      'Address must between 3 and 100 characters',
            'txtPhone.required'         =>      'You must enter Phone',
            'txtPhone.digits'           =>      'Phone must be number and has from 9 to 11 numbers',
            'txtEmail.required'         =>      'You must enter Email',
            'txtEmail.min'              =>      'Email must between 3 and 100 characters',
            'txtEmail.max'              =>      'Email must between 3 and 100 characters',
            'txtEmail.email'            =>      'You must enter correct email format',
            'txtEmail.unique'           =>      'This E-Mail has already exists',
            'txtPassword.required'      =>      'You must enter Password',
            'txtPassword.min'           =>      'Password must between 3 and 100 characters',
            'txtPassword.max'           =>      'Password must between 3 and 100 characters',
            'txtRepassword.required'    =>      'You must enter Repassword',
            'txtRepassword.min'         =>      'Re-password must between 3 and 100 characters',
            'txtRepassword.max'         =>      'Re-password must between 3 and 100 characters',
            'txtRepassword.same'        =>      'Re-password must be same as password',
            'day.required'              =>      'You must choose day',
            'month.required'            =>      'You must choose month',
            'year.required'             =>      'You must choose year',
        ]);
        $user = new User();
        $user->name         =   $request->txtName;
        $user->birthday     =   $request->year.'-'.$request->month.'-'.$request->day;
        $user->address      =   $request->txtAddress;
        $user->phone        =   $request->txtPhone;
        $user->email        =   $request->txtEmail;
        $user->password     =   bcrypt($request->txtPassword);
        $user->level        =   '0';
        $user->save();
        return redirect()->route('register_form')->with('message','Register successfull');
    }
    public function change_password(Request $request)
    {
        $this->validate($request,
        [
            'current_password'              =>      'required|min:3|max:100',
            'new_password'                  =>      'required|min:3|max:100',
            'renew_password'                =>      'required|min:3|max:100|same:new_password',      
        ],
        [
            'current_password.required'     =>      'You must enter current password',
            'current_password.min'          =>      'Current password must between 3 and 100 character',
            'current_password.max'          =>      'Current password must between 3 and 100 character',
            'new_password.required'         =>      'You must enter new password',
            'new_password.min'              =>      'New password must between 3 and 100 character',
            'new_password.max'              =>      'New password must between 3 and 100 character',
            'renew_password.required'       =>      'You must enter confirm new password',
            'renew_password.min'            =>      'Confirm new password must between 3 and 100 character',
            'renew_password.max'            =>      'Confirm new password must between 3 and 100 character',
            'renew_password.same'           =>      'Confirm your re-new password same as your new password',
        ]);
        if(Hash::check($request->current_password,Auth::user()->password))
        {
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            return redirect()->route('change_password')->with('message','Change password successfull');
        }
        else
        {
            return redirect()->route('change_password')->with('error','Your current password is wrong');
        }
    }
    public function change_profile_user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if($request->txtName==""&&$request->txtAddress==""&&$request->txtPhone==""&&$request->day==""&&$request->month==""&&$request->year=="")
        {
            return redirect()->route('user_profile')->with('message','You must enter information of user, if you need to change');
        }
        else
        {
            if($request->txtName!="")
            {
                $user->name = $request->txtName;
            }
            if($request->txtAddress!="")
            {
                $user->address = $request->txtAddress;
            }
            if($request->txtPhone!="")
            {
                $user->phone = $request->txtPhone;
            }
            if($request->day!=""&&$request->month!=""&&$request->year!="")
            {
                $user->birthday = $request->year.'-'.$request->month.'-'.$request->day;
            }
        }
        $user->save();
        return redirect()->route('user_profile')->with('message_success','Change Information Successfull');
    }
    public function create_user_profile()
    {
        return view('admin.pages.user_profile');
    }
    public function create_change_password()
    {
        return view('admin.pages.change_password');
    }
}
