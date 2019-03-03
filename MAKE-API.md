# Criação de api com laravel

Estou seguindo o seguinte tutorial  [api-laravel parte I](https://rafaell-lycan.com/2015/construindo-restful-api-laravel-parte-1/)


# Parte I
## criando os model

```sh
php artisan make:model Unidade
```

## Criando tabelas via migrations
- `php artisan` &rarr; CLI do laravel
- `make:migration` &rarr; Manipular banco de dados
- `create_unidades_table`  &rarr; nome do arquivo presente em `database/migrations`
```angular2html
php artisan make:migration create_unidades_table --crate=unidades
```
Obs: Apos criar as migrations pode execurar o migrate para criar a tabela
no bando de dados

(Dentro do container onde o laravel esta instalado)
```angular2html
php artisan migrate
```

## Criando seeder

É usado para criar teste de persistencia no DB

* Step 1
```angular2html
php artisan make:seeder UnidadesTableSeeder
```

depois de criar o Seed tem que rodar o dump-autoload do composer, vamos usar o docker para executar a parte do compose ja que o nosso php-fpm nao tem composer instalado

* Step 1.1

Obs: contexto da pasta para executar esse comando `pasta root do projeto`
```angular2html
docker run --rm -v $(pwd)/api:/app dump-autoload dump-autoload
```

- Step 03

Rodar o Seeder

```angular2html
php artisan db:seed
```

# PARTE II (Rotas)

[link](https://rafaell-lycan.com/2016/construindo-restful-api-laravel-parte-2/)

## Criando grupo de recursos

