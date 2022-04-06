<template>
<div class="body">
    <!-- <component :is="component"/> -->
    <Header v-if="$route.name == 'home'"/>
    <HeaderMinimal v-else/>
    <router-view></router-view>
    <Footer/>
</div>
</template>

<script>
import Axios from "axios";

import HeaderMinimal from '../components/HeaderMinimal.vue';
import Header from '../components/Header.vue';
import Main from '../components/Main.vue';
import Footer from '../components/Footer.vue';


export default {
    name: "App",
    data() {
        return {
            token: '',
        }
    },
    components: {
        HeaderMinimal,
        Header,
        Main,
        Footer,
    },
created() {
    Axios.get(localHost + '/api/orders/generate')
        .then((results) =>{
            console.log(results.data.results.token);
            this.token = results.data.results.token;
            this.runBrainTree();
        }).catch( (error) => {console.log(error)});

    },
    methods: {
        runBrainTree() {
                const form = document.getElementById('payment-form');

                braintree.client.create({
  authorization: this.token,
}, function (err, clientInstance) {
  // Creation of any other components...

  braintree.dataCollector.create({
    client: clientInstance
  }, function (err, dataCollectorInstance) {
    if (err) {
      // Handle error in creation of data collector
      return;
    }
    // At this point, you should access the dataCollectorInstance.deviceData value and provide it
    // to your server, e.g. by injecting it into your form as a hidden input.
    var deviceData = dataCollectorInstance.deviceData;
  });
});

                braintree.dropin.create({
                authorization: this.token,
                data: JSON.parse(localStorage.getItem('key')),
                container: '#dropin-container'
                }, (error, dropinInstance) => {
                if (error) console.error(error);

                form.addEventListener('submit', event => {
                    event.preventDefault();

                    dropinInstance.requestPaymentMethod((error, payload) => {
                    if (error) console.error(error);

                    // Step four: when the user is ready to complete their
                    //   transaction, use the dropinInstance to get a payment
                    //   method nonce for the user's selected payment method, then add
                    //   it a the hidden field before submitting the complete form to
                    //   a server-side integration
                    document.getElementById('nonce').value = payload.nonce;
                    form.submit();
                    });
                });
                });;


//         var button = document.querySelector('#submit-button');

//   braintree.dropin.create({
//     // Insert your tokenization key here
//     authorization: this.token,
//     container: '#dropin-container'
//   }, function (createErr, instance) {
//     button.addEventListener('click', function () {
//       instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
//         // When the user clicks on the 'Submit payment' button this code will send the
//         // encrypted payment information in a variable called a payment method nonce
//         $.ajax({
//           type: 'POST',
//           url: '/checkout',
//           data: {'paymentMethodNonce': payload.nonce,
//                 'orderData': JSON.parse(localStorage.getItem('key')),
//                 }
//         }).done(function(result) {
//           // Tear down the Drop-in UI
//           instance.teardown(function (teardownErr) {
//             if (teardownErr) {
//               console.error('Could not tear down Drop-in UI!');
//             } else {
//               console.info('Drop-in UI has been torn down!');
//               // Remove the 'Submit payment' button
//               $('#submit-button').remove();
//             }
//           });

//           if (result.success) {
//             $('#checkout-message').html('<h1>Success</h1><p>Your Drop-in UI is working! Check your <a href="https://sandbox.braintreegateway.com/login">sandbox Control Panel</a> for your test transactions.</p><p>Refresh to try another transaction.</p>');
//           } else {
//             console.log(result);
//             $('#checkout-message').html('<h1>Error</h1><p>Check your console.</p>');
//           }
//         });
//       });
//     });
//   });
        }
    }
}
</script>

<style lang="scss">
@import '~@sass/_variables.scss';
@import '~bootstrap';

.body {
    background-color: rgba($color: $success, $alpha: 0.4);
}
</style>