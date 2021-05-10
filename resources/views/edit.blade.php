@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit patient for clinic: '.session("clinicName")) }}</div>
                
                
                <div class="card-body">
                @if(!empty($patient))
                    <form action="{{ route('patient.edit', [$patient->id]) }}" method="POST">
                    @csrf
                    <div class="form-group row">

                        <div class="col-md-6">
                            <label for="patientFullname" class="form-label">FullName</label>
                            <input type="text" class="form-control" id="patientFullname" name="fullname" placeholder="name@example.com" value="{{$patient->fullname}}">
                        </div>
                        <div class="col-md-6">
                            <label for="patientGovernmentId" class="form-label">GovernmentId</label>
                            <input type="text" class="form-control" id="patientGovernmentId" name="governmentId" placeholder="12345678F" value="{{$patient->governmentId}}">
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary">
                                Save Patient!!!
                            </button>
                        </div>
                    </div>
                    </form>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection