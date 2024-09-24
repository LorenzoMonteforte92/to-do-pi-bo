<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Organiser;
use App\Models\Type;
use App\Models\User as ModelsUser;
use Illuminate\Support\Str;


class NewProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $types = Type::all();
        $organiser = Organiser::all();

        return view('admin.profile.index' , compact('user', 'types', 'organiser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $types = Type::all();
        $organiser = Organiser::all();

        return view('admin.profile.create' , compact('user', 'types', 'organiser'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'img' => 'nullable|file|mimes:png,jpg,jpeg|max:2044',
                'phone_num' => 'nullable|string|max:15|min:10',
                'bio' => 'nullable|string|min:10',
            ],
            [
                'img.mimes' => 'il formato del logo deve essere png, jpg o jpeg',
                'img.max' => 'il file non può superare i 2mb',
                'phone_num.min' => 'il numero di telefono deve contenere minimo 10 cifre',
                'phone_num.max' => 'il numero di telefono deve contenere massimo 15 cifre',
                'bio.min' => 'Descriviti usando almeno 10 caratteri',
            ]

        );
        $formdata = $request->all();

        if ($request->hasFile('img')) {
            $img_path = Storage::disk('public')->put('projects_images', $formdata['img']);
            $formdata['img'] = $img_path;
        }

        
        $slug = Str::slug($formdata['name'] . rand(10,110) . Str::random(2));

        $newProfile = new NewProfile([
            'user_id' => Auth::id(),
            'slug' => $slug,
        ]);

        $newProfile->fill($formdata);
        $newProfile->save();

        if($request->has('organiser_id')) {
            $newProfile->organisers()->sync($formdata['organiser_id']);
        }
        return redirect()->route('admin.profile.show')->with('message', 'Profilo aggiornato con successo');;
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ModelsUser $user)
    {
        
        $user = Auth::user();
        $types = Type::all();
        $organiser = Organiser::all();

        return view('admin.profile.show' , compact('user', 'types', 'organiser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
