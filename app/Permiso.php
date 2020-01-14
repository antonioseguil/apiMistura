<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permiso';
    protected $primaryKey = 'ncodpermiso';

    protected $fillable = [
        'ncodpermiso','cnombrepermiso'
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
