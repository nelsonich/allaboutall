<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;

class UsersImportExportController extends Controller
{
    public function exportAsExcel()
    {
        $users = User::where('id', '!=', auth()->id())->with('role')->get();

        return Excel::download(new UserExport($users), 'users.xlsx');
        
    }
}
