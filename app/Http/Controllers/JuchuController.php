<?php

namespace App\Http\Controllers;

use App\Models\Juchu;
use App\Models\Bunbougu;
use App\Models\Kyakusaki;
use App\Models\Joutai;
use Illuminate\Http\Request;

class JuchuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $juchus = Juchu::select([
            'j.id',
            'j.kyakusaki_id',
            'j.bunbougu_id',
            'j.kosu',
            'j.user_id',
            'k.name as kyakusaki_name',
            'b.name as bunbougu_name',
            'u.name as user_name',
            'g.name as joutai'
        ])
        ->from('juchus as j')
        ->join('kyakusakis as k', function($join){
            $join->on('j.kyakusaki_id', '=', 'k.id');
        })
        ->join('bunbougus as b', function($join){
            $join->on('j.bunbougu_id', '=', 'b.id');
        })
        ->join('users as u', function($join){
            $join->on('j.user_id', '=', 'u.id');
        })
        ->join('joutais as g', function($join){
            $join->on('j.joutai', '=', 'g.id');
        })
        ->orderBy('j.id','DESC')
        ->paginate(5);

        return view('juchu.index',compact('juchus'))
                ->with('user_name',\Auth::user()->name)
                ->with('page_id',request()->page)
                ->with('i',(request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bunbougus = Bunbougu::all();
        $kyakusakis = Kyakusaki::all();
        return view('juchu.create')
            ->with('bunbougus',$bunbougus)
            ->with('kyakusakis',$kyakusakis);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kyakusaki_id' => 'required|integer',
            'bunbougu_id' => 'required|integer',
            'kosu' => 'required|integer|min:1|max:12',
        ]);

        $juchu = new Juchu;
        $juchu->kyakusaki_id = $request->input(["kyakusaki_id"]);
        $juchu->bunbougu_id = $request->input(["bunbougu_id"]);
        $juchu->kosu = $request->input(["kosu"]);
        $juchu->joutai = 1;
        $juchu->user_id = \Auth::user()->id;
        $juchu->save();

        return redirect()->route('juchu.index')
            ->with('success','受注完了しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Juchu $juchu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Juchu $juchu)
    {
        $bunbougus = Bunbougu::all();
        $kyakusakis = Kyakusaki::all();
        $joutais = Joutai::all();
        return view('juchu.edit',compact('juchu'))
            ->with('bunbougus',$bunbougus)
            ->with('joutais',$joutais)
            ->with('kyakusakis',$kyakusakis);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Juchu $juchu)
    {
        $request->validate([
            'kyakusaki_id' => 'required|integer',
            'bunbougu_id' => 'required|integer',
            'kosu' => 'required|integer|min:1|max:12',
        ]);

        $juchu->kyakusaki_id = $request->input(["kyakusaki_id"]);
        $juchu->bunbougu_id = $request->input(["bunbougu_id"]);
        $juchu->kosu = $request->input(["kosu"]);
        $juchu->joutai = $request->input(["joutai_id"]);
        $juchu->user_id = \Auth::user()->id;
        $juchu->save();

        return redirect()->route('juchu.index')
            ->with('success','受注内容を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Juchu $juchu)
    {
        $juchu->delete();
        return redirect()->route('juchu.index')
            ->with('success','受注ID'.$juchu->id.'を削除しました');
    }
}
