document.addEventListener('DOMContentLoaded', function() {
    let notice_container = document.querySelector('.notice__container');
    notice_container.style.display = 'none';

    let searchInput = document.querySelector('.searchTerm');
    let xhr = new XMLHttpRequest();
    show_news()

    searchInput.addEventListener('keyup', function() {
        if(searchInput.value){
            let search = searchInput.value;

            xhr.open(
                'POST',
                'handlers/show_news.php',
                true
            );
            xhr.setRequestHeader(
                'Content-Type', 
                'application/x-www-form-urlencoded'
            );

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    let response = JSON.parse(xhr.responseText);
                    if (!response.error) {
                        let news = response;
                        let template = '';
                        news.forEach(new_s => {
                            template += `<div class="cards__container">
                                            <h2 class="card__title">${new_s.name}</h2>
                                            <p class="card__description">${new_s.description}</p>
                                            ${new_s.permissions ? ` <button class="btn-borrar" data-id="${new_s.id}">Borrar</button>
                                                                    <button class="btn-editar" data-id="${new_s.id}">Editar</button>` : ''}
                                        </div>
                                        `;
                        });
                        notice_container.style.display = 'block';
                        notice_container.innerHTML = template;                                                                    
                    }
                } 
            }
            xhr.send('search=' + search);  
        }else{
            show_news();
        }
    })

    function show_news(){
        xhr.open(
            'GET',
            'handlers/show_all_news.php',
            true
        )

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(xhr.responseText)
                let news = response;
                let template = '';

                news.forEach(new_s =>{
                    template += `<div class="cards__container">
                                    <h2 class="card__title">${new_s.name}</h2>
                                    <p class="card__description">${new_s.description}</p>
                                    ${new_s.permissions ? ` <button class="btn-borrar" data-id="${new_s.id}">Borrar</button>
                                                            <button class="btn-editar" data-id="${new_s.id}">Editar</button>` : ''}
                                </div>
                                `;
                })
                notice_container.style.display = 'block';
                notice_container.innerHTML = template;         
            }
        }
        xhr.send()
    }

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-borrar')) {
            const id = e.target.getAttribute('data-id');

            xhr.open('POST', 
                    'handlers/news_delete.php',
                    true
                    );
            xhr.setRequestHeader('Content-Type',
                                'application/x-www-form-urlencoded'
                                );

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log(xhr.responseText);
                    show_news();
                }
            };
            const data = new FormData();
            data.append('id', id);
            console.log(data.get('id'))
            xhr.send(data);
        }
    });
})