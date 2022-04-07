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
 var myOrders = <?php echo json_encode($myOrder); ?>;
 console.log(myOrders);

  let arrayPrice = [];
  myOrders.forEach(element => {
        arrayPrice.push(element.total_amount);
    });
  
  
  let arrayDate = [];
  myOrders.forEach(element => {
        arrayDate.push(element.created_at.split('T')[0]);
    });
    console.log(arrayPrice);
    console.log(arrayDate);
    const labels = arrayDate
  
    const data = {
      labels: labels,
      datasets: [{
        label: 'My First dataset',
        backgroundColor: '#cc561e',
        borderColor: '#cc561e',
        data: arrayPrice,
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