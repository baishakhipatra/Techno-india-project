<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


if(!function_exists('generateSlug')){
    function generateSlug($title,$table){
        $slug = Str::slug($title, '_');
        $originalSlug = $slug;

        $count =1;
        while (DB::table($table)->where('slug',$slug)->exists())
        {
            $slug = $originalSlug. '_' .$count;
            $count++;
        }
        return $slug;
    }
}
?>