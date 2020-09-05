<footer id="footer">



 <div class="footer-nav">
 <div class="container">
   <div class="content-wrapper pt-4 ">
     <div class="row">
       <div class="col-sm-9">
         <ul class="list-inline">
           <li class="pl-4 text-center d-inline-block"><a href="{{url('/about-us')}}">About</a></li>
           <li class="pl-4 text-center d-inline-block"><a href="{{url('/tos')}}">Terms</a></li>
          {{--  <li class="pl-4 text-center d-inline-block"><a href="#">EULA</a></li> --}}
           <li class="pl-4 text-center d-inline-block"><a href="{{route('privacy_policy')}}">Privacy Policy</a></li>
          
           <li class="pl-4 text-center d-inline-block"><a href="{{url('disclaimer')}}">Disclaimer</a></li>
           <li class="pl-4 text-center d-inline-block"><a href="{{route('contact.index')}}">Contact</a></li>
         </ul>
       </div>
       <div class="col-sm-3">
         <ul class="list-inline social-links pl-4 ">
           <li class="btn-facebook btn btn-sm "><a  href="https://www.facebook.com/Adlaw-109225687182044/?modal=admin_todo_tour" target="_blank"><span class="fa fa-facebook"></span></a></li>
           <li class="btn-twitter btn btn-sm"><a  href="https://twitter.com/adlaw6" target="_blank"><span class="fa fa-twitter"></span></a></li>
           <li class="btn-linkedin btn btn-sm"><a  href="https://www.linkedin.com/in/adlaw-in-7b9632187/" target="_blank"><span class="fa fa-linkedin"></span></a></li>
         </ul>
       </div>
     </div>
   </div>
 </div>
 </div>
 <div class="footer-copyright">
 <div class="container">
   <div class="content-wrapper border-top pt-4 text-center ">
     The information provided on <a href="{{url('/')}}">Adlaw.in</a> is provided AS IS, subject to <a style="color:#FFFFFF;" href="{{url('/tos')}}">Terms Of Services</a> &amp; <a style="color:#FFFFFF;" href="{{url('privacy_policy')}}">Privacy Policy</a>. It is solely available at your request for informational purposes only, should not be interpreted as soliciting or advertisement. In cases where the user has any legal issues, he/she in all cases must seek independent legal advice.<br><br>
   </div>
 </div>
 </div>


 </footer> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
  {{-- <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script> --}}
  <script src="https://cdn.jsdelivr.net/sweetalert2/4.2.4/sweetalert2.min.js"></script>
  <script src="{{asset('js/jquery.star-rating-svg.js')}}"></script>
  <script src="{{asset('js/all_category.js')}}"></script>
  <script>
    
$(window).on("scroll", function() {
  if($(window).scrollTop() > 50) {
      $(".menunav").addClass("bg-white");
      $(".menunav").css({'box-shadow' : '0 .335rem .25rem rgba(0,0,0,.075) '});
      $(".menunav li>a").css({ 'color': 'black', 'font-weight': 'bold' });
  } else {
      //remove the background property so it comes transparent again (defined in your css)
     $(".menunav").removeClass("bg-white");
     $(".menunav li>a").css({ 'color': 'white', 'font-weight': 'bold' });
     $(".menunav").css({'box-shadow' : ''});
  }
});
  </script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-48209472-2');
</script>
  {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
  </main>
</body>
</html>