# Proyecto Final Desarrollo web integrado 2 : Diario Digital Somos Catamarca

- Bootstrap 5 
- estilos css personalizados
- FontAwesome
- Google Fonts
- PHP
- MySQL.


## Estructura del Proyecto

El proyecto se organiza de manera eficiente y está compuesto por las siguientes carpetas y archivos clave:


diario/
    admin/
        agregar_usuario.php: Nuevo usuario.
        form_login.php: Formulario de inicio de sesión.
        menu.php: Menú de navegación.
        publicaciones.php: Página para administrar las publicaciones de noticias.
        usuarios.php: Página para gestionar usuarios del sistema.
        editar_usuario.php: Permite editar la información de un usuario existente.
        index.php: Página principal del sistema administrativo.
        mis_publicaciones.php: Página que muestra todas las publicaciones de un autor.
        todas_publicaciones.php: Página que muestra todas las publicaciones en el sistema.

    backend/
        admin_mis_noticias.php: Permite gestionar sus propias noticias.
        admin_usuarios.php: Administración de usuarios, incluyendo la edición y eliminación.
        agregar_usuario.php: Agregar un nuevo usuario al sistema.
        borrar_usuario.php: Elimina un usuario existente.
        editar_noticia.php: Permite editar una noticia existente.
        login.php: Proceso de inicio de sesión.
        usuario_disponible.php: Utilizado para verificar la disponibilidad de nombres de usuario.
        admin_noticias.php: Administración completa de noticias, incluyendo listar, crear y eliminar.
        agregar_noticia.php: Permite agregar una nueva noticia.
        borrar_noticia.php: Elimina una noticia existente.
        conexion.php: Configuración de conexión a la base de datos.
        editar_usuario.php: Permite editar información de usuario.
        logout.php: Proceso de cierre de sesión.
        ver_noticia.php: Visualización de una noticia completa.

    estaticos/
        css/
            style.css: Archivo de estilo CSS para el diseño de la aplicación.
        js/
            scripts.js: Archivo JavaScript para funciones interactivas.

    imagenes/
        logos/: Carpeta que almacena los logotipos y gráficos.
        subidas/: Directorio para cargar imágenes y archivos.

    noticias/
        footer.php: Pie de página común para las noticias.
        form_agregar.php: Formulario para agregar una nueva noticia.
        form_editar.php: Formulario para editar una noticia existente.
        index.php: Página principal del portal de noticias.
        menu.php: Menú de navegación.
        noticia.php: Página individual de una noticia.
```


## Base de Datos

La aplicación utiliza una base de datos MySQL denominada `diario_web`, que consta de al menos dos tablas fundamentales:

1. **usuarios**: Almacena la información de los administradores del sistema, incluyendo campos como id_usuario, usuario, nombre, apellido, contraseña encriptada, roles (admin, autor).

2. **news**: Contiene la información sobre las noticias, con campos como id_noticia, título, fecha, autor (id_usuario), copete, cuerpo, imagen principal.

## Características Principales

El proyecto incluye las siguientes características destacadas:

- **URL Distintas**: El portal y el sistema administrativo tienen URLs separadas para un acceso diferenciado.

- **Administradores del Sistema**: Los administradores se almacenan en la base de datos y pueden realizar diversas acciones, como listar, dar de alta, eliminar, editar y resetear contraseñas.

- **Gestión de Noticias**: Permite la administración completa de noticias, incluyendo listar, crear, editar y eliminar.

- **Orden de Noticias**: Las noticias en el portal se presentan desde la más reciente hasta la más antigua.

- **Límite de Noticias**: En el portal, se muestran hasta un máximo de 10 noticias, con las más nuevas reemplazando automáticamente a las más antiguas si existen más de 10 noticias en la base de datos.

- **Página de Noticia Completa**: Permite ver una noticia completa en una página separada, respetando el diseño del portal de inicio. Incluye la visualización del autor de la noticia.

- **Contraseñas Encriptadas**: Las contraseñas de los administradores se almacenan en la base de datos de forma segura mediante encriptación.

## Innovación Creativa Libre: 
- Se implementó un sistema de inicio de sesión basado en roles, redirigiendo a los administradores a una página de administración de usuarios y a los autores a la página de "mis publicaciones", donde se muestran sus propias noticias. 
- Además, se añadieron filtros por categoría y autor en diferentes páginas y se incorporaron tablas interactivas para la gestión de noticias y usuarios. 
- Se utilizó tecnología Ajax para verificar la disponibilidad de nombres de usuario en tiempo real al crear nuevos usuarios.


