@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Company: '.session("clinicName")) }}</div>
                <div class="card-body">

                @if(!empty($patients))
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Id</id>
                                <td>FullName</id>
                                <td>GovernmentId</id>
                                <td>Actions</id>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($patients as $patient)
                            <tr>
                                <td>{{$patient->id}}</td> 
                                <td>{{$patient->fullname}}</td> 
                                <td>{{$patient->governmentId}}</td> 
                                <td>
                                    <button type="button" class="btn btn-primary">Edit</button>
                                    <button type="button" class="btn btn-danger">Remove</button>
                                    <button type="button" class="btn btn-success">View Diagnostic</button>
                                </td> 
                            </tr>
                        @endforeach
                        </tbody>
                        
                    </table>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
