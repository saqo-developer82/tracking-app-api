<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackingRequest;
use App\Services\TrackingService;
use Illuminate\Http\JsonResponse;

class TrackingController extends Controller
{
    private TrackingService $trackingService;

    public function __construct(TrackingService $trackingService)
    {
        $this->trackingService = $trackingService;
    }

    /**
     * Handles the tracking process by fetching tracking information
     * based on the provided tracking code in the request.
     *
     * @param TrackingRequest $request The request containing the tracking code.
     * @return JsonResponse The response containing the tracking information or an error message.
     */
    public function show(TrackingRequest $request): JsonResponse
    {
        $trackingCode = strtoupper(trim($request->input('tracking_code')));

        $trackingInfo = $this->trackingService->getTrackingInfo($trackingCode);

        if (!$trackingInfo) {
            return response()->json([
                'success' => false,
                'message' => 'Tracking code not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Tracking information retrieved successfully.',
            'data' => $trackingInfo
        ]);
    }
}
