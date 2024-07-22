{{-- for success  --}}
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span><i class="fas fa-check mr-2"></i>{{ session('success') }}</span>
    </div>
@endif

{{-- for error  --}}
@if (session()->has('error')) 
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span><i class="fas fa-times mr-2"></i>{{ session('error') }}</span>
    </div>
@endif

{{-- for warning  --}}
@if (session()->has('warning'))
    <div class="alert alert-warning alert-dismissible ">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span><i class="fas fa-exclamation-triangle mr-2"></i>{{ session('warning') }}</span>
    </div>
@endif

{{-- for info  --}}
@if (session()->has('info'))  
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span><i class="fas fa-info mr-2"></i>{{ session('info') }}</span>
    </div>
@endif
