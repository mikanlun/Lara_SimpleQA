<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Validator;

use App\User;
use App\Question;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 認可中のユーザー情報を取得
        $user = User::find($id);
        if (is_null($user) || (Auth::user()->id != $id)) {
            // ユーザー情報が無い時又は認可中のユーザーの異なる時トップページに戻る
            return redirect("/");
        }

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 認可中のユーザー情報を取得
        $user = User::find($id);
        if (is_null($user) || (Auth::user()->id != $id)) {
            // ユーザー情報が無い時又は認可中のユーザーの異なる時トップページに戻る
            return redirect("/");
        }

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $validator =Validator::make($request->all(), User::$rulesUpdate);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        // メールアドレス
        $newEmail = $request->email;
        if ($newEmail == Auth::user()->email) {
            // 変更なし
            $email = Auth::user()->email;
        } else {
            // 変更あり
            if (User::where('email', $newEmail)->first()) {
                // 使用済み
                $validator->errors()->add('email', $newEmail .  __('messages.email.exists'));

            } else {

                $email = $newEmail;
            }
        }

        // パスワード
        $newPassword = $request->password;

        if (is_null($newPassword)) {
            // 変更なし
            $password = Auth::user()->password;

        } else {
            // 変更あり
            if (strlen($newPassword) < 8) {
                $validator->errors()->add('password', __('messages.password.min'));

            } else {
                $password = Hash::make($newPassword);
            }
        }

        // プロフィール画像
        if ($request->hasFile('image')) {
            // プロフィール画像を更新
            // 既存のプロフィール画像を削除
            $now_image = Auth::user()->email . '-' . Auth::user()->image;
            if (Storage::disk('public')->exists('images/' . $now_image)) {
                Storage::delete('public/images/' . $now_image);
            }
            // 新しいプロフィール画像を登録
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images/', $email . '-' . $file_name);
        } else {
            // 既存のプロフィール画像名
            $file_name = Auth::user()->image;
            if ($email != Auth::user()->email && !is_null($file_name)) {
                // メールアドレス変更　かつ　画像が登録されている時、ファイル名を変更
                $now_image = Auth::user()->email . '-' . $file_name;
                $new_image = $email . '-' . $file_name;
                Storage::move('public/images/' . $now_image, 'public/images/' . $new_image);
            }
        }

        // バリデーション
        if (count($validator->errors())) {

            return back()->withInput()->withErrors($validator);
        }

        // 認可中のユーザー変更情報保存
        $newUser = [
            'name' => $request->name,
            'email' => $email,
            'password' => $password,
            'image' => $file_name,
        ];

        // 認可中のユーザー情報を取得
        $user = User::find($id);
        $user->fill($newUser)->save();

        return redirect("/");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 認可中のユーザー情報を取得
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;

        // 認可中のユーザー情報を削除
        $questions = Question::where('user_id', $user_id)->get();
        foreach ($questions as $question) {
            Question::find($question->id)->delete();
        }
        User::find($user_id)->delete();

        // 既存のプロフィール画像を削除
        $now_image = Auth::user()->email . '-' . Auth::user()->image;
        if (Storage::disk('public')->exists('images/' . $now_image)) {
            Storage::delete('public/images/' . $now_image);
        }

        Auth::logout();

        return view('user.destroy', compact('user_name'));

    }
}
