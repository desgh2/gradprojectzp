@if (session()->has('alert'))
<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration border-5 border-{{ session('alert.class') }} border-top-0 border-end-0 border-bottom-0" role="alert">
    <div class="inner">
        <div class="app-card-body p-3 p-lg-4">
            <h3 class="mb-3">{{ session('alert.title') }}</h3>
            <div class="row gx-5 gy-3">
                <div class="col-12 col-lg-9">
                    <div>{{ session('alert.message') }}</div>
                </div><!--//col-->
            </div><!--//row-->
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div><!--//app-card-body-->
    </div><!--//inner-->
</div>
@endif
