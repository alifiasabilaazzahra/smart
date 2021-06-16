<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Session;
class Yand extends Model 
{
    public function split_date($tgl)
    {
       return date("d F Y H:i:s", strtotime($tgl));
    }

    public function tes_id($id, $where, $table)
    {
      $user_id = Auth::user()->user_id;
      $data=DB::table($table)->where($where, $id)->where('user_id', $user_id)->count();
      if ($data > 0) {
        return true;
      }
      else{
        return false;
      }
    }
}
