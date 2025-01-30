<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Date;
use Symfony\Component\HttpFoundation\StreamedResponse;


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
        $category = Category::find($request->category_id);
        return view('confirm',compact('contact','tel','category'));
    }

    //修正ページ

    // 問い合わせデータの追加
    public function store(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
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

    //csv エクスポート
    public function export(Request $request)
    {
        $query = Contact::query();
        //検索したものだけを入れてる？
        $query = $this->getSearchQuery($request, $query);
        //csvDataという変数に全件取得し、配列？
        $csvData = $query->get()->toArray();
        //csvヘッダー項目作成↓
        $csvHeader = [
            'id', 'category_id', 'first_name', 'last_name', 'gender', 'email', 'tell', 'address', 'building', 'detail', 'created_at', 'updated_at'
        ];

        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $createCsvFile = fopen('php://output', 'w');

            mb_convert_variables('SJIS-win', 'UTF-8', $csvHeader);

            fputcsv($createCsvFile, $csvHeader);

            foreach ($csvData as $csv) {
                $csv['created_at'] = Date::make($csv['created_at'])->setTimezone('Asia/Tokyo')->format('Y/m/d H:i:s');
                $csv['updated_at'] = Date::make($csv['updated_at'])->setTimezone('Asia/Tokyo')->format('Y/m/d H:i:s');
                fputcsv($createCsvFile, $csv);
            }

            fclose($createCsvFile);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ]);

        return $response;
    }
}
