<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminModel extends Model
{
    use HasFactory;
    public static function GetData($table)
    {
        return DB::table($table)->get();
    }
    public static function GetDataById($table, $column, $data)
    {
        return DB::table($table)->where($column, $data)->get();
    }
    public static function GetDataByIdF($table, $column, $data)
    {
        return DB::table($table)->where($column, $data)->first();
    }
    public static function InsertData($table, $data)
    {
        return DB::table($table)->insert($data);
    }
    public static function UpdateDataById($table, $column, $value, $data)
    {
        return DB::table($table)->where($column, $value)->update($data);
    }

    public static function DeleteDataById($table, $column, $value)
    {
        return DB::table($table)->where($column, $value)->delete();
    }
    public static function joinDataUser()
    {
        // Menjalankan query dan mengambil data
        return DB::table('user')
            ->select('status_user.*', 'role.*', 'user.*')
            ->join('status_user', 'status_user.id_status', '=', 'user.id_status')
            ->join('role', 'role.id_role', '=', 'user.id_role')
            ->where('user.id_role', '2')
            ->get();
    }
    public static function joinDataPengaduan()
    {
        // Menjalankan query dan mengambil data
        return DB::table('pengaduan')
            ->select('status_pengaduan.*', 'pengaduan.*', 'user.*')
            ->join('status_pengaduan', 'status_pengaduan.id_status', '=', 'pengaduan.id_status')
            ->join('user', 'user.id_user', '=', 'pengaduan.id_user')
            ->get();
    }
    public static function joinDataPengaduan2($data)
    {
        // Retrieve data from multiple tables using joins
        return DB::table('pengaduan')
            ->select('status_pengaduan.*', 'pengaduan.*', 'user.*')
            ->join('status_pengaduan', 'status_pengaduan.id_status', '=', 'pengaduan.id_status')
            ->join('user', 'user.id_user', '=', 'pengaduan.id_user')
            ->where('pengaduan.kode_pengaduan', $data)
            ->first();
    }
    public static function joinDataPengaduan3($data)
    {
        // Retrieve data from multiple tables using joins
        return DB::table('pengaduan')
            ->select('status_pengaduan.*', 'pengaduan.*', 'user.*')
            ->join('status_pengaduan', 'status_pengaduan.id_status', '=', 'pengaduan.id_status')
            ->join('user', 'user.id_user', '=', 'pengaduan.id_user')
            ->where('pengaduan.id_pengaduan', $data)
            ->first();
    }
}
