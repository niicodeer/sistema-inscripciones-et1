# Convenciones de trabajo, commits y las ramas.
* Ver en el tablero las tareas / issues disponibles. Asignarse la tarea que desea realizar y moverla a la tabla _"In Progress"_
* Antes de empezar, realizar el pull de la rama **_"develop"_** para tenerla actualizada.
* Crear una nueva rama a partir de **_"develop"_** con el nombre de:
    - **_feature/{numeroIssue}_**        //Por ejemplo: Si voy a realizar la tarea numero 3, el nombre de la rama será **_feature/3_**
    - **_bugfix/{numeroIssue}_**         //En caso de que la tarea implique una correción de algún bug
* Al momento de hacer commits, los mensajes deben empezar con el numero de la tarea, seguido de algun breve mensaje de lo que se hizo, por ejemplo:
  -     git commit -m "#3 - Creacion del modelo y migración de Estudiante".
  - Esto hará que el commit se vincule con la tarea del tablero para tener un mejor orden y seguimiento
    
* Realizar el **git push**
* Ir al repositorio y crear un **Pull Request** OJO, siempre comparando con la rama **_develop_** .
  
* Mover la tarea a la tabla de _"En Revision"_ . Una vez revisada y mergeada será movida a la tabla "_Done_"

<br/>

### Algunos comandos GIT que se van a usar:

1) Traer los cambios actualizados
  
       git pull

2) Crear una rama nueva
  
       git branch <nombre>

    y luego

	    git checkout <nombre>    //para moverse a esa rama

    o como atajo

	    git checkout -b <nombre>

3) Agregar los cambios (todos)

       git add .

    * agregar los cambios de un archivo especifico

            git add <nombre_archivo>

4) Confirmar los cambios (todos)
	
         git commit -m "<mensaje commit>" .

    * Confirmar los cambios de archivos especificos
        
            git commit -m "<mensaje commit>" ruta/carpeta/nombre_archivo.php

5) Realizar un push

        git push

<br/>
### Otros comandos que se pueden usar
* Renombrar una rama

        git branch -m <nombreViejo> <nombreNuevo>

* Eliminar una rama

        git branch -d <nombreRama>

* Reservar temporalmente los cambios sin commitear para no perderlos antes de hacer un pull o un cambio de rama

        git stash

- Luego de hacer el pull o cambiar de rama, aplico las modificaciones que tenia guardadas anteriormente

      - git stash apply    //(aplica los cambios y deja una copia en la reserva)
      - git stash pop    //(aplica los cambios sin dejar una copia en la reserva)

<br/>
<br/>
## Comandos PHP a utilizar:

* Crear modelo, migracion, controlador, seeder y factory con un solo comando:

      php artisan make:model <NombreModelo> -mcsf

* Realizar las migraciones a la base de datos

      php artisan migrate
  O si quiero deshacer la migracion

        php artisan migrate:rollback

* Para poblar la base de datos:
  
        php artisan db:seed

** O se puede hacer tanto la migracion como el seed con un solo comando:
        
        php artisan migrate --seed
