<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Arabhardware API Documentation",
 *      description="This is the API documentation for the Arabhardware project. It provides a comprehensive guide to interacting with the API endpoints.",
 *      @OA\Contact(
 *          email="sbilal@arabhardware.net",
 *          name="Support Team"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Arabhardware API Server"
 * )
 *
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="Authorization",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 *      description="Enter token in format (Bearer <token>)"
 * )
 *
 * @OA\PathItem(
 *      path="/api/"
 * )
 */
abstract class Controller
{
    //
}
