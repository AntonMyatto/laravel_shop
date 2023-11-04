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
                    <div class="col-lg-12 col-xl-12 mt-2 mb-2 text-dark">
                        <h2>Редактирование категории</h2>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 text-left mb-4 mt-2">
                        <a href="{{ route('categories.index') }}" class="btn btn-primary">Вернуться </a>
                    </div>
                </div>

                <div class="row">
                    <form action="{{ route('categories.update',$category->id) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                    <strong>Тип:</strong>
                                    <select name="type" id="" class="form-control">
                                        <option value="product" selected>Товар</option>
                                        <option value="post">Пост</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Название:</strong>
                                    <input type="text" name="title" class="form-control" placeholder="Заголовок"
                                           value="{{ old('title', $category->title) }}">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Описание:</strong>
                                    <textarea class="form-control" style="height:150px" name="description"
                                              placeholder="Описание">{{ old('description', $category->description) }}</textarea>
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Изображение:</strong>
                                    <input class="form-control mb-2" name="img" type="file"
                                           value="{{ Storage::url($category->img) }}">
                                    <p class="mt-2 font-weight-bold">Прикрепленное изображение</p>
                                    <img src="{{ Storage::url($category->img) }}" alt="" class=" mb-3 img-fluid"
                                         style="max-height:200px;width:200px">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Статус:</strong>

                                    @if($category->published == 1)
                                        <select name="published" id="" class="form-control">
                                            <option value="1" selected>Опубликован</option>
                                            <option value="0">Не опубликован</option>
                                        </select>
                                    @else
                                        <select name="published" id="" class="form-control">
                                            <option value="1">Опубликован</option>
                                            <option value="0" selected>Не опубликован</option>
                                        </select>
                                    @endif

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Теги:</strong>

                                    <select name="tags[]" class="form-control" multiple multiselect-search="true">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}" @selected($category->tags->contains($tag->id))>{{ $tag->title }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-12 text-center mb-4 mt-2">
                                <button type="submit" class="btn btn-primary">Обновить курс</button>
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

@endsection

<script src="{{ asset('assets/vendor/multiple/multiselect.js') }}"></script>
