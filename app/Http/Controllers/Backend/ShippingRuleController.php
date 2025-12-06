<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ShippingRuleDataTable;
use App\Models\ShippingRule;

class ShippingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShippingRuleDataTable $datatables)
    {
        return $datatables->render('admin.shipping-rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'type' => ['required'],
            'cost' => ['required' , 'integer'],
            'min_cost' => ['nullable','integer'],
            'status' => ['required']
        ]);

        $rule = new ShippingRule();
        $rule->name = $request->name;
        $rule->type = $request->type;
        $rule->cost = $request->cost;
        $rule->min_cost = $request->min_cost;
        $rule->status = $request->status;
        $rule->save();

        toastr('Rule Created Successfully', 'success');

        return redirect(route('admin.shipping-rule.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shipping = ShippingRule::findOrFail($id);
        return view('admin.shipping-rule.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required'],
            'type' => ['required'],
            'cost' => ['required' , 'integer'],
            'min_cost' => ['nullable','integer'],
            'status' => ['required']
        ]);

        $rule = ShippingRule::findOrFail($id);
        $rule->name = $request->name;
        $rule->type = $request->type;
        $rule->cost = $request->cost;
        $rule->min_cost = $request->min_cost;
        $rule->status = $request->status;
        $rule->save();

        toastr('Rule Updated Successfully', 'success');

        return redirect(route('admin.shipping-rule.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rule = ShippingRule::findOrFail($id);
        $rule->delete();
        return response(['status' => 'success', 'message' => 'Rule Deleted Successfully']); 
    }

    public function changeStatus (Request $request){

        $rule = ShippingRule::findOrFail($request->id);
        $rule->status = $request->status == 'true' ? 1 : 0;
        $rule->save();

        return response(['message' => 'Rule Status Updated']); 
    }
}
