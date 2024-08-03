document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const resultsContainer = document.getElementById('results-container');

    // Função de pesquisa
    function search() {
        const query = searchInput.value.trim();

        // Limpar resultados anteriores e mensagens
        resultsContainer.innerHTML = '';

        if (query.length === 0) {
            resultsContainer.innerHTML = '<p>Please enter a search query.</p>';
            return;
        }

        fetch(`search.php?query=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.length === 0) {
                    resultsContainer.innerHTML = '<p>No results found</p>';
                } else {
                    data.forEach(item => {
                        const resultItem = document.createElement('div');
                        resultItem.classList.add('card2');

                        const imageSrc = item.imagem
                            ? `data:image/jpeg;base64,${item.imagem}`
                            : 'default-music-image.jpg';

                        resultItem.innerHTML = `
                            <img src="${imageSrc}" alt="Image of ${item.titulo}" class="card-image">
                            <div class="card-content2">
                                <h3>${item.titulo}</h3>
                                <p><strong>Artista:</strong> ${item.artista}</p>
                                <p><strong>Ano:</strong> ${item.ano}</p>
                                <p><strong>Gênero:</strong> ${item.genero}</p>
                                <a href="${item.arquivo}" download class="download-button">Download</a>
                            </div>
                        `;

                        resultsContainer.appendChild(resultItem);
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                resultsContainer.innerHTML = '<p>There was an error fetching the search results. Please try again later.</p>';
            });
    }

    // Adicionar evento de input para limpar os resultados quando o input é limpo
    searchInput.addEventListener('input', function() {
        if (searchInput.value.trim().length === 0) {
            resultsContainer.innerHTML = '';
        }
    });

    // Adicionar evento de clique ao botão de pesquisa
    document.getElementById('search-button').addEventListener('click', search);
});


