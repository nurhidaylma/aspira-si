<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EntitasSi extends Model
{
    protected $table = 'entitas_si';
    protected $primaryKey = 'id_entitas';

    protected static function getDataEntitas(){
        return DB::table('entitas_si')
            ->select('id_entitas as id_entitas' ,'nama_entitas as nama_entitas', 'status as status')
            ->get();
    }
}
