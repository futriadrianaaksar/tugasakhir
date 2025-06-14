<?php

namespace App\Http\Controllers;

use App\Models\FineRule;
use Illuminate\Http\Request;

class FineRuleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $fineRules = FineRule::paginate(10);
        return view('fine_rules.index', compact('fineRules'));
    }

    public function create()
    {
        return view('fine_rules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fine_per_day' => 'required|integer|min:0',
        ]);

        FineRule::create($request->only('fine_per_day'));

        return redirect()->route('fine_rules.index')->with('success', 'Aturan denda berhasil ditambahkan.');
    }

    public function edit(FineRule $fineRule)
    {
        return view('fine_rules.edit', compact('fineRule'));
    }

    public function update(Request $request, FineRule $fineRule)
    {
        $request->validate([
            'fine_per_day' => 'required|integer|min:0',
        ]);

        $fineRule->update($request->only('fine_per_day'));

        return redirect()->route('fine_rules.index')->with('success', 'Aturan denda berhasil diperbarui.');
    }

    public function destroy(FineRule $fineRule)
    {
        $fineRule->delete();
        return redirect()->route('fine_rules.index')->with('success', 'Aturan denda berhasil dihapus.');
    }
}
