@extends('layouts.app')

@section('columns', '10')
@section('title', 'All Adoption Requests')

@section('content')    
    @include('elements.session_alerts')
    <table class="table table-striped table-bordered table-hover table-pink">
        <thead> 
            <tr>
                <th>@sortablelink('id', 'Request ID')</th>
                @if(Gate::allows('admin-functionality'))
                    <th>Requester</th>
                @endif
                <th>Animal Name</th>
                <th>@sortablelink('created_at', 'Request Date')</th>
                <th>@sortablelink('adoption_status', 'Adoption Status')</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    @if(Gate::allows('admin-functionality'))
                        <td>{{ $request->user_name }}</td>
                    @endif
                    <td>{{ $request->animal_name }}</td>
                    <td>{{ date("l jS \of F Y h:i A", strtotime($request->created_at)) }}</td>
                    <td>{{ $request->adoption_status }}</td>
                    <td>
                        <a href="{{ route('requests.show', ['request' => $request['id']]) }}" class="btn btn-blue">Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $requests->appends(\Request::except('page'))->render() }}
@endsection