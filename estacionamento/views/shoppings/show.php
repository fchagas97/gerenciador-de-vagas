<h1 class="h5 m-0 p-4 bg-light border-bottom">
    <i class="fa fa-chevron-circle-right d-inline-block mr-2"></i> Visualizar Shoppings
</h1>
<div class="p-4"><div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>Nome</th>
                <th style="width:100px">Endereço</th>
                <th>Vagas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
<?php
$coordinates_list = [];

foreach ($shoppings as $shopping):
    $id      = $shopping->id;
    $name    = $shopping->nome;
    $address = $shopping->endereco;
    $coords  = geocode($address, $name);
            print($coords);
    if (!empty($coords)) {
        array_push($coordinates_list, $coords);
    }
?>
            <tr>
            <td class="align-middle text-truncate" title="<?php echo $name ?>"><?php echo $name; ?></td>
            <td class="align-middle text-truncate"><?php echo $address; ?></td>
            <td class="align-middle text-center"><?php echo $totalVagas($id); ?></td>
            <td class="align-middle text-center">
                <a
                href="index.php?controller=vagas&action=show&shopping_id=<?php echo $id; ?>"
                class="badge badge-pill badge-info p-2">Ver vagas</a>
                <a
                href="#"
                data-href="index.php?controller=shoppings&action=delete&shopping_id=<?php echo $id; ?>"
                class="action_delete badge badge-pill badge-danger p-2"
                data-toggle="modal"
                data-target="#confirm-delete">Apagar</a>
                <a
                href="index.php?controller=shoppings&action=update&shopping_id=<?php echo $id; ?>"
                class="badge badge-pill badge-secondary p-2">Atualizar</a>
            </td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>
</div>
<div id="mapid">Loading...</div>
</div>
<script type="text/javascript">
var coordinates_list = <?php echo json_encode($coordinates_list); ?>;
var mymap = L.map('mapid').setView([0, 0], 13);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(mymap);
var shoppingMarkers = L.featureGroup();
shoppingMarkers.addTo(mymap);
for (var i=0; i<coordinates_list.length; i++) {     
    var lat = coordinates_list[i][0];
    var lon = coordinates_list[i][1];
    var popupText = coordinates_list[i][2];
    var markerLocation = new L.LatLng(lat, lon);
    var marker = new L.Marker(markerLocation);
    marker.bindPopup(popupText);
    marker.addTo(shoppingMarkers);
}
mymap.fitBounds(shoppingMarkers.getBounds(), {padding: [10, 10]});
</script>
