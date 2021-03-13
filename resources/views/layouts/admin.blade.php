<?php
    use App\Models\Order;

    $count1 = Order::where('status', 'Відправлене')->get();
    $count2 = Order::where('status', 'Нове замовлення')->get();
    $count3 = Order::where('status', 'Очікує оплати')->get();
    $count4 = Order::where('status', 'Відмінене')->get();
    $count5 = Order::where('status', 'Завершене')->get();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sneakerboom | панель адміністратора</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{@asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{@asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{@asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{@asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
          href="{{@asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{@asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{@asset('admin/plugins/jqvmap/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{@asset('admin/plugins/ekko-lightbox/ekko-lightbox.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{@asset('admin/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{@asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{@asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{@asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{@asset('admin/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{@asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('dashboard')}}" class="nav-link"><i style="padding-right: 10px;"
                                                                     class="fas fa-home"></i>Головна</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a target="_blank" href="{{route('home')}}" class="nav-link"><i style="padding-right: 10px;"
                                                                                class="fas fa-external-link-alt"></i>sneakerboom.ho.ua</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#" role="button"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i style="padding-right: 10px;" class="fas fa-sign-out-alt"></i><b>Вихід</b>
                </a>
                <form id="logout-form" action="{{route('logout')}}" method="POST">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{@asset('images/user_admin.png')}}" alt="User Image">
                </div>
                <div class="info my_info">
                    {{Auth::user()->name}}
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{route('goods.view')}}"
                           class="nav-link @if(request()->is('admin/goods')) active @endif">
                            <i class="nav-icon fas fa-box"></i>
                            <p>
                                Товари
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('orders.view')}}"
                           class="nav-link @if(request()->is('admin/orders')) active @endif">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Замовлення
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('users.view')}}"
                           class="nav-link @if(request()->is('admin/users')) active @endif">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Користувачі
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('ui')}}"
                           class="nav-link @if(request()->is('admin/ui')) active @endif">
                            <i class="nav-icon fas fa-pencil-ruler"></i>
                            <p>
                                UI елементи
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('contacts.view')}}"
                           class="nav-link @if(request()->is('admin/contacts')) active @endif">
                            <i class="nav-icon far fa-envelope"></i>
                            <p>
                                Звернення
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('newsletter')}}"
                           class="nav-link @if(request()->is('admin/newsletter')) active @endif">
                            <i class="nav-icon fas fa-rss"></i>
                            <p>
                                Розсилка
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>&copy; 2021 <a href="{{route('home')}}">Sneakerboom.ho.ua</a></strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{@asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{@asset('admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{@asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{@asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{@asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{@asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{@asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{@asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{@asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{@asset('admin/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{@asset('admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{@asset('admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{@asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{@asset('admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{@asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{@asset('admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{@asset('admin/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{@asset('admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{@asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{@asset('admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{@asset('admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{@asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{@asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{@asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{@asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{@asset('admin/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{@asset('admin/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{@asset('admin/dist/js/pages/dashboard.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/08l3obp9hhm94f5eyek7vvjyqaycsh7sdlo5wwzz2touo7zc/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
<!-- Select2 -->
<script src="{{@asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{@asset('admin/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>
<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.13/sorting/datetime-moment.js"></script>
<script>
    $(function () {
        $('#examplenewsletter').DataTable({
            "language": {
                "search": "Пошук:",
                "info": "Показано від _START_ до _END_ із _TOTAL_ записів",
                "infoEmpty": "Показано від 0 до 0 із 0 записів",
                "zeroRecords": "Не знайдено жодного товару",
                "infoFiltered": "(відфільтровано з _MAX_ загальних записів)",
                "processing": "Обробка результатів...",
                "loadingRecords": "Завантаження...",
                "emptyTable": "У таблиці відсутні дані",
                "paginate": {
                    "first": "Перша",
                    "last": "Остання",
                    "next": "Наступна",
                    "previous": "Попередня"
                },
            },
            paging: true,
            pagingType: "first_last_numbers",
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('newsletter') }}",
            columns: [
                {"data": "email"},
                {
                    data: "action",
                    name: "action",
                    orderable: false
                },

            ],
        });
    });

    $(function () {
        $('#example2').DataTable({
            "language": {
                "search": "Пошук:",
                "info": "Показано від _START_ до _END_ із _TOTAL_ записів",
                "infoEmpty": "Показано від 0 до 0 із 0 записів",
                "zeroRecords": "Не знайдено жодного товару",
                "infoFiltered": "(відфільтровано з _MAX_ загальних записів)",
                "processing": "Обробка результатів...",
                "loadingRecords": "Завантаження...",
                "emptyTable": "У таблиці відсутні дані",
                "paginate": {
                    "first": "Перша",
                    "last": "Остання",
                    "next": "Наступна",
                    "previous": "Попередня"
                },
            },
            paging: true,
            pagingType: "first_last_numbers",
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('goods.view') }}",
            columns: [
                {"data": "manufacturer"},
                {"data": "model"},
                {"data": "price"},
                {"data": "discount"},
                {"data": "count"},
                {"data": "sale_count"},
                {
                    data: "action",
                    name: "action",
                    orderable: false
                },

            ],
        });
    });

    $(function () {
        $('#examplecontacts').DataTable({
            "language": {
                "search": "Пошук:",
                "info": "Показано від _START_ до _END_ із _TOTAL_ записів",
                "infoEmpty": "Показано від 0 до 0 із 0 записів",
                "zeroRecords": "Не знайдено жодного замовлення",
                "infoFiltered": "(відфільтровано з _MAX_ загальних записів)",
                "processing": "Обробка результатів...",
                "loadingRecords": "Завантаження...",
                "emptyTable": "У таблиці відсутні дані",
                "paginate": {
                    "first": "Перша",
                    "last": "Остання",
                    "next": "Наступна",
                    "previous": "Попередня"
                },
            },
            paging: true,
            pagingType: "first_last_numbers",
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('contacts.view') }}",
            columns: [
                {"data": "name"},
                {"data": "phone"},
                {"data": "email"},
                {
                    "data": "created_at", render: function (data, type, row) {
                        return moment(new Date(data).toString()).format('DD/MM/YYYY HH:mm');
                    }
                },
                {"data": "status"},
                {
                    data: "action",
                    name: "action",
                    orderable: false
                },

            ],
        });
    });
    $(function () {
        $('#exampleorders').DataTable({
            "language": {
                "search": "Пошук:",
                "info": "Показано від _START_ до _END_ із _TOTAL_ записів",
                "infoEmpty": "Показано від 0 до 0 із 0 записів",
                "zeroRecords": "Не знайдено жодного замовлення",
                "infoFiltered": "(відфільтровано з _MAX_ загальних записів)",
                "processing": "Обробка результатів...",
                "loadingRecords": "Завантаження...",
                "emptyTable": "У таблиці відсутні дані",
                "paginate": {
                    "first": "Перша",
                    "last": "Остання",
                    "next": "Наступна",
                    "previous": "Попередня"
                },
            },
            paging: true,
            pagingType: "first_last_numbers",
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('orders.view') }}",
            columns: [
                {"data": "id"},
                {
                    "data": "created_at", render: function (data, type, row) {
                        return moment(new Date(data).toString()).format('DD/MM/YYYY HH:mm');
                    }
                },
                {"data": "total_cost"},
                {"data": "status"},
                {"data": "TTN"},
                {
                    data: "action",
                    name: "action",
                    orderable: false
                },

            ],
        });
    });
    $(function () {
        $('#exampleusers').DataTable({
            "language": {
                "search": "Пошук:",
                "info": "Показано від _START_ до _END_ із _TOTAL_ записів",
                "infoEmpty": "Показано від 0 до 0 із 0 записів",
                "zeroRecords": "Не знайдено жодного замовлення",
                "infoFiltered": "(відфільтровано з _MAX_ загальних записів)",
                "processing": "Обробка результатів...",
                "loadingRecords": "Завантаження...",
                "emptyTable": "У таблиці відсутні дані",
                "paginate": {
                    "first": "Перша",
                    "last": "Остання",
                    "next": "Наступна",
                    "previous": "Попередня"
                },
            },
            paging: true,
            pagingType: "first_last_numbers",
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.view') }}",
            columns: [
                {"data": "id"},
                {"data": "name"},
                {"data": "email"},
                {
                    data: "role",
                    name: "role",
                },
                {
                    "data": "created_at", render: function (data, type, row) {
                        return moment(new Date(data).toString()).format('DD/MM/YYYY');
                    }
                },
                {
                    data: "action",
                    name: "action",
                    orderable: false
                },

            ],
        });
    });


    $('#slider').click(function () {
        if ($(this).is(':checked')) {
            $('#slider_img').show(500);
            $('#slider_desc').show(500);
        } else {
            $('#slider_img').hide(500);
            $('#slider_desc').hide(500);
        }
    });

    if ($('#slider').is(':checked')) {
        $('#slider_img').show();
        $('#slider_desc').show();
    }

    $('#order_status').change(function(){
        if ($(this).val() == "Відправлене")
        {
            $('#TTN').show(500);
            $("#TTN_num").attr("required", true);
        }
        else
        {
            $('#TTN').hide(500);
            $("#TTN_num").attr("required", false);
        }
    });
    if($('#order_status').val() == "Відправлене"){
        $('#TTN').show(500);
        $("#TTN_num").attr("required", true);
    }

    tinymce.init({
        selector: '#description',
        language: 'uk',
        height: "350"
    });

    tinymce.init({
        selector: '#highlights',
        language: 'uk',
        height: "350"
    });

    tinymce.init({
        selector: '#answer',
        language: 'uk',
        height: "500"
    });

    tinymce.init({
        selector: '#rss',
        language: 'uk',
        height: "800"
    });

    //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    });

    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

    $('#timepicker').datetimepicker({
        format: 'LT'
    });

    $('#reservationdate').datetimepicker({
        format: 'L'
    });

</script>
<script>
    $(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function (event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

        $('.filter-container').filterizr({gutterPixels: 3});
        $('.btn[data-filter]').on('click', function () {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
        });
    })

</script>
<script>
    // Donut Chart
    var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
    var pieData = {
        labels: [
            'Відправлено',
            'Нове замовлення',
            'Очікує оплати',
            'Відмінене',
            'Завершене'
        ],
        datasets: [
            {
                data: [{{count($count1)}}, {{count($count2)}}, {{count($count3)}}, {{count($count4)}}, {{count($count5)}}],
                backgroundColor: ['#f56924', '#01a65a', '#f49c12', '#1184ff','#4943cb']
            }
        ]
    }
    var pieOptions = {
        legend: {
            display: false
        },
        maintainAspectRatio: false,
        responsive: true
    }
    // Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    // eslint-disable-next-line no-unused-vars
    var pieChart = new Chart(pieChartCanvas, {
        type: 'doughnut',
        data: pieData,
        options: pieOptions
    })

    $('#calendar').datetimepicker({
        format: 'L',
        inline: true,
    })

</script>
</body>
</html>
