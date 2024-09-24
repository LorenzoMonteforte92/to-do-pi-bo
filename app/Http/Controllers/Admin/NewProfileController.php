<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Organiser;
use App\Models\Type;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;

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

        $incompleteUser = Auth::user();
        $incompleteUser->img = $formdata['img'];
        $incompleteUser->phone_num = $formdata['phone_num'];
        $incompleteUser->bio = $formdata['bio'];
        $incompleteUser->save();

        if($request->has('organiser_id')) {
            $incompleteUser->organisers()->sync($formdata['organiser_id']);
        }
        return redirect()->route('admin.profile.show');
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
