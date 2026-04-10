# TicketSupportSystem - Système de Gestion de Tickets de Support

## Présentation du Projet

---

## 1. Introduction

Le **TicketSupportSystem** est une application web complète de gestion des tickets de support client, développée avec le framework **Laravel** (PHP). Ce système permet aux entreprises de gérer efficacement les demandes de support de leurs clients, depuis la création du ticket jusqu'à sa résolution finale.

### Objectifs du projet

- Centraliser toutes les demandes de support dans une plateforme unique
- Assigner les tickets aux agents de support appropriés
- Suivre le cycle de vie complet de chaque demande
- Maintenir une base de connaissances pour l'auto-assistance
- Mesurer la satisfaction des clients

---

## 2. Architecture Technique

### Stack technologique

| Composant | Technologie |
|-----------|-------------|
| Framework Backend | Laravel 10+ |
| Base de données | SQLite |
| Frontend | Blade Templates + Tailwind CSS |
| Build Tool | Vite |
| Serveur local | Artisan |

### Structure du projet

```
TicketSupportSystem/
├── app/
│   ├── Models/          # Modèles Eloquent (25+ entités)
│   ├── Http/Controllers # Contrôleurs API/Web (11 contrôleurs)
│   └── Http/Middleware/ # Middleware d'authentification
├── database/
│   ├── migrations/     # 35+ fichiers de migration
│   ├── seeders/        # Jeux de données initiaux
│   └── factories/      # Fabriques pour les tests
├── routes/             # Définitions des routes API/Web
└── resources/          # Vues et assets frontend
```

---

## 3. Entités et Modèles de Données

### 3.1 Entités Principales

#### **Ticket** (Ticket.php)
Le cœur du système. Chaque ticket représente une demande de support.

- **Champs** : numéro unique (auto-généré), sujet, description, priorité, statut, catégorie, agent assigné
- **Relations** : client, catégorie, agent, commentaires, historiques
- **Génération automatique** : Les numéros de ticket sont générés au format `TCK-XXXXXXXX` (8 caractères aléatoires)

#### **Client** (Client.php)
Représente les clients finaux qui soumettent des tickets.

- **Champs** : informations personnelles et coordonnées
- **Relation** : plusieurs tickets, adresses

#### **User (Utilisateur)** (User.php)
Les agents et administrateurs du système de support.

- **Champs** : nom, email, mot de passe, rôle
- **Relations** : tickets assignés, commentaires, notifications, journal d'activité

#### **CategorieTicket** (CategorieTicket.php)
Permet d'organiser les tickets par type de problème.

- **Exemples** : Technique, Facturation, Commercial, Réclamation

### 3.2 Entités de Support

#### **CommentaireTicket**
Permet les échanges entre clients, agents et autres parties prenantes sur un ticket.

#### **HistoriqueTicket**
Journal de toutes les modifications apportées à un ticket (changement de statut, priorité, assignation, etc.).

#### **SLA (Service Level Agreement)**
Gestion des accords de niveau de service avec engagement de temps de réponse.

#### **Satisfaction**
Enquêtes de satisfaction post-résolution pour mesurer la qualité du support.

#### **Escalade**
Mécanisme pour escalader un ticket vers un niveau de support supérieur ou un responsable.

### 3.3 Entités de Communication

#### **Notification**
Système de notifications pour alerter les utilisateurs des événements importants.

#### **CanalSupport**
Définition des canaux de support disponibles (Email, Chat, Téléphone, formulaire web).

#### **PieceJointe**
Gestion des fichiers joints aux tickets (captures d'écran, documents).

### 3.4 Base de Connaissances

#### **BaseConnaissance**
Articles d'aide et FAQ pour l'auto-assistance des clients.

- **Catégories** : organisation des articles par thème
- **Réponses prédéfinies** : modèles de réponses pour les agents

### 3.5 Gestion des Permissions

#### **Role**
Rôles utilisateurs (Admin, Agent, Client, Superviseur).

#### **Permission**
Permissions granulaires (créer ticket, voir tous les tickets, supprimer, etc.).

#### **Tables pivot**
- `role_utilisateur` : utilisateurs multi-rôles
- `permission_role` : permissions par rôle

### 3.6 Journalisation

#### **JournalActivite**
Trace de toutes les actions effectuées dans le système (création, modification, suppression).

#### **Parametre**
Configuration système et paramètres personnalisés.

---

## 4. Fonctionnalités Principales

### 4.1 Gestion des Tickets

- **Création** : Les clients peuvent soumettre des tickets via un formulaire
- **Numérotation automatique** : Génération d'un numéro unique TCK-XXXXXXXX
- **Catégorisation** : Attribution à une catégorie de ticket
- **Priorisation** : Définition du niveau de priorité (basse, moyenne, haute, critique)
- **Assignation** : Attribution à un agent de support
- **Statut** : Suivi de l'état (Ouvert, En cours, Résolu, Fermé, En attente)

### 4.2 Flux de Travail

1. **Soumission** : Le client crée un nouveau ticket
2. **Tri** : Le système ou un administrateur classe le ticket
3. **Assignation** : Un agent est assigné au ticket
4. **Traitement** : L'agent prend en charge le ticket
5. **Communication** : Échanges via les commentaires
6. **Résolution** : Le ticket est marqué comme résolu
7. **Satisfaction** : Enquête de satisfaction envoyée au client

### 4.3 Système de Commentaires

- Ajout de commentaires sur les tickets
- Support des fichiers joints
- Notifications lors de nouveaux commentaires

### 4.4 Escalade

- Possibilité de remonter un ticket à un niveau supérieur
- Transfert entre agents ou départements

### 4.5 Base de Connaissances

- Articles consultables par les clients
- Catégories d'articles
- Réponses prédéfinies pour les agents

### 4.6 Notifications

- Alertes lors de nouveaux tickets
- Mises à jour de statut
- Assignations de tickets
- Commentaires sur les tickets suivis

---

## 5. Contrôleurs et Points d'Accès

| Contrôleur | Fonctionnalité |
|------------|-----------------|
| **TicketController** | Gestion complète des tickets (CRUD, assignation, statut) |
| **ClientController** | Gestion des clients |
| **AuthController** | Authentification et connexion |
| **AdminController** | Tableau de bord administrateur |
| **CommentController** | Gestion des commentaires |
| **RoleController** | Gestion des rôles et permissions |
| **CategorieTicketController** | Gestion des catégories |
| **ComplaintController** | Gestion des réclamations |
| **ProfileController** | Gestion des profils utilisateurs |
| **ReponsePredefinieController** | Gestion des réponses prédéfinies |

---

## 6. Modèle de Base de Données

### Schéma relationnel simplifié

```
Utilisateur (1) ──────< Ticket (N)
       │                    │
       │                    ├─< CommentaireTicket (N)
       │                    ├─< HistoriqueTicket (N)
       │                    └─< PieceJointe (N)
       │
       └─────< Commentaire (N)
       │
       └─────< Notification (N)
       │
       └─────< JournalActivite (N)

Client (1) ──────< Ticket (N)
      │
      └─────< Adresse (N)
      └─────< Satisfaction (N)

Ticket (N) ───< CategorieTicket (1)
Ticket (N) ───< SLA (1)
Ticket (N) ───< Escalade (N)
```

---

## 7. Sécurité et Permissions

### Système de gestion des droits

- **Rôles prédéfinis** : Admin, Agent, Client, Superviseur
- **Permissions granulaires** : créer, lire, modifier, supprimer
- **Associations many-to-many** : un utilisateur peut avoir plusieurs rôles
- **Associations many-to-many** : un rôle peut avoir plusieurs permissions

### Middleware d'authentification

- Protection des routes par middleware Laravel
- Vérification du rôle pour les actions administratives

---

## 8. Cas d'Utilisation

### Pour le Client
1. Soumettre un nouveau ticket de support
2. Suivre l'avancement de ses tickets
3. Ajouter des commentaires
4. Consulter la base de connaissances
5. Donner une note de satisfaction

### Pour l'Agent
1. Consulter la liste des tickets assignés
2. Mettre à jour le statut et la priorité
3. Ajouter des commentaires et réponses
4. Escalader un ticket si nécessaire

### Pour l'Administrateur
1. Gérer les utilisateurs et leurs rôles
2. Configurer les catégories et priorités
3. Consulter les statistiques globales
4. Gérer les SLA
5. Créer/modifier la base de connaissances

---

## 9. Indicateurs de Performance (KPI)

Le système permet de suivre :

- Nombre de tickets créés / résolus
- Temps moyen de résolution
- Taux de satisfaction client
- Nombre d'escalades
- Tickets par catégorie / agent
- Respect des SLA

---

## 10. Conclusion

Le **TicketSupportSystem** est une solution complète et modulaire pour la gestion du support client. Grâce à son architecture Laravel robuste, son modèle de données riche et ses fonctionnalités complètes, il permet de :

- **Professionnaliser** le support client
- **Centraliser** toutes les demandes
- **Traçabiliser** les interactions
- **Mesurer** la qualité du service

Ce système est adaptable et extensible selon les besoins spécifiques de chaque organisation.