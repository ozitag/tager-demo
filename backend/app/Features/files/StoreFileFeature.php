<?php
namespace App\Features\files;

use App\Features\Feature;
use App\Http\Requests\Api\Admin\files\ImageUploadRequest;
use App\Repositories\Eloquent\FileRepository;
use Illuminate\Support\Facades\Storage;

class StoreFileFeature extends Feature
{
    private $folder;

    public function __construct($folder = 'images')
    {
        $this->folder = $folder;
    }

    /**
     * @param ImageUploadRequest $request
     * @param FileRepository $repository
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function handle(ImageUploadRequest $request, FileRepository $repository){
        $path = Storage::putFile($this->folder, $request->file);
        return $repository->fillAndSave([
            'path' => $path,
            'size' => Storage::size($path),
            'extension' => $request->file->getClientOriginalExtension(),
            'filename' => $request->file->getClientOriginalName()
        ]);
    }
}
