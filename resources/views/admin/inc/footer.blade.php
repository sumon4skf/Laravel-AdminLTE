
    <script src="{{ asset("assets/bower_components/moment/min/moment.min.js")}}"></script>
    <script src="{{ asset("assets/bower_components/bootstrap/dist/js/bootstrap.min.js") }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset("assets/dist/js/adminlte.min.js") }}"></script>
        {{-- generate custom-script file --}}
       
@yield('custom-script')
    <script>
        //Timepicker
        $(document).on('click', '.btn-close', function () {
            $('.custom-alert').hide();
        });
        setTimeout(function () {
            $('.custom-alert').hide();
        }, 5000);

    </script>

  </body>

</html>
