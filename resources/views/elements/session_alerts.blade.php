<!-- Display the success status -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    <br />
@endif

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    <br />
@endif

<!-- Display the errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li> 
            @endforeach
        </ul>
    </div>
    <br />
@endif

@if (session('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
    <br />
@endif

@if (session('failure'))
    <div class="alert alert-danger">
        <p>{{ session('failure') }}</p>
    </div>
    <br />
@endif