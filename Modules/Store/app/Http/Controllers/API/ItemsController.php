<?php

namespace Modules\Store\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Store\Http\Traits\ZohoApiTrait;
use Exception;

class ItemsController extends Controller
{
    use ZohoApiTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = $this->zohoRequest('items');
            $data = $response->json();
            return response()->json($data['items'] ?? []);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch items: ' . $e->getMessage()], 500);
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
            $response = $this->zohoRequest('items/'.$id);
            $data = $response->json();
            return response()->json($data['item'] ?? []);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch items: ' . $e->getMessage()], 500);
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
