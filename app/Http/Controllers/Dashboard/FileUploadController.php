<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function upload()
    {
        /*request()->validate([
            'upload' => 'mimes:webp,jpeg,jpg,gif,png,pdf,txt,doc,bmp,xls,xslx,xml,docx,svg'
        ]);*/
        $file = request()->file('upload');
        $filename = strtolower('files_' . Str::slug($file->getClientOriginalName()) . '_' . date('YmdHi') . '.' . $file->getClientOriginalExtension());
        $file->move(public_path() . '/uploads/editor/', $filename);
        $url = asset('uploads/editor/' . $filename);
        echo "<script>window.parent.CKEDITOR.tools.callFunction(1,'{$url}','')</script>";
    }
}
