<?php

namespace App\Http\Controllers;

use App\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.content.home.index',[
            'data' => Home::all()
        ]);
    }

    public function store(Request $request)
    {
        $validates = $request->validate([
            'title'     => 'required',
            'img_title' => 'file|image|max:2048',
            'logo'      => 'file|image|max:2048'
        ]);
        $validates['img_title'] = $request->file('img_title')->store('assets/img_jumbo','public');
        $validates['logo'] = $request->file('logo')->store('asssets/logo','public');
        Home::create($validates);
        return redirect()->route('home.index');
    }


    public function update(Request $request,Home $home)
    {
        $validates = $request->validate([
            'title' => 'required',
            'img_title' => 'file|image|max:2048',
            'logo' => 'file|image|max:2048'
        ]);
        if (!empty($validates['img_title'])){
            Storage::delete('public/'.$home->img_title);
            $validates['img_title'] = $request->file('img_title')->store('assets/img_jumbo','public');
        }
        if(!emptty($validates['logo'])){
            Storage::delete('public/' .$home->logo);
            $validates['logo'] = $request->file('logo')->store('assets/logo','public');
        }
        $home->update($validates);
        return redirect()->route('home.index');
    }

    public function destroy(Home $home)
    {
        Storage::delete('public/'.$home->img_title);
        Storage::delete('public/'.$home->logo);
        $home->delete();
        return redirect()->route('home.index');
    }
}
