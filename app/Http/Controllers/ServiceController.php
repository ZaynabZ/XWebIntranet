<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;
use App\Role;
use Auth;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.services', [
            'services' => $services
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin()){
            $role_name = 'Supervisor';
            $supervisor = Role::where('role_name', $role_name)->first();
            //dd($supervisor_role_id);
            $supervisors = User::where('role_id', $supervisor->id)
                                ->get();
            return view('admin.add_service')->with('supervisors', $supervisors);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'supervisor'=>'bail|required|string|unique:services',
         ]);
         
         $service = new Service();
         $service->name = $request->name;
         $service->supervisor = $request->supervisor;
         
         $service->save();

         return redirect(route('services'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        $role_name = 'Supervisor';
        $supervisor = Role::where('role_name', $role_name)->first();
        $supervisors = User::where('role_id', $supervisor->id)
                            ->get();
        return view('admin.edit_service')->with('service', $service)
                                        ->with('supervisors', $supervisors);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $service = Service::findOrFail($id);
        
        $this->validate($request,[
            'name'=>'bail|required|string|unique:services,name,' . $id,
         ]);
         
        
        $service->name = $request->name;
        $service->supervisor = $request->supervisor;
        $service->update();

        return redirect(route('services'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect(route('services'));
    }
}
