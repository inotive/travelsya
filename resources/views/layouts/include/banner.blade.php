 <!--begin::Toolbar-->
 <div class="toolbar py-5 pb-lg-15" id="kt_toolbar">
     <!--begin::Container-->
     <div id="kt_content_container" class=" container-xxl ">

         <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
             <ol class="carousel-indicators">
                 @foreach($ads as $key => $ad)
                 <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}" class="{($key==0)?'active':''}}"></li>
                 @endforeach
             </ol>
             <div class="carousel-inner">
                 @foreach($ads as $key => $ad)
                 <div class="carousel-item {{($key==0)?'active':''}}">
                     <img class="d-block w-100 h-400px" src="{{$ad['image']}}" alt="First slide">
                 </div>
                 @endforeach
                 <div class="carousel-item">
                     <img class="d-block w-100 h-400px" src="https://fastly.picsum.photos/id/861/1200/400.jpg?hmac=oEEp9Zqn58JvH4Jr3KtUz1MIhsZl__Xh-W8RZIqv4a4" alt="second slide">
                 </div>
                 <div class="carousel-item">
                     <img class="d-block w-100 h-400px" src="https://fastly.picsum.photos/id/786/1200/400.jpg?hmac=ev4yUlckhUn0mZu3CHH6cS7-LtNb-EyDuABsTHBZkGY" alt="third slide">
                 </div>

             </div>
             <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                 <span class="sr-only">Previous</span>
             </a>
             <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                 <span class="sr-only">Next</span>
             </a>
         </div>
     </div>
     <!--end::Container-->
 </div>