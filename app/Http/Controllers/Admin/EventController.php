<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\NewProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $events = Event::all();

        return view('admin.event.index', compact('user', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('admin.event.create', compact('user'));
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
                'name' => 'required|string|max:250',
                'img' => 'nullable|file|mimes:png,jpg,jpeg|max:2044',
                'bio' => 'nullable|string|min:10',
            ],
            [
                'name.required' => 'Dai un titolo al tuo evento',
                'name.max' => 'Il nome ha raggiunto la lunghezza massima di caratteri',
                'img.mimes' => 'il formato del logo deve essere png, jpg o jpeg',
                'img.max' => 'il file non può superare i 2mb',
                'phone_num.min' => 'il numero di telefono deve contenere minimo 10 cifre',
                'phone_num.max' => 'il numero di telefono deve contenere massimo 15 cifre',
                'bio.min' => 'Descrivi il tuo evento usando almeno 10 caratteri',
            ]

        );
        $formdata = $request->all();
        $newProfile = NewProfile::where('user_id', Auth::id())->first();

        if ($request->hasFile('img')) {
            $img_path = Storage::disk('public')->put('projects_images', $formdata['img']);
            $formdata['img'] = $img_path;
        }

        $newProfile = NewProfile::where('user_id', Auth::id())->first();
        
        $slug = Str::slug($formdata['name'] . rand(10,110) . Str::random(2));
    
        $newEvent = new Event($formdata);
        $newEvent->slug = $slug;
        $newEvent->new_profile_id = $newProfile->id;

        $newEvent->fill($formdata);
        $newEvent->save();

        return redirect()->route('admin.event.show', ['event' => $newEvent->slug])->with('message', 'Grande ' . Auth::user()->name . '! evento creato con successo');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(NewProfile $newProfile, $eventSlug)
    {
        // Recupera l'evento associato al profilo
        $event = $newProfile->events()->where('slug', $eventSlug)->first();

        // Se l'evento non esiste, aborta con un errore 404
        if (!$event) {
            abort(404, 'Evento non trovato');
        }

        //laravel policy
        $this->authorize('view', $event);

        return view('admin.event.show', compact('user', 'newProfile', 'event'));
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
