<!DOCTYPE html>
<html lang="zxx">

    @include('customers.layout.head')

<body>
    <!-- Page Preloder -->
    <!-- Humberger Begin -->
    <!-- Humberger End -->
    <!-- Header Section Begin -->
    @include('customers.layout.header')

    <!-- Header Section End -->
        @yield('content')
   
    <!-- Blog Section End -->

    <!-- Footer Section Begin -->
    <!-- Js Plugins -->
    @include('customers.layout.footer')


</body>

</html>