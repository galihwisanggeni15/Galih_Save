<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\category;

class admin extends Model
{
    use HasFactory;
    public static function GetData($table)
    {
        return DB::table($table)->get();
    }
    public static function CreateData($table, $data)
    {
        return DB::table($table)->insert($data);
    }
    public static function DeleteData($table, $data)
    {
        return DB::table($table)->delete($data);
    }
    
}
