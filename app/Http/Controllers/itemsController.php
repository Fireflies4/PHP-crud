<?php

session_start();

require_once __DIR__.'/../../../config/config.php';

//De homepage (index.php) zet $action op 'index', formulieren sturen 'action' mee via POST
$action = $action ?? ($_POST['action'] ?? '');

if($action == 'index')
{
    //Alle items ophalen via het Model (vult $items)
    require __DIR__.'/../../models/itemsModel.php';

    //Melding ophalen en meteen weer leegmaken, zodat hij maar één keer getoond wordt
    $success = $_SESSION['success'] ?? '';
    unset($_SESSION['success']);

    //De records doorgeven aan de View
    require __DIR__.'/../../../resources/views/items/index.php';
    exit;
}

//Vanaf hier worden alleen formulieren verwerkt die via POST zijn verstuurd
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    header('Location: ' . $base_url . '/index.php');
    exit;
}

if($action == 'create')
{
    //Variabelen vullen
    $naam = trim($_POST['naam'] ?? '');
    $beschrijving = trim($_POST['beschrijving'] ?? '');
    $categorie = trim($_POST['categorie'] ?? '');
    $aantal = trim($_POST['aantal'] ?? '');

    //Invoer controleren, per veld een foutmelding
    $errors = [];

    if($naam == '')
    {
        $errors['naam'] = "Vul een naam in.";
    }
    else if(mb_strlen($naam) > 100)
    {
        $errors['naam'] = "De naam mag maximaal 100 tekens lang zijn.";
    }

    if($beschrijving == '')
    {
        $errors['beschrijving'] = "Vul een beschrijving in.";
    }

    if($categorie == '')
    {
        $errors['categorie'] = "Vul een categorie in.";
    }
    else if(mb_strlen($categorie) > 50)
    {
        $errors['categorie'] = "De categorie mag maximaal 50 tekens lang zijn.";
    }

    if($aantal == '')
    {
        $errors['aantal'] = "Vul een aantal in.";
    }
    else if(!ctype_digit($aantal))
    {
        //ctype_digit controleert of het aantal alleen uit cijfers bestaat (dus geen min-teken of komma)
        $errors['aantal'] = "Het aantal moet een heel getal van 0 of hoger zijn.";
    }

    //Bij fouten: terug naar het formulier met de foutmeldingen en de ingevulde waarden
    if(count($errors) > 0)
    {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = [
            'naam' => $naam,
            'beschrijving' => $beschrijving,
            'categorie' => $categorie,
            'aantal' => $aantal
        ];

        header('Location: ' . $base_url . '/resources/views/items/create.php');
        exit;
    }

    //Opslaan via het Model: daar staan verbinding, query, prepare en execute
    //Het Model gebruikt de variabelen hierboven en vult $opgeslagen
    require __DIR__.'/../../models/itemsModel.php';

    //Gelukt: naar het overzicht met een melding. Mislukt: terug naar het formulier
    if($opgeslagen)
    {
        $_SESSION['success'] = 'Item "' . $naam . '" is toegevoegd.';
        header('Location: ' . $base_url . '/index.php');
        exit;
    }

    $_SESSION['errors'] = ['algemeen' => "Er ging iets mis bij het opslaan."];
    $_SESSION['old'] = [
        'naam' => $naam,
        'beschrijving' => $beschrijving,
        'categorie' => $categorie,
        'aantal' => $aantal
    ];
    header('Location: ' . $base_url . '/resources/views/items/create.php');
    exit;
}

//Onbekende actie: terug naar home
header('Location: ' . $base_url . '/index.php');
exit;
