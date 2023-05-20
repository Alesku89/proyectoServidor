<?php

    class Conexion {

        private $conexion;

        public function __construct() {
            $this->conexion = new mysqli('localhost','root','','servidor');          
        }

        public function login() {

            session_start();

            $login = $_POST['login'];
            $password = $_POST['password'];

            $query = $this->conexion->query("SELECT * FROM usuario WHERE upper(Correo) = upper('$login') AND Password = '$password'");

            if(mysqli_num_rows($query) > 0) {
        
                $consulta = $this->conexion->query("SELECT Seq_Usuario, Nombre FROM usuario WHERE upper(correo) = upper('$login')");

                while($row = $consulta->fetch_array() ) {   //$_SESSION['usuario'] siempre será el nombre de usuario
                    $_SESSION['usuario'] = $row[0]; 
                    setcookie("nombre",$row[1], time()+3600,"/");     
                }

                echo '
                <script>
                    alert("Sesion iniciada con éxito.");
                    window.location = "../Vistas/V_index.php";
                </script>
                ';
            } 

            else {
                echo '
                    <script>
                        alert("El correo o usuario no coinciden con la contraseña.");
                        window.location = "../Vistas/V_login.php";
                    </script>
                    ';
            }

        }

        public function cerrarSesion() {
            session_start();
            session_destroy();
            setcookie("nombre","", time()-1,"/");  
            echo '
            <script>
                alert("Sesión cerrada con éxito.");
                window.location = "../Vistas/V_index.php";
            </script>
            ';

        }

        public function getAsociaciones() {

            $query = $this->conexion->query('SELECT asociacion.CodAso, asociacion.Descripcion as "Asociacion", asociacion.CIF, CONCAT(tipovia.Descripcion," ",domicilio.NombreVia," ",domicilio.Numero,", ",provincia.Descripcion,", ",localidad.Descripcion) as "domicilio", domicilio.mapa FROM asociacion INNER JOIN domicilio ON asociacion.Seq_Dom = domicilio.Seq_Dom INNER JOIN tipovia ON tipovia.CodTV = domicilio.CodTV INNER JOIN localidad ON domicilio.CodLoc = localidad.CodLoc INNER JOIN provincia ON localidad.CodProv = provincia.CodProv');

            $asociaciones = [];

            $i = 0;

            while($fila = $query->fetch_assoc()) {
                $asociaciones[$i] = $fila;
                $i++;
            }

            return $asociaciones;
        }

        public function getGatos() {

            $query = $this->conexion->query('SELECT animal.CodAni as "CodAni", asociacion.Descripcion as "CodAso", animal.Nombre as "nombre",raza.Descripcion as "raza", animal.CodAni, asociacion.Descripcion as "asociacion" FROM animal INNER JOIN raza ON animal.CodRaz = raza.CodRaz INNER JOIN tipoanimal on raza.CodTA = tipoanimal.CodTA INNER JOIN asociacion ON animal.CodAso = asociacion.CodAso WHERE tipoanimal.CodTA = 1 AND animal.estado = 1');

            $gatos = [];

            $i = 0;

            while($fila = $query->fetch_assoc()) {
                $gatos[$i] = $fila;
                $i++;
            }

            return $gatos;
        }

        public function getPerros() {

            $query = $this->conexion->query('SELECT animal.CodAni as "CodAni", asociacion.Descripcion as "CodAso", animal.Nombre as "nombre",raza.Descripcion as "raza", animal.CodAni, asociacion.Descripcion as "asociacion" FROM animal INNER JOIN raza ON animal.CodRaz = raza.CodRaz INNER JOIN tipoanimal on raza.CodTA = tipoanimal.CodTA INNER JOIN asociacion ON animal.CodAso = asociacion.CodAso WHERE tipoanimal.CodTA = 2 AND animal.estado = 1');

            $perros = [];

            $i = 0;

            while($fila = $query->fetch_assoc()) {
                $perros[$i] = $fila;
                $i++;
            }

            return $perros;
        }

        public function getCuenta() {

            $usuario = $_SESSION['usuario'];

            $query = $this->conexion->query("SELECT CuentaBanco as 'cuenta' FROM usuario WHERE Seq_Usuario = '$usuario'");

            $cuenta = $query->fetch_assoc();

            return $cuenta;
        }

        public function donacion() {

            session_start();

            $usuario = $_SESSION['usuario'];
            $asociacion = $_POST['asociacion'];
            $cantidad = $_POST['cantidad'];

            $query = $this->conexion->query("INSERT INTO donacion VALUES ('Seq_Don','$usuario','$asociacion','$cantidad',CURRENT_TIMESTAMP)");

            echo '<script>
                    alert("Donación realizada con éxito");
                    window.location = "../Vistas/V_index.php";
                  </script>';
        }

        public function adopcion() {

            session_start();

            if($_SESSION['usuario'] == '') {
                echo '<script>
                    alert("Necesita iniciar sesión para adoptar el animal.");
                    window.location = "../Vistas/V_login.php";
                  </script>';
            }

            $usuario = $_SESSION['usuario'];
            $animal = $_POST['CodAni'];

            $query = $this->conexion->query("INSERT INTO adopcion VALUES ('Seq_Ado','$usuario','$animal',CURRENT_TIMESTAMP)");

            $query = $this->conexion->query("UPDATE animal SET Estado = 0 WHERE CodAni = '$animal'");

            echo '<script>
                    alert("Adopción realizada con éxito");
                    window.location = "../Vistas/V_index.php";
                  </script>';
        }

        public function getUsuarios() {

            $query = $this->conexion->query('SELECT usuario.Seq_Usuario as "Usuario", usuario.DNI as "DNI", usuario.nombre as "nombre", CONCAT(usuario.Ap1," ",COALESCE(usuario.Ap2," ")) as "apellidos", usuario.Telefono as "telefono", usuario.correo as "correo", usuario.CuentaBanco as "cuenta",CONCAT(tipovia.Descripcion," ",domicilio.NombreVia," ",domicilio.Numero,", ",provincia.Descripcion,", ",localidad.Descripcion) as "domicilio" FROM usuario INNER JOIN domicilio ON usuario.Seq_Dom = domicilio.Seq_Dom INNER JOIN tipovia ON tipovia.CodTV = domicilio.CodTV INNER JOIN localidad ON domicilio.CodLoc = localidad.CodLoc INNER JOIN provincia ON localidad.CodProv = provincia.CodProv WHERE CodPer = 3');

            $usuarios = [];

            $i = 0;

            while($fila = $query->fetch_assoc()) {
                $usuarios[$i] = $fila;
                $i++;
            }

            return $usuarios;
        }

        public function getAdopciones() {

            $query = $this->conexion->query('SELECT usuario.DNI as "DNI", usuario.Nombre as "nombre", CONCAT(usuario.Ap1," ",COALESCE(usuario.Ap2," ")) as "apellidos", asociacion.Descripcion, animal.Nombre as "aninombre", adopcion.fecha as "fecha" FROM adopcion INNER JOIN usuario ON adopcion.Seq_Usuario = usuario.Seq_Usuario INNER JOIN animal ON adopcion.CodAni = animal.CodAni INNER JOIN asociacion ON animal.CodAso = asociacion.CodAso ORDER BY Fecha ASC');

            $adopciones = [];

            $i = 0;

            while($fila = $query->fetch_assoc()) {
                $adopciones[$i] = $fila;
                $i++;
            }

            return $adopciones;
        }

        public function getDonaciones() {

            $query = $this->conexion->query('SELECT usuario.DNI as "DNI", usuario.Nombre as "nombre", CONCAT(usuario.Ap1," ",COALESCE(usuario.Ap2," ")) as "apellidos", asociacion.Descripcion, donacion.Importe as "importe", donacion.fecha as "fecha" FROM donacion INNER JOIN usuario ON donacion.Seq_Usuario = usuario.Seq_Usuario INNER JOIN asociacion ON donacion.CodAso = asociacion.CodAso ORDER BY Fecha ASC');

            $donaciones = [];

            $i = 0;

            while($fila = $query->fetch_assoc()) {
                $donaciones[$i] = $fila;
                $i++;
            }

            return $donaciones;
        }

        public function getDonacionesUsuario() {

            session_start();

            $usuario = $_SESSION['usuario'];

            $query = $this->conexion->query('SELECT asociacion.Descripcion, donacion.Importe as "importe", donacion.fecha as "fecha" FROM donacion INNER JOIN usuario ON donacion.Seq_Usuario = usuario.Seq_Usuario INNER JOIN asociacion ON donacion.CodAso = asociacion.CodAso WHERE Seq_Usuario = '.$usuario.' ORDER BY Fecha ASC');

            $donaciones = [];

            $i = 0;

            while($fila = $query->fetch_assoc()) {
                $donaciones[$i] = $fila;
                $i++;
            }

            return $donaciones;
        }

        public function getAdopcionesUsuario() {

            $usuario = $_SESSION['usuario'];

            $query = $this->conexion->query('SELECT asociacion.Descripcion, animal.Nombre as "aninombre", adopcion.fecha as "fecha" FROM adopcion INNER JOIN usuario ON adopcion.Seq_Usuario = usuario.Seq_Usuario INNER JOIN animal ON adopcion.CodAni = animal.CodAni INNER JOIN asociacion ON animal.CodAso = asociacion.CodAso WHERE adopcion.Seq_Usuario = '.$usuario.' ORDER BY Fecha ASC');

            $adopciones = [];

            $i = 0;

            while($fila = $query->fetch_assoc()) {
                $adopciones[$i] = $fila;
                $i++;
            }

            return $adopciones;
        }

        public function selectVia() {

            $query = $this->conexion->query('SELECT Descripcion FROM tipovia');

            $tv = [];

            $i = 0;

            while($fila = $query->fetch_assoc()) {
                $tv[$i] = $fila;
                $i++;
            }

            return $tv;
        }

        public function selectProv() {

            $query = $this->conexion->query('SELECT Descripcion FROM provincia');

            $prov = [];

            $i = 0;

            while($fila = $query->fetch_assoc()) {
                $prov[$i] = $fila;
                $i++;
            }

            return $prov;
        }

        public function selectLoc() {

            // LOCALIDADES POR PROVINCIAS!!

            $query = $this->conexion->query('SELECT localidad.Descripcion FROM localidad INNER JOIN provincia ON localidad.CodProv = provincia.CodProv');

            $loc = [];

            $i = 0;

            while($fila = $query->fetch_assoc()) {
                $loc[$i] = $fila;
                $i++;
            }

            return $loc;
        }

        public function registroUsuario() {

            if($_POST['password'] != $_POST['cpassword']) {
                echo '<script>
                        alert("Las contraseñas no coinciden.");
                        window.location = "../Vistas/V_registroUsuario.php";
                    </script>
                ';
            }

            $dom = $this->conexion->query('SELECT MAX(Seq_Dom) as "valor" FROM domicilio');

            $dom = $dom->fetch_assoc();

            $dom = $dom['valor']+1;

            $usu = $this->conexion->query('SELECT MAX(Seq_Usuario) as "valor" FROM usuario');

            $usu = $usu->fetch_assoc();

            $usu = $usu['valor']+1;


            $prov = $this->conexion->query('SELECT CodProv FROM provincia WHERE provincia.Descripcion = "'.$_POST["prov"].'"');

            $loc = $this->conexion->query('SELECT CodLoc FROM localidad WHERE localidad.Descripcion = "'.$_POST["loc"].'"');

            $tv = $this->conexion->query('SELECT CodTV FROM tipovia WHERE Descripcion = "'.$_POST["tv"].'"');

            $prov = $prov->fetch_assoc();

            $loc = $loc->fetch_assoc();

            $tv = $tv->fetch_assoc();

            // $query = $this->conexion->query('INSERT INTO domicilio (Seq_Dom, CodTV, NombreVia, Numero, Piso, Letra, CodProv, CodLoc) VALUES ('.$dom.','.$tv["CodTV"].',"'.$_POST["nombrevia"].'",'.$_POST["numero"].','.$_POST["piso"].',"'.$_POST["letra"].'",'.$prov["CodProv"].','.$loc["CodLoc"].')');
            
            // $query = $this->conexion->query('INSERT INTO usuario (Seq_usuario, DNI, Nombre, Ap1, Ap2, Telefono, Correo, "'.$pass.'", CuentaBanco, CodPer, Seq_Dom) VALUES ('.$usu.','.$_POST["dni"].',"'.$_POST["nombre"].'","'.$_POST["ap1"].'","'.$_POST["ap2"].'",'.$_POST["telefono"].',"'.$_POST["correo"].'","'.$_POST["password"].'",'.$_POST["cuenta"].',3,'.$dom.')');
            //$query = $this->conexion->query('INSERT INTO usuario (Seq_usuario,CodPer,Seq_Dom) VALUES ('.$usu.',3,'.$dom.')');
            $query = $this->conexion->query('INSERT INTO usuario (Seq_usuario, DNI, Nombre, Ap1, Ap2, Telefono, Correo, `Password`, CuentaBanco, CodPer, Seq_Dom) VALUES ('.$usu.','.$_POST["dni"].',"'.$_POST["nombre"].'","'.$_POST["ap1"].'","'.$_POST["ap2"].'",'.$_POST["telefono"].',"'.$_POST["correo"].'","'.$_POST["password"].'",'.$_POST["cuenta"].',3,'.$dom.')');

            echo '<script>
                    alert("Registro realizado con éxito.");
                    window.location = "../Vistas/V_login.php";
                  </script>';
        }

    }

?>