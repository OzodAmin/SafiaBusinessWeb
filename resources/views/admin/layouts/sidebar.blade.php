<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Пользователи</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i> <span>Пользователи</span></a></li>
            <li><a href="{{ route('roles.index') }}"><i class="fa fa-circle-o"></i> <span>Роли</span></a></li>
          </ul>
        </li>
        <!-- Cities & Districts -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-globe"></i>
            <span>Города</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('cities.index') }}"><i class="fa fa-circle-o"></i> <span>Города</span></a></li>
            <li><a href="{{ route('districts.index') }}"><i class="fa fa-circle-o"></i> <span>Районы</span></a></li>
          </ul>
        </li>
        <!-- Cakes ingredients -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-align-center"></i>
            <span>Инградиенты</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('bases.index') }}"><i class="fa fa-circle-o"></i> <span>Основа</span></a></li>
            <li><a href="{{ route('creams.index') }}"><i class="fa fa-circle-o"></i> <span>Крем</span></a></li>
            <li><a href="{{ route('fillings.index') }}"><i class="fa fa-circle-o"></i> <span>Начинки</span></a></li>
            <li><a href="{{ route('decors.index') }}"><i class="fa fa-circle-o"></i> <span>Оформление</span></a></li>
            <li><a href="{{ route('covers.index') }}"><i class="fa fa-circle-o"></i> <span>Покрытие</span></a></li>
            <li><a href="{{ route('sizes.index') }}"><i class="fa fa-circle-o"></i> <span>Размер</span></a></li>
          </ul>
        </li>
        
        <li><a href="{{ route('measures.index') }}"><i class="fa fa-balance-scale"></i> <span>Ед. измерения</span></a></li>
        <li><a href="{{ route('categories.index') }}"><i class="fa fa-share"></i> <span>Категории</span></a></li>
        <li><a href="{{ route('products.index') }}"><i class="fa fa-birthday-cake"></i> <span>Products</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>