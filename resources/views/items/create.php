<?php
session_start();
require_once __DIR__.'/../../../config/config.php';

//Foutmeldingen, ingevulde waarden en de melding ophalen die de controller heeft klaargezet
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
$success = $_SESSION['success'] ?? '';

$naam = $old['naam'] ?? '';
$beschrijving = $old['beschrijving'] ?? '';
$categorie = $old['categorie'] ?? '';
$aantal = $old['aantal'] ?? '';

//Meteen weer leegmaken, zodat alles maar één keer getoond wordt
unset($_SESSION['errors'], $_SESSION['old'], $_SESSION['success']);
?>
<!doctype html>
<html lang="nl">

<head>
    <title>Voorraadbeheer / Items / Nieuw</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>Nieuw item</h1>
        <a href="<?php echo $base_url; ?>/index.php">&lt; Terug naar home</a>

        <?php if($success != '') { ?>
            <div class="msg msg-success"><?php echo htmlspecialchars($success); ?></div>
        <?php } ?>

        <?php if(count($errors) > 0) { ?>
            <div class="msg msg-error">Het item is niet opgeslagen. Controleer de velden hieronder.</div>
        <?php } ?>

        <form action="<?php echo $base_url; ?>/app/Http/Controllers/itemsController.php" method="POST">
            <input type="hidden" name="action" value="create">

            <div class="form-group">
                <label for="naam">Naam:</label>
                <input type="text" name="naam" id="naam" maxlength="100"
                    class="form-input<?php echo isset($errors['naam']) ? ' is-invalid' : ''; ?>"
                    value="<?php echo htmlspecialchars($naam); ?>">
                <?php if(isset($errors['naam'])) { ?>
                    <p class="error"><?php echo htmlspecialchars($errors['naam']); ?></p>
                <?php } ?>
            </div>

            <div class="form-group">
                <label for="beschrijving">Beschrijving:</label>
                <textarea name="beschrijving" id="beschrijving" rows="4"
                    class="form-input<?php echo isset($errors['beschrijving']) ? ' is-invalid' : ''; ?>"><?php echo htmlspecialchars($beschrijving); ?></textarea>
                <?php if(isset($errors['beschrijving'])) { ?>
                    <p class="error"><?php echo htmlspecialchars($errors['beschrijving']); ?></p>
                <?php } ?>
            </div>

            <div class="form-group">
                <label for="categorie">Categorie:</label>
                <input type="text" name="categorie" id="categorie" maxlength="50"
                    class="form-input<?php echo isset($errors['categorie']) ? ' is-invalid' : ''; ?>"
                    value="<?php echo htmlspecialchars($categorie); ?>">
                <?php if(isset($errors['categorie'])) { ?>
                    <p class="error"><?php echo htmlspecialchars($errors['categorie']); ?></p>
                <?php } ?>
            </div>

            <div class="form-group">
                <label for="aantal">Aantal:</label>
                <input type="number" min="0" name="aantal" id="aantal"
                    class="form-input<?php echo isset($errors['aantal']) ? ' is-invalid' : ''; ?>"
                    value="<?php echo htmlspecialchars($aantal); ?>">
                <?php if(isset($errors['aantal'])) { ?>
                    <p class="error"><?php echo htmlspecialchars($errors['aantal']); ?></p>
                <?php } ?>
            </div>

            <input type="submit" value="Item opslaan">

        </form>
    </div>

</body>

</html>
