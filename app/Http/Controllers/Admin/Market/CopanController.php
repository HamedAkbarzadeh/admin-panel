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
    /**
     * @OA\Get(
     *    path="/admin/discount/copon",
     *    operationId="allCopon",
     *    tags={"Discount"},
     *    summary="get all copon Detail",
     *    description="get all copon Detail",
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *          @OA\Property(property="status_code", type="integer", example="200"),
     *          @OA\Property(property="data",type="object")
     *           ),
     *        )
     *       )
     *  )
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
           /**
     * @OA\Post(
     *      path="/admin/discount/copon/store",
     *      operationId="storeCopon",
     *      tags={"Discount"},
     *      summary="Store Copon in DB",
     *      description="Store Copon in DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"code", "amount" , "amount_type", "discount_ceiling" , "type" , "status", "start_date" , "end_date", "user_id"},
     *            @OA\Property(property="code", type="string", format="string", example="win30"),
     *            @OA\Property(property="status", type="integer", format="integer", example="0 Or 1"),
     *            @OA\Property(property="amount_type", type="integer", format="integer", example="0 Or 1"),
     *            @OA\Property(property="amount", type="integer", format="integer", example="150000"),
     *            @OA\Property(property="discount_ceiling", type="integer", format="integer", example="52"),
     *            @OA\Property(property="type", type="integer", format="integer", example="0 OR 1"),
     *            @OA\Property(property="start_date", type="integer", format="integer", example="214215321213"),
     *            @OA\Property(property="end_date", type="integer", format="integer", example="214215321213"),
     *            @OA\Property(property="user_id", type="integer", format="integer", example="2"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="status", type="integer", example=""),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
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
