<?php

namespace App\Models\EgoModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class InstagramPost extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(Instagram::class,'insta_user_id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function post()
    {
        
        $accessToken = Instagram::find($this->user)->first()->access_token;

        $response = Http::get("https://graph.instagram.com/{$this->post_id}", [
            'fields' => 'id,caption,username,media_type,media_url,permalink,timestamp',
            'access_token' => $accessToken,
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }
}
