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

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>


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
                <div class="row">
                    <div class="col-lg-6 col-xl-6 mt-2 mb-2 text-dark">
                        <h2>Теги</h2>
                    </div>

                    <div class="col-lg-6 text-right">
                        <a href="{{ route('tags.create') }}" class="btn btn-primary">Создать тег <i class="fas fa-plus ml-2"></i></a>
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
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">№</th>
                            <th scope="col">Название</th>
                            <th scope="col">Сортировка</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($tags as $tag)
                            <tr data-entry-id="{{ $tag->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tag->title }}</td>
                                <td>{{ $tag->sort }}</td>
                                <td class="action-block">
                                    <div class="mrt-5">
                                        <a class="btn btn-primary btn-actions" href="{{ route('tags.edit',$tag->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('tags.destroy',$tag->id) }}" method="POST">

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-actions"><i class="fas fa-times"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">{{ __('Нет тегов') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
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
