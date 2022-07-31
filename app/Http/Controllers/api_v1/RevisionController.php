<?php

namespace App\Http\Controllers\api_v1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Revision;
use App\Models\Timeline;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'timelineid'            => 'required|integer|exists:timelines,id',
                'description_revision'  => 'required|string|max:255',
                'image_revision'        => 'required',
                'status_revision'       => 'required|boolean|exists:sales_transactions,status_product',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Validation Error',
                    'data' => $validator->errors(),
                    'ErrorCode' => 400
                ],
                400
            );
        }

        Revision::create($request->all());
        return response()->json(
            [
                'status' => 'succes',
                'message' => 'Input revision succes',
            ],
            400
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
