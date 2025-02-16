<<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
      <!-- Menu -->


      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
              <a href="index.html" class="app-brand-link">
                  <span class="app-brand-logo demo">

                  </span>
                  <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>
              </a>


          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
              <!-- Dashboard -->
              <li class="menu-item active">
                  <a href="index.html" class="menu-link">
                      <i class="menu-icon tf-icons bx bx-home-circle"></i>
                      <div data-i18n="Analytics">Dashboard</div>
                  </a>
              </li>

              <!-- Layouts -->
              <li class="menu-item">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx-layout"></i>
                      <div data-i18n="Layouts">Layouts</div>
                  </a>

                  <ul class="menu-sub">
                      <li class="menu-item">
                          <a href="layouts-without-menu.html" class="menu-link">
                              <div data-i18n="Without menu">Without menu</div>
                          </a>
                      </li>
                      <li class="menu-item">
                          <a href="layouts-without-navbar.html" class="menu-link">
                              <div data-i18n="Without navbar">Without navbar</div>
                          </a>
                      </li>
                      <li class="menu-item">
                          <a href="layouts-container.html" class="menu-link">
                              <div data-i18n="Container">Container</div>
                          </a>
                      </li>
                      <li class="menu-item">
                          <a href="layouts-fluid.html" class="menu-link">
                              <div data-i18n="Fluid">Fluid</div>
                          </a>
                      </li>
                      <li class="menu-item">
                          <a href="layouts-blank.html" class="menu-link">
                              <div data-i18n="Blank">Blank</div>
                          </a>
                      </li>
                  </ul>
              </li>







              <li class="menu-header small text-uppercase"><span class="menu-header-text">Image</span></li>
              <!-- Forms -->
              <li class="menu-item">
                  <a href="" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx-detail"></i>
                      <div data-i18n="Form Elements">File</div>
                  </a>
                  {{-- <ul class="menu-sub">
                      <li class="menu-item">
                          <a href="{{route('file.create') }}" class="menu-link">
                              <div data-i18n="Basic Inputs">Create</div>
                          </a>
                      </li>
                      <li class="menu-item">
                          <a href="{{route('file.index') }}" class="menu-link">
                              <div data-i18n="Input groups">Index</div>
                          </a>
                      </li>
                  </ul> --}}
              </li>



                       
               



{{-- Pagesss --}}
              <li class="menu-header small text-uppercase">
                  <span class="menu-header-text">PAGES</span>
              </li>


{{--Page Home  start --}}
              <li class="menu-item">
                  <a href="javascript:void(0);" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx-layout"></i>
                      <div data-i18n="Layouts">Home</div>
                  </a>

                  <ul class="menu-sub">
                      <li class="menu-item">
                          <a href="" class="menu-link">
                              <div data-i18n="Without menu">Create</div>
                          </a>
                      </li>
                      <li class="menu-item">
                          <a href="" class="menu-link">
                              <div data-i18n="Without navbar">Index</div>
                          </a>
                      </li>

                  </ul>
              </li>

{{--Page Home end --}}

          </ul>
      </aside>