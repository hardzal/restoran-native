    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="./?show=admin&pages=">
              <!-- class='active'-->
              <span data-feather="home"></span>
              Dashboard
              <!--<span class="sr-only">(current)</span>-->
            </a>
          </li>
          <?php
          if ($_SESSION['roles_id'] != 6) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= './?show=admin&pages=order-all' ?>">
                <span data-feather="file"></span>
                Orders
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= './?show=admin&pages=product-all' ?>">
                <span data-feather="shopping-cart"></span>
                Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="././?show=admin&pages=category-all">
                <span data-feather="tag"></span>
                Categories
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./?show=admin&pages=desk-all">
                <span data-feather="tablet"></span>
                Desks
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= './?show=admin&pages=user-all' ?>">
                <span data-feather="users"></span>
                Users
              </a>
            </li>
            <li class='nav-item'>
              <a class='nav-link' href='./?show=admin&pages=payment-all'>
                <span data-feather="credit-card"></span>
                Payments
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./?show=admin&pages=logs-all">
                <span data-feather="bar-chart-2"></span>
                Logs
              </a>
            </li>
          <?php
          }
          ?>
          <li class="nav-item">
            <a class="nav-link" href="./?show=admin&pages=settings">
              <span data-feather="settings"></span>
              Settings
            </a>
          </li>
        </ul>
      </div>
    </nav>