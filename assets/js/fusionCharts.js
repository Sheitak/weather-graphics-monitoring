// Include the core fusioncharts file from core
import FusionCharts from 'fusioncharts/core';

// Include the fusion theme
import FusionTheme from 'fusioncharts/themes/es/fusioncharts.theme.fusion';
import { ZoomLine } from "fusioncharts/zoomline";

// Add the chart and theme as dependency
// E.g. FusionCharts.addDep(ChartType)
FusionCharts.addDep(ZoomLine);
FusionCharts.addDep(FusionTheme);

// Graphique d'affichage des différentes courbes
let datasets = [];

for (let j = 0; j < labels.length; j++) {
    datasets.push({
        seriesName: labels[j],
        data: totalValues[j].join('|'),
    })
}

const dataSource = {
    chart: {
        caption: "Météo avec FusionChart.js",
        subcaption: "Exemple de récupération de metrics",
        yaxisname: "Mesures des différentes données récupérées",
        xaxisname: "Jours de la semaine",
        forceaxislimits: "1",
        pixelsperpoint: "0",
        pixelsperlabel: "30",
        compactdatamode: "1",
        dataseparator: "|",
        theme: "fusion"
    },
    categories: [
        {
            category:
                "lun.|mar.|mer.|jeu.|ven.|sam.|dim."
        }
    ],
    dataset: datasets,
    events: {
        beforeRender: function (evt, args) {
            function updateData() {
                dataSource.dataset.forEach(oneSeries => {
                    console.log(dataSource.dataset);
                    oneSeries.data = popAndAddRand(oneSeries.data)
                });
                dataSource.updateData();
                console.log(dataSource.updateData());
            }
            function popAndAddRand(array) {
                const firstElement = array.shift();
                array.push(firstElement);
                return array;
            }
            FusionCharts.ready(function() {
                new FusionCharts({
                    type: "zoomline",
                    renderAt: "chart-fusion",
                    width: "100%",
                    height: "100%",
                    dataFormat: "json",
                    dataSource
                }).render();
                setInterval(() => {
                    updateData();
                }, 1000)
            });
        }
    }
};

FusionCharts.ready(function() {
    new FusionCharts({
        type: "zoomline",
        renderAt: "chart-fusion",
        width: "100%",
        height: "100%",
        dataFormat: "json",
        dataSource
    }).render();
});
