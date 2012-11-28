<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>jQuery Autocompletar con Ajax</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta content="Plugin Gratis para autocompletar un input con jQuery y Ajax" name="description" />
        <script src="js/jquery-1.4.2.min.js"></script>
        <script src="js/autocomplete.jquery.js"></script>
        <link type="text/css" rel="stylesheet" href="css/autocomplete.css"></link>
        <script>
            $(document).ready(function(){
                /* Una vez que se cargo la pagina , llamo a todos los autocompletes y
                 * los inicializo */
                $('.autocomplete').autocomplete();
            });
        </script>
    </head>
    <body>
        <!-- Código del Autocompletar , todo el código html necesario estra entre estos comentarios -->
        <div class="autocomplete">
            <label style="display:block;">Seleccione una categoría:</label>
            <input  type="text" value="" data-source="search.php?search=" />
        </div>
        <!-- fin de codigo autocompletar -->
    </body>
</html>