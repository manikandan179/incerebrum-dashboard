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

    // DataTables AJAX fetch
    public function getUpskills(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get('start') ?? 0;
        $length = $request->get('length') ?? 10;
        $search = $request->input('search.value');

        $query = Upskill::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
            });
        }

        $totalRecords = $query->count();

        $upskills = $query->orderBy('created_at', 'desc')
                            ->skip($start)
                            ->take($length)
                            ->get();

        $data = [];
        foreach ($upskills as $upskill) {
            $data[] = [
                'name'       => $upskill->name,
                'email'      => $upskill->email,
                'phone'      => $upskill->phone,
                'message'      => $upskill->message,
                'created_at' => $upskill->created_at->format('Y-m-d H:i:s'),
            ];
        }

        return response()->json([
            'draw'            => intval($draw),
            'recordsTotal'    => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data'            => $data,
        ]);
    }
}
