<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="w3-container " style="margin-top:70px;">
<div class="w3-panel w3-light-grey   w3-panel w3-topbar  w3-border-black" >
  <div class="w3-panel w3-card"><p>
           <div class="w3-row">
             <div class="w3-col s4 w3-center"><p><img src="{{asset('images/fav.jpeg')}}" class="w3-circle" style="height:120px;width:120px"></p></div>
             <div class="w3-col s2 w3-center"><p></p></div>
             <div class="w3-col s4 w3-center"><p></p></div>
           </div>
           <div class="w3-row">
             <div class="w3-col s4  w3-left"><p>{{$donor}}|{{$jrn}}</p>
                                               <p><b>Project Name: </b>{{$project}}</p>

             </div>
             <div class="w3-col s4  w3-center">

             </div>
             <div class="w3-col s4  w3-center"><p>
                  <h1>
                  RECEIPT
                  </h1>
             </p></div>
           </div>
           <div class="w3-row">
             <div class="w3-col s12  w3-center">
                <table class="w3-table-all">
                   <thead>
                     <tr class="w3-black">
                        <th>Description</th>
                        <th>Amount</th>

                      </tr>
                    </thead>
                      <tr>
                        <td>{{$project}}</td>
                        <td>{{$amt}}</td>

                       </tr>
                       <tr>
                         <td>Total</td>
                         <td>{{$amt}}</td>

                         </tr>

                     </table>


             </div>


            </div>
            <div class="w3-row">
             <div class="w3-col s3"><p>Date:{{$date}}</p></div>

           </div>
           <div class="w3-row">
             <div class="w3-col s6 w3-opacity"><p><h4>Thank you for your donation!</h4></p></div>

           </div>
     </p>
   </div>
</div>


</div>



