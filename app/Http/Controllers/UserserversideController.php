<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserserversideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = \App\Models\User::query();

            if ($request->has('search') && $request->search['value'] != '') {
                $search = $request->search['value'];
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            }

            $totalFiltered = $query->count();

            $users = $query->orderBy(
                $request->columns[$request->order[0]['column']]['data'],
                $request->order[0]['dir']
            )
                ->offset($request->start)
                ->limit($request->length)
                ->get();

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => \App\Models\User::count(),
                'recordsFiltered' => $totalFiltered,
                'data' => $users, // ✅ ini yang dikembalikan
            ]);
        }

        return view('cms.table.tablecreateuserserverside');
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
