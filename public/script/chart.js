if ($("#north-america-chart").length) {
  var areaData = {
    labels: ["Sold", "Rented", "Vacant"],
    datasets: [{
        data: [],
        backgroundColor: [
           "#4B49AC","#FFC100", "#248AFD",
        ],
        borderColor: "rgba(0,0,0,0)"
      }
    ]
  };
  var areaOptions = {
    responsive: true,
    maintainAspectRatio: true,
    segmentShowStroke: false,
    cutoutPercentage: 78,
    elements: {
      arc: {
          borderWidth: 4
      }
    },      
    legend: {
      display: false
    },
    tooltips: {
      enabled: true
    },
    legendCallback: function(chart) { 
      var text = [];
      text.push('<div class="report-chart">');
        text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[0] + '"></div><p class="mb-0">Sold Properties</p></div>');
        text.push('<p class="mb-0">'+ chart.data.datasets[0].data[0] +'</p>');
        text.push('</div>');
        text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[1] + '"></div><p class="mb-0">Vacant Properties</p></div>');
        text.push('<p class="mb-0">'+ chart.data.datasets[0].data[1] +'</p>');
        text.push('</div>');
        text.push('<div class="d-flex justify-content-between mx-4 mx-xl-5 mt-3"><div class="d-flex align-items-center"><div class="mr-3" style="width:20px; height:20px; border-radius: 50%; background-color: ' + chart.data.datasets[0].backgroundColor[2] + '"></div><p class="mb-0"> Rented Properties</p></div>');
        text.push('<p class="mb-0">'+ chart.data.datasets[0].data[2] +'</p>');
        text.push('</div>');
      text.push('</div>');
      return text.join("");
    },
  }
  var northAmericaChartPlugins = {
    beforeDraw: function(chart) {
      var width = chart.chart.width,
          height = chart.chart.height,
          ctx = chart.chart.ctx;
  
      ctx.restore();
      var fontSize = 3.125;
      ctx.font = "500 " + fontSize + "em sans-serif";
      ctx.textBaseline = "middle";
      ctx.fillStyle = "#13381B";
  
      var text = chart.data.datasets[0].data[0] + chart.data.datasets[0].data[1] + chart.data.datasets[0].data[2],
          textX = Math.round((width - ctx.measureText(text).width) / 2),
          textY = height / 2;
  
      ctx.fillText(text, textX, textY);
      ctx.save();
    }
  }
  var northAmericaChartCanvas = $("#north-america-chart").get(0).getContext("2d");
  var northAmericaChart = new Chart(northAmericaChartCanvas, {
      type: 'doughnut',
      data: {
          labels: ["Sold", "Vacant", "Rented"],
          datasets: [{
              data: [],
              backgroundColor: [
                 "#4B49AC","#FFC100", "#248AFD",
              ],
              borderColor: "rgba(0,0,0,0)"
            }
          ]
      },
      options: areaOptions,
      plugins: northAmericaChartPlugins
    });
    document.getElementById('north-america-legend').innerHTML = northAmericaChart.generateLegend();
}


if ($("#sales-chart").length) {
  var SalesChartCanvas = $("#sales-chart").get(0).getContext("2d");

  var SalesChart = new Chart(SalesChartCanvas, {
    type: 'bar',
    data: {
      labels: ["Jan", "Feb", "Mar", "Apr", "May","Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
      datasets: [{
          label: 'Current Year',
          data: [],
          backgroundColor: '#98BDFF'
        },
        {
          label: 'Previous Year',
          data: [],
          backgroundColor: '#4B49AC'
        }
      ]
    },
    options: {
      cornerRadius: 5,
      responsive: true,
      maintainAspectRatio: true,
      layout: {
        padding: {
          left: 0,
          right: 0,
          top: 20,
          bottom: 0
        }
      },
      scales: {
        yAxes: [{
          display: true,
          gridLines: {
            display: true,
            drawBorder: false,
            color: "#F2F2F2"
          },
          ticks: {
            display: true,
            min: 0,
          //   max: 560,
            callback: function(value, index, values) {
              return  'P ' + value.toFixed(2) ;
            },
            autoSkip: true,
            maxTicksLimit: 10,
            fontColor:"#6C7383"
          }
        }],
        xAxes: [{
          stacked: false,
          ticks: {
            beginAtZero: true,
            fontColor: "#6C7383"
          },
          gridLines: {
            color: "rgba(0, 0, 0, 0)",
            display: false
          },
          barPercentage: 1
        }]
      },
      legend: {
        display: false
      },
      elements: {
        point: {
          radius: 0
        }
      }
    },
  });

 
  


}