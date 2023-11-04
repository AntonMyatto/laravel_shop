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
            <div class="container-fluid pb-3">

                <!-- Content Row -->
                <div class="row">
                    <div class="col-lg-12 col-xl-12 mt-2 mb-2 text-dark">
                        <h2>Создание товар</h2>
                    </div>
                </div>

                <div class="row">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xl-12">
                                @if(count($errors) > 0)
                                    @foreach($errors->all() as $error)
                                        <div class="alert alert-danger">{{ $error }}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Категория:</strong>
                                    <select class="form-control" name="category_id" id="course">
                                        @foreach($categories as $id => $category)
                                            <option value="{{ $id }}">{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Название:</strong>
                                    <input type="text" name="title" class="form-control" placeholder="Заголовок">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Описание:</strong>
                                    <textarea class="form-control" style="height:150px" name="description"
                                              placeholder="Описание"></textarea>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Цена:</strong>
                                    <input type="number" name="price" class="form-control" placeholder="Цена">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Характеристики</strong>
                                    <div class="row mb-2" id="linksTable">
                                        <div class="row mb-2 mt-2">
                                            <div class="col-md-2">
                                                <span>Порядок</span>
                                            </div>
                                            <div class="col-md-2">
                                                <span>Название</span>
                                            </div>
                                            <div class="col-md-2">
                                                <span>Значение</span>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <span>Действие</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <input type="text" name="content[0][key]" class="form-control" placeholder="Порядок">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="content[0][value]" class="form-control" placeholder="Название">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="content[0][text]" class="form-control"  placeholder="Значение" >
                                            </div>
                                            <div class="col-md-2">

                                            </div>
                                            <div class="col-md-2">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-lg-12">
                                            <button type="button" name="add_string" id="add_string" class="btn btn-success">Новая опция <i class="fas fa-plus ml-2"></i></button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Изображение:</strong>
                                    <input type="file" name="img" class="form-control" value="{{ old('img') }}">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Статус:</strong>
                                    <select name="published" id="" class="form-control">
                                        <option value="1">Опубликован</option>
                                        <option value="0">Не опубликован</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Создать товар</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('admin.layouts.footer')

        <!-- End of Footer -->

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>

    <script type="text/javascript">

        var i = 0;

        $("#add_string").click(function(){

            ++i;

            $("#linksTable").append('' +
                '<div class="row mt-2 new-par">' +
                '<div class="col-md-2">' +
                '<input type="text" name="content['+i+'][key]" class="form-control" placeholder="Порядок">' +
                '</div>' +
                '<div class="col-md-2">' +
                '<input type="text" name="content['+i+'][value]" class="form-control" placeholder="Название" >' +
                '</div>' +
                '<div class="col-md-2">' +
                '<input name="content['+i+'][text]" class="form-control" placeholder="Значение" >' +
                '</div>' +
                '<div class="col-md-2 text-center"><button type="button" class="btn btn-danger remove-tr">Удалить</button></div>' +
                '</div>');
        });


        $(document).on('click', '.remove-tr', function(){
            $(this).parents('.new-par').remove();
        });

    </script>
@endsection
