<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;//追記
use Illuminate\Support\Facades\Validator;//追記

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //モデル名::all() モデルのレコードを全て取得
        //変数$tasksに入れ、viewファイルに渡す
        // $tasks = Task::all(); 全て表示
        $tasks = Task::where('status' , false)->get();
        return view('tasks.index' , compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'task_name' => 'required | max:100',
        ];

        //[バリデーションルールの名前 => エラーメッセージ]
        $messages = ['required' => '必須項目です' , 'max' => '100文字以下にしてください。'];

        //Validator::make($request->all(),バリデーションルール,エラーメッセージ);
        //バリデーションに引っ掛かれば以降は実行されない
        Validator::make($request->all(), $rules, $messages)->validate();


        //モデルをインスタンス化
        $task = new Task;

        //モデル->カラム名 = 値　で、データを割り当てる
        $task->name = $request->input('task_name');

        //データベースに保存
        $task->save();

        //リダイレクト
        return redirect('/tasks');

        // ・$request->input('フォームのキーの名前')
        // $task_name = $request->input('task_name');
        // ・デバック用処理。dd以降の処理は実行されない
        // dd($task_name);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //GETで「/tasks/タスクのID/edit」というアクセスがあった場合
        //モデル名::find(整数);
        //findでテーブルの「id」カラムから指定の番号(整数)のものを検索する(プライマリーキーであることが前提)
        $task = Task::find($id);
        return view('tasks.edit' , compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->status);　確認用

        //「編集する」ボタンを押した時
        if($request->status === null) {
        $rules = [
            'task_name' => 'required|max:100',
          ];
        
          $messages = ['required' => '必須項目です', 'max' => '100文字以下にしてください。'];
        
          Validator::make($request->all(), $rules, $messages)->validate();
        
        
          //該当のタスクを検索
          $task = Task::find($id);
        
          //モデル->カラム名 = 値 で、データを割り当てる
          $task->name = $request->input('task_name');
        
          //データベースに保存
          $task->save();
        }else{
        //「完了」ボタンを押した時

        //該当のタスクを検索
        $task = Task::find($id);

        //モデル->カラム名 = 値 で、データを割り当てる
        $task->status = true; //true:完了、false:未完了

        //データベースに保存
        $task->save();
        }
        //リダイレクト
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Task::find($id)->delete();

        return redirect('/tasks');
    }
}
