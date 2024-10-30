<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $fileName = time() . '-' . $request->file('file')->getClientOriginalName();
            
            // Sử dụng disk 'public' đã được cấu hình
            $request->file('file')->storeAs('images', $fileName, 'public');
            
            // Đường dẫn URL trả về
            $url = '/storage/images/' . $fileName;
            
            return response()->json([
                'success' => true,
                'path' => $url
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'File not found!'
        ], 400);
    }
}
