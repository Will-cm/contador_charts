
var ctx = document.getElementById('myChart').getContext('2d');

var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: nombres, //['Lpaz', 'scz', 'cbba', 'Tarija', 'oruro', 'beni'],//departamento,
    datasets: [{
      label: "% Ventas",
      data: porcentaje_ventas, //[12, 19, 3, 5, 2, 3], //cantidad_pedidos,
      backgroundColor: [
        'rgba(201, 33, 58, 0.2)',
        'rgba(33, 153, 77, 0.2)',
        'rgba(5, 63, 199, 0.2)',
        'rgba(227, 223, 3, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(244, 247, 18, 0.2)',
        'rgba(5, 5, 5, 0.2)',
        'rgba(255, 0, 179, 0.2)',
        'rgba(0, 255, 8, 0.2)'
      ],
      borderColor: [
        'rgba(201, 33, 58, 1)',
        'rgba(33, 153, 77, 1)',
        'rgba(5, 63, 199, 1)',
        'rgba(227, 223, 3, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(5, 5, 5, 1)',
        'rgba(255, 0, 179, 1)',
        'rgba(0, 255, 8, 1)'
      ],
      borderWidth: 2
    }]
  }
});



/*
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    datasets: [{
      label: '# of Votes',
      data: [12, 19, 3, 5, 2, 3],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
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
    }
  }
});  */