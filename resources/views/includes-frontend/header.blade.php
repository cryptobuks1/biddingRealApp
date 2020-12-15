@section('header')

{{-- <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600|Roboto:300,400,600,500,700"
  rel="stylesheet"> --}}
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="{{ asset('css/frontend-1.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/frontend-2.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('css/bs4Front-end.css') }}" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="{{ asset('css/customFront-end.css') }}" rel="stylesheet"/>
  <link href="{{ asset('css/toaster.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('css/jquery.datetimepicker.min.css') }}" rel="stylesheet">
  
  
  <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
  @php
  session()->forget('ClientTimezone');
  // session()->put('ClientTimezone','Asia/Karachi');
  
  @endphp
  @if (session('ClientTimezone')==null || session('ClientTimezone')=='Asia/Karachi')
  <script src="{{ asset('js/frontjq.min.js') }}"></script>
  <script type="text/javascript">
  
  // $(document).ready(function(){
  var timezone=Intl.DateTimeFormat().resolvedOptions().timeZone;
  $.ajax({
  url:"{{ route('SetClientTimezoneSession') }}",
  type:"POST",
  dataType:"html",
  data:{timezone:timezone,_token:"{{ csrf_token() }}"},
  success:function(res)
  {
  //Cookies.set('setTimeZoneCheck', 'true');
  },
  error: function(XMLHttpRequest, textStatus, errorThrown) {
  console.log("Status: " + textStatus); console.log("Error: " + errorThrown);console.log("Error: " + errorThrown);
  }
  });
  // }
  
  
  // });
  </script>
  @else
  <script type="text/javascript">
  //alert("Client TimeZone NOT Set");
  </script>
  <script src="{{ asset('js/frontjq.min.js') }}"></script>
  
  @endif
  @endsection