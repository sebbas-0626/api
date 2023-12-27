<?php

require 'flight/Flight.php';

Flight::register('db', 'PDO',array('mysql:host=localhost;dbname=api','root',''));

//leer los datos y los muestra
Flight::route('GET /alumnos', function () {
    $sentencia = Flight::db()->prepare("SELECT * FROM `alumnos`");
    $sentencia->execute();
    $datos=$sentencia->fetchAll();

    Flight::json($datos);
});

//inserta los datos en la base de datos
Flight::route('POST /alumnos', function () {
    $nombres=(Flight::request()->data->nombres);
    $apellidos=(Flight::request()->data->apellidos);

    $sql="INSERT INTO alumnos (nombres,apellidos) VALUES(?,?)";
    $sentencia=Flight::db()->prepare($sql);
    $sentencia->bindparam(1,$nombres);
    $sentencia->bindparam(2,$apellidos);
    $sentencia->execute();

    Flight::jsonp(["alumnos agregados"]);

});

//borrar registros de la base de datos

Flight::route('DELETE /alumnos', function () {
    $id=(Flight::request()->data->id);

    $sql="DELETE FROM alumnos WHERE id=?";
    $sentencia=Flight::db()->prepare($sql);
    $sentencia->bindparam(1,$id);
    $sentencia->execute();

    Flight::jsonp(["alumnos borrado"]);
});

//actualizar registros
Flight::route('PUT /alumnos', function () {

    $id=(Flight::request()->data->id);
    $nombres=(Flight::request()->data->nombres);
    $apellidos=(Flight::request()->data->apellidos);

    $sql="UPDATE alumnos SET nombres=?, apellidos=? WHERE id=?";

    $sentencia=Flight::db()->prepare($sql);

    $sentencia->bindparam(3,$id);
    $sentencia->bindparam(1,$nombres);
    $sentencia->bindparam(2,$apellidos);
    $sentencia->execute();

    Flight::jsonp(["alumnos actualizado"]);


    print_r($id);
    print_r($nombres);
    print_r($apellidos);

});

//leectura dde eeeun regidtro
Flight::route('GET /alumnos/@id', function ($id) {

    $sentencia=Flight::db()->prepare("SELECT * FROM `alumnos` WHERE  id=?");
    $sentencia->bindparam(1,$id);

    $sentencia->execute();
    $datos=$sentencia->fetchAll();
    Flight::json($datos);


});



Flight::start();

