<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Entities\Featured;
use App\Http\Controllers\Controller;
use File;
class FeaturedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;

        $path = public_path().'/upload/'.'product_'.$id;

        if (!file_exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        if($request->has('file_delete')){
            foreach($request->file_delete as $key => $val){
                $featured = Featured::find($val);
                $delName = $featured->name;
                $featured->delete();

                File::delete($path.'/'.$delName);
            }
        }

        if($request->has('file')){

            foreach($request->photo_index as $key => $val){
                $file = $request->file[$key];
                $file_name = $request->file_name[$key];
                $file->move($path, $file_name);

                $featured = new Featured();
                $featured->product_id = $id;
                $featured->name = $file_name;
                $featured->save();
            }
        }

        return response()->json(['status' => 'success'], 200);
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
