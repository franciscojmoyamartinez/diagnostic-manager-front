@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Company: '.session("clinicName")) }}</div>
                @if(!empty(session()->get('statusCode')) && session()->get('statusCode')=== 204)
                    @if(session()->get('statusCode') === 204)
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
                        <thead>
                            <tr>
                                <td>Id</id>
                                <td>FullName</id>
                                <td>GovernmentId</id>
                                <td>Actions</id>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                            Add Patient
                            </td>
                        </tr>
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
                                    <button type="button" class="btn btn-success m-1">View Diagnostics</button>
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
