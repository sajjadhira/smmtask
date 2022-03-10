<script src="{{ url('/assets/js/jquery.min.js')}}"></script>
<script src="{{ url('/assets/js/bootstrap.min.js')}}"></script>

@if (Session::has('message') || count($errors) >0 )
<script src="{!! asset('app-assets/js/scripts/extensions/sweetalert2.all.min.js') !!}"></script>
@endif

<script src="{{ url('/assets/js/scripts.js')}}"></script>

@if (Session::has('message'))
<script type="text/javascript">
     Swal.fire({
       type: "{{Session::get('message')['type']}}",
       title: '{{ucfirst(Session::get('message')['type'])}}!',
       html: '{{Session::get('message')['message']}}',
       timer: @if(Session::get('message')['type']=='success') 2000 @else 5000 @endif,
     })
 </script>
 @endif

@if (count($errors) >0 )
<script type="text/javascript">
     Swal.fire({
       type: "error",
       title: 'Error!',
       html: '@foreach($errors->all() as $error) {{ $error }}<br/> @endforeach',
       timerProgressBar: true,
     })
 </script>
@endif

@yield('js')

</body>

</html>