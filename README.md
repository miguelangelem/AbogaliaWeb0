# Diseño con CSS

Para el desarrollo visual de la página se utilizó CSS3, organizando los estilos por secciones para facilitar su lectura, mantenimiento y modificación.

### 1. Configuración y estilos base

Primero se establecieron estilos generales para el body, definiendo:

- Color de fondo oscuro.
- Color principal del texto.
- Tipografía.
- Interlineado.
- Configuración general de los enlaces.

### 2. Diseño del Header y menú de navegación

Se construyó un encabezado utilizando Flexbox, permitiendo distribuir el logotipo y el menú de navegación horizontalmente.

Se agregaron características como:

- position: sticky para mantener el menú visible al desplazarse.
- Fondo semitransparente.
- Efecto de desenfoque mediante backdrop-filter.
- Espaciado y alineación mediante Flexbox.
- Efectos hover en los enlaces.
- Botón de menú para dispositivos móviles.

### 3. Sección Hero o Banner principal

Para la sección principal se utilizó una imagen como fondo mediante background-image, acompañada de:

- background-size: cover.
- Centrado de la imagen.
- Un overlay oscuro semitransparente.
- Centrado del contenido mediante Flexbox.
- Título principal destacado con color dorado.
- Texto descriptivo y botón de llamada a la acción.

Esto permitió crear una primera sección visualmente atractiva y con buena legibilidad sobre la imagen de fondo.

### 4. Tarjetas de valores

La sección de valores se desarrolló utilizando CSS Grid, con:

> grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));

Esta configuración permite que las tarjetas se acomoden automáticamente dependiendo del espacio disponible. Las tarjetas incluyen:

- Fondo semitransparente.
- Bordes redondeados.
- Efecto de desenfoque.
- Bordes sutiles.
- Animación al pasar el cursor.
- Desplazamiento vertical mediante transform.

### 5. Diseño de botones

Se crearon dos estilos principales de botones:

> - .btn-primary: utilizado como botón principal.
- .btn-secondary: utilizado como botón secundario.

Ambos cuentan con transiciones y efectos hover, incluyendo cambios de color, escala y bordes para proporcionar retroalimentación visual al usuario.

### 6. Sistema de filtros

Para la sección de filtros se utilizó nuevamente CSS Grid, permitiendo organizar los diferentes controles de selección de manera flexible. Los elementos select fueron personalizados para mantener la misma identidad visual del sitio, utilizando:

- Fondos semitransparentes.
- Bordes redondeados.
- Colores oscuros.
- Espaciado interno.
- Estados focus.

### 7. Lista de abogados

La lista de abogados se estructuró mediante CSS Grid, permitiendo mostrar las tarjetas en diferentes columnas dependiendo del ancho disponible. Cada tarjeta contiene:

1. Imagen del abogado.
2. Nombre.
3. Información descriptiva.
4. Fondo semitransparente.
5. Bordes redondeados.
6. Efectos de transición.
7. Animación al pasar el cursor.

Las imágenes utilizan object-fit: cover para mantener una proporción visual uniforme.

### 8. Formularios

Se diseñaron formularios para diferentes funcionalidades del sitio, como:

1. Registro.
2. Inicio de sesión.
3. Solicitud de cotización.
4. Citas.
5. Comentarios.

Los campos input, textarea y select fueron agrupados para compartir estilos, manteniendo una interfaz consistente.

También se implementó un estado :focus para resaltar visualmente el campo que está siendo utilizado por el usuario.

### 9. Sección de blogs

La sección de blogs utiliza un diseño vertical mediante Flexbox. Cada enlace cuenta con:

- Fondo semitransparente.
- Bordes.
- Bordes redondeados.
- Transiciones.
- Cambio de color.
- Desplazamiento horizontal al pasar el cursor.

Esto proporciona una interacción sencilla para identificar los enlaces disponibles.

### 10. Footer

Finalmente se creó un footer con:

- Alineación centrada.
- Fondo oscuro.
- Borde superior.
- Espaciado interno.
- Tipografía de menor tamaño.
- Opacidad reducida para darle menor peso visual.

### 11. Diseño Responsive

Una de las partes principales del CSS fue la implementación de Responsive Design mediante @media queries. Se establecieron dos puntos de ruptura principales:

- 900px: adaptación para tablets y pantallas medianas.
- 480px: adaptación para teléfonos móviles.

En pantallas pequeñas se realizaron cambios como:

- Activación del botón del menú móvil.
- Ocultamiento del menú de navegación convencional.
- Reducción del tamaño de los títulos.
- Ajuste de los espacios laterales.
- Adaptación de los formularios.
- Botones con ancho completo en teléfonos.

### 12. Identidad visual

Como parte del diseño se utilizó una combinación de colores basada principalmente en:

- Fondo oscuro: para crear una apariencia profesional y elegante.
- Dorado (#d4af37): utilizado como color de acento y para destacar títulos, botones y elementos interactivos.
- Blanco y transparencias: para mantener el contraste y crear una estética moderna.

También se utilizaron transparencias, bordes sutiles, sombras visuales y backdrop-filter para conseguir un estilo similar al concepto de Glassmorphism.


# Desarrollo de funcionalidades con JavaScript

Para agregar interactividad y comportamiento dinámico a la página se utilizó JavaScript, mediante el archivo app.js.

### 1. Menú responsive para dispositivos móviles

Primero se implementó la funcionalidad del menú de navegación para dispositivos móviles. Se obtuvieron mediante getElementById() los elementos correspondientes al botón del menú y a la lista de enlaces:

> - const menuToggle = document.getElementById("menuToggle");
- const navLinks = document.getElementById("navLinks");

Después se agregó un evento click al botón mediante addEventListener(). Por lo que al hacer clic, se utiliza:

> navLinks.classList.toggle("show");

Esto permite agregar o eliminar la clase show, que previamente fue definida en CSS para mostrar u ocultar el menú. También se agregó una validación para comprobar que los elementos existan antes de agregar el evento, evitando errores si alguno de ellos no se encuentra en el documento.

### 2. Scroll suave entre secciones

Se implementó un sistema de navegación con scroll suave para los enlaces internos de la página. Para identificar estos enlaces se utilizó:

> document.querySelectorAll('a[href^="#"]')

De esta manera se seleccionan los enlaces cuyo atributo href comienza con #. Posteriormente, para evitar el comportamiento predeterminado del navegador, se agregó un evento click a cada enlace y se utilizó:

> e.preventDefault();

Después se obtiene el identificador de la sección y se localiza el elemento correspondiente mediante querySelector().

Y finalmente, para desplazar la página suavemente hasta la sección seleccionada, se utiliza:

targetSection.scrollIntoView({
  behavior: "smooth"
> targetSection.scrollIntoView({
  behavior: "smooth"
});});

Además, cuando el usuario selecciona una opción desde el menú móvil, este se cierra automáticamente eliminando la clase show.

### 3. Cambio dinámico del Header al hacer scroll

Se agregó un efecto dinámico al encabezado utilizando el evento scroll de window. Primero se obtiene el elemento:

> const header = document.querySelector(".header");const header = document.querySelector(".header");

Después se detecta la posición vertical del usuario mediante:

> window.scrollY

Cuando el usuario se desplaza más de 50 píxeles, se modifica dinámicamente el estilo del encabezado:

- Se cambia el fondo.
- Se agrega una sombra.
- Se aumenta visualmente el contraste con el contenido.

Cuando el usuario regresa a la parte superior de la página, estos estilos se eliminan o regresan a su estado original. Esto permite que el Header tenga una apariencia diferente mientras el usuario navega por el sitio.

### 4. Animaciones de aparición mediante Intersection Observer

Para mejorar la experiencia visual se implementó una animación de aparición utilizando la API Intersection Observer. Primero se seleccionaron diferentes elementos de la página:

> const fadeElements = document.querySelectorAll(
  ".lawyer-card, .value-card, .filter-box, .blog-links a"
);

Estos elementos inicialmente se configuran con:

> opacity = "0";
transform = "translateY(25px)";

Por lo tanto, comienzan invisibles y ligeramente desplazados hacia abajo.

Posteriormente se creó un IntersectionObserver para detectar cuándo los elementos entran en el área visible de la pantalla. Para esto se estableció un **threshold** de 0.2, lo que significa que la animación comienza cuando aproximadamente el 20% del elemento es visible. Cuando el elemento entra en pantalla, JavaScript modifica sus propiedades:

> entry.target.style.opacity = "1";
entry.target.style.transform = "translateY(0)";

Como resultado, las tarjetas y enlaces aparecen gradualmente mientras el usuario hace scroll.

### 5. Efecto adicional en los botones

Finalmente se agregó una interacción adicional a los botones principales y secundarios. Primero se seleccionaron mediante:

> document.querySelectorAll(".btn-primary, .btn-secondary");

Después se agregaron eventos mouseover y mouseout. Cuando el cursor pasa sobre un botón, se agrega una sombra:

> btn.style.boxShadow = "0px 10px 25px rgba(0,0,0,0.4)";

Cuando el cursor abandona el botón, la sombra se elimina.

Este efecto complementa las transiciones definidas previamente en CSS y proporciona una respuesta visual al usuario cuando interactúa con los botones.

# Página principal básica (index.php)

En este archivo, a diferencia de una página HTML estática, la información de los abogados se obtiene directamente desde MySQL mediante PHP y PDO, por lo que los registros mostrados pueden cambiar conforme se agregan nuevos abogados a la plataforma.

### 1. Conexión con la base de datos

El primer paso consiste en incluir el archivo encargado de establecer la conexión con la base de datos:

> require "php/db.php";

De esta manera se obtiene el objeto** $pdo**, que posteriormente se utiliza para realizar consultas mediante **PDO** (PHP Data Objects).

### 2. Consulta de abogados

Una vez establecida la conexión, se realiza una consulta SQL:

> $stmt = $pdo->query("SELECT * FROM abogados ORDER BY created_at DESC");

Esta consulta obtiene todos los registros de la tabla abogados.

Además, se utiliza:

> ORDER BY created_at DESC

para ordenar los resultados de manera descendente utilizando la fecha de creación del registro. De esta forma, los abogados registrados más recientemente aparecen primero.

### 3. Recuperación de los resultados

Los resultados de la consulta se convierten en un arreglo asociativo mediante:

> $abogados = $stmt->fetchAll(PDO::FETCH_ASSOC);$abogados = $stmt->fetchAll(PDO::FETCH_ASSOC);

Esto permite posteriormente recorrer los registros y utilizar sus diferentes campos dentro del HTML.

### 4. Estructura HTML

Después de realizar la consulta mediante PHP, se construye la interfaz utilizando HTML5.

La página se divide en diferentes secciones:

1. Header.
2. Menú de navegación.
3. Sección Hero.
4. Valores de la plataforma.
5. Lista de abogados.
6. Blogs y recursos legales.
7. Footer.

Esta estructura permite organizar la información de manera clara y facilitar la navegación del usuario.

### 5. Header y navegación

El encabezado contiene el logotipo de Abogalia y el menú principal. Entre las opciones disponibles se encuentran:

1. Inicio.
2. Abogados.
3. Registrarse como abogado.
4. Blogs.

También se incluye un botón de menú móvil:

> button class="menu-toggle" id="menuToggle"

Este elemento es utilizado posteriormente por app.js para controlar el menú responsive.

### 6. Sección Hero

La sección principal presenta la plataforma Abogalia y explica su objetivo: Facilitar el contacto entre usuarios y abogados confiables. Dentro de esta sección también se muestran cinco valores principales:

1. Confianza.
2. Justicia.
3. Experiencia.
4. Seguridad.
5. Rapidez.

Estos valores se presentan mediante tarjetas (value-card) que reciben su diseño desde style.css. Y finalmente, se incluye el botón:

> a href="#abogados" class="btn-primary">Ver Abogados

que permite desplazarse hacia la sección donde se encuentran los abogados.

### 7. Generación dinámica de abogados

Una de las principales funciones de este archivo es generar automáticamente las tarjetas de los abogados. Para ello se utiliza un ciclo foreach:

> <?php foreach($abogados as $abogado): ?>

Por cada registro obtenido de MySQL se genera una tarjeta con la información correspondiente. Esto significa que no es necesario crear manualmente una tarjeta HTML por cada abogado.

Después para mostrar la fotografía del abogado se utiliza una condición:

> $abogado['foto'] ? 'uploads/'.$abogado['foto'] : 'assets/default.jpg'$abogado['foto'] ? 'uploads/'.$abogado['foto'] : 'assets/default.jpg'

Si el registro contiene una fotografía, se utiliza la imagen almacenada en la carpeta uploads. Si no existe una fotografía, se utiliza:

> assets/default.jpg

Esto permite mantener una apariencia uniforme en las tarjetas.

### 9. Protección de datos mostrados

Para mostrar información proveniente de la base de datos se utiliza:

> htmlspecialchars()htmlspecialchars()

Por ejemplo:

> htmlspecialchars($abogado['nombre'])

Esta función convierte caracteres especiales en entidades **HTML** y ayuda a evitar que contenido no confiable almacenado en la base de datos sea interpretado directamente como código HTML.

### 10. Acceso al perfil del abogado

Cada tarjeta contiene un botón "Ver Perfil":

> href="views/abogado_profile.php?id=<?= $abogado['id'] ?>" class="btn-secondary">
    Ver Perfil

El ID del abogado se envía mediante la URL. Por ejemplo:

> abogado_profile.php?id=5abogado_profile.php?id=5

De esta manera, la página abogado_profile.php puede identificar qué registro debe consultar y mostrar el perfil correspondiente.

### 11. Sección de recursos legales

Se incorporó una sección de blogs y recursos legales con enlaces a sitios oficiales. Entre ellos:

- Suprema Corte de Justicia de la Nación.
- PROFECO.
- Constitución Política de los Estados Unidos Mexicanos.

Los enlaces utilizan:

> target="_blank"

para abrir los recursos en una nueva pestaña sin abandonar la plataforma.

### 12. Footer

Finalmente se incorpora un footer con información de derechos reservados:

> © 2026 Abogalia. Todos los derechos reservados.
