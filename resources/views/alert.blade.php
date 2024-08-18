@if(!empty(session('success')))
<div class="alert alert-success alert-action" role="alert">
    {{ session('success') }}
</div>
@endif

@if(!empty(session('error')))
<div class="alert alert-danger alert-action" role="alert">
    {{ session('error') }}
</div>
@endif

@if(!empty(session('payment-error')))
<div class="alert alert-danger alert-action" role="alert">
    {{ session('payment-error') }}
</div>
@endif

@if(!empty(session('warning')))
<div class="alert alert-warning alert-action" role="alert">
    {{ session('warning') }}
</div>
@endif

@if(!empty(session('info')))
<div class="alert alert-info alert-action" role="alert">
    {{ session('info') }}
</div>
@endif

@if(!empty(session('secondary')))
<div class="alert alert-secondary alert-action" role="alert">
    {{ session('secondary') }}
</div>
@endif

@if(!empty(session('primary')))
<div class="alert alert-primary alert-action" role="alert">
    {{ session('primary') }}
</div>
@endif

@if(!empty(session('light')))
<div class="alert alert-light alert-action" role="alert">
    {{ session('light') }}
</div>
@endif

@if(!empty(session('dark')))
<div class="alert alert-dark alert-action" role="alert">
    {{ session('dark') }}
</div>
@endif