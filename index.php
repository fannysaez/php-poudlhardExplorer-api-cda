<?php

$urlApi = 'https://hp-api.onrender.com/api/characters';

$imagesMaisons = [
    'Gryffindor' => 'images/gryffindor.jpg',
    'Slytherin'  => 'images/slytherin.jpg',
    'Ravenclaw'  => 'images/ravenclaw.jpg',
    'Hufflepuff' => 'images/hufflepuff.jpg',
];

$contenuJson = @file_get_contents($urlApi);

if ($contenuJson === false) {
    $personnagesAvecImage = [];
    $nombrePersonnages = 0;
    $erreurApi = true;
} else {
    $personnages = json_decode($contenuJson, true);

    $personnagesAvecImage = array_filter($personnages, function ($personnage) {
        return !empty($personnage['image']);
    });

    $nombrePersonnages = count($personnagesAvecImage);
    $erreurApi = false;
}

function calculerAge(?string $dateNaissanceTexte, ?int $anneeNaissance): ?int
{
    if (!empty($dateNaissanceTexte)) {
        $dateNaissance = DateTime::createFromFormat('d-m-Y', $dateNaissanceTexte);
    } elseif (!empty($anneeNaissance)) {
        $dateNaissance = new DateTime($anneeNaissance . '-01-01');
    } else {
        return null;
    }

    if ($dateNaissance === false) {
        return null;
    }

    $dateAujourdhui = new DateTime();
    $intervalle = $dateAujourdhui->diff($dateNaissance);

    return (int) $intervalle->y;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des personnages de Poudlhard Explorer</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card-img-top {
            height: 210px;
            object-fit: cover;
            object-position: top;
        }

        .carte-personnage {
            position: relative;
            border-width: 3px;
            border-style: solid;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .carte-personnage:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.25) !important;
        }

        .marqueur-deces {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0);
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-4">

    <h1 class="mb-2 text-center">Univers Harry Potter</h1>

    <?php if ($erreurApi) : ?>

        <div class="alert alert-warning text-center">
            Impossible de récupérer les données depuis l'API pour le moment.
        </div>

    <?php else : ?>

        <p class="text-muted text-center mb-4">
            <?= $nombrePersonnages ?> personnage<?= $nombrePersonnages > 1 ? 's' : '' ?> affiché<?= $nombrePersonnages > 1 ? 's' : '' ?>
        </p>

    <?php endif; ?>

    <div class="row g-4">

        <?php foreach ($personnagesAvecImage as $personnage) : ?>

            <?php
            $nom = $personnage['name'] ?? 'Nom inconnu';
            $maison = $personnage['house'] ?? '';
            $dateNaissanceTexte = $personnage['dateOfBirth'] ?? '';
            $anneeNaissance = $personnage['yearOfBirth'] ?? null;
            $urlImage = $personnage['image'];
            $estVivant = $personnage['alive'] ?? true;
            $genre = $personnage['gender'] ?? '';
            $age = calculerAge($dateNaissanceTexte, $anneeNaissance);

            if ($genre === 'male') :
                $couleurBordure = '#0d6efd';
            elseif ($genre === 'female') :
                $couleurBordure = '#dc3545';
            else :
                $couleurBordure = '#000000';
            endif;
            ?>

            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm mb-4 carte-personnage" style="border-color: <?= $couleurBordure ?>;">

                    <?php if (!$estVivant) : ?>
                        <span class="marqueur-deces" title="Personnage décédé">☠️</span>
                    <?php endif; ?>

                    <img src="<?= htmlspecialchars($urlImage) ?>" class="card-img-top" alt="Photo de <?= htmlspecialchars($nom) ?>">

                    <div class="card-body">

                        <h5 class="card-title text-center"><?= htmlspecialchars($nom) ?></h5>

                        <?php if (!empty($maison) && isset($imagesMaisons[$maison])) : ?>
                            <div class="text-center mb-2">
                                <img src="<?= htmlspecialchars($imagesMaisons[$maison]) ?>" alt="Blason de <?= htmlspecialchars($maison) ?>" style="width: 50px; height: 50px; object-fit: contain;">
                                <p class="card-text mb-0"><?= htmlspecialchars($maison) ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($dateNaissanceTexte)) : ?>
                            <p class="card-text text-center mb-1">
                                <strong>Né(e) le :</strong> <?= htmlspecialchars($dateNaissanceTexte) ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($age !== null) : ?>
                            <p class="card-text text-center mb-0">
                                <strong>Âge :</strong> <?= $age ?> ans
                            </p>
                        <?php endif; ?>

                    </div>

                </div>
            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>
</html>