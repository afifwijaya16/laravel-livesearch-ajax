<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request) {
        if($request->ajax()) {
            $output='';
            $query=$request->post('query');
            if($query !='') {
                $data=DB::table('users')->where('name', 'like', '%'.$query.'%')->orWhere('email', 'like', '%'.$query.'%')->offset(0)->limit(10)->get();
            }
            else {
                $data=DB::table('users')->orderBy('id', 'desc')->paginate(10);
            }
            $total_row=$data->count();
            if($total_row > 0) {
                foreach($data as $row) {
                    $onclick = "edit('$row->name','$row->email')";
                    $output .='
                        <tr>
                            <td>'.$row->name.'</td>
                            <td>'.$row->email.'</td>
                            <td>
                                <a href="javascript:;" onclick="'.$onclick.'" class="btn btn-success"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    ';
                }
            }
            else {
                $output='<tr><td align="center"colspan="3">No Data Found</td></tr>';
            }
            $data=array(
                'table_data'=> $output,
                'total_data'=> $total_row
            );
            echo json_encode($data);
        }
    }

    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
