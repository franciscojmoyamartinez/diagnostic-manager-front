@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Company: '.session("clinicName")) }}</div>
                @if(!empty(session()->get('statusCode')))
                    @if(session()->get('statusCode') === 204 || session()->get('statusCode') === 201 || session()->get('statusCode') === 200)
                        @php ($textClass = 'success')
                    @else
                        @php ($textClass = 'danger')
                    @endif
                <div class="alert alert-{{$textClass}}" role="alert">
                    {{session()->get('status')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card-body">
                @if(!empty($patients))
                    <table class="table table-striped">
                        <a href="{{ route('patient.formView')}}" class="btn btn-primary btn-sm m-2 float-right">Add new Patient</a>
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
                                <td class="d-flex">
                                    <a class="btn btn-primary m-1" href="{{ route('patient.editView', [$patient->id])}}">Edit</a>
                                    <form action="{{ route('patients.delete', [$patient->id]) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE')}}
                                        <input type="submit" class="btn btn-danger m-1" value="Remove">
                                    </form>
                                    <a class="btn btn-success m-1" href="{{ route('patient.diagnostic', [$patient->id])}}">View Diagnostics</a>
                                    <a class="btn btn-info m-1" href="{{ route('patient.historical', [$patient->id])}}">View Historical</a>
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
