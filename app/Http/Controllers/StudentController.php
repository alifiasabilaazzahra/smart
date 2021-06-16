<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Yand;
use App\Quiz;
use App\Teacher;
use App\Quiz_category;
use App\Quiz_class;
use App\Quiz_point;
use App\Quiz_question_option;
use App\Quiz_question;
use App\Quiz_schedule;
use App\Quiz_subjects;
use App\Student;
use App\StudentClass;
use App\Theory;
use App\Schedule;
class StudentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->is_role; 

            $this->user_id = Auth::user()->user_id;
            if(Auth::user()->is_role != 'Student'){
                return redirect('/home');
            }
            return $next($request);
           });
    }

    //show
    public function index()
    {
        $data['title'] = 'Siswa';
        $data['load'] = ['student/dashboard'];
        $data['tasks'] = $this->get_task_all();
        $data['Qpoint'] = new Quiz_point;
        $data['id_siswa'] = $this->getStudentInfo()->student_id;
        $data['yand'] = new Yand;
        $data['mapel'] = Quiz_subjects::all();
        $data['jadwal'] = Schedule::where('student_class_id', Auth::user()->account->student_class_id)
                                    ->whereRaw('(now() between schedule_start and schedule_end)')
                                    ->get();
        
        return view('temp/temp_siswa', $data);
    }

    public function nilai_tugas()
    {
        $siswa= $this->getStudentInfo();
        $data['title'] = 'Nilai';
        $data['load'] = ['student/nilai_tugas'];
        $data['nilai_siswa']=Quiz::join('task_points', 'tasks.task_id', '=', 'task_points.task_id')->where('student_id', $siswa->student_id)->get();
        $data['mapel'] = Quiz_subjects::all();
        
        return view('temp/temp_siswa', $data);
    }

    public function pengerjaan($id=NULL)
    {
        $task_data=$this->get_task_where($id);
        
        $tgl=Quiz_schedule::select('task_schedule_end')->where('task_id', $id)->first();

        if ($id != NULL && $task_data && strtotime($tgl->task_schedule_end) > strtotime(date('Y-m-d'))) {
            $data['title'] = 'Pengerjaan';
            $data['load'] = ['student/pengerjaan'];
            $data['tasks']=$task_data;
            $data['soal']=Quiz_question::where('task_id', $id)->get();
            
            $std=$this->getStudentInfo();
            $data['siswa']=$std;
            $data['id'] = $id;
            $data['ss'] = Quiz_point::where('student_id', $std->student_id)
                        ->where('task_id',$id)->get('task_point')->count();
            $data['Qquestion'] = Quiz_question::where('task_id', $id)
                            ->get('task_question')->count();
            $data['task_question_option'] = new Quiz_question_option;
            $data['mapel'] = Quiz_subjects::all();
            return view('temp/temp_siswa', $data);
		}
    }

    //rest
        //insert
    
    public function in_jawaban(Request $request)
    {
        $nilai=0;
		$siswa = $this->getStudentInfo();
		if ($request->task_id != NULL) {
            $jumlah_soal=Quiz_question::where('task_id', $request->task_id)->count();
            $selectQ = Quiz_question::where('task_id', $request->task_id)->get();
			foreach ($selectQ as $key) {

				$jawab=$request->pil[$key->task_question_id];
				$kunjaw=$key->task_question_answer;
				if ($jawab==$kunjaw) {
					$nilai=$nilai+1;
				}
			}
			$op=$nilai*100/$jumlah_soal;
			if ($op < 75) {
				$status='Remedial';
			}
			elseif ($op==75) {
				$status='Cukup';
			}
			elseif ($op>75) {
				$status='Lulus';
			}

            Quiz_point::insert([
                'task_point_id' => $this->genID(),
                'student_id' => $siswa->student_id,
				'task_id' => $request->task_id,
				'task_point' => $op,
				'status' => $status
            ]);
            
        return redirect('/student');
        }
    }
    
    //func

    function get_task_all()
    {
        $getData = Quiz_schedule::join('task_classes', 'task_schedules.task_id', '=', 'task_classes.task_id')
                    ->join('tasks', 'task_classes.task_id', '=', 'tasks.task_id')
                    ->where('task_classes.student_class_id', $this->getStudentInfo()->student_class_id)->get();
    
        return $getData;
    }

    function get_task_where($id=NULL)
    {
        $getData = Quiz_schedule::join('task_classes', 'task_schedules.task_id', '=', 'task_classes.task_id')
                    ->join('tasks', 'task_classes.task_id', '=', 'tasks.task_id')
                    ->where('task_classes.student_class_id', $this->getStudentInfo()->student_class_id)
                    ->where('tasks.task_id', $id)->get();
    
        return $getData;
    }

    function getStudentInfo()
    {
        return StudentClass::join('students', 'student_classes.student_class_id', '=', 'students.student_class_id')
                ->where('students.user_id', $this->user_id)->first();
    }

    function genId($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function theory($id){
        $data['title'] = 'Materi Pembahasan';
        $data['load'] = ['student/theory'];
        $data['theory'] = Theory::select("theories.*","theory_classes.theory_id","theory_classes.student_class_id")
                                ->where("theories.subject_id",$id)
                                ->where("theory_classes.student_class_id", Auth::user()->account->student_class_id)
                                ->join("theory_classes","theory_classes.theory_id","=","theories.theory_id")
                                ->orderBy("theories.created_at","desc")
                                ->paginate(10);
        $data['mapel'] = Quiz_subjects::all();
        return view('temp/temp_siswa',$data);
    }
    public function ikuti_jadwal($id_jadwal=NULL)
    {
        $validasi = Schedule::where('schedule_id', $id_jadwal)
                            ->where('student_class_id', Auth::user()->account->student_class_id)
                            ->first();
        if (!$validasi) {
            return redirect('/');
        }
        $data['mapel'] = Quiz_subjects::all();
        
        $data['jadwal'] = $validasi;
        $data['title'] = 'Jadwal Mapel '.$validasi->subjects->subject_name;
        $data['load'] = ['student/ikuti_jadwal'];
        return view('temp/temp_siswa', $data);
    }
}