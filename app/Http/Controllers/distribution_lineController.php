<?php

namespace App\Http\Controllers;

use App\Models\distribution_header;
use Illuminate\Http\Request;
use App\Models\distribution_line;
use Illuminate\Support\Facades\DB;

class distribution_lineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=distribution_line::get();
        return response()->json($data);
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

        $data = distribution_header::orderBy('id', 'desc')->first(); // Fetch the last record based on the 'id' column
        $lastId = $data->id;
        $id_distribution_header=$lastId;

        $billNumber = str_pad(rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        $num_bl=$billNumber;

        $name_delivery=$request->get('name_delivery');
        $qty_line=$request->get('qty_line');
        $volume_line=$request->get('volume_line');
        $line_order=$request->get('line_order');

        $data=new distribution_line([
            'id_distribution_header'=>$id_distribution_header,
            'num_bl'=>$num_bl,
            'name_delivery'=>$name_delivery,
            'qty_line'=>$qty_line,
            'volume_line'=>$volume_line,
            'line_order'=>$line_order,
        ]);
        $data->save();
        return response()->json(['status'=>'pass','msg'=>'inserted']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data=distribution_line::find($id);

        $data=DB::table('distribution_lines')
                ->where('distribution_lines.id_distribution_header','=',$id)
                ->select('*')
                ->get();

        return response()->json($data);
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
        $id_distribution_header=$request->get('id_distribution_header');
        $num_bl=$request->get('num_bl');
        $name_delivery=$request->get('name_delivery');
        $qty_line=$request->get('qty_line');
        $volume_line=$request->get('volume_line');
        $line_order=$request->get('line_order');

        $data=distribution_line::find($id);
        $data->id_distribution_header=$id_distribution_header;
        $data->num_bl=$num_bl;
        $data->name_delivery=$name_delivery;
        $data->qty_line=$qty_line;
        $data->volume_line=$volume_line;
        $data->line_order=$line_order;
        $data->update();
        return response()->json(['status'=>'pass','msg'=>'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $data=distribution_line::find($id);
        // $data->delete();
        // return response()->json(['status'=>'pass','msg'=>'deleted']);
    }
}
