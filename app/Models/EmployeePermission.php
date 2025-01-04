<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class EmployeePermission extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    // العلاقة مع نموذج Permission
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
