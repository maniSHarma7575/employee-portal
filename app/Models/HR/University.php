<?php

namespace App\Models\HR;

use App\Models\HR\UniversityContact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class University extends Model
{
    protected $fillable = ['name','address','rating'];

    protected $table = 'hr_universities';

    public function universityContacts()
    {
        return $this->hasMany(UniversityContact::class, 'hr_university_id');
    }
    public static function getUniversities($filteredString = false)
    {
        if (!$filteredString) {
            return self::latest()->paginate(config('constants.pagination_size'));
        }
        return self::where('name', 'like', '%'.$filteredString.'%')
            ->orWhere('address', 'like', "%$filteredString%")
            ->orWhereHas('universityContacts', function ($query) use ($filteredString) {
                $query->where('name', 'like', '%'.$filteredString.'%')
                ->orWhere('email', 'like', "%$filteredString%")
                ->orWhere('designation', 'like', "%$filteredString%")
                ->orWhere('phone', 'like', "%$filteredString%");
            })
            ->latest()->paginate(config('constants.pagination_size'));
    }

    public static function universityFilter($type=false)
    {
        $query=DB::table('hr_universities')
        ->join('hr_applicants', 'hr_applicants.hr_university_id', '=', 'hr_universities.id')
        ->join('hr_applications', 'hr_applications.hr_applicant_id', '=', 'hr_applicants.id')
        ->select('hr_universities.name', DB::raw("count(hr_applications.id) as total"));
        $query->when($type!=false, function ($query) use ($type) {
            return $query->where('hr_applications.status', $type);
        });
        return $query->groupBy('hr_universities.id')->get()->toArray();
    }
    public static function refactorArray($array)
    {
        $applications=[];
        foreach ($array as $value) {
            $applications['labels'][]=$value->name;
            $applications['data'][]=$value->total;
            $applications['backgroundColor'][]=sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }
        return $applications;
    }
    public static function getUniversitiesReports()
    {
        $applications['total']=self::refactorArray(self::universityFilter());
        $applications['approved']=self::refactorArray(self::universityFilter('approved'));
        $applications['rejected']=self::refactorArray(self::universityFilter('rejected'));
        return $applications;
    }
}
