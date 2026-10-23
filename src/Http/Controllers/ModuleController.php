<?php

namespace Gmarineau\AdminPhp\Http\Controllers;

use Gmarineau\AdminPhp\AdminPhp;
use Gmarineau\AdminPhp\Modules\Module;
use Illuminate\Http\JsonResponse;

class ModuleController
{
    /**
     * Modules shown in the admin navigation.
     */
    public function index(AdminPhp $adminPhp): JsonResponse
    {
        return response()->json([
            'data' => array_values(array_map(fn (Module $module): array => [
                'name' => $module->name(),
                'title' => $module->title(),
                'count' => $module->modelClass()::query()->count(),
            ], $adminPhp->modules())),
        ]);
    }

    /**
     * Form schema of a module.
     */
    public function show(AdminPhp $adminPhp, string $module): JsonResponse
    {
        abort_unless($adminPhp->hasModule($module), 404);

        return response()->json(['data' => $adminPhp->module($module)->toSchema()]);
    }
}
