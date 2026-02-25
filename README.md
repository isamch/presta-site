# PrestaShop Project - Nutriweb

PrestaShop e-commerce site avec thème personnalisé et module de gestion des dates d'expiration.

## 📋 Table des matières

- [Prérequis](#prérequis)
- [Installation](#installation)
- [Accès](#accès)
- [Structure du projet](#structure-du-projet)
- [Commandes utiles](#commandes-utiles)
- [Fonctionnalités](#fonctionnalités)

---

## 🔧 Prérequis

- **Docker** (version 20.10+)
- **Docker Compose** (version 2.0+)
- **Git**
- **Ports disponibles:** 8080 (PrestaShop), 3306 (MySQL), 8081 (PHPMyAdmin)

### Vérifier l'installation:
```bash
docker --version
docker-compose --version
git --version
```

---

## 🚀 Installation

### 1. Cloner le projet
```bash
git clone https://github.com/isamch/presta-site.git
cd presta-site
```

### 2. Cloner le module (si pas déjà fait)
```bash
cd modules
git clone https://github.com/isamch/ps-module-expiry-date.git ps_expirydate
cd ..
```

### 3. Configurer l'environnement
```bash
# Copier le fichier d'exemple
cp .env.example .env

# Modifier si nécessaire (optionnel)
# nano .env
```

### 4. Démarrer Docker
```bash
docker-compose up -d
```

### 5. Attendre le démarrage (2-3 minutes)
```bash
# Vérifier les logs
docker-compose logs -f prestashop
```

### 6. Accéder au site
Ouvrir le navigateur: `http://localhost:8080`

---

## 🔐 Accès

### FrontOffice (Site public)
- **URL:** http://localhost:8080
- Accessible sans authentification

### BackOffice (Administration)
- **URL:** http://localhost:8080/admin511sphi5rtv6ismkpbu/
  *(Remplacer `admin511sphi5rtv6ismkpbu` par le nom réel du dossier admin)*
- **Email:** admin@prestashop.com
- **Mot de passe:** [Votre mot de passe configuré lors de l'installation]

### PHPMyAdmin (Base de données)
- **URL:** http://localhost:8081
- **Serveur:** mysql
- **Utilisateur:** prestashop
- **Mot de passe:** prestashop
- **Base de données:** prestashop

---

## 📁 Structure du projet

```
presta-site/
├── docker-compose.yml          # Configuration Docker
├── .env                        # Variables d'environnement
├── .env.example               # Exemple de configuration
├── README.md                  # Ce fichier
│
├── prestashop/                # Installation PrestaShop
│   ├── modules/              # Modules PrestaShop
│   ├── themes/               # Thèmes PrestaShop
│   │   ├── hummingbird/     # Thème parent
│   │   └── nutrihummingbird/ # Thème enfant personnalisé
│   └── ...
│
├── modules/                   # Modules personnalisés (hors PrestaShop)
│   └── ps_expirydate/        # Module date d'expiration
│       ├── ps_expirydate.php
│       ├── sql/
│       ├── views/
│       └── README.md
│
├── themes/                    # Thèmes personnalisés (hors PrestaShop)
│   └── nutrihummingbird/     # Source du thème enfant
│
└── docker/                    # Anciens fichiers Docker (deprecated)
```

---

## 🛠️ Commandes utiles

### Démarrer les conteneurs
```bash
docker-compose up -d
```

### Arrêter les conteneurs
```bash
docker-compose down
```

### Voir les logs
```bash
# Tous les services
docker-compose logs -f

# PrestaShop uniquement
docker-compose logs -f prestashop

# MySQL uniquement
docker-compose logs -f mysql
```

### Redémarrer les services
```bash
docker-compose restart
```

### Accéder au conteneur PrestaShop
```bash
docker exec -it prestashop_web bash
```

### Vider le cache PrestaShop
```bash
docker exec -it prestashop_web php bin/console cache:clear
```

### Sauvegarder la base de données
```bash
docker exec prestashop_mysql mysqldump -u prestashop -pprestashop prestashop > backup.sql
```

### Restaurer la base de données
```bash
docker exec -i prestashop_mysql mysql -u prestashop -pprestashop prestashop < backup.sql
```

### Arrêter et supprimer tout (⚠️ Attention: supprime les données)
```bash
docker-compose down -v
```

---

## ✨ Fonctionnalités

### 1. Thème personnalisé (Nutri Hummingbird)
- ✅ Thème enfant de Hummingbird
- ✅ Couleurs personnalisées (vert pour nutrition/sport)
- ✅ Bloc "Informations de livraison" sur les fiches produits
- ✅ Design responsive

**Activation:**
1. BackOffice → Design → Theme & Logo
2. Sélectionner "Nutri Hummingbird"
3. Cliquer "Use this theme"

### 2. Module Date d'expiration (ps_expirydate)
- ✅ Champ date d'expiration dans la fiche produit (BackOffice)
- ✅ Colonne date d'expiration dans la liste des produits (BackOffice)
- ✅ Affichage "Expire le : JJ/MM/AAAA" sur la fiche produit (FrontOffice)
- ✅ Date nullable (optionnelle)

**Installation:**
1. BackOffice → Modules → Module Manager
2. Rechercher "Product Expiry Date"
3. Cliquer "Install"

**Utilisation:**
1. Catalog → Products → Modifier un produit
2. Remplir le champ "Expiry Date"
3. Sauvegarder
4. La date apparaît dans la liste et sur le site

---

## 🐛 Dépannage

### Le site ne démarre pas
```bash
# Vérifier que les ports sont libres
netstat -ano | findstr :8080
netstat -ano | findstr :3306

# Vérifier les logs
docker-compose logs
```

### Erreur de permissions
```bash
# Donner les permissions (Linux/Mac)
chmod -R 777 prestashop/var
chmod -R 777 prestashop/cache

# Windows: Exécuter Docker Desktop en administrateur
```

### Le thème ne s'affiche pas
```bash
# Vider le cache
docker exec -it prestashop_web php bin/console cache:clear

# Ou via BackOffice
# Advanced Parameters → Performance → Clear cache
```

### Le module ne fonctionne pas
1. Désinstaller le module
2. Réinstaller le module
3. Vider le cache

---

## 📦 Repositories

- **Projet principal:** https://github.com/isamch/presta-site
- **Module expiry date:** https://github.com/isamch/ps-module-expiry-date

---

## 📝 Notes

- PrestaShop est déjà installé et configuré
- Les données sont persistées dans un volume Docker (`mysql_data`)
- Le thème et le module sont montés depuis les dossiers locaux
- Modifications en temps réel (pas besoin de rebuild)

---

## 🤝 Support

Pour toute question ou problème:
1. Vérifier les logs: `docker-compose logs`
2. Consulter la documentation PrestaShop: https://devdocs.prestashop-project.org/
3. Vérifier les issues GitHub

---

## 📄 Licence

Ce projet est développé pour Nutriweb.
