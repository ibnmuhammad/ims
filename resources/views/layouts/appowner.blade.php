<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('inc.head')
<body class="hold-transition sidebar-mini layout-fixed">
    @include('inc.navowner')
    @include('inc.ownersidebar')
    <div id="app">
        <main class="py-0">
            @include('sweetalert::alert')
            @yield('content')
            @include('inc.footer')
        </main>
    </div>
    @include('inc.query')
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> --}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/b-print-2.0.1/cr-1.5.5/date-1.1.1/fc-4.0.1/fh-3.2.0/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.0/sp-1.4.0/sl-1.3.3/datatables.min.js"></script>
    
    <script>
        $(document).ready(function(){
          $("#storeTable").dataTable({
              "responsive": true,
              "autoWidth": false, 
          });
    
        })
    </script>
</body>
</html>
