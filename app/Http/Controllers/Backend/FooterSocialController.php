<?php

namespace App\Http\Controllers\Backend;

use App\Models\FooterSocial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\FooterSocialDataTable;

class FooterSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FooterSocialDataTable $dataTable)
    {
        return $dataTable->render('admin.footer.footer-social.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.footer.footer-social.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'name' => 'required',
            'url' => 'required|url',
            'status' => 'required'
        ]);

        $footerSocial = new FooterSocial();
        $footerSocial->icon = $request->icon;
        $footerSocial->name = $request->name;
        $footerSocial->url = $request->url;
        $footerSocial->status = $request->status;
        $footerSocial->save();

        toastr('Footer Social created successfully!', 'success');

        return redirect()->route('admin.footer-socials.index');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $footerSocial = FooterSocial::findOrFail($id);
        return view('admin.footer.footer-social.edit', compact('footerSocial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'icon' => 'required',
            'name' => 'required',
            'url' => 'required|url',
            'status' => 'required'
        ]);

        $footerSocial = FooterSocial::findOrFail($id);
        $footerSocial->icon = $request->icon;
        $footerSocial->name = $request->name;
        $footerSocial->url = $request->url;
        $footerSocial->status = $request->status;
        $footerSocial->save();

        toastr('Footer Social updated successfully!', 'success');

        return redirect()->route('admin.footer-socials.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $footerSocial = FooterSocial::findOrFail($id);
        $footerSocial->delete();

        return response(['status' => 'success', 'message' => 'Footer Social deleted successfully!']);
    }

    public function changeStatus(Request $request){

        $footerSocial = FooterSocial::findOrFail($request->id);
        $footerSocial->status = $request->status == "true" ? 1 : 0;
        $footerSocial->save();

        return response(['message' => 'Status Updated Successfully']);
    }
}
