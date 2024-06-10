Dernière modification le : 04/02/2024 par Jimmy VOLLAND

![](https://raw.githubusercontent.com/MyLaboAccess/MLA/Images/labo.png)

# PROJET LABO

**CDAN IPI**

Dossier de Conception : MyLaboAccess (MLA)

Groupe 3 : Volland Jimmy, Darribeau Clément, Piuzzi Florent 

## Table des matières
[Introduction](#introduction)

[Cahier des charges	](#cahierdescharges)

[Introduction du système MLA (MyLaboAccess)](#introduction)

[Cas d’utilisation pour le système ](#cas_utilisation)

[Activité de création d'une donnée](#activite_creation)

[Activité de modification d'une donnée (version administrateur/modérateur)](#activite_modification_admin)

[Activité de modification d'une donnée (version mise à jour disponibilité matériel)](#activite_modification_dispo)

[Activité de consultation d'une donnée (cas de la consultation du matériel et de sa disponibilité)](#activite_consultation)

[Activité de suppression d'une donnée](#activite_suppression)

[Modèle physique de données](#modele_physique)

[Axes d’améliorations et limitations ](#axe_amelioration)

## Introduction <a id="introduction"></a>
Ce dossier de conception est élaboré en réponse au cahier des charges fourni par le groupe des M2IL. Il a pour objectif de décrire la conception d’une application Web composée d’un frontend, un backend, un SGBDR, une BDD et un FS. Cette application est nommée pour le projet et tout au long de ce dossier : “MLA”.
Elle permettra de gérer le matériel présent dans le Labo de l’école IPI. Ce dossier de conception accompagnera le développement du début à la fin de ce projet et il sera donc amené à évoluer au cours de l’année.

## Cahier des charges<a id="cahierdescharges"></a>

L’application sera composée de différentes fonctionnalités qui sont essentielles à la gestion des équipements disponibles dans le Labo.

Chaque matériel présent dans le Labo aura un QR Code unique, permettant de l’identifier et de le scanner via un lecteur de QR code qui redirigera l’utilisateur vers l’application.

Elle permettra de :

-	Consulter la liste des différents équipements présents dans le 	Labo
-	Ajouter du nouveau matériel via l’application
-	Modifier les informations du matériel via l’application
-	Supprimer un des matériels présents dans le Labo
-	Lire un QR Code
-	Modifier la disponibilité d’un matériel présent dans le Labo
-	Gérer des droits des utilisateurs

Il y aura différents rôles attribuables aux comptes afin de définir qui peut effectuer les différentes actions :

- Un premier niveau (invité) qui aura uniquement le droit de consulter l’inventaire
- Un second niveau (utilisateur) qui aura le droit de modifier la disponibilité du matériel
- Un troisième niveau (modérateur) qui aura le droit d’ajouter, modifier ou supprimer du matériel
- Un dernier niveau (administrateur) qui aura tous les droits sur l’inventaire, ainsi que des accès de gestion du site, des rôles et niveaux d’accès.

Chaque rôle hérite logiquement des droits des niveaux inférieurs.

Hypothèse : 

On considère que la base de données a été créée à partir du MLD et fournie à partir des fichiers Excel effectués lors de l’inventaire. 
Pour les besoins de l’application nous avons considéré qu’il existait des comptes invités, utilisateurs, modérateurs et un ou des administrateurs. 



## Introduction au système MLA (MyLaboAccess)<a id="introduction"></a>


**MyLaboAccess (MLA) :**

C'est le système global. Il gère toutes les fonctionnalités nécessaires pour permettre aux utilisateurs, d’utiliser, d'administrer l’application de gestion des équipements du labo

**Ajouter, modifier ou supprimer du matériel :**

Les comptes « modérateur » peuvent ajouter, modifier ou supprimer un matériel présent dans la base de données au travers de MLA

**Modifier la disponibilité du matériel :**

Les comptes « utilisateur » peuvent emprunter du matériel 

**Consulter du matériel :**

Un « invité » peut consulter le matériel présent dans le labo

**Gérer les accès :**

Les comptes « Administrateur » peuvent en plus des droits précédemment décrits, ajouter, modifier ou supprimer des rôles, des comptes, des catégories, etc...

**SGBD :**

Système de gestion de base de données, il s’agit d’un système externe qui permet d’accéder à la base de données contenant le matériel présent dans le labo ainsi que la création des comptes utilisateurs. (ici les fonctions PHP Symfony permettant de faire des requêtes SQL sur la BDD.)



## Cas d’utilisation pour le système<a id="cas_utilisation"></a>

Diagramme de cas d’utilisation :

![](https://raw.githubusercontent.com/MyLaboAccess/MLA/main/Diagramme_Cas_Utilisation.png)

![](https://raw.githubusercontent.com/MyLaboAccess/MLA/Images/Sous_Diagramme_Cas_Utilisation.png)

Les diagrammes décrivent les cas d’utilisation du système et l’héritage des rôles des acteurs humains.

On identifie 4 cas d’utilisations distincts pour le système :
-	L'ajout, la modification ou la suppression de matériel par les rôles administrateurs et modérateurs. Par expérience on pourra faire l’équivalence avec des activité de type “Create”, “Update” et “Delete” des données matériels, de plus on peut par hypothèse supposer que d’autre type de données serons traitées de la même façon : les utilisateurs par exemple.
-	La modification de la disponibilité du matériel par les rôles Utilisateur et au-dessus, ici correspondra à une activité de type “Update” mais suivant un processus plus simple que l’activité de modification de donnée générale.
-	La consultation du matériel et de sa disponibilité par les rôles Invités et au-dessus, ici correspondra à une activité de type “Read”.
-	La gestion des accès par le rôle Administrateur uniquement, par défaut chaque rôle aura des accès prédéfinis pour celui-ci, il s’agira donc de la gestion des rôles des utilisateurs qui, telle que nous l’envisageons se passera dans un Back-Office. Elle sera donc équivalente à une activité de type “Update” telle que définie ci-dessus.

## Activité de création d'une donnée<a id="activite_creation"></a>

**Objectif :**

A travers un accès via un Back-Office les rôles «administrateur» et «modérateur» peuvent créer une multitude de données (telles qu’elles sont définies dans le dictionnaire de données et le MPD)

**Acteurs concernés :**

-	Administrateur
-	Modérateur 

**Préconditions :** 

Le SGBDR est opérationnel et permet au travers du Back-Office la création de données dans la BDD

**Postcondition :** 

N/A

**Scenario nominal :** 

Les rôles «administrateur» et «modérateur» se connecte à MLA et au travers du Back-Office remplissent un formulaire qui sera envoyé afin de créer la donnée dans la BDD.

**Scenario alternatif :**

Les données saisies dans le formulaire sont incorrectes, un message d’erreur apparait et l’acteur doit corriger les erreurs de saisie pour que le formulaire soit accepté.

**Diagramme d’activité associé :**

![](https://raw.githubusercontent.com/MyLaboAccess/MLA/Images/DIAGRAMME_ACTIVITE_CREATE.png)

Le diagramme ci-dessus décrit le processus de création d’une donnée type dans le système, on remarque notamment la précision sur la vérification de la validité des informations saisies dans le formulaire avant la remontée en BDD au travers du SGBDR.

**Diagramme de flux associé :**

![](https://raw.githubusercontent.com/MyLaboAccess/MLA/Images/Diagramme_Flux_CREATION_DATA.png)

Ce diagramme représente le processus de création de la donnée mais cette fois d'un point de vue de la donnée, autrement dit on s’intéresse au chemin parcouru par celle-ci. Indispensable pour pouvoir quantifier les flux de données à venir dans les étapes suivantes du développement.

## Activité de modification d’une donnée (version administrateur/modérateur)<a id="activite_modification_admin"></a>

**Objectif :**

A travers un accès via un Back-Office les rôles administrateur et modérateur peuvent modifier une multitude de données (telles qu’elles sont définies dans le dictionnaire de données et le MPD)

**Acteurs concernés :**

-	Administrateur
-	Modérateur

**Précondition :** 

Le SGBDR est opérationnel et permet au travers du Back-Office la modification des données dans la BDD

**Postcondition :** 

N/A

**Scenario nominal :**

Les rôles «administrateur» et «modérateur» se connecte à MLA et au travers du Back-Office remplissent un formulaire qui sera envoyé afin de modifier la donnée dans la BDD.

**Scenario alternatif :**

Les données saisies dans le formulaire sont incorrectes, un message d’erreur apparait et l’acteur doit corriger les erreurs de saisie pour que le formulaire soit accepté.

**Diagramme d’activité associé :**

![](https://raw.githubusercontent.com/MyLaboAccess/MLA/Images/DIAGRAMME_ACTIVITE_UPDATE.png)

Le diagramme ci-dessus décrit le processus de modification d’une donnée type dans le système, on remarque notamment la précision sur la vérification de la validité des informations saisies dans le formulaire avant la remontée en BDD au travers du SGBDR.

**Diagramme de flux associé :**

![](https://raw.githubusercontent.com/MyLaboAccess/MLA/Images/DIAGRAMME_FLUX_MODIFICATION_DATA.drawio.png)

Ce diagramme représente le processus de modification de la donnée mais cette fois d'un point de vue de la donnée, autrement dit on s’intéresse au chemin parcourue par celle-ci.


## Activité de modification d'une donnée (version mise à jour disponibilité matériel<a id="activite_modification_dispo"></a>

**Objectif :**

En scannant un QR code associé à un matériel les utilisateurs viennent modifier la disponibilité du matériel au travers de MLA.

**Acteurs concernés :**

-	Administrateur
-	Modérateur
-	Utilisateur

**Préconditions :** 

Le SGBDR est opérationnel et permet au travers du Back-Office la modification des données dans la BDD
Le matériel à un QR code placé dessus et le QR code pointe bien sur la bonne référence matérielle en BDD.

**Postcondition :** 

N/A

**Scenario nominal :** 

L’utilisateur scanne le QR code ce qui entraine la modification de la disponibilité du matériel avec MLA de manière automatisée.

**Scenarios alternatifs :**

L’utilisateur n’est pas connecté ou son token de connexion est arrivé en fin de vie, MLA lui demandera alors de se reconnecter avant de poursuivre la modification de la disponibilité du matériel.
 
**Diagramme d’activité associé :**

![](https://raw.githubusercontent.com/MyLaboAccess/MLA/Images/DIAGRAMME_ACTIVITE_UPDATE_DISPONIBILITE.png)

Le diagramme ci-dessus décrit le processus de modification de la disponibilité du matériel dans système.

**Diagramme de flux associé :**

![](https://raw.githubusercontent.com/MyLaboAccess/MLA/Images/Diagramme_Flux_SYNCHRO_DATA.png)

Ce diagramme représente le processus de modification de la disponibilité du matériel. On aborde ici la notion de synchronisation.

## Activité de consultation d’une donnée (cas de la consultation du matériel et de sa disponibilité)<a id="activite_consultation"></a>

**Objectif :**

En accédant à la page d’accueil de MLA tous les utilisateurs ou invités peuvent consulter la disponibilité du matériel.

Acteurs concernés :

-	Administrateur
-	Modérateur
-	Utilisateur
-	Invité

**Précondition :** 

Le SGBDR est opérationnel et permet de remonter des informations de la BDD pour être utilisées par le back end et le front end.

**Postcondition :** 

N/A

**Scenario nominal :** 

L’utilisateur accède à la page d’accueil sur laquelle est présente la liste du matériel ainsi que sa disponibilité.

**Scenario alternatif :**

N/A

**Diagramme d’activité associé :**

![](https://raw.githubusercontent.com/MyLaboAccess/MLA/Images/DIAGRAMME_ACTIVITE_READ.png)

Le diagramme ci-dessus décrit le processus d'affichage de la disponibilité du matériel.

## Activité de suppression d’une donnée<a id="activite_suppression"></a>

**Objectif :**

A travers un accès via un Back-Office les rôles «administrateur» et «modérateur» peuvent supprimer une multitude de données (telles qu’elles sont définies dans le dictionnaire de données et le MPD)

**Acteurs concernés :**

-	Administrateur
-	Modérateur

**Précondition :** 

Le SGBDR est opérationnel et permet au travers du Back-Office la suppression des données dans la BDD

**Postcondition :**

N/A

**Scenario nominal :** 

Les rôles «administrateur» et «modérateur» se connectent à MLA et au travers du Back-Office choisissent la donnée à supprimer et confirme sa suppression.

**Scenario alternatif :**

L’administrateur ou le modérateur ne confirme pas la suppression de la donnée auquel cas le processus est interrompu.
 
**Diagramme d’activité associé :**

![](https://raw.githubusercontent.com/MyLaboAccess/MLA/Images/DIAGRAMME_ACTIVITE_DELETE.png)

Le diagramme ci-dessus décrit le processus de suppression de la donnée dans le système.

**Diagramme de flux associé :**

![](https://raw.githubusercontent.com/MyLaboAccess/MLA/Images/DIAGRAMME_FLUX_SUPPRESSION_DATA.drawio.png)

Ce diagramme représente le processus de suppression de la donnée. D’un point de vue donnée on la supprime de manière “douce” en BDD, ce qui nous permet d’en garder une trace.

## Modèle Physique de données<a id="modele_physique"></a>

![](https://raw.githubusercontent.com/MyLaboAccess/MLA/Images/Modele_Physique_donnees.PNG)

Ci-dessus le modèle physique de données réalisé à partir du dictionnaire de données (fichier Excel nommé :  Dictionnaire_données_V2.xlsx



## Axes d’améliorations et limitations<a id="axe_amelioration"></a>

En l’état nous n’avons pas travaillé sur la mise en place et l’utilisation de comptes Microsoft pour se connecter à l’application.
La mise en place de QR Code pour scanner le matériel pourrait générer auprès des utilisateurs qui utiliseraient ces QR Code sur leur téléphone des connexions vers des pages de destination non fiables et pourraient également les inviter à télécharger des logiciels malveillants qui pourraient voler leurs données privées.  Il faudra prendre en compte ces éléments en mettant en place des avertissements sur l’utilisation des QR Code. (Il faudra donc porter une attention particulière sur la solution de génération de QR Code utilisée).
Dans ce dossier nous sommes restés sur la description du Backend au niveau de l’application sans rentrer dans le détail ou l’utilisation du frontend (Mise en place de bouton pour interagir avec l’utilisateur). 
Certaines activités et fonctionnalités restent à définir, on pense notamment à la gestion et assignation des rôles, le système de Login ou encore la gestion de l’historique des emprunts (possible avec le MPD actuel).



