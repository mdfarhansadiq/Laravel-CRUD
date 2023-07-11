<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\HomeModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomAuthModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function homeFunction()
    {
        return view('home.home');
    }

    public function customRegistrationView()
    {
        return view('customauth.registration');
    }

    public function customRegistrationCreate(Request $req)
    {
        // $req->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:custom_auth_users',
        //     'pass' => 'required|min:6',
        // ]);

        $data = new CustomAuthModel();
        $data->name = $req->name;
        $data->email = $req->email;
        $data->pass = Crypt::encrypt($req->pass);

        $data->save();

        // Session::put('useremail', $req->email);
        // Session::put('userpass', $req->pass);
        // Session::put('userid', $data->id);

        return redirect('/registration');
    }

    public function customLoginView()
    {
        return view('customauth.login');
    }

    public function customLoginCreate(Request $req)
    {
        $user = CustomAuthModel::where('email', $req->email)->first();
        //dd($user);
        if ($user && $req->pass == Crypt::decrypt($user->pass)) {

            Session::put('useremail', $req->email);
            Session::put('userpass', $req->pass);
            Session::put('userid', $user->id);

            return redirect('/home-data');
        } else {

            return redirect('/login');
        }
    }

    public function customLogout(Request $req)
    {
        if (Session::has('useremail') && Session::has('userpass')) {

            Session::flush();

            return redirect('/login');
        }
    }

    public function homeFunctionCreate(Request $req)
    {
        $homeInfo = new HomeModel();
        $homeInfo->user_name = $req->user_name;
        $homeInfo->user_email = $req->user_email;

        $homeInfo->user_subject = $req->user_subject;

        $path = '';
        if ($req->hasFile('user_photo')) {
            $file = $req->file('user_photo');
            $filename = $file->getClientOriginalName();
            $folder = $homeInfo->user_name;
            $path = $req->file('user_photo')->storeAs($folder, $filename, 'public');
        }
        $homeInfo->user_photo = '/storage/' . $path;
        $homeInfo->user_message = $req->user_message;

        $homeInfo->save();

        return redirect('/');
    }

    public function homeFunctionAllData()
    {

        $userId = Session::get('userid');

        if ($userId == 1) {
            $homeInfoAll = HomeModel::all();
            return view('home.allhomedata', compact('homeInfoAll'));
        }
        else
        {
            return view('');
        }

    }

    public function homeFunctionEdit($id)
    {
        $homeInfoData = HomeModel::findOrFail($id);

        return view('home.homedataedit', compact('homeInfoData'));
    }

    public function homeFunctionUpdate(Request $req, $id)
    {
        $homeInfoData = HomeModel::findOrFail($id);

        $homeInfoData->user_name = $req->user_name;
        $homeInfoData->user_email = $req->user_email;
        $homeInfoData->user_subject = $req->user_subject;
        $homeInfoData->user_message = $req->user_message;

        $homeInfoData->save();

        return redirect('/home-data');
    }

    public function homeFunctionDelete($id)
    {
        $homeInfoData = HomeModel::findOrFail($id);

        $homeInfoData->delete();

        return redirect('/home-data');
    }
}
