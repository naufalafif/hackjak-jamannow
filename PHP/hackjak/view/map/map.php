<?php
  $data_titik = $app->getDataTitik();
?>

<div id="lokasi">
  <div id="map"></div>
</div>

<script>
  var titikKriminal = [<?php
      foreach($data_titik['data'] as $data){
          echo "[".$data['location']['longitude'].",".$data['location']['latitude']."],";
      }
      ?>];
  var kota = statesData['features'];

  for (var i = 0, len = kota.length; i < len; i++) {
      titikKota = kota[i]['geometry']['coordinates'][0];
      for (var j = 0, lenJ = titikKriminal.length; j < lenJ; j++) {
          if(checkTitik(titikKriminal[j], titikKota)){
              statesData['features'][i]['properties']['titik_kriminal'] = statesData['features'][i]['properties']['titik_kriminal'] + 1;
          }
      }  
  }
</script>

<script>
 var kriminal = L.layerGroup();
 var cctv_all = L.layerGroup();

  var cctvIcon = L.icon({
      iconUrl: 'assets/leaflet/images/cctv.png',
      iconSize:     [21, 32], // size of the shadow
  });

    // L.marker([-6.3142204, 106.710172],{icon: cctvIcon}).bindPopup('Jl. I Gusti Ngurah Rai Klender Jakarta Timur').addTo(cctv_all);
    for(x=0;x<cctv.length;x++)
       L.marker([cctv[x]['Longitude'], cctv[x]['Latitude']],{icon: cctvIcon}).bindPopup("CCTV - " + cctv[x]['nama_tempat']+ " - " + cctv[x]['Pemilik']).addTo(cctv_all);
   

  <?php
    foreach($data_titik['data'] as $data){
      echo "L.marker([".$data['location']['latitude'].", ".$data['location']['longitude']."]).bindPopup('".$data['lokasi']."').addTo(kriminal);";
    }
  ?>
  var mbAttr = 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
    '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
    'Imagery © <a href="http://mapbox.com">Mapbox</a>',
    mbUrl =
    'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

  var grayscale = L.tileLayer(mbUrl, {
      id: 'mapbox.light',
      attribution: mbAttr
    }),
    streets = L.tileLayer(mbUrl, {
      id: 'mapbox.streets',
      attribution: mbAttr
    });

  var map = L.map('map', {
    center: [-6.183310, 106.843572],
    zoom: 11,
    minZoom: 11,
    layers: [grayscale, kriminal, cctv_all]
  });

  

  var baseLayers = {
    "Peta Abu - Abu": grayscale,
    "Peta Lengkap": streets
  };

  var overlays = {
    "Titik Kriminal": kriminal,
    "CCTV" : cctv_all
  };

  var info = L.control();

  info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info');
    this.update();
    return this._div;
  };

  info.update = function (props) {
    this._div.innerHTML = '<div class="info-area"><h4>Titik Kriminal Jakarta</h4><p>' + (props ?
      '<b>' + props.nama_kota + '</b><br />' + props.titik_kriminal + ' titik </p></div>' :
      'Pilih Area');
  };

  info.addTo(map);

  function getColor(d) {
    return d > 50 ? '#800026' :
      d > 20 ? '#BD0026' :
      d > 5 ? '#FEB24C' :
      d > 3 ? '#FED976' :
      '#FFEDA0';
  }

  function style(feature) {
    return {
      weight: 2,
      opacity: 1,
      color: 'white',
      dashArray: '3',
      fillOpacity: 0.7,
      fillColor: getColor(feature.properties.titik_kriminal)
    };
  }

  function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
      weight: 5,
      color: '#666',
      dashArray: '',
      fillOpacity: 0.7
    });

    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
      layer.bringToFront();
    }

    info.update(layer.feature.properties);
  }

  var geojson;

  function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
  }

  function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
  }

  counter = 0;

  function onEachFeature(feature, layer) {
    // counter++;
    layer.on({
      mouseover: highlightFeature,
      mouseout: resetHighlight,
      click: zoomToFeature
    });
  }

  geojson = L.geoJson(statesData, {
    style: style,
    onEachFeature: onEachFeature
  }).addTo(map);

  map.attributionControl.addAttribution(
    'CCTV, Criminal, Geojson Data &copy; <a href="http://smartcity.jakarta.go.id/">Jakarta Smart City</a>');

  var legend = L.control({
    position: 'bottomright'
  });

  legend.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info legend'),
      grades = [50,20,5,3],
      labels = [],
      from, to,
      tingkat_kriminal = ['Parah','Tinggi','Sedang','Rendah'];

    for (var i = 0; i < grades.length; i++) {
      from = grades[i];
      to = grades[i + 1];

      labels.push(
        '<i style="background:' + getColor(from + 1) + '"></i> ' + tingkat_kriminal[i]);
        // from + (to ? '&ndash;' + to : '+'));
    }

    div.innerHTML = labels.join('<br>');
    return div;
  };

  legend.addTo(map);

  L.control.layers(baseLayers, overlays).addTo(map);
</script>


<div class="info informasi">
<h4> <i class="fa fa-clock-o"></i> Status Sekarang</h4>
<ul class="list-group">
<?php
  $status_sekarang = $app->getStatusKriminalJam();
  if($status_sekarang=="Ada") echo "<span class='badge badge-danger'>Potensi Kriminal Tinggi</span>";
    else echo "<span class='badge badge-success'>Potensi Kriminal Rendah</span>";

?>
</ul>
<hr>
<h4> <i class="fa fa-clock-o"></i> Jam Potensi Kriminal</h4>
<ul class="list-group">
  <?php 
  $all = $app->getOneDayStatus();
  foreach ($all['hasil'] as $row) {
      if($row!="")
        echo '<li class="list-group-item"> Jakarta, Jam '.$row.'.00</li>';
    }
  ?>
</ul>
</div>