<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    protected $fillable = [
        'title',          
        'logo',           
        'about',          
        'address',        
        'phone',          
        'email',          
        'map_embed',      
        'vision',         
        'mission',        
        'facebook_url',   
        'instagram_url',  
        'youtube_url',    
        'twitter_url',    
    ];
}
