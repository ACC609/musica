document.addEventListener('DOMContentLoaded', function() {
    const menuLinks = document.querySelectorAll('.menu li a');

    // Restaura o estado ativo do menu do localStorage
    const activeLink = localStorage.getItem('activeMenuLink');
    if (activeLink) {
        document.querySelector(activeLink).classList.add('active');
    }

    menuLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Remove a classe "ativo" de todos os links
            menuLinks.forEach(item => item.classList.remove('active'));

            // Adiciona a classe "ativo" ao link clicado
            this.classList.add('active');

            // Salva o estado ativo no localStorage
            localStorage.setItem('activeMenuLink', `#${this.id}`);
        });
    });
});
