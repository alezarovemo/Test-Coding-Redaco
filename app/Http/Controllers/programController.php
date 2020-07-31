<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use Illuminate\Support\Facades\DB;
use Storage;

class programController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = DB::table('programs')
                ->where('user_id', auth()->user()->id)
                ->orderBy('id', 'desc')
                ->get();
        return view('gallery')->with([
            'programs' => $programs
        ]);
    }

    public function beranda()
    {
        $programs = DB::table('programs')->get();
        return view('beranda')->with([
            'programs' => $programs
        ]);
    }

    public function chart()
    {
        $programs = DB::table('programs')->get();
        return view('chart')->with([
            'programs' => $programs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        
        return view ('create-program');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $file = $request->file('audio');
        $name = $file->getClientOriginalName();

        Program::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'title' => $request->title,
            'photo' => $request->file('photo')->store('images'),
            'audio' => $request->file('audio')->storeAs('audio', $name),
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end
        ]);
        
        return redirect()->route('program.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Program::findOrFail($id);

        return view('edit-detail-user')->with([
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $item = Program::findOrFail($id);
        $item->delete();

        return redirect()->route('program.index');
    }

}
