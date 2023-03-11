<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use App\Models\Scopes\StudentScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends User
{
    use CrudTrait;

    protected $table = "users";
    use HasFactory;

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope(new StudentScope);
    }

    protected function setRoleAttribute()
    {
        $this->attributes["role"] = "student";
    }

    public function Grades(): BelongsToMany
    {
        return $this->belongsToMany(Grade::class, "student_grade", "student_id", "grade_id");
    }

    public function Sups(): BelongsToMany
    {
        return $this->belongsToMany(Sup::class, "student_sup", "student_id", "sup_id");
    }
}
