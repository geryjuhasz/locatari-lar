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
                    echo 'Nr. scari: '.$nrapart;
                    echo '<br/>';
                    echo 'Suma repatitie: '.round($che->suma/$nrscara, 4);
                    $che->repartitie = round($che->suma/$nrscara, 4);
                    $che->save();
                }
                
                if($c->tipcalculrepartitie->id == 5 || $c->tipcalculrepartitie->id == 6 || $c->tipcalculrepartitie->id == 7){
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
                    
                            
                    echo 'Consum mp: '.$mp;
                    echo '<br/>';
 
                    echo 'Suma repatitie: '.round($che->suma/$mp, 4);
                    $che->repartitie = round($che->suma/$mp, 4);
                    $che->save();
                }
                echo '<hr/>';
            }
        }