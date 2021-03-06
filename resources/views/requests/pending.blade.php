@extends('layouts.app')

@section('columns', '10')
@section('title', 'Pending Adoption Requests')


@section('content')    
    @include('elements.session_alerts')
    <table class="table table-striped table-bordered table-hover table-pink">
        <thead> 
            <tr>
                <th>@sortablelink('id', 'Request ID')</th>
                <th>Animal Name</th>
                @if(Gate::allows('admin-functionality'))
                    <th>Requester</th>
                @endif
                <th>@sortablelink('created_at', 'Request Date')</th>
                <th colspan="4">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ $request->animal_name }}</td>
                    @if(Gate::allows('admin-functionality'))
                        <td>{{ $request->user_name }}</td>
                    @endif
                    <td>{{ date("l jS \of F Y h:i A", strtotime($request->created_at)) }}</td>
                    <td>
                        <a href="{{ route('requests.show', ['request' => $request['id']]) }}" class="btn btn-blue">Details</a>
                    </td>
                    @if(Gate::allows('admin-functionality'))
                        <td>
                            <form method="POST" action="{{ route('update_request_status', ['id' => $request['id']]) }}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <input type="submit" class="btn btn-green" name="submitButton" value="Approve" />
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('update_request_status', ['id' => $request['id']]) }}" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <input type="submit" class="btn btn-red" name="submitButton" value="Deny" />
                            </form>
                        </td>
                    @endif
                    <td>
                        <form action="{{ action([App\Http\Controllers\RequestController::class, 'destroy'], ['request' => $request['id']]) }}" method="post">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE" /> 
                            <button class="btn btn-red" type="submit" onclick="return confirm('Are you sure you want to cancel the adoption request for {{ $request->animal_name }}?')">Cancel</button>
                        </form> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $requests->appends(\Request::except('page'))->render() }}
@endsection