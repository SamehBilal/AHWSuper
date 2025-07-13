<?php

namespace Modules\AHWStore\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\AHWStore\Http\Traits\ZohoApiTrait;
use Exception;

class SalesOrdersController extends Controller
{
    use ZohoApiTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = $this->zohoRequest('salesorders');
            $data = $response->json();
            return response()->json($data['salesorders'] ?? []);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch salesorders: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'customer_id' => 'required|integer',
                'date' => 'required|date',
                'shipment_date' => 'nullable|date',
                'delivery_method' => 'nullable|string',
                'reference_number' => 'nullable|string',
                'notes' => 'nullable|string',
                'terms' => 'nullable|string',
                'line_items' => 'required|array|min:1',
                'line_items.*.item_id' => 'required|integer',
                'line_items.*.name' => 'required|string',
                'line_items.*.quantity' => 'required|integer|min:1',
                'line_items.*.rate' => 'required|numeric|min:0',
                'line_items.*.tax_percentage' => 'nullable|numeric|min:0|max:100',
                'line_items.*.item_total' => 'required|numeric|min:0',
            ]);

            // Add any additional required fields with defaults
            $salesOrderData = array_merge($validatedData, [
                'unit' => 'qty',
                'is_inclusive_tax' => false,
                'exchange_rate' => 1,
            ]);

            $response = $this->zohoRequest('salesorders', 'post', $salesOrderData);
            
            if ($response->successful()) {
                $data = $response->json();
                return response()->json($data, 201);
            } else {
                return response()->json(['error' => 'Failed to create sales order: ' . $response->body()], $response->status());
            }
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to create sales order: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        try {
            $response = $this->zohoRequest('salesorders/' . $id);
            $data = $response->json();
            return response()->json($data['salesorder'] ?? []);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch salesorder: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //

        return response()->json([]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        return response()->json([]);
    }
}
