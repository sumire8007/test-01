<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;


class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::with('category')->get();
        $categories = Category::all();
        return view('index',compact('contacts','categories'));
    }

    // 確認ページの表示
    public function confirm(ContactRequest $request){
        $tel = $request->tel1.''.$request->tel2.''.$request->tel3;
        $contact = $request->only(['first_name', 'last_name', 'category_id','gender', 'email', 'address', 'building', 'detail']);
        return view('confirm',compact('contact','tel'));
    }
    // データの追加
    public function store(ContactRequest $request){
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
        Contact::create($contact);
        return view('thanks');
    }
}
