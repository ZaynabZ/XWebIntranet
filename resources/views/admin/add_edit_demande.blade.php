@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-1 grid-margin "></div>
    <div class="col-lg-10 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Liste des Demandes</h4>
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>
                                Demande
                            </th>
                            <th>
                                Actions
                            </th>
                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($demandes as $demande)
                            <tr>
                            <td class="py-1">
                                {{ $demande->type_demande }}
                            </td>
                            <td >
                                <div class="btn-toolbar" role="group">
                                    <a href="{{ url('/demandes_admin')}}/{{$demande->id}}" class="btn btn-success btn-sm mr-2"><i class="mdi mdi-lead-pencil"></i></a>
                                <form action="{{ url('/delete_demande') }}/{{$demande->id}}" method="POST"> 
                                    @csrf
                                    <button class="btn btn-danger btn-sm ml-2" type="submit"><i class="mdi mdi-delete"></i></button>
                                    </form>     
                                </div>
                            </td>                         
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <div class="col-lg-1 grid-margin "></div>
</div>
<div class="row">
<div class="col-md-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Ajouter une Demande</h4>
            <form action="{{ url('/demandes_admin') }}" class="forms-sample" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Type Demande</label>                            
                            <div class="col-sm-9">
                                <input name="id" value="{{ $theDemande->id ?? '0' }}" hidden />
                                <input autocomplete="off" name="type_demande" type="text" 
                                        class="form-control @error('type_demande') is-invalid @enderror" 
                                        placeholder="Demande" aria-label="Label"
                                        value="{{ $theDemande->type_demande ?? '' }}">
                                @error('type_demande')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>    
                </div>
               
                
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
                
        </div>  
    </div>
</div>
</div>
@endsection