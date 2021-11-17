let container = document.querySelector('.containerGraphics');

let ctx = document.querySelector('#myChart').getContext('2d');

if(container) {
    let $title = [];
    let $value = [];

    let $xhr = new XMLHttpRequest();
    $xhr.responseType = "json";
    $xhr.open("GET", "../assets/js/graphics.php");
    $xhr.onload = function() {
        let $response = $xhr.response;
        if($response.length !== 0) {
            $response.forEach(function($e) {
                $title.push($e['name']);
                $value.push($e['click']);
            })
        }
        graph($title, $value);
    }
    $xhr.send();

}

function graph($title,$value) {

    const statGraph = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: $title,
            datasets: [{
                label: 'Nombre de click',
                data: $value,
                backgroundColor: [
                    'rgba(255,99,132,1)',
                    'rgba(55,199,132,1)',
                    'rgba(5,99,132,1)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Mes liens que <i class="fas fa-thumbs-up"></i>',
                    padding: {
                        top: 10,
                        bottom: 30
                    }
                }
            }
        },

    })
}


