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
                            <h4 class="text-dark">Товар: {{$product->title}}</h4>
                            <a class="btn btn-primary btn-actions" href="{!! route('products.edit', $product->slug) !!}">
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
                            <span>{{$product->id}}</span>
                        </div>
                    </div>
                    <div class="row border-bottom-light mt-2 mb-2">
                        <div class="col-lg-4 mb-2">
                            <p>Опубликован</p>
                        </div>
                        <div class="col-lg-8">
                            @if($product->published == 1)
                                <span style="color:white;background:#6457C6;padding:4px 8px; border-radius: 10px">Да</span>
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
                            @if(Storage::url($product->img) == '/storage/')
                                <p>Нет иозбражения</p>
                            @else
                                <img src="{{ Storage::url($product->img) }}" alt="" class="img-fluid" style="width:263px;height:192px;">
                            @endif

                        </div>
                    </div>
                    <div class="row border-bottom-light mt-2 mb-2">
                        <div class="col-lg-4 mb-2">
                            <p>Цена</p>
                        </div>
                        <div class="col-lg-8">
                            <span>{{$product->price}}</span>
                        </div>
                    </div>
                    <div class="row border-bottom-light mt-2 mb-2">
                        <div class="col-lg-4">
                            <span class="text-dark">Описание товара: </span>
                        </div>
                        <div class="col-lg-8">
                            <p>{{$product->description}}</p>
                        </div>
                    </div>

                    <div class="row border-bottom-light mt-2 mb-2">
                        <div class="col-lg-4">
                            <span class="text-dark">Характеристики: </span>
                        </div>
                        <div class="col-lg-8">
                           <div class="content">
                               @foreach ($product->content as $elem)
                                  <p><b>{{ $elem['value'] }}: </b> <span>{{ $elem['text'] }}</span></p>
                               @endforeach
                           </div>
                        </div>
                    </div>

                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('admin.layouts.footer')

        <!-- End of Footer -->

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
        let firstBr = $('.content-div').find(':first-child').css('margin-left','3%');
        let br = $('.br');
        br.next().css('margin-left','3%');
    </script>
@endsection
