<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;


class ContactController extends Controller
{
    // 問い合わせ画面の表示
    public function index()
    {
        $contacts = Contact::with('category')->get();
        $categories = Category::all();
        return view('index',compact('contacts','categories'));
    }

    // 確認ページの表示
    public function confirm(ContactRequest $request)
    {
        $tel = $request->tel1.''.$request->tel2.''.$request->tel3;
        $contact = $request->only(['first_name', 'last_name', 'category_id','gender', 'email', 'address', 'building', 'detail']);
        return view('confirm',compact('contact','tel'));
    }
    // 問い合わせデータの追加
    public function store(ContactRequest $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
        Contact::create($contact);
        return view('thanks');
    }
    // 問い合わせ内容の削除
    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }

    //検索 ※全て入れるとidとcreated_atの値だけが渡された
    public function search(Request $request)
    {
        $query = Contact::with('category');

        if($request->filled('keyword')){
            $query->KeywordSearch($request->keyword);
        }
        elseif($request->filled('gender'))
        {
            $query->GenderSearch($request->gender);
        }
        elseif($request->filled('category_id'))
        {
            $query->CategorySearch($request->category_id);
        }
        elseif($request->filled('created_at')){
            $query->CreatedSearch($request->created_at);
        }
        $contacts = $query->paginate(7);
        $categories = Category::all();

        return view('admin', compact('contacts','categories'));
    }

}
        // $contacts = Contact::with('category')
        // ->CategorySearch($request->category_id)
        // ->KeywordSearch($request->keyword)
        // ->GenderSearch($request->gender)
        // ->CreatedSearch($request->created_at)
        // ->paginate(7);
