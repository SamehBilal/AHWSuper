<?php

namespace Modules\AHWStore\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\AHWStore\Http\Traits\ZohoApiTrait;
use Exception;

class InvoicesController extends Controller
{
    use ZohoApiTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = $this->zohoRequest('invoices');
            $data = $response->json();
            return response()->json($data['invoices'] ?? []);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch invoices: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        return response()->json([]);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        try {
            $response = $this->zohoRequest('invoices/' . $id);
            $data = $response->json();
            return response()->json($data['invoice'] ?? []);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch invoice: ' . $e->getMessage()], 500);
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
