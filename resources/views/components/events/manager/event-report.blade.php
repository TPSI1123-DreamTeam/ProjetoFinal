<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />


<div class="event-wrapper">
    <div class="title-hidder-div">
        <h1>Relatório de Eventos</h1>
    </div>
</div>
<div class="linha-divisoria-event-manager"></div>

<div class="graphs">

    <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
    
        <div class="flex justify-between mb-3">
            <div class="flex justify-center items-center">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Eventos</h5>    

                <!-- Donut Chart -->
                <div class="py-6" id="donut-chart"></div>
                <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">    
                </div>
            </div> 
        </div>    
    </div>    
    <br>
    <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3">
            <dl>
                <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Lucros</dt>
                <dd class="leading-none text-3xl font-bold text-gray-900 dark:text-white">5.405,00€</dd>
            </dl>
            <div>
                <span class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
                    </svg>
                    Percentagem 23.5%
                </span>
            </div>
        </div>
        <div id="bar-chart"></div> 
    </div>
</div>

@php
    $eventsJson = json_encode($events);
@endphp


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>

// Array de dados dos eventos
const eventsData = <?php echo $eventsJson; ?>;
// Total de eventos
const totalEventos = eventsData.length;
// Contar os eventos por status
const eventStatusCounts = eventsData.reduce((acc, event) => {
    // Inicializar o contador do status se ainda não existir
    acc[event.event_status] = (acc[event.event_status] || 0) + 1;
    return acc;
}, {});
// Valores padrão caso algum status não esteja presente nos dados
const statusLabels = ["ativo", "recusado", "pendente", "cancelado", "concluido"];
const statusCounts = statusLabels.map(status => eventStatusCounts[status] || 0);

// Função para gerar as opções do gráfico
const getChartOptions = () => {
    return {
        series: statusCounts, // Use os valores dinâmicos
        colors: ["#1C64F2", "#16BDCA", "#FDBA8C", "#E74694", "#28A745"],
        chart: {
            height: 320,
            width: "100%",
            type: "donut",
        },
        stroke: {
            colors: ["transparent"],
            lineCap: "",
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: true,
                        name: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            offsetY: 20,
                        },
                        total: {
                            showAlways: true,
                            show: true,
                            label: "Eventos Associados",
                            fontFamily: "Inter, sans-serif",
                            formatter: function (w) {
                                return totalEventos; // Valor do centro
                            },
                        },
                        value: {
                            show: true,
                            fontFamily: "Inter, sans-serif",
                            offsetY: -20,
                            formatter: function (value) {
                                return value; // Valor de cada linha
                            },
                        },
                    },
                    size: "80%",
                },
            },
        },
        grid: {
            padding: {
                top: -2,
            },
        },
        labels: statusLabels, // Rótulos dinâmicos
        dataLabels: {
            enabled: false,
        },
        legend: {
            position: "bottom",
            fontFamily: "Inter, sans-serif",
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value;
                },
            },
        },
        xaxis: {
            labels: {
                formatter: function (value) {
                    return value;
                },
            },
            axisTicks: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
        },
    };
};

// Renderizar o gráfico
if (document.getElementById("donut-chart") && typeof ApexCharts !== 'undefined') {
    const chart = new ApexCharts(document.getElementById("donut-chart"), getChartOptions());
    chart.render();
}
</script>


<script>

const eventsDataFinance = <?php echo $eventsJson; ?>;

/// Função para mapear o nome do mês para o formato "YYYY-MM"
const getMonthYear = (dateStr) => {
    const date = new Date(dateStr);
    return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}`;
};

// Definir meses fixos
const fixedMonths = ["2024-08", "2024-09", "2024-10", "2024-11", "2024-12","2025-01"];

// Categorias de status
const group1Statuses = ["ativo", "recusado", "pendente", "concluido"];
const group2Statuses = ["cancelado"];

// Inicializar objeto com meses fixos
const monthlyAmounts = fixedMonths.reduce((acc, month) => {
    acc[month] = { group1: 0, group2: 0 };
    return acc;
}, {});

// Agrupar os valores dos eventos
eventsDataFinance.forEach(event => {
    const monthYear = getMonthYear(event.start_date);
    const amount = parseFloat(event.amount || 0);

    // Verificar se o mês é um dos meses fixos
    if (monthlyAmounts[monthYear]) {
        if (group1Statuses.includes(event.event_status)) {
            monthlyAmounts[monthYear].group1 += amount;
        } else if (group2Statuses.includes(event.event_status)) {
            monthlyAmounts[monthYear].group2 += amount;
        }
    }
});

// Transformar os resultados em arrays para o gráfico
const labels = fixedMonths; // Meses fixos como rótulos
const group1Data = labels.map(label => monthlyAmounts[label].group1);
const group2Data = labels.map(label => monthlyAmounts[label].group2);

console.log(group1Data)
console.log(group2Data)
console.log(monthlyAmounts)

const options = {
  series: [
    {
      name: "Receitas",
      color: "#31C48D",
      data: [group1Data[0], group1Data[1], group1Data[2], group1Data[3], group1Data[4], group1Data[5]],
    },
    {
      name: "Despesas",
      data: [group2Data[0], group2Data[1], group2Data[2], group2Data[3], group2Data[4], group2Data[5]],
      color: "#F05252",
    }
  ],
  chart: {
    sparkline: {
      enabled: false,
    },
    type: "bar",
    width: "100%",
    height: 400,
    toolbar: {
      show: false,
    }
  },
  fill: {
    opacity: 1,
  },
  plotOptions: {
    bar: {
      horizontal: true,
      columnWidth: "100%",
      borderRadiusApplication: "end",
      borderRadius: 6,
      dataLabels: {
        position: "top",
      },
    },
  },
  legend: {
    show: true,
    position: "bottom",
  },
  dataLabels: {
    enabled: false,
  },
  tooltip: {
    shared: true,
    intersect: false,
    formatter: function (value) {
      return "€" + value
    }
  },
  xaxis: {
    labels: {
      show: true,
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
      },
      formatter: function(value) {
        return "€" + value
      }
    },
    categories: [fixedMonths[0],fixedMonths[1],fixedMonths[2],fixedMonths[3],fixedMonths[4],fixedMonths[5]],//["Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    axisTicks: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
  },
  yaxis: {
    labels: {
      show: true,
      style: {
        fontFamily: "Inter, sans-serif",
        cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
      }
    }
  },
  grid: {
    show: true,
    strokeDashArray: 4,
    padding: {
      left: 2,
      right: 2,
      top: -20
    },
  },
  fill: {
    opacity: 1,
  }
}

if(document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {
  const chart = new ApexCharts(document.getElementById("bar-chart"), options);
  chart.render();
}

</script>



<!-- <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script> -->
@vite('resources/js/formListEvents.js')
