document.addEventListener('DOMContentLoaded', function() {
    var streetAddressInput = document.getElementById('streetAddress');
    var addressValidation = document.getElementById('addressValidation');

    streetAddressInput.addEventListener('input', function() {
        var searchText = this.value.trim();

        if (searchText !== '') {
            var apiKey = '873861da3cea41369af53ffcbc9ac45e'; 
            var apiUrl = `https://api.geoapify.com/v1/geocode/autocomplete?text=${encodeURIComponent(searchText)}&apiKey=${apiKey}`;

            fetch(apiUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network Problem');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.features && data.features.length > 0) {
                        var suggestions = data.features.map(feature => feature.properties.formatted);
                        addressValidation.innerHTML = '';
                        suggestions.forEach(suggestion => {
                            var suggestionElement = document.createElement('button');
                            suggestionElement.textContent = suggestion;
                            suggestionElement.addEventListener('click', function() {
                                streetAddressInput.value = suggestion;
                                addressValidation.innerHTML = ''; 
                            });
                            addressValidation.appendChild(suggestionElement);
                        });
                    } else {
                        addressValidation.innerHTML = '<p>No suggestions found.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching autocomplete data:', error);
                    addressValidation.innerHTML = '<p>Error fetching suggestions.</p>';
                });
        } else {
            addressValidation.innerHTML = '';
        }
    });
});