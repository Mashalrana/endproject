<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;

class ManagerController extends Controller
{
    public function index()
    {
        $managers = Manager::all();
        return view('managers.index', compact('managers'));
    }

    public function create()
    {
        return view('managers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'manager_name' => 'required',
            'manager_address' => 'required',
            'manager_postcode' => 'required',
            'manager_city' => 'required',
        ]);

        Manager::create($request->all());

        return redirect()->route('managers.index')->with('success', 'Manager created successfully.');
    }

    public function edit(Manager $manager)
    {
        return view('managers.edit', compact('manager'));
    }

    public function update(Request $request, Manager $manager)
    {
        $request->validate([
            'manager_name' => 'required',
            'manager_address' => 'required',
            'manager_postcode' => 'required',
            'manager_city' => 'required',
        ]);

        $manager->update($request->all());

        return redirect()->route('managers.index')->with('success', 'Manager updated successfully.');
    }

    public function destroy(Manager $manager)
    {
        $manager->delete();
        return redirect()->route('managers.index')->with('success', 'Manager deleted successfully.');
    }
}
