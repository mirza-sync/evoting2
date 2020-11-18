<script type="text/javascript">
var ctx = document.getElementById('myChart').getContext('2d');
var mylabel = [];
var mydata = [];
var votes = @json($votes);
// votes = votes[0];
console.log(votes);
votes.forEach(vote => {
    mylabel.push(vote.name);
    mydata.push(vote.count);
});
console.log(mylabel);
console.log(mydata);
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: [...mylabel],
        datasets: [{
            label: '# of Votes',
            data: [...mydata],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        title: {
            display: true,
            text: 'Votes Chart',
            fontSize: 20
        }
    }
});
</script>