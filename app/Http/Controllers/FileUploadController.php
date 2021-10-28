<?php

namespace App\Http\Controllers;

use App\Candidat;
use App\Http\Controllers\HelperController;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function cvUpload(){

        return view('admin.candidatures');
    }

    public function cvUploadPost(Request $request){
        //dd($request->cv_file);
        $request->validate([
            'nom_candidat' => 'required|string|max:255',
            'prenom_candidat' => 'required|string|max:255',
            'cv_file' => 'required|mimes:pdf,png,jpg,jpeg|max:2048',
        ]);

        $file_name = strtoupper($request->nom_candidat).'_'.strtoupper($request->prenom_candidat).'_'.date('Y-m-d').'.'.$request->cv_file->extension();
        //dd($file_name);
        $request->cv_file->move(public_path('cvs'),$file_name);

        $candidat = new Candidat;

        $candidat->nom_candidat = $request->nom_candidat;
        $candidat->prenom_candidat = $request->prenom_candidat;
        $candidat->emplacement = $file_name;

        $candidat->save();

        return back()
                ->with('success','Le candidat est téléchrgé avec succès.')
                ->with('cv_file',$file_name);

    }

    public function displayCvs(){
        $cv_emplacements = HelperController::parse_cv();
        return response()->json([
            'cv_emplacements'  => $cv_emplacements,
        ]);
    }

    public function deleteCV(Request $request)
    {  
        $file_name = $request->file_name;
        if(\File::exists(public_path('cvs/'.$file_name))){
            \File::delete(public_path('cvs/'.$file_name));
            
        }
        return response()->json([
            'deleted'  => 'yes',

        ]);

    } 
}
