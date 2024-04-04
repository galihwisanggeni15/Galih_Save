<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminModel extends Model
{
    use HasFactory;
    public static function GetData($table)
    {
        return DB::table($table)->get();
    }
    public static function GetDataTotal($table)
    {
        return DB::table($table)->count();
    }
    public static function GetDataIdBarangTotal($table, $id, $column)
    {
        return DB::table($table)->where($column, $id)->count();
    }
    public static function GetDataIdBarang($table, $id)
    {
        return DB::table($table)->where('id_barang', $id)->first();
    }
    public static function GetDataIdPinjaman($table, $id)
    {
        return DB::table($table)->where('id_pinjaman', $id)->first();
    }
    public static function GetDataIdUser($table)
    {
        return DB::table($table)->where('id_user', session('id_user'))->first();
    }
    public static function UpdateDataIdUser($table, $data)
    {
        return DB::table($table)->where('id_user', session('id_user'))->update($data);
    }
    public static function UpdateDataById($table, $column, $id, $data)
    {
        return DB::table($table)->where($column, $id)->update($data);
    }

    public static function UpdateDataIdBarang($table, $data, $id)
    {
        return DB::table($table)->where('id_barang', $id)->update($data);
    }
    public static function UpdateDataIdPinjaman($table, $data, $id)
    {
        return DB::table($table)->where('id_pinjaman', $id)->update($data);
    }
    public static function HapusDataIdPinjaman($table, $id)
    {
        return DB::table($table)->where('id_pinjaman', $id)->delete();
    }
    public static function HapusDataById($table, $id, $column)
    {
        return DB::table($table)->where($column, $id)->delete();
    }
    public static function joinData()
    {
        // Menjalankan query dan mengambil data
        $data = DB::table('pinjaman')
            ->join('user', 'user.id_user', '=', 'pinjaman.id_user')
            ->join('status', 'status.id_status', '=', 'pinjaman.id_status')
            ->join('barang', 'barang.id_barang', '=', 'pinjaman.id_barang')
            ->get();

        return $data; // Mengembalikan hasil query
    }
    public static function x()
    {
        // Menjalankan query dan mengambil data
        $data = DB::table('user')
            ->join('status_user', 'user.id_status', '=', 'status_user.id_status')
            ->get();

        return $data; // Mengembalikan hasil query
    }
}
