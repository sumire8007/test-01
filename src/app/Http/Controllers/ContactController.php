<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view('index');
    }

    // 確認ページの表示
    public function confirm(Request $request){
        $tel = $request->tel1.''.$request->tel2.''.$request->tel3;
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'address', 'building', 'category', 'detail']);
        return view('confirm',compact('contact','tel'));
    }
    // データの追加
    public function store(Request $request){
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'category', 'detail']);
    }
}
