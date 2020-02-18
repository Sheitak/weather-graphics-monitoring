import ApexCharts from 'apexcharts'

// Graphique d'affichage des différentes courbes.
let datasets = [];

for (let j = 0; j < labels.length; j++) {
    datasets.push({
        name: labels[j],
        data: totalValues[j],
    })
}

const options = {
    series: datasets,
    chart: {
        height: 350,
        type: 'line',
        zoom: {
            enabled: false
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'straight'
    },
    title: {
        text: 'Météo avec Apex.js',
        align: 'center'
    },
    grid: {
        row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
        },
    },
    xaxis: {
        categories: ['lun.', 'mar.', 'merc.', 'jeu.', 'vend.', 'sam.', 'dim.'],
        tickAmount: 'dataPoints',
        tickPlacement: 'between',
    }
};

const chart = new ApexCharts(document.querySelector("#chart-apex"), options);

// let updateGraph = await update();
//
// function update() {
//     return new Promise((resolve)=>{
//         setTimeout(()=>{resolve(
//             chart.updateSeries([{
//                 data: datasets
//             }])
//         )},5000)
//     },
// }

chart.render();
