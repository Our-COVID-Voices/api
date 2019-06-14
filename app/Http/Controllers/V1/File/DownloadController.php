<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\File;

use App\Http\Controllers\Controller;
use App\Http\Requests\File\DownloadFileRequest;
use App\Models\File;

class DownloadController extends Controller
{
    /**
     * @param \App\Http\Requests\File\DownloadFileRequest $request
     * @param \App\Models\File $file
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \App\Models\File
     */
    public function __invoke(DownloadFileRequest $request, File $file): File
    {
        $this->authorize('download', $file);

        return $file;
    }
}
