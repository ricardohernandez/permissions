<?php

namespace App\Http\Controllers\Back_end\Users;
use Inertia\Inertia;
use App\Models\Leader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LeadersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $this->authorize('view',Auth::user()); */

        $query = DB::table('leaders');

        if(request('search')){
            $query->where('name' , 'LIKE' ,'%'.request('search').'%');
        }

        if(request()->has(['field', 'direction'])){
            $query->orderBy(request('field'),request('direction'));
        }
        
        if (Auth::user()->can('leaders.index')) {

            return Inertia::render('Back_end/Users/Leaders/Index', [
                'leaders' => $query->paginate(50)->withQueryString(),
                'tbfilters' => request()->all(['search' , 'field' , 'direction'])
            ]);

        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
