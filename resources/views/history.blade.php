@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('home')}}" class="btn btn-primary btn-sm m-2">Return to list patients</a>
                </div>
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
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Id</id>
                                <td>Description</id>
                                <td>Date</id>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($histories))
                            @foreach($histories as $history)
                                <tr>
                                    <td>{{$history->id}}</td> 
                                    <td>{{$history->description}}</td> 
                                    <td>{{date('d-m-Y H:i', strtotime($history->created_at))}}</td> 
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
