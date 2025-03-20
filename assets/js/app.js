$(document).ready(function() {
    // Inicialização de componentes
    $('[data-toggle="tooltip"]').tooltip();
    
    // Carregamento AJAX básico
    $('.ajax-load').on('click', function(e) {
        e.preventDefault();
        const page = $(this).data('page');
        $('#content').load(`views/${page}.php`);
    });
    
    // Inicialização de gráficos (exemplo com Chart.js)
    if(typeof Chart !== 'undefined') {
        const ctx = document.getElementById('progressChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai'],
                datasets: [{
                    label: 'Progresso do Paciente',
                    data: [12, 19, 3, 5, 2],
                    borderColor: '#2A5C82',
                    tension: 0.1
                }]
            }
        });
    }
});