<nav class="navbar navbar-expand-lg navbar-light bg-light">
   <div class="container">
     <a class="navbar-brand" href="index.html">
       <h4 style="width:25px;">LicitaDocs</h4>
     </a>
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
       data-bs-target="#navbarTogglerDemo03"
       aria-controls="navbarTogglerDemo03" aria-expanded="false"
       aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
       <ul class="navbar-nav ms-auto me-sm-2 mt-2 mt-lg-0">
         <li class="nav-item active me-3">
           <a class="nav-link" href="{{ route('usuario.dashboard')}}">Dashboard</a>
         </li>
         <li class="nav-item me-3">
           <a class="nav-link" href="{{ route('documento.upload')}}">Enviar Documento</a>
         </li>
         <li class="nav-item me-3">
           <a class="nav-link" href="#">Processos</a>
         </li>
         <li class="nav-item dropdown">
           <a class="nav-link" href="#" id="navbarDropdown" role="button"
             data-bs-toggle="dropdown" aria-haspopup="true"
             aria-expanded="false">
             {{ auth()->user()->name}}
             <img src="{{ url('assets/angle_down_icon.svg')}}"  style="width:12px;">
           </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdown">
             <a class="dropdown-item" href="#">Alterar Dados</a>
             <div class="dropdown-divider"></div>
             <a class="dropdown-item" href="{{ route('login.destroy')}}">Desconectar</a>
           </div>
         </li>
       </ul>

     </div>
   </div>
 </nav>
