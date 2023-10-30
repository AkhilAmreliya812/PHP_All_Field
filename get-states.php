<?php
$country = $_POST["country"];

if($country == "India") { ?>
    <option value="Gujarat">Gujarat</option>
    <option value="Maharastra">Maharastra</option>
    <option value="Rajasthan">Rajasthan</option>
    <option value="Banglore">Banglore</option>
<?php } elseif($country == "USA") { ?>
    <option value="New York">New York</option>
    <option value="Los Angeles">Los Angeles</option>
    <option value="California">California</option>
    <option value="New Jersey">New Jersey</option>
    
<?php }?>


