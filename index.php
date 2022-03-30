<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- hoja de estilos -->
    <link rel="stylesheet" href="./css/styles.css">
    <!-- título de página -->
    <title>Título de la página</title>
    <!-- ícono de pàgina -->
    <!-- fuentes -->
    <!-- javascript Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
<?php
/* lectura del documento xml */
if (file_exists('xml/encartelera.xml')) {
    $films = simplexml_load_file('xml/encartelera.xml');
} else {
    exit('Error abriendo encartelera.xml.');
}
?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href=".">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- items del menú de navegación-->
                <?php
                $aux=[];
                foreach($films->film as $film){
                    if(!in_array((string)$film['cine'],$aux)){
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link active" aria-current="page" href="?cine='.$film['cine'].'">'.$film['cine'].'</a>';
                        echo '</li>';
                        array_push($aux,(string)$film['cine']);
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<!-- end Navbar -->

<div class="row-c">
    <div class="column-1">
        <!-- tabla de datos -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Película</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Tema</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if(isset($_GET['cine'])){
                /* filtro por cine */
                foreach($films->film as $film){
                    if($_GET['cine']==$film['cine']){
                        echo '<tr>';
                        echo '<td>'.$film->title.'</td>';
                        echo '<td>'.$film->description.'</td>';
                        echo '<td>'.$film->description['tema'].'</td>';
                        echo '</tr>';
                    }
                }
            }else{
                /* no filtro (muestro todos los datos) */
                foreach($films->film as $film){
                    echo '<tr>';
                    echo '<td>'.$film->title.'</td>';
                    echo '<td>'.$film->description.'</td>';
                    echo '<td>'.$film->description['tema'].'</td>';
                    echo '</tr>';
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

</body>

</html>