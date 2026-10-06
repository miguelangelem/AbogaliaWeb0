<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro de Abogado | Abogalia</title>

    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<header class="header">

    <div class="logo-container">
        <img
            src="../assets/Logohorizontal.jpg"
            alt="Logo de Abogalia"
            class="logo"
        >
    </div>

</header>


<section class="section">

    <h2>Registro de Abogado</h2>

    <p>
        Completa tus datos para aparecer en la plataforma.
    </p>


    <form
        class="quote-form"
        action="../php/abogados_create.php"
        method="POST"
        enctype="multipart/form-data"
    >

        <div class="form-group">

            <label for="nombre">
                Nombre completo
            </label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                placeholder="Ej. María López Hernández"
                autocomplete="name"
                required
            >

        </div>


        <div class="form-group">

            <label for="especializacion">
                Especialización
            </label>

            <input
                type="text"
                id="especializacion"
                name="especializacion"
                placeholder="Ej. Derecho Familiar"
                required
            >

        </div>


        <div class="form-group">

            <label for="descripcion">
                Descripción profesional
            </label>

            <textarea
                id="descripcion"
                name="descripcion"
                placeholder="Describe brevemente tu experiencia y servicios."
                required
            ></textarea>

        </div>


        <div class="form-group">

            <label for="ciudad">
                Ciudad
            </label>

            <input
                type="text"
                id="ciudad"
                name="ciudad"
                placeholder="Ej. Aguascalientes"
                autocomplete="address-level2"
                required
            >

        </div>


        <div class="form-group">

            <label for="direccion">
                Dirección
            </label>

            <input
                type="text"
                id="direccion"
                name="direccion"
                placeholder="Dirección del despacho"
                autocomplete="street-address"
                required
            >

        </div>


        <div class="form-group">

            <label for="email">
                Correo electrónico
            </label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="correo@ejemplo.com"
                autocomplete="email"
                required
            >

        </div>


        <div class="form-group">

            <label for="telefono">
                Teléfono
            </label>

            <input
                type="tel"
                id="telefono"
                name="telefono"
                placeholder="4491234567"
                autocomplete="tel"
                required
            >

        </div>


        <div class="form-group">

            <label for="foto">
                Foto profesional
            </label>

            <input
                type="file"
                id="foto"
                name="foto"
                accept="image/jpeg,image/png,image/webp"
            >

        </div>


        <div>

            <button
                type="submit"
                class="btn-primary"
            >
                Registrarme
            </button>

            <a
                href="../index.php"
                class="btn-secondary"
            >
                Volver
            </a>

        </div>

    </form>

</section>

</body>
</html>