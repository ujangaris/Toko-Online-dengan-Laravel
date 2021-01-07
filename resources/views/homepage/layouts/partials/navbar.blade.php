 <header class="nav-holder make-sticky">
        <div id="navbar" role="navigation" class="navbar navbar-expand-lg">
          <div class="container"><a href="index.html" class="navbar-brand home"><img src="{{ url('homepage/img/logo.png') }}" alt="Universal logo" class="d-none d-md-inline-block"><img src="{{ url('homepage/img/logo-small.png') }}" alt="Universal logo" class="d-inline-block d-md-none"><span class="sr-only">Universal - go to homepage</span></a>
            <button type="button" data-toggle="collapse" data-target="#navigation" class="navbar-toggler btn-template-outlined"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
            <div id="navigation" class="navbar-collapse collapse">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item  active"><a href="javascript: void(0)" >Home</a>
                </li>
                <li class="nav-item dropdown menu-large"><a href="{{ url('/product') }}" >Product</a>
                </li>

                <!-- ========== FULL WIDTH MEGAMENU ==================-->
                <li class="nav-item dropdown menu-large"><a href="{{ url('supplier') }}" data-hover="dropdown" data-delay="200" ">Supplier </a>
                </li>
                <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle">Category <b class="caret"></b></a>
                  <ul class="dropdown-menu megamenu">
                    <li>
                      <div class="row">
                          @foreach($category as  $value)

                          <div class="col-md-6 col-lg-3">
                              <h5><a href="{{ url('category/'.$value->slug) }}">{{ $value->name }}</a></h5>
                            <ul class="list-unstyled mb-3">
                                @foreach($value->children as $sub)
                                    <li class="nav-item">
                                        <a href="{{ url('category/'.$sub->slug) }}" class="nav-link">{{ $sub->name }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        @endforeach

                    </li>
                  </ul>
                </li>
                @if(Auth::user())
                <li class="nav-item dropdown"><a style="color: #3aa18c "  href="javascript: void(0)" data-toggle="dropdown" class="dropdown-toggle"><img class=" rounded-circle" width="15px" src="{{ url(Auth::user()->photo) }}"> {{(Auth::user()->name) }}  <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li class="dropdown-item"><a href="{{ url('myprofil')}}" class="nav-link">My Acount</a></li>
                    <li class="dropdown-item"><a href="{{ Auth::logout() }}" class="nav-link">Logout</a></li>
                  </ul>
                </li>
                @endif

                <!-- ========== FULL WIDTH MEGAMENU END ==================-->

              </ul>
            </div>
            <div id="search" class="collapse clearfix">
              <form role="search" class="navbar-form">
                <div class="input-group">
                  <input type="text" placeholder="Search" class="form-control"><span class="input-group-btn">
                    <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button></span>
                </div>
              </form>
            </div>
          </div>
        </div>
      </header>
