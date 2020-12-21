<nav class="navbar navbar-dark sticky-top navbar-expand-lg bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand nav-admin col-md-3 col-lg-2 me-0 px-3" href="/"><b>Nameless Store</b></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="navbar-nav mr-auto ml-3">
        <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="product">Produk</a>
        </li>
    </ul>
    <div class="navbar-nav mr-3">
        <!-- login -->
        <a class="nav-link" href="/admin"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z" />
                <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z" />
            </svg>
        </a>
    </div>
</nav>


<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="/admin">
                    <span data-feather="home"></span>
                    Dashboard <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file"></span>
                    Orders
                </a>
            </li>
            <!-- <li class="nav-item">
            <a class="nav-link" href="/admin">
              <span data-feather="shopping-cart"></span>
              Products
            </a>
          </li> -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/customers">
                    <span data-feather="users"></span>
                    Customers
                </a>
            </li>
        </ul>
    </div>
</nav>