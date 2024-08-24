
<div class="content-wrapper" >
    <div class="content-header text-center">
    </div>
    <div class="content">
        <div class="container">
            <div class="row">
                @foreach ($projects as $p)
                    <div class="col-md-3">
                        <div class="card card-info card">
                        <div class="card-header font-weight-bold text-dark" style="background-color:#f9c013;" >{{ $p->name}} </div>
                            <div class="card-body text-justify">{!! $p->shortCode !!}</div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>



