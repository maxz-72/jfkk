document.addEventListener('DOMContentLoaded', function() {
    let notice_container = document.querySelector('.notice__container');
    notice_container.style.display = 'none';

    let searchInput = document.querySelector('.searchTerm');
    show_news()

    searchInput.addEventListener('keyup', function () {
        if (searchInput.value) {
            const search = searchInput.value;
            fetchNews('handlers/show_news.php', 'POST', `search=${search}`);
        } else {
            show_news();
        }
    });

    function show_news() {
        fetchNews('handlers/show_all_news.php', 'GET');
    }

    function fetchNews(url, method, body = null) {
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
                    const news = response;
                    const template = news.map(new_s => `
                        <div class="cards__container">
                            <h2 class="card__title">${new_s.name}</h2>
                            <p class="card__description">${new_s.description}</p>
                            ${new_s.permissions ? ` <button class="btn-borrar" data-id="${new_s.id}">Borrar</button>
                                                    <a href="handlers/edit_news.php">
                                                        <button class="btn-editar" data-id="${new_s.id}">Editar</button>
                                                    </a>`  : ''}
                        </div>`
                    ).join('');

                    notice_container.style.display = 'block';
                    notice_container.innerHTML = template;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-borrar')) {
            const id = e.target.getAttribute('data-id');
    
            fetch('handlers/news_delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=${id}`
            })
            .then(response => response.text())
            .then(result => {
                show_news();
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
})  