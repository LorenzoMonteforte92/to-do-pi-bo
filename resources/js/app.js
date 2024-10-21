import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])


let mapElement = document.getElementById('map');
let routeName = mapElement.getAttribute('data-route');

  // Variabili per la mappa e il servizio di ricerca TomTom
  let map, marker, searchBox;
    
  // Chiave API di TomTom
  const apiKey = 'IVJ2d30z4OsD1BOoMEvX2TGYuMGgRaOG';

  function initMap() {
      // Imposta la mappa iniziale
      const pisa = [10.401886, 43.715928];
      map = tt.map({
          key: apiKey,
          container: 'map',
          center: pisa,
          zoom: 13
      });

      // Aggiunge i controlli di zoom alla mappa
      map.addControl(new tt.NavigationControl());

      // Marker per la posizione selezionata
    //   marker = new tt.Marker().setLngLat([12.496366, 41.902782]).addTo(map);

      // Servizio di ricerca di TomTom
      searchBox = new tt.services.SearchBox(tt.services, {
          minNumberOfCharacters: 3,
          searchOptions: {
              key: apiKey,
              language: 'it-IT'
          },
          autocompleteOptions: {
              key: apiKey
          }
      });

  }

  function initEditMap() {

    let userLongitude = Number(mapElement.getAttribute('data-longitude'))
    let userLatitude = Number(mapElement.getAttribute('data-latitude'))
    let userVenueLocation = [userLongitude, userLatitude];
    
    // Imposta la mappa iniziale
    map = tt.map({
        key: apiKey,
        container: 'map',
        center: userVenueLocation,
        zoom: 16
    });

    // Aggiunge i controlli di zoom alla mappa
    map.addControl(new tt.NavigationControl());

    //  Marker per la posizione selezionata
      marker = new tt.Marker().setLngLat(userVenueLocation).addTo(map);

      // Servizio di ricerca di TomTom
      searchBox = new tt.services.SearchBox(tt.services, {
        minNumberOfCharacters: 3,
        searchOptions: {
            key: apiKey,
            language: 'it-IT'
        },
        autocompleteOptions: {
            key: apiKey
        }
    });
}

  
  // Funzione per cercare l'indirizzo
  document.getElementById('address-search').addEventListener('click', function() {
    let address = document.getElementById('addressInput').value + ' Pisa'; //la stringa finale fa in modo che gli indirizzi vengano cercati solo su pisa
    console.log(address)

    // Chiamata API per la geocodifica
    fetch(`https://api.tomtom.com/search/2/geocode/${encodeURIComponent(address)}.json?key=IVJ2d30z4OsD1BOoMEvX2TGYuMGgRaOG`)
    .then(response => response.json())
    .then(data => {
        if (data.results.length > 0) {
            let position = data.results[0].position; // Latitudine e longitudine
            let lat = position.lat;
            let lon = position.lon;

            // Se c'è già un segnalino, rimuoverlo
            if (marker) {
                marker.remove();
            }

            // Aggiungere un nuovo segnalino sulla mappa
            marker = new tt.Marker().setLngLat([lon, lat]).addTo(map);

            // Spostare la mappa al nuovo segnalino
            map.flyTo({
                center: [lon, lat],
                zoom: 15
            });

            // Aggiornare i campi nascosti con le coordinate
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lon;
        } else {
            alert("Indirizzo non trovato.");
        }
    })
    .catch(error => {
        console.error('Errore nella geocodifica:', error);
    });
});



  // Inizializza la mappa quando il documento è pronto
  document.addEventListener("DOMContentLoaded", function () {
        
    //verifica il nome della rotta, in base a questo parametro fa partire la funzione necessaria
    if(routeName === 'admin.profile.edit'){

        initEditMap()
    } else {
        initMap()   
    }
  });
  
  