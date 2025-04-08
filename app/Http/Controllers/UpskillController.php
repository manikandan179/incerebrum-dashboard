<?php
namespace App\Http\Controllers;
use App\Models\Upskill;

use Illuminate\Http\Request;

class UpskillController extends Controller
{
    public function index(Request $request)
    {
        $upskills = Upskill::all();
        return view('upskill.list', compact('upskills'));
    }
}
