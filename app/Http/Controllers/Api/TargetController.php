<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Target\IndexRequest;
use App\UseCases\Target\IndexAction;
use App\Http\Resources\Target\IndexResource;

class TargetController extends Controller
{
    public function index(IndexRequest $request, IndexAction $action): IndexResource
    {
        $user = $request->user;
        $targetList = $action($user->id);
        return new IndexResource($targetList);
    }
}
