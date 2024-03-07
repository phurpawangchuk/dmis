@extends('frontend.index')
@section('title','Register/Login')
@section('frontcontent')
<style>
  
.panel-body {
    padding-top: 15px;
    padding-bottom: 15px;
    padding-left: 0;
    padding-right: 0;
    background: #fff;
}
.panel-footer {
    background: #2469b7;
    padding: 20px 10px;
    color: #fff;
    font-size: 13px;
    border-radius: 0;
    border: 0;
    height: 160px;
}
img {
    
}
.img-responsive{
    display: block;
    max-width: 100%;
    
    height: 130px;
    width: 130px;
    border-radius: 0%;
    margin: 0 auto;
}
.box{
    padding-left:15px;
    padding-right:15px;
    padding-top:15px;
    padding-bottom:15px;
    
}

</style>
<div class="content-wrapper">
    <div class="content-header text-center">
        
    </div>
    <div class="content">
        <div class="container">
      
                    <div class="row">
                        <div class="col-md-5">
                            <h4>Partners</h4>
                        </div> 
                    </div>  
                    <div class="row">
                        <div class="col-md-12">
                        <div class="row">   
                                                   <div class="col-md-6">
                                                   <div class="org-content panel">
                                                                   <div class="row box">
                                                                                 <div class="col-md-4 panel-body">
                                                                                 <img class="img-responsive" src="{{asset('/images/rtc.png')}}" />
                                                                                 </div>
                                                                                 <div class="col-md-8 panel-footer" style="float:right;">
                                                                                     <p>Royal Thimphu College</p>
                                                                                     <p class="contact-person"><a href="https://www.rtc.bt/" style="color:#fff;display:block;padding-bottom:5px;">https://www.rtc.bt</a> </p>
                                                         
                                                                                 </div>
                                                                    </div>             
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="org-content panel">
                                                                   <div class="row box">
                                                                                 <div class="col-md-4 panel-body">
                                                                                 <img class="img-responsive" src="{{asset('/images/swis.jpg')}}" />
                                                                                 </div>
                                                                                 <div class="col-md-8 panel-footer" style="float:right;">
                                                                                     <p>Swiss Embassy bhutan</p>
                                                                                     <p class="contact-person"><a href="https://www.eda.admin.ch/eda/en/fdfa/representations-and-travel-advice/bhutan/ch-representation-bhutan.html" style="color:#fff;display:block;padding-bottom:5px;">https://www.eda.admin.ch/eda/en/fdfa/representations-and-travel-advice/bhutan/ch-representation-bhutan.html</a> </p>
                                                         
                                                                                 </div>
                                                                    </div>             
                                                      </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                       <div class="org-content panel">
                                                                   <div class="row box">
                                                                                 <div class="col-md-4 panel-body">
                                                                                 <img class="img-responsive" src="{{asset('/images/unicef.jpeg')}}" />
                                                                                 </div>
                                                                                 <div class="col-md-8 panel-footer" style="float:right;">
                                                                                     <p>Unicef</p>
                                                                                     <p class="contact-person"><a href="https://www.unicef.org/bhutan/" style="color:#fff;display:block;padding-bottom:5px;">https://www.unicef.org/bhutan/</a> </p>
                                                                                                                                 
                                                         
                                                                                 </div>
                                                                    </div>             
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="org-content panel">
                                                                   <div class="row box">
                                                                                 <div class="col-md-4 panel-body">
                                                                                 <img class="img-responsive" src="{{asset('/images/mud.jpeg')}}" />
                                                                                 </div>
                                                                                 <div class="col-md-8 panel-footer" style="float:right;">
                                                                                     <p>Murdoch University</p>
                                                                                     <p class="contact-person"><a href="https://www.murdoch.edu.au/" style="color:#fff;display:block;padding-bottom:5px;">https://www.murdoch.edu.au/</a> </p>
                                                                                                   
                                                         
                                                                                 </div>
                                                                    </div>             
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="org-content panel">
                                                                   <div class="row box">
                                                                                 <div class="col-md-4 panel-body">
                                                                                 <img class="img-responsive" src="{{asset('/images/bhutanfundation.png')}}" />
                                                                                 </div>
                                                                                 <div class="col-md-8 panel-footer" style="float:right;">
                                                                                     <p>Bhutan Foundation</p>
                                                                                     <p class="contact-person"><a href="https://www.bhutanfound.org/" style="color:#fff;display:block;padding-bottom:5px;">https://www.bhutanfound.org/</a> </p>
                                                                                 </div>
                                                                    </div>             
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="org-content panel">
                                                                   <div class="row box">
                                                                                 <div class="col-md-4 panel-body">
                                                                                 <img class="img-responsive" src="{{asset('/images/jaypee.jpeg')}}" />
                                                                                 </div>
                                                                                 <div class="col-md-8 panel-footer" style="float:right;">
                                                                                     <p>Jaypee Group</p>
                                                                                     <p class="contact-person"><a href="http://jalindia.com/" style="color:#fff;display:block;padding-bottom:5px;">http://jalindia.com/</a></p>
                                                         
                                                                                 </div>
                                                                    </div>             
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="org-content panel">
                                                                   <div class="row box">
                                                                                 <div class="col-md-4 panel-body">
                                                                                 <img class="img-responsive" src="{{asset('/images/wwf.gif')}}" />
                                                                                 </div>
                                                                                 <div class="col-md-8 panel-footer" style="float:right;">
                                                                                     <p>World Wildlife Fund</p>
                                                                                     <p class="contact-person"><a href="https://www.worldwildlife.org/" style="color:#fff;display:block;padding-bottom:5px;">https://www.worldwildlife.org/</a></p>
                                                         
                                                                                 </div>
                                                                    </div>             
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="org-content panel">
                                                                   <div class="row box">
                                                                                 <div class="col-md-4 panel-body">
                                                                                 <img class="img-responsive" src="{{asset('/images/snv.jpeg')}}" />
                                                                                 </div>
                                                                                 <div class="col-md-8 panel-footer" style="float:right;">
                                                                                     <p>SNV</p>
                                                                                     <p class="contact-person"><a href="https://snv.org/organisation" style="color:#fff;display:block;padding-bottom:5px;">https://snv.org/organisation</a></p>
                                                         
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

@endsection