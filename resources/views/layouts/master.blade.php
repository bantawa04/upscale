<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{config('app.name')}}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/css/style.css">
  @yield('styles')
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper" id="app">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">

      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>

      </ul>

      <!-- SEARCH FORM -->
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ asset(Auth::user()->avatar) }}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">
              {{Auth::user()->name}}
              <p>{{Auth::user()->type}}</p>
            </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-header">PRODUCT</li>
            <li class="nav-item">
              <a href="{{ route('tour.index') }}" class="nav-link">
                <i class="fas fa-shoe-prints nav-icon"></i>
                <p>
                  Tour

                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('departure.index') }}" class="nav-link">
                <i class="fas fa-calendar-alt nav-icon"></i>
                <p>
                  Departure

                </p>
              </a>
            </li>
            <li class="nav-header">PRODUCT ATTRIBUTE</li>

            <li class="nav-item">
              <a href="{{ route('accomodation.index') }}" class="nav-link">
                <i class="fas fa-bed nav-icon"></i>
                <p>
                  Accomodation
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('tour-category.index') }}" class="nav-link">
                <i class="fas fa-code-branch nav-icon"></i>
                <p>
                  Category
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('country.index') }}" class="nav-link">
                <i class="fas fa-globe-asia nav-icon"></i>
                <p>
                  Country
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('difficulty.index') }}" class="nav-link">
                <i class="fas fa-signal nav-icon"></i>
                <p>
                  Difficulty
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('exclude.index') }}" class="nav-link">
                <i class="far fa-minus-square nav-icon"></i>
                <p>
                  Excludes
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('group.index') }}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>
                  Group
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('include.index') }}" class="nav-link">
                <i class="far fa-plus-square nav-icon"></i>
                <p>
                  Includeds
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('meal.index') }}" class="nav-link">
                <i class="fas fa-utensils nav-icon"></i>
                <p>
                  Meal Plan
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('region.index') }}" class="nav-link">
                <i class="far fa-dot-circle nav-icon"></i>
                <p>
                  Region
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('location.index') }}" class="nav-link">
                <i class="fas fa-map-marker-alt nav-icon"></i>
                <p>
                  Location
                </p>
              </a>
            </li>

            <li class="nav-header">Media</li>

            <li class="nav-item">
              <a href="{{ route('media.index') }}" class="nav-link">
                <i class="fas fa-photo-video nav-icon"></i>
                <p>
                  Gallery
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('carousel.index') }}" class="nav-link">
                <i class="far fa-images nav-icon"></i>
                <p>
                  Carousel
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('links.index') }}" class="nav-link">
                <i class="fas fa-link nav-icon"></i>
                <p>
                  Links
                </p>
              </a>
            </li>            

            <li class="nav-header">Page</li>
            <li class="nav-item">
              <a href="{{ route('page.index') }}" class="nav-link">
                <i class="far fa-newspaper nav-icon"></i>
                <p>
                  Page
                </p>
              </a>
            </li>

            <li class="nav-header">Blog</li>
            <li class="nav-item">
              <a href="{{ route('post.index') }}" class="nav-link">
                <i class="far fa-newspaper nav-icon"></i>
                <p>
                  Post
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('blog-category.index') }}" class="nav-link">
                <i class="fas fa-list nav-icon"></i>
                <p>
                  Category
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('tag.index') }}" class="nav-link">
                <i class="fas fa-project-diagram nav-icon"></i>
                <p>
                  Tags
                </p>
              </a>
            </li>
            <li class="nav-header">Review</li>
            <li class="nav-item">
              <a href="{{ route('review.index') }}" class="nav-link">
                <i class="far fa-comment-alt nav-icon"></i>
                <p>
                  Client Reviews
                </p>
              </a>
            </li>
            <li class="nav-header">Team</li>
            <li class="nav-item">
              <a href="{{ route('team.index') }}" class="nav-link">
                <i class="fas fa-user nav-icon"></i>
                <p>
                  Members
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('type.index') }}" class="nav-link">
                <i class="fas fa-user-tag nav-icon"></i>
                <p>
                  Types
                </p>
              </a>
            </li>
            <li class="nav-header">Miscellanious</li>
            <li class="nav-item">
              <a href="{{ route('recommended.index') }}" class="nav-link">
                <i class="fas fa-medal nav-icon"></i>
                <p>
                  Recommendeds
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('faq.index') }}" class="nav-link">
                <i class="fas fa-question nav-icon"></i>
                <p>
                  FAQ's
                </p>
              </a>
            </li>
            <li class="nav-header">Marketing</li>
            <li class="nav-item">
              <a href="{{ route('tour.promote') }}" class="nav-link">
                <i class="fas fa-ad nav-icon"></i>
                <p>
                  Promote

                </p>
              </a>
            </li>
            <li class="nav-header">Config</li>
            <li class="nav-item">
              <a href="{{ route('setting.index') }}" class="nav-link">
                <i class="fas fa-cogs nav-icon"></i>
                <p>
                  Settings
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('profile.show', Auth::user()->id)}}" class="nav-link">
                <i class="nav-icon fas fa-user orange"></i>
                <p>
                  Profile
                </p>
              </a>
            </li>
            @can('isAdmin')
            <li class="nav-item">
              <a href="{{route('profile.index')}}" class="nav-link">
                <i class="nav-icon fas fa-user orange"></i>
                <p>
                  Users
                </p>
              </a>
            </li>
            @endcan
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                <i class="nav-icon fa fa-power-off red"></i>
                <p>
                  {{ __('Logout') }}
                </p>
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          @include('backend.partials._message')
          @yield('content')

        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        {{-- Anything you want --}}
      </div>
      <!-- Default to the left -->
      <strong>
        {{-- Copyright &copy; 2014-2018 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved. --}}
    </footer>
  </div>
  <!-- ./wrapper -->

  {{-- @auth
  <script>
    window.user = @json(auth()->user())
  </script>
  @endauth --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
  <script src="/js/script.js"></script>
  @yield('scripts')
  @yield('image')

</body>

</html>