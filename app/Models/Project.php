<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    /**
     * Get the client that owns the project.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get details to list projects
     *
     * @return self
     */
    public static function getList()
    {
        return self::with(['client' => function ($query) {
            $query->select('id', 'name');
        }])
            ->orderBy('id', 'desc')
            ->paginate(config('constants.pagination_size'));
    }

    /**
     * Get the stages for the project.
     */
    public function stages()
    {
        return $this->hasMany(ProjectStage::class);
    }
}
