@extends('admin.layouts.app')

@section('content')

    <!-- Page Wrapper -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <form
                    class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Поиск..."
                               aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">


                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">

                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#"
                                   role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end"
                                     aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Выйти') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>


                        </ul>

                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Content Row -->
                <div class="row mt-2 mb-2">
                    <div class="col-lg-6 col-xl-6  text-dark">
                        <h2>Товары</h2>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Создать товар <i
                                class="fas fa-plus ml-2"></i></a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <span>{{ $message }}</span>
                            </div>
                        @endif

                        @if($message = Session::get('delete'))
                            <div class="alert alert-danger">
                                <span>{{ $message }}</span>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="row">
                    @forelse($products as $product)
                        <div data-entry-id="{{ $product->id }}" class="card col-lg-3 m-2">

                            <div class="row mt-2">
                                <div class="mt-2 col-lg-7">
                                    <h5 class="text-dark">{{$product->title}}</h5>
                                </div>
                                <div class="col-lg-5 mt-2 d-flex justify-content-end">
                                    <div class="mrt-5">
                                        <a href="{!! route('products.show', $product->slug) !!}" class="btn btn-warning btn-actions"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="mrt-5">
                                        <a class="btn btn-primary btn-actions"
                                           href="{!! route('products.edit', $product->slug) !!}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-3 mb-1">
                                    <p>
                                        @if($product->published == 1)
                                            <span
                                                style="color:white;background:#6457C6;padding:4px 8px; border-radius: 10px">Опубликован</span>
                                        @else
                                            <span
                                                style="color:white;background:darkred;padding:4px 8px; border-radius: 10px">Не опубликован</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="col-lg-12 mt-3 mb-2">
                                    @if(Storage::url($product->img) == '/storage/')
                                        <p>Нет иозбражения</p>
                                    @else
                                        <img src="{{ Storage::url($product->img) }}" alt=""
                                             class="img-fluid img-courses">
                                    @endif
                                </div>
                                <div class="col-lg-12 mt-2 mb-2">
                                    <p><b>Категория: {{ $product->category->title }}</b></p>
                                </div>
                            </div>

                        </div>
                    @empty
                        <div>
                            <div class="text-center">{{ __('Нет продуктов') }}</div>
                        </div>
                    @endforelse
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('admin.layouts.footer')

        <!-- End of Footer -->

    </div>

@endsection
