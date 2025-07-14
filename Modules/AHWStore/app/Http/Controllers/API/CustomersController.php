<?php

namespace Modules\AHWStore\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\AHWStore\Http\Traits\ZohoApiTrait;
use Exception;

class CustomersController extends Controller
{
    use ZohoApiTrait;

     /**
     * @OA\Get(
     *     path="/ahwstore/customers",
     *     tags={"Customers"},
     *     summary="Get all customers",
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/User")
     *         )
     *     ),
     *     @OA\Response(response="400", description="Invalid request")
     * )
     */
    public function index()
    {
        try {
            $response = $this->zohoRequest('contacts');
            $data = $response->json();
            return response()->json($data['contacts'] ?? []);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch customers: ' . $e->getMessage()], 500);
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
            $response = $this->zohoRequest('contacts/' . $id);
            $data = $response->json();
            return response()->json($data['contact'] ?? []);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch customers: ' . $e->getMessage()], 500);
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
