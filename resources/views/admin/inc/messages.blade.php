@if(session('success'))
    <div class="alert custom-alert bg-success text-center">
        <button class="btn btn-close" title="close message"><i class="fa fa-times" aria-hidden="true"></i></button>
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert custom-alert bg-error text-center">
        <button class="btn btn-close" title="close message"><i class="fa fa-times" aria-hidden="true"></i></button>
        {{session('error')}}
    </div>
@endif