<?php

namespace App\Http\Controllers\Api;

use App\Models\Spy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSpyRequest;

class SpyController extends Controller
{
    public function store(StoreSpyRequest $request)
    {
        $spy = new Spy;
        $spy->name = $request->name;
        $spy->surname = $request->surname;
        $spy->agency = $request->agency;
        $spy->country_of_operation = $request->country_of_operation;
        $spy->dob = $request->dob;
        $spy->dod = $request->dod;
        $spy->save();

        return response()->json( [$spy], 201 );
        
    }

    public function getSpies(Request $request)
    {
        $supported_filters = ['name', 'surname', 'age_range', 'age_exact_match'];
        $spies = Spy::query();

        if(isset($request->filter)) {
            foreach($request->filter as $key => $value) {
                if(in_array($key,  $supported_filters)) {
                    if(isset($request->filter[$key])) {
                        $spies->where($key, $request->filter[$key]);
                    }
                } else {
                    return response()->json( ['message' => 'Not Supported Filter!'], 404 );
                }
            }
        }

        if(isset($request->sort)) {
            if(isset($request->sort['fullname'])) {
                $spies->orderByRaw('CONCAT(name, surname)');
            } 
            if(isset($request->sort['created_at'])) {
                $spies->orderBy('created_at','asc');
            }            
            if(isset($request->sort['fullname']) && isset($request->sort['created_at'])) {
                $spies->orderByRaw('CONCAT(name, surname)')->orderBy('created_at','desc');
            }
        }
  
        return response()->json( $spies->paginate(10) );

    }

    public function getSpiesRandom(Request $request)
    {
        $spies = Spy::all()->random(3);

        return response()->json( $spies );

    }    
}
