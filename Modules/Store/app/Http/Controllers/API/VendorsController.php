<?php

namespace Modules\Store\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Store\Http\Traits\ZohoApiTrait;
use Exception;

class VendorsController extends Controller
{
    use ZohoApiTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $response = $this->zohoRequest('contacts');
            $data = $response->json();
            $contacts = $data['contacts'] ?? [];

            // Filter contacts to get only vendors
            // In Zoho Inventory, vendors are typically identified by:
            // 1. contact_type = 'vendor'
            // 2. is_vendor = true
            // 3. contact_type = 'supplier'
            // 4. Or by checking if they have vendor-specific fields
            $vendors = collect($contacts)->filter(function ($contact) {
                $contactType = strtolower($contact['contact_type'] ?? '');
                $isVendor = $contact['is_vendor'] ?? false;
                $vendorStatus = strtolower($contact['vendor_status'] ?? '');
                $contactName = strtolower($contact['contact_name'] ?? '');
                
                // Check for vendor-specific identifiers
                $isVendorByType = in_array($contactType, ['vendor', 'supplier', 'v']);
                $isVendorByFlag = $isVendor === true;
                $isVendorByStatus = $vendorStatus === 'active' && !empty($vendorStatus);
                
                // Additional checks for vendor-specific fields
                $hasVendorFields = isset($contact['vendor_id']) || 
                                  isset($contact['supplier_id']) || 
                                  isset($contact['vendor_code']);
                
                // TEMPORARY: If no vendors are found with strict filtering, show all contacts
                // This helps us see what data is available and adjust the filter accordingly
                $strictVendorCheck = $isVendorByType || $isVendorByFlag || $isVendorByStatus || $hasVendorFields;
                
                // If strict check fails, let's be more lenient for now
                if (!$strictVendorCheck) {
                    // Show contacts that might be vendors based on company name patterns
                    $companyName = strtolower($contact['company_name'] ?? '');
                    $hasCompanyName = !empty($companyName) && $companyName !== '-';
                    
                    // For now, show contacts with company names as potential vendors
                    // You can adjust this logic based on your specific needs
                    return $hasCompanyName;
                }
                
                return $strictVendorCheck;
            });

            return response()->json($vendors->values()->toArray());
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch vendors: ' . $e->getMessage()], 500);
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
            return response()->json(['error' => 'Failed to fetch vendor: ' . $e->getMessage()], 500);
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

    /**
     * Debug method to check contact types
     */
    public function debugContactTypes()
    {
        try {
            $response = $this->zohoRequest('contacts');
            $data = $response->json();
            $contacts = $data['contacts'] ?? [];
            
            $contactTypes = collect($contacts)->pluck('contact_type')->unique()->filter()->values();
            $firstContact = $contacts[0] ?? null;
            
            return response()->json([
                'total_contacts' => count($contacts),
                'available_contact_types' => $contactTypes->toArray(),
                'first_contact_sample' => $firstContact,
                'contact_fields' => $firstContact ? array_keys($firstContact) : []
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Debug method to test dashboard API calls
     */
    public function debugDashboardTest()
    {
        try {
            // Test items API
            $itemsResponse = $this->zohoRequest('items');
            $itemsData = $itemsResponse->json();
            
            // Test sales orders API
            $ordersResponse = $this->zohoRequest('salesorders');
            $ordersData = $ordersResponse->json();
            
            // Test invoices API
            $invoicesResponse = $this->zohoRequest('invoices');
            $invoicesData = $invoicesResponse->json();
            
            return response()->json([
                'items' => [
                    'total' => count($itemsData['items'] ?? []),
                    'sample' => $itemsData['items'][0] ?? null,
                    'response_keys' => array_keys($itemsData)
                ],
                'sales_orders' => [
                    'total' => count($ordersData['salesorders'] ?? []),
                    'sample' => $ordersData['salesorders'][0] ?? null,
                    'response_keys' => array_keys($ordersData)
                ],
                'invoices' => [
                    'total' => count($invoicesData['invoices'] ?? []),
                    'sample' => $invoicesData['invoices'][0] ?? null,
                    'response_keys' => array_keys($invoicesData)
                ]
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
