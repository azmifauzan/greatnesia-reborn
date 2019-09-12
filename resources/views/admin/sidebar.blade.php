<nav class="col-md-2 d-none d-md-block bg-light sidebar">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link @if($title == 'Dashboard') active @endif" href="{{ route('dashboard') }}">
          <span data-feather="home"></span>
          Dashboard @if($title == "Dashboard")<span class="sr-only">(current)</span>@endif
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link @if($title == 'Categories') active @endif" href="{{ route('category.index') }}">
          <span data-feather="layers"></span>
          Categories @if($title == "Categories")<span class="sr-only">(current)</span>@endif
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link @if($title == 'Articles') active @endif" href="{{ route('article.index') }}">
          <span data-feather="edit-3"></span>
          Articles @if($title == "Articles")<span class="sr-only">(current)</span>@endif
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link @if($title == 'Users') active @endif" href="{{ route('user.index') }}">
          <span data-feather="users"></span>
          Users
        </a>
      </li>      
    </ul>        
  </div>
</nav>