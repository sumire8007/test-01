<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail'
    ];
    public function category() {
        return $this->belongsTo(Category::class);
    }

    // 検索(キーワード検索--名前・メアド)
    public function scopeKeywordSearch($query, $keyword)
    {
        if(!empty($keyword)) {
                $query->where('first_name', 'like' ,'%' . $keyword . '%')
                ->orWhere('last_name','like','%' . $keyword . '%')
                ->orWhere('email','like','%' . $keyword . '%');
            }
    }

    //検索(性別gender)
    public function scopeGenderSearch($query, $gender)
    {
        if(!empty($gender)) {
            $query->where('gender', $gender);
        }
    }

    //検索(お問い合わせの種類category_id)
    public function scopeCategorySearch($query, $category_id)
    {
        if(!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }
    //検索(年月日)
    public function scopeCreatedSearch($query, $created_at)
    {
        if(!empty($created_at)) {
            $query->where('created_at','like','%' . $created_at . '%');
        }
    }
}
