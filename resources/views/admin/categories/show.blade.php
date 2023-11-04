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

                <div class="container">
                    <div class="row">
                        <div class="d-flex justify-content-between mt-2 mb-2">
                            <h4 class="text-dark">Категория: {{$category->title}}</h4>
                            <a class="btn btn-primary btn-actions" href="{{ route('categories.edit',$category->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="container bg-white p-4 course-preview">

                    <div class="row border-bottom-light">
                        <div class="col-lg-4 mb-2">
                            <p>ID</p>
                        </div>
                        <div class="col-lg-8">
                            <span>{{$category->id}}</span>
                        </div>
                    </div>
                    <div class="row border-bottom-light mt-2 mb-2">
                        <div class="col-lg-4 mb-2">
                            <p>Опубликован</p>
                        </div>
                        <div class="col-lg-8">
                            @if($category->published == 1)
                                <span style="color:white;background:#182444;padding:4px 8px; border-radius: 10px">Да</span>
                            @else
                                <span style="color:white;background:darkred;padding:4px 8px; border-radius: 10px">Нет</span>
                            @endif
                        </div>
                    </div>


                    <div class="row border-bottom-light mt-2 mb-2">
                        <div class="col-lg-4 mb-2">
                            <p>Превью:</p>
                        </div>
                        <div class="col-lg-8 mb-2">
                            <img src="{{ Storage::url($category->img) }}" alt="" class="img-fluid"
                                 style="width:263px;height:192px;">
                        </div>
                    </div>
                    <div class="row border-bottom-light mt-2 mb-2">
                        <div class="col-lg-4">
                            <span class="text-dark">Описание курса: </span>
                        </div>
                        <div class="col-lg-8">
                            <p>{{$category->description}}</p>
                        </div>
                    </div>
                    <div class="row border-bottom-light">
                        <div class="col-lg-4">
                            <span class="text-dark">Теги: </span>
                        </div>
                        <div class="col-lg-8">
                            @foreach($tags as $tag)
                                <span style="color:white;background:cornflowerblue;padding:4px 8px; border-radius: 10px;margin-left:5px; margin-top:10px;">{{$tag->title}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="d-flex justify-content-between mt-4 mb-2">
                            <h4 class="text-dark">Прикрепленные уроки</h4>
                        </div>
                    </div>
                </div>

                <div class="container bg-white p-4 course-preview mb-4">
                    <div class="row mt-2 mb-2 border-bottom-light">
                        <div class="col-lg-2">
                            Заголовок
                        </div>
                        <div class="col-lg-2">
                            Нумерация
                        </div>
                        <div class="col-lg-3">
                            Превью
                        </div>
                        <div class="col-lg-2">
                            Статус
                        </div>
                        <div class="col-lg-3 justify-content-end d-flex">
                            Действия
                        </div>
                    </div>
                    @php
                        $lessons = App\Models\Product::get()->where('category_id',$category->id);
                    @endphp
                    @foreach($lessons as $lesson)
                        <div class="row border-bottom-light mt-2 mb-2">
                            <div class="col-lg-2 mt-2">
                                {{$lesson->title}}
                            </div>
                            <div class="col-lg-2 mt-2">
                                {{$lesson->sort}}
                            </div>
                            <div class="col-lg-3">
                                <img src="{{ Storage::url($lesson->img) }}" alt="" class="img-fluid"
                                     style="width:80px;height:80px;">
                            </div>
                            <div class="col-lg-2 mt-2">
                                @if($category->published == 1)
                                    <span style="color:white;background:#182444;padding:4px 8px; border-radius: 10px">Опубликован</span>
                                @else
                                    <span style="color:white;background:darkred;padding:4px 8px; border-radius: 10px">Не опубликован</span>
                                @endif
                            </div>
                            <div class="col-lg-3 justify-content-end d-flex">
                                <a class="btn btn-primary btn-actions m-1"
                                   href="{{ route('products.edit',$lesson->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('products.destroy',$lesson->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-actions m-1"><i
                                                class="fas fa-times"></i></button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                </div>
                @php
                    $tests = App\Models\Test::get()->where('category_id',$category->id);
                @endphp
                <div class="container">
                    <div class="row">
                        <div class="d-flex justify-content-between mt-4 mb-2">
                            <h4 class="text-dark">Прикрепленные Тесты</h4>
                        </div>
                    </div>
                </div>

                <div class="container bg-white p-4 course-preview mb-4">
                    <div class="row mt-2 mb-2 border-bottom-light">
                        <div class="col-lg-4">
                            Название
                        </div>
                        <div class="col-lg-3">
                            Тип
                        </div>
                        <div class="col-lg-3">
                            Статус
                        </div>
                        <div class="col-lg-2 justify-content-end d-flex">
                            Действия
                        </div>
                    </div>
                    @foreach($tests as $test)
                        <div class="row border-bottom-light mt-2 mb-2">
                            <div class="col-lg-4 mt-2">
                                {{$test->name}}
                            </div>
                            <div class="col-lg-3 mt-2">
                                @if($test->type == "course")
                                    <span style="color:white;background:green;padding:4px 8px; border-radius: 10px;margin-left:5px;">Для курса</span>
                                @else
                                    <span style="color:white;background:darkred;padding:4px 8px; border-radius: 10px;margin-left:5px;">Начальный</span>
                                @endif
                            </div>
                            <div class="col-lg-3">
                                @if($test->published == 1)
                                    <span style="color:white;background:#182444;padding:4px 8px; border-radius: 10px">Опубликован</span>
                                @else
                                    <span style="color:white;background:darkred;padding:4px 8px; border-radius: 10px">Не опубликован</span>
                                @endif
                            </div>
                            <div class="col-lg-2 justify-content-end d-flex">
                                <a class="btn btn-primary btn-actions m-1" href="{{ route('tests.edit',$test->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tests.destroy',$test->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-actions m-1"><i
                                                class="fas fa-times"></i></button>
                                </form>
                            </div>
                        </div>
                    @endforeach
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
