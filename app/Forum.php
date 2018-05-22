<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Forum extends Model
{
    protected $table = 'forums';
    protected $fillable = ['name' , 'description', 'slug'];

    public static function boot(){
        parent::boot();

        static::creating(function($forum){
            if( !App::runningInConsole() ){
                $forum->slug = str_slug($forum->name, "-");
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function replies(){
        return $this->hasManyThrough(Reply::class, Post::class);
    }

    public function scopeSearch(Builder $query) {
        $result = $query->with(['replies', 'posts']);
        if($session = session('search')) {
            $result
                ->where('name', 'LIKE', '%' . $session . '%')
                ->orWhere('description', 'LIKE', '%' . $session . '%');
        }
        return $result->withCount(['posts', 'replies'])->paginate(4);
    }
}
