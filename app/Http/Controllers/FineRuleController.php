<?php

namespace App\Http\Controllers;

use App\Models\FineRule;
use Illuminate\Http\Request;

class FineRuleController extends Controller
{
    public function index()
    {
        $fineRules = FineRule::all();
        return view('admin.fine_rules.index', compact('fineRules'));
    }

    public function create()
    {
        return view('admin.fine_rules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount_per_day' => 'required|numeric|min:0',
            'max_days' => 'required|integer|min:1',
        ]);

        FineRule::create($request->all());
        return redirect()->route('admin.fine_rules.index')->with('success', 'Aturan denda berhasil ditambahkan.');
    }

    public function edit(FineRule $fineRule)
    {
        return view('admin.fine_rules.edit', compact('fineRule'));
    }

    public function update(Request $request, FineRule $fineRule)
    {
        $request->validate([
            'amount_per_day' => 'required|numeric|min:0',
            'max_days' => 'required|integer|min:1',
        ]);

        $fineRule->update($request->all());
        return redirect()->route('admin.fine_rules.index')->with('success', 'Aturan denda berhasil diperbarui.');
    }

    public function destroy(FineRule $fineRule)
    {
        $fineRule->delete();
        return redirect()->route('admin.fine_rules.index')->with('success', 'Aturan denda berhasil dihapus.');
    }
}
