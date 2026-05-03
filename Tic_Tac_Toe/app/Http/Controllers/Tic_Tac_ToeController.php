<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Tic_Tac_ToeController extends Controller
{
    private $case=[
                [
                    "case1"=>[false," "] ,
                    "case2"=>[false," "] ,
                    "case3"=>[false," "] 
                ],

                [
                    "case4"=>[false," "] ,
                    "case5"=>[false," "] ,
                    "case6"=>[false," "] 
                ],

                [
                    "case7"=>[false," "] ,
                    "case8"=>[false," "] ,
                    "case9"=>[false," "]  
                ]
            ];

    public function innit(){
        return view('tic_tac_toe.mode');
    }

    public function index(){
        if(!session()->has("mode")){
            return $this->innit();
        }

        $case=session('case');
        $gagne=session('gagne');
        
        return view('tic_tac_toe.index',compact('case','gagne'));
    }

    public function mode(Request $request){
        session([
            "mode"=>$request->mode,
            "choix"=>$request->dernier_signe,
            "dernier_signe"=>$request->dernier_signe,
            "nbTour"=>1,
            "case"=>$this->case,
            'gagne'=>'En cours'
        ]);

        return redirect()->route('jeu.index');
    }

    public function marquer(Request $request){
        $case = session('case');

        

        switch(session('mode')){
            case "1": {

                $d_s = session('choix');

                if(in_array($request->case, ['case1','case2','case3'])){
                    $case[0][$request->case] = [true, $d_s];
                }
                elseif(in_array($request->case, ['case4','case5','case6'])){
                    $case[1][$request->case] = [true, $d_s];
                }
                else{
                    $case[2][$request->case] = [true, $d_s];
                }

                session(['case' => $case]);
                $this->gagner($d_s);

                if(session('gagne') !== "En cours"){
                    break;
                }

                $ia = $d_s == "X" ? "O" : "X";

                $played = false;
                foreach($case as $li => $col){
                    foreach($col as $key => $value){
                        if($value[0] == false){ // case vide
                            $case[$li][$key] = [true, $ia];
                            $played = true;
                            break;
                        }
                    }
                    if($played) break;
                }

                
                session(['case' => $case]);
                $this->gagner($ia);

                break;
            }

            case "2": {
                $d_s = session("nbTour") == 1 
                ? session('choix') 
                : session('dernier_signe');

                if(in_array($request->case, ['case1','case2','case3'])){
                    $case[0][$request->case] = [true, $d_s];
                }
                elseif(in_array($request->case, ['case4','case5','case6'])){
                    $case[1][$request->case] = [true, $d_s];
                }
                else{
                    $case[2][$request->case] = [true, $d_s];
                }

                session(['case' => $case]);

                
                $this->gagner($d_s);

                
                $dernier_signe = $d_s == "X" ? "O" : "X";
                session(['dernier_signe' => $dernier_signe]);

                break;
            }
        }

        session(['nbTour' => session("nbTour") + 1]);

        return redirect()->route('jeu.index');
    }


    
    public function gagner($d_s){
        $case=session('case');
        $case1=$case[0]['case1'];
        $case2=$case[0]['case2'];
        $case3=$case[0]['case3'];
        $case4=$case[1]['case4'];
        $case5=$case[1]['case5'];
        $case6=$case[1]['case6'];
        $case7=$case[2]['case7'];
        $case8=$case[2]['case8'];
        $case9=$case[2]['case9'];

        $tabCase=[
            $case1[1],
            $case2[1],
            $case3[1],
            $case4[1],
            $case5[1],
            $case6[1],
            $case7[1],
            $case8[1],
            $case9[1]
        ];

        if(
        (($case1==$case2 && $case2==$case3) && 
        ($case1[0] && $case2[0]&& $case3[0] ))

        || 

        (($case4==$case5 && $case5==$case6)
            && 
        ($case4[0] && $case5[0]&& $case6[0] ))

        || 

        (($case7==$case8 && $case8==$case9)
            && 
        ($case7[0] && $case8[0]&& $case9[0] ))

        || 

        (($case1==$case4 && $case4==$case7)
            && 
        ($case1[0] && $case4[0]&& $case7[0] ))

        || 

        (($case2==$case5 && $case5==$case8)
            && 
        ($case2[0] && $case5[0]&& $case8[0] ))

        || 

        (($case3==$case6 && $case6==$case9)
            && 
        ($case3[0] && $case6[0]&& $case9[0] ))

        || 
        (($case1==$case5 && $case5==$case9)
            && 
        ($case1[0] && $case5[0]&& $case9[0] ))

        || 

        (($case3==$case5 && $case5==$case7)
            && 
        ($case3[0] && $case5[0]&& $case7[0] ))
    )

        {
            session(["gagne"=>"Victoire de $d_s"]);
            return;
        }

        $egalite=true;
        foreach ($tabCase as $t) {
            if($t==" ") $egalite=false;
        }

        $egalite? session(["gagne"=>"Egalité"]):session(["gagne"=>"En cours"]);
    }

    public function reinitialiser(){
        session(['gagne'=>"En cours"]);
        session(['dernier_signe'=>session('choix')]);
        session(['case'=>$this->case]);
        return redirect()->route('jeu.index');
    }

    
}
