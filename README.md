## Setup proyecto

### En la base del proyecto correr:
#### Comandos para Linux, para Windows buscar la equivalencia
- **cp .env.example .env**
- **docker-compose up**
- **chown $USER:www-data -R storage**
- **chmod 775 -R storage**


### Acceder al contenedor web y correr:
- **composer install**
- **php artisan migrate**

## Testing Unit:
*Acceder al contenedor web y correr*
- **php artisan test**

## Rutas api

### Cargar Jugador
##### POST {{urlserver}}/api/jugador body: nombre(str), genero(F ó M), habilidad(int), dni(int unique)
- **genero F  => agregar reaccion(int)**
- **genero M => agregar velocidad(int) y fuerza(int)**

### Cargar Torneo
##### POST {{urlserver}}/api/torneo body: nombre(str), genero(F ó M), jugadores_ids(array<int>)


