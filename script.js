document.addEventListener('DOMContentLoaded', () => {
    cargarNotas();
    document.getElementById('notaForm').addEventListener('submit', manejarSubmit);
});

async function cargarNotas() {
    try {
        const response = await fetch('api/notas.php');
        const notas = await response.json();
        const tbody = document.getElementById('notasBody');
        tbody.innerHTML = '';

        notas.forEach(nota => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${nota.id}</td>
                <td>${nota.nombre_alumno}</td>
                <td>${nota.materia}</td>
                <td>${nota.nota}</td>
                <td>
                    <button class="action-btn edit-btn" onclick="editarNota(${nota.id}, '${nota.nombre_alumno}', '${nota.materia}', ${nota.nota})">Editar</button>
                    <button class="action-btn delete-btn" onclick="eliminarNota(${nota.id})">Eliminar</button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    } catch (error) {
        console.error('Error al cargar las notas:', error);
        alert('Error al cargar las notas');
    }
}

async function manejarSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('notaId').value;
    const data = {
        nombre_alumno: document.getElementById('nombre').value,
        materia: document.getElementById('materia').value,
        nota: document.getElementById('nota').value
    };

    try {
        const url = 'api/notas.php';
        const method = id ? 'PUT' : 'POST';
        if (id) data.id = id;

        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();
        alert(result.message);
        limpiarFormulario();
        cargarNotas();
    } catch (error) {
        console.error('Error al guardar la nota:', error);
        alert('Error al guardar la nota');
    }
}

function editarNota(id, nombre, materia, nota) {
    document.getElementById('notaId').value = id;
    document.getElementById('nombre').value = nombre;
    document.getElementById('materia').value = materia;
    document.getElementById('nota').value = nota;
}

async function eliminarNota(id) {
    if (!confirm('¿Está seguro de eliminar esta nota?')) return;

    try {
        const response = await fetch(`api/notas.php?id=${id}`, {
            method: 'DELETE'
        });
        const result = await response.json();
        alert(result.message);
        cargarNotas();
    } catch (error) {
        console.error('Error al eliminar la nota:', error);
        alert('Error al eliminar la nota');
    }
}

function limpiarFormulario() {
    document.getElementById('notaForm').reset();
    document.getElementById('notaId').value = '';
} 