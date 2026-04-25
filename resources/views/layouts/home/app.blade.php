<!DOCTYPE html>
<html lang="en">

<head>
    {{-- start css --}}
    @include('layouts.home.css')
    {{-- End Css --}}
</head>

<body>
    <div class="all-content">
        <!-- navbar -->
        @include('layouts.home.navbar')
        <!-- navbar end -->



        <!-- home section -->

    {{-- Start container --}}
    @yield('content')
    {{-- End Container --}}


        <!-- footer -->
       @include('layouts.home.footer')
        {{-- End Footer --}}

    </div>

{{-- js  --}}
@include('layouts.home.js')
{{-- End Js --}}



</body>

</html>
