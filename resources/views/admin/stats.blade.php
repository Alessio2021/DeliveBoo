@extends('layouts.admin.app')

@section('content') 
   
<div class="container mt-5">
    <div class="row">
        <div class="col-12 text-center">
            <h2>Statistiche</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div>
                <canvas id="myChart">
                                          
                </canvas>
            </div>
        </div>
    </div>
</div>


<script>
    
    const labels = [
      'January',
      'February',
      'March',
      'April',
      'May',
      'June',
    ];
  
    const data = {
      labels: labels,
      datasets: [{
        label: 'My First dataset',
        backgroundColor: '#cc561e',
        borderColor: '#cc561e',
        data: [0, 10, 5, 2, 20, 30, 45],
      }]
    };
  
    const config = {
      type: 'line',
      data: data,
      options: {}
    };
  </script>
  <script>
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
  </script>
   
  
   
@endsection