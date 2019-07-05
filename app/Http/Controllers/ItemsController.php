<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Item;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use Illuminate\Support\Facades\File;
use JD\Cloudder\Facades\Cloudder;

class ItemsController extends Controller
{
    public function index() {
        $items = Item::latest('created_at')->get();
        return view('items.index', compact('items'));
    }

    public function show($id) {
        $item = Item::findOrFail($id);
        return view('items.show', compact('item'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(ItemRequest $request) {
        //まずimage以外のpostデータを$dataに代入　imageは入ってこない
        $data = $request->validated();
        //dd($data);
        if ($file = $request->file('thefile')) {
            $file_name = $file->getRealPath();
            //file名にするための日時を取得
            // $file_name = date('Y-m-d H:i:s');
            //cloudinaryにupload
            Cloudder::upload($file_name, null);
            // 直前にアップロードした画像のユニークIDを取得します。
            $publicId = Cloudder::getPublicId();
            // dump($publicId);
            //laravelにアップロードして保存
            // $temp_path = $request->file('thefile')->storeAs('public/images', $file_name.'.jpeg');
            //読込先と保存先が異なるので、bladeで表示させるためのファイルパスに変換
            // $read_path = str_replace('public/', 'storage/', $temp_path);
            //データベースにまとめて保存するため、配列に$read_path(imageファイルのパス)を追加
            $data['image'] = $publicId;
        }
        Item::create($data);
        \Flash::success('商品を登録しました。');
        return redirect()->route('items.index');

    }

    public function edit($id) {

        $item = Item::findOrFail($id);
        return view('items.edit', compact('item'));
    }

    public function update(ItemRequest $request, $id) {
        $item = Item::findOrFail($id);
        $publicId = $item->image;
        $data = $request->validated();
        if ($file = $request->file('thefile')) {
            if (!is_null($publicId)) {
              // \Cloudinary\Uploader::destroy($publicId);
                Cloudder::destroyImage($publicId, null);
                Cloudder::delete($publicId, null);
                //dump($publicId);
            };
            //dd($data);
            $file_name = $file->getRealPath();
            Cloudder::upload($file_name, null);
            $publicId = Cloudder::getPublicId();
            $data['image'] = $publicId;
            // File::delete($image);
            // $temp_path = $request->file('thefile')->storeAs('public/images', $item['created_at'].'.jpeg');
            // $read_path = str_replace('public/', 'storage/', $temp_path);
            // $data['image'] = $read_path;

        }
        $item->update($data);

        \Flash::success('商品を更新しました。');
        return redirect()->route('items.show', [$item->id]);

    }
    public function destroy($id) {
        $item = Item::findOrFail($id);
        $publicId = $item->image;
        Cloudder::destroyImage($publicId);
        Cloudder::delete($publicId);
        $item->delete();
        //laravel_shopping内の写真fileも削除する
        // File::delete($image);
        \Flash::success('商品を削除しました。');
        return redirect()->route('items.index');
    }

    public function __construct()
    {
        $this->middleware('auth')
        ->except(['index', 'show']);
    }
}
