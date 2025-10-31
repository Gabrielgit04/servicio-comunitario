<?php

// $db_name = 'servicio.db';

define('DB_NAME', 'servicio.db');


function conexionDB()
{

        try {
                $db = new PDO("sqlite:" . __DIR__ . "/" . DB_NAME);
                // Set error mode to exceptions
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        //         $consult = "CREATE TABLE IF NOT EXISTS users_admins(
        //     ci int,
        //     nombre_completo  varchar(70),
        //     correo varchar(40),
        //     contrasena varchar(50),
        //     PRIMARY KEY(ci)
        //     );";

                // $db->exec($consult);

                return $db;
        } catch (PDOException $e) {
                echo "Error de conexion: " . $e->getMessage();
                exit();
        }
}
