<?php

namespace App\Http\Controllers;

use App\Http\Requests\api\v1\StoreLogBookRequest;
use App\Models\LogBook;

class LogBookController extends Controller
{

    public function index()
    {
        return LogBook::all();
    }

    public function store(StoreLogBookRequest $request)
    {
        // $this->authorize('logBook.create');

        $request->validated($request->all());

        LogBook::create($request->all());

        return response(["message" => "Logbook created successfully", "status" => "success"]);
    }
}
