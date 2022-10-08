<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Auth;
use DateTime;

class ArticleController extends Controller
{
    public function index(){
        $tmpdata=Article::leftJoin('users', function($join) {
            $join->on('users.id', '=', 'articles.user_id');
          })->get([
            'articles.*',
            'users.name as user_name'
        ]);
        $data=[];
        foreach ($tmpdata as $value) {
            $dt = new DateTime($value->created_at);
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
                        'header'=>$value->header,
                        'txt'=>$finalText,
                        'user_name'=>$value->user_name,
                        'created_at'=>($dt->format('Y/m/d'))

                    );
                    array_push($data,$tmp);
                    break;
                }

            }
           
        }
        return view('home',['data'=>$data]);
    }

    public function getByUser(){
        $tmpdata= Article::where('user_id', Auth::user()->id)->get();
        $data=[];
        foreach ($tmpdata as $value) {
            $dt = new DateTime($value->created_at);
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
                        'header'=>$value->header,
                        'txt'=>$finalText,
                        'created_at'=>($dt->format('Y/m/d'))

                    );
                    array_push($data,$tmp);
                    break;
                }

            }
           
        }
       
        return view('admin',['data'=>$data]);
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
        $data[0]->txt=json_decode($data[0]->txt);
        return view('single',['data'=>$data[0]]);
    }

    public function create(Request $req)
    {
        $article= new Article();
        $article->header=$req->header;
        $article->txt=$req->txt;
        $article->user_id= Auth::user()->id;
        $article->save();
        return $article;
    }
}
