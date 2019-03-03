# Laravel + Docker + Nginx

Antes de tudo tenho que agradece a esse serumaninho que fez
esse tesão de tutorial para mais duvidas veja esse passo-a-passo
em: ()[https://medium.com/@shakyShane/laravel-docker-part-1-setup-for-development-e3daaefaf3c]

## Laravel

### 1 - Clonar laravel do git

A versçao '5.6' é a mais atual hoje, mas verifique o repositorio
e teste para ver ser tudo ainda funciona :D

```sh
git clone -b 5.6 https://github.com/laravel/laravel.git app
```

### 2 - Instalar dependencias via docker run

Com esse metodo não precisa ter o compose instalado nem o php se pa

```
docker run --rm -v $(pwd)/api:/app composer install
```

### 3 - Build no projeto

```
docker-compose build
```

### 4 - Parti para  o abraço

```
docker-compose up
```

Se for a primeira vez que rodar o projeto tu vai precisar
roda isso aqui ó

```
docker exec -it app php artisan key:generate
```
