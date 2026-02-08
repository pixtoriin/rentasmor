<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rutas de Transporte Cuernavaca</title>
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <style>
    html, body, #map {
      height: 100%;
      margin: 0;
      font-family: 'Arial', sans-serif;
    }
    #map {
      z-index: 1;
    }
    .panel {
      position: absolute;
      top: 10px;
      right: 10px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
      padding: 15px;
      z-index: 1000;
      max-width: 300px;
    }
    .panel h2 {
      margin: 0 0 10px;
      color: #3498db;
    }
    .panel button {
      background-color: #3498db;
      color: white;
      border: none;
      padding: 8px;
      border-radius: 8px;
      cursor: pointer;
      margin-top: 5px;
    }
    .panel button:hover {
      background-color: #2980b9;
    }
    .ruta-card {
      border-left: 5px solid;
      margin: 8px 0;
      padding-left: 10px;
      transition: background 0.3s ease;
    }
    .ruta-card:hover {
      background: #ecf0f1;
      cursor: pointer;
    }
    .leaflet-marker-icon, .leaflet-marker-shadow {
      transition: transform 0.3s ease;
    }
  </style>
</head>
<body>
  <div id="map"></div>
  <div class="panel">
    <h2>Rutas de Transporte Cuernavaca</h2>
    <div>
      <strong>Destino:</strong>
      <p id="destino-text">No seleccionado</p>
    </div>
    <button onclick="usarUbicacion()"><i class="fas fa-location-arrow"></i> Usar mi ubicación</button>
    <div id="rutas-disponibles"></div>
  </div>

  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <!-- Leaflet Routing Machine -->
  <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.min.js"></script>

  <script>
    const rutas = {
      "R13": {
        id: "R13",
        name: "Ruta 13",
        color: "#e74c3c",
        path: [
          [18.9780283, -99.2374341],
          [18.9817598, -99.2421387],
          [18.9654178, -99.2467885],
          [18.9675253, -99.2410936]
        ],
        stops: [
          { name: "Oficinas Ruta 13 Chamilpa", coords: [18.9780283, -99.2374341] },
          { name: "La Gringa", coords: [18.9817598, -99.2421387] },
          { name: "Glorieta", coords: [18.9654178, -99.2467885] },
          { name: "Paloma de la Paz", coords: [18.9675253, -99.2410936] }
        ],
        schedule: "5:00 - 22:00",
        frequency: "10-15 min"
      },
      "R1": {
        id: "R1",
        name: "Ruta 1",
        color: "#2ecc71",
        path: [
          [18.9747341, -99.2369996],
          [18.9817598, -99.2421387],
          [18.9654178, -99.2467885],
          [18.9497259, -99.2453571]
        ],
        stops: [
          { name: "Oficinas Ruta 1 Chamilpa", coords: [18.9747341, -99.2369996] },
          { name: "La Gringa", coords: [18.9817598, -99.2421387] },
          { name: "Glorieta", coords: [18.9654178, -99.2467885] },
          { name: "Glorieta Tlaltenango", coords: [18.9497259, -99.2453571] }
        ],
        schedule: "6:00 - 23:00",
        frequency: "8-12 min"
      }
    };

    let map = L.map('map').setView([18.92, -99.23], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    let destinoMarker, usuarioMarker;
    let rutasCercanas = [];
    let rutaControl = null;

    Object.values(rutas).forEach(ruta => {
      ruta.stops.forEach(stop => {
        L.marker(stop.coords).addTo(map)
          .bindPopup(`<strong>${stop.name}</strong><br>Ruta: ${ruta.name}<br>Horario: ${ruta.schedule}<br>Frecuencia: ${ruta.frequency}`);
      });
    });

    map.on('click', e => {
      if (destinoMarker) map.removeLayer(destinoMarker);
      destinoMarker = L.marker(e.latlng, { icon: L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41]
      })}).addTo(map);
      document.getElementById("destino-text").innerText = `Lat: ${e.latlng.lat.toFixed(5)}, Lng: ${e.latlng.lng.toFixed(5)}`;
      encontrarRutasCercanas(e.latlng);
    });

    function usarUbicacion() {
      navigator.geolocation.getCurrentPosition(pos => {
        let coords = [pos.coords.latitude, pos.coords.longitude];
        if (usuarioMarker) map.removeLayer(usuarioMarker);
        usuarioMarker = L.marker(coords, { icon: L.icon({
          iconUrl: 'https://cdn-icons-png.flaticon.com/512/149/149071.png',
          iconSize: [30, 30],
          iconAnchor: [15, 15]
        })}).addTo(map);
        map.setView(coords, 14);
      });
    }

    function distanciaMinimaAPolilinea(latlng, path) {
      let min = Infinity;
      for (let i = 0; i < path.length - 1; i++) {
        let p1 = L.latLng(path[i]);
        let p2 = L.latLng(path[i + 1]);
        let d = distanciaAPerpendicular(latlng, p1, p2);
        if (d < min) min = d;
      }
      return min;
    }

    function distanciaAPerpendicular(p, v, w) {
      const l2 = v.distanceTo(w) ** 2;
      if (l2 === 0) return p.distanceTo(v);
      let t = ((p.lat - v.lat) * (w.lat - v.lat) + (p.lng - v.lng) * (w.lng - v.lng)) / l2;
      t = Math.max(0, Math.min(1, t));
      const proj = L.latLng(v.lat + t * (w.lat - v.lat), v.lng + t * (w.lng - v.lng));
      return p.distanceTo(proj);
    }

    function encontrarRutasCercanas(destino) {
      rutasCercanas = [];
      Object.entries(rutas).forEach(([key, ruta]) => {
        const minDistRuta = distanciaMinimaAPolilinea(destino, ruta.path);
        if (minDistRuta <= 1000) {
          let paradaMasCercana = ruta.stops.reduce((min, stop) => {
            let dist = map.distance(destino, stop.coords);
            return dist < min.dist ? { stop, dist } : min;
          }, { dist: Infinity });
          rutasCercanas.push({ ...ruta, paradaCercana: paradaMasCercana, distRuta: minDistRuta });
        }
      });
      mostrarRutas();
    }

    function mostrarRutas() {
      const contenedor = document.getElementById("rutas-disponibles");
      contenedor.innerHTML = "";
      rutasCercanas.forEach(ruta => {
        const div = document.createElement("div");
        div.className = "ruta-card";
        div.style.borderColor = ruta.color;
        div.innerHTML = `<strong>${ruta.name}</strong><br>
                         Cerca de la ruta: ${(ruta.distRuta / 1000).toFixed(2)} km<br>
                         Parada más cercana: ${ruta.paradaCercana.stop.name}<br>
                         Distancia a parada: ${(ruta.paradaCercana.dist / 1000).toFixed(2)} km<br>
                         Horario: ${ruta.schedule}<br>
                         Frecuencia: ${ruta.frequency}`;
        div.onclick = () => trazarRuta(ruta);
        contenedor.appendChild(div);
      });
    }

    function trazarRuta(ruta) {
      if (rutaControl) map.removeControl(rutaControl);
      const waypoints = ruta.path.map(coord => L.latLng(coord));
      rutaControl = L.Routing.control({
        waypoints: waypoints,
        lineOptions: {
          styles: [{ color: ruta.color, weight: 6 }],
          addWaypoints: false
        },
        createMarker: () => null,
        fitSelectedRoutes: true
      }).addTo(map);
    }
  </script>
</body>
</html>
