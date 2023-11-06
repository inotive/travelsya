<?php

namespace App\Helpers;

use File;

trait UploadFile {

    function storeFile($file, $path)
	{
        if ( ! File::exists(storage_path('app/public/' . $path)) ) {
            File::makeDirectory(storage_path('app/public/' . $path), 0755, true, true);
        }

        $filenameWithExt = $file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = uniqid() . time().'.'.$extension;
        // Upload Image
        $path = $file->storeAs($path, $fileNameToStore, 'public');

        return $fileNameToStore;
    }

    public function deleteFile($file, $path)
    {
        if ( File::exists(storage_path('app/public/'.$path.'/'.$file)) ){
            return File::delete(storage_path('app/public/'.$path.'/'.$file));
        }

        return false;
    }
}