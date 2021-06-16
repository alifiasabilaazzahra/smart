<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Yand;
use App\Quiz;
use App\Teacher;
use App\TeacherSubject;
use App\Quiz_category;
use App\Quiz_class;
use App\Quiz_point;
use App\Quiz_question_option;
use App\Quiz_question;
use App\Quiz_schedule;
use App\Quiz_subjects;
use App\Student;
use App\StudentClass;
use App\User;
use App\Schedule;
class AdminController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->role = Auth::user()->is_role; 

            $this->user_id = Auth::user()->user_id;
            if(Auth::user()->is_role != 'Admin'){
                return redirect('/home');
            }
            return $next($request);
           });
    }

    //SHOW
    public function index(){
        $data['title'] = 'Admin';
        $data['load'] = ['admin/dashboard'];
        $data['jumlah_teacher']=Teacher::count();
        $data['jumlah_student']=Student::count();
        $data['jumlah_class']=StudentClass::count();
        return view('temp/temp_admin',$data);
    }

    public function kategori_tugas(){
        $data['title'] = 'Kategori Tugas';
        $data['load'] = ['admin/kategori_tugas'];
        $data['jumlah_kategori_tugas']=Quiz_category::count();
        $data['kategori_tugas'] = Quiz_category::paginate(10);
        return view('temp/temp_admin',$data);
    }

    public function mata_pelajaran(){
        $data['title'] = 'Mata Pelajaran';
        $data['load'] = ['admin/mata_pelajaran'];
        $data['jumlah_mata_pelajaran']=Quiz_subjects::count();
        $data['mata_pelajaran'] = Quiz_subjects::paginate(10);
        return view('temp/temp_admin',$data);
    }

    public function kelas(){
        $data['title'] = 'Kelas';
        $data['load'] = ['admin/kelas'];
        $data['jumlah_kelas']=StudentClass::count();
        $data['kelas'] = StudentClass::paginate(10);
        return view('temp/temp_admin',$data);
    }

    public function siswa(Request $request){
        $data['title'] = 'Siswa';
        $data['load'] = ['admin/siswa'];
        $data['jumlah_siswa']=Student::count();
        $data['kelas'] = StudentClass::all();
        $kelas = $request->get('student_class_id', false);
        $data['siswa'] = Student::when($kelas, function($query) use ($kelas){
            return $query->where('student_class_id', $kelas);
        })->paginate(10);
        return view('temp/temp_admin',$data);
    }

    public function guru(Request $request){
        $data['title'] = 'Guru';
        $data['load'] = ['admin/guru'];
        $data['jumlah_guru']=Teacher::count();
        $data['guru'] = Teacher::paginate(10);
        return view('temp/temp_admin',$data);
    }

    public function jadwal(Request $request){
        $data['title'] = 'Penjadwalan';
        $data['load'] = ['admin/jadwal'];
        $data['jumlah_jadwal']=Schedule::count();
        $data['jadwal'] = Schedule::paginate(10);
        return view('temp/temp_admin',$data);
    }

    public function tambah_kategori_tugas(){
        $data['title'] = 'Kategori Tugas';
        $data['load'] = ['admin/kategori_tugas_form'];
        return view('temp/temp_admin',$data);
    }

    public function tambah_mata_pelajaran(){
        $data['title'] = 'Mata Pelajaran';
        $data['load'] = ['admin/mata_pelajaran_form'];
        return view('temp/temp_admin',$data);
    }

    public function tambah_kelas(){
        $data['title'] = 'Kelas';
        $data['load'] = ['admin/kelas_form'];
        return view('temp/temp_admin',$data);
    }

    public function tambah_siswa(){
        $data['title'] = 'Siswa';
        $data['load'] = ['admin/siswa_form'];
        $data['kelas'] = StudentClass::all();
        return view('temp/temp_admin',$data);
    }

    public function tambah_guru(){
        $data['title'] = 'Guru';
        $data['load'] = ['admin/guru_form'];
        return view('temp/temp_admin',$data);
    }

    public function tambah_jadwal(){
        $data['title'] = 'Penjadwalan';
        $data['load'] = ['admin/jadwal_form'];
        $data['guru'] = Teacher::all();
        $data['mapel'] = Quiz_subjects::all();
        $data['kelas'] = StudentClass::all();
        return view('temp/temp_admin',$data);
    }

    public function perbarui_kategori_tugas($id=NULL){
        $data['title'] = 'Kategori Tugas';
        $data['load'] = ['admin/kategori_tugas_form'];
        $data['kategori_tugas'] = Quiz_category::where('task_category_id',$id)->get();
        return view('temp/temp_admin',$data);
    }

    public function perbarui_mata_pelajaran($id=NULL){
        $data['title'] = 'Mata Pelajaran';
        $data['load'] = ['admin/mata_pelajaran_form'];
        $data['mata_pelajaran'] = Quiz_subjects::where('subject_id',$id)->get();
        return view('temp/temp_admin',$data);
    }

    public function perbarui_kelas($id=NULL){
        $data['title'] = 'Kelas';
        $data['load'] = ['admin/kelas_form'];
        $data['kelas'] = StudentClass::where('student_class_id',$id)->get();
        return view('temp/temp_admin',$data);
    }

    public function perbarui_siswa($id=NULL){
        $data['title'] = 'Siswa';
        $data['load'] = ['admin/siswa_form'];
        $data['kelas'] = StudentClass::all();
        $data['siswa'] = User::where('user_id',$id)->get();
        return view('temp/temp_admin',$data);
    }

    public function perbarui_guru($id=NULL){
        $data['title'] = 'Guru';
        $data['load'] = ['admin/guru_form'];
        $data['guru'] = User::where('user_id',$id)->get();
        return view('temp/temp_admin',$data);
    }

    public function perbarui_jadwal($id=NULL){
        $data['title'] = 'Penjadwalan';
        $data['load'] = ['admin/jadwal_form'];
        $data['jadwal'] = Schedule::where('schedule_id',$id)->get();
        $data['guru'] = Teacher::all();
        $data['mapel'] = Quiz_subjects::all();
        $data['kelas'] = StudentClass::all();
        return view('temp/temp_admin',$data);
    }

    public function mapel_guru($teacher_id=NULL)
    {
        $data['title'] = 'Data Mapel';
        $data['load'] = ['admin/guru_mapel'];
        $data['guru'] = Teacher::where('teacher_id', $teacher_id)->get();
        $data['mapel'] = Quiz_subjects::All();
        $data['guru_mapel'] = TeacherSubject::join('subjects', 'subjects.subject_id', '=', 'teacher_subjects.subject_id')
                                            ->where('teacher_subjects.teacher_id', $teacher_id)->get();
        return view('temp/temp_admin', $data);
    }
    
    //REST
        //Insert
    public function insert_kategori_tugas(Request $request)
    {
        $quizCategory=new Quiz_category;
        $quizCategory->task_category_name = $request->task_category_name;
        $quizCategory->task_category_description = $request->task_category_description;
        $quizCategory->save();
        return redirect('/admin/kategori_tugas');
    }

    public function insert_mata_pelajaran(Request $request)
    {
        $quizSubject = new Quiz_subjects;
        $id = "MP-".rand(0,1000000);
        $quizSubject->subject_id = $id;
        $quizSubject->subject_name = $request->subject_name;
        $quizSubject->subject_description = $request->subject_description;
        $quizSubject->save();

        return redirect('/admin/mata_pelajaran');
    }

    public function insert_kelas(Request $request)
    {
        $studentClass = new StudentClass;
        $id = "KL-".rand(0,1000000);
        $studentClass->student_class_id = $id;
        $studentClass->student_class_name = $request->student_class_name;
        $studentClass->student_class_description = $request->student_class_description;
        $studentClass->save();

        return redirect('/admin/kelas');
    }

    public function insert_siswa(Request $request)
    {
        $user = new User;
        $user->role = 0;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $students = new Student;
        $students->student_id = $request->student_id;
        $students->user_id = $user->user_id;
        $students->student_class_id = $request->student_class_id;
        $students->student_name = $request->student_name;
        $students->student_gender = $request->student_gender;
        $students->student_status = "Belum Lulus";
        $students->student_start = $request->student_start;
        $students->save();

        return redirect('/admin/siswa');
    }

    public function insert_guru(Request $request)
    {
        $user = new User;
        $user->role = 1;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $teachers = new Teacher;
        $teachers->teacher_id = $request->teacher_id;
        $teachers->user_id = $user->user_id;
        $teachers->name = $request->name;
        $teachers->save();

        return redirect('/admin/guru');
    }

    public function insert_jadwal(Request $request)
    {
        $schedule = new Schedule;
        $schedule->teacher_id = $request->teacher_id;
        $schedule->student_class_id = $request->student_class_id;
        $schedule->subject_id = $request->subject_id;
        $schedule->schedule_start = date("Y-m-d H:i:s", strtotime($request->schedule_start));
        $schedule->schedule_end = date("Y-m-d H:i:s", strtotime($request->schedule_end));
        $schedule->save();

        return redirect('/admin/jadwal');
    }
        //Update
    public function update_kategori_tugas(Request $request)
    {
        $quizCategory = Quiz_category::where('task_category_id',$request->task_category_id)->first();
        $quizCategory->task_category_name = $request->task_category_name;
        $quizCategory->task_category_description = $request->task_category_description;
        $quizCategory->save();
        return redirect('/admin/kategori_tugas');
    }

    public function update_mata_pelajaran(Request $request)
    {
        $quizSubject = Quiz_subjects::where('subject_id',$request->subject_id)->first();
        $quizSubject->subject_name = $request->subject_name;
        $quizSubject->subject_description = $request->subject_description;
        $quizSubject->save();
        return redirect('/admin/mata_pelajaran');
    }

    public function update_kelas(Request $request)
    {
        $studentClass = StudentClass::where('student_class_id',$request->student_class_id)->first();
        $studentClass->student_class_name = $request->student_class_name;
        $studentClass->student_class_description = $request->student_class_description;
        $studentClass->save();
        return redirect('/admin/kelas');
    }

    public function update_siswa(Request $request)
    {
        $user = User::where('user_id', $request->user_id)->first();
        if ($user) {
            if ($request->password !== $user->password) {
                $user->password = bcrypt($request->password);
                $user->save();
            }

            $students = Student::where('user_id',$request->user_id)->first();
            $students->student_class_id = $request->student_class_id ? $request->student_class_id : $students->student_class_id;
            $students->student_name = $request->student_name ? $request->student_name : $students->student_name;
            $students->student_gender = $request->student_gender ? $request->student_gender : $students->student_gender;
            $students->student_status = $request->student_status;
            $students->student_start = $request->student_start ? $request->student_start : $students->student_start;
            $students->student_end = $request->student_status === "Lulus" ? date("Y") : ($request->student_end ? $request->student_end : $students->student_end);
            $students->save();
        }
        return redirect('/admin/siswa');
    }

    public function update_guru(Request $request)
    {
        $user = User::where('user_id', $request->user_id)->first();
        if ($user) {
            if ($request->password !== $user->password) {
                $user->password = bcrypt($request->password);
                $user->save();
            }

            $teachers = Teacher::where('user_id',$request->user_id)->first();
            $teachers->name = $request->name ? $request->name : $teachers->name;
            $teachers->save();
        }
        return redirect('/admin/guru');
    }

    public function update_jadwal(Request $request)
    {
        $schedule = Schedule::where('schedule_id',$request->schedule_id)->first();
        $schedule->teacher_id = $request->teacher_id;
        $schedule->student_class_id = $request->student_class_id;
        $schedule->subject_id = $request->subject_id;
        $schedule->schedule_start = date("Y-m-d H:i:s", strtotime($request->schedule_start));
        $schedule->schedule_end = date("Y-m-d H:i:s", strtotime($request->schedule_end));
        $schedule->save();
        return redirect('/admin/jadwal');
    }

        //Delete
    public function delete_kategori_tugas(Request $request)
    {
        Quiz_category::where('task_category_id',$request->task_category_id)->delete();
        return redirect('/admin/kategori_tugas');
    }

    public function delete_mata_pelajaran(Request $request)
    {
        Quiz_subjects::where('subject_id',$request->subject_id)->delete();
        return redirect('/admin/mata_pelajaran');
    }

    public function delete_kelas(Request $request)
    {
        StudentClass::where('student_class_id',$request->student_class_id)->delete();
        return redirect('/admin/kelas');
    }

    public function delete_siswa(Request $request)
    {
        User::where('user_id',$request->user_id)->delete();
        return redirect('/admin/siswa');
    }

    public function delete_guru(Request $request)
    {
        User::where('user_id',$request->user_id)->delete();
        return redirect('/admin/guru');
    }

    public function delete_jadwal(Request $request)
    {
        Schedule::where('schedule_id',$request->schedule_id)->delete();
        return redirect('/admin/jadwal');
    }

    public function in_mapel_guru(Request $request)
    {
        $cek=TeacherSubject::where('teacher_id', $request->teacher_id)->where('subject_id', $request->subject)->count();
        if($cek > 0){
            return redirect('/admin/assign-mapel/'.$request->teacher_id);
        }
        else{
            TeacherSubject::insert([
                'teacher_subject_id' => $this->genId(),
                'teacher_id' => $request->teacher_id,
                'subject_id' => $request->subject,
            ]);
            return redirect('/admin/assign-mapel/'.$request->teacher_id);
        }
        
    }

    public function del_mapel_guru($id=NULL, Request $request)
    {
        TeacherSubject::where("teacher_subject_id",$id)->forceDelete();
        return redirect('/admin/assign-mapel/'.$request->teacher_id);
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
