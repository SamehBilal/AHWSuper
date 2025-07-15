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
     *     path="api/v1/ahwstore/customers",
     *     tags={"Customers"},
     *     summary="Get all customers",
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="contact_name", type="string", example="Bowman and Co"),
     *                 @OA\Property(property="company_name", type="string", example="Bowman and Co"),
     *                 @OA\Property(property="payment_terms", type="integer", example=15),
     *                 @OA\Property(property="currency_id", type="integer", example=460000000000097),
     *                 @OA\Property(property="website", type="string", example="www.bowmanfurniture.com"),
     *                 @OA\Property(property="contact_type", type="string", example="customer"),
     *                 @OA\Property(property="custom_fields", type="array", @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="value", type="string", example="GBGD078"),
     *                     @OA\Property(property="index", type="integer", example=1)
     *                 )),
     *                 @OA\Property(property="opening_balances", type="array", @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="location_id", type="string", example="460000000038080"),
     *                     @OA\Property(property="exchange_rate", type="number", format="float", example=1),
     *                     @OA\Property(property="opening_balance_amount", type="number", format="float", example=1200)
     *                 )),
     *                 @OA\Property(property="billing_address", type="object",
     *                     @OA\Property(property="attention", type="string", example="Mr.John"),
     *                     @OA\Property(property="address", type="string", example="4900 Hopyard Rd"),
     *                     @OA\Property(property="street2", type="string", example="Suit 310"),
     *                     @OA\Property(property="city", type="string", example="Pleasanton"),
     *                     @OA\Property(property="state", type="string", example="California"),
     *                     @OA\Property(property="zip", type="integer", example=94588),
     *                     @OA\Property(property="country", type="string", example="U.S.A")
     *                 ),
     *                 @OA\Property(property="shipping_address", type="object",
     *                     @OA\Property(property="attention", type="string", example="Mr.John"),
     *                     @OA\Property(property="address", type="string", example="4900 Hopyard Rd"),
     *                     @OA\Property(property="street2", type="string", example="Suit 310"),
     *                     @OA\Property(property="city", type="string", example="Pleasanton"),
     *                     @OA\Property(property="state", type="string", example="California"),
     *                     @OA\Property(property="zip", type="integer", example=94588),
     *                     @OA\Property(property="country", type="string", example="U.S.A")
     *                 ),
     *                 @OA\Property(property="contact_persons", type="array", @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="salutation", type="string", example="Mr"),
     *                     @OA\Property(property="first_name", type="string", example="Will"),
     *                     @OA\Property(property="last_name", type="string", example="Smith"),
     *                     @OA\Property(property="email", type="string", example="willsmith@bowmanfurniture.com"),
     *                     @OA\Property(property="phone", type="string", example="+1-925-921-9201"),
     *                     @OA\Property(property="mobile", type="string", example="+1-4054439562"),
     *                     @OA\Property(property="is_primary_contact", type="boolean", example=true)
     *                 )),
     *                 @OA\Property(property="default_templates", type="object",
     *                     @OA\Property(property="invoice_template_id", type="integer", example=460000000052069),
     *                     @OA\Property(property="invoice_template_name", type="string", example="Custom Classic"),
     *                     @OA\Property(property="estimate_template_id", type="integer", example=460000000000179),
     *                     @OA\Property(property="estimate_template_name", type="string", example="Service - Professional"),
     *                     @OA\Property(property="creditnote_template_id", type="integer", example=460000000000211),
     *                     @OA\Property(property="creditnote_template_name", type="string", example="Fixed Cost - Professional"),
     *                     @OA\Property(property="invoice_email_template_id", type="integer", example=460000000052071),
     *                     @OA\Property(property="invoice_email_template_name", type="string", example="Custom Invoice Notification"),
     *                     @OA\Property(property="estimate_email_template_id", type="integer", example=460000000052073),
     *                     @OA\Property(property="estimate_email_template_name", type="string", example="Custom Estimate Notification"),
     *                     @OA\Property(property="creditnote_email_template_id", type="integer", example=460000000052075),
     *                     @OA\Property(property="creditnote_email_template_name", type="string", example="Custom Credit Note Notification")
     *                 ),
     *                 @OA\Property(property="language_code", type="string", example="en"),
     *                 @OA\Property(property="notes", type="string", example="Payment option : Through check"),
     *                 @OA\Property(property="vat_reg_no", type="string", example="string"),
     *                 @OA\Property(property="tax_reg_no", type="integer", example=12345678912345),
     *                 @OA\Property(property="country_code", type="string", example="US"),
     *                 @OA\Property(property="vat_treatment", type="string", example="string"),
     *                 @OA\Property(property="tax_treatment", type="string", example="string"),
     *                 @OA\Property(property="tax_regime", type="string", example="general_legal_person"),
     *                 @OA\Property(property="legal_name", type="string", example="ESCUELA KEMPER URGATE"),
     *                 @OA\Property(property="is_tds_registered", type="boolean", example=true),
     *                 @OA\Property(property="avatax_exempt_no", type="string", example="string"),
     *                 @OA\Property(property="avatax_use_code", type="string", example="string"),
     *                 @OA\Property(property="tax_exemption_id", type="integer", example=11149000000061054),
     *                 @OA\Property(property="tax_authority_id", type="integer", example=11149000000061052),
     *                 @OA\Property(property="tax_id", type="integer", example=11149000000061058),
     *                 @OA\Property(property="is_taxable", type="boolean", example=true),
     *                 @OA\Property(property="facebook", type="string", example="zoho"),
     *                 @OA\Property(property="twitter", type="string", example="zoho"),
     *                 @OA\Property(property="place_of_contact", type="string", example="TN"),
     *                 @OA\Property(property="gst_no", type="string", example="22AAAAA0000A1Z5"),
     *                 @OA\Property(property="gst_treatment", type="string", example="business_gst"),
     *                 @OA\Property(property="tax_authority_name", type="string", example="string"),
     *                 @OA\Property(property="tax_exemption_code", type="string", example="string")
     *             )
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
     * @OA\Post(
     *     path="api/v1/ahwstore/customers",
     *     tags={"Customers"},
     *     summary="Create a new customer",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="contact_name", type="string", example="Bowman and Co"),
     *             @OA\Property(property="company_name", type="string", example="Bowman and Co"),
     *             @OA\Property(property="payment_terms", type="integer", example=15),
     *             @OA\Property(property="currency_id", type="integer", example=460000000000097),
     *             @OA\Property(property="website", type="string", example="www.bowmanfurniture.com"),
     *             @OA\Property(property="contact_type", type="string", example="customer"),
     *             @OA\Property(property="custom_fields", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="value", type="string", example="GBGD078"),
     *                 @OA\Property(property="index", type="integer", example=1)
     *             )),
     *             @OA\Property(property="opening_balances", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="location_id", type="string", example="460000000038080"),
     *                 @OA\Property(property="exchange_rate", type="number", format="float", example=1),
     *                 @OA\Property(property="opening_balance_amount", type="number", format="float", example=1200)
     *             )),
     *             @OA\Property(property="billing_address", type="object",
     *                 @OA\Property(property="attention", type="string", example="Mr.John"),
     *                 @OA\Property(property="address", type="string", example="4900 Hopyard Rd"),
     *                 @OA\Property(property="street2", type="string", example="Suit 310"),
     *                 @OA\Property(property="city", type="string", example="Pleasanton"),
     *                 @OA\Property(property="state", type="string", example="California"),
     *                 @OA\Property(property="zip", type="integer", example=94588),
     *                 @OA\Property(property="country", type="string", example="U.S.A")
     *             ),
     *             @OA\Property(property="shipping_address", type="object",
     *                 @OA\Property(property="attention", type="string", example="Mr.John"),
     *                 @OA\Property(property="address", type="string", example="4900 Hopyard Rd"),
     *                 @OA\Property(property="street2", type="string", example="Suit 310"),
     *                 @OA\Property(property="city", type="string", example="Pleasanton"),
     *                 @OA\Property(property="state", type="string", example="California"),
     *                 @OA\Property(property="zip", type="integer", example=94588),
     *                 @OA\Property(property="country", type="string", example="U.S.A")
     *             ),
     *             @OA\Property(property="contact_persons", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="salutation", type="string", example="Mr"),
     *                 @OA\Property(property="first_name", type="string", example="Will"),
     *                 @OA\Property(property="last_name", type="string", example="Smith"),
     *                 @OA\Property(property="email", type="string", example="willsmith@bowmanfurniture.com"),
     *                 @OA\Property(property="phone", type="string", example="+1-925-921-9201"),
     *                 @OA\Property(property="mobile", type="string", example="+1-4054439562"),
     *                 @OA\Property(property="is_primary_contact", type="boolean", example=true)
     *             )),
     *             @OA\Property(property="default_templates", type="object",
     *                 @OA\Property(property="invoice_template_id", type="integer", example=460000000052069),
     *                 @OA\Property(property="invoice_template_name", type="string", example="Custom Classic"),
     *                 @OA\Property(property="estimate_template_id", type="integer", example=460000000000179),
     *                 @OA\Property(property="estimate_template_name", type="string", example="Service - Professional"),
     *                 @OA\Property(property="creditnote_template_id", type="integer", example=460000000000211),
     *                 @OA\Property(property="creditnote_template_name", type="string", example="Fixed Cost - Professional"),
     *                 @OA\Property(property="invoice_email_template_id", type="integer", example=460000000052071),
     *                 @OA\Property(property="invoice_email_template_name", type="string", example="Custom Invoice Notification"),
     *                 @OA\Property(property="estimate_email_template_id", type="integer", example=460000000052073),
     *                 @OA\Property(property="estimate_email_template_name", type="string", example="Custom Estimate Notification"),
     *                 @OA\Property(property="creditnote_email_template_id", type="integer", example=460000000052075),
     *                 @OA\Property(property="creditnote_email_template_name", type="string", example="Custom Credit Note Notification")
     *             ),
     *             @OA\Property(property="language_code", type="string", example="en"),
     *             @OA\Property(property="notes", type="string", example="Payment option : Through check"),
     *             @OA\Property(property="vat_reg_no", type="string", example="string"),
     *             @OA\Property(property="tax_reg_no", type="integer", example=12345678912345),
     *             @OA\Property(property="country_code", type="string", example="US"),
     *             @OA\Property(property="vat_treatment", type="string", example="string"),
     *             @OA\Property(property="tax_treatment", type="string", example="string"),
     *             @OA\Property(property="tax_regime", type="string", example="general_legal_person"),
     *             @OA\Property(property="legal_name", type="string", example="ESCUELA KEMPER URGATE"),
     *             @OA\Property(property="is_tds_registered", type="boolean", example=true),
     *             @OA\Property(property="avatax_exempt_no", type="string", example="string"),
     *             @OA\Property(property="avatax_use_code", type="string", example="string"),
     *             @OA\Property(property="tax_exemption_id", type="integer", example=11149000000061054),
     *             @OA\Property(property="tax_authority_id", type="integer", example=11149000000061052),
     *             @OA\Property(property="tax_id", type="integer", example=11149000000061058),
     *             @OA\Property(property="is_taxable", type="boolean", example=true),
     *             @OA\Property(property="facebook", type="string", example="zoho"),
     *             @OA\Property(property="twitter", type="string", example="zoho"),
     *             @OA\Property(property="place_of_contact", type="string", example="TN"),
     *             @OA\Property(property="gst_no", type="string", example="22AAAAA0000A1Z5"),
     *             @OA\Property(property="gst_treatment", type="string", example="business_gst"),
     *             @OA\Property(property="tax_authority_name", type="string", example="string"),
     *             @OA\Property(property="tax_exemption_code", type="string", example="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Customer created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="contact_name", type="string", example="Bowman and Co"),
     *             @OA\Property(property="company_name", type="string", example="Bowman and Co"),
     *             @OA\Property(property="payment_terms", type="integer", example=15),
     *             @OA\Property(property="currency_id", type="integer", example=460000000000097),
     *             @OA\Property(property="website", type="string", example="www.bowmanfurniture.com"),
     *             @OA\Property(property="contact_type", type="string", example="customer"),
     *             @OA\Property(property="custom_fields", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="value", type="string", example="GBGD078"),
     *                 @OA\Property(property="index", type="integer", example=1)
     *             )),
     *             @OA\Property(property="opening_balances", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="location_id", type="string", example="460000000038080"),
     *                 @OA\Property(property="exchange_rate", type="number", format="float", example=1),
     *                 @OA\Property(property="opening_balance_amount", type="number", format="float", example=1200)
     *             )),
     *             @OA\Property(property="billing_address", type="object",
     *                 @OA\Property(property="attention", type="string", example="Mr.John"),
     *                 @OA\Property(property="address", type="string", example="4900 Hopyard Rd"),
     *                 @OA\Property(property="street2", type="string", example="Suit 310"),
     *                 @OA\Property(property="city", type="string", example="Pleasanton"),
     *                 @OA\Property(property="state", type="string", example="California"),
     *                 @OA\Property(property="zip", type="integer", example=94588),
     *                 @OA\Property(property="country", type="string", example="U.S.A")
     *             ),
     *             @OA\Property(property="shipping_address", type="object",
     *                 @OA\Property(property="attention", type="string", example="Mr.John"),
     *                 @OA\Property(property="address", type="string", example="4900 Hopyard Rd"),
     *                 @OA\Property(property="street2", type="string", example="Suit 310"),
     *                 @OA\Property(property="city", type="string", example="Pleasanton"),
     *                 @OA\Property(property="state", type="string", example="California"),
     *                 @OA\Property(property="zip", type="integer", example=94588),
     *                 @OA\Property(property="country", type="string", example="U.S.A")
     *             ),
     *             @OA\Property(property="contact_persons", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="salutation", type="string", example="Mr"),
     *                 @OA\Property(property="first_name", type="string", example="Will"),
     *                 @OA\Property(property="last_name", type="string", example="Smith"),
     *                 @OA\Property(property="email", type="string", example="willsmith@bowmanfurniture.com"),
     *                 @OA\Property(property="phone", type="string", example="+1-925-921-9201"),
     *                 @OA\Property(property="mobile", type="string", example="+1-4054439562"),
     *                 @OA\Property(property="is_primary_contact", type="boolean", example=true)
     *             )),
     *             @OA\Property(property="default_templates", type="object",
     *                 @OA\Property(property="invoice_template_id", type="integer", example=460000000052069),
     *                 @OA\Property(property="invoice_template_name", type="string", example="Custom Classic"),
     *                 @OA\Property(property="estimate_template_id", type="integer", example=460000000000179),
     *                 @OA\Property(property="estimate_template_name", type="string", example="Service - Professional"),
     *                 @OA\Property(property="creditnote_template_id", type="integer", example=460000000000211),
     *                 @OA\Property(property="creditnote_template_name", type="string", example="Fixed Cost - Professional"),
     *                 @OA\Property(property="invoice_email_template_id", type="integer", example=460000000052071),
     *                 @OA\Property(property="invoice_email_template_name", type="string", example="Custom Invoice Notification"),
     *                 @OA\Property(property="estimate_email_template_id", type="integer", example=460000000052073),
     *                 @OA\Property(property="estimate_email_template_name", type="string", example="Custom Estimate Notification"),
     *                 @OA\Property(property="creditnote_email_template_id", type="integer", example=460000000052075),
     *                 @OA\Property(property="creditnote_email_template_name", type="string", example="Custom Credit Note Notification")
     *             ),
     *             @OA\Property(property="language_code", type="string", example="en"),
     *             @OA\Property(property="notes", type="string", example="Payment option : Through check"),
     *             @OA\Property(property="vat_reg_no", type="string", example="string"),
     *             @OA\Property(property="tax_reg_no", type="integer", example=12345678912345),
     *             @OA\Property(property="country_code", type="string", example="US"),
     *             @OA\Property(property="vat_treatment", type="string", example="string"),
     *             @OA\Property(property="tax_treatment", type="string", example="string"),
     *             @OA\Property(property="tax_regime", type="string", example="general_legal_person"),
     *             @OA\Property(property="legal_name", type="string", example="ESCUELA KEMPER URGATE"),
     *             @OA\Property(property="is_tds_registered", type="boolean", example=true),
     *             @OA\Property(property="avatax_exempt_no", type="string", example="string"),
     *             @OA\Property(property="avatax_use_code", type="string", example="string"),
     *             @OA\Property(property="tax_exemption_id", type="integer", example=11149000000061054),
     *             @OA\Property(property="tax_authority_id", type="integer", example=11149000000061052),
     *             @OA\Property(property="tax_id", type="integer", example=11149000000061058),
     *             @OA\Property(property="is_taxable", type="boolean", example=true),
     *             @OA\Property(property="facebook", type="string", example="zoho"),
     *             @OA\Property(property="twitter", type="string", example="zoho"),
     *             @OA\Property(property="place_of_contact", type="string", example="TN"),
     *             @OA\Property(property="gst_no", type="string", example="22AAAAA0000A1Z5"),
     *             @OA\Property(property="gst_treatment", type="string", example="business_gst"),
     *             @OA\Property(property="tax_authority_name", type="string", example="string"),
     *             @OA\Property(property="tax_exemption_code", type="string", example="string")
     *         )
     *     ),
     *     @OA\Response(response=400, description="Invalid input")
     * )
     */
    public function store(Request $request)
    {
        //

        return response()->json([]);
    }

    /**
     * @OA\Get(
     *     path="api/v1/ahwstore/customers/{id}",
     *     tags={"Customers"},
     *     summary="Get a specific customer",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Customer ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="contact_name", type="string", example="Bowman and Co"),
     *             @OA\Property(property="company_name", type="string", example="Bowman and Co"),
     *             @OA\Property(property="payment_terms", type="integer", example=15),
     *             @OA\Property(property="currency_id", type="integer", example=460000000000097),
     *             @OA\Property(property="website", type="string", example="www.bowmanfurniture.com"),
     *             @OA\Property(property="contact_type", type="string", example="customer"),
     *             @OA\Property(property="custom_fields", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="value", type="string", example="GBGD078"),
     *                 @OA\Property(property="index", type="integer", example=1)
     *             )),
     *             @OA\Property(property="opening_balances", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="location_id", type="string", example="460000000038080"),
     *                 @OA\Property(property="exchange_rate", type="number", format="float", example=1),
     *                 @OA\Property(property="opening_balance_amount", type="number", format="float", example=1200)
     *             )),
     *             @OA\Property(property="billing_address", type="object",
     *                 @OA\Property(property="attention", type="string", example="Mr.John"),
     *                 @OA\Property(property="address", type="string", example="4900 Hopyard Rd"),
     *                 @OA\Property(property="street2", type="string", example="Suit 310"),
     *                 @OA\Property(property="city", type="string", example="Pleasanton"),
     *                 @OA\Property(property="state", type="string", example="California"),
     *                 @OA\Property(property="zip", type="integer", example=94588),
     *                 @OA\Property(property="country", type="string", example="U.S.A")
     *             ),
     *             @OA\Property(property="shipping_address", type="object",
     *                 @OA\Property(property="attention", type="string", example="Mr.John"),
     *                 @OA\Property(property="address", type="string", example="4900 Hopyard Rd"),
     *                 @OA\Property(property="street2", type="string", example="Suit 310"),
     *                 @OA\Property(property="city", type="string", example="Pleasanton"),
     *                 @OA\Property(property="state", type="string", example="California"),
     *                 @OA\Property(property="zip", type="integer", example=94588),
     *                 @OA\Property(property="country", type="string", example="U.S.A")
     *             ),
     *             @OA\Property(property="contact_persons", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="salutation", type="string", example="Mr"),
     *                 @OA\Property(property="first_name", type="string", example="Will"),
     *                 @OA\Property(property="last_name", type="string", example="Smith"),
     *                 @OA\Property(property="email", type="string", example="willsmith@bowmanfurniture.com"),
     *                 @OA\Property(property="phone", type="string", example="+1-925-921-9201"),
     *                 @OA\Property(property="mobile", type="string", example="+1-4054439562"),
     *                 @OA\Property(property="is_primary_contact", type="boolean", example=true)
     *             )),
     *             @OA\Property(property="default_templates", type="object",
     *                 @OA\Property(property="invoice_template_id", type="integer", example=460000000052069),
     *                 @OA\Property(property="invoice_template_name", type="string", example="Custom Classic"),
     *                 @OA\Property(property="estimate_template_id", type="integer", example=460000000000179),
     *                 @OA\Property(property="estimate_template_name", type="string", example="Service - Professional"),
     *                 @OA\Property(property="creditnote_template_id", type="integer", example=460000000000211),
     *                 @OA\Property(property="creditnote_template_name", type="string", example="Fixed Cost - Professional"),
     *                 @OA\Property(property="invoice_email_template_id", type="integer", example=460000000052071),
     *                 @OA\Property(property="invoice_email_template_name", type="string", example="Custom Invoice Notification"),
     *                 @OA\Property(property="estimate_email_template_id", type="integer", example=460000000052073),
     *                 @OA\Property(property="estimate_email_template_name", type="string", example="Custom Estimate Notification"),
     *                 @OA\Property(property="creditnote_email_template_id", type="integer", example=460000000052075),
     *                 @OA\Property(property="creditnote_email_template_name", type="string", example="Custom Credit Note Notification")
     *             ),
     *             @OA\Property(property="language_code", type="string", example="en"),
     *             @OA\Property(property="notes", type="string", example="Payment option : Through check"),
     *             @OA\Property(property="vat_reg_no", type="string", example="string"),
     *             @OA\Property(property="tax_reg_no", type="integer", example=12345678912345),
     *             @OA\Property(property="country_code", type="string", example="US"),
     *             @OA\Property(property="vat_treatment", type="string", example="string"),
     *             @OA\Property(property="tax_treatment", type="string", example="string"),
     *             @OA\Property(property="tax_regime", type="string", example="general_legal_person"),
     *             @OA\Property(property="legal_name", type="string", example="ESCUELA KEMPER URGATE"),
     *             @OA\Property(property="is_tds_registered", type="boolean", example=true),
     *             @OA\Property(property="avatax_exempt_no", type="string", example="string"),
     *             @OA\Property(property="avatax_use_code", type="string", example="string"),
     *             @OA\Property(property="tax_exemption_id", type="integer", example=11149000000061054),
     *             @OA\Property(property="tax_authority_id", type="integer", example=11149000000061052),
     *             @OA\Property(property="tax_id", type="integer", example=11149000000061058),
     *             @OA\Property(property="is_taxable", type="boolean", example=true),
     *             @OA\Property(property="facebook", type="string", example="zoho"),
     *             @OA\Property(property="twitter", type="string", example="zoho"),
     *             @OA\Property(property="place_of_contact", type="string", example="TN"),
     *             @OA\Property(property="gst_no", type="string", example="22AAAAA0000A1Z5"),
     *             @OA\Property(property="gst_treatment", type="string", example="business_gst"),
     *             @OA\Property(property="tax_authority_name", type="string", example="string"),
     *             @OA\Property(property="tax_exemption_code", type="string", example="string")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Customer not found")
     * )
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
     * @OA\Put(
     *     path="api/v1/ahwstore/customers/{id}",
     *     tags={"Customers"},
     *     summary="Update a customer",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Customer ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="contact_name", type="string", example="Bowman and Co"),
     *             @OA\Property(property="company_name", type="string", example="Bowman and Co"),
     *             @OA\Property(property="payment_terms", type="integer", example=15),
     *             @OA\Property(property="currency_id", type="integer", example=460000000000097),
     *             @OA\Property(property="website", type="string", example="www.bowmanfurniture.com"),
     *             @OA\Property(property="contact_type", type="string", example="customer"),
     *             @OA\Property(property="custom_fields", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="value", type="string", example="GBGD078"),
     *                 @OA\Property(property="index", type="integer", example=1)
     *             )),
     *             @OA\Property(property="opening_balances", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="location_id", type="string", example="460000000038080"),
     *                 @OA\Property(property="exchange_rate", type="number", format="float", example=1),
     *                 @OA\Property(property="opening_balance_amount", type="number", format="float", example=1200)
     *             )),
     *             @OA\Property(property="billing_address", type="object",
     *                 @OA\Property(property="attention", type="string", example="Mr.John"),
     *                 @OA\Property(property="address", type="string", example="4900 Hopyard Rd"),
     *                 @OA\Property(property="street2", type="string", example="Suit 310"),
     *                 @OA\Property(property="city", type="string", example="Pleasanton"),
     *                 @OA\Property(property="state", type="string", example="California"),
     *                 @OA\Property(property="zip", type="integer", example=94588),
     *                 @OA\Property(property="country", type="string", example="U.S.A")
     *             ),
     *             @OA\Property(property="shipping_address", type="object",
     *                 @OA\Property(property="attention", type="string", example="Mr.John"),
     *                 @OA\Property(property="address", type="string", example="4900 Hopyard Rd"),
     *                 @OA\Property(property="street2", type="string", example="Suit 310"),
     *                 @OA\Property(property="city", type="string", example="Pleasanton"),
     *                 @OA\Property(property="state", type="string", example="California"),
     *                 @OA\Property(property="zip", type="integer", example=94588),
     *                 @OA\Property(property="country", type="string", example="U.S.A")
     *             ),
     *             @OA\Property(property="contact_persons", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="salutation", type="string", example="Mr"),
     *                 @OA\Property(property="first_name", type="string", example="Will"),
     *                 @OA\Property(property="last_name", type="string", example="Smith"),
     *                 @OA\Property(property="email", type="string", example="willsmith@bowmanfurniture.com"),
     *                 @OA\Property(property="phone", type="string", example="+1-925-921-9201"),
     *                 @OA\Property(property="mobile", type="string", example="+1-4054439562"),
     *                 @OA\Property(property="is_primary_contact", type="boolean", example=true)
     *             )),
     *             @OA\Property(property="default_templates", type="object",
     *                 @OA\Property(property="invoice_template_id", type="integer", example=460000000052069),
     *                 @OA\Property(property="invoice_template_name", type="string", example="Custom Classic"),
     *                 @OA\Property(property="estimate_template_id", type="integer", example=460000000000179),
     *                 @OA\Property(property="estimate_template_name", type="string", example="Service - Professional"),
     *                 @OA\Property(property="creditnote_template_id", type="integer", example=460000000000211),
     *                 @OA\Property(property="creditnote_template_name", type="string", example="Fixed Cost - Professional"),
     *                 @OA\Property(property="invoice_email_template_id", type="integer", example=460000000052071),
     *                 @OA\Property(property="invoice_email_template_name", type="string", example="Custom Invoice Notification"),
     *                 @OA\Property(property="estimate_email_template_id", type="integer", example=460000000052073),
     *                 @OA\Property(property="estimate_email_template_name", type="string", example="Custom Estimate Notification"),
     *                 @OA\Property(property="creditnote_email_template_id", type="integer", example=460000000052075),
     *                 @OA\Property(property="creditnote_email_template_name", type="string", example="Custom Credit Note Notification")
     *             ),
     *             @OA\Property(property="language_code", type="string", example="en"),
     *             @OA\Property(property="notes", type="string", example="Payment option : Through check"),
     *             @OA\Property(property="vat_reg_no", type="string", example="string"),
     *             @OA\Property(property="tax_reg_no", type="integer", example=12345678912345),
     *             @OA\Property(property="country_code", type="string", example="US"),
     *             @OA\Property(property="vat_treatment", type="string", example="string"),
     *             @OA\Property(property="tax_treatment", type="string", example="string"),
     *             @OA\Property(property="tax_regime", type="string", example="general_legal_person"),
     *             @OA\Property(property="legal_name", type="string", example="ESCUELA KEMPER URGATE"),
     *             @OA\Property(property="is_tds_registered", type="boolean", example=true),
     *             @OA\Property(property="avatax_exempt_no", type="string", example="string"),
     *             @OA\Property(property="avatax_use_code", type="string", example="string"),
     *             @OA\Property(property="tax_exemption_id", type="integer", example=11149000000061054),
     *             @OA\Property(property="tax_authority_id", type="integer", example=11149000000061052),
     *             @OA\Property(property="tax_id", type="integer", example=11149000000061058),
     *             @OA\Property(property="is_taxable", type="boolean", example=true),
     *             @OA\Property(property="facebook", type="string", example="zoho"),
     *             @OA\Property(property="twitter", type="string", example="zoho"),
     *             @OA\Property(property="place_of_contact", type="string", example="TN"),
     *             @OA\Property(property="gst_no", type="string", example="22AAAAA0000A1Z5"),
     *             @OA\Property(property="gst_treatment", type="string", example="business_gst"),
     *             @OA\Property(property="tax_authority_name", type="string", example="string"),
     *             @OA\Property(property="tax_exemption_code", type="string", example="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customer updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="contact_name", type="string", example="Bowman and Co"),
     *             @OA\Property(property="company_name", type="string", example="Bowman and Co"),
     *             @OA\Property(property="payment_terms", type="integer", example=15),
     *             @OA\Property(property="currency_id", type="integer", example=460000000000097),
     *             @OA\Property(property="website", type="string", example="www.bowmanfurniture.com"),
     *             @OA\Property(property="contact_type", type="string", example="customer"),
     *             @OA\Property(property="custom_fields", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="value", type="string", example="GBGD078"),
     *                 @OA\Property(property="index", type="integer", example=1)
     *             )),
     *             @OA\Property(property="opening_balances", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="location_id", type="string", example="460000000038080"),
     *                 @OA\Property(property="exchange_rate", type="number", format="float", example=1),
     *                 @OA\Property(property="opening_balance_amount", type="number", format="float", example=1200)
     *             )),
     *             @OA\Property(property="billing_address", type="object",
     *                 @OA\Property(property="attention", type="string", example="Mr.John"),
     *                 @OA\Property(property="address", type="string", example="4900 Hopyard Rd"),
     *                 @OA\Property(property="street2", type="string", example="Suit 310"),
     *                 @OA\Property(property="city", type="string", example="Pleasanton"),
     *                 @OA\Property(property="state", type="string", example="California"),
     *                 @OA\Property(property="zip", type="integer", example=94588),
     *                 @OA\Property(property="country", type="string", example="U.S.A")
     *             ),
     *             @OA\Property(property="shipping_address", type="object",
     *                 @OA\Property(property="attention", type="string", example="Mr.John"),
     *                 @OA\Property(property="address", type="string", example="4900 Hopyard Rd"),
     *                 @OA\Property(property="street2", type="string", example="Suit 310"),
     *                 @OA\Property(property="city", type="string", example="Pleasanton"),
     *                 @OA\Property(property="state", type="string", example="California"),
     *                 @OA\Property(property="zip", type="integer", example=94588),
     *                 @OA\Property(property="country", type="string", example="U.S.A")
     *             ),
     *             @OA\Property(property="contact_persons", type="array", @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="salutation", type="string", example="Mr"),
     *                 @OA\Property(property="first_name", type="string", example="Will"),
     *                 @OA\Property(property="last_name", type="string", example="Smith"),
     *                 @OA\Property(property="email", type="string", example="willsmith@bowmanfurniture.com"),
     *                 @OA\Property(property="phone", type="string", example="+1-925-921-9201"),
     *                 @OA\Property(property="mobile", type="string", example="+1-4054439562"),
     *                 @OA\Property(property="is_primary_contact", type="boolean", example=true)
     *             )),
     *             @OA\Property(property="default_templates", type="object",
     *                 @OA\Property(property="invoice_template_id", type="integer", example=460000000052069),
     *                 @OA\Property(property="invoice_template_name", type="string", example="Custom Classic"),
     *                 @OA\Property(property="estimate_template_id", type="integer", example=460000000000179),
     *                 @OA\Property(property="estimate_template_name", type="string", example="Service - Professional"),
     *                 @OA\Property(property="creditnote_template_id", type="integer", example=460000000000211),
     *                 @OA\Property(property="creditnote_template_name", type="string", example="Fixed Cost - Professional"),
     *                 @OA\Property(property="invoice_email_template_id", type="integer", example=460000000052071),
     *                 @OA\Property(property="invoice_email_template_name", type="string", example="Custom Invoice Notification"),
     *                 @OA\Property(property="estimate_email_template_id", type="integer", example=460000000052073),
     *                 @OA\Property(property="estimate_email_template_name", type="string", example="Custom Estimate Notification"),
     *                 @OA\Property(property="creditnote_email_template_id", type="integer", example=460000000052075),
     *                 @OA\Property(property="creditnote_email_template_name", type="string", example="Custom Credit Note Notification")
     *             ),
     *             @OA\Property(property="language_code", type="string", example="en"),
     *             @OA\Property(property="notes", type="string", example="Payment option : Through check"),
     *             @OA\Property(property="vat_reg_no", type="string", example="string"),
     *             @OA\Property(property="tax_reg_no", type="integer", example=12345678912345),
     *             @OA\Property(property="country_code", type="string", example="US"),
     *             @OA\Property(property="vat_treatment", type="string", example="string"),
     *             @OA\Property(property="tax_treatment", type="string", example="string"),
     *             @OA\Property(property="tax_regime", type="string", example="general_legal_person"),
     *             @OA\Property(property="legal_name", type="string", example="ESCUELA KEMPER URGATE"),
     *             @OA\Property(property="is_tds_registered", type="boolean", example=true),
     *             @OA\Property(property="avatax_exempt_no", type="string", example="string"),
     *             @OA\Property(property="avatax_use_code", type="string", example="string"),
     *             @OA\Property(property="tax_exemption_id", type="integer", example=11149000000061054),
     *             @OA\Property(property="tax_authority_id", type="integer", example=11149000000061052),
     *             @OA\Property(property="tax_id", type="integer", example=11149000000061058),
     *             @OA\Property(property="is_taxable", type="boolean", example=true),
     *             @OA\Property(property="facebook", type="string", example="zoho"),
     *             @OA\Property(property="twitter", type="string", example="zoho"),
     *             @OA\Property(property="place_of_contact", type="string", example="TN"),
     *             @OA\Property(property="gst_no", type="string", example="22AAAAA0000A1Z5"),
     *             @OA\Property(property="gst_treatment", type="string", example="business_gst"),
     *             @OA\Property(property="tax_authority_name", type="string", example="string"),
     *             @OA\Property(property="tax_exemption_code", type="string", example="string")
     *         )
     *     ),
     *     @OA\Response(response=400, description="Invalid input"),
     *     @OA\Response(response=404, description="Customer not found")
     * )
     */
    public function update(Request $request, $id)
    {
        //

        return response()->json([]);
    }

    /**
     * @OA\Delete(
     *     path="api/v1/ahwstore/customers/{id}",
     *     tags={"Customers"},
     *     summary="Delete a customer",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Customer ID",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Customer deleted successfully"
     *     ),
     *     @OA\Response(response=404, description="Customer not found")
     * )
     */
    public function destroy($id)
    {
        //

        return response()->json([]);
    }
}
