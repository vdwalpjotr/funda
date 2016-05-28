<?php
$sqlCount = "SELECT COUNT(*) as cnt
             FROM WO
             INNER JOIN wo_ad
             on wo_ad.WOID = wo.WOID
             WHERE (".$_SESSION['CLAUSES']['soortBouw'].") $straatnaamQueryClause $huisnummerQueryClause $toevoeginQueryClause $plaatsnaamQueryClause $postcodeQueryClause
              AND wo_ad.vraagprijs BETWEEN ".$_SESSION['lowerPrice']." AND ".$_SESSION['maxPrice'].
              " AND wo.SoortObject = ".$_SESSION['CLAUSES']['soortObject'];
echo $sqlCount;

$sqlSelect = "SELECT wo.ADDRESS as ADDRESS,
wo.PC as PC,
wo.CITY as city,
det.WOON_OPPERVLAKTE as WOON_OPPERVLAKTE,
det.AantalKamers as aantal_kamers,
wo_ad.vraagprijs as vraagprijs,
mk.name as makelaar,
svp.name as prijsnaam
FROM WO
INNER JOIN wo_ad
ON wo_ad.WOID = wo.WOID
INNER JOIN wo_details as det
ON wo.WOID = det.WOID
INNER JOIN mkantoor as mk
ON wo.mkID = mk.mkID
INNER JOIN soortvraagprijs as svp
ON wo_ad.vraagprijs_soort = svp.ID
WHERE (". $_SESSION['CLAUSES']['soortBouw']." ) $straatnaamQueryClause $huisnummerQueryClause $toevoeginQueryClause $plaatsnaamQueryClause $postcodeQueryClause
AND vraagprijs
BETWEEN ".$_SESSION['lowerPrice']." AND ".$_SESSION['maxPrice']."
AND wo.SoortObject = ".$_SESSION['CLAUSES']['soortObject']."
LIMIT 6 OFFSET ".$_SESSION['offset'];


echo "<br />".$sqlSelect;?>
