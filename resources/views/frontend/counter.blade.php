<div class="col-lg-3 col-6">

<div class="small-box bg-warning">
<div class="inner">
<h3 class="counter">{{$scholarshipcount}}</h3>
<p>Open Scholarships</p>
</div>
<div class="icon">
<i class="fas fa-certificate"></i>
</div>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-primary">
<div class="inner">
<h3 class="counter">{{$studentregcount}}</h3>
<p>Registered Students</p>
</div>
<div class="icon">
<i class="fas fa-users"></i>
</div>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-info">
<div class="inner">
<h3 class="counter">{{$awardcount}}</h3>
<p>Scholarship Awards</p>
</div>
<div class="icon">
<i class="fas fa-star"></i>
</div>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-success">
<div class="inner">
<h3 class="counter">{{$sponsercount}}</h3>
<p>Sponsors</p>
</div>
<div class="icon">
<i class="fas fa-handshake"></i>
</div>
</div>
</div>


@push('scripts')
<script>
    $(document).ready(function() {

        $('.counter').each(function () {
        $(this).prop('Counter',0).animate({
        Counter: $(this).text()
        }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
        });
        });

    }); 
</script>

@endpush