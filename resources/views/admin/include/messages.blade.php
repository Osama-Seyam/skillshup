@if(session('msg') and str_contains(session('msg'), 'updated'))

<div class="alert alert-primary">
   {{ session('msg')}}
</div>
@endif
@if(session('msg') and str_contains(session('msg'), 'added'))

<div class="alert alert-success">
   {{ session('msg')}}
</div>
@endif

@if(session('msg') and str_contains(session('msg'), 'deleted'))

<div class="alert alert-danger">
   {{ session('msg')}}
</div>
@endif

@if(session('msg') and str_contains(session('msg'), 'Can\'t'))
    <div class="alert alert-warning">
        {{ session('msg')}}
    </div>
@endif
