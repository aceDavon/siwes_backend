<?php

namespace App\Http\Controllers;

use App\Http\Requests\api\v1\StoreOpeningRequest;
use App\Models\Opening;
use Illuminate\Http\Request;

class OpeningController extends Controller
{
    public function index()
    {
        $openings = Opening::all();
        return response()->json(["message" => '', "data" => $openings]);
    }

    public function store(StoreOpeningRequest $request)
    {
        $request->validated($request->all());

        Opening::create($request->all());

        return response()->json(['message' => "Opening created successfully", "status" => "success"]);
    }
}
