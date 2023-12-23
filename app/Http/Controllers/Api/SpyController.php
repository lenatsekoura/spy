<?php

namespace App\Http\Controllers\Api;

use App\Models\Spy;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
                    if(isset($request->filter[$key]) && $key == 'age_range') {
                        $spies = $spies->get('dob')
                            ->map(fn ($spy) => Carbon::parse($spy->dob)->age);

                        $partitions = [
                            '-18' => $spies->sum(fn ($age) => $age <= 18),
                            '18-27' => $spies->sum(fn ($age) => $age > 18 && $age <= 27),
                            '28-65' => $spies->sum(fn ($age) => $age > 27 && $age <= 65),
                            '65+' => $spies->sum(fn ($age) => $age > 65)
                        ];

                        return response()->json( $partitions );

                    } elseif (isset($request->filter[$key]) && $key == 'age_exact_match') {
                        $spies = $spies->get()->groupBy(fn ($spy) => Carbon::parse($spy->dob)->age);
                        $spies = $spies->get($value);

                        if ($spies) {                            
                            return response()->json( $spies );
                        } else {
                            return response()->json( ['message' => 'There are not records with this age.'] );
                        }
                        
                    } else {
                        if(isset($request->filter[$key])) {
                            $spies->where($key, $request->filter[$key]);
                        }
                    }
                } else {
                    return response()->json( [
                        'message' => 'Filter ( ' . $key . ' ) is not supported!'],
                        404 );
                }
            }
        }

        if(isset($request->sort)) {
            if(isset($request->sort['fullname'])) {
                $spies->orderByRaw('CONCAT(name, surname)');
            } 
            if(isset($request->sort['dob'])) {
                $spies->orderBy('dob','asc');
            }            
            if(isset($request->sort['fullname']) && isset($request->sort['dob'])) {
                $spies->orderByRaw('CONCAT(name, surname)')->orderBy('dob','asc');
            }
        }

        return response()->json( $spies->paginate(10) );

    }

    public function getSpiesRandom(Request $request)
    {
        $spies = Spy::all()->random(5);

        return response()->json( $spies );

    }    
}
