<?php

namespace Modules\Store\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Store\Http\Traits\ZohoApiTrait;
use Exception;

/**
 * @OA\Schema(
 *     schema="SalesOrderResponse",
 *     type="object",
 *     @OA\Property(property="salesorder_id", type="string", example="4815000000045208"),
 *     @OA\Property(property="customer_id", type="integer", example=12345),
 *     @OA\Property(property="customer_name", type="string", example="John Doe"),
 *     @OA\Property(property="date", type="string", format="date", example="2024-01-15"),
 *     @OA\Property(property="shipment_date", type="string", format="date", example="2024-01-20"),
 *     @OA\Property(property="delivery_method", type="string", example="Standard"),
 *     @OA\Property(property="reference_number", type="string", example="REF-001"),
 *     @OA\Property(property="notes", type="string", example="Order notes"),
 *     @OA\Property(property="terms", type="string", example="Net 30"),
 *     @OA\Property(property="total", type="number", format="float", example=1250.50),
 *     @OA\Property(property="status", type="string", example="confirmed"),
 *     @OA\Property(
 *         property="line_items",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/LineItem")
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="SalesOrderRequest",
 *     type="object",
 *     required={"customer_id", "date", "line_items"},
 *     @OA\Property(property="customer_id", type="integer", example=12345),
 *     @OA\Property(property="date", type="string", format="date", example="2024-01-15"),
 *     @OA\Property(property="shipment_date", type="string", format="date", example="2024-01-20"),
 *     @OA\Property(property="delivery_method", type="string", example="Standard"),
 *     @OA\Property(property="reference_number", type="string", example="REF-001"),
 *     @OA\Property(property="notes", type="string", example="Order notes"),
 *     @OA\Property(property="terms", type="string", example="Net 30"),
 *     @OA\Property(
 *         property="line_items",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/LineItemRequest")
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="SalesOrderUpdateRequest",
 *     type="object",
 *     @OA\Property(property="customer_id", type="integer", example=12345),
 *     @OA\Property(property="date", type="string", format="date", example="2024-01-15"),
 *     @OA\Property(property="shipment_date", type="string", format="date", example="2024-01-20"),
 *     @OA\Property(property="delivery_method", type="string", example="Standard"),
 *     @OA\Property(property="reference_number", type="string", example="REF-001"),
 *     @OA\Property(property="notes", type="string", example="Order notes"),
 *     @OA\Property(property="terms", type="string", example="Net 30"),
 *     @OA\Property(
 *         property="line_items",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/LineItemRequest")
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="LineItem",
 *     type="object",
 *     @OA\Property(property="line_item_id", type="string", example="4815000000045209"),
 *     @OA\Property(property="item_id", type="integer", example=67890),
 *     @OA\Property(property="name", type="string", example="Product Name"),
 *     @OA\Property(property="quantity", type="integer", example=2),
 *     @OA\Property(property="rate", type="number", format="float", example=125.50),
 *     @OA\Property(property="tax_percentage", type="number", format="float", example=10.0),
 *     @OA\Property(property="item_total", type="number", format="float", example=251.0)
 * )
 *
 * @OA\Schema(
 *     schema="LineItemRequest",
 *     type="object",
 *     required={"item_id", "name", "quantity", "rate", "item_total"},
 *     @OA\Property(property="item_id", type="integer", example=67890),
 *     @OA\Property(property="name", type="string", example="Product Name"),
 *     @OA\Property(property="quantity", type="integer", example=2),
 *     @OA\Property(property="rate", type="number", format="float", example=125.50),
 *     @OA\Property(property="tax_percentage", type="number", format="float", example=10.0),
 *     @OA\Property(property="item_total", type="number", format="float", example=251.0)
 * )
 */
class SalesOrdersController extends Controller
{
    use ZohoApiTrait;
    /**
     * @OA\Get(
     *     path="/api/v1/store/sales-orders",
     *     tags={"SalesOrders"},
     *     summary="Get all sales orders",
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/SalesOrderResponse")
     *         )
     *     ),
     *     @OA\Response(response=400, description="Invalid request")
     * )
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
     * @OA\Post(
     *     path="/api/v1/store/sales-orders",
     *     tags={"SalesOrders"},
     *     summary="Create a new sales order",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SalesOrderRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Sales order created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SalesOrderResponse")
     *     ),
     *     @OA\Response(response=400, description="Invalid input")
     * )
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
     * @OA\Get(
     *     path="/api/v1/store/sales-orders/{id}",
     *     tags={"SalesOrders"},
     *     summary="Get a specific sales order",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Sales Order ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/SalesOrderResponse")
     *     ),
     *     @OA\Response(response=404, description="Sales order not found")
     * )
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
     * @OA\Put(
     *     path="/api/v1/store/sales-orders/{id}",
     *     tags={"SalesOrders"},
     *     summary="Update a sales order",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Sales Order ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SalesOrderUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sales order updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/SalesOrderResponse")
     *     ),
     *     @OA\Response(response=400, description="Invalid input"),
     *     @OA\Response(response=404, description="Sales order not found")
     * )
     */
    public function update(Request $request, $id)
    {
        //

        return response()->json([]);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/store/sales-orders/{id}",
     *     tags={"SalesOrders"},
     *     summary="Delete a sales order",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Sales Order ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Sales order deleted successfully"
     *     ),
     *     @OA\Response(response=404, description="Sales order not found")
     * )
     */
    public function destroy($id)
    {
        //

        return response()->json([]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/store/sales-orders/{id}/status/confirmed",
     *     tags={"SalesOrders"},
     *     summary="Mark a sales order as Confirmed",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Sales Order ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sales order status changed to Confirmed",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="code", type="integer", example=0),
     *             @OA\Property(property="message", type="string", example="Sales order status has been changed to 'Confirmed'.")
     *         )
     *     )
     * )
     */
    public function markAsConfirmed($id)
    {
        try {
            $response = $this->zohoRequest("salesorders/{$id}/status/confirmed", 'post');
            if ($response->successful()) {
                return response()->json($response->json(), 200);
            } else {
                return response()->json(['error' => 'Failed to confirm sales order: ' . $response->body()], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to confirm sales order: ' . $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/store/sales-orders/{id}/status/void",
     *     tags={"SalesOrders"},
     *     summary="Mark a sales order as Void",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Sales Order ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sales order status changed to Void",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="code", type="integer", example=0),
     *             @OA\Property(property="message", type="string", example="The status of the Sales Order has been changed to void.")
     *         )
     *     )
     * )
     */
    public function markAsVoid($id)
    {
        try {
            $response = $this->zohoRequest("salesorders/{$id}/status/void", 'post');
            if ($response->successful()) {
                return response()->json($response->json(), 200);
            } else {
                return response()->json(['error' => 'Failed to void sales order: ' . $response->body()], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to void sales order: ' . $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/store/sales-orders/status/confirmed",
     *     tags={"SalesOrders"},
     *     summary="Bulk confirm sales orders",
     *     @OA\Parameter(
     *         name="salesorder_ids",
     *         in="query",
     *         required=true,
     *         description="Comma-separated list of sales order IDs",
     *         @OA\Schema(type="string", example="4815000000045208,4815000000045274,4815000000045340")
     *     ),
     *     @OA\Parameter(
     *         name="organization_id",
     *         in="query",
     *         required=true,
     *         description="Organization ID",
     *         @OA\Schema(type="string", example="10234695")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Bulk sales order status changed to Confirmed",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="code", type="integer", example=0),
     *             @OA\Property(property="message", type="string", example="Sales order status has been changed to Confirmed."),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="email_success_info", type="array", @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="code", type="integer", example=0),
     *                     @OA\Property(property="message", type="string", example="The status of the sales order has been changed to Open."),
     *                     @OA\Property(property="ids", type="array", @OA\Items(type="string", example="4815000000045208,4815000000045274,4815000000045340"))
     *                 )),
     *                 @OA\Property(property="email_error_info", type="array", @OA\Items(type="object"))
     *             )
     *         )
     *     )
     * )
     */
    public function bulkMarkAsConfirmed(Request $request)
    {
        try {
            $salesorder_ids = $request->query('salesorder_ids');
            $organization_id = $request->query('organization_id');
            if (!$salesorder_ids || !$organization_id) {
                return response()->json(['error' => 'Missing required query parameters: salesorder_ids, organization_id'], 400);
            }
            $endpoint = "salesorders/status/confirmed?salesorder_ids={$salesorder_ids}&organization_id={$organization_id}";
            $response = $this->zohoRequest($endpoint, 'post');
            if ($response->successful()) {
                return response()->json($response->json(), 200);
            } else {
                return response()->json(['error' => 'Failed to bulk confirm sales orders: ' . $response->body()], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to bulk confirm sales orders: ' . $e->getMessage()], 500);
        }
    }
}
