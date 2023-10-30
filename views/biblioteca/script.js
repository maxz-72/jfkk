document.addEventListener('DOMContentLoaded', function(){
    let pdf_container = document.querySelector('.pdf-links');
    pdf_container.style.display = 'none';
    showPdfs()

    let searchInput = document.querySelector('.searchTerm');

    function showPdfs() {
        fetchPdfs('handlers/show_all_pdfs.php', 'GET');
    }

    searchInput.addEventListener('keyup', function () {
        if (searchInput.value) {
            const search = searchInput.value;
            fetchPdfs('handlers/show_pdf.php', 'POST', `search=${search}`);
        } else {
            showPdfs();
        }
    });

    function fetchPdfs(url, method, body = null) {
        const options = {
            method: method,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: body
        };
        fetch(url, options)
            .then(response => response.json())
            .then(response => {
                if (!response.error) {
                    const pdfs = response;
                    const template = pdfs.map(pdf => `
                        <div class="cards__container">
                            <a href="${pdf.ruta_pdf}">
                                <img src="../../images/pdf.png">
                                <h2 class="card__title">${pdf.name}</h2>
                            </a>
                            ${pdf.permissions ? ` <button class="btn-borrar" data-id="${pdf.id}">Borrar</button>
                                                    <button class="btn-editar" data-id="${pdf.id}">Editar</button>`: ''}
                        </div>`
                    ).join('');
                    pdf_container.style.display = 'block';
                    pdf_container.innerHTML = template;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-borrar')) {
            const id = e.target.getAttribute('data-id');
        
            fetch('handlers/delete_pdf.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${id}`
            })
            .then(response => response.text())
            .then(result => {
                showPdfs();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });

    let modal = document.getElementById('mainModal')
    const openModal = () => {
        modal.showModal();
    }
    const closeModal = () => {
        modal.close()
    }
    document.querySelector('.cerrar-modal').addEventListener('click', function () {
        closeModal();
    })
    document.addEventListener('click', function (e) {
        if(e.target.classList.contains('btn-editar')){
            const id = e.target.getAttribute('data-id');
            document.getElementById('id').value=id;
            openModal();
        }
    })
})