<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadImageTrait {
    /**
     * @param object $image 업로드 이미지
     * @return false|string
     */
    public function uploadImage($image){
        return Storage::putFileAs(
            "uploads/" . date('y-m-d'),
            $image,
            date("his")."_".$image->getClientOriginalName()
        );
    }

    /**
     * @param $path 삭제할 이미지 경로
     * @return void
     */
    public function deleteImage($path){
        Storage::delete($path);
    }
}
