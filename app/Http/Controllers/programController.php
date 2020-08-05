<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Category;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
        $programs = Program::orderBy('id', 'desc')->take(2)->get();
        $progs = Program::paginate(10);
        return view('beranda')->with([
            'programs' => $programs,
            'progs' => $progs
        ]);
    }

    public function landing()
    {
        $programs = Program::where('category_id', 1)
                    ->orderBy('id', 'desc')
                    ->take(10)
                    ->get();
        
        $ilus = Program::where('category_id', 2)
                    ->orderBy('id', 'desc')
                    ->take(10)
                    ->get();
        
        $typos = Program::where('category_id', 3)
                    ->orderBy('id', 'desc')
                    ->take(10)
                    ->get();


        return view('landing')->with([
            'programs' => $programs,
            'ilus' => $ilus,
            'typos' => $typos
        ]);
    }

    public function detail_post($id)
    {

        $program = Program::findOrFail($id);
        $loks = Program::get();
        return view('detail-post')->with([
            'program' => $program,
            'loks' => $loks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $cats = Category::all();
        return view ('create-program')->with([
            'cats' =>$cats
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'title' => 'required|max:255',
            'photo' => 'required|mimes:jpeg,bmp,png,svg|max:700',
            'description' => 'required|max:1000',
            'hastag' => 'required|max:100',
            'subhastag' => 'required|max:100'
        ]);

        Program::create([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'photo' => $request->file('photo')->store('images'),
            'description' => $request->description,
            'hastag' => $request->hastag,
            'subhastag' => $request->subhastag
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
        $cats = Category::all();
        $program = Program::findOrFail($id);
        return view('edit-post')->with([
            'program' => $program,
            'cats' => $cats
        ]);

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
        if($request->photo == null) {
            $validatedData = $request->validate([
                'user_id' => 'required|integer',
                'category_id' => 'required|integer',
                'title' => 'required|max:255',
                'description' => 'required|max:1000',
                'hastag' => 'required|max:100',
                'subhastag' => 'required|max:100'
            ]);
    
            Program::where('id', $id)->update([
                'user_id' =>$request->user_id,
                'title' => $request->title,
                'category_id' => $request->category_id,
                'description' =>$request->description,
                'hastag' => $request->hastag,
                'subhastag' => $request->subhastag
                ]);
    
        }
        if($request->photo != null) {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'title' => 'required|max:255',
            'photo' => 'required|mimes:jpeg,bmp,png,svg|max:700',
            'description' => 'required|max:1000',
            'hastag' => 'required|max:100',
            'subhastag' => 'required|max:100'
        ]);
    
            if ($request->hapus_photo) {
                Storage::delete($request->hapus_photo);
            }
    
            Program::where('id', $id)->update([
                'user_id' =>$request->user_id,
                'title' => $request->title,
                'photo' => $request->file('photo')->store('images'),
                'category_id' => $request->category_id,
                'description' =>$request->description,
                'hastag' => $request->hastag,
                'subhastag' => $request->subhastag
                ]);
            }
    
            return redirect()->route('program.index');
                

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Storage::delete($request->photo);
        $id = $request->id;
        $item = Program::findOrFail($id);
        $item->delete();

        return back();
    }

}
