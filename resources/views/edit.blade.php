@extends('layouts.app')
@php
    $fullname = '';
    $governmentId = '';
@endphp
@if(!empty($patient))
    @php
        $fullname = $patient->fullname;
        $governmentId = $patient->governmentId;
    @endphp
@endif
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if(!empty($patient))
                        Edit patient for clinic:
                    @else
                        New patient for clinic: 
                    @endif
                    {{session("clinicName")}}
                </div>
                
                <div class="card-body">
                    <form action="{{ !empty($patient) ? route('patient.edit', [$patient->id]) : route('patient.store')}}" method="POST">
                    @csrf
                    <div class="form-group row">

                        <div class="col-md-3">
                            <label for="patientFullname" class="form-label">FullName</label>
                            <input type="text" class="form-control" id="patientFullname" name="fullname" placeholder="Pedro Rodriguez Rodriguez" value="{{$fullname}}">
                            @if ($errors->has('fullname'))
                                <span class="text-danger">
                                    <strong>{{$errors->first('fullname')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <label for="patientGovernmentId" class="form-label">GovernmentId</label>
                            <input type="text" class="form-control" id="patientGovernmentId" name="governmentId" placeholder="12345678F" value="{{$governmentId}}">
                            @if ($errors->has('governmentId'))
                                <span class="text-danger">
                                    <strong>{{$errors->first('governmentId')}}</strong>
                                </span>
                            @endif
                        </div>
                        @if(empty($patient))
                            <div class="col-md-3">
                                <label for="patientClinicId" class="form-label">Clinic</label>
                                <select id="patientClinicId" class="form-control form-select-sm" name="clinicId" aria-label="Default select example">
                                    <option selected>Choose Clinic</option>
                                    @foreach($clinics as $clinic)
                                        <option value="{{$clinic->id}}">{{$clinic->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('clinicId'))
                                <span class="text-danger">
                                    <strong>{{$errors->first('clinicId')}}</strong>
                                </span>
                            @endif
                            </div>
                        @endif
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary">
                                Save Patient!!!
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection