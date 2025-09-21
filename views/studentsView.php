<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Estudiantes</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../views/assets/style.css">
</head>

<style>
    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        padding: 20px;
        background-color: #f4f7f6;
        color: #333;
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 0.2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }


    th,
    td {
        padding: 142px 15px;
        border: 1px solid #ddd;
        text-align: left;
        font-size: 14px;
        /* Tamaño de letra más grande */
    }

    th {
        font-size: 16px;
        /* Tamaño de letra más grande */
    }

    td {
        font-size: 14px;
    }

    thead tr {
        background-color: #4A5568;
        /* Un gris más oscuro */
        color: #333;
    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
        /* Filas alternas con color */
    }


    .modal-background {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-background.visible {
        display: flex;
        /* Lo hace visible */
        align-items: center;
        /* Lo centra VERTICALMENTE */
        justify-content: center;
        /* Lo centra HORIZONTALMENTE */
    }

    .modal-content {
        background-color: #fefefe;
        margin-top: 50vh;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 400px;
    }

    .btn-edit,
    .btn-delete,
    .btn-new,
    .btn-save,
    .btn-confirm,
    .btn-cancelar {
        border: none;
        padding: 8px 52px;
        border-radius: 0.2rem;
        color: white;
        cursor: pointer;
        transition: opacity 0.3s ease;
    }


    .btn-edit {
        background-color: #4A5568;
    }

    .btn-delete {
        background-color: #7D0303;
    }

    .btn-new {
        background-color: #4A5568;
        margin-bottom: 10px;
    }

    .btn-save {
        background-color: #7D0303;
    }

    .btn-confirm {
        background-color: #7D0303;
    }

    .btn-cancelar {
        background-color: #4A5568;
    }

    .btn-edit:hover,
    .btn-delete:hover,
    .btn-new:hover,
    .btn-save:hover,
    .btn-confirm:hover,
    .btn-cancelar:hover {
        opacity: 0.8;
    }

    .acciones-cell {
        text-align: center;
        width: 160px;
    }

    .acciones-cell button {
        margin: 0 4px;
    }

    .close-button {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }


    #studentForm label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
        /* Letras más gruesas para legibilidad */
        color: #4A5568;
    }

    #studentForm input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 13.5px;
        /* Tamaño de letra más grande */
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        /* Transición suave */
    }

    #studentForm input:focus {
        border-color: #4299E1;
        /* Borde azul al seleccionar */
        box-shadow: 0 0 0 1px rgba(66, 153, 225, 0.5);
        /* Sombra exterior azul */
        outline: none;
        /* Quitamos el borde por defecto del navegador */
    }

    #studentForm button {
        margin-top: 20px;
        padding: 12px 15px;
        box-sizing: border-box;
        width: 100%;
        cursor: pointer;
        margin-bottom: 10px;
        border: none;
        border-radius: 0.2rem;
    }

    #studentForm button:hover {
        background-color: #AF4040;
        /* Un gris un poco más claro */
    }

    .modal-actions {
        margin-top: 20px;
        /* Añade un espacio arriba */
        display: flex;
        /* ¡Activa el modo Flexbox! */
        justify-content: center;
        /* Centra los botones horizontalmente */
        gap: 15px;
        /* Crea un espacio de 15px entre los botones */
    }
</style>

<body>

    <div class="container">
        <h1>Gestion de Estudiantes</h1>
        <button id="btnNew" class="btn-new"> Insertar Nuevo Estudiante</button>
        <hr>
        <h2>Lista de Estudiantes</h2>
        <div class="table-container">
            <p>Cargando...</p>
        </div>
    </div>

    <div id="modal-form" class="modal-background">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2 id="modal-tittle"></h2>
            <form id="studentForm" class="student-form">
                <input type="hidden" id="form-action" value="insert">
                <label for="cedula">Cédula</label>
                <input type="text" id="cedula" name="cedula" required>
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" required>
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" required>
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" required>
                <button type="button" class="btn-save" id="saveBtn">Guardar Información</button>
            </form>
        </div>
    </div>

    <div id="modal-confirmation" class="modal-background">
        <div class="modal-content">
            <h3>Confirmar Eliminación</h3>
            <p>¿Está seguro de que desea eliminar este estudiante?</p>
            <div class="modal-actions">
                <button id="btnConfirmDelete" class="btn-confirm">Sí, Eliminar</button>
                <button id="btn-cancelar" class="btn-cancelar">Cancelar</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            const apiUrl = "http://localhost/Servicios/DeberMVC/PHPProyect/controllers/StudentController.php";

            function loadTable() {
                $.ajax({
                    url: apiUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        let tableHtml = '<table border="1" style="width: 100%; border-collapse: collapse;">';
                        tableHtml += `<thead>
                        <tr style="background-color: #f2f2f2;">
                        <th style="padding: 12px;"> Cedula</th>
                        <th style="padding: 12px;"> Nombre</th>
                        <th style="padding: 12px;"> Apellido</th>
                        <th style="padding: 12px;"> Direccion</th>
                        <th style="padding: 12px;"> Telefono</th>
                        <th style="padding: 12px;"> Acciones</th>
                        </tr>
                        </thead><tbody>`;
                        data.forEach(function(student) {
                            tableHtml += `<tr>
                            <td style="padding: 8px;">${student.cedula}</td>
                            <td style="padding: 8px;">${student.nombre}</td>
                            <td style="padding: 8px;">${student.apellido}</td>
                            <td style="padding: 8px;">${student.direccion}</td>
                            <td style="padding: 8px;">${student.telefono}</td>
                            <td style="padding: 8px;" class="acciones-cell">
                            <button class="btn-edit" style="padding: 7px;"
                            data-cedula="${student.cedula}" 
                            data-nombre="${student.nombre}" 
                            data-apellido="${student.apellido}" 
                            data-direccion="${student.direccion}" 
                            data-telefono="${student.telefono}"
                            >Editar</button>
                            <button class="btn-delete" style="padding: 7px;"
                            data-cedula="${student.cedula}">
                            Eliminar</button>
                            </td>
                            </tr>`;
                        });
                        tableHtml += '</tbody></table>';
                        $('.table-container').html(tableHtml);
                    },
                    error: function(error) {
                        console.error("Error al cargar datos: ", error);
                        $('.table-container').html('<p>Ocurrio un error al cargar los datos.</p>');
                    }
                });
            }
            $('#btnNew').on('click', function() {
                $('#studentForm')[0].reset();
                $('#modal-tittle').text('Nuevo Estudiante');
                $('#cedula').prop('readonly', false);
                $('#form-action').val('insert');
                $('#modal-form').addClass('visible');
            });

            $('.close-button').on('click', function() {
                $('.modal-background').removeClass('visible');
            });

            $('#saveBtn').on('click', function() {
                const cedula = $('#cedula').val();
                const nombre = $('#nombre').val();
                const apellido = $('#apellido').val();

                if (cedula === '' || nombre === '' || apellido === '') {
                    alert('Por favor, complete los campos obligatorios: Cédula, Nombre y Apellido.');
                    return;
                }
                const action = $('#form-action').val();
                const studentsData = {
                    cedula: cedula,
                    nombre: nombre,
                    apellido: apellido,
                    direccion: $('#direccion').val(),
                    telefono: $('#telefono').val()
                };
                let ajaxType = (action === 'insert') ? 'POST' : 'PUT';
                $.ajax({
                    url: apiUrl,
                    type: ajaxType,
                    data: studentsData,
                    dataType: 'json',
                    success: function(response) {
                        $('#modal-form').removeClass('visible');
                        alert("Datos guardados exitosamente.");
                        loadTable();
                    },
                    error: function(error) {
                        console.error("Error al guardar el estudiante:", error);
                        alert("Ocurrió un error al guardar. Revise la consola.");
                    }
                });
            });

            $(document).on('click', '.btn-edit', function() {
                $('#modal-tittle').text('Actualizar Informacion');
                $('#cedula').val($(this).data('cedula')).prop('readonly', true);
                $('#nombre').val($(this).data('nombre'));
                $('#apellido').val($(this).data('apellido'));
                $('#direccion').val($(this).data('direccion'));
                $('#telefono').val($(this).data('telefono'));
                $('#form-action').val('update');
                $('#modal-form').addClass('visible');
            });

            let idCardForDelete;

            $(document).on('click', '.btn-delete', function() {
                $('#modal-tittle').text('Eliminar Estudiante');
                idCardForDelete = $(this).data('cedula');
                $('#modal-confirmation').addClass('visible');
            });

            $('#btnConfirmDelete').on('click', function() {
                $.ajax({
                    url: `${apiUrl}&cedula=${idCardForDelete}`,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(response) {
                        $('#modal-confirmation').removeClass('visible');
                        loadTable();
                    },
                    error: function(error) {
                        console.error("Error al eliminar un estudiante", error);
                        alert("Ocurrio un error al eliminar");
                    }

                });
            });

            $('#btn-cancelar').on('click', function() {
                $('#modal-confirmation').removeClass('visible');
            });
            loadTable();
        });
    </script>
</body>

</html>