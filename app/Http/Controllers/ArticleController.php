<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Auth;
use DateTime;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ArticleController extends Controller
{
    public function index(){
        $tmpdata=Article::leftJoin('users', function($join) {
            $join->on('users.id', '=', 'articles.user_id');
          })->get([
            'articles.*',
            'users.name as user_name'
        ]);
        $data=$this->prepareData($tmpdata);
        return view('home',['data'=>$data]);
    }

    public function getByUser(){
        $tmpdata= Article::where('user_id', Auth::user()->id)->get();
        $data=$this->prepareData($tmpdata);
        return view('admin',['data'=>$data]);
    }

    private function prepareData($tmpdata){
        $data=[];
        foreach ($tmpdata as $value) {
            $dt =( new DateTime($value->created_at))->format('Y/m/d');
            $value->created_at=$dt;
            $decodedText=json_decode($value->txt);
            $blocks=$decodedText->blocks;
            foreach ($blocks as $block) {
                if($block->type=='paragraph')
                {
                    $finalText=$block->data->text;
                    if( strlen($finalText)>100)
                    {
                        $finalText=substr($finalText,0,99);
                    }
                    $tmp = array(
                        'id'=>$value->id,
                        'slug'=>$value->slug,
                        'header'=>$value->header,
                        'txt'=>$finalText,
                        'user_name'=>$value->user_name,
                        'created_at'=>$dt,
                    );
                    array_push($data,$tmp);
                    break;
                }

            }  
            if(!array_filter($data, function($item) use($value) { 	    return isset($item['id']) && $value->id == $item['id']; 	})){
                $value->txt='';
                array_push($data,$value);
            }
        }
        return $data;
    }
    public function getById(Request $req){
        $data=Article::where('articles.id', $req->id)->leftJoin('users', function($join) {
            $join->on('users.id', '=', 'articles.user_id');
          })->get([
            'articles.*',
            'users.name as user_name'
        ]);
        $dt = new DateTime($data[0]->created_at);
        $data[0]->created_at=($dt->format('Y/m/d'));
        $decodedText=json_decode($data[0]->txt);
        //data[0]->txt
        $blocks=[];

        foreach ($decodedText->blocks as $block) {
            if($block->type=='gif')
            {
                foreach ($block->data as $d) {
                    $tmp=clone($d);
                $tmp ->id=$d->id;
                $tmp ->type='gif';
                $tmp ->data=$d;
                array_push($blocks,$tmp);
            }
            }else{
                array_push($blocks,$block);
            }

        }
        $decodedText->blocks=$blocks;
        $data[0]->txt=$decodedText;
        return view('single',['data'=>$data[0]]);
    }

    public function create(Request $req)
    {
        $slug = SlugService::createSlug(Article::class, 'slug', request('header'));
        $article= new Article();
        $article->header=$req->header;
        $article->txt=$req->txt;
        $article->user_id= Auth::user()->id;
        $article->slug=$slug;
        $article->save();
        return $article;
    }
     
    public function getByURL(Request $req){
        $data=Article::where('articles.slug', $req->slug)->leftJoin('users', function($join) {
            $join->on('users.id', '=', 'articles.user_id');
          })->get([
            'articles.*',
            'users.name as user_name'
        ]);
        $dt = new DateTime($data[0]->created_at);
        $data[0]->created_at=($dt->format('Y/m/d'));
        $decodedText=json_decode($data[0]->txt);
        //data[0]->txt
        $blocks=[];

        foreach ($decodedText->blocks as $block) {
            if($block->type=='gif')
            {
                foreach ($block->data as $d) {
                    $tmp=clone($d);
                $tmp ->id=$d->id;
                $tmp ->type='gif';
                $tmp ->data=$d;
                array_push($blocks,$tmp);
            }
            }else{
                array_push($blocks,$block);
            }

        }
        $decodedText->blocks=$blocks;
        $data[0]->txt=$decodedText;
        return view('single',['data'=>$data[0]]);
    }
}
