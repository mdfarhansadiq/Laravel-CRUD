<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\HomeModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function homeFunction()
    {
        return view('home.home');
    }

    public function homeFunctionCreate(Request $req)
    {
        $homeInfo = new HomeModel();
        $homeInfo->user_name = $req->user_name;
        $homeInfo->user_email = $req->user_email;
        $homeInfo->user_subject = $req->user_subject;
        $homeInfo->user_message = $req->user_message;

        $homeInfo->save();

        return redirect('/');
    }

    public function homeFunctionAllData()
    {
        $homeInfoAll = HomeModel::all();

        return view('home.allhomedata', compact('homeInfoAll'));
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
