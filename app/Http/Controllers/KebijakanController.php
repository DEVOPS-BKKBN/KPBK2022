<?php

namespace App\Http\Controllers;
use App\User;
use App\Kebijakan;
use App\Http\Requests\KebijakanRequest;
use Illuminate\Http\Request;

class KebijakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->authorizeResource(Kategori::class);
    }

    public function index(Kebijakan $model)
    {
        $this->authorize('manage-items', User::class);

        return view('master.kebijakan.index', ['kebijakans' => $model->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('master.kebijakan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KebijakanRequest $request, Kebijakan $model)
    {
        $model->create($request->all());
        return redirect()->route('kebijakan.create')->withStatus(__('Jenis kebijakan successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kebijakan  $kebijakan
     * @return \Illuminate\Http\Response
     */
    public function show(Kebijakan $kebijakan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kebijakan  $kebijakan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kebijakan $kebijakan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kebijakan  $kebijakan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kebijakan $kebijakan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kebijakan  $kebijakan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kebijakan $kebijakan)
    {
        //
    }
}
