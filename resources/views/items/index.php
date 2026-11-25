<?php
require_once __DIR__.'/../../../config/config.php';

//Variabelen die de controller meegeeft
$items = $items ?? [];
$success = $success ?? '';
?>
<!doctype html>
<html lang="nl">

<head>
    <title>Voorraadbeheer</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>Welkom bij Voorraadbeheer</h1>
        <p>Beheer hier de items in de voorraad.</p>
        <a href="<?php echo $base_url; ?>/resources/views/items/create.php">Nieuw item toevoegen &gt;</a>

        <?php if($success != '')
        {
            echo "<div class='msg msg-success'>" . htmlspecialchars($success) . "</div>";
        } ?>

        <h2>Items</h2>

        <?php if(count($items) > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Beschrijving</th>
                    <th>Categorie</th>
                    <th>Aantal</th>
                    <th>Aangemaakt op</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($items as $item)
                {
                    echo "<tr>";
                    echo "<td>
                            <a href='" . $base_url . "/resources/views/items/edit.php?id=" . $item['id'] . "'>"
                            . htmlspecialchars($item['naam']) . "</a>
                          </td>";
                    echo "<td>" . htmlspecialchars($item['beschrijving']) . "</td>";
                    echo "<td>" . htmlspecialchars($item['categorie']) . "</td>";
                    echo "<td>" . htmlspecialchars($item['aantal']) . "</td>";
                    echo "<td>" . date("d-m-Y H:i", strtotime($item['aangemaakt_op'])) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php } else { ?>
            <div class="msg">Er zijn nog geen items in de voorraad. Voeg je eerste item toe via "Nieuw item".</div>
        <?php } ?>
    </div>

</body>

</html>
