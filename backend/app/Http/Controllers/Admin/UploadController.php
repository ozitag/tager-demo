<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Ozerich\FileStorage\Storage;
use OZiTAG\Tager\Backend\Core\Controller;

class UploadController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request, Storage $storage)
    {
        $scenario = $request->get('scenario', 'default');
        $scenarioInstance = Storage::GetScenario($scenario);

        if (!$scenarioInstance) {
            return [
                'error' => 'Scenario `' . $scenario . '` is not found'
            ];
        }

        $file = $storage->createFromRequest($scenario);

        return $file->getJson();
    }
}
