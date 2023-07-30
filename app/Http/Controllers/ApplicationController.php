<?php

namespace App\Http\Controllers;

use App\Http\Requests\api\v1\StoreApplicationRequest;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    //

    public function index()
    {
        $applications = Application::all();

        return response()->json(["message" => "", "data" => $applications]);
    }

    public function store(StoreApplicationRequest $request)
    {
        $request->validated($request->all());

        Application::create($request->all());

        return response()->json(["message" => "Application created successfully", 200]);
    }
}
