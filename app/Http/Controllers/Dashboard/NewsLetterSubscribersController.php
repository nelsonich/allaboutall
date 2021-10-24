<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsLetterSubscribersModelRequest;
use App\Models\NewsLetterSubscriber;
use Illuminate\Http\Request;

class NewsLetterSubscribersController extends Controller
{
    public function index()
    {
        return view('dashboard.news_letter_subscribers', [
            'subscribers' => NewsLetterSubscriber::paginate(15),
            'is_add' => isAdd('subscribers'),
            'is_edit' => isEdit('subscribers'),
            'is_delete' => isDelete('subscribers'),
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        NewsLetterSubscriber::destroy($id);

        return redirect()->back();
    }

    public function editUser(NewsLetterSubscribersModelRequest $request)
    {
        $id = $request->post('id');
        $name = $request->post('name');
        $email = $request->post('email');
        
        $data = NewsLetterSubscriber::find($id);
        $data->name = $name;
        $data->email = $email;
        $data->save();

        return back();
    }
}
