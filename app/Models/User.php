<?php

namespace App\Models;

use App\Models\Drive\FileShared;
use App\Models\Drive\Folder;
use App\Models\Drive\Project;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role as Role;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Trainings\Learning;
use App\Models\Trainings\LearningSection;
use App\Models\Trainings\TrainerCertification;
use Spatie\Permission\Traits\HasPermissions;

class User extends Authenticatable 
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    //use TwoFactorAuthenticatable;
    use HasRoles;
    use HasPermissions;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    

    protected $fillable = [
        'name',
        'email',
        'password',
        'sdt',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    const TT_Hoat_Dong = 1;
    const TT_Khong_Hoat_Dong = 0;
    const EMPLOYEE = 1;
    const PUBLIC_USER = 2;
    protected static function booted()
    {
        static::created(function ($user) {
            // dd($user);
            // if ($user->type == 2) {
            //     //user đăng ký
            //     $role = Role::firstOrCreate(['name' => 'User']);
            //     $user->assignRole($role);
            // } else {
            //     $role = Role::firstOrCreate(['name' => 'Employee']);
            //     $user->assignRole($role);
            // }

            // $profile = new Profile();
            // $profile->user_id = $user->id;
            // $profile->full_name = $user->name;
            // $profile->gender = 1;
            // $profile->save();
        });
    }

    public function scopeActiveEmployees($query)
    {
        return $query->where('status', self::TT_Hoat_Dong)
                     ->where('type', self::EMPLOYEE)
                     ->whereNotIn('id', [94, 138, 197]);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    /**
     * return str role's names
     */
    public function roleNames()
    {
       
        $roles = $this->roles->pluck('label')->toArray();
        return implode(', ', $roles);
    }

   
    /**
     * return collection
     */
    public function employeeList()
    {
        $employeeList = self::select(['id','name'])
        //->where('type',self::EMPLOYEE)
        ->get();
        return $employeeList;
    }

    public function departmentEmployeeList() {
        $employeeList = self::select(['id','name'])
        ->where('type',self::EMPLOYEE)
        ->get();
        return $employeeList;
    }

    public function userList()
    {
        $userList = self::select(['id','name'])->get();
        return $userList;
    }

    public function nhanVien()
    {
        return $this->hasOne(NhanVien::class, 'user_id', 'id');
    }

    /**
     * lay nhan vien ID
     */
    public function nhanVienID() : int
    {
        if($this->nhanVien == null) 
            return 0;
        return $this->nhanVien->id;
    }

    public function viTri(){
        return $this->hasOne(Vitri::class,'id_user','id');
    }

    public function isViTri($viTriKiemTra)
    {
        $viTriUser = $this->viTri;
        $listIDCapDuoi = $this->listIdCapDuoi($viTriUser);
        
        return in_array($viTriKiemTra->id, $listIDCapDuoi);
        
    }

    public function isCapTren($viTriKiemTra)
    {
        $viTriUser = $this->viTri;
        $listIDCapDuoi = $this->listIdCapDuoi($viTriUser);
        unset($listIDCapDuoi[0]);
        return in_array($viTriKiemTra->id, $listIDCapDuoi);
        
    }

    public function listIdCapDuoi($viTri)
    {
        $listID = [$viTri->id];
        if($viTri->capDuoi->isNotEmpty()){
            foreach ($viTri->capDuoi as $capDuoi) {
                // Gọi đệ quy để lấy danh sách ID cấp dưới của viTri
                $listID = array_merge($listID, $this->listIdCapDuoi($capDuoi));
            }
        }

       return $listID;
    }
 

}
