<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Profile extends Model
{
    use HasFactory;
    protected $table="profiles";
    public $fillable = [
        'full_name',
        'birthday',
        'gender',
        'phone',
        'address',
        'province_id',
        'district_id',
        'workplace',
        'department_id',
        'position'
    ];

 
    // protected $dateFormat = 'd/m/Y';

    // public function setBirthdayAttribute( $value ) {
    //     $this->attributes['date'] = (new Carbon($value))->format('d/m/y');
    //   }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

   
    public function showLink()
    {
        return route('detail-profile.show', $this);
    }

    public function showProfileLink()
    {
        return route('my-profile.show', $this);
    }

    public function attributesLabel()
    {
        return [
            'full_name' => 'Họ và tên',
            'birthday' => 'Ngày sinh',
            'gender' => 'Giới tính',
            'phone' => 'Điện thoại',
            'address' => 'Địa chỉ',
            'district_id' => 'Quận/Huyện',
            'province_id' => 'Tỉnh/Thành phố',
            'workplace' => 'Nơi công tác',
            'department_id' => 'Phòng',
            'position' => 'Chức vụ'
        ];
    }

    public function getLabel($label)
    {
        return $this->attributesLabel()[$label];
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            if ($model->birthday != "") {
                $birthday = str_replace("/", "-", $model->birthday);
                $model->birthday = date('Y-m-d', strtotime($birthday));
            }
        });

        self::created(function ($model) {
            if ($model->birthday != "") {
                $birthday = str_replace("-", "/", $model->birthday);
                $model->birthday = date('d-m-Y', strtotime($birthday));
            }
        });

        self::updating(function ($model) {
            if ($model->birthday != "") {
                $birthday = str_replace("/", "-", $model->birthday);
                $model->birthday = date('Y-m-d', strtotime($birthday));
            }
        });

        self::updated(function ($model) {
            if ($model->birthday != "") {
                $birthday = str_replace("-", "/", $model->birthday);
                $model->birthday = date('d-m-Y', strtotime($birthday));
            }
        });

        // self::deleting(function($model){
        //     // ... code here
        // });

        // self::deleted(function($model){
        //     // ... code here
        // });
    }

    public function dateOfBirth()
    {
        if ($this->birthday == "") {
            return "<i>Chưa cập nhật</i>";
        } else {
            $birthday = date("d-m-Y", strtotime($this->birthday));
            return str_replace("-", "/", $birthday);
        }
    }

    // /**
    //  * return collection
    //  */
    // public function profileList()
    // {
    //     $employeeList = self::select(['id','name'])
    //     //->where('type',self::EMPLOYEE)
    //     ->get();
    //     return $employeeList;
    // }

}
