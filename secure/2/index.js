(function() {
    var widget, initAddressFinder = function() {
        widget = new AddressFinder.Widget(
            document.getElementById('addrs_1'),
            '98NJTAM4Y6DKRWB7E3CL',
           // 'ADDRESSFINDER_DEMO_KEY',//98NJTAM4Y6DKRWB7E3CL
            'AU', {
                "address_params": {
                  "gnaf" : "1",
                }
            }
        );

        widget.on('result:select', function(fullAddress, metaData) {
          
            // You will need to update these ids to match those in your form
            document.getElementById('addrs_1').value = metaData.address_line_1;
            document.getElementById('addrs_2').value = metaData.address_line_2;
            document.getElementById('suburb').value = metaData.locality_name;
            document.getElementById('state').value = metaData.state_territory;
            document.getElementById('postcode').value = metaData.postcode;

        });

    }

    function downloadAddressFinder() {
        var script = document.createElement('script');
        script.src = 'https://api.addressfinder.io/assets/v3/widget.js';
        script.async = true;
        script.onload = initAddressFinder;
        document.body.appendChild(script);
    };

    document.addEventListener('DOMContentLoaded', downloadAddressFinder);
      let addr_1 = document.getElementById('addrs_1')
})();