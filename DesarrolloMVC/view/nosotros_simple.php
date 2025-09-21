<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Estudiantes</title>
    <style>
        :root {
            --primary: #0d6efd;
            --danger: #dc3545;
            --warning: #f59f00;
            --success: #198754;
            --bg: #f7f8fa;
            --card: #ffffff;
            --text: #222;
            --muted: #6b7280;
            --border: #e5e7eb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .container {
            max-width: 1100px;
            margin: 24px auto;
            padding: 0 16px;
        }

        h1 {
            margin: 0 0 12px;
            font-size: 24px;
        }

        .sub {
            color: var(--muted);
            margin-bottom: 20px;
        }

        .toolbar {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-bottom: 16px;
        }

        .btn {
            appearance: none;
            border: 1px solid var(--border);
            background: #fff;
            color: #111;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn.primary {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .btn.danger {
            background: var(--danger);
            color: #fff;
            border-color: var(--danger);
        }

        .btn:disabled {
            opacity: .6;
            cursor: not-allowed;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
        }

        .card-header {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            font-weight: 700;
        }

        .card-body {
            padding: 12px 16px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border-bottom: 1px solid var(--border);
            padding: 10px 8px;
            text-align: left;
        }

        .table th {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: var(--muted);
        }

        .table tr:hover {
            background: #fafafa;
        }

        .row-actions {
            display: flex;
            gap: 6px;
        }

        .alert {
            padding: 10px 12px;
            border-radius: 10px;
            margin: 10px 0;
            border: 1px solid var(--border);
        }

        .alert.info {
            background: #eef2ff;
            border-color: #e0e7ff;
            color: #3730a3;
        }

        .alert.warn {
            background: #fff7ed;
            border-color: #ffedd5;
            color: #9a3412;
        }

        .alert.error {
            background: #fef2f2;
            border-color: #fecaca;
            color: #991b1b;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 999px;
            background: #e5e7eb;
            color: #111;
            font-size: 12px;
        }

        /* Modal nativo */
        .modal-native {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .modal-native.open {
            display: flex;
        }

        .modal-native__overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
        }

        .modal-native__dialog {
            position: relative;
            background: #fff;
            border-radius: 12px;
            width: min(820px, 95%);
            max-height: 90vh;
            overflow: auto;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
            animation: modal-in .14s ease-out;
        }

        .modal-native__header,
        .modal-native__footer {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
        }

        .modal-native__footer {
            border-top: 1px solid var(--border);
            border-bottom: 0;
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .modal-native__body {
            padding: 16px;
        }

        .modal-native__title {
            margin: 0;
            font-size: 18px;
        }

        .modal-native__close {
            position: absolute;
            top: 10px;
            right: 12px;
            border: 0;
            background: transparent;
            font-size: 22px;
            cursor: pointer;
        }

        @keyframes modal-in {
            from {
                opacity: 0;
                transform: translateY(8px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        /* Form */
        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .field label {
            font-size: 12px;
            color: var(--muted);
            font-weight: 600;
        }

        .field input,
        .field select {
            padding: 9px 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 14px;
        }

        .field small {
            color: #b91c1c;
        }

        .full {
            grid-column: 1 / -1;
        }
    </style>
</head>

<body>
    <?php $usuario_info = getUsuarioInfo();
    $es_admin = isAdmin(); ?>
    <div class="container">
        <h1>Gestión de Estudiantes</h1>

        <div class="toolbar">

            <button class="btn primary" data-modal-open="modalEstudiante">Agregar Estudiante</button>
            <!-- 
            <button class="btn" id="btnRefrescar">Actualizar Lista</button> -->
        </div>

        <div class="card">
            <div class="card-header">Lista de Estudiantes</div>
            <div class="card-body">
                <div id="tablaEstudiantes">
                    <div class="alert info">Cargando estudiantes...</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Agregar/Editar Estudiante -->
    <div id="modalEstudiante" class="modal-native" role="dialog" aria-hidden="true" aria-labelledby="modalEstudianteLabel">
        <div class="modal-native__overlay" data-modal-close></div>
        <div class="modal-native__dialog" role="document">
            <button class="modal-native__close" data-modal-close aria-label="Cerrar">&times;</button>
            <div class="modal-native__header">
                <h3 id="modalEstudianteLabel" class="modal-native__title">Agregar Estudiante</h3>
            </div>
            <div class="modal-native__body">
                <div id="msgEstudiante"></div>
                <form id="formEstudiante" novalidate>
                    <input type="hidden" id="estudianteId" name="id" />
                    <div class="grid">
                        <div class="field">
                            <label for="cedula">Cédula</label>
                            <input id="cedula" name="cedula" type="text" minlength="6" maxlength="20" required />
                        </div>
                        <div class="field">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" name="nombre" type="text" required />
                        </div>
                        <div class="field">
                            <label for="apellido">Apellido</label>
                            <input id="apellido" name="apellido" type="text" required />
                        </div>
                        <div class="field">
                            <label for="direccion">Dirección</label>
                            <input id="direccion" name="direccion" type="text" />
                        </div>
                        <div class="field">
                            <label for="telefono">Teléfono</label>
                            <input id="telefono" name="telefono" type="text" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-native__footer">
                <button class="btn" data-modal-close>Cancelar</button>
                <button class="btn primary" id="btnGuardarEstudiante">Guardar</button>
            </div>
        </div>
    </div>

    <!-- Modal Confirmar Eliminar -->
    <div id="modalConfirmarEliminar" class="modal-native" role="dialog" aria-hidden="true" aria-labelledby="modalConfirmarEliminarLabel">
        <div class="modal-native__overlay" data-modal-close></div>
        <div class="modal-native__dialog" role="document">
            <button class="modal-native__close" data-modal-close aria-label="Cerrar">&times;</button>
            <div class="modal-native__header">
                <h3 id="modalConfirmarEliminarLabel" class="modal-native__title">Confirmar eliminación</h3>
            </div>
            <div class="modal-native__body">
                <div id="estudianteAEliminar" class="alert warn">¿Eliminar este estudiante?</div>
            </div>
            <div class="modal-native__footer">
                <button class="btn" data-modal-close>Cancelar</button>
                <button class="btn danger" id="btnConfirmarEliminar">Eliminar</button>
            </div>
        </div>
    </div>

    <script>
        // Estado global básico
        const esAdmin = 'true';
        let eliminarId = null;

        // Utilidades Modal nativo
        (function() {
            function openModal(id) {
                const m = document.getElementById(id);
                if (!m) return;
                m.classList.add('open');
                m.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                m._esc = (e) => {
                    if (e.key === 'Escape') {
                        closeModal(id);
                    }
                };
                document.addEventListener('keydown', m._esc);
            }

            function closeModal(id) {
                const m = document.getElementById(id);
                if (!m) return;
                m.classList.remove('open');
                m.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
                if (m._esc) {
                    document.removeEventListener('keydown', m._esc);
                }
            }
            document.addEventListener('click', (e) => {
                const o = e.target.closest('[data-modal-open]');
                if (o) {
                    openModal(o.getAttribute('data-modal-open'));
                }
                const c = e.target.closest('[data-modal-close]');
                if (c) {
                    const m = c.closest('.modal-native');
                    if (m) closeModal(m.id);
                }
            });
            window.openModal = openModal;
            window.closeModal = closeModal;
        })();

        // Cargar estudiantes usando la API local (Api.php)
        async function cargarEstudiantes() {
            const cont = document.getElementById('tablaEstudiantes');
            cont.innerHTML = '<div class="alert info">Cargando estudiantes...</div>';
            try {
                const res = await fetch('http://localhost/Servicios/practicaApiPHP/api.php', {
                    method: 'GET'
                });
                const ests = await res.json();
                if (!Array.isArray(ests) || ests.length === 0) {
                    cont.innerHTML = '<div class="alert">No hay estudiantes registrados.</div>';
                    return;
                }
                let html = '';
                html += '<div class="table-responsive">';
                html += '<table class="table">';
                html += '<thead><tr>' +
                    '<th>#</th><th>Cédula</th><th>Nombres</th><th>Apellidos</th><th>Dirección</th><th>Teléfono</th>' + (esAdmin ? '<th>Acciones</th>' : '') +
                    '</tr></thead><tbody>';
                ests.forEach((e, i) => {
                    html += '<tr>' +
                        `<td>${i+1}</td>` +
                        `<td>${e.cedula||''}</td>` +
                        `<td>${e.nombre||''}</td>` +
                        `<td>${e.apellido||''}</td>` +
                        `<td>${e.direccion||''}</td>` +
                        `<td>${e.telefono||''}</td>` +
                        (esAdmin ? `<td><div class="row-actions">
                        <button class="btn" onclick="editarEstudiante('${encodeURIComponent(e.cedula)}','${(e.nombre||'').replace(/\\/g,'\\\\').replace(/'/g,"\\'")}','${(e.apellido||'').replace(/\\/g,'\\\\').replace(/'/g,"\\'")}','${(e.direccion||'').replace(/\\/g,'\\\\').replace(/'/g,"\\'")}','${(e.telefono||'').replace(/\\/g,'\\\\').replace(/'/g,"\\'")}')">Editar</button>
                        <button class="btn danger" onclick="confirmarEliminar('${encodeURIComponent(e.cedula)}', '${(e.nombre||'').replace(/\\/g,'\\\\').replace(/'/g,"\\'")} ${(e.apellido||'').replace(/\\/g,'\\\\').replace(/'/g,"\\'")}')">Eliminar</button>
                    </div></td>` : '') +
                        '</tr>';
                });
                html += '</tbody></table></div>';
                cont.innerHTML = html;
            } catch (err) {
                cont.innerHTML = `<div class="alert error">Error: ${err.message}</div>`;
            }
        }

        // Abrir modal para agregar
        function resetFormulario() {
            document.getElementById('formEstudiante').reset();
            document.getElementById('estudianteId').value = '';
            document.getElementById('cedula').removeAttribute('readonly');
            document.getElementById('modalEstudianteLabel').textContent = 'Agregar Estudiante';
            document.getElementById('msgEstudiante').innerHTML = '';
        }

        function mostrarFormularioEstudiante() {
            if (!esAdmin) {
                alert('Solo administradores pueden agregar estudiantes.');
                return;
            }
            resetFormulario();
            openModal('modalEstudiante');
        }

        // Asignar al botón de la toolbar
        document.addEventListener('click', (e) => {
            const btn = e.target.closest('[data-modal-open="modalEstudiante"]');
            if (btn) {
                mostrarFormularioEstudiante();
            }
        });

        // Guardar/Editar estudiante usando Api.php
        async function guardarEstudiante() {
            if (!esAdmin) {
                alert('No autorizado');
                return;
            }
            const cedula = document.getElementById('cedula').value.trim();
            const nombre = document.getElementById('nombre').value.trim();
            const apellido = document.getElementById('apellido').value.trim();
            const direccion = document.getElementById('direccion').value.trim();
            const telefono = document.getElementById('telefono').value.trim();
            const id = document.getElementById('estudianteId').value;
            try {
                let res;
                if (id) {
                    // PUT via query string as CRUD expects
                    const params = `cedula=${encodeURIComponent(cedula)}&nombre=${encodeURIComponent(nombre)}&apellido=${encodeURIComponent(apellido)}&direccion=${encodeURIComponent(direccion)}&telefono=${encodeURIComponent(telefono)}`;
                    res = await fetch(`http://localhost/Servicios/practicaApiPHP/api.php?${params}`, {
                        method: 'PUT'
                    });
                } else {
                    const body = new URLSearchParams();
                    body.append('cedula', cedula);
                    body.append('nombre', nombre);
                    body.append('apellido', apellido);
                    body.append('direccion', direccion);
                    body.append('telefono', telefono);
                    res = await fetch('http://localhost/Servicios/practicaApiPHP/api.php', {
                        method: 'POST',
                        body
                    });
                }
                const data = await res.json();
                // CRUD devuelve generalmente un mensaje en JSON (por ejemplo "Insertado")
                document.getElementById('msgEstudiante').innerHTML = `<div class="alert">Operación completada</div>`;
                setTimeout(() => {
                    closeModal('modalEstudiante');
                    cargarEstudiantes();
                }, 600);
            } catch (err) {
                document.getElementById('msgEstudiante').innerHTML = `<div class="alert error">${err.message}</div>`;
            }
        }

        document.getElementById('btnGuardarEstudiante').addEventListener('click', (e) => {
            e.preventDefault();
            guardarEstudiante();
        });
        document.getElementById('btnRefrescar').addEventListener('click', cargarEstudiantes);

        // Editar
        async function editarEstudiante(cedula, nombre, apellido, direccion, telefono) {
            if (!esAdmin) {
                alert('No autorizado');
                return;
            }
            resetFormulario();
            document.getElementById('modalEstudianteLabel').textContent = 'Editar Estudiante';
            try {
                // Si se pasaron los datos desde la fila, úsalos directamente
                if (cedula && nombre !== undefined) {
                    const decCed = decodeURIComponent(cedula);
                    document.getElementById('estudianteId').value = decCed;
                    document.getElementById('cedula').value = decCed;
                    document.getElementById('cedula').setAttribute('readonly', 'readonly');
                    document.getElementById('nombre').value = nombre || '';
                    document.getElementById('apellido').value = apellido || '';
                    document.getElementById('direccion').value = direccion || '';
                    document.getElementById('telefono').value = telefono || '';
                    openModal('modalEstudiante');
                    return;
                }
                // Fallback: pedir lista y buscar (menos eficiente)
                const res = await fetch('http://localhost/Servicios/practicaApiPHP/api.php', {
                    method: 'GET'
                });
                const lista = await res.json();
                const e = (Array.isArray(lista) ? lista : []).find(x => x.cedula === decodeURIComponent(cedula));
                if (!e) throw new Error('Estudiante no encontrado');
                document.getElementById('estudianteId').value = e.cedula;
                document.getElementById('cedula').value = e.cedula;
                document.getElementById('cedula').setAttribute('readonly', 'readonly');
                document.getElementById('nombre').value = e.nombre || '';
                document.getElementById('apellido').value = e.apellido || '';
                document.getElementById('direccion').value = e.direccion || '';
                document.getElementById('telefono').value = e.telefono || '';
                openModal('modalEstudiante');
            } catch (err) {
                alert('Error: ' + err.message);
            }
        }
        window.editarEstudiante = editarEstudiante;

        // Eliminar
        function confirmarEliminar(id, nombre) {
            if (!esAdmin) {
                alert('No autorizado');
                return;
            }
            eliminarId = id;
            document.getElementById('estudianteAEliminar').textContent = `¿Eliminar a ${nombre}?`;
            openModal('modalConfirmarEliminar');
        }
        window.confirmarEliminar = confirmarEliminar;

        document.getElementById('btnConfirmarEliminar').addEventListener('click', async () => {
            if (!esAdmin) {
                return;
            }
            try {
                const res = await fetch(`http://localhost/Servicios/practicaApiPHP/api.php?cedula=${eliminarId}`, {
                    method: 'DELETE'
                });
                // CRUD devuelve json con mensaje, podemos ignorarlo y refrescar
                closeModal('modalConfirmarEliminar');
                cargarEstudiantes();
            } catch (err) {
                alert('Error: ' + err.message);
            }
        });

        // Utilidades


        // Inicial
        document.addEventListener('DOMContentLoaded', () => {
            cargarEstudiantes();

        });
    </script>
</body>

</html>