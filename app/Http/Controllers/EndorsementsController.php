<?php

namespace App\Http\Controllers;

use App\Http\Requests\api\v1\StoreEndorsementRequest;
use App\Models\Endorsements;
use Illuminate\Http\Request;

class EndorsementsController extends Controller
{
    //

    public function index()
    {
        return Endorsements::all();
    }

    public function store(StoreEndorsementRequest $request)
    {
        $this->authorize('endorse.create');

        $request->validated($request->all());

        Endorsements::create($request->all());

        return 'Endorsement created successfully.';
    }

    public function destroy($id)
    {
        $this->authorize('endorsement.delete');

        $endorsement = Endorsements::find($id);

        $endorsement->delete();

        return 'Endorsement deleted successfully.';
    }
}
