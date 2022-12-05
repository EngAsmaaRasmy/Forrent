  <!-- Plugins JS File -->
  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/superfish.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script> --}}
    <script src="assets/js/jquery.elevateZoom.min.js"></script>
    <script src="{{ asset('assets/js/jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js')}}"></script>
  <script src="{{ asset('assets/js/demos/demo.js')}}"></script>
  
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-K31RQG2MWS"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-K31RQG2MWS');
</script>
  

  <script type="text/javascript">
      @if (count($errors) > 0)
      var id = document.getElementById("id").value;
      console.log(id);
          $('#edit').modal('show');
      @endif
  </script>
  

