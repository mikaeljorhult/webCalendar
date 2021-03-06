<?php

namespace WebCalendar\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use WebCalendar\Http\Requests\ModuleCreateRequest;
use WebCalendar\Http\Requests\ModuleUpdateRequest;
use WebCalendar\Module;

class ModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $modules = Module::all();

        return view('modules.index')
            ->with('modules', $modules);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('modules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ModuleCreateRequest $request
     * @return Response
     */
    public function store(ModuleCreateRequest $request)
    {
        $module = new Module($request->all());

        // Save file and store in model if present in request.
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $module->addFile($request->file('file'));
        }

        // Store module and attach related courses.
        $module->save();
        $module->courses()->sync((array)$request->input('courses'));

        return redirect()->route('admin.modules.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Module $module
     * @return Response
     */
    public function show(Module $module)
    {
        return view('modules.view')
            ->with('module', $module);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Module $module
     * @return Response
     */
    public function edit(Module $module)
    {
        return view('modules.edit')
            ->with('module', $module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Module $module
     * @param ModuleUpdateRequest $request
     * @return Response
     */
    public function update(Module $module, ModuleUpdateRequest $request)
    {
        $module->fill($request->all());

        // Save file and store in model if present in request.
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $module->addFile($request->file('file'));
        }

        // Store module and attach related courses.
        $module->save();
        $module->courses()->sync((array)$request->input('courses'));

        return redirect()->route('admin.modules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Module $module
     * @return Response
     */
    public function destroy(Module $module)
    {
        $module->delete();

        // Delete calendar file if present.
        if (str_contains($module->type, '-file') && Storage::has($module->calendar)) {
            Storage::delete($module->calendar);
        }

        return redirect()->route('admin.modules.index');
    }

}