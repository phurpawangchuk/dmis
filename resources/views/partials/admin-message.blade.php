@if (session()->has('msg_error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p class="mb-0">{{ session('msg_error') }}</p>
    </div>
@endif
@if (session()->has('msg_success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p class="mb-0">{{ session('msg_success') }}</p>
    </div>
@endif
@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p class="mb-0">{{ session('success') }}</p>
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p class="mb-0">{{ session('error') }}</p>
    </div>
@endif