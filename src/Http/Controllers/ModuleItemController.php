<?php

namespace Gmarineau\AdminPhp\Http\Controllers;

use Gmarineau\AdminPhp\Actions\GetFormData;
use Gmarineau\AdminPhp\Actions\SaveModuleContent;
use Gmarineau\AdminPhp\AdminPhp;
use Gmarineau\AdminPhp\Modules\Module;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModuleItemController
{
    public function __construct(protected AdminPhp $adminPhp) {}

    public function index(string $module): JsonResponse
    {
        $moduleDefinition = $this->findModule($module);
        $locale = $this->adminPhp->defaultLocale();

        $items = $moduleDefinition->modelClass()::query()
            ->latest('updated_at')
            ->paginate(30);

        return response()->json([
            'data' => $items->getCollection()->map(fn (Model $item): array => [
                'id' => $item->getKey(),
                'title' => $moduleDefinition->itemTitle($item, $locale),
                'updatedAt' => $item->getAttribute('updated_at')?->toIso8601String(),
            ])->all(),
            'meta' => [
                'currentPage' => $items->currentPage(),
                'lastPage' => $items->lastPage(),
                'total' => $items->total(),
            ],
        ]);
    }

    public function show(GetFormData $getFormData, string $module, string $id): JsonResponse
    {
        $moduleDefinition = $this->findModule($module);

        return $this->itemResponse($moduleDefinition, $this->findItem($moduleDefinition, $id), $getFormData);
    }

    public function store(Request $request, SaveModuleContent $saveModuleContent, GetFormData $getFormData, string $module): JsonResponse
    {
        $moduleDefinition = $this->findModule($module);

        $item = $saveModuleContent->handle($moduleDefinition, $request->all());

        return $this->itemResponse($moduleDefinition, $item, $getFormData, 201);
    }

    public function update(Request $request, SaveModuleContent $saveModuleContent, GetFormData $getFormData, string $module, string $id): JsonResponse
    {
        $moduleDefinition = $this->findModule($module);

        $item = $saveModuleContent->handle($moduleDefinition, $request->all(), $this->findItem($moduleDefinition, $id));

        return $this->itemResponse($moduleDefinition, $item, $getFormData);
    }

    protected function findModule(string $name): Module
    {
        abort_unless($this->adminPhp->hasModule($name), 404);

        return $this->adminPhp->module($name);
    }

    protected function findItem(Module $module, string $id): Model
    {
        return $module->modelClass()::query()->findOrFail($id);
    }

    protected function itemResponse(Module $module, Model $item, GetFormData $getFormData, int $status = 200): JsonResponse
    {
        return response()->json([
            'data' => [
                'id' => $item->getKey(),
                'title' => $module->itemTitle($item, $this->adminPhp->defaultLocale()),
                'values' => $getFormData->handle($module, $item->fresh()),
            ],
        ], $status);
    }
}
