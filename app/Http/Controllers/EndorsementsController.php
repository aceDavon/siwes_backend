<?php

namespace App\Http\Controllers;

use App\Http\Requests\api\v1\StoreEndorsementRequest;
use App\Models\Endorsements;
use App\Models\LogBook;
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
        $validatedData = $request->validated();

        $endorsement = Endorsements::create($validatedData);

        if ($request->has('log_book_id')) {
            $logBook = LogBook::findOrFail($request->log_book_id);
            $logBook->is_isEndorsed = true;
            $logBook->save();

            $endorsement->logBook()->associate($logBook);
            $endorsement->save();
        }

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
