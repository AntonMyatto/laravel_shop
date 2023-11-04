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
                <div class="row mt-2 mb-2">
                    <div class="col-lg-6 col-xl-6  text-dark">
                        <h2>Категории</h2>
                    </div>
                    <div class="col-lg-6 text-right">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary">Создать категорию <i
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
                    @forelse($categories as $category)
                        <div data-entry-id="{{ $category->id }}" class="card col-lg-4 m-2">

                            <div class="row mt-2">
                                <div class="mt-2 col-lg-8">
                                    <h5 class="text-dark">{{$category->title}}</h5>
                                </div>
                                <div class="col-lg-4 mt-2 d-flex justify-content-end">
                                    <div class="mrt-5">
                                        <a class="btn btn-warning btn-actions"
                                           href="{{ route('categories.show',$category->id) }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div class="mrt-5">
                                        <a class="btn btn-primary btn-actions"
                                           href="{{ route('categories.edit',$category->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-6 mt-3 mb-1">
                                    <p>
                                        @if($category->published == 1)
                                            <span
                                                style="color:white;background:#6457C6;padding:4px 8px; border-radius: 10px">Опубликован</span>
                                        @else
                                            <span
                                                style="color:white;background:darkred;padding:4px 8px; border-radius: 10px">Не опубликован</span>
                                        @endif
                                    </p>
                                </div>

                                <div class="col-lg-12 mt-3 mb-1">
                                    <p class="d-flex flex-wrap"><span style="margin-top:10px;">Теги:</span>
                                        @php
                                            $category = App\Models\Category::find($category->id);
                                            $tags = $category->tags;
                                        @endphp
                                        @foreach($tags as $tag)
                                            <span
                                                style="color:white;background:cornflowerblue;padding:4px 8px; border-radius: 10px;margin-left:5px; margin-top:10px;">{{$tag->title}}</span>
                                        @endforeach
                                    </p>
                                </div>

                                <div class="col-lg-12 mt-3 mb-2">
                                    <img src="{{ Storage::url($category->img) }}" alt="" class="img-fluid img-courses">
                                </div>
                            </div>

                            <div class="row mt-2 mb-4">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button text-dark font-weight-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#records-{{$category->id}}"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                Товары:
                                            </button>
                                        </h2>
                                        <div id="records-{{$category->id}}" class="accordion-collapse collapse"
                                             aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                @php
                                                    $products = App\Models\Product::get()->where('category_id',$category->id);
                                                @endphp
                                                @foreach($products as $product)
                                                    <div class="row">
                                                        <div class="col-lg-8 mt-2">
                                                            {{$product->title}}
                                                        </div>
                                                        <div class="col-lg-4 d-flex justify-content-end">
                                                            <a class="btn btn-primary btn-actions"
                                                               href="{{ route('products.edit',$product->id) }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="row mt-2">
                                                    <div class="col-lg-12 text-center">
                                                        <a href="{{ route('products.create') }}" class="btn btn-primary">Создать
                                                            товар <i class="fas fa-plus ml-2"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    @empty
                        <div>
                            <div class="text-center">{{ __('Нет категорий') }}</div>
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
