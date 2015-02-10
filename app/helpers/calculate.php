<?php

function calculateConsum($consum){
    $consum_luna = array();
    foreach ($consum as $c){
        $locatar = Locatari::find($c->locatari_id);
        $con['locatari_id'] = $c->locatari_id;
        $con['scara_id'] = $locatar->scara_id;
        $con['consum_rece'] = $c->index_nou_rece - $c->index_vechi_rece;
        $con['consum_calda'] = $c->index_nou_calda - $c->index_vechi_calda;
        $con['tipincapere_id'] = $c->tipincapere_id;
        $consum_luna[] = $con;
    }
    return $consum_luna;
}

function getConsumLocatar($locatar_id, $luna, $tipconsum=1){
    
}

function calculateRepartition($asociatie_id, $luna){
            $cheltuieli = Cheltuieli::where('asociatie_id', '=', $asociatie_id)
                    ->where('luna', '=', $luna)
                    ->get();
            
                      
            foreach($cheltuieli as $che){
                $calcul_asociatie = Calcul_asociatie::where('asociatie_id', '=', $asociatie_id)
                        ->where('tipcheltuieli_id', '=', $che->tipcheltuieli_id)->get();
                $c = $calcul_asociatie[0];
                
                echo 'Cheltuiala: '.$che->tipcheltuieli->denumire;
                echo '<br/>';

                echo 'Suma: '.$che->suma;
                echo '<br/>';

                echo 'Repartitia: '.$c->tiprepartitie->denumire;
                echo ' pe: '.$c->tipcalculrepartitie->denumire;
                echo '<br/>';
                
                if($c->tipcalculrepartitie->id == 1){
                    switch ($c->tiprepartitie->id){
                        case 1: $nrpers = Locatari::fromAsociatie($asociatie_id)->sum('nr_persoane');break;
                        case 2: $nrpers = Locatari::fromBloc($che->object_id)->sum('nr_persoane');break;
                        case 3: $nrpers = Locatari::fromScara($che->object_id)->sum('nr_persoane');break;
                        case 4: $locatar = Locatari::find($che->object_id);
                                $nrpers = $locatar->nr_persoane; break;
                        break;
                    }
                    echo 'Nr. pers: '.$nrpers;
                    echo '<br/>';
                    echo 'Suma repatitie: '.round($che->suma/$nrpers, 4);
                    
                    $che->repartitie = round($che->suma/$nrpers, 4);
                    $che->save();
                }
                
                if($c->tipcalculrepartitie->id == 2){
                    switch ($c->tiprepartitie->id){
                        case 1: $mp = Locatari::fromAsociatie($asociatie_id)->sum('suprafata_mp');break;
                        case 2: $mp = Locatari::fromBloc($che->object_id)->sum('suprafata_mp');break;
                        case 3: $mp = Locatari::fromScara($che->object_id)->sum('suprafata_mp');break;
                        case 4: $locatar = Locatari::find($che->object_id);
                                $mp = $locatar->suprafata_mp; break;
                        break;
                    }
                    echo 'Suprafata mp: '.$mp;
                    echo '<br/>';
                    echo 'Suma repatitie: '.round($che->suma/$mp, 4);
                    $che->repartitie = round($che->suma/$mp, 4);
                    $che->save();
                }
                
                if($c->tipcalculrepartitie->id == 3){
                    switch ($c->tiprepartitie->id){
                        case 1: $nrapart = Locatari::fromAsociatie($asociatie_id)->count();break;
                        case 2: $nrapart = Locatari::fromBloc($che->object_id)->count();break;
                        case 3: $nrapart = Locatari::fromScara($che->object_id)->count();break;
                        case 4: $nrapart = 1; break;
                        break;
                    }
                    echo 'Nr. apartamente: '.$nrapart;
                    echo '<br/>';
                    echo 'Suma repatitie: '.round($che->suma/$nrapart, 4);
                    $che->repartitie = round($che->suma/$nrapart, 4);
                    $che->save();
                }
                
                if($c->tipcalculrepartitie->id == 4){
                    switch ($c->tiprepartitie->id){
                            case 1: $nrscara = Scara::fromAsociatie($asociatie_id)->count();break;
                            case 2: $nrscara = Scara::fromBloc($che->object_id)->count();break;
                            case 3: $nrscara = 1; break;
                            case 4: $nrscara = 1; break;
                            break;
                    }
                    $repartitie = round($che->suma/$nrscara, 4);

                    echo 'Nr. scari: '.$nrapart;
                    echo '<br/>';
                    echo 'Suma repatitie: '.$repartitie;
                    $che->repartitie = $repartitie;
                    $che->save();
                }
                
                if($c->tipcalculrepartitie->id == 5 || $c->tipcalculrepartitie->id == 6 || $c->tipcalculrepartitie->id == 7){
                    if(is_null($che->consum) || $che->consum == 0){
                        switch ($c->tiprepartitie->id){
                            case 1: $consum = Consum::fromAsociatie($asociatie_id)
                                    ->where('luna', '=', $luna)
                                    ->where('tipconsum_id', '=', '1')
                                    ->get();break;
                            case 2: {
                                $consum = Consum::fromBloc($che->object_id)
                                    ->where('luna', '=', $luna)
                                    ->where('tipconsum_id', '=', '1')
                                    ->get();
                                break;
                            }
                            case 3: 
                            {
                                $consum = Consum::fromScara($che->object_id)
                                    ->where('luna', '=', $luna)
                                    ->where('tipconsum_id', '=', '1')
                                    ->get();
                                break;
                            }
                            case 4: $consum = null; break;
                            break;
                        }
                        if ($consum)
                            $consum_luna = calculateConsum($consum);

                        switch ($c->tipcalculrepartitie->id){
                            case 5: $mp = getColumnSum($consum_luna, 'consum_rece') + getColumnSum($consum_luna, 'consum_calda');
                                    break;
                            case 6: $mp = getColumnSum($consum_luna, 'consum_calda');
                                    break;
                            case 7: $mp = getColumnSum($consum_luna, 'consum_rece');
                                    break;
                            break;
                        }
                        $repartitie = round($che->suma/$mp, 4);
                        echo 'Consum mc: '.$mp;
                        echo '<br/>';
                    } else {
                        $repartitie =  round($che->suma/$che->consum, 4);
                        echo 'Consum mc factura: '.$che->consum;
                        echo '<br/>';
                    }
                    echo 'Suma repatitie: '.$repartitie;
                    $che->repartitie = $repartitie;
                    $che->save();
                }
                echo '<hr/>';
            }
        }
        
function calculateCostLocatari($asociatie_id, $luna){
    //populare Cost_locatari
            $locatari = Locatari::FromAsociatie($asociatie_id)->get();
            $costuri = array();
            
            foreach($locatari as $l){
                $costuri[$l->id]['locatari_id'] = $l->id;
                $costuri[$l->id]['costuri_persoana'] = 0;
                $costuri[$l->id]['apa_rece'] = 0;
                $costuri[$l->id]['dif_apa_rece'] = 0;
                $costuri[$l->id]['apa_calda'] = 0;
                $costuri[$l->id]['dif_apa_calda'] = 0;
                $costuri[$l->id]['costuri_comune'] = 0;
                $costuri[$l->id]['taxa_elsaco'] = 0;
                $costuri[$l->id]['caldura'] = 0;
                $costuri[$l->id]['fond_rulment'] = 0;
                $costuri[$l->id]['costuri_specifice'] = 0;
                $costuri[$l->id]['total'] = 0;
                $costuri[$l->id]['luna'] = '';
                
            }
            
            //costuri_persoana - cheltuieli cu tip calcul repartitie Nr. persoana - 1
            // <editor-fold desc="costuri_persoana">            
            $calcul_asociatie = Calcul_asociatie::where('asociatie_id', '=', $asociatie_id)
                    ->where('tipcalculrepartitie_id', '=', 1)->get();
            foreach ($calcul_asociatie as $calcul){
                $cheltuieli = Cheltuieli::where('asociatie_id', '=', $asociatie_id)
                    ->where('luna', '=', $luna)
                    ->where('tipcheltuieli_id', '=', $calcul->tipcheltuieli_id)
                    ->get();
                foreach($cheltuieli as $che){
                    
//                        echo 'Cheltuiala: '.$che->tipcheltuieli->denumire;
//                        echo '<br/>';
//
//                        echo 'Suma: '.$che->suma;
//                        echo '<br/>';
//
//                        echo 'Repartitia: '.$calcul->tiprepartitie->denumire;
//                        echo ' pe: '.$calcul->tipcalculrepartitie->denumire;
//                        echo '<br/>';
//                        echo 'Suma repartizata pe persoana:' . $che->repartitie;
//                        echo '<br/>';
                        
                        foreach($locatari as $l){
                            switch ($calcul->tiprepartitie->id){
                                case 1: 
                                    if(is_null($che->object_id) || $che->object_id == $asociatie_id){
                                        $costuri[$l->id]['costuri_persoana'] += $che->repartitie * $l->nr_persoane;
                                    }
                                    break;
                                case 2: 
                                    $bloc_id = Scara::find($l->scara_id)->bloc_id;
                                    if($che->object_id == $bloc_id){
                                        $costuri[$l->id]['costuri_persoana'] += $che->repartitie * $l->nr_persoane;
                                    }
                                    
                                    break;
                                case 3: 
                                    if($che->object_id == $l->scara_id){
                                        $costuri[$l->id]['costuri_persoana'] += $che->repartitie * $l->nr_persoane;
                                    }
                                    break;
                                case 4: 
                                    if($che->object_id == $l->id){
                                        $costuri[$l->id]['costuri_persoana'] += $che->repartitie * $l->nr_persoane;
                                    }
                                    break;
                                break;
                            }
                        }
                }
                
            }
            // </editor-fold>
            
            

            //apa rece
            //<editor-fold desc="apa rece">   
            $calcul_asociatie = Calcul_asociatie::where('asociatie_id', '=', $asociatie_id)
                    ->wherein('tipcalculrepartitie_id', array(7))->get();
            foreach ($calcul_asociatie as $calcul){
                //var_dump($calcul);
                $cheltuieli = Cheltuieli::where('asociatie_id', '=', $asociatie_id)
                    ->where('luna', '=', $luna)
                    ->where('tipcheltuieli_id', '=', $calcul->tipcheltuieli_id)
                    ->get();
                foreach($cheltuieli as $che){
                    
//                        echo 'Cheltuiala: '.$che->tipcheltuieli->denumire;
//                        echo '<br/>';
//
//                        echo 'Suma: '.$che->suma;
//                        echo '<br/>';
//
//                        echo 'Repartitia: '.$calcul->tiprepartitie->denumire;
//                        echo ' pe: '.$calcul->tipcalculrepartitie->denumire;
//                        echo '<br/>';
//                        echo 'Suma repartizata pe mp:' . $che->repartitie;
//                        echo '<br/>';
                    
                        //calcul diferenta daca exista consum factura
                        $cost_diff_rece = 0;
                        if(!is_null($che->consum) && $che->consum <> 0){
                            switch ($calcul->tiprepartitie->id){
                                case 1: $consum = Consum::fromAsociatie($asociatie_id)
                                        ->where('luna', '=', $luna)
                                        ->where('tipconsum_id', '=', '1')
                                        ->get();
                                        $nrapart = Locatari::fromAsociatie($asociatie_id)->count();
                                    break;
                                        
                                case 2: {
                                    $consum = Consum::fromBloc($che->object_id)
                                        ->where('luna', '=', $luna)
                                        ->where('tipconsum_id', '=', '1')
                                        ->get();
                                    $nrapart = Locatari::fromBloc($che->object_id)->count();
                                    break;
                                }
                                case 3: 
                                {
                                    $consum = Consum::fromScara($che->object_id)
                                        ->where('luna', '=', $luna)
                                        ->where('tipconsum_id', '=', '1')
                                        ->get();
                                    $nrapart = Locatari::fromScara($che->object_id)->count();
                                    break;
                                }
                                case 4: $consum = null; $nrapart = 1; break;
                                break;
                            }
                            if ($consum)
                                $consum_luna = calculateConsum($consum);
                            
                            $diff_consum = round((getColumnSum($consum_luna, 'consum_rece') - $che->consum)/$nrapart, 4);
                            //echo 'nr apart :'. $nrapart; 
                            //echo 'diferenta consum apa rece: ' .$diff_consum;
                            $cost_diff_rece =  round($diff_consum * $che->repartitie, 4);
                        }
                        
                        foreach($locatari as $l){
                            $consum = Consum::LocatarConsum($l->id)
                                    ->where('luna', '=', $luna)
                                    ->where('tipconsum_id', '=', 1)
                                    ->get();
                            if ($consum)
                                $consum_luna = calculateConsum($consum);
                            //var_dump($consum_luna[0]);
                            
                            switch ($calcul->tiprepartitie->id){
                                case 1: 
                                    if(is_null($che->object_id) || $che->object_id == $asociatie_id){
                                        $costuri[$l->id]['apa_rece'] += $che->repartitie * getColumnSum($consum_luna, 'consum_rece');
                                        $costuri[$l->id]['dif_apa_rece'] += -$cost_diff_rece;
                                    }
                                    break;
                                case 2: 
                                    $bloc_id = Scara::find($l->scara_id)->bloc_id;
                                    if($che->object_id == $bloc_id){
                                        $costuri[$l->id]['apa_rece'] += $che->repartitie * getColumnSum($consum_luna, 'consum_rece');
                                        $costuri[$l->id]['dif_apa_rece'] += -$cost_diff_rece;
                                    }
                                    
                                    break;
                                case 3: 
                                    if($che->object_id == $l->scara_id){
                                        $costuri[$l->id]['apa_rece'] += $che->repartitie * getColumnSum($consum_luna, 'consum_rece');
                                        $costuri[$l->id]['dif_apa_rece'] += -$cost_diff_rece;
                                    }
                                    break;
                                case 4: 
                                    if($che->object_id == $l->id){
                                        $costuri[$l->id]['apa_rece'] += $che->repartitie * getColumnSum($consum_luna, 'consum_rece');
                                        $costuri[$l->id]['dif_apa_rece'] += -$cost_diff_rece;
                                    }
                                    break;
                                break;
                            }
                        }
                }
                
            }
            // </editor-fold>
            
            //apa calda
            //<editor-fold desc="apa calda">   
            $calcul_asociatie = Calcul_asociatie::where('asociatie_id', '=', $asociatie_id)
                    ->wherein('tipcalculrepartitie_id', array(6))->get();
            foreach ($calcul_asociatie as $calcul){
                //var_dump($calcul);
                $cheltuieli = Cheltuieli::where('asociatie_id', '=', $asociatie_id)
                    ->where('luna', '=', $luna)
                    ->where('tipcheltuieli_id', '=', $calcul->tipcheltuieli_id)
                    ->get();
                foreach($cheltuieli as $che){
                    
//                        echo 'Cheltuiala: '.$che->tipcheltuieli->denumire;
//                        echo '<br/>';
//
//                        echo 'Suma: '.$che->suma;
//                        echo '<br/>';
//
//                        echo 'Repartitia: '.$calcul->tiprepartitie->denumire;
//                        echo ' pe: '.$calcul->tipcalculrepartitie->denumire;
//                        echo '<br/>';
//                        echo 'Suma repartizata pe mp:' . $che->repartitie;
//                        echo '<br/>';
                        //calcul diferenta daca exista consum factura
                        $cost_diff_rece = 0;
                        if(!is_null($che->consum) && $che->consum <> 0){
                            switch ($calcul->tiprepartitie->id){
                                case 1: $consum = Consum::fromAsociatie($asociatie_id)
                                        ->where('luna', '=', $luna)
                                        ->where('tipconsum_id', '=', '1')
                                        ->get();
                                        $nrapart = Locatari::fromAsociatie($asociatie_id)->count();
                                    break;
                                        
                                case 2: {
                                    $consum = Consum::fromBloc($che->object_id)
                                        ->where('luna', '=', $luna)
                                        ->where('tipconsum_id', '=', '1')
                                        ->get();
                                    $nrapart = Locatari::fromBloc($che->object_id)->count();
                                    break;
                                }
                                case 3: 
                                {
                                    $consum = Consum::fromScara($che->object_id)
                                        ->where('luna', '=', $luna)
                                        ->where('tipconsum_id', '=', '1')
                                        ->get();
                                    $nrapart = Locatari::fromScara($che->object_id)->count();
                                    break;
                                }
                                case 4: $consum = null; $nrapart = 1; break;
                                break;
                            }
                            if ($consum)
                                $consum_luna = calculateConsum($consum);
                            
                            $diff_consum = round((getColumnSum($consum_luna, 'consum_calda') - $che->consum)/$nrapart, 4);
                            //echo 'nr apart :'. $nrapart; 
                            //echo 'diferenta consum apa calda: ' .$diff_consum;
                            $cost_diff_calda =  round($diff_consum * $che->repartitie,4);
                        }
                        
                        foreach($locatari as $l){
//                            echo 'Locatar: '. $l->nume;
//                            echo '<br/>';
                            
                            $consum = Consum::LocatarConsum($l->id)
                                    ->where('luna', '=', $luna)
                                    ->where('tipconsum_id', '=', 1)
                                    ->get();
                            if ($consum)
                                $consum_luna = calculateConsum($consum);
                            //var_dump($consum_luna[0]);
                            
                            switch ($calcul->tiprepartitie->id){
                                case 1: 
                                    if(is_null($che->object_id) || $che->object_id == $asociatie_id){
                                        $costuri[$l->id]['apa_calda'] += $che->repartitie * getColumnSum($consum_luna, 'consum_calda');
                                        $costuri[$l->id]['dif_apa_calda'] += -$cost_diff_calda;
//                                        echo 'Asociatie pe consum apa calda: '.$che->repartitie .' * '. getColumnSum($consum_luna, 'consum_calda');
//                                        echo '<br/>';
                                    }
                                    break;
                                case 2: 
                                    $bloc_id = Scara::find($l->scara_id)->bloc_id;
                                    if($che->object_id == $bloc_id){
                                        $costuri[$l->id]['apa_calda'] += $che->repartitie * getColumnSum($consum_luna, 'consum_calda');
                                        $costuri[$l->id]['dif_apa_calda'] += -$cost_diff_calda;
//                                        echo 'Bloc pe consum apa calda: '.$che->repartitie .' * '. getColumnSum($consum_luna, 'consum_calda');
//                                        echo '<br/>';
                                    }
                                    
                                    break;
                                case 3: 
                                    if($che->object_id == $l->scara_id){
                                        $costuri[$l->id]['apa_calda'] += $che->repartitie * getColumnSum($consum_luna, 'consum_calda');
                                        $costuri[$l->id]['dif_apa_calda'] += -$cost_diff_calda;
//                                        echo 'Scara pe suma repartizata: '.$che->repartitie.' * '. getColumnSum($consum_luna, 'consum_calda');
//                                        echo '<br/>';
                                    }
                                    break;
                                case 4: 
                                    if($che->object_id == $l->id){
                                        $costuri[$l->id]['apa_calda'] += $che->repartitie * getColumnSum($consum_luna, 'consum_calda');
                                        $costuri[$l->id]['dif_apa_calda'] += -$cost_diff_calda;
//                                        echo 'Apartament pe cosum apa calda: '.$che->repartitie.' * '. getColumnSum($consum_luna, 'consum_calda');
//                                        echo '<br/>';
                                    }
                                    break;
                                break;
                            }
                        }
                }
                
            }
            // </editor-fold>
            
            //costuri_comune - se calculeaza pe repartitie nr. total mp repartizat pe bloc sau asociatie
            //tipcalculrepartitie - 2
            //<editor-fold desc="costuri_comune">   
            $calcul_asociatie = Calcul_asociatie::where('asociatie_id', '=', $asociatie_id)
                    ->where('tipcalculrepartitie_id', '=', 2)->get();
            foreach ($calcul_asociatie as $calcul){
                //var_dump($calcul);
                $cheltuieli = Cheltuieli::where('asociatie_id', '=', $asociatie_id)
                    ->where('luna', '=', $luna)
                    ->where('tipcheltuieli_id', '=', $calcul->tipcheltuieli_id)
                    ->get();
                foreach($cheltuieli as $che){
                    
//                        echo 'Cheltuiala: '.$che->tipcheltuieli->denumire;
//                        echo '<br/>';
//
//                        echo 'Suma: '.$che->suma;
//                        echo '<br/>';
//
//                        echo 'Repartitia: '.$calcul->tiprepartitie->denumire;
//                        echo ' pe: '.$calcul->tipcalculrepartitie->denumire;
//                        echo '<br/>';
//                        echo 'Suma repartizata pe mp:' . $che->repartitie;
//                        echo '<br/>';
                        
                        foreach($locatari as $l){
                            
                            switch ($calcul->tiprepartitie->id){
                                case 1: 
                                    if(is_null($che->object_id) || $che->object_id == $asociatie_id){
                                        $costuri[$l->id]['costuri_comune'] += round($che->repartitie * $l->suprafata_mp, 4);
                                    }
                                    break;
                                case 2: 
                                    $bloc_id = Scara::find($l->scara_id)->bloc_id;
                                    if($che->object_id == $bloc_id){
                                        $costuri[$l->id]['costuri_comune'] += round($che->repartitie * $l->suprafata_mp, 4);
                                    }
                                    
                                    break;
                                case 3: 
                                    if($che->object_id == $l->scara_id){
                                        $costuri[$l->id]['costuri_comune'] += round($che->repartitie * $l->suprafata_mp, 4);
                                    }
                                    break;
                                case 4: 
                                    if($che->object_id == $l->id){
                                        $costuri[$l->id]['costuri_comune'] += round($che->repartitie * $l->suprafata_mp, 4);
                                    }
                                    break;
                                break;
                            }
                        }
                }
                
            }
            // </editor-fold>
            
            //costuri_specifice - ex. curatenie 
            //tipcalculrepartitie - poate fi pe scara sau apartament 3 sau 4
            //<editor-fold desc="costuri_specifice">   
            $calcul_asociatie = Calcul_asociatie::where('asociatie_id', '=', $asociatie_id)
                    ->wherein('tipcalculrepartitie_id', array(3,4))->get();
            foreach ($calcul_asociatie as $calcul){
                //var_dump($calcul);
                $cheltuieli = Cheltuieli::where('asociatie_id', '=', $asociatie_id)
                    ->where('luna', '=', $luna)
                    ->where('tipcheltuieli_id', '=', $calcul->tipcheltuieli_id)
                    ->get();
                foreach($cheltuieli as $che){
//                    
//                        echo 'Cheltuiala: '.$che->tipcheltuieli->denumire;
//                        echo '<br/>';
//
//                        echo 'Suma: '.$che->suma;
//                        echo '<br/>';
//
//                        echo 'Repartitia: '.$calcul->tiprepartitie->denumire;
//                        echo ' pe: '.$calcul->tipcalculrepartitie->denumire;
//                        echo '<br/>';
//                        echo 'Suma repartizata pe mp:' . $che->repartitie;
//                        echo '<br/>';
//                        
                        foreach($locatari as $l){
                            
                            switch ($calcul->tiprepartitie->id){
                                case 1: 
                                    if(is_null($che->object_id) || $che->object_id == $asociatie_id){
                                        $costuri[$l->id]['costuri_specifice'] += $che->repartitie;
                                    }
                                    break;
                                case 2: 
                                    $bloc_id = Scara::find($l->scara_id)->bloc_id;
                                    if($che->object_id == $bloc_id){
                                        $costuri[$l->id]['costuri_specifice'] += $che->repartitie;
                                    }
                                    
                                    break;
                                case 3: 
                                    if($che->object_id == $l->scara_id){
                                        $costuri[$l->id]['costuri_specifice'] += $che->repartitie;
                                    }
                                    break;
                                case 4: 
                                    if($che->object_id == $l->id){
                                        $costuri[$l->id]['costuri_specifice'] += $che->repartitie;
                                    }
                                    break;
                                break;
                            }
                        }
                }
                
            }
            // </editor-fold>
            
            

                        
                        
            //taxa_elsaco
            //caldura
            //fond_rulment
            //
            //
            //
            //
            //
            //total
            foreach($locatari as $l){
                $costuri[$l->id]['total'] = $costuri[$l->id]['costuri_persoana']+
                        $costuri[$l->id]['apa_rece']+
                        $costuri[$l->id]['dif_apa_rece']+
                        $costuri[$l->id]['apa_calda']+
                        $costuri[$l->id]['dif_apa_calda']+
                        $costuri[$l->id]['costuri_comune']+
                        $costuri[$l->id]['taxa_elsaco']+
                        $costuri[$l->id]['caldura']+
                        $costuri[$l->id]['fond_rulment']+
                        $costuri[$l->id]['costuri_specifice'];
                $costuri[$l->id]['luna']=$luna;
            }
            //var_dump($costuri);
            //die();
            foreach($costuri as $cost) {
                $cost_locatari = null;
                $cost_locatari = Cost_locatari::where('locatari_id', '=', $cost['locatari_id'])
                        ->where('luna', '=', $luna)
                        ->get();
                $cost_locatari = $cost_locatari[0];
                if(!$cost_locatari)
                    $cost_locatari = new Cost_locatari();
                //var_dump($cost_locatari);
                $cost_locatari->locatari_id = $cost['locatari_id'];
                $cost_locatari->costuri_persoana = $cost['costuri_persoana'];
                $cost_locatari->apa_rece = $cost['apa_rece'];
                $cost_locatari->dif_apa_rece = $cost['dif_apa_rece'];
                $cost_locatari->apa_calda = $cost['apa_calda'];
                $cost_locatari->dif_apa_calda = $cost['dif_apa_calda'];
                $cost_locatari->costuri_comune = $cost['costuri_comune'];
                $cost_locatari->taxa_elsaco = $cost['taxa_elsaco'];
                $cost_locatari->caldura = $cost['caldura'];
                $cost_locatari->fond_rulment = $cost['fond_rulment'];
                $cost_locatari->costuri_specifice = $cost['costuri_specifice'];
                $cost_locatari->total = $cost['total'];
                $cost_locatari->luna = $cost['luna'];
                $cost_locatari->save();
            }
}