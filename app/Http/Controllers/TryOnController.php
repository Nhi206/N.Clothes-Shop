<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TryOnController extends Controller
{
    public function tryOn(Request $request)
    {
        $request->validate([
            'person_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'shirt_image' => 'required|string'
        ]);

        try {
            // Initialize Intervention Image
            $manager = new ImageManager(new Driver());
            
            // Get person image
            $personFile = $request->file('person_image');
            $personImage = $manager->read($personFile->getPathname());
            
            // Get shirt image from base64
            $shirtDataUrl = $request->input('shirt_image');
            
            // Decode base64 shirt image
            if (strpos($shirtDataUrl, 'data:image') === 0) {
                $base64Data = explode(',', $shirtDataUrl)[1];
                $shirtBinary = base64_decode($base64Data);
                $shirtImage = $manager->read($shirtBinary);
            } else {
                return response()->json(['error' => 'Invalid shirt image format'], 400);
            }
            
            // Resize person image to a standard height
            $personHeight = 600;
            $personImage->scaleDown(height: $personHeight);
            
            // Calculate shirt size (approximately 40% of person height)
            $shirtHeight = (int)($personHeight * 0.4);
            $shirtImage->scaleDown(height: $shirtHeight);
            
            // Create canvas (person width, person height)
            $canvasWidth = max($personImage->width(), $shirtImage->width());
            $canvasHeight = $personImage->height();
            
            // Create empty canvas with white background
            $canvas = $manager->create($canvasWidth, $canvasHeight)
                ->fill('ffffff');
            
            // Place person image centered
            $personX = (int)(($canvasWidth - $personImage->width()) / 2);
            $personY = 50;
            $canvas->place($personImage, 'top-left', $personX, $personY);
            
            // Place shirt image at center-top of person
            $shirtX = (int)(($canvasWidth - $shirtImage->width()) / 2);
            $shirtY = 150;
            $canvas->place($shirtImage, 'top-left', $shirtX, $shirtY);
            
            // Convert to base64 for response
            $resultImage = $canvas->toJpeg(quality: 90);
            $base64Result = 'data:image/jpeg;base64,' . base64_encode($resultImage);
            
            return response()->json([
                'success' => true,
                'image' => $base64Result
            ]);
        } catch (\Exception $e) {
            \Log::error('Try-on error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to process try-on: ' . $e->getMessage()
            ], 500);
        }
    }
}
