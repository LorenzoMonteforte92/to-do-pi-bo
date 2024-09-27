import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])



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
      marker = new tt.Marker().setLngLat([12.496366, 41.902782]).addTo(map);

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

    //   // Evento per cercare e selezionare un indirizzo
    //   const searchInput = document.getElementById('searchInput');
    //   searchInput.addEventListener('input', function() {
    //       searchBox.getSearchResults({
    //           query: searchInput.value,
    //           limit: 5
    //       }).then(response => {
    //           if (response.results.length > 0) {
    //               const place = response.results[0];
    //               const position = place.position;
                  
    //               // Centra la mappa e posiziona il marker
    //               map.flyTo({
    //                   center: [position.lon, position.lat],
    //                   zoom: 15
    //               });
    //               marker.setLngLat([position.lon, position.lat]);

    //               // Aggiorna i campi nascosti con latitudine e longitudine
    //               document.getElementById('latitude').value = position.lat;
    //               document.getElementById('longitude').value = position.lon;
    //           }
    //       });
    //   });
  }

  

  
  // Funzione per cercare l'indirizzo
  document.getElementById('address-search').addEventListener('click', function() {
    let address = document.getElementById('addressInput').value;

    // Chiamata API per la geocodifica
    fetch(`https://api.tomtom.com/search/2/geocode/${encodeURIComponent(address)}.json?key=IVJ2d30z4OsD1BOoMEvX2TGYuMGgRaOG`)
    .then(response => response.json())
    .then(data => {
        if (data.results.length > 0) {
            let position = data.results[0].position; // Latitudine e longitudine
            let lat = position.lat;
            let lon = position.lon;


        // mettere Pisa come città di default
        console.log(data.results)

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

 // Funzione per ottenere le coordinate al clic sulla mappa
    map.on('click', function (e) {
        let lat = e.lngLat.lat;
        let lon = e.lngLat.lng;

        // Se c'è già un segnalino, rimuoverlo
        if (marker) {
            marker.remove();
        }

        // Aggiungere un nuovo segnalino dove l'utente ha cliccato
        marker = new tt.Marker().setLngLat([lon, lat]).addTo(map);

        // Aggiornare i campi nascosti con le coordinate
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lon;

        // Centrare e zoommare sulla posizione del clic
        map.flyTo({
            center: [lon, lat],
            zoom: 15
        });
    });

  // Inizializza la mappa quando il documento è pronto
  document.addEventListener("DOMContentLoaded", function () {
      initMap();
  });
