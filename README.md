# SentinelSOC — sentinel-soc (challenge8)

| | |
|---|---|
| **Catégorie** | Web |
| **Difficulté** | Moyen |
| **Points** | 300 |
| **Topics** | SQL Injection → Enumeration & Brute Force → Session Management → RCE |
| **Port** | 8008 (`http://localhost:8008`) |
| **Flag** | `UNIALONE{...}` |

## Lancement

```bash
cd /home/omar/ctf/challenge8/sentinel-soc/ctf
docker compose up -d
```

## Scénario

**SentinelSOC** est la plateforme de veille sécurité interne de Carthage
Systems. Une sauvegarde chiffrée du SOC a été détruite par erreur ; le seul
exemplaire restant de la « clé d'exploitation » dort dans `/vault/flag.txt` sur
la plateforme, accessible uniquement via la console d'administration.

**Compte analyste de démonstration** : `analyst` / `analyst123`.
Une liste de mots de passe issue des précédents audits est servie publiquement :
`/static/wordlist.txt`.

Objectif : lire `/vault/flag.txt`.

## Format du flag

```
UNIALONE{...}
```

## Notes

- Le moteur de recherche d'alertes est « fait maison ».
- La console admin s'ouvre étrangement facilement — mais certains outils
  exigent une vraie session admin.
