<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Help;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;



class HelpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $helps = Help::with('createdBy')->get();
        return view('admin.management-help.index', compact('helps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $helps = Help::all();

        return view('admin.management-help.create', compact('helps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;

        $validator = Validator::make($request->all(), [
            'categories' => 'required',
            'title' => 'required',
            'content' => 'required',
            // 'created_by' => $user_id,


        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        Help::create([
            'categories'  => $request->categories,
            'title'   => $request->title,
            'content' => $request->content,
            'created_by' => $user_id,
        ]);

        toast('Help has been created', 'success');
        return redirect()->route('admin.help.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($help);

        $help = Help::FindorFail($id);

        return view('admin.management-help.edit', compact('help'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Help $help)
    {
        $user_id = auth()->user()->id;

        $validator = Validator::make($request->all(), [
            'categories' => 'required',
            'title' => 'required',
            'content' => 'required',
            // 'created_by' => $user_id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // $help = Help::find($id);
        $help->update([
            'categories'  => $request->categories,
            'title'   => $request->title,
            'content' => $request->content,
            'created_by' => $user_id,
        ]);



        toast('Help has been updated', 'success');
        return redirect()->route('admin.help.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     $help = Help::findOrFail($id);
    //     $help->delete();

    //     toast('Help has been deleted', 'success');
    //     return redirect()->back();
    // }

    public function destroy(string $id)
    {
        DB::table('helps')->where('id', $id)->delete();
        toast('Help has been deleted', 'success');
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Dihapus!'
        ]);
    }
}
