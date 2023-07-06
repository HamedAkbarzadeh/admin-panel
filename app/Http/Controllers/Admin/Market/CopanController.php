<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CopanRequest;
use App\Models\Market\Copan;
use Illuminate\Http\Request;

class CopanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $copons = Copan::where('created_at'  , 'desc')->get();
        return response()->json([
            'copons' => $copons,
            'status' => true,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CopanRequest $request)
    {
        $inputs = $request->all();

        //fix date
        $realTimePublishedAt = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y/m/d H:i:s', (int) $realTimePublishedAt);
        //fix date
        $realTimePublishedAt = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y/m/d H:i:s', (int) $realTimePublishedAt);
        if ($request->type == 0) {
            $inputs['user_id'] = null;
        } else {
            $inputs['user_id'] = $request->user_id;
        }

        $copon = Copan::create($inputs);
        return response()->json([
            'copon' => $copon,
            'status' => true,
        ]);
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
