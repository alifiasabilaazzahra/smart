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
use App\TheoryClass;
use App\Schedule;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;



class TeacherController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->is_role; 

            $this->user_id = Auth::user()->user_id;
            $this->yand = new Yand;
            if(Auth::user()->is_role != 'Teacher'){
                return redirect('/home');
            }
            return $next($request);
           });
    }

    //show
    public function index()
    {
        $data['title'] = 'Guru';
        $data['jumlah_tugas']=Quiz::where('user_id', $this->user_id)->count();
        $data['tugas'] = Quiz::where('user_id', $this->user_id)->paginate(10);
        $data['jadwal'] = Schedule::where('teacher_id', Auth::user()->account->teacher_id)
                                    ->whereRaw('(now() between schedule_start and schedule_end)')
                                    ->get();
                                   
        $data['load'] = ['teacher/dashboard'];

        return view('temp/temp_guru', $data);
    }

    public function buat_tugas()
    {
        $data['title'] = 'Buat Tugas';
        $data['load'] = ['teacher/buat_tugas'];
        $data['task_category'] = Quiz_category::All();
        $data['subjects'] = Quiz_subjects::All();
        return view('temp/temp_guru', $data);
    }

    public function buat_soal(Request $request)
    {
        $request->session()->put('task_id', $request->task_id);
        $data['title'] = 'Buat Pertanyaan';
        $data['load'] = ['teacher/masukan_pertanyaan'];
        $data['maks'] = $request->jumlah_pertanyaan;
        return view('temp/temp_guru', $data);
    }

    public function list_tugas()
    {
        $data['title'] = 'List Tugas';
        $data['load'] = ['teacher/list_tugas'];
        $data['yand'] = new Yand;
        $data['tugas']=DB::table('task_schedules')
                        ->join('tasks', 'tasks.task_id', '=', 'task_schedules.task_id')
                        ->where('tasks.user_id', $this->user_id)
                        ->paginate(10); 


        return view('temp/temp_guru', $data);
    }

    public function tinjau_tugas($id_tugas=NULL)
    {
        if($this->yand->tes_id($id_tugas, 'task_id', 'tasks') == false){
            return redirect('/');
        }
        $data['yand'] = new Yand;
        $data['title'] = 'Tinjau Tugas';
        $data['load'] = ['teacher/tinjau_tugas'];
        $data['id'] = $id_tugas;
        $data['jadwal'] = Quiz_schedule::where('task_id', $id_tugas)->get();
        $data['tugas'] = Quiz_category::join('tasks','tasks.task_category_id','=','task_categories.task_category_id')
                        ->where('task_id', $id_tugas)->get();
        $data['jumlah_jadwal'] = Quiz_schedule::where('task_id', $id_tugas)->count();
        $data['jumlah_soal'] = Quiz_question::where('task_id', $id_tugas)->count();
        return view('temp/temp_guru', $data);
    }

    public function lihat_soal($id_tugas=NULL)
    {
        if($this->yand->tes_id($id_tugas, 'task_id', 'tasks') == false){
            return redirect('/');
        }
        $data['title'] = 'Lihat Soal';
        $data['load'] = ['teacher/lihat_soal'];
        $data['soal'] = Quiz_question::where('task_id', $id_tugas)->get();
        $data['bd'] = new Quiz_question_option;
        

        return view('temp/temp_guru', $data);
    }

    public function data_kelas($id_tugas=NULL)
    {
        if($this->yand->tes_id($id_tugas, 'task_id', 'tasks') == false){
            return redirect('/');
        }
        $data['title'] = 'Data Kelas';
        $data['load'] = ['teacher/kelas'];
        $data['tasks'] = Quiz::where('task_id', $id_tugas)->get();
        $data['kelas'] = StudentClass::All();
        $data['task_class'] = StudentClass::join('task_classes', 'student_classes.student_class_id', '=', 'task_classes.student_class_id')
                            ->where('task_classes.task_id', $id_tugas)->get();
        return view('temp/temp_guru', $data);
    }

    public function tinjau_nilai($id_tugas=NULL)
    {
        if($this->yand->tes_id($id_tugas, 'task_id', 'tasks') == false){
            return redirect('/');
        }
        $data['title'] = 'Tinjau Nilai';
        $data['load'] = ['teacher/list_nilai'];
        $data['tasks'] = StudentClass::join('task_classes', 'student_classes.student_class_id', '=', 'task_classes.student_class_id')
                        ->join('tasks', 'tasks.task_id', '=', 'task_classes.task_id')
                        ->where('tasks.task_id', $id_tugas)->where('tasks.user_id', $this->user_id)
                        ->get(); 

        return view('temp/temp_guru', $data);
    }

    public function update_info_tugas($id_tugas=NULL)
    {
        if($this->yand->tes_id($id_tugas, 'task_id', 'tasks') == false){
            return redirect('/');
        }
        $data['title'] = 'Update Info Tugas';
        $data['load'] = ['teacher/update_info_tugas'];
        $data['tugas'] = Quiz_category::join('tasks','tasks.task_category_id','=','task_categories.task_category_id')
                        ->where('task_id', $id_tugas)->get();
        return view('temp/temp_guru', $data);
    }

    public function update_soal($id_tugas=NULL, $id_pertanyaan=NULL, Request $request)
    {
        if($this->yand->tes_id($id_tugas, 'task_id', 'tasks') == false){
            return redirect('/');
        }
        $request->session()->put('task_id', $id_tugas);
        $request->session()->put('id_soal', $id_pertanyaan);
        $data['title'] = 'Update Soal';
        $data['load'] = ['teacher/update_soal'];
        $data['soal'] = Quiz_question::where('task_question_id', $id_pertanyaan)
                        ->where('task_id', $id_tugas)->get();
        $data['bd'] = new Quiz_question_option;
        return view('temp/temp_guru', $data);
    }

    public function tinjau_nilai_kelas($id_tugas=NULL, $id_kelas=NULL)
    {
        if($this->yand->tes_id($id_tugas, 'task_id', 'tasks') == false){
            return redirect('/');
        }
        $data['title'] = 'Tinjau Nilai Kelas';
        $data['load'] = ['teacher/list_kelas_nilai'];

        $data['nilai_siswa']=Student::join('task_points', 'students.student_id', '=', 'task_points.student_id')
        ->where('task_points.task_id', $id_tugas)
        ->where('students.student_class_id', $id_kelas)
        ->get();
        $data['kelas'] = StudentClass::where('student_class_id', $id_kelas)->first();
        return view('temp/temp_guru', $data);
    }

    public function ikuti_jadwal($id_jadwal=NULL)
    {
        $validasi = Schedule::where('schedule_id', $id_jadwal)
                            ->where('teacher_id', Auth::user()->account->teacher_id)
                            ->first();
        if (!$validasi) {
            return redirect('/');
        }
        $data['jadwal'] = $validasi;
        $data['title'] = 'Jadwal Mapel '.$validasi->subjects->subject_name;
        $data['load'] = ['teacher/ikuti_jadwal'];
        return view('temp/temp_guru', $data);
    }
    





    //crud
        
        //insert
    
    public function in_tugas(Request $request)
    {
        $id= $this->genId();
        DB::table('tasks')->insert([
            'task_id'   => $id,
            'user_id'   => $this->user_id,
            'task_category_id' => $request->task_category_id,
            'subject_id'   => $request->subject_id,
            'task_name'         => $request->task_name,
            'task_description'  => $request->task_description
        ]);

        DB::table('task_schedules')->insert([
            'task_schedule_id'  => $this->genId(),
            'task_id'           => $id,
            'task_schedule_start'=> $request->mulai,
            'task_schedule_end' => $request->selesai
        ]);
        return redirect('/guru/list_tugas')->with('pesan','Berhasil menginput tugas baru');
    }

    public function in_pertanyaan(Request $request)
    {
        $id_tugas = $request->session()->get('task_id');
        $data_pertanyaan=[];
		$data_option=[];
		$jumlah_row=count($request->option);
        // echo $id_tugas;
		for($i=0; $i<$jumlah_row; $i++){
			$id=$this->genId();
			$data_pertanyaan[]=[
								'task_question_id' => $id,
								'task_id' => $id_tugas,
								'task_question' => $request->pertanyaan[$i],
								'task_question_answer' => $request->option[$i]
								];
			$data_option[]=[
				'task_question_option_id' => $this->genId(),
				'task_question_id' => $id,
				'task_question_option' => 'A',
				'task_question_option_description' => $request->a[$i]
			];

			$data_option[]=[
				'task_question_option_id' => $this->genId(),
				'task_question_id' => $id,
				'task_question_option' => 'B',
				'task_question_option_description' => $request->b[$i]
			];

			$data_option[]=[
				'task_question_option_id' => $this->genId(),
				'task_question_id' => $id,
				'task_question_option' => 'C',
				'task_question_option_description' => $request->c[$i]
			];

			$data_option[]=[
				'task_question_option_id' => $this->genId(),
				'task_question_id' => $id,
				'task_question_option' => 'D',
				'task_question_option_description' => $request->d[$i]
			];

			$data_option[]=[
				'task_question_option_id' => $this->genId(),
				'task_question_id' => $id,
				'task_question_option' => 'E',
				'task_question_option_description' => $request->e[$i]
			];
		}

        DB::table('task_questions')->insert($data_pertanyaan);
        DB::table('task_question_options')->insert($data_option);

        return redirect('/guru/tinjau_tugas/'.$id_tugas);
    }

    public function in_kelas(Request $request)
    {
        $cek=Quiz_class::where('task_id', $request->task_id)->where('student_class_id', $request->student_class)->count();
        if($cek > 0){
            return redirect('/guru/data_kelas/'.$request->task_id);
        }
        else{
            Quiz_class::insert([
                'task_class_id' => $this->genId(),
                'task_id' => $request->task_id,
                'student_class_id' => $request->student_class,
            ]);
            return redirect('/guru/data_kelas/'.$request->task_id);
        }
        
    }



        //delete
    
    public function del_kelas($id=NULL, Request $request)
    {
        if($this->yand->tes_id($request->task_id, 'task_id', 'tasks') == false){
            return redirect('/');
        }
        Quiz_class::find($id)->forceDelete();
        return redirect('/guru/data_kelas/'.$request->task_id);
    }

    public function del_tugas($id=NULL)
    {
        if($this->yand->tes_id($id, 'task_id', 'tasks') == false){
            return redirect('/');
        }
        Quiz::find($id)->forceDelete();
        return redirect('/guru/list_tugas');
    }



        //update

    public function up_info_tugas(Request $request)
    {
        $id_tugas=$request->task_id;
        if($this->yand->tes_id($id_tugas, 'task_id', 'tasks') == false){
            return redirect('/');
        }
        Quiz::find($request->task_id)->update([
            'task_name' => $request->task_name,
            'task_description' => $request->task_description
        ]);
        return redirect('/guru/tinjau_tugas/'.$request->task_id);
    }

    public function up_soal(Request $request)
    {

        $id_tugas=$request->session()->get('task_id');
        $id_pertanyaan=$request->session()->get('id_soal');;
        if($this->yand->tes_id($id_tugas, 'task_id', 'tasks') == false){
            return redirect('/');
        }

        $soal=$request->pertanyaan;
		$jawaban_benar=$request->option;
		$op_A=$request->A;
		$op_B=$request->B;
		$op_C=$request->C;
		$op_D=$request->D;
		$op_E=$request->E;

		$soal=[
			'task_question'=>$soal,
			'task_question_answer' => $jawaban_benar
		];

		$option_A=[
			'task_question_option_description' => $op_A
		];
		$option_B=[
			'task_question_option_description' => $op_B
		];
		$option_C=[
			'task_question_option_description' => $op_C
		];
		$option_D=[
			'task_question_option_description' => $op_D
		];
		$option_E=[
			'task_question_option_description' => $op_E
		];

		Quiz_question::where('task_question_id', $id_pertanyaan)->update($soal);


		Quiz_question_option::where('task_question_id', $id_pertanyaan)->where('task_question_option', 'A')->update($option_A);
		Quiz_question_option::where('task_question_id', $id_pertanyaan)->where('task_question_option', 'B')->update($option_B);
		Quiz_question_option::where('task_question_id', $id_pertanyaan)->where('task_question_option', 'C')->update($option_C);
		Quiz_question_option::where('task_question_id', $id_pertanyaan)->where('task_question_option', 'D')->update($option_D);
		Quiz_question_option::where('task_question_id', $id_pertanyaan)->where('task_question_option', 'E')->update($option_E);

        return redirect('/guru/soal/'.$id_tugas);
    }



    //func

    public function send_email($id_tugas, $id_kelas)
    {

        $usr=Student::join('users', 'users.user_id', '=', 'students.user_id')
                ->where('student_class_id', $id_kelas)->get();
        foreach($usr as $key){
            Mail::to($key->email)->send(new SendMailable(
                "Ada Tugas Baru Yang Di Assign Ke Kelas Kami..."
            ));
        }
        
        
        return 'Email was sent';
    }

    public function ekspor_excell($id_tugas=NULL, $id_kelas=NULL)
    {
        if(!headers_sent()) {

            header("Access-Control-Allow-Origin: *");
            header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
            header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With, GoogleDataStudio');
            header('Access-Control-Allow-Credentials: true');
        }
        $data['nilai_siswa']=Student::join('task_points', 'students.student_id', '=', 'task_points.student_id')
                            ->where('task_points.task_id', $id_tugas)
                            ->where('students.student_class_id', $id_kelas)
                            ->get();

		$data['nama_kelas']=StudentClass::select('student_class_name')->where('student_class_id', $id_kelas)->get()->toArray();
		

		echo '
        <!DOCTYPE html>
		<table class="table table-striped">
			<tr>
				<th>
					Nama
				</th>
				<th>
					Nilai
				</th>
				<th>
					Status
				</th>
			</tr>

		';

		foreach ($data['nilai_siswa'] as $key) {
			echo '
				<tr>
					<td>
						'.$key->student_name.'
					</td>
					<td>
						'.$key->task_point.'
					</td>
					<td>
						'.$key->status.'
					</td>
				</tr>
			';
		}
		echo '</table></html>';



	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=".\Carbon\Carbon::now().".xlsx");
    
}

    public function theory(){
        $data['title'] = 'Teacher';
        $data['load'] = ['teacher/theory'];
        $data['theory'] = Theory::paginate(10);
        return view('temp/temp_guru',$data);
    }

    public function tambah_theory(){
        $data['title'] = 'Teacher';
        $data['load'] = ['teacher/theory_form'];
        $data['subjects'] = Quiz_subjects::All();
        return view('temp/temp_guru',$data);
    }

    public function edit_theory($id){
        $data['title'] = 'Teacher';
        $data['load'] = ['teacher/theory_form'];
        $data['subjects'] = Quiz_subjects::All();
        $data['theory'] = Theory::where("theory_id",$id)->get();
        return view('temp/temp_guru',$data);
    }

    public function insert_theory(Request $request)
    {
        $theory=new Theory;
        $theory->theory_name = $request->theory_name;
        $theory->theory_description = $request->theory_description;
        $theory->theory_type = $request->theory_type;
        $theory->subject_id = $request->subject_id;
        if ($request->file('theory_url')) {
		    $tujuan_upload = 'uploaded/materi';
            $request->file('theory_url')->move($tujuan_upload,$request->file('theory_url')->getClientOriginalName());
            $theory->theory_url = $request->file('theory_url')->getClientOriginalName();
        }
        $theory->save();
        return redirect('/guru/materi');
    }

    public function update_theory(Request $request)
    {
        $theory= Theory::where("theory_id", $request->theory_id)->first();
        $theory->theory_name = $request->theory_name;
        $theory->theory_description = $request->theory_description;
        $theory->save();
        return redirect('/guru/materi');
    }

    public function delete_theory(Request $request)
    {
        $delete = Theory::where("theory_id" ,$request->theory_id)->delete();
        return redirect('/guru/materi');
    }

    public function kelas_theory($theory_id=NULL)
    {
        $data['title'] = 'Data Kelas';
        $data['load'] = ['teacher/theory_kelas'];
        $data['theory'] = Theory::where('theory_id', $theory_id)->get();
        $data['kelas'] = StudentClass::All();
        $data['theory_class'] = StudentClass::join('theory_classes', 'theory_classes.student_class_id', '=', 'student_classes.student_class_id')
                            ->where('theory_classes.theory_id', $theory_id)->get();
        return view('temp/temp_guru', $data);
    }
    public function in_kelas_theory(Request $request)
    {
        $cek=TheoryClass::where('theory_id', $request->theory_id)->where('student_class_id', $request->student_class)->count();
        if($cek > 0){
            return redirect('/guru/assign-kelas/'.$request->theory_id);
        }
        else{
            TheoryClass::insert([
                'theory_class_id' => $this->genId(),
                'theory_id' => $request->theory_id,
                'student_class_id' => $request->student_class,
            ]);
            return redirect('/guru/assign-kelas/'.$request->theory_id);
        }
        
    }

    public function del_kelas_theory($id=NULL, Request $request)
    {
        TheoryClass::where("theory_class_id",$id)->forceDelete();
        return redirect('/guru/assign-kelas/'.$request->theory_id);
    }
    public function genId($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
