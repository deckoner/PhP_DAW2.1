Utilidades del proyecto
Este proyecto sirve como "portal" para gestionar tus mazos de digimon

En el inicio se tendra que logear o en us defecto registrarse en la aplicacion
una vex dentro tendras el menu, en el inicio veras una breve descrpcion de todas las
areas que puede acceder un usuario con el rol USUARIO,

estas son
coleccion: Aqui puedes ver todas las cartas actuales del TCG de digimon y tiene funciones de
filtrado por caracteristicas de la carta y por nombre, el filtrado por nombre es parcial y no absoluto

deck: Aqui puedes gestionar y crear tus decks, tambien tienes la opcion del mismo filtrado que en coleccion

decks de la comunidad: aqui podras ver todos los decks hechos por la comunidad.

logout: sirve para cerrar la sesion

Funciones interesantes
Si vas a http://localhost/DigiMonchosTCG/coleccion/carta/BT1-002 puedes cambiar el numero de la carta (BT1-002)
por cualquier otro numero, esto de tevolvera la carta si es que existe, esto funciona aunque no pase por la pestaña coleccion

Y luego a la hora de visualizar un deck puedes usar http://localhost/DigiMonchosTCG/decks/verDeck/9, aqui si sabes el
numero de id se visualizara ese deck, esto se hace asi para facilitar que se pueda compartir facilmente con un link

Tipos de usuarios en la aplicacion
En esencia existen dos tipos de usuario, administradores y usuarios, estos ultimos siendo el rol por defecto
el asministrador podra acceder a la zona de gestion.

Credenciales de acceso
servidor sql:
                usuario: root
                contraseña: 

administrador:
                usuario: DestoryGK
                contraseña: 123456

usuario normal
                usuario DestroyGK2
                contraseña: 123456