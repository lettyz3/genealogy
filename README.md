# Genealogy Project

## Description

Ce projet est une application de généalogie permettant de créer des fiches de personnes, d'ajouter des relations familiales et de calculer le degré de parenté entre deux personnes. Le système de gestion des données repose sur une base de données MySQL avec des migrations Laravel pour la gestion des tables. Ce projet permet également aux utilisateurs de proposer des modifications sur les informations des personnes ou les relations familiales, qui seront ensuite validées par la communauté.

## Objectifs

- Créer un système de gestion des personnes et de leurs relations familiales.
- Implémenter un système de validation de modifications communautaires.
- Calculer le degré de parenté entre deux personnes.
- Mettre en place un environnement de développement Laravel avec MySQL.

## Prérequis

- PHP 7.4 ou supérieur
- Laravel 8.x ou supérieur
- MySQL 5.7 ou supérieur
- Composer (pour la gestion des dépendances)
- Un compte GitHub pour héberger le code

## Installation

Téléchargez directement le dossier, et changez juste le nom de votre base de donnée dans le fichier .env

## Partie 3
 1. le lien pour le générateur de schéma dbdiagram.io: https://dbdiagram.io/d/678426986b7fa355c3a4111d
 2. Évolution des Données : Propositions de Modifications et Validation:
    A. Proposition de Modification :
Lorsqu'un utilisateur souhaite proposer une modification (par exemple, ajouter une relation ou modifier une personne), une proposition de modification est créée.
Cette proposition ne modifie pas immédiatement les données existantes dans la base. Elle est stockée dans une table dédiée des propositions avec les informations suivantes :
L'ID de la personne ou de la relation concernée.
Le type de modification proposée (ajout, mise à jour, suppression).
L'ID de l'utilisateur ayant proposé la modification.
L'état de la proposition (en attente, validée, rejetée).
    B.Validation des Modifications :
Les propositions de modification doivent être validées par la communauté avant d'être appliquées aux données principales.

Une proposition est soumise à la validation de plusieurs utilisateurs (au moins 3).
Chaque utilisateur peut accepter ou rejeter la proposition.
Lorsqu'un nombre suffisant de validations est atteint, la proposition devient validée et la modification est appliquée aux données existantes (par exemple, une relation est ajoutée ou les informations d'une personne sont mises à jour).
Si la proposition est rejetée, aucune modification n'est effectuée.
    C.Mise à Jour des Données :
Lorsque la proposition est validée, les données dans les tables principales (personnes, relations) sont mises à jour ou créées selon le type de modification :

Si la proposition était un ajout de relation, une nouvelle entrée est créée dans la table des relations.
Si c'était une mise à jour d'une personne (ex. changement de nom), l'enregistrement de cette personne dans la table des personnes est modifié.
Si c'était une suppression, l'entrée concernée est supprimée.
