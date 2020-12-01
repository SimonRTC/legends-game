# Legend's Game

> This repository is a [Dawan](http://www.dawan.fr/) training project.

![Dependencies](https://github.com/SimonRTC/legend-game/workflows/Dependencies/badge.svg)

---

## How to deploy databases with environment variables
> Minify your JSON to avoid breakage.
```json
{
    "default": {
        "host": "localhost",
        "port": "3306",
        "database": "legendgame",
        "username": "root",
        "password": null,
        "charset": "utf8"
    }
}

```

**Example variable**: 
"LG_DATABASES", "JSON::``{"default":{"host":"localhost","port":"3306","database":"legendgame","username":"root","password":null,"charset":"utf8"}}``"

---

## Deployment configuration
- [x] Dockerfile
- [x] PHP 7.4 (php.ini & fpm-pool)
- [x] Nginx (virtual host & routing)
- [ ] PHPUnit (tests)

---

### Contributing

You are more than welcome to contribute to this project by submitting a pull request and creating issues.

[![contributions Welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/SimonRTC/legends-game/issues)

&copy; Sibel Urbain, Axel Guihard, Simon Malpel
