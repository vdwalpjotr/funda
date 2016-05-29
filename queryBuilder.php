<?php
$sqlCount = "SELECT COUNT(*) as cnt
             FROM WO
             INNER JOIN wo_ad
             on wo_ad.WOID = wo.WOID
             INNER JOIN wo_details as det
             on wo.WOID = det.WOID
             WHERE (".$_SESSION['CLAUSES']['soortBouw'].") $straatnaamQueryClause $huisnummerQueryClause $toevoeginQueryClause $plaatsnaamQueryClause $postcodeQueryClause
              AND wo_ad.vraagprijs BETWEEN ".$_SESSION['lowerPrice']." AND ".$_SESSION['maxPrice'].
              " AND wo_ad.vraagprijs_soort IS NOT NULL AND det.AantalKamers > ".$_SESSION['CLAUSES']['aantalKamers']."
              AND det.Woon_oppervlakte > ".$_SESSION['CLAUSES']['woonOppervlakte']."
              AND wo.SoortObject = ".$_SESSION['CLAUSES']['soortObject'];


$sqlSelect = "SELECT wo.ADDRESS as ADDRESS,
wo.WOID as WOID,
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
AND det.AantalKamers > ".$_SESSION['CLAUSES']['aantalKamers']."
AND det.Woon_oppervlakte > ".$_SESSION['CLAUSES']['woonOppervlakte']."
 AND wo_ad.vraagprijs_soort IS NOT NULL
LIMIT 6 OFFSET ".$_SESSION['offset'];


$sqlDetailSelect = "SELECT WO.ADDRESS as ADDRESS,
  wo.bouwjaar as bouwJaar,
  WO.PC as PC,
  WO.CITY as CITY,
  det.woon_oppervlakte as woonOppervlakte,
  det.Inhoud as woonInhoud,
  det.Perceel_oppervlakte as perceelOppervlakte,
  det.Tuin_oppervlakte as tuinOppervlakte,
  det.Aantalkamers as aantalKamers,
  det.Aantalbadkamers as aantalBadkamers,
  det.Aantalwoonlagen as aantalWoonlagen,
  makelaar.name as makelaarName,
  type.name as typeWoning,
  status.name as statusWoning,
  soort.name as soortWoning,
  bouw.name as soortBouw,
  soort_object.name as soortObject,
  wo_ad.vraagprijs as vraagprijs,
  svp.name as prijsnaam,
  SUBSTRING_INDEX(wo_ad.omschrijving, ' ', 40) as omschrijvingKort,
  wo_ad.omschrijving as omschrijvingLang,
  ABS(ROUND(DATEDIFF(wo_ad.plaatsings_datum, SYSDATE())/7)) as weeksPassed
  FROM WO
  INNER JOIN wo_ad
  ON WO.WOID = wo_ad.WOID
  INNER JOIN soortvraagprijs as svp
  ON wo_ad.vraagprijs_soort = svp.ID
  INNER JOIN typewoning as type
  ON WO.TYPEWONING = type.ID
  INNER JOIN status
  ON wo_ad.status_id = status.id
  INNER JOIN soortwoning as soort
  ON wo.SoortWoning = soort.ID
  INNER JOIN soortobject as soort_object
  ON wo.soortobject = soort_object.ID
  INNER JOIN SoortBouw as bouw
  ON wo.SoortBouw = bouw.ID
  INNER JOIN mkantoor as makelaar
  ON makelaar.MKID = wo.MKID
  INNER JOIN wo_details as det
  ON WO.WOID = det.WOID
  WHERE WO.WOID=".$_GET['woid'];

$selectLiggingQuery = "SELECT ligging.name as ligging FROM
wo_ligging
INNER JOIN ligging
ON wo_ligging.ligging_id = ligging.ID
WHERE wo_ligging.WOID =".$_GET['woid'];
// echo $sqlSelect;

?>
