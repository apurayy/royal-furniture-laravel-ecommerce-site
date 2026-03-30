<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterMenuItem;
use Illuminate\Http\Request;

class FooterMenuController extends Controller
{
    public function index()
    {
        $items = FooterMenuItem::orderBy('sort_order')->paginate(20);
        return view('admin.footer_menu.index', compact('items'));
    }

    public function create()
    {
        return view('admin.footer_menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'section' => 'required|in:footer_links,customer_service',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'opens_in_new_tab' => 'nullable|boolean',
        ]);

        FooterMenuItem::create([
            'title' => $request->title,
            'url' => $request->url,
            'section' => $request->section,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
            'opens_in_new_tab' => $request->has('opens_in_new_tab'),
        ]);

        return redirect()->route('admin.footer-menu.index')->with('success', 'Footer menu item created.');
    }

    public function edit(FooterMenuItem $footer_menu)
    {
        return view('admin.footer_menu.edit', ['item' => $footer_menu]);
    }

    public function update(Request $request, FooterMenuItem $footer_menu)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'opens_in_new_tab' => 'nullable|boolean',
        ]);

        $footer_menu->update([
            'title' => $request->title,
            'url' => $request->url,
            'section' => $request->section,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
            'opens_in_new_tab' => $request->has('opens_in_new_tab'),
        ]);

        return redirect()->route('admin.footer-menu.index')->with('success', 'Footer menu item updated.');
    }

    public function destroy(FooterMenuItem $footer_menu)
    {
        $footer_menu->delete();

        return redirect()->route('admin.footer-menu.index')->with('success', 'Footer menu item deleted.');
    }
}
