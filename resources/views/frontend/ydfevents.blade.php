<div class="content-wrapper mt-3">
    <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info card">
                    <div class="card-header font-weight-bold text-dark" style="background-color:#f9c013;">
                    <div class="section-header">
                        <h3>YDF EVENTS</h3>
                    </div>
                     </div>
                        <div class="card-body text-justify">
                             <div class="row ">
                                <div class="col-md-12 grid-margin-md stretch-card d-flex_">
                                    <div class="border">
                                        @foreach ($events as $e)
                                            <div class="border-bottom p-3">
                                                <div class="row">
                                                    <div class="col-sm-4 border-right-lg border-right-md-0">
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <h1 class="mb-0 mr-2 text-primary font-weight-normal">{{ substr($e->event_date,8,10) }}</h1>
                                                            <div>
                                                                    <p class="font-weight-bold mb-0 text-dark">{{ date_format(date_create($e->event_date),"M")}}</p>
                                                                    <p class="mb-0">{{ substr($e->event_date,0,4) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 pl-3 uppercase">
                                                        <a href=#>  <p class="text-dark font-weight-bold uppercase mb-0">{{ $e->event_name}}</p></a>
                                                            <p class="mb-0">{!! $e->description !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                       

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


