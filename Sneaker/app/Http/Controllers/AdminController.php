<?php

namespace App\Http\Controllers;

session_start();


use Illuminate\Http\Request;
use App\Users;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    private $user;

    public function __construct(Users $user)
    {
        $this->user = $user;
    }

    public function login(){
        unset($_SESSION['user']);
        return view('loginAdmin');
    }

    public function loginAdmin(){

        $email = request('email');

        $password = request('password');

        $user = Users::where('email', $email)->get();

        if ($user->isEmpty()){
            return view('loginAdmin', ['errorEmail' => '* Vui Lòng Kiểm Tra Lại Email!']);
        }else{
            if (Hash::check($password, $user[0]['password'])){
                if ($user[0]['status'] == '1'){
                    $_SESSION['user'] = $user[0]['fullname'];
                    return redirect('/admin');
                }else{
                    return view('loginAdmin', ['errorStatus' => 'Bạn Không Có Quyền Truy Cập']);
                }

            }else{
                return view('loginAdmin', ['errorPassword' => '* Vui Lòng Kiểm Tra Lại Password', 'email' => $email]);
            }
        }


    }

    public function indexAdmin(){
        return view('indexAdmin');
    }


    public function users(){

        $users = Users::all();

        return view('usersAdmin', ['users' => $users]);
    }

    // Create User
    public function handlingUser(){

        $user = new Users();

        $user->fullname = request('fullname');

        $user->email = request('email');

        $password = bcrypt(request('password'));
        $user->password = $password;

        $user->status = request('status');

        $user->save();
        
        return redirect('/admin/users')->with('mssg', 'Bạn Đã Tạo Mới User Thành Công!');
    }

    public function viewCreateUser(){

        return view('createUser');
    }
    // Create User



    // Update User
    public function viewUpdateUser($id){

        $user = Users::where('id', $id)->get();

        return view('updateUser', ['user' => $user]);
    }

    public function updateUser($id){

        $user = Users::findOrFail($id);

        $user->fullname = request('fullname');

        $user->email = request('email');

        $password = bcrypt(request('password'));

        $user->password = $password;

        $user->status = request('status');

        $user->save();

        return redirect('/admin/users')->with('update', 'Bạn Đã Chỉnh Sửa Thành Công!');
    }
    // Update User

    // Delete User
    public function destroy(Request $request){
        if($request->ajax()) {
            // dd($request->all());
            $id = $request->get('id');
            $this->user->find($id)->delete();

            //Bắt đầu render
            $users = $this->user->all();
            $viewUsersData = view('ajax.users-data', compact('users'))->render();
            return response()->json(['viewUsersData' => $viewUsersData, 'code' => 200], 200);
        }
    }
    // Delete User

}
