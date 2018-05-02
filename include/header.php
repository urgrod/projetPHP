
<nav class="navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Easy NACA</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="../index.php">Accueil <span class="sr-only">(current)</span></a>
            </li>
          <li class="nav-item">
            <a class="nav-link" href="../php/addprofil.php">Ajouter un profil</a>
          </li>
          <li class="nav-item">
            <?php
                session_start();
                if(isset($_SESSION["username"])){
                    echo '<a class="nav-link" href="/php/script/disconnect.php">Déconnexion</a>';
                }else{
                    echo '<a class="nav-link" href="/php/login.php">Connexion</a>';
                }
            ?>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="get">
          <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search (Si on a le time)" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
