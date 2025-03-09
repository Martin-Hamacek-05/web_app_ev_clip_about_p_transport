<?php
class statistic{
    
    public static function procedure_convertor(){
        $list = array();
        array_push($list,"recalculation_clips_on_days");
        array_push($list,"recalculation_clips_on_month");
        array_push($list,"recalculation_clip_on_line");
        array_push($list,"recalculation_clip_to_stops");
        array_push($list,"recalculation_days_on_stop");
        array_push($list,"recalculation_on_subtype_mean_of_transport_from_clip");
        array_push($list,"recalculation_lines_on_stop_from_clip");
        array_push($list,"recalculation_subtypes_mean_of_transport_on_lines_from_clip");

        return $list;
    }

    public function procedure_load(){
        $statistic = new statistic();
        $list_II = $statistic->procedure_convertor();
        $list = array();
        array_push($list,"přepočet záběrů na dny (I)");
        array_push($list,"přepočet záběrů na měsíc (I)");
        array_push($list,"přepočet záběrů na jednotlivé linky (I)");
        array_push($list,"přepočet záběrů na jednotlivé zastávky (I)");
        array_push($list,"přepočet dnů na zastávky (I)");
        array_push($list,"přepočet záběrů na podtyp dopravních prostředků (II)");
        array_push($list,"přepočet linek na zastávku na základě klipů (II)");
        array_push($list,"přepočet linek na podtyp dopravních prostředků (III)");

        for($i = 0; $i<count($list);$i++){
            echo '<option value="'.$list_II[$i].'">'.$list[$i].'</option>';
        }
    }

    public function headers($index){
        $statistic = new statistic;

        $arrayI = array("vytvořeno","počet");
        $arrayII = array("název zastávky", "počet");
        $arrayIII = array("dopravní prostředek", "podtyp", "počet");
        $arrayIV = array("dopraavní prostředek", "podtyp","název linky","počet");
        $arrayV = array("název zastávky", "linka", "počet");

        $array = array(
            $statistic->procedure_convertor()[0] => "<tr><th class='vypisdat_II'>".$arrayI[0]."</th><th class='vypisdat_II'>".$arrayI[1]."</th></tr>",
            $statistic->procedure_convertor()[1] => "<tr><th class='vypisdat_II'>".$arrayI[0]."</th><th class='vypisdat_II'>".$arrayI[1]."</th></tr>",
            $statistic->procedure_convertor()[2] => "<tr><th class='vypisdat_II'>".$arrayV[1]."</th><th class='vypisdat_II'>".$arrayV[2]."</th></tr>",
            $statistic->procedure_convertor()[3] => "<tr><th class='vypisdat_II'>".$arrayII[0]."</th><th class='vypisdat_II'>".$arrayII[1]."</th></tr>",
            $statistic->procedure_convertor()[4] => "<tr><th class='vypisdat_II'>".$arrayII[0]."</th><th class='vypisdat_II'>".$arrayII[1]."</th></tr>",
            $statistic->procedure_convertor()[5] => "<tr><th class='vypisdat_II'>".$arrayIII[0]."</th><th class='vypisdat_II'>".$arrayIII[1]."</th><th class='vypisdat_II'>".$arrayIII[2]."</th></tr>",
            $statistic->procedure_convertor()[6] => "<tr><th class='vypisdat_II'>".$arrayV[0]."</th><th class='vypisdat_II'>".$arrayV[1]."</th><th class='vypisdat_II'>".$arrayV[2]."</th></tr>",
            $statistic->procedure_convertor()[7] => "<tr><th class='vypisdat_II'>".$arrayIV[0]."</th><th class='vypisdat_II'>".$arrayIV[1]."</th><th class='vypisdat_II'>".$arrayIV[2]."</th><th class='vypisdat_II'>".$arrayIV[3]."</th></tr>",
        );

        return $array[$index];
    }


}

?>