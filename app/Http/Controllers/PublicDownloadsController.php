<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Spatie\MediaLibrary\Media;

class PublicDownloadsController extends Controller
{

    public function downloadn($uuid) {

        $file = File::where([
            ['uuid', '=', $uuid]
            ])->first();

        $media = Media::where('model_id', $file->id)->first();
        $pathToFile = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $file->id . DIRECTORY_SEPARATOR . $media->file_name );
        $npathToFile  = public_path('files' . DIRECTORY_SEPARATOR . $media->file_name );
        copy($pathToFile, $npathToFile);

        return Response::downloadn($npathToFile);
    }
}
