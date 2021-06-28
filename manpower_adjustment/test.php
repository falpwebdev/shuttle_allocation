<?php
   include '../db/config.php';
   include '../functions/inc/inc.php';

   $deptCode = 'PROD';
   $deptSection = 'Section 4';
   $subSection = 'Subaru Final';
   $empPosition = 'Associate';

    $keyofDept = array_search($subSection,array_column($subCodesList,'subSection'));
    $code = $subCodesList[$keyofDept]["code"];
    $key = array_search($empPosition,array_column($positionList,'position'));
    $rank = $positionList[$key]["rank"];
    $costCenter = $code.'.'.$rank.'_'.$subSection;



?>