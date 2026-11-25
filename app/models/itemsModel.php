<?php

//Model: hier staan de SQL-query's voor de tabel items
//Dit bestand wordt door de controller geladen. De controller vult eerst $action
//(en bij 'create' ook $naam, $beschrijving, $categorie en $aantal).

//Variabelen uit de controller overnemen
$action = $action ?? '';
$naam = $naam ?? '';
$beschrijving = $beschrijving ?? '';
$categorie = $categorie ?? '';
$aantal = $aantal ?? 0;

//1. Verbinding
require_once __DIR__.'/../../config/conn.php';

if($action == 'index')
{
    //2. Query
    $query = "SELECT * FROM items ORDER BY aangemaakt_op DESC, id DESC";

    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([]);

    //5. Fetchall
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);
}

if($action == 'create')
{
    //2. Query
    $query = "
        INSERT INTO items
            (naam, beschrijving, categorie, aantal)
        VALUES
            (:naam, :beschrijving, :categorie, :aantal)
    ";

    //3. Prepare
    $statement = $conn->prepare($query);

    //4. Execute
    $statement->execute([
        ":naam" => $naam,
        ":beschrijving" => $beschrijving,
        ":categorie" => $categorie,
        ":aantal" => (int) $aantal
    ]);

    //5. Resultaat: bij een INSERT is er niets om te fetchen,
    //   dus we kijken of er precies één record is toegevoegd
    $opgeslagen = $statement->rowCount() == 1;
}


