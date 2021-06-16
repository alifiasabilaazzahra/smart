<?php

namespace App\Http\Controllers\API\REST;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * 
     * Index db
     */
    public function index(Request $request){
        try {
            
        $std=new Student();
        $student = Student::orderBy('student_id','desc')->get();

        return Datatables::of($student)->addColumn('action', function($student){
                
            
            return '
            <div class="row">
                <div class="col-xs-6">
                    <a onclick="editForm(\''.$student->student_id.'\')" class="btn btn-success"><i class="glyphicon glyphicon-edit"></i></a> 
                </div>
                <div class="col-xs-6">
                    <a onclick="deleteData(\''.$student->student_id.'\')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                </div>
            </div>';
           
            })->rawColumns(['action', 'stat'])->make(true);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada serve, coba kembali.', 
                'serve' => []
            ], 500);
        }
    }

    public function trash(Request $request)
    {
        try {
            
        $student = Student::onlyTrashed()->get();

        return Datatables::of($student)->addColumn('action', function($student){
                
            
            return '
            <a onclick="restore(\''.$student->student_id.'\')" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-repeat"></i> Restore</a> 
            <a onclick="deletePermanent(\''.$student->student_id.'\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            
            
            })->rawColumns(['action'])->make(true);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada serve, coba kembali.', 
                'serve' => []
            ], 500);
        }
    }

    public function get_one($id){
        try {
            
        $student = Student::all()->where('student_id', $id);

        return Datatables::of($student)->addColumn('action', function($student){
                
            
            return '<a onclick="editForm(\''.$student->student_id.'\')" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i> update</a> <a onclick="deleteData(\''.$student->student_id.'\')" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            
            
            })->rawColumns(['action'])->make(true);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada serve, coba kembali.', 
                'serve' => []
            ], 500);
        }
    }

    /**
     * 
     * Store db
     */
    public function store(Request $request){
        try {
            
            $dataStudent = new Student;
            $cek_nama = Student::where('student_name', $request->student_name)->count();

            if($cek_nama > 0){
                $std_name = $request->student_name.'(Copy)_'.$dataStudent->randString();
            }
            else{
                $std_name = $request->student_name;
            }

            $dataStudent->student_name = $std_name;
            $dataStudent->student_class = $request->student_class;
            $dataStudent->save();
            return response()->json([
                'message' => 'Sukses tersimpan.', 
                'serve' => $dataStudent
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada serve, coba kembali.', 
                'serve' => [$e]
            ], 500);
        }
    }

    /**
     * 
     * Retrieve db
     */
    public function retrieve(Request $request){
        try {
            $dataStudent = Student::where('student_id',$request->student_id)->first();
            if(!$dataStudent){
                return response()->json([
                    'message' => 'Data kosong.', 
                    'serve' => []
                ], 400);
            }
            return response()->json([
                'message' => 'Sukses tersimpan.', 
                'serve' => $dataStudent
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada serve, coba kembali.', 
                'serve' => []
            ], 500);
        }
    }

    /**
     * 
     * Update db
     */
    public function update(Request $request){
        try {
            $dataStudent = Student::where("student_id",$request->student_id)->first();
            $dataStudent->student_name = $request->student_name;
            $dataStudent->student_class = $request->student_class;
            $dataStudent->save();
            return response()->json([
                'message' => 'Sukses tersimpan.', 
                'serve' => $dataStudent
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada serve, coba kembali.', 
                'serve' => []
            ], 500);
        }
    }


    public function restore(Request $request)
    {
        try {
            $id=$request->student_id;
            $student = Student::onlyTrashed()->where('student_id',$id);
            $student->restore();
            return response()->json([
                'message' => 'Sukses tersimpan.', 
                'serve' => $student
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada serve, coba kembali.', 
                'serve' => []
            ], 500);
        }
    }

    /**
     * 
     * Delete db
     */
    public function delete(Request $request){
        try {
            $dataStudent = Student::find($request->student_id);
            $dataStudent->delete();
            return response()->json([
                'message' => 'Sukses terhapus.', 
                'serve' => []
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada serve, coba kembali.', 
                'serve' => []
            ], 500);
        }
    }

    public function delete_permanent(Request $request)
    {
        try {
            $id= $request->student_id;
            $student = Student::onlyTrashed()->where('student_id',$id);
    	    $student->forceDelete();
            return response()->json([
                'message' => 'Sukses terhapus.', 
                'serve' => []
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada serve, coba kembali.', 
                'serve' => []
            ], 500);
        }
    }
}
