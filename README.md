# Poudlhard Explorer — Univers Harry Potter

## Lancer la page en local

```bash
git clone git@github.com:fannysaez/php-poudlhardExplorer-api-cda.git
cd php-poudlhardExplorer-api-cda
php -S localhost:8000
```

Puis ouvrir `http://localhost:8000` dans le navigateur.

Aucune installation supplémentaire n'est nécessaire : Bootstrap est chargé via CDN
et les données proviennent de l'API `https://hp-api.onrender.com/api/characters`
à chaque chargement de la page.

## Aperçu

![Aperçu de la page Univers Harry Potter](./Catalogue%20des%20Personnages%20-%20Poudlhard%20Explorer.png)

## Structure du projet

```bash
poudlardExplorer/
├── index.php
├── images/
│   ├── gryffindor.jpg
│   ├── slytherin.jpg
│   ├── ravenclaw.jpg
│   └── hufflepuff.jpg
├── TP/
│   └── TP-Jour2-3.md
├── README.md
└── Catalogue des Personnages - Poudlhard Explorer.png
```

## Bonus traités

- Nombre de personnages affichés en haut de page (calculé après filtrage, donc
  toujours cohérent avec le nombre de cartes réellement rendues).

- Blason de la maison affiché au-dessus du nom de la maison dans la carte.

- Marqueur (tête de mort) en haut à droite de la carte pour les personnages
  décédés (`alive` à `false`).

- Bordure de carte colorée selon le genre : bleu (male), rouge (female),
  noir (non renseigné).

- Âge calculé dynamiquement avec `DateTime`, en priorité à partir de
  `dateOfBirth` (jour, mois, année précis) et, à défaut, à partir de
  `yearOfBirth` seul — aucune année n'est écrite en dur. L'âge n'est affiché
  que lorsqu'au moins une des deux informations est disponible.

## Analyse réflexive

- **Choix d'affichage/masquage** : seule la présence d'une image conditionne
  l'apparition d'une carte, pour éviter toute image cassée. En revanche, à
  l'intérieur d'une carte, chaque champ (maison, date de naissance, âge) n'est
  affiché que s'il est réellement renseigné, pour ne jamais montrer
  d'encadré vide.

- **Si l'API avait été indisponible** : la page affiche un message d'erreur
  clair à la place de la grille plutôt que de planter ou d'afficher une page
  blanche (voir la vérification du retour de `file_get_contents()`).