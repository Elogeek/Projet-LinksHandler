import('/node_modules/chart.js/dist/chart.js');

let ctx = document.querySelector('#myChart').getContext('2d');

let graphOne = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Rouge', 'Bleu', 'Vert', 'Orange', 'Violet', 'Grey'],
        datasets: [{
            label: 'Mes liens les plus aimés',
            data: [12, 19, 5, 4, 1, 5],
            backgroundColor: [
                'rgba(255,99,132,1)',
                'rgba(55,199,132,1)',
                'rgba(5,99,132,1)'
            ],
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Mes likes <i class="fas fa-thumbs-up"></i>',
                        padding: {
                            top: 10,
                            bottom: 30
                        }
                    }
                }

            }
        }]
    }
});
/**
 ctx = document.querySelector('#myChart').getContext('2d');
let graphTwo = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Rouge', 'Bleu', 'Vert', 'Orange', 'Violet', 'Grey'],
        datasets: [{

            label: "Liens favoris",
            data: [14, 3, 56, 13, 10, 22],
            backgroundColor: [
                'rgba(255,165,0)',
                'rgba(64,224,208)',
                'rgba(220, 198, 224, 1)'
            ]

        }],
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Mes liens favoris <i class="fas fa-star"></i>',
                    padding: {
                        top: 10,
                        bottom: 30
                    }
                }
            }

        }

    }
});
/*/