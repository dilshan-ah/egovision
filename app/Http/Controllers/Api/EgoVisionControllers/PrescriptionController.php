<?php

namespace App\Http\Controllers\Api\EgoVisionControllers;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrescriptionController extends Controller
{
    public function showPrescription(string $userId)
    {
        // Retrieve the latest prescription for the specified user
        $prescription = Prescription::where('user_id', $userId)
            ->select('id', 'file', 'created_at')
            ->orderBy('created_at', 'desc')
            ->first();
    
        if ($prescription) {
            $prescription->file = 'http://egovision.shop/' . $prescription->file;
    
            return response()->json($prescription);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'No prescription found.'
        ], 404); // 404 Not Found
    }


    public function uploadPrescriptionSubmit(Request $request, string $userID)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpeg,png,jpg,pdf|max:2048', // Validate file type and size
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors occurred.',
                'errors' => $validator->errors() // Return the validation errors
            ], 422); // HTTP status 422 for unprocessable entity
        }
    
        // Check if the file is present in the request
        if ($request->hasFile('file')) {
            try {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('prescriptions');
    
                // Move the uploaded file to the specified destination
                $file->move($destinationPath, $filename);
    
                // Create a new prescription record
                $prescription = new Prescription();
                $prescription->user_id = $userID; // Set the user_id
                $prescription->file = 'prescriptions/' . $filename; // Save the file path
                $prescription->save(); // Save the prescription
    
                // Return success response
                return response()->json([
                    'success' => true,
                    'message' => 'Prescription uploaded successfully!',
                    'prescription' => [
                        'id' => $prescription->id,
                        'file' => $prescription->file,
                        'created_at' => $prescription->created_at
                    ]
                ], 201); // HTTP status 201 for created
            } catch (\Exception $e) {
                // Handle any exceptions that may occur during the file upload
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while uploading the prescription.',
                    'error' => $e->getMessage() // Optionally include the error message
                ], 500); // HTTP status 500 for server error
            }
        }
    
        // Return error response if file not uploaded
        return response()->json([
            'success' => false,
            'message' => 'No file was uploaded, please try again.'
        ], 400); // HTTP status 400 for bad request
    }    
    
}
