<!DOCTYPE html>
<html lang="en">
<head>
    @include('inc.header')
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
        @include('inc.topbar')
      <!--end::Header-->
      <!--begin::Sidebar-->
        @include('inc.sidebar')
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->

        <!--end::App Content Header-->

        <!--begin::App Content-->
        @yield('content')

        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->

      <!--end::Footer-->
    </div>
    <!-- ./wrapper -->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->

    @include('inc.footer')
</body>

</html>
