<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Department extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'description',
        'parent_id'
    ];

    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }

    public function childrens()
    {
        return $this->hasMany(Department::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Department::class, 'parent_id', 'id');
    }

    public function attributesLabel()
    {
        return [
            'name' => 'Tên phòng/nhóm',
            'description' => 'Mô tả',
            'parent_id' => 'Thuộc phòng/nhóm'
        ];
    }

    public function getLabel($label)
    {
        return $this->attributesLabel()[$label];
    }

    public function scopeDepartmentUser($query)
    {
        //if ($id == "") {
        //$id = Auth::user()->profile->deparment_id;
        $id = 4;
        //}

        return $query->where('id', $id);
    }

    public function countUser()
    {
        return $this->profiles->count();
    }


    public function getDepartmentTree($list, $deepLevel = 3)
    {
        if (in_array(9, $list)) {
            return 9;
        }
        $departmentList = $list;
        for ($i = 1; $i <= $deepLevel; $i++) {
            $departments = $this->_departmentTreeLoop($list);
            if (empty($departments)) {
                break;
            }
            $departmentList = array_merge($departmentList, $departments);
            $list = $departments;
        }
        return $departmentList;
    }
    private function _departmentTreeLoop($list)
    {

        $departments = Department::whereIn('parent_id', $list)->select('id')->get()->pluck('id')->toArray();

        return $departments;
    }
}
