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
                
                <form action="{{ route('diagnostic.store', [request()->patientId])}}" method="POST">
                    @csrf

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>Id</id>
                                <td>Diagnostic</id>
                                <td>Comments</id>
                                <td>Actions</id>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td><input type="text" class="form-control" id="diagnostic" name="diagnostic" placeholder="" value=""></td>
                                <td><input type="text" class="form-control" id="comments" name="comments" placeholder="" value=""></td>
                                <td><button type="submit" class="btn btn-primary">Save</td>
                            </tr>
                        @if(!empty($diagnostics))
                            @foreach($diagnostics as $diagnostic)
                                <tr>
                                    <td>{{$diagnostic->id}}</td> 
                                    <td>{{$diagnostic->diagnostic}}</td> 
                                    <td>{{$diagnostic->description}}</td> 
                                    <td class="d-flex">
                                    </td> 
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        
                    </table>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
