## Exercice 6 : Afficher dynamiquement des personnages Harry Potter avec Bootstrap et JSON

Tu vas créer une page PHP qui récupère des données depuis une **API externe**, les transforme en **tableau PHP**, puis les affiche sous forme de **cartes Bootstrap** joliment mises en page.

---

### 🔗 Lien de l’API :
```
https://hp-api.onrender.com/api/characters
```

---

### 🎯 Objectif général :
Créer une grille de cartes HTML avec Bootstrap, contenant les personnages de l’univers Harry Potter, en récupérant dynamiquement les données depuis une API.

---

### 🧩 Étapes à suivre :

1. **Récupération des données**
    - Utilise `file_get_contents()` pour récupérer le contenu de l’URL.
    - Utilise `json_decode()` pour transformer le JSON obtenu en tableau PHP exploitable.
    - Tu obtiendras un tableau contenant plusieurs personnages, chacun avec différentes infos (nom, maison, image, etc.).

2. **Préparation de la structure HTML**
    - Intègre Bootstrap via un CDN dans ton fichier HTML (`<head>`).
    - Prépare un `<div class="container">` avec un `<div class="row">` à l’intérieur.
    - Chaque personnage sera affiché dans une colonne `<div class="col-md-4">` (ou autre selon la taille).

3. **Affichage des cartes pour chaque personnage**
    - À l’intérieur de la boucle `foreach`, affiche :
        - Une image du personnage (`image`)
        - Son nom (`name`)
        - Sa maison (`house`)
        - Sa date de naissance (`dateOfBirth`)
    - Ne crée une carte **que si l’image du personnage existe** (certaines sont vides).
    - Utilise la syntaxe `if () : ... endif;` pour les conditions.

4. **Style**
    - Utilise les classes Bootstrap `card`, `card-body`, `card-img-top`, `card-title`, `card-text`, etc.
    - Assure-toi que les cartes soient bien alignées et aient un peu d’espace entre elles (`mb-4` par exemple).

---

### 💡 Concepts mobilisés :
- Requête HTTP avec `file_get_contents()`
- Décodage JSON en PHP avec `json_decode()`
- Tableaux multidimensionnels
- Boucle `foreach`
- Conditions `if() : endif;`
- Génération de HTML avec PHP
- Intégration de Bootstrap pour la mise en page

---

### ✅ Résultat attendu :
Une page qui affiche une grille de cartes bien présentées, chacune contenant un personnage d’Harry Potter avec son image, son nom, sa maison et sa date de naissance.  
Seuls les personnages avec une **image disponible** doivent apparaître.


### Bonus
- Afficher l'image de la maison auquel le personnage appartient (dans la card au dessus du nom de la maison)
- Afficher en haut à droite de la card, une tête de mort si le personnage est mort
- Changer la bordure de la card en fonction du genre : 
    - Si male = bleu
    - Si female = rouge
    - Si non-renseigné = noir
    
- Ajouter tout en haut de votre page le nombre de personnage
- En vous basant sur le yearOfBirth si ça existe => mettez l'age du personnage à partir d'ajourdh'ui (ne fait pas le calcul avec 2026 en dur !, vous renseigner sur les dates en PHP)
