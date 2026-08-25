<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PositionController extends Controller
{
    public function index(): View
    {
        $positions = Position::latest()->get();

        return view('hr.positions.index', compact('positions'));
    }

    public function create(): View
    {
        return view('hr.positions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'position_name' => [
                'required',
                'string',
                'max:100',
                'unique:positions,position_name',
            ],
        ]);

        Position::create($validated);

        return redirect()
            ->route('positions.index')
            ->with('success', 'Position berhasil ditambahkan.');
    }

    public function edit(Position $position): View
    {
        return view('hr.positions.edit', compact('position'));
    }

    public function update(
        Request $request,
        Position $position
    ): RedirectResponse {

        $validated = $request->validate([
            'position_name' => [
                'required',
                'string',
                'max:100',
                'unique:positions,position_name,' . $position->id,
            ],
        ]);

        $position->update($validated);

        return redirect()
            ->route('positions.index')
            ->with('success', 'Position berhasil diperbarui.');
    }

    public function destroy(
        Position $position
    ): RedirectResponse {

        $position->delete();

        return redirect()
            ->route('positions.index')
            ->with('success', 'Position berhasil dihapus.');
    }
}