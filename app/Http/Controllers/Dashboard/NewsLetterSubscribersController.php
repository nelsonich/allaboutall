<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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
}
